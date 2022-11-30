# Raudius\Luar\Interpreter\LuarObject\Literal  

The literal is the most basic Luar object, it is used for encapsulating "primitive" values such as strings, booleans, numbers and `NULL`.

May be used for encapsulating other types (such as objects) but this use is generally not encouraged. Instead, consider serializing your object as a `Table`.  

## Implements:
Raudius\Luar\Interpreter\LuarObject\LuarObject, Stringable



## Methods

| Name | Description |
|------|-------------|
|[__construct](#literal__construct)||
|[__toString](#literal__tostring)||
|[getType](#literalgettype)||
|[getValue](#literalgetvalue)|Always returns the value as provided in the constructor.|




### Literal::__construct  

**Description**

```php
 __construct (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Literal::__toString  

**Description**

```php
 __toString (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Literal::getType  

**Description**

```php
 getType (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Literal::getValue  

**Description**

```php
public getValue (void)
```

Always returns the value as provided in the constructor. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`mixed`




<hr />

