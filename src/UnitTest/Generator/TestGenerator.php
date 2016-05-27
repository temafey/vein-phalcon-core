<?php
/**
 * @namespace
 */
namespace Vein\Core\UnitTest\Generator;

/**
 * Generator for test class skeletons from classes.
 *
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */
class TestGenerator extends AbstractGenerator
{
    public static $EXCLUDE_DECLARING_CLASES = ['Phalcon', 'Exception'];

    public static $EXCLUDE_DECLARING_CLASES_FOR_METHODS = ['Phalcon', 'Exception'];

    public static $EXCLUDE_DECLARING_METHODS = [
        'setdi',
        'getdi',
        'seteventsmanager',
        'geteventsmanager',
        'getmodelsmetadata',
        'getmodelsmanager',
        'getautoloadmethodprefix',
        'getautoloadmethodprefixexception',
        'setautoloadmethodprefix',
        'setautoloadmethodprefixexception',
        'addautoloadmethodprefixexception',
        'getclassresources',
        'isexception',
        'getclassresourcenames',
    ];

    /**
     * @var array
     */
    protected $_methodNameCounter = [];

    /**
     * Constructor.
     *
     * @param string $inClassName
     * @param string $inSourceFile
     * @param string $outClassName
     * @param string $outSourceFile
     * @param string $baseNamespace
     * @throws \RuntimeException
     */
    public function __construct(
        $inClassName,
        $inSourceFile = '',
        $outClassName = '',
        $outSourceFile = '',
        $baseNamespace = ''
    ) {
        if (class_exists($inClassName)) {
            $reflector = new \ReflectionClass($inClassName);
            $inSourceFile = $reflector->getFileName();

            if ($inSourceFile === false) {
                $inSourceFile = '<internal>';
            }

            unset($reflector);
        } else {
            if (empty($inSourceFile)) {
                $possibleFilenames = [
                    $inClassName . '.php',
                    str_replace(
                        ['_', '\\'],
                        DIRECTORY_SEPARATOR,
                        $inClassName
                    ) . '.php'
                ];

                foreach ($possibleFilenames as $possibleFilename) {
                    if (is_file($possibleFilename)) {
                        $inSourceFile = $possibleFilename;
                    }
                }
            }

            if (empty($inSourceFile)) {
                throw new \RuntimeException(
                    sprintf(
                        'Neither \'%s\' nor \'%s\' could be opened.',
                        $possibleFilenames[0],
                        $possibleFilenames[1]
                    )
                );
            }

            if (!is_file($inSourceFile)) {
                throw new \RuntimeException(
                    sprintf(
                        '\'%s\' could not be opened.',
                        $inSourceFile
                    )
                );
            }

            $inSourceFile = realpath($inSourceFile);
            include_once $inSourceFile;

            if (!class_exists($inClassName)) {
                throw new \RuntimeException(
                    sprintf(
                        'Could not find class \'%s\' in \'%s\'.',
                        $inClassName,
                        $inSourceFile
                    )
                );
            }
        }

        if (empty($outClassName)) {
            $outClassName = $inClassName . 'Test';
        }

        if (empty($outSourceFile)) {
            $outSourceFile = dirname($inSourceFile) . DIRECTORY_SEPARATOR . end(explode('\\', $outClassName)) . '.php';
        }

        parent::__construct(
            $inClassName,
            $inSourceFile,
            $outClassName,
            $outSourceFile,
            $baseNamespace
        );
    }

