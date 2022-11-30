# Raudius\Luar\Interpreter\LuarObject\Table  

This class represents the Lua table type inside the Luar interpreter.

## Implements:
Raudius\Luar\Interpreter\LuarObject\LuarObject, JsonSerializable, Stringable

## Extend:

Raudius\Luar\Interpreter\Scope

## Methods

| Name | Description |
|------|-------------|
|[__toString](#table__tostring)||
|[fromArray](#tablefromarray)|Table instantiation from a PHP array.|
|[getLength](#tablegetlength)|Returns the length of the table. This is the length as defined by Lua: https://www.lua.org/manual/5.3/manual.html#3.4.7|
|[getMetaTable](#tablegetmetatable)|Returns the meta table for this table. If none, returns a `nil` literal `LuaObject` See: https://www.lua.org/manual/5.3/manual.html#pdf-getmetatable|
|[getType](#tablegettype)||
|[getValue](#tablegetvalue)||
|[jsonSerialize](#tablejsonserialize)|Converts the table to a JSON-serializable array.|
|[next](#tablenext)|Returns the value that comes after the specified key. If key is NULL, the first value is returned.|
|[setMetaTable](#tablesetmetatable)|Sets the meta-table for this object.|

## Inherited methods

| Name | Description |
|------|-------------|
| [__construct](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.__construct.php) | - |
| [__debugInfo](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.__debuginfo.php) | - |
| [assign](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.assign.php) | - |
| [get](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.get.php) | - |
| [getAssigns](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.getassigns.php) | - |
| [getExit](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.getexit.php) | - |
| [getParent](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.getparent.php) | - |
| [getReturn](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.getreturn.php) | - |
| [getScope](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.getscope.php) | - |
| [has](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.has.php) | - |
| [isRoot](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.isroot.php) | - |
| [remove](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.remove.php) | - |
| [resetExit](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.resetexit.php) | - |
| [setExit](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.setexit.php) | - |
| [setExpectedExit](https://secure.php.net/manual/en/raudius\luar\interpreter\scope.setexpectedexit.php) | - |



### Table::__toString  

**Description**

```php
 __toString (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Table::fromArray  

**Description**

```php
public static fromArray (array $array)
```

Table instantiation from a PHP array. 

 

**Parameters**

* `(array) $array`

**Return Values**

`static`




<hr />


### Table::getLength  

**Description**

```php
public getLength (void)
```

Returns the length of the table. This is the length as defined by Lua: https://www.lua.org/manual/5.3/manual.html#3.4.7 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`int`




<hr />


### Table::getMetaTable  

**Description**

```php
public getMetaTable (void)
```

Returns the meta table for this table. If none, returns a `nil` literal `LuaObject` See: https://www.lua.org/manual/5.3/manual.html#pdf-getmetatable 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\LuarObject`




<hr />


### Table::getType  

**Description**

```php
 getType (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Table::getValue  

**Description**

```php
 getValue (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Table::jsonSerialize  

**Description**

```php
public jsonSerialize (void)
```

Converts the table to a JSON-serializable array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`




<hr />


### Table::next  

**Description**

```php
public next (void)
```

Returns the value that comes after the specified key. If key is NULL, the first value is returned. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\LuarObject[]`

> [key, value]


<hr />


### Table::setMetaTable  

**Description**

```php
public setMetaTable (\Table|null $table)
```

Sets the meta-table for this object. 

See Lua documentation for more information on meta-tables.  
https://www.lua.org/manual/5.3/manual.html#pdf-setmetatable 

**Parameters**

* `(\Table|null) $table`

**Return Values**

`void`




<hr />

