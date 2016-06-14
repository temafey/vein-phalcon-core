<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;

/**
 * Class SimpleServiceTemplater
 * @package Vein\Core\Builder\Traits
 *
 */
trait SimpleTraitTemplater
{

    public $templateSimpleTraitFileCode = '<?php
%s

%s

%s
trait %s
{
%s
}
';

    public $templateSimpleUseTrait = [
        '%s as %s'
    ];

    public $templateSimpleTraitProperty = "
    /**
     * %s service
     * @var %s
     */
    private \$_%s;
";
    public $templateSimpleTraitSet = "
    /**
     * Set %s %s %s
     *
     * @param %s \$%s
     *
     * @return mixed
     */
    public function set%s(%s \$%s)
    {
        \$this->_%s = \$%s;
        return \$this;
    }
";

    public $templateSimpleTraitGet = "
    /**
     * Return %s %s %s object
     *
     * @return %s
     * @throws \Vein\Core\Exception
     */
    public function get%s()
    {
        if (null === \$this->_%s) {
            if (\$this->_di) {
                \$this->_%s = \$this->_di->get('%s');
            }
        }
        if (!\$this->_%s instanceof %s) {
            throw new \Vein\Core\Exception('Object not instance of %s');
        }
        return \$this->_%s;
    }
";

}