    /**
     * Generate test class code
     *
     * @return string
     */
    public function generate()
    {
        $class = new \ReflectionClass(
            $this->_inClassName['fullyQualifiedClassName']
        );

        if ($class->isAbstract()) {
            sprintf(
                'Class \'%s\' is abstract, test class will not be generate',
                $class->getName()
            );
            return false;
        }

        $methods           = '';
        $incompleteMethods = '';
        $constructArguments = '';
        $constructParameters = '';
        $constructArgumentsInitialize = '';

        foreach ($class->getMethods() as $method) {
            if ($method->isDestructor()) {
                continue;
            }
            $methodName = $method->getName();
            $methodDeclaringClassName = $method->getDeclaringClass()->getName();
            if ($method->isConstructor()) {
                $parameters = $method->getParameters();
                list($constructArguments, $constructArgumentsInitialize, $constructComment) = $this->_processMethodDocComment($class, $method);
            } elseif (
                !$method->isAbstract()
                && $method->isPublic()
                //&& $method->getDeclaringClass()->getName() == trim($this->_inClassName['fullyQualifiedClassName'], '\\')
                && !in_array(explode('\\', trim($methodDeclaringClassName, '\\'))[0], self::$EXCLUDE_DECLARING_CLASES_FOR_METHODS)
                && !in_array(strtolower($methodName), self::$EXCLUDE_DECLARING_METHODS)
            ) {
                $assertAnnotationFound = false;
                $testMethodCode = $this->_renderMethod($class, $method);
                if (!$testMethodCode) {
                    continue;
                }
                $methods .= $testMethodCode;

                $assertAnnotationFound = true;

                /*if (!$assertAnnotationFound) {
                    $methodTemplate = new Template(
                        sprintf(
                            '%s%stemplate%sIncompleteTestMethod.tpl',
                            __DIR__,
                            DIRECTORY_SEPARATOR,
                            DIRECTORY_SEPARATOR
                        )
                    );

                    $methodTemplate->setVar(
                        [
                            'namespace'      => $this->_inClassName['namespace'],
                            'className'      => $this->_inClassName['fullyQualifiedClassName'],
                            'methodName'     => ucfirst($method->getName()),
                            'origMethodName' => $method->getName()
                        ]
                    );

                    $incompleteMethods .= $methodTemplate->render();
                }*/
            }
        }

        $classTemplate = new Template(
            sprintf(
                '%s%stemplate%sTestClass.tpl',
                __DIR__,
                DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR
            )
        );

        $classTemplate->setVar(
            [
                'namespace'          => trim($this->_outClassName['namespace'], '\\'),
                'testBaseFullClassName'=> trim($this->_outClassName['testBaseFullClassName'], '\\'),
                'className'          => $this->_inClassName['className'],
                'fullClassName'      => $this->_inClassName['fullyQualifiedClassName'],
                'constructArguments' => $constructArguments,
                'constructArgumentsInitialize' => $constructArgumentsInitialize,
                'testClassName'      => $this->_outClassName['className'],
                'methods'            => $methods . $incompleteMethods,
                'date'               => date('Y-m-d'),
                'time'               => date('H:i:s')
            ]
        );

        return $classTemplate->render();
    }

    /**
     * Render test method
     *
     * @param \ReflectionClass $class
     * @param \ReflectionMethod $method
     * @return string
     */
    protected function _renderMethod(\ReflectionClass $class, \ReflectionMethod $method)
    {
        preg_match_all('/@return (.*)$/Um', $method->getDocComment(), $annotationReturn);
        if (!$annotationReturn[1]) {
            throw new \RuntimeException(
                sprintf(
                    'Could not find annotation comment for method \'%s\' in \'%s\' return annotation.',
                    $method->getName(),
                    $class->getName()
                )
            );
        }

        $expected = '';
        $annotationReturn[1][0] = trim($annotationReturn[1][0]);
        if (strpos($annotationReturn[1][0], '|') !== false) {
            $annotationReturn[1][0] = explode('|', $annotationReturn[1][0])[0];
        }
        switch ($annotationReturn[1][0]) {
            case 'int':
            case 'integer':
                $assertion = 'InternalType';
                $template  = 'TestMethod';
                $expected = '\'int\'';
                break;

            case 'string':
                $assertion = 'InternalType';
                $template  = 'TestMethod';
                $expected = '\'string\'';
                break;

            case 'bool':
            case 'boolean':
                $assertion = 'True';
                $template  = 'TestMethodBool';
                break;

            case 'void':
                $assertion = false;
                $template  = 'TestMethodVoid';
                break;

            default:
                $assertion = 'InstanceOf';
                $template  = 'TestMethod';
                $expected = '\''.$annotationReturn[1][0].'\'';
        }

        if ($method->isStatic()) {
            $template .= 'Static';
        }

        $methodTemplate = new Template(
            sprintf(
                '%s%stemplate%s%s.tpl',
                __DIR__,
                DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR,
                $template
            )
        );

        $origMethodName = $method->getName();
        $methodName     = ucfirst($origMethodName);

        if (isset($this->_methodNameCounter[$methodName])) {
            $this->_methodNameCounter[$methodName]++;
        } else {
            $this->_methodNameCounter[$methodName] = 1;
        }

        if ($this->_methodNameCounter[$methodName] > 1) {
            $methodName .= $this->_methodNameCounter[$methodName];
        }
        $methodOptions = $this->_processMethodDocComment($class, $method);
        if (!$methodOptions) {
            return false;
        }

        list($arguments, $argumentsInitialize, $methodComment) = $this->_processMethodDocComment($class, $method);

        $annotation = '';
        $methodTemplate->setVar(
            [
                'annotation'     => trim($annotation),
                'arguments'      => $arguments,
                'argumentsInitialize' => $argumentsInitialize,
                'assertion'      => isset($assertion) ? $assertion : '',
                'expected'       => $expected,
                'origMethodName' => $origMethodName,
                'className'      => $this->_inClassName['fullyQualifiedClassName'],
                'methodName'     => $methodName,
                'methodComment'  => $methodComment
            ]
        );

        return $methodTemplate->render();
    }

