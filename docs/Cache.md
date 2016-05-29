## Table of contents

- [\Vein\Core\Cache\Dummy](#class-veincorecachedummy)
- [\Vein\Core\Cache\Backend\Libmemcached](#class-veincorecachebackendlibmemcached)
- [\Vein\Core\Cache\Backend\Redis](#class-veincorecachebackendredis)
- [\Vein\Core\Cache\Backend\Memcache](#class-veincorecachebackendmemcache)

<hr /> 
### Class: \Vein\Core\Cache\Dummy

> Class Dummy

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Cache\FrontendInterface</em> <strong>$frontend</strong>, <em>mixed/array</em> <strong>$options=null</strong>)</strong> : <em>void</em><br /><em>\Phalcon\Cache\Backend constructor</em> |
| public | <strong>delete(</strong><em>int/string</em> <strong>$keyName</strong>)</strong> : <em>boolean</em><br /><em>Deletes a value from the cache by its key</em> |
| public | <strong>exists(</strong><em>mixed/string</em> <strong>$keyName=null</strong>, <em>\Vein\Core\Cache\long</em> <strong>$lifetime=null</strong>)</strong> : <em>boolean</em><br /><em>Checks if cache exists and it hasn't expired</em> |
| public | <strong>flush()</strong> : <em>boolean</em><br /><em>Immediately invalidates all existing items.</em> |
| public | <strong>get(</strong><em>int/string</em> <strong>$keyName</strong>, <em>\Vein\Core\Cache\long</em> <strong>$lifetime=null</strong>)</strong> : <em>mixed</em><br /><em>Returns a cached content</em> |
| public | <strong>getFrontend()</strong> : <em>mixed</em><br /><em>Returns front-end instance adapter related to the back-end</em> |
| public | <strong>getLastKey()</strong> : <em>string</em><br /><em>Gets the last key stored by the cache</em> |
| public | <strong>getOptions()</strong> : <em>array</em><br /><em>Returns the backend options</em> |
| public | <strong>isFresh()</strong> : <em>boolean</em><br /><em>Checks whether the last cache is fresh or cached</em> |
| public | <strong>isStarted()</strong> : <em>boolean</em><br /><em>Checks whether the cache has starting buffering or not</em> |
| public | <strong>queryKeys(</strong><em>mixed/string</em> <strong>$prefix=null</strong>)</strong> : <em>array</em><br /><em>Query the existing cached keys</em> |
| public | <strong>save(</strong><em>mixed/int/string</em> <strong>$keyName=null</strong>, <em>mixed/string</em> <strong>$content=null</strong>, <em>\Vein\Core\Cache\long</em> <strong>$lifetime=null</strong>, <em>mixed/bool</em> <strong>$stopBuffer=null</strong>)</strong> : <em>void</em><br /><em>Stores cached content into the file backend and stops the frontend</em> |
| public | <strong>setLastKey(</strong><em>string</em> <strong>$lastKey</strong>)</strong> : <em>void</em><br /><em>Sets the last key used in the cache</em> |
| public | <strong>start(</strong><em>int/string</em> <strong>$keyName</strong>, <em>\Vein\Core\Cache\long</em> <strong>$lifetime=null</strong>)</strong> : <em>mixed</em><br /><em>Starts a cache. The $keyname allows to identify the created fragment</em> |
| public | <strong>stop(</strong><em>mixed/bool</em> <strong>$stopBuffer=null</strong>)</strong> : <em>void</em><br /><em>Stops the frontend without store any cached content</em> |

*This class extends \Phalcon\Cache\Backend*

<hr /> 
### Class: \Vein\Core\Cache\Backend\Libmemcached

> Libmemcached This backend uses memcached as cache backend

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$var</strong>, <em>bool</em> <strong>$flag</strong>, <em>integer</em> <strong>$expire</strong>)</strong> : <em>bool</em><br /><em>Add an item to the memcache server</em> |

*This class extends \Phalcon\Cache\Backend\Libmemcached*

*This class implements \Phalcon\Cache\BackendInterface*

<hr /> 
### Class: \Vein\Core\Cache\Backend\Redis

> \Vein\Core\Cache\Backend\Redis This backend uses redis as cache backend

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Phalcon\Cache\FrontendInterface</em> <strong>$frontend</strong>, <em>mixed/array</em> <strong>$options=null</strong>)</strong> : <em>void</em><br /><em>[\Vein\Core\Cache\Backend\Redis](#class-veincorecachebackendredis) constructor</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$keyName</strong>)</strong> : <em>boolean</em><br /><em>Deletes a value from the cache by its key</em> |
| public | <strong>exists(</strong><em>mixed/string</em> <strong>$keyName=null</strong>, <em>mixed/string</em> <strong>$lifetime=null</strong>)</strong> : <em>boolean</em><br /><em>Checks if a value exists in the cache by checking its key.</em> |
| public | <strong>flush()</strong> : <em>void</em> |
| public | <strong>get(</strong><em>string</em> <strong>$keyName</strong>, <em>mixed/int</em> <strong>$lifetime=null</strong>)</strong> : <em>mixed/null</em><br /><em>Get cached content from the Redis backend</em> |
| public | <strong>queryKeys(</strong><em>mixed/string</em> <strong>$prefix=null</strong>)</strong> : <em>array</em><br /><em>Query the existing cached keys</em> |
| public | <strong>save(</strong><em>mixed/string</em> <strong>$keyName=null</strong>, <em>mixed/string</em> <strong>$content=null</strong>, <em>mixed/int</em> <strong>$lifetime=null</strong>, <em>bool</em> <strong>$stopBuffer=true</strong>)</strong> : <em>void</em><br /><em>Stores cached content into the Redis backend and stops the frontend</em> |

*This class extends \Phalcon\Cache\Backend*

*This class implements \Phalcon\Cache\BackendInterface*

<hr /> 
### Class: \Vein\Core\Cache\Backend\Memcache

> Memcache This backend uses memcache as cache backend

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$var</strong>, <em>bool</em> <strong>$flag</strong>, <em>integer</em> <strong>$expire</strong>)</strong> : <em>bool</em><br /><em>Add an item to the memcache server</em> |

*This class extends \Phalcon\Cache\Backend\Memcache*

*This class implements \Phalcon\Cache\BackendInterface*

