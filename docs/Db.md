## Table of contents

- [\Vein\Core\Db\Adapter\Cacheable\Mysql](#class-veincoredbadaptercacheablemysql)
- [\Vein\Core\Db\Result\Serializable](#class-veincoredbresultserializable)

<hr /> 
### Class: \Vein\Core\Db\Adapter\Cacheable\Mysql

> Phalcon\Adapter\Cacheable\Mysql Every query executed via this adapter is automatically cached

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$descriptor</strong>)</strong> : <em>void</em><br /><em>The constructor avoids the automatic connection</em> |
| public | <strong>execute(</strong><em>string</em> <strong>$sqlStatement</strong>, <em>mixed/array</em> <strong>$bindParams=null</strong>, <em>mixed/array</em> <strong>$bindTypes=null</strong>)</strong> : <em>boolean</em><br /><em>Executes the SQL statement without caching</em> |
| public | <strong>query(</strong><em>string</em> <strong>$sqlStatement</strong>, <em>mixed/array</em> <strong>$bindParams=null</strong>, <em>mixed/array</em> <strong>$bindTypes=null</strong>)</strong> : <em>[\Vein\Core\Db\Result\Serializable](#class-veincoredbresultserializable)</em><br /><em>The queries executed are stored in the cache</em> |
| public | <strong>setCache(</strong><em>\Phalcon\Cache\BackendInterface</em> <strong>$cache</strong>)</strong> : <em>void</em><br /><em>Sets a handler to cache the data</em> |
| public | <strong>tableExists(</strong><em>string</em> <strong>$tableName</strong>, <em>mixed/string</em> <strong>$schemaName=null</strong>)</strong> : <em>boolean</em><br /><em>Checks if a table exists</em> |
| protected | <strong>_connect()</strong> : <em>void</em><br /><em>Checks if exist an active connection, if not, makes a connection</em> |

*This class extends \Phalcon\Db\Adapter\Pdo\Mysql*

*This class implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Db\Result\Serializable

> Vein\Core\Adapter\Result\Serializable Fetches all the data in a result providing a serializable resultset

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em><br /><em>The resultset is completely fetched</em> |
| public | <strong>__wakeup()</strong> : <em>void</em><br /><em>Resets the internal pointer</em> |
| public | <strong>fetch()</strong> : <em>array/boolean</em><br /><em>Fetches a row in the resultset</em> |
| public | <strong>fetchAll()</strong> : <em>array</em><br /><em>Returns the full data in the resultset</em> |
| public | <strong>numRows()</strong> : <em>int</em><br /><em>Returns the number of rows in the internal array</em> |
| public | <strong>setFetchMode(</strong><em>int</em> <strong>$fetchMode</strong>)</strong> : <em>void</em><br /><em>Changes the fetch mode, this is not implemented yet</em> |

