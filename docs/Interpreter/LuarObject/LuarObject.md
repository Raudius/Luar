# Raudius\Luar\Interpreter\LuarObject\LuarObject  

Luar-objects are how variables and expression results are stored in the Luar interpreter.

Variables assigned via `Luar::assign` are also converted to `LuarObjects`.

PHP values may be converted to and from `LuarObjects` via `Luar::packLuarObject` and `Luar::unpackLuarObject`.  





## Methods

| Name | Description |
|------|-------------|
|[getType](#luarobjectgettype)|Returns the type of the object.|
|[getValue](#luarobjectgetvalue)|Returns the value held by the object.|




### LuarObject::getType  

**Description**

```php
public getType (void)
```

Returns the type of the object. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />


### LuarObject::getValue  

**Description**

```php
public getValue (void)
```

Returns the value held by the object. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`mixed`




<hr />

