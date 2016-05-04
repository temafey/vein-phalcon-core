<?php
/**
 * @namespace
 */
namespace Vein\Core\UnitTest\Generator;

/**
 * Generator for base test class skeletons from classes.
 *
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */
class RegularTestGenerator extends AbstractGenerator
{

    /**
     * Test modules
     * @var array
     */
    protected $_modules = [];

    /**
     * Constructor.
     *
     * @param string $outClassName
     * @param string $outSourceFile
     * @param array $modules
     * @throws \RuntimeException
     */
    public function __construct($outClassName = '', $outSourceFile = '', array $modules = [])
    {
        $this->_outClassName = $this->_parseFullyQualifiedClassName(
            $outClassName
        );

        $this->_outSourceFile = str_replace(
            $this->_outClassName['fullyQualifiedClassName'],
            $this->_outClassName['className'],
            $outSourceFile
        );

        $this->_modules = $modules;
    }

    /**
     * Generate base test class
     *
     * @return string
     */
    public function generate()
    {
        $oathinfo = pathinfo($this->_outSourceFile);

        $classTemplate = new Template(
            sprintf(
                '%s%stemplate%s'.$oathinfo['filename'].'.tpl',
                __DIR__,
                DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR
            )
        );

        $testsuites = $this->getTestsuites($this->_modules);

        $classTemplate->setVar(
            [
                'testsuites'         => $testsuites,
                'testClassName'      => $this->_outClassName['className'],
                'date'               => date('Y-m-d'),
                'time'               => date('H:i:s')
            ]
        );

        return $classTemplate->render();
    }

    /**
     * Genereate testsuites
     *
     * @param array $modules
     * @return string
     */
    public function getTestsuites(array $modules)
    {
        $testsuiteModules = [];
        foreach ($modules as $module => $tests) {
            $testsuite = '<testsuite name="'.$module.' Test Suite">';
            $testsuitefiles = [];
            foreach ($tests as $localTestPath) {
                $testsuitefiles[] = '<file>'.$localTestPath.'</file>';
            }
            $testsuite .= "\r\n\t\t\t".implode("\r\n\t\t\t", $testsuitefiles);
            $testsuite .= "\r\n\t\t".'</testsuite>';

            $testsuiteModules[] = $testsuite;
        }

        return implode("\r\n\t\t", $testsuiteModules);
    }
}
