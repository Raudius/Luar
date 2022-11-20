# Luar

Luar is an interpreter for embedding Lua into PHP applications.

Luar implements a reduced version of Lua which also packages some essential Lua libraries. As such Luar offers forward-compatibility with Lua with some minor caveats:

* The math/string libraries use PHP number/string handling on the backend; not all behaviour has been replicated (e.g. division by zero, integer overflow)
* Not all core functions and libraries are available, but a method is provided to inject your own
* Some language constructs are not implemented (e.g. variable attributes, go-to statements)


