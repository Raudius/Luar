# Luar

Luar is an interpreter for embedding Lua into PHP applications.

Luar implements a reduced version of Lua which also packages some essential Lua libraries.

 * Luar programs are forward-compatible with Lua.
 * Some basic libraries are included (string, table, math)
 * PHP functions and variables may be assigned into the global environment

## Limitations

Luar does not intend to be a full-replacement for Lua. Matching the exact language spec in PHP is a thankless task as many niche features of Lua are seldom used (particularly when embedded inside PHP).

Not-implemented, not planned:
* Meta-tables
* Attributes
* go-to statements
* Full implementations of all libraries and functions


Also notewothy:
* Performance and memory efficiency have not been the main focus in early development
* Recursive Luar programs can result in hugely nested stacks, which may trigger `xdebug.max_nesting_level`
* Error messages may not match exactly with the C interpreter for Lua.
