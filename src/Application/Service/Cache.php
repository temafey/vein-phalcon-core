<?php
/**
 * @namespace
 */
namespace Vein\Core\Application\Service;

use Vein\Core\Application\Service\AbstractService;

/**
 * Class Cache
 *
 * @category   Vein\Core
 * @package    Application
 * @subpackage Service
 */
class Cache extends AbstractService
{
    /**
     * Initializes the cache
     */
    public function init()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        if (!$this->_config->application->debug || $this->_config->application->useCachingInDebugMode) {
            $cacheAdapter = $this->_getBackendCacheAdapter($this->_config->application->cache->data->adapter);
            if (!$cacheAdapter) {
                throw new \Vein\Core\Exception("Cache adapter '{$this->_config->application->cache->data->adapter}' not exists!");
            }
            $frontEndOptions = ['lifetime' => $this->_config->application->cache->data->lifetime];
            $backEndOptions = $this->_config->application->cache->data->toArray();
            if (extension_loaded('igbinary')) {
                $frontDataCache = new \Phalcon\Cache\Frontend\Igbinary($frontEndOptions);
            } else {
                $frontDataCache = new \Phalcon\Cache\Frontend\Data($frontEndOptions);
            }

            // Cache:Data
            $cacheData = new $cacheAdapter($frontDataCache, $backEndOptions);
            $dependencyInjector->set('cacheData', $cacheData, true);

            // Cache:Models
            $cacheModels = new $cacheAdapter($frontDataCache, $backEndOptions);
            $dependencyInjector->set('modelsCache', $cacheModels, true);

            $cacheAdapter = $this->_getBackendCacheAdapter($this->_config->application->cache->output->adapter);
            if (!$cacheAdapter) {
                throw new \Vein\Core\Exception("Cache adapter '{$this->_config->application->cache->output->adapter}' not exists!");
            }
            $frontEndOptions = ['lifetime' => $this->_config->application->cache->output->lifetime];
            $backEndOptions = $this->_config->application->cache->output->toArray();
            $frontOutputCache = new \Phalcon\Cache\Frontend\Output($frontEndOptions);

            // Cache:View
            $viewCache = new $cacheAdapter($frontOutputCache, $backEndOptions);
            $dependencyInjector->set('viewCache', $viewCache, false);

            // Cache:Output
            $cacheOutput = new $cacheAdapter($frontOutputCache, $backEndOptions);
            $dependencyInjector->set('cacheOutput', $cacheOutput, true);
        } else {
            // Create a dummy cache for system.
            // System will work correctly and the data will be always current for all adapters
            $dummyCache = new \Vein\Core\Cache\Dummy(null);
            $dependencyInjector->set('viewCache', $dummyCache);
            $dependencyInjector->set('cacheOutput', $dummyCache);
            $dependencyInjector->set('cacheData', $dummyCache);
            $dependencyInjector->set('modelsCache', $dummyCache);
        }
    }

    /**
     * Clear application cache
     */
    public function clearCache()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        // clear cache
        $viewCache = $dependencyInjector->get('viewCache');
        $cacheOutput = $dependencyInjector->get('cacheOutput');
        $cacheData = $dependencyInjector->get('cacheData');
        $modelsCache = $dependencyInjector->get('modelsCache');
        $config = $dependencyInjector->get('config');

        $keys = $viewCache->queryKeys();
        foreach ($keys as $key) {
            $viewCache->delete($key);
        }

        $keys = $cacheOutput->queryKeys();
        foreach ($keys as $key) {
            $cacheOutput->delete($key);
        }

        $keys = $cacheData->queryKeys();
        foreach ($keys as $key) {
            $cacheData->delete($key);
        }

        $keys = $modelsCache->queryKeys();
        foreach ($keys as $key) {
            $modelsCache->delete($key);
        }

        // clear files cache
        $files = glob($this->_config->application->cache->cacheDir.'*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                @unlink($file); // delete file
            }
        }

        // clear view cache
        $files = glob($this->_config->application->view->compiledPath.'*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                @unlink($file); // delete file
            }
        }

        // clear metadata cache
        if ($this->_config->metadata && $this->_config->metadata->metaDataDir) {
            $files = glob($this->_config->metadata->metaDataDir.'*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    @unlink($file); // delete file
                }
            }
        }

        // clear annotations cache
        if ($config->annotations && $config->annotations->annotationsDir) {
            $files = glob($config->annotations->annotationsDir.'*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    @unlink($file); // delete file
                }
            }
        }

        // clear assets cache
        $this->_dependencyInjector->getShared('assets')->clear();
    }

    /**
     * Return backend cache adapter full class name
     *
     * @param string $name
     * @return string
     */
    protected function _getBackendCacheAdapter($name)
    {
        if (class_exists($name)) {
            $adapter = $name;
        } else {
            $adapter = '\Vein\Core\Cache\Backend\\' . ucfirst($name);
            if (!class_exists($adapter)) {
                $adapter = '\Phalcon\Cache\Backend\\' . ucfirst($name);
                if (!class_exists($adapter)) {
                    return false;
                }
            }
        }

        return $adapter;
    }
}