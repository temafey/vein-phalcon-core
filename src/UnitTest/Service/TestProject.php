<?php
/**
 * @namespace
 */
namespace Vein\Core\UnitTest\Service;

use Vein\Core\UnitTest\Generator\TestGenerator,
    Vein\Core\UnitTest\Generator\BaseTestGenerator,
    Vein\Core\UnitTest\Generator\RegularTestGenerator;

/**
 * Class TestProject
 *
 * @package UnitTest
 * @subpackage Service
 */
class TestProject extends TestVendorModule
{
    /**
     * Base test namespace
     * @var string
     */
    protected $_baseNamespace = 'ModuleTest';

    /**
     * Generate tests
     *
     * @return void
     * @throws \Exception
     */
    public function generate()
    {
        if (!file_exists($this->_sourcePath)) {
            throw new \Exception("Source file '{$this->_sourcePath}' doesn't exitsts!");
        }
        list($testPath, $localTestPAth)  = $this->_getTestPathFromSource($this->_sourcePath);

        if (!file_exists($testPath)) {
            mkdir($testPath, 0755, true);
        }
        $this->_autoloader($this->_sourcePath);
        $modules = $this->_scanModulesSources($this->_sourcePath);

        $this->_generateRegular($testPath, 'bootstrap.php', $modules);
        $this->_generateRegular($testPath, 'phpunit.xml', $modules);
    }

    /**
     * Scan all subfolders in the source project directory and generate test for all classes
     *
     * @param string $directory
     * return array
     */
    protected function _scanModulesSources($modulesSourcePath)
    {
        $modulesFolders = scandir($modulesSourcePath);
        $modules = [];
        foreach ($modulesFolders as $folder) {
            if ($folder === '.' or $folder === '..') {
                continue;
            }
            $moduleSourcePath = $modulesSourcePath.'/'.$folder;
            if (!is_dir($moduleSourcePath)) {
                continue;
            }
            $this->_generateBase($moduleSourcePath);
            $this->_scanSources($moduleSourcePath);
            $modules[$folder] = $this->_localTestsPath;
            $this->_localTestsPath = [];
        }

        return $modules;
    }

    /**
     * Initialize autoloader
     *
     * @param string $modulesSourcePath
     */
    protected function _autoloader($modulesSourcePath)
    {
        $modulesFolders = scandir($modulesSourcePath);
        $modules = [];
        foreach ($modulesFolders as $folder) {
            if ($folder === '.' or $folder === '..') {
                continue;
            }
            $moduleSourcePath = $modulesSourcePath . '/' . $folder;
            if (!is_dir($moduleSourcePath)) {
                continue;
            }
            $modules[$folder] = $moduleSourcePath;
        }

        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces($modules);
        $loader->register();
    }

    /**
     * Generate skeleton for regular file
     *
     * @param string $sourcePath
     * @param string $filename
     * @param array $modules
     *
     * @return boolean
     * @throws \Exception
     */
    protected function _generateRegular($sourcePath, $filename, array $modules)
    {
        $tmpPath = explode('\\', trim(str_replace('/', '\\', $sourcePath), '/'));
        $namespace = array_pop($tmpPath);
        if (in_array(end($tmpPath), ['lib', 'test', 'tests', 'apps'])) {
            array_pop($tmpPath);
            if (in_array(end($tmpPath), ['lib', 'test', 'tests'])) {
                array_pop($tmpPath);
            }
        }
        $tmpPath[] = 'tests';
        $testPath = implode('/', $tmpPath);
        if (!file_exists($testPath)) {
            mkdir($testPath, 0755, true);
        }

        $generator = new RegularTestGenerator(
            '\\'.$namespace,
            $testPath.'/'.$filename,
            $modules
        );
        $generator->write();

        return true;
    }

}