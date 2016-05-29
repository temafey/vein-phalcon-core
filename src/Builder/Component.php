<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2013 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Vein\Core\Builder;

use Vein\Core\Builder\Script\Color,
    Vein\Core\Builder\BuilderException,
    Vein\Core\Tools\Inflector,
    Vein\Core\Tools\File;

/**
 * \Phalcon\Builder\Component
 *
 * Base class for builder components
 *
 * @category 	Phalcon
 * @package 	Builder
 * @subpackage  Component
 * @copyright   Copyright (c) 2011-2013 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
abstract class Component
{
    const OPTION_MODEL = 1;

    const OPTION_FORM = 2;

    const OPTION_GRID = 3;

    const OPTION_SERVICE = 6;

    const OPTION_TRAIT = 7;

    const TYPE_SIMPLE = 4;

    const TYPE_EXTJS = 5;

    protected $db = null;

	protected $_options = [];

    protected $_builderOptions = array();

	public function __construct($options)
	{
		$this->_options = $options;
	}

    /**
     * Tries to find the current configuration in the application
     *
     * @param $configPath
     * @return mixed|\Phalcon\Config\Adapter\Ini
     * @throws BuilderException
     */
    protected function _getConfig($configPath)
	{
        if ($configPath) {
            $configPath = rtrim(trim($configPath), "/")."/";
        }
		/*foreach (array('', 'config/', 'app/config/', '../config/') as $configPath) {
			if (file_exists($path.$configPath."engine.ini")) {
				return new \Phalcon\Config\Adapter\Ini($path.$configPath."/engine.ini");
			} else {
				if (file_exists($path.$configPath."engine.php")) {
					$config = include($path.$configPath."engine.php");
					return $config;
				}
			}
		}

		$dependencyInjectorrectory = new \RecursiveDirectoryIterator('.');
		$iterator = new \RecursiveIteratorIterator($dependencyInjectorrectory);
		foreach ($iterator as $f) {
			if (preg_match('/engine\.php$/', $f->getPathName())) {
				$config = include $f->getPathName();
				return $config;
			} else {
				if (preg_match('/engine\.ini$/', $f->getPathName())) {
					return new \Phalcon\Config\Adapter\Ini($f->getPathName());
				}
			}
		}*/
        $configFlag = false;
        if (is_file($configPath)) {
            $configFlag = true;
            $globalConfig = include($configPath);
        } else {
            $globalConfig = new \Phalcon\Config();
            $files = scandir($configPath); // get all file names
            foreach ($files as $file) { // iterate files
                if ($file === '.' || $file === '..' || $file[0] === '_' || $file[0] === '.') {
                    continue;
                }
                $configFilePath = $configPath.'/'.$file;
                $fileInfo = pathinfo($configFilePath);
                if ($fileInfo['extension'] !== 'php') {
                    continue;
                }
                $configFlag = true;
                $config = include($configFilePath);
                $globalConfig->merge($config);
            }
        }

        if (!$configFlag) {
            throw new BuilderException('Builder can\'t locate the configuration file');
        }

        return $globalConfig;
	}

    protected function prepareDbConnection($config)
    {
        // If no database configuration in config throw exception
        if (!isset($config->database)) {
            throw new BuilderException(
                "Database configuration cannot be loaded from your config file"
            );
        }


        // if no adapter in database config throw exception
        if (!isset($config->database->adapter)) {
            throw new BuilderException(
                "Adapter was not found in the config. " .
                "Please specify a config variable [database][adapter]"
            );
        }

        // If model already exist throw exception
        if (file_exists($this->_builderOptions['path'])) {
            if (!array_key_exists('force', $this->_options) || !$this->_options['force']) {
                if (array_key_exists('forceContinue', $this->_options) && $this->_options['forceContinue']) {
                    print Color::colorize(
                            'The model file "' . $this->_builderOptions['path'] .
                            '" already exists in models dir',
                            Color::FG_YELLOW
                        ) . PHP_EOL;
                    return false;
                }
                throw new BuilderException(
                    "The model file '" . $this->_builderOptions['path'] .
                    "' already exists in models dir"
                );
            }
        }


        // Get and check database adapter
        $adapter = $config->database->adapter;
        $this->isSupportedAdapter($adapter);
        if (isset($config->database->adapter)) {
            $adapter = $config->database->adapter;
        } else {
            $adapter = 'pdo\Mysql';
        }
        // Get database configs
        if (is_object($config->database)) {
            $configArray = $config->database->toArray();
        } else {
            $configArray = $config->database;
        }
        $adapterName = 'Phalcon\Db\Adapter\\'.ucfirst($adapter);
        unset($configArray['adapter']);
        // Open Connection
        $db = new $adapterName($configArray);

        $this->db = $db;

        return true;
    }

    /**
     * Check if a path is absolute
     *
     * @param $path
     * @return bool
     */
    public function isAbsolutePath($path)
	{
		if (PHP_OS == "WINNT") {
			if (preg_match('/^[A-Z]:\\\\/', $path)) {
				return true;
			}
		} else {
			if (substr($path, 0, 1) == DIRECTORY_SEPARATOR) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if the script is running on Console mode
	 *
	 * @return boolean
	 */
	public function isConsole()
	{
		return !isset($_SERVER['SERVER_SOFTWARE']);
	}

	/**
	 * Check if the current adapter is supported by Phalcon
	 *
	 * @param string $adapter
	 * @throws BuilderException
	 */
	public function isSupportedAdapter($adapter)
	{
		if (!class_exists('\Phalcon\Db\Adapter\\' . ucfirst($adapter))) {
			throw new BuilderException("Adapter $adapter is not supported");
		}
	}

	/**
	 * Shows a success notification
	 *
	 * @param string $message
	 */
	protected function _notifySuccess($message)
	{
		print Color::success($message);
	}

	abstract public function build();

    protected function buildOptions($table, $config, $type = self::OPTION_MODEL, $buildType = self::TYPE_SIMPLE)
    {
        $moduleName = $this->getModuleNameByTableName($table);
        $className = $this->getclassName($table);
        list($modelNamespace, $namespaceClear) = $this->getNameSpace($table, $type, $buildType);
        $useComponents = $this->getUseComponennts($type, $buildType);
        $classHead = $this->getClassHead($table, $type, $buildType);

        if (isset($config->builder)) {
            if (!isset($config->builder->modules)) {
                throw new \Vein\Core\Exception('Modules property not set in builder config section');
            }
            if (!isset($config->builder->modules->{$moduleName})) {
                throw new \Vein\Core\Exception('Module property not set in builder modules config section');
            }
            if ($type === self::OPTION_MODEL) {
                if (!isset($config->builder->modules->{$moduleName}->modelDir)) {
                    throw new \Vein\Core\Exception('ModelDir property not set in builder modules \''.$moduleName.'\' config section');
                }
                $path = $config->builder->modules->{$moduleName}->modelDir;
            } elseif ($type === self::OPTION_FORM) {
                if (!isset($config->builder->modules->{$moduleName}->formDir)) {
                    throw new \Vein\Core\Exception('FormDir property not set in builder modules \''.$moduleName.'\' config section');
                }
                $path = $config->builder->modules->{$moduleName}->formDir;
            } elseif ($type === self::OPTION_GRID) {
                if (!isset($config->builder->modules->{$moduleName}->gridDir)) {
                    throw new \Vein\Core\Exception('GridDir property not set in builder modules \''.$moduleName.'\' config section');
                }
                $path = $config->builder->modules->{$moduleName}->gridDir;
            } elseif ($type === self::OPTION_SERVICE) {
                if (!isset($config->builder->modules->{$moduleName}->serviceDir)) {
                    throw new \Vein\Core\Exception('ServiceDir property not set in builder modules \''.$moduleName.'\' config section');
                }
                $path = $config->builder->modules->{$moduleName}->serviceDir;
            } elseif ($type === self::OPTION_TRAIT) {
                if (!isset($config->builder->modules->{$moduleName}->traitDir)) {
                    throw new \Vein\Core\Exception('TraitDir property not set in builder modules \''.$moduleName.'\' config section');
                }
                $path = $config->builder->modules->{$moduleName}->traitDir;
            } else {
                throw new \InvalidArgumentException('Invalid build type');
            }
        } else {
            if (!isset($config->application)) {
                throw new \Vein\Core\Exception('Application property not set in config section');
            }
            if (!isset($config->application->modulesDir)) {
                throw new \Vein\Core\Exception('Modules property not set in application config section');
            }
            if ($type === self::OPTION_MODEL) {
                $path = rtrim($config->application->modulesDir, '/').'/'.ucfirst($moduleName).'/Model';
            } elseif ($type === self::OPTION_FORM) {
                $path = rtrim($config->application->modulesDir, '/').'/'.ucfirst($moduleName).'/Form';
            } elseif ($type === self::OPTION_GRID) {
                $path = rtrim($config->application->modulesDir, '/').'/'.ucfirst($moduleName).'/Grid';
            } elseif ($type === self::OPTION_SERVICE) {
                $path = rtrim($config->application->modulesDir, '/').'/'.ucfirst($moduleName).'/Service';
            } elseif ($type === self::OPTION_TRAIT) {
                $path = rtrim($config->application->modulesDir, '/').'/'.ucfirst($moduleName).'/Trait';
            }
        }

        $modelPath = $this->getPath($path, $table, $buildType);

        $this->_builderOptions = array(
            'moduleName' => $moduleName,
            'className' => $className,
            'namespace' => $modelNamespace,
            'use'       => $useComponents,
            'head'      => $classHead,
            'namespaceClear' => $namespaceClear,
            'path' => $modelPath
        );

        return true;
    }

    /**
     * Return module name based on table name
     * For example if table name is "front_category" return "front" <-- module name
     *
     * <code>
     * $moduleName = $this->getModuleNameByTableName("front_category");
     * </code>
     *
     * @param $table
     * @return mixed
     */
    protected function getModuleNameByTableName($table)
    {
        $pieces = explode('_', $table);

        if (empty($pieces)) {
            $pieces = [null];
        }

        return $pieces[0];
    }

    /**
     * Return class name
     *
     * @param $table
     * @return null|string
     */
    protected function getClassName($table)
    {
        $name = null;
        $pieces = explode('_', $table);
        return ucfirst(array_pop($pieces));
    }

    /**
     * Return alias by table name without module name
     *
     * @param $str
     * @return string
     */
    protected function getAlias($str)
    {
        $pieces = explode('_', strtolower($str));
        if (count($pieces) > 1) {
            array_shift($pieces);
        }

        return implode('_', $pieces);
    }

    protected function getPath($dependencyInjectorrPath, $table, $buildType = self::TYPE_SIMPLE)
    {
        $pieces = explode('_', $table);
        array_shift($pieces);

        $dependencyInjectorrPath = rtrim(trim($dependencyInjectorrPath), "/")."/";
        switch($buildType) {
            case self::TYPE_EXTJS: $dependencyInjectorrPath .= 'Extjs/';
                break;
        }

        if (!file_exists($dependencyInjectorrPath)) {
            File::rmkdir($dependencyInjectorrPath, 0755, true);
        }
        if (count($pieces) > 1) {
            $modelName = ucfirst(array_pop($pieces));

            $line = '';
            foreach ($pieces as $piece) {
                $line .= ucfirst($piece) . '/';
            }

            $path = $dependencyInjectorrPath . $line;

            if (!file_exists($path)) {
                File::rmkdir($path, 0755, true);
            }
            $path = rtrim(trim($path), "/")."/";
            $modelsDirPath = $path . $modelName . '.php';
        } else {
            $modelsDirPath = $dependencyInjectorrPath . $this->getClassName($table) . '.php';
        }

        return $modelsDirPath;
    }

    /**
     * Return class namespace
     *
     * @param string $table
     * @param string $type
     * @param int $builderType
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function getNameSpace($table, $type, $builderType = self::TYPE_SIMPLE)
    {
        $namespace = '';
        $namespaceClear = '';

        $pieces = explode('_', $table);
        $moduleName = array_shift($pieces);
        array_pop($pieces);

        switch($type) {
            case self::OPTION_MODEL: $buildType = 'Model';
                break;
            case self::OPTION_FORM: $buildType = 'Form';
                break;
            case self::OPTION_GRID: $buildType = 'Grid';
                break;
            case self::OPTION_SERVICE: $buildType = 'Service';
                break;
            default: throw new \InvalidArgumentException('Invalid build type');
                break;
        }

        $namespace = ucfirst($moduleName).'\\'.$buildType;

        switch($builderType) {
            case self::TYPE_EXTJS: $namespace .= '\Extjs';
                break;
        }

        if (count($pieces) > 0) {
            foreach ($pieces as $piece) {
                $namespace .= '\\'.ucfirst($piece);
            }
        }

        if ($namespace) {
            $namespaceClear = $namespace;
            $namespace = "/**\n * @namespace\n */\nnamespace ".$namespace.";";
        }

        return array($namespace, $namespaceClear);
    }

    /**
     * Return class head section
     *
     * @param string $table
     * @param string $type
     * @param int $builderType
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function getClassHead($table, $type, $builderType = self::TYPE_SIMPLE)
    {
        $pieces = explode('_', $table);
        $fullTemplate = false;
        $template = (count($pieces) == 2) ? $this->templateClassHeadSimple : $this->templateClassHeadFull;
        $packageName = ucfirst(array_shift($pieces));
        $className = ucfirst(array_pop($pieces));
        if ($pieces) {
            $subPackageName = ucfirst(array_pop($pieces));
            $fullTemplate = true;
        }

        switch($type) {
            case self::OPTION_MODEL: $categoryName = 'Model';
                break;
            case self::OPTION_FORM: $categoryName = 'Form';
                break;
            case self::OPTION_GRID: $categoryName = 'Grid';
                break;
            case self::OPTION_SERVICE: $categoryName = 'Service';
                break;
            default: throw new \InvalidArgumentException('Invalid build type');
            break;
        }

        $head = ($fullTemplate)
            ?
        sprintf(
            $this->templateClassHeadFull,
            $className,
            $categoryName,
            $packageName,
            $subPackageName
        )
            :
        sprintf(
            $this->templateClassHeadSimple,
            $className,
            $categoryName,
            $packageName
        );

        return $head;
    }

    /**
     * Return all class components for 'use' class section
     *
     * @param $type
     * @param int $builderType
     * @return string
     */
    protected function getUseComponennts($type, $builderType = self::TYPE_SIMPLE)
    {
        $useProperty = 'templateSimpleUse';
        switch($type) {
            case self::OPTION_MODEL: $useProperty .= 'Model';
                break;
            case self::OPTION_FORM: $useProperty .= 'Form';
                break;
            case self::OPTION_GRID: $useProperty .= 'Grid';
                break;
            case self::OPTION_SERVICE: $useProperty .= 'Service';
                break;
            default: throw new \InvalidArgumentException('Invalid build type');
            break;
        }
        switch($builderType) {
            case self::TYPE_EXTJS: $useProperty .= 'Extjs';
                break;
        }

        $use = [];
        foreach ($this->{$useProperty} as $alias => $namespace) {
            $use[] = (!is_numeric($alias)) ? $namespace." as ".$alias : $namespace;
        }

        if (!$use) {
            return '';
        }

        $delimeter = ",
    ";

        return "use ".implode($delimeter, $use).";";
    }

    protected function isEnum($table, $filed)
    {
        $res = $this->db->fetchOne("SHOW COLUMNS FROM {$table} WHERE Field = '{$filed}'");
        preg_match('/enum\((.*)\)$/', $res['Type'], $matches);

        $answer = false;

        if (count($matches) > 0) {
            $answer = true;
        }

        return $answer;
    }

    protected function getEnumValues($table, $filed)
    {
        $res = $this->db->fetchOne("SHOW COLUMNS FROM {$table} WHERE Field = '{$filed}'");
        preg_match('/enum\((.*)\)$/', $res['Type'], $matches);

        $return = array();

        if (count($matches) > 0) {
            foreach (explode(',', $matches[1]) as $value) {
                $return[] = trim($value, "'");
            }
        }

        return $return;
    }

}