    /**
     * Process method doc comment and parse method description, method arguments and code for inititalize all arguments for testing
     *
     * @param \ReflectionClass $class
     * @param \ReflectionMethod $method
     * @return array
     */
    protected function _processMethodDocComment(\ReflectionClass $class, \ReflectionMethod $method)
    {
        $excludeConstructor = false;
        $methodDeclaringClass = $method->getDeclaringClass()->getName();
        if (in_array(explode('\\', $methodDeclaringClass)[0], self::$EXCLUDE_DECLARING_CLASES)) {
            if ($method->isConstructor()) {
               $excludeConstructor = true;
            } else {
                return false;
            }
        }
        $namespaces = $this->getNamespacesFromSource($class->getFileName());
        list ($extendedClasses, $extendedTraits) = $this->getParentClassesAndTraits($class);

        $methodDocComment = $method->getDocComment();
        preg_match_all('/\* (.*)$/Um', $methodDocComment, $annotationComment);
        $methodComment = (isset($annotationComment[1][0])) ?
            trim($annotationComment[1][0]) :
            ucfirst(\Phalcon\Text::uncamelize(trim($method->getName(), '_')));

        preg_match_all('/@param (.*?) (.*)$/Um', $methodDocComment, $annotationParams);
        $parameters = $method->getParameters();
        $argumentsInitialize = [];
        $arguments = [];

        foreach ($parameters as $i => $param) {
            $setEndColon = true;
            $argumentName = '$'.$param->getName();
            $argumentInitialize = '$'.$param->getName().' = ';
            if ($param->isDefaultValueAvailable()) {
                $value = $param->getDefaultValue();
                if (
                    ($value === null || $value === false || $value === true) &&
                    @class_exists($annotationParams[1][$i])
                ) {
                    list($mockName, $mock) = $this->getMock($annotationParams[1][$i], $class, $method, $namespaces);
                    $argumentName = $mockName;
                    $argumentInitialize = $mockName.' = '.$mock;
                    $setEndColon = false;
                } elseif ($value === null) {
                    $argumentInitialize .= 'null';
                } elseif ($value === false) {
                    $argumentInitialize .= 'false';
                } elseif ($value === true) {
                    $argumentInitialize .= 'true';
                } elseif (is_numeric($value) || is_float($value)) {
                    $argumentInitialize .= $value;
                } elseif (is_array($value)) {
                    $tmpValue = [];
                    foreach ($value as $key => $val) {
                        $key = (is_numeric($key) || is_float($key)) ? $key : '\''.$key.'\'';
                        $value = (is_numeric($value) || is_float($value)) ? $value : '\''.$value.'\'';
                        $tmpValue[] = $key. ' => '.$value;
                    }
                    $argumentInitialize .= '['.implode(', ', $tmpValue).']';
                } else {
                    $argumentInitialize .= '\''.$value.'\'';
                }
            } else {
                if (!isset($annotationParams[1][$i]) &&
                    in_array(explode('\\', $methodDeclaringClass)[0], self::$EXCLUDE_DECLARING_CLASES_FOR_METHODS)
                ) {
                    $annotationParams[1][$i] = null;
                }
                if (!array_key_exists($i, $annotationParams[1])) {
                    throw new \RuntimeException(
                        sprintf(
                            'In class \'%s\' in method \'%s\' for argument  \'%s\' annotation not exists.',
                            $class->getName(),
                            $method->getName(),
                            $param->getName()
                        )
                    );
                }
                $annotationParams[1][$i] = trim($annotationParams[1][$i]);
                if (strpos($annotationParams[1][$i], '|') !== false) {
                    $annotationParams[1][$i] = explode('|', $annotationParams[1][$i])[0];
                }
                switch ($annotationParams[1][$i]) {
                    case 'int':
                    case 'integer':
                        $argumentInitialize .= '1';
                        break;

                    case 'float':
                        $argumentInitialize .= '1.5';
                        break;

                    case 'string':
                        $argumentInitialize .= '\'test'.ucfirst($param->getName()).'\'';
                        break;

                    case 'bool':
                    case 'boolean':
                        $argumentInitialize .= 'true';
                        break;

                    case 'mixed':
                        $argumentInitialize .= '\'test\'';
                        break;

                    case 'array':
                        $argumentInitialize .= '[\'test1\', \'test2\', \'test3\']';
                        break;

                    case '\Closure':
                        $argumentInitialize .= 'function () { return true; }';
                        break;

                    default:
                        if (!$excludeConstructor && empty($annotationParams[1][$i])) {
                            throw new \RuntimeException(
                                sprintf(
                                    'Could not find param type for param \'%s\' in method \'%s\' in \'%s\'.',
                                    $param->getName(),
                                    $method->getName(),
                                    $class->getName()
                                )
                            );
                        }
                        if (!$excludeConstructor) {
                            list($mockName, $mock) = $this->getMock($annotationParams[1][$i], $class, $method, $namespaces);
                            $argumentName = $mockName;
                            $argumentInitialize = $mockName.' = '.$mock;
                            $setEndColon = false;
                        } else {
                            $argumentInitialize .= '\'test'.ucfirst($param->getName()).'\'';
                        }
                }
            }
            if ($setEndColon) {
                $argumentInitialize .= ';';
            }
            $arguments[] = $argumentName;
            $argumentsInitialize[] = $argumentInitialize;
        }
        $arguments = implode(', ', $arguments);
        $argumentsInitialize = implode("\r\n\t\t", $argumentsInitialize);

        return [$arguments, $argumentsInitialize, $methodComment];
    }

