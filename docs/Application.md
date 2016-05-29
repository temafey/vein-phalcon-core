## Table of contents

- [\Vein\Core\Application\Cli (abstract)](#class-veincoreapplicationcli-abstract)
- [\Vein\Core\Application\Service\Logger](#class-veincoreapplicationservicelogger)
- [\Vein\Core\Application\Service\Environment](#class-veincoreapplicationserviceenvironment)
- [\Vein\Core\Application\Service\Router](#class-veincoreapplicationservicerouter)
- [\Vein\Core\Application\Service\Cache](#class-veincoreapplicationservicecache)
- [\Vein\Core\Application\Service\Flash](#class-veincoreapplicationserviceflash)
- [\Vein\Core\Application\Service\Url](#class-veincoreapplicationserviceurl)
- [\Vein\Core\Application\Service\Loader](#class-veincoreapplicationserviceloader)
- [\Vein\Core\Application\Service\Annotations](#class-veincoreapplicationserviceannotations)
- [\Vein\Core\Application\Service\Session](#class-veincoreapplicationservicesession)
- [\Vein\Core\Application\Service\Database](#class-veincoreapplicationservicedatabase)
- [\Vein\Core\Application\Service\AbstractService (abstract)](#class-veincoreapplicationserviceabstractservice-abstract)

<hr /> 
### Class: \Vein\Core\Application\Cli (abstract)

> Class Cli

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>clearCache()</strong> : <em>void</em><br /><em>Clear application cache</em> |
| public | <strong>getOutput()</strong> : <em>string</em><br /><em>Return string content</em> |
| public | <strong>run()</strong> : <em>void</em><br /><em>Runs the application, performing all initializations</em> |

*This class extends \Phalcon\Cli\Console*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Logger

> Class the logger

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the logger</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Environment

> Class Environment

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the environment</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Router

> Class Router

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes router system</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Cache

> Class Cache

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clearCache()</strong> : <em>void</em><br /><em>Clear application cache</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the cache</em> |
| protected | <strong>_getBackendCacheAdapter(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return backend cache adapter full class name</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Flash

> Class Flash

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the flash messages</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Url

> Class Url

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the baseUrl</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Loader

> Class Loader

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the loader</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Annotations

> Class Annotations

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes Annotations system</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Session

> Class Session

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the session</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\Database

> Class Database

| Visibility | Function |
|:-----------|:---------|
| public | <strong>init()</strong> : <em>void</em><br /><em>Initializes the database and metadata adapter</em> |
| protected | <strong>_getDatabaseAdapter(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return database adapter full class name</em> |
| protected | <strong>_getMetaDataAdapter(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return metadata adapter full class name</em> |

*This class extends [\Vein\Core\Application\Service\AbstractService](#class-veincoreapplicationserviceabstractservice-abstract)*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Application\Service\AbstractService (abstract)

> Class AbstractService

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager</strong>, <em>\Phalcon\Config</em> <strong>$config</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>getEventsManager()</strong> : <em>\Phalcon\Events\ManagerInterface</em><br /><em>Returns the internal event manager</em> |
| public | <strong>abstract init()</strong> : <em>void</em><br /><em>Service init method</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |
| public | <strong>setEventsManager(</strong><em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>void</em><br /><em>Sets the events manager</em> |

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

