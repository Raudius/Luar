# Raudius\Luar\Interpreter\LuarObject\Invokable  

This type of `LuarObject` is how Lua functions are stored during runtime. It is also used for defining functions aheead of runtime via a `Library` or via `Luar->assign`.

- `Invokable::fromPhpCallbale()`, is the most convenient way to instantiate this class, as you can simply write the function as you would in PHP.
- `new Invokable()`, requires understanding how `ObjectList` operates, but offers more direct access to the underlying `LuarObjects` passed in the parameters.  

## Implements:
Raudius\Luar\Interpreter\LuarObject\LuarObject, Stringable



## Methods

| Name | Description |
|------|-------------|
|[__construct](#invokable__construct)|The function must expect a single argument of type `ObjectList`|
|[__toString](#invokable__tostring)||
|[fromPhpCallable](#invokablefromphpcallable)|Creates an `Invokable` from a PHP function|
|[getType](#invokablegettype)||
|[getValue](#invokablegetvalue)||
|[invoke](#invokableinvoke)|Calls the function.|




### Invokable::__construct  

**Description**

```php
public __construct (callable $function)
```

The function must expect a single argument of type `ObjectList` 

 

**Parameters**

* `(callable) $function`

**Return Values**

`void`


<hr />


### Invokable::__toString  

**Description**

```php
 __toString (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Invokable::fromPhpCallable  

**Description**

```php
public static fromPhpCallable (callable $callable)
```

Creates an `Invokable` from a PHP function 

```php  
$add = Invokable::fromPhpCallable(function ($a, $b) {  
  return $a + $b;  
});  
``` 

**Parameters**

* `(callable) $callable`

**Return Values**

`\Invokable`




<hr />


### Invokable::getType  

**Description**

```php
 getType (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Invokable::getValue  

**Description**

```php
 getValue (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Invokable::invoke  

**Description**

```php
public invoke (\ObjectList $args)
```

Calls the function. 

You generally should not need to do call this function directly. 

**Parameters**

* `(\ObjectList) $args`

**Return Values**

`\ObjectList`




<hr />

