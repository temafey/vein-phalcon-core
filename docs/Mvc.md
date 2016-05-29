## Table of contents

- [\Vein\Core\Mvc\Model](#class-veincoremvcmodel)
- [\Vein\Core\Mvc\Module (abstract)](#class-veincoremvcmodule-abstract)
- [\Vein\Core\Mvc\Model\Query](#class-veincoremvcmodelquery)
- [\Vein\Core\Mvc\Model\Behavior\Blameable](#class-veincoremvcmodelbehaviorblameable)
- [\Vein\Core\Mvc\Model\MetaData\Base (abstract)](#class-veincoremvcmodelmetadatabase-abstract)
- [\Vein\Core\Mvc\Model\MetaData\Redis](#class-veincoremvcmodelmetadataredis)
- [\Vein\Core\Mvc\Model\MetaData\Memcache](#class-veincoremvcmodelmetadatamemcache)
- [\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)
- [\Vein\Core\Mvc\Model\Validator\ConfirmationOf](#class-veincoremvcmodelvalidatorconfirmationof)
- [\Vein\Core\Mvc\Module\Service\Crypt](#class-veincoremvcmoduleservicecrypt)
- [\Vein\Core\Mvc\Module\Service\Volt](#class-veincoremvcmoduleservicevolt)
- [\Vein\Core\Mvc\Module\Service\Dispatcher](#class-veincoremvcmoduleservicedispatcher)
- [\Vein\Core\Mvc\Module\Service\Security](#class-veincoremvcmoduleservicesecurity)
- [\Vein\Core\Mvc\Module\Service\View](#class-veincoremvcmoduleserviceview)
- [\Vein\Core\Mvc\Module\Service\AbstractService (abstract)](#class-veincoremvcmoduleserviceabstractservice-abstract)
- [\Vein\Core\Mvc\Module\Service\Acl](#class-veincoremvcmoduleserviceacl)
- [\Vein\Core\Mvc\Module\Service\Viewer](#class-veincoremvcmoduleserviceviewer)
- [\Vein\Core\Mvc\Module\Service\Registry](#class-veincoremvcmoduleserviceregistry)
- [\Vein\Core\Mvc\Module\Service\Auth](#class-veincoremvcmoduleserviceauth)
- [\Vein\Core\Mvc\View\Engine\Smarty](#class-veincoremvcviewenginesmarty)
- [\Vein\Core\Mvc\View\Engine\Mustache](#class-veincoremvcviewenginemustache)
- [\Vein\Core\Mvc\View\Engine\Pug](#class-veincoremvcviewenginepug)
- [\Vein\Core\Mvc\View\Engine\Jade](#class-veincoremvcviewenginejade)

<hr /> 
### Class: \Vein\Core\Mvc\Model

> Class Model

| Visibility | Function |
|:-----------|:---------|
| public | <strong>_skipAttributes(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>[\Vein\Core\Mvc\Model](#class-veincoremvcmodel)</em><br /><em>Sets a list of attributes that must be skipped from the generated INSERT/UPDATE statement *<code> *class Robots extends \Phalcon\Mvc\Model *{ public function initialize() { $this->skipAttributes(array('price')); } *} *</code></em> |
| public static | <strong>find(</strong><em>mixed/	array</em> <strong>$parameters=null</strong>)</strong> : <em>\Phalcon\Mvc\Model\ResultsetInterface</em><br /><em>Allows to query a set of records that match the specified conditions</em> |
| public static | <strong>findByColumn(</strong><em>string</em> <strong>$column</strong>, <em>string/array</em> <strong>$values</strong>)</strong> : <em>\Phalcon\Mvc\Model\ResultsetInterface</em><br /><em>Find records by array of ids</em> |
| public static | <strong>findByIds(</strong><em>string/array</em> <strong>$ids</strong>)</strong> : <em>\Phalcon\Mvc\Model\ResultsetInterface</em><br /><em>Find records by array of ids</em> |
| public | <strong>getAttributes()</strong> : <em>array</em><br /><em>Return model attributes</em> |
| public static | <strong>getConditions()</strong> : <em>mixed</em><br /><em>Return model static conditions</em> |
| public | <strong>getNameExpr()</strong> : <em>string</em><br /><em>Return model field name</em> |
| public | <strong>getOrderAsc()</strong> : <em>string</em><br /><em>Return default order direction</em> |
| public | <strong>getOrderExpr()</strong> : <em>string</em><br /><em>Return default order column</em> |
| public | <strong>getPrimary()</strong> : <em>string</em><br /><em>Return table primary key.</em> |
| public | <strong>getReferenceFields(</strong><em>mixed</em> <strong>$refModel</strong>)</strong> : <em>string</em><br /><em>Find reference rule and return reference fields.</em> |
| public | <strong>getReferenceRelation(</strong><em>string</em> <strong>$refModel</strong>)</strong> : <em>\Phalcon\Mvc\Model\Relation</em><br /><em>Return model relation</em> |
| public | <strong>getRelationFields(</strong><em>mixed</em> <strong>$refModel</strong>)</strong> : <em>string</em><br /><em>Find reference rule and return fields.</em> |
| public | <strong>getRelationPath(</strong><em>string/array</em> <strong>$path</strong>)</strong> : <em>array</em><br /><em>Return models relation path</em> |
| public static | <strong>normalizeConditions(</strong><em>array/string</em> <strong>$conditions</strong>)</strong> : <em>string</em><br /><em>Normalize query conditions</em> |
| public static | <strong>query(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>\Phalcon\Mvc\Model\Criteria</em><br /><em>Create a criteria for a specific model</em> |
| public | <strong>queryBuilder(</strong><em>mixed/string</em> <strong>$alias=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Create a criteria for a especific model</em> |
| protected | <strong>_preSave(</strong><em>\Phalcon\Mvc\Model\MetadataInterface</em> <strong>$metaData</strong>, <em>boolean</em> <strong>$exists</strong>, <em>string</em> <strong>$identityField</strong>)</strong> : <em>boolean</em><br /><em>Fix field value for tinyint(1) types, from integer to string Executes internal hooks before save a record</em> |

*This class extends \Phalcon\Mvc\Model*

*This class implements \Serializable, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\ResultInterface, \Phalcon\Mvc\ModelInterface, \Phalcon\Mvc\EntityInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module (abstract)

> Class Base Module

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>getDefaultModuleDirectory()</strong> : <em>string</em><br /><em>Return default module directory</em> |
| public | <strong>getModuleDirectory()</strong> : <em>string</em><br /><em>Return module directory</em> |
| public | <strong>getModuleName()</strong> : <em>string</em><br /><em>Return module name</em> |
| public | <strong>registerAutoloaders(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Registers an autoloader related to the module</em> |
| public | <strong>registerServices(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>\Phalcon\Events\Manager</em><br /><em>Registers an autoloader related to the module</em> |
| protected | <strong>_checkModuleName()</strong> : <em>void</em><br /><em>Check and normalize module name</em> |
| protected | <strong>_getService(</strong><em>string</em> <strong>$serviceName</strong>)</strong> : <em>string</em><br /><em>Return module service full class name</em> |

*This class implements \Phalcon\Mvc\ModuleDefinitionInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\Query

> Class Query

| Visibility | Function |
|:-----------|:---------|
| public | <strong>execute(</strong><em>mixed/array</em> <strong>$bindParams=null</strong>, <em>mixed/array</em> <strong>$bindTypes=null</strong>)</strong> : <em>mixed</em><br /><em>Executes a parsed PHQL statement</em> |
| protected | <strong>_createKey(</strong><em>mixed</em> <strong>$parameters</strong>)</strong> : <em>void</em><br /><em>Implement a method that returns a string key based on the query parameters</em> |

*This class extends \Phalcon\Mvc\Model\Query*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\QueryInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\Behavior\Blameable

> Phalcon\Mvc\Model\Behavior\Blameable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/array</em> <strong>$options=null</strong>)</strong> : <em>void</em><br /><em>\Phalcon\Mvc\Model\Behavior\Blameable constructor</em> |
| public | <strong>auditAfterCreate(</strong><em>\Phalcon\Mvc\ModelInterface</em> <strong>$model</strong>)</strong> : <em>boolean</em><br /><em>Audits an DELETE operation</em> |
| public | <strong>auditAfterUpdate(</strong><em>\Phalcon\Mvc\ModelInterface</em> <strong>$model</strong>)</strong> : <em>boolean</em><br /><em>Audits an UPDATE operation</em> |
| public | <strong>createAudit(</strong><em>string</em> <strong>$type</strong>, <em>\Phalcon\Mvc\ModelInterface</em> <strong>$model</strong>)</strong> : <em>[\Vein\Core\Mvc\Model](#class-veincoremvcmodel)\Behavior\Audit</em><br /><em>Creates an Audit isntance based on the current enviroment</em> |
| public | <strong>notify(</strong><em>string</em> <strong>$type</strong>, <em>\Phalcon\Mvc\ModelInterface</em> <strong>$model</strong>)</strong> : <em>void</em><br /><em>Receive notifications from the Models Manager</em> |

*This class extends \Phalcon\Mvc\Model\Behavior*

*This class implements \Phalcon\Mvc\Model\BehaviorInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\MetaData\Base (abstract)

> \Phalcon\Mvc\Model\MetaData\Base Base class for \Phalcon\Mvc\Model\MetaData\Memcache and \Phalcon\Mvc\Model\MetaData\Redis adapters.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/null/array</em> <strong>$options=null</strong>)</strong> : <em>void</em><br /><em>Class constructor.</em> |
| public | <strong>read(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>array</em> |
| public | <strong>write(</strong><em>string</em> <strong>$key</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>void</em> |
| protected | <strong>abstract getCacheBackend()</strong> : <em>\Phalcon\Cache\BackendInterface</em><br /><em>Returns cache backend instance.</em> |
| protected | <strong>getId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>string</em><br /><em>Returns the sessionId with prefix</em> |

*This class extends \Phalcon\Mvc\Model\MetaData*

*This class implements \Phalcon\Mvc\Model\MetaDataInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\MetaData\Redis

> \Vein\Core\Mvc\Model\MetaData\Redis Redis adapter for \Phalcon\Mvc\Model\MetaData

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/null/array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| protected | <strong>getCacheBackend()</strong> : <em>\Vein\Core\Cache\Backend\Redis</em> |

*This class extends [\Vein\Core\Mvc\Model\MetaData\Base](#class-veincoremvcmodelmetadatabase-abstract)*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\MetaDataInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\MetaData\Memcache

> \Phalcon\Mvc\Model\MetaData\Memcache Memcache adapter for \Phalcon\Mvc\Model\MetaData

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/null/array</em> <strong>$options=null</strong>)</strong> : <em>void</em> |
| protected | <strong>getCacheBackend()</strong> : <em>\Phalcon\Cache\Backend\Memcache</em> |

*This class extends [\Vein\Core\Mvc\Model\MetaData\Base](#class-veincoremvcmodelmetadatabase-abstract)*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\MetaDataInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\Query\Builder

> Class Builder

| Visibility | Function |
|:-----------|:---------|
| public | <strong>columns(</strong><em>string/array</em> <strong>$columns</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Sets the columns to be queried</em> |
| public | <strong>columnsId(</strong><em>string</em> <strong>$alias=`'id'`</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Include primary key to Query condition.</em> |
| public | <strong>columnsJoinMany(</strong><em>string/array</em> <strong>$path</strong>, <em>mixed/string</em> <strong>$fieldAlias=null</strong>, <em>mixed/string</em> <strong>$tableField=null</strong>, <em>mixed/string</em> <strong>$orderBy=null</strong>, <em>mixed/string</em> <strong>$separator=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Set field to current table by many to many rule path.</em> |
| public | <strong>columnsJoinOne(</strong><em>array/string</em> <strong>$path</strong>, <em>mixed/array/string</em> <strong>$columns=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Check for existing join rules and set join between table.</em> |
| public | <strong>columnsName(</strong><em>string</em> <strong>$alias=`'name'`</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Include column with name alias to Query condition.</em> |
| public | <strong>getAlias()</strong> : <em>string</em><br /><em>Return table alias</em> |
| public | <strong>getCorrelationName(</strong><em>mixed</em> <strong>$col</strong>)</strong> : <em>string</em><br /><em>Return table name by column name</em> |
| public | <strong>getJoinAlias(</strong><em>string/[\Vein\Core\Mvc\Model](#class-veincoremvcmodel)</em> <strong>$model</strong>)</strong> : <em>string</em><br /><em>Return alias from joined table</em> |
| public | <strong>getModel()</strong> : <em>[\Vein\Core\Mvc\Model](#class-veincoremvcmodel)</em><br /><em>Return model object</em> |
| public | <strong>getQuery()</strong> : <em>[\Vein\Core\Mvc\Model\Query](#class-veincoremvcmodelquery)</em><br /><em>Returns the query built</em> |
| public | <strong>joinColumns(</strong><em>array</em> <strong>$columns</strong>, <em>string</em> <strong>$refModel</strong>, <em>string</em> <strong>$alias</strong>)</strong> : <em>void</em><br /><em>Join columns</em> |
| public | <strong>joinPath(</strong><em>array</em> <strong>$joinPath</strong>, <em>mixed</em> <strong>$columns=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Join all models</em> |
| public | <strong>orderNatural(</strong><em>bool</em> <strong>$reverse=false</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Set model default order to query</em> |
| public | <strong>reset(</strong><em>mixed/string</em> <strong>$part=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Clear parts of the Query object, or an individual part.</em> |
| public | <strong>setColumn(</strong><em>string</em> <strong>$column</strong>, <em>mixed/string</em> <strong>$alias=null</strong>, <em>bool/boolean</em> <strong>$useTableAlias=true</strong>, <em>bool/boolean</em> <strong>$useCorrelationName=false</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Set column to query</em> |
| public | <strong>setModel(</strong><em>[\Vein\Core\Mvc\Model](#class-veincoremvcmodel)</em> <strong>$model</strong>, <em>mixed/string</em> <strong>$alias=null</strong>)</strong> : <em>[\Vein\Core\Mvc\Model\Query\Builder](#class-veincoremvcmodelquerybuilder)</em><br /><em>Set model</em> |

*This class extends \Phalcon\Mvc\Model\Query\Builder*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\Query\BuilderInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Model\Validator\ConfirmationOf

> Phalcon\Mvc\Model\Validator\ConfirmationOf Allows to validate if a field has a confirmation field with the same value Don't forget to add confirmation field to be skipped on create and update

| Visibility | Function |
|:-----------|:---------|
| public | <strong>validate(</strong><em>\Phalcon\Mvc\ModelInterface</em> <strong>$record</strong>)</strong> : <em>boolean</em><br /><em>Executes the validator</em> |

*This class extends \Phalcon\Mvc\Model\Validator*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Crypt

> Class Crypt

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes viewer</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Volt

> Class Volt

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes Volt engine</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Dispatcher

> Class Dispatcher

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes dispatcher</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Security

> Class Security

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes viewer</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\View

> Class View

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes Volt engine</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\AbstractService (abstract)

> Class AbstractService

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\Vein\Core\Mvc\Module](#class-veincoremvcmodule-abstract)\Base/[\Vein\Core\Mvc\Module](#class-veincoremvcmodule-abstract)</em> <strong>$module</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager</strong>, <em>\Phalcon\Config</em> <strong>$config</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>getEventsManager()</strong> : <em>\Phalcon\Events\ManagerInterface</em><br /><em>Returns the internal event manager</em> |
| public | <strong>abstract register()</strong> : <em>void</em><br /><em>Service register method</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |
| public | <strong>setEventsManager(</strong><em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>void</em><br /><em>Sets the events manager</em> |

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Acl

> Class Acl

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes acl</em> |
| protected | <strong>_getAclAdapter(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return acl adapter full class name</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Viewer

> Class Viewer

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes viewer</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Registry

> Class Registry

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__get(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>false/mixed</em><br /><em>Get item by key</em> |
| public | <strong>__isset(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Remove item from the regisry</em> |
| public | <strong>__set(</strong><em>string</em> <strong>$key</strong>, <em>mixed</em> <strong>$item</strong>)</strong> : <em>void</em><br /><em>Put item into the registry</em> |
| public | <strong>__unset(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>void</em><br /><em>Remove item from the regisry</em> |
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes viewer</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\Module\Service\Auth

> Class Acl

| Visibility | Function |
|:-----------|:---------|
| public | <strong>register()</strong> : <em>void</em><br /><em>Initializes acl</em> |

*This class extends [\Vein\Core\Mvc\Module\Service\AbstractService](#class-veincoremvcmoduleserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Mvc\View\Engine\Smarty

> Phalcon\Mvc\View\Engine\Smarty Adapter to use Smarty library as templating engine

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Mvc\ViewInterface</em> <strong>$view</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Phalcon\Mvc\View\Engine\Twig constructor</em> |
| public | <strong>render(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$params</strong>, <em>mixed</em> <strong>$mustClean=null</strong>)</strong> : <em>void</em><br /><em>Renders a view</em> |
| public | <strong>setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Set Smarty's options</em> |

*This class extends \Phalcon\Mvc\View\Engine*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\View\EngineInterface*

<hr /> 
### Class: \Vein\Core\Mvc\View\Engine\Mustache

> Phalcon\Mvc\View\Engine\Mustache Adapter to use Mustache library as templating engine

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Mvc\ViewInterface</em> <strong>$view</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Phalcon\Mvc\View\Engine\Mustache constructor</em> |
| public | <strong>render(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$params</strong>, <em>bool</em> <strong>$mustClean=false</strong>)</strong> : <em>void</em><br /><em>Renders a view</em> |

*This class extends \Phalcon\Mvc\View\Engine*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\View\EngineInterface*

<hr /> 
### Class: \Vein\Core\Mvc\View\Engine\Pug

> Jade Adapter to use Pug library as templating engine

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Mvc\View</em> <strong>$view</strong>, <em>\Phalcon\DI</em> <strong>$di</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>void</em><br /><em>Adapter constructor</em> |
| public | <strong>render(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$params</strong>, <em>bool</em> <strong>$mustClean=false</strong>)</strong> : <em>void</em><br /><em>Renders a view using the template engine</em> |

*This class extends \Phalcon\Mvc\View\Engine*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\View\EngineInterface*

<hr /> 
### Class: \Vein\Core\Mvc\View\Engine\Jade

> Jade Adapter to use Jade library as templating engine

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Mvc\View</em> <strong>$view</strong>, <em>\Phalcon\DI</em> <strong>$di</strong>, <em>array</em> <strong>$options=array()</strong>)</strong> : <em>void</em><br /><em>Adapter constructor</em> |
| public | <strong>render(</strong><em>string</em> <strong>$path</strong>, <em>array</em> <strong>$params</strong>, <em>bool</em> <strong>$mustClean=false</strong>)</strong> : <em>void</em><br /><em>Renders a view using the template engine</em> |

*This class extends \Phalcon\Mvc\View\Engine*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\View\EngineInterface*

