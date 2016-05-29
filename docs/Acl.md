## Table of contents

- [\Vein\Core\Acl\ViewerInterface (interface)](#interface-veincoreaclviewerinterface)
- [\Vein\Core\Acl\Dispatcher](#class-veincoreacldispatcher)
- [\Vein\Core\Acl\AuthModelInterface (interface)](#interface-veincoreaclauthmodelinterface)
- [\Vein\Core\Acl\Service](#class-veincoreaclservice)
- [\Vein\Core\Acl\Authorizer](#class-veincoreaclauthorizer)
- [\Vein\Core\Acl\Viewer](#class-veincoreaclviewer)
- [\Vein\Core\Acl\Adapter\Database](#class-veincoreacladapterdatabase)

<hr /> 
### Interface: \Vein\Core\Acl\ViewerInterface

> Interface ViewerInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getRole()</strong> : <em>string</em><br /><em>Retuirn role name</em> |

<hr /> 
### Class: \Vein\Core\Acl\Dispatcher

> Class Dispatcher

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em> |
| public | <strong>beforeDispatch(</strong><em>\Phalcon\Events\Event</em> <strong>$event</strong>, <em>\Phalcon\Mvc\Dispatcher</em> <strong>$dispatcher</strong>)</strong> : <em>void</em><br /><em>This action is executed before execute any action in the application</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |

<hr /> 
### Interface: \Vein\Core\Acl\AuthModelInterface

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>findByCredentials(</strong><em>array</em> <strong>$credentials</strong>)</strong> : <em>\Vein\Core\Mvc\Model</em><br /><em>Return user by auth credentials</em> |
| public static | <strong>findUserById(</strong><em>integer</em> <strong>$id</strong>)</strong> : <em>\Vein\Core\Mvc\Model</em><br /><em>Return user by id</em> |
| public | <strong>getId()</strong> : <em>string</em><br /><em>Return user id</em> |
| public | <strong>getLoginCredential()</strong> : <em>string</em><br /><em>Return login credential</em> |
| public | <strong>getPasswordCredential()</strong> : <em>string</em><br /><em>Return password credential</em> |
| public | <strong>getRole()</strong> : <em>string</em><br /><em>Return user role</em> |

<hr /> 
### Class: \Vein\Core\Acl\Service

> Class Service

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em> |
| public | <strong>clearAcl()</strong> : <em>void</em><br /><em>Clear acl cache. The acl will be rewrited.</em> |
| public | <strong>getAdapter()</strong> : <em>\Phalcon\Acl\Adapter\Memory</em><br /><em>Get acl system</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>getObjectAcl(</strong><em>mixed</em> <strong>$objectName</strong>)</strong> : <em>null/\stdClass</em><br /><em>Parse object annotations for find acl rules</em> |
| public | <strong>getResource(</strong><em>string</em> <strong>$moduleName</strong>, <em>string</em> <strong>$controllerName</strong>)</strong> : <em>string</em><br /><em>Return resource name</em> |
| public | <strong>isAllowed(</strong><em>string</em> <strong>$role</strong>, <em>string</em> <strong>$moduleName</strong>, <em>string</em> <strong>$controllerName</strong>, <em>string</em> <strong>$actionName</strong>, <em>bool</em> <strong>$checkResource=false</strong>)</strong> : <em>bool</em><br /><em>Check access by role and mvc module, controller and action names</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |

*This class implements \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Acl\Authorizer

> Class Dispatcher

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>authUserById(</strong><em>mixed</em> <strong>$userId</strong>)</strong> : <em>boolean</em><br /><em>Auths the user by his/her id</em> |
| public | <strong>check(</strong><em>array</em> <strong>$credentials</strong>)</strong> : <em>bool</em><br /><em>Checks the user credentials</em> |
| public | <strong>checkRememberMe(</strong><em>mixed</em> <strong>$crypt</strong>)</strong> : <em>boolean</em><br /><em>Check remember me value</em> |
| public | <strong>checkUserFlags(</strong><em>[\Vein\Core\Acl\AuthModelInterface](#interface-veincoreaclauthmodelinterface)</em> <strong>$user</strong>)</strong> : <em>void</em><br /><em>Checks if the user is banned/inactive/suspended</em> |
| public | <strong>createRememberEnviroment(</strong><em>[\Vein\Core\Acl\AuthModelInterface](#interface-veincoreaclauthmodelinterface)</em> <strong>$authModel</strong>)</strong> : <em>mixed</em><br /><em>Creates the remember me environment settings the related cookies and generating tokens</em> |
| public | <strong>getMessage()</strong> : <em>string</em><br /><em>Return error message</em> |
| public | <strong>getUser()</strong> : <em>\Vein\Core\Mvc\Model</em><br /><em>Get the entity related to user in the active identity</em> |
| public | <strong>hasRememberMe()</strong> : <em>boolean</em><br /><em>Check if the session has a remember me cookie</em> |
| public | <strong>isAuth()</strong> : <em>bool</em><br /><em>Is user authenticate</em> |
| public | <strong>loginWithRememberMe()</strong> : <em>boolean</em><br /><em>Logs on using the information in the coookies</em> |
| public | <strong>remove()</strong> : <em>boolean</em><br /><em>Removes the user identity information from session</em> |

*This class extends \Phalcon\Mvc\User\Component*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Acl\Viewer

> Class Viewer

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em> |
| public | <strong>getId()</strong> : <em>string</em><br /><em>Return viewer id</em> |
| public | <strong>getRole()</strong> : <em>string</em><br /><em>Return viewer role name</em> |
| public | <strong>setId(</strong><em>int</em> <strong>$id</strong>)</strong> : <em>void</em><br /><em>Set viewer id</em> |
| public | <strong>setRole(</strong><em>string</em> <strong>$role</strong>)</strong> : <em>void</em><br /><em>Set acl role name</em> |

*This class extends \Phalcon\Session\Bag*

*This class implements \Countable, \ArrayAccess, \Traversable, \IteratorAggregate, \Phalcon\Session\BagInterface, \Phalcon\Di\InjectionAwareInterface*

<hr /> 
### Class: \Vein\Core\Acl\Adapter\Database

> Class AbstractService

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$options</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector</strong>)</strong> : <em>void</em><br /><em>Vein\Core\Acl\Adapter\Database</em> |
| public | <strong>addInherit(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$roleToInherit</strong>)</strong> : <em>void</em><br /><em>Do a role inherit from another existing role</em> |
| public | <strong>addResource(</strong><em>\Phalcon\Acl\Resource</em> <strong>$resource</strong>, <em>mixed</em> <strong>$accessList=null</strong>)</strong> : <em>boolean</em><br /><em>Adds a resource to the ACL list Access names can be a particular action, by example search, update, delete, etc or a list of them Example: <code> //Add a resource to the the list allowing access to an action $acl->addResource(new Phalcon\Acl\Resource('customers'), 'search'); $acl->addResource('customers', 'search'); //Add a resource  with an access list $acl->addResource(new Phalcon\Acl\Resource('customers'), ['create', 'search')); $acl->addResource('customers', ['create', 'search')); </code></em> |
| public | <strong>addResourceAccess(</strong><em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$accessList</strong>)</strong> : <em>void</em><br /><em>Adds access to resources</em> |
| public | <strong>addRole(</strong><em>string</em> <strong>$role</strong>, <em>mixed/array</em> <strong>$accessInherits=null</strong>)</strong> : <em>boolean</em><br /><em>Adds a role to the ACL list. Second parameter lets to inherit access data from other existing role Example: <code>$acl->addRole(new Phalcon\Acl\Role('administrator'), 'consultor');</code> <code>$acl->addRole('administrator', 'consultor');</code></em> |
| public | <strong>allow(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$access</strong>, <em>mixed</em> <strong>$func=null</strong>)</strong> : <em>void</em><br /><em>Allow access to a role on a resource You can use '*' as wildcard Ej: <code> //Allow access to guests to search on customers $acl->allow('guests', 'customers', 'search'); //Allow access to guests to search or create on customers $acl->allow('guests', 'customers', ['search', 'create')); //Allow access to any role to browse on products $acl->allow('*', 'products', 'browse'); //Allow access to any role to browse on any resource $acl->allow('*', '*', 'browse'); </code></em> |
| public | <strong>deny(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$access</strong>, <em>mixed</em> <strong>$func=null</strong>)</strong> : <em>boolean</em><br /><em>Deny access to a role on a resource You can use '*' as wildcard Ej: <code> //Deny access to guests to search on customers $acl->deny('guests', 'customers', 'search'); //Deny access to guests to search or create on customers $acl->deny('guests', 'customers', ['search', 'create')); //Deny access to any role to browse on products $acl->deny('*', 'products', 'browse'); //Deny access to any role to browse on any resource $acl->deny('*', '*', 'browse'); </code></em> |
| public | <strong>dropResourceAccess(</strong><em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$accessList</strong>)</strong> : <em>void</em><br /><em>Removes an access from a resource</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>getNoArgumentsDefaultAction()</strong> : <em>mixed</em> |
| public | <strong>getResourceAccesses(</strong><em>mixed</em> <strong>$resource</strong>)</strong> : <em>\Phalcon\Acl\Resource[]</em><br /><em>Returns resource accesses</em> |
| public | <strong>getResources()</strong> : <em>array</em><br /><em>Returns all resources in the access list</em> |
| public | <strong>getRoles()</strong> : <em>\Phalcon\Acl\Role[]</em><br /><em>Returns all resources in the access list</em> |
| public | <strong>isAllowed(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$access</strong>, <em>array</em> <strong>$parameters=null</strong>)</strong> : <em>boolean</em><br /><em>Check whether a role is allowed to access an action from a resource <code> //Does Andres have access to the customers resource to create? $acl->isAllowed('Andres', 'Products', 'create'); //Do guests have access to any resource to edit? $acl->isAllowed('guests', '*', 'edit'); </code></em> |
| public | <strong>isResource(</strong><em>string</em> <strong>$resourceName</strong>)</strong> : <em>boolean</em><br /><em>Check whether resource exist in the resources list</em> |
| public | <strong>isRole(</strong><em>string</em> <strong>$roleName</strong>)</strong> : <em>boolean</em><br /><em>Check whether role exist in the roles list</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |
| public | <strong>setNoArgumentsDefaultAction(</strong><em>mixed</em> <strong>$defaultAccess</strong>)</strong> : <em>void</em> |
| protected | <strong>_allowOrDeny(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$resourceName</strong>, <em>int</em> <strong>$access</strong>, <em>mixed</em> <strong>$action</strong>, <em>mixed</em> <strong>$func=null</strong>)</strong> : <em>boolean</em><br /><em>Inserts/Updates a permission in the access list</em> |
| protected | <strong>_insertOrUpdateAccess(</strong><em>string</em> <strong>$roleName</strong>, <em>string</em> <strong>$resourceName</strong>, <em>mixed</em> <strong>$accessName</strong>, <em>mixed</em> <strong>$action</strong>)</strong> : <em>boolean</em><br /><em>Inserts/Updates a permission in the access list</em> |

*This class extends \Phalcon\Acl\Adapter*

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Acl\AdapterInterface*

