# Raudius\Luar\Interpreter\LuarObject\ObjectList  



## Implements:
Raudius\Luar\Interpreter\LuarObject\LuarObject, Stringable



## Methods

| Name | Description |
|------|-------------|
|[__construct](#objectlist__construct)||
|[__toString](#objectlist__tostring)||
|[count](#objectlistcount)||
|[getObject](#objectlistgetobject)||
|[getObjects](#objectlistgetobjects)||
|[getRawObject](#objectlistgetrawobject)|Returns the "raw" object at the specified index.|
|[getType](#objectlistgettype)||
|[getValue](#objectlistgetvalue)|*|
|[slice](#objectlistslice)|Slices the list, returning a sub-list.|




### ObjectList::__construct  

**Description**

```php
 __construct (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::__toString  

**Description**

```php
 __toString (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::count  

**Description**

```php
 count (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::getObject  

**Description**

```php
 getObject (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::getObjects  

**Description**

```php
 getObjects (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::getRawObject  

**Description**

```php
public getRawObject (int $idx)
```

Returns the "raw" object at the specified index. 

Raw object means that other ObjectLists contained in the ObjectList do not get expanded/flattened.  
  
Example:  
```lua  
function foo(...)  
  return ..., 'foo', 'bar', ...  
end  
  
print(foo(1,2,3))  
```  
In this example the raw objects would be:  
[ `0`=> `ObjectList<1,2,3>`, `1`=> `'foo'`, `3`=> `'bar'`, `4`=> `ObjectList<1,2,3>` ]  
  
While the expanded objets would correspond with the value printed by the snippet:  
[ `0`=> `1`, `1`=> `'foo'`, `3`=> `'bar'`, `4`=> `1`, `5`=> `2`, `6`=> `3` ] 

**Parameters**

* `(int) $idx`

**Return Values**

`\LuarObject`




<hr />


### ObjectList::getType  

**Description**

```php
 getType (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::getValue  

**Description**

```php
public getValue (void)
```

* 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`void`


<hr />


### ObjectList::slice  

**Description**

```php
public slice (int $idx, int|null $size)
```

Slices the list, returning a sub-list. 

 

**Parameters**

* `(int) $idx`
: - Index where we want the sublist to start  
* `(int|null) $size`
: - Size of the subindex (if null, will return all the items following the starting index)  

**Return Values**

`\ObjectList`




<hr />