    /**
     * Generate mock object
     *
     * @param string $className
     * @param \ReflectionClass $parentClass
     * @param \ReflectionMethod $parentMethod
     * @param array $parentNamespaces
     * @param integer $level
     * @return array
     */
    public function getMock(
        $className,
        \ReflectionClass $parentClass,
        \ReflectionMethod $parentMethod,
        array $parentNamespaces,
        $level = 0
    ) {
        ++$level;
        $className = trim($className);
        $mockName = '$mock'.ucfirst(str_replace('\\', '', $className));
        try {
            $reflection = new \ReflectionClass($className);
        } catch (\Exception $e) {
            $alias = $className;
            $fullClassName = $className;
            if (strpos('\\', $className)) {
                $alias = explode('\\', $className)[0];
            }
            if (isset($parentNamespaces[$alias])) {
                $fullClassName = $parentNamespaces[$alias];
            }
            try {
                $reflection = new \ReflectionClass($fullClassName);
            } catch (\Exception $e) {
                throw new \RuntimeException(
                    sprintf(
                        'Class \'%s\' not exists, creating mock in parent class \'%s\' for method  \'%s\'.',
                        $fullClassName,
                        $parentClass->getName(),
                        $parentMethod->getName()
                    )
                );
            }
        }

        if (
            in_array(explode('\\', trim($className, '\\'))[0], self::$EXCLUDE_DECLARING_CLASES) ||
            $reflection->isInterface() ||
            $level > 1
        ) {
            $mock = $mockName.' = $this->getMockBuilder(\''.$className.'\')
           ->disableOriginalConstructor()
           ->getMock();';

            return [$mockName, $mock];
        }

        list ($extendedClasses, $extendedTraits) = $this->getParentClassesAndTraits($reflection);
        $methods = $reflection->getMethods();
        $refMethods = [];
        $mockMethods = [];

        foreach ($methods as $refMethod) {
            if ($refMethod->isConstructor() ||
                $refMethod->isProtected() ||
                $refMethod->isPrivate()
            ) {
                continue;
            }
            $refMethodName = $refMethod->getName();
            $refMethodDeclaringClassName = $refMethod->getDeclaringClass()->getName();
            if (
                in_array(explode('\\', trim($refMethodDeclaringClassName, '\\'))[0], self::$EXCLUDE_DECLARING_CLASES_FOR_METHODS) ||
                in_array(strtolower($refMethodName), self::$EXCLUDE_DECLARING_METHODS)
            ) {
                continue;
            }
            preg_match_all('/@return (.*)$/Um', $refMethod->getDocComment(), $annotationReturn);
            if (!$annotationReturn[1]) {
                throw new \RuntimeException(
                    sprintf(
                        'In class \'%s\ could not find annotation comment for method \'%s\' in \'%s\' return annotation.',
                        $className,
                        $refMethodName,
                        $reflection->getName()
                    )
                );
            }

            $annotationReturn[1][0] = trim($annotationReturn[1][0]);
            if ($annotationReturn[1][0] === 'void') {
                continue;
            }
            $expected = '';
            if (strpos($annotationReturn[1][0], '|') !== false) {
                $annotationReturn[1][0] = explode('|', $annotationReturn[1][0])[0];
            }
            switch ($annotationReturn[1][0]) {
                case 'int':
                case 'integer':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(1));';
                    break;

                case 'float':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(1.5));';
                    break;

                case 'string':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(\'testMock'.$refMethodName.'\'));';
                    break;

                case 'bool':
                case 'true':
                case 'boolean':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(true));';
                    break;

                case 'false':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(false));';
                    break;

