# Raudius\Luar\Library\Library  

This abstract class can be extended to define a "library" of functions which can be injected into a Luar instance, via `Luar->addLibrary()` or `Luar->addCoreLibrary()`.

Libraries are currently the only way to set meta methods to non-table types in Luar, via `getMetaMethods()`.

You can find some implementations in [Luar/tree/main/src/Library](https://github.com/Raudius/Luar/tree/main/src/Library)  





## Methods

| Name | Description |
|------|-------------|
|[__call](#library__call)|Helper magic-methods can be useful in `getFunctions()` for generating placeholder code.|
|[getFunctions](#librarygetfunctions)|Returns an array of `Invokable` functions to be assigned to the global scope. The names of the arguments are defined via the keys.|
|[getMetaMethods](#librarygetmetamethods)|Returns an array of arrays of `Invokable` functions, to be set as meta-methods.|
|[getName](#librarygetname)|Determines how the functions will be accessed.|




### Library::__call  

**Description**

```php
public __call (void)
```

Helper magic-methods can be useful in `getFunctions()` for generating placeholder code. 

Functions generated via this method will always raise an error in runtime:  
> `Unimplemented function in '<function-name>' library: '<lib-name>'` 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### Library::getFunctions  

**Description**

```php
public getFunctions (void)
```

Returns an array of `Invokable` functions to be assigned to the global scope. The names of the arguments are defined via the keys. 

Example:  
```php  
public function getFunctions(): array {  
  returns [  
    'foo' => $this->foo(),  
    'bar' => new Invokable(function (ObjectList $ol) { ... }),  
    'test' => Invokable::fromPhpCallable(function($arg1, $arg2, $arg3) { ... }),  
  ];  
}  
``` 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Invokable[]`




<hr />


### Library::getMetaMethods  

**Description**

```php
public getMetaMethods (void)
```

Returns an array of arrays of `Invokable` functions, to be set as meta-methods. 

The type for which the meta-methods should be defined is determined by the key.  
  
Example:  
```php  
[  
  'string' => [  
    'isFoo' => Invokable::fromPhpCallable(function ($string) {  
      return $string === 'foo';  
    })  
  ]  
]  
```  
  
This example creates the `isFoo` meta-method for the `string` type.  
```lua  
local str1 = 'foo'  
local str2 = 'bar'  
  
print(str1::isFoo()) -- true  
print(str2::isFoo()) -- false  
``` 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`




<hr />


### Library::getName  

**Description**

```php
public getName (void)
```

Determines how the functions will be accessed. 

For example if we have a library with the name `alice` and a function `do()` the function will be accessible via `alice.do()` 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`




<hr />

