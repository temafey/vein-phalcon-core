<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait SimpleServiceTemplater {

    public $templateSimpleServiceFileCode = '<?php
%s

%s

%s
class %s implements %s
{
%s
}
';

    public $templateSimpleServiceExtends = 'Service';

    public $templateSimpleServiceImplements = 'InjectionAwareInterface';

    public $templateSimpleUseService = [
        'Phalcon\DI\InjectionAwareInterface',
        'Vein\Core\Tools\Traits\DIaware'
    ];


} 