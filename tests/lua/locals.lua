-- $Id: testes/locals.lua $
-- See Copyright Notice in file all.lua

print('testing local variables and environments')


-- bug in 5.1:

local function f(x) x = nil; return x end
assert(f(10) == nil)

local function f() local x; return x end
assert(f(10) == nil)

local function f(x) x = nil; local y; return x, y end
assert(f(10) == nil and select(2, f(20)) == nil)

do
  local i = 10
  do local i = 100; assert(i==100) end
  do local i = 1000; assert(i==1000) end
  assert(i == 10)
  if i ~= 10 then
    local i = 20
  else
    local i = 30
    assert(i == 30)
  end
end



f = nil

local f
x = 1

a = nil
load('local a = {}')()
assert(a == nil)

function f (a)
  local _1, _2, _3, _4, _5
  local _6, _7, _8, _9, _10
  local x = 3
  local b = a
  local c,d = a,b
  if (d == b) then
    local x = 'q'
    x = b
    assert(x == 2)
  else
    assert(nil)
  end
  assert(x == 3)
  local f = 10
end

local b=10
local a; repeat local b; a,b=1,2; assert(a+1==b); until a+b==3


assert(x == 1)

f(2)
assert(type(f) == 'function')



print'+'