                case 'null':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(null));';
                    break;

                case 'mixed':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(\'testMock'.$refMethodName.'\'));';
                    break;

                case 'void':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(\'testMock'.$refMethodName.'\'));';
                    break;

                case 'array':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue([\'test1\', \'test2\', \'test3\']));';
                    break;

                case '\Closure':
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue(function () { return true; }));';
                    break;

                case '$this':
                case $className:
                    $mockMethod = $mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnSelf());';
                    break;

                default:
                    if (
                        in_array(trim($annotationReturn[1][0], ' \\'), $extendedClasses) ||
                        in_array(trim($annotationReturn[1][0], ' \\'), $extendedTraits)
                    ) {
                        $mockMethod = $mockName.
                            '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnSelf());';
                        break;
                    }
                    $refNamespaces = $this->getNamespacesFromSource($reflection->getFileName());
                    list($refMockName, $refMock) = $this->getMock($annotationReturn[1][0], $reflection, $refMethod, $refNamespaces, $level);
                    $mockMethod = "\r\n\t\t".$refMock."\r\n\t\t".$mockName.
                        '->expects($this->any())->method(\''.$refMethodName.'\')->will($this->returnValue('.$refMockName.'));';
                    break;

            }
            $mockMethods[] = $mockMethod;
            $refMethods[] = '\''.$refMethodName.'\'';
        }

        $mock = '$this->getMockBuilder(\''.$className.'\')
           ->setMethods(['.implode(', ', $refMethods).'])
           ->disableOriginalConstructor()
           ->getMock();';

        $mock .= "\r\n\r\n\t\t". implode("\r\n\t\t", $mockMethods)."\r\n";

        return [$mockName, $mock];
    }

    /**
     * Return all namespaces source
     *
     * @param  string $sourceName
     * @return array
     */
    public function getNamespacesFromSource($sourceName)
    {
        $namespaces = [];
        $tokens = token_get_all(file_get_contents($this->_inSourceFile));

        for ($i=0; $i<count($tokens); ++$i) {
            $token = $tokens[$i];
            if (is_array($token) && $token[0] === T_USE) {
                $y = 0;
                ++$i;
                $namespace = [];
                $alias = false;
                $namespaceFinish = false;
                foreach (array_slice($tokens, $i) as $y => $useToken) {
                    if (
                        is_array($useToken) &&
                        (
                            $useToken[0] === T_WHITESPACE ||
                            $useToken[0] === T_NS_SEPARATOR
                        )
                    ) {
                        continue;
                    }

                    if (is_array($useToken) && $useToken[0] === T_STRING) {
                        $useToken[1] = trim($useToken[1]);
                        if (!$namespaceFinish) {
                            $namespace[] = $useToken[1];
                            if (!$alias) {
                                $alias = $useToken[1];
                            }
                        } else {
                            $alias = $useToken[1];
                        }
                    } elseif (is_string($useToken)) {
                        if ($useToken === ',') {
                            $namespace = implode('\\', $namespace);
                            $namespaces[$alias] = $namespace;
                            $namespace = [];
                            $alias = false;
                            $namespaceFinish = false;
                        } elseif ($useToken === ';') {
                            break;
                        }
                    } elseif (is_array($useToken) && $useToken[0] === T_AS) {
                        $namespaceFinish = true;
                    }
                }
                $namespace = implode('\\', $namespace);
                $namespaces[$alias] = $namespace;

                $i += $y;
            }
            if (is_array($token) && $token[0] === T_CLASS) {
                break;
            }
        }

        return $namespaces;
    }

    /**
     * Parse and find all parent classes and traits
     *
     * @param \ReflectionClass $reflection
     * @return array
     */
    public function getParentClassesAndTraits(\ReflectionClass $reflection)
    {
        $traitsNames = [];
        $parentClasses = [];

        $recursiveClasses = function ($class) use(&$recursiveClasses, &$traitsNames, &$parentClasses) {
            if ($class->getParentClass() != false) {
                $parentClasses[] = $class->getParentClass()->getName();
                $recursiveClasses($class->getParentClass());
            }
            else {
                $traitsNames = array_merge($traitsNames, $class->getTraitNames());
            }
        };

        $recursiveClasses($reflection);

        return [$parentClasses, $traitsNames];
    }
}
