-- $Id: testes/math.lua $
-- See Copyright Notice in file all.lua


print("testing numbers and math lib")
print(1>0)

local minint = math.tointeger(math.mininteger)
local maxint = math.tointeger(math.maxinteger)

print(minint, maxint)

local intbits= math.floor(math.log(maxint, 2) + 0.5) + 1
print(maxint)
print(intbits)
assert((1 << intbits) == 0)

print(1 << (63))
print(minint)

print(minint == (1 << 63))
print(minint == (1 << (intbits - 1)))
print(minint == 1 << (intbits - 1))
assert(minint == 1 << (intbits - 1))

print('+')
-- number of bits in the mantissa of a floating-point number
local floatbits = 24
do
  local p = 2.0^floatbits
  while p < p + 1.0 do
    p = p * 2.0
    floatbits = floatbits + 1
  end
end


do
  local x = 2.0^floatbits
  assert(x > x - 1.0 and x == x + 1.0)

  print(string.format("%d-bit integers, %d-bit (mantissa) floats",
          intbits, floatbits))
end

assert(math.type(0) == "integer" and math.type(0.0) == "float"
        and not math.type("10"))


local function checkerror (msg, f, ...)
  local s, err = pcall(f, ...)
  print(s)
  assert(not s)
end
local function f2i (x) return x | x end
local msgf2i = "number.* has no integer representation"

-- float equality
function eq (a,b,limit)
  if not limit then
    if floatbits >= 50 then limit = 1E-11
    else limit = 1E-5
    end
  end

  print('.')
  print('.')
  print(a)
  print(b)
  print(math.abs(a-b))
  print(limit)
  -- a == b needed for +inf/-inf
  return a == b or math.abs(a-b) <= limit
end


-- equality with types
function eqT (a,b)
  return a == b and math.type(a) == math.type(b)
end


-- basic float notation
assert(0e12 == 0)
assert(.0 == 0)
assert(0. == 0)
assert(.2e2 == 20)
assert(2.E-1 == 0.2)

do
local a,b,c = "2", " 3e0 ", " 10  "
assert(a+b == 5 and -b == -3 and b+"2" == 5 and "10"-c == 0)
assert(type(a) == 'string' and type(b) == 'string' and type(c) == 'string')
assert(a == "2" and b == " 3e0 " and c == " 10  " and -c == -"  10 ")
assert(c%a == 0 and a^b == 08)
a = 0
assert(a == -a and 0 == -0)
end

do
local x = -1
local mz = 0/x   -- minus zero
t = {[0] = 10, 20, 30, 40, 50}
assert(t[mz] == t[0] and t[-0] == t[0])
end

do   -- tests for 'modf'
local a,b = math.modf(3.5)
assert(a == 3.0 and b == 0.5)
a,b = math.modf(-2.5)
assert(a == -2.0 and b == -0.5)
a,b = math.modf(-3e23)

print(a)
print(b)
assert(a == -3e23 and b == 0.0)
a,b = math.modf(3e35)
assert(a == 3e35 and b == 0.0)
a,b = math.modf(3)  -- integer argument
assert(eqT(a, 3) and eqT(b, 0.0))
a,b = math.modf(minint)
assert(eqT(a, minint) and eqT(b, 0.0))
end

assert(math.huge > 10e30)
assert(-math.huge < -10e30)


-- testing floor division and conversions

for _, i in pairs ({-16, -15, -3, -2, -1, 0, 1, 2, 3, 15}) do
for _, j in pairs ({-16, -15, -3, -2, -1, 1, 2, 3, 15}) do
for _, ti in pairs({0, 0.0}) do     -- try 'i' as integer and as float
for _, tj in pairs({0, 0.0}) do   -- try 'j' as integer and as float
local x = i + ti
local y = j + tj
assert(i//j == math.floor(i/j))
end
end
end
end

assert(eqT(3.5 // 1.5, 2.0))
assert(eqT(3.5 // -1.5, -3.0))

do   -- tests for different kinds of opcodes
local x, y
x = 3.5; assert(eqT(x // 1, 3.0))
assert(eqT(x // -1, -4.0))

x = 3.5; y = 1.5; assert(eqT(x // y, 2.0))
x = 3.5; y = -1.5; assert(eqT(x // y, -3.0))
end



-- negative exponents
do
assert(2^-3 == 1 / 2^3)
assert(eq((-3)^-3, 1 / (-3)^3))
for i = -3, 3 do    -- variables avoid constant folding
for j = -3, 3 do
-- domain errors (0^(-n)) are not portable
if i ~= 0 or j > 0 then
assert(eq(i^j, 1 / i^(-j)))
end
end
end
end


-- order between floats and integers
assert(1 < 1.1); assert(not (1 < 0.9))
assert(1 <= 1.1); assert(not (1 <= 0.9))
assert(-1 < -0.9); assert(not (-1 < -1.1))
assert(1 <= 1.1); assert(not (-1 <= -1.1))
assert(-1 < -0.9); assert(not (-1 < -1.1))
assert(-1 <= -0.9); assert(not (-1 <= -1.1))


if floatbits < intbits then
print("testing order (floats cannot represent all integers)")
local fmax = 2^floatbits
local ifmax = fmax | 0
assert(fmax < ifmax + 1)
assert(fmax - 1 < ifmax)
assert(-(fmax - 1) > -ifmax)
assert(not (fmax <= ifmax - 1))
assert(-fmax > -(ifmax + 1))
assert(not (-fmax >= -(ifmax - 1)))

assert(fmax/2 - 0.5 < ifmax//2)
assert(-(fmax/2 - 0.5) > -ifmax//2)

assert(maxint < 2^intbits)
assert(minint > -2^intbits)
assert(maxint <= 2^intbits)
assert(minint >= -2^intbits)
else
print("testing order (floats can represent all integers)")
assert(maxint < maxint + 1.0)
assert(maxint < maxint + 0.5)
assert(maxint - 1.0 < maxint)
assert(maxint - 0.5 < maxint)
assert(not (maxint + 0.0 < maxint))
assert(maxint + 0.0 <= maxint)
assert(not (maxint < maxint + 0.0))
assert(maxint + 0.0 <= maxint)
assert(maxint <= maxint + 0.0)
assert(not (maxint + 1.0 <= maxint))
assert(not (maxint + 0.5 <= maxint))
assert(not (maxint <= maxint - 1.0))
assert(not (maxint <= maxint - 0.5))

assert(minint < minint + 1.0)
assert(minint < minint + 0.5)
assert(minint <= minint + 0.5)
assert(minint - 1.0 < minint)
assert(minint - 1.0 <= minint)
assert(not (minint + 0.0 < minint))
assert(not (minint + 0.5 < minint))
assert(not (minint < minint + 0.0))
assert(minint + 0.0 <= minint)
assert(minint <= minint + 0.0)
assert(not (minint + 1.0 <= minint))
assert(not (minint + 0.5 <= minint))
assert(not (minint <= minint - 1.0))
end


-- testing numeric strings
assert("2" + 1 == 3)
assert("2 " + 1 == 3)
assert(" -2 " + 1 == -1)
--[[
]]

-- Literal integer Overflows (new behavior in 5.3.3)
do
-- no overflows
maxint = math.maxinteger
assert(eqT(tonumber(tostring(maxint)), maxint))
assert(eqT(tonumber(tostring(minint)), minint))

-- add 1 to last digit as a string (it cannot be 9...)
local function incd (n)
  print(math.type(n))
  local s = string.format("%d", n)
  s = string.gsub(s, "%d$", function (d)
    assert(d ~= '9')
    return string.char(string.byte(d) + 1)
  end)

  return s
end

-- 'tonumber' with overflow by 1
print(tonumber(incd(maxint)))
assert(eqT(tonumber(incd(maxint)), maxint + 1.0))
assert(eqT(tonumber(incd(minint)), minint - 1.0))

-- large numbers
assert(eqT(tonumber("1"..string.rep("0", 30)), 1e30))
assert(eqT(tonumber("-1"..string.rep("0", 30)), -1e30))

assert(eqT(10000000000000000000000.0, 10000000000000000000000))
assert(eqT(-10000000000000000000000.0, -10000000000000000000000))
end


-- testing 'tonumber'

-- 'tonumber' with numbers
assert(tonumber(3.4) == 3.4)
assert(eqT(tonumber(3), 3))
assert(eqT(tonumber(maxint), maxint) and eqT(tonumber(minint), minint))

-- 'tonumber' with strings
assert(tonumber("0") == 0)
assert(not tonumber(""))
assert(not tonumber("  "))
assert(not tonumber("-"))
assert(not tonumber("  -0x "))
assert(not tonumber({}))
assert(tonumber('+0.01') == 1/100 and tonumber('+.01') == 0.01 and
tonumber('.01') == 0.01    and tonumber('-1.') == -1 and
tonumber('+1.') == 1)
assert(not tonumber('+ 0.01') and not tonumber('+.e1') and
not tonumber('1e')     and not tonumber('1.0e+') and
not tonumber('.'))
assert(tonumber('-012') == -010-2)
assert(tonumber('-1.2e2') == - - -120)


-- testing 'tonumber' with base
assert(tonumber('  001010  ', 2) == 10)
assert(tonumber('  001010  ', 10) == 001010)
assert(tonumber('  -1010  ', 2) == -10)
assert(tonumber('10', 36) == 36)
assert(tonumber('  -10  ', 36) == -36)
assert(tonumber('  +1Z  ', 36) == 36 + 35)
assert(tonumber('  -1z  ', 36) == -36 + -35)
assert(tonumber('-fFfa', 16) == -(10+(16*(15+(16*(15+(16*15)))))))
assert(tonumber(string.rep('1', (intbits - 2)), 2) + 1 == 2^(intbits - 2))
assert(tonumber('ffffFFFF', 16)+1 == (1 << 32))
assert(tonumber('0ffffFFFF', 16)+1 == (1 << 32))
assert(tonumber('-0ffffffFFFF', 16) - 1 == -(1 << 40))
for i = 2,36 do
local i2 = i * i
local i10 = i2 * i2 * i2 * i2 * i2      -- i^10
assert(tonumber('\t10000000000\t', i) == i10)
end

if not _soft then
-- tests with very long numerals
assert(tonumber("0x"..string.rep("f", 13)..".0") == 2.0^(4*13) - 1)
assert(tonumber("0x"..string.rep("f", 150)..".0") == 2.0^(4*150) - 1)
assert(tonumber("0x"..string.rep("f", 300)..".0") == 2.0^(4*300) - 1)
assert(tonumber("0x"..string.rep("f", 500)..".0") == 2.0^(4*500) - 1)
assert(tonumber('0x3.' .. string.rep('0', 1000)) == 3)
assert(tonumber('0x' .. string.rep('0', 1000) .. 'a') == 10)
assert(tonumber('0x0.' .. string.rep('0', 13).."1") == 2.0^(-4*14))
assert(tonumber('0x0.' .. string.rep('0', 150).."1") == 2.0^(-4*151))
assert(tonumber('0x0.' .. string.rep('0', 300).."1") == 2.0^(-4*301))
assert(tonumber('0x0.' .. string.rep('0', 500).."1") == 2.0^(-4*501))

end

-- testing 'tonumber' for invalid formats

local function f (...)
if select('#', ...) == 1 then
return (...)
else
return "***"
end
end

assert(not f(tonumber('fFfa', 15)))
assert(not f(tonumber('099', 8)))
assert(not f(tonumber('1\0', 2)))
assert(not f(tonumber('', 8)))
assert(not f(tonumber('  ', 9)))
assert(not f(tonumber('  ', 9)))
assert(not f(tonumber('0xf', 10)))

assert(not f(tonumber('inf')))
assert(not f(tonumber(' INF ')))
assert(not f(tonumber('Nan')))
assert(not f(tonumber('nan')))

assert(not f(tonumber('  ')))
assert(not f(tonumber('')))
assert(not f(tonumber('1  a')))
assert(not f(tonumber('1  a', 2)))
assert(not f(tonumber('1\0')))
assert(not f(tonumber('1 \0')))
assert(not f(tonumber('1\0 ')))
assert(not f(tonumber('e1')))
assert(not f(tonumber('e  1')))
assert(not f(tonumber(' 3.4.5 ')))


-- testing 'tonumber' for invalid hexadecimal formats
print('testing \'tonumber\' for invalid hexadecimal formats')

assert(not tonumber('0x'))
assert(not tonumber('x'))
assert(not tonumber('x3'))
assert(not tonumber('0x3.3.3'))   -- two decimal points
assert(not tonumber('00x2'))
assert(not tonumber('0x 2'))
assert(not tonumber('0 x2'))
assert(not tonumber('23x'))
assert(not tonumber('- 0xaa'))
assert(not tonumber('-0xaaP '))   -- no exponent
assert(not tonumber('0x0.51p'))
assert(not tonumber('0x5p+-2'))


-- testing hexadecimal numerals
print('testing hexadecimal numerals')

assert(0x10 == 16 and 0xfff == 2^12 - 1 and 0XFB == 251)
assert(0x0p12 == 0 and 0x.0p-3 == 0)
assert(0xFFFFFFFF == (1 << 32) - 1)
assert(tonumber('+0x2') == 2)
assert(tonumber('-0xaA') == -170)
assert(tonumber('-0xffFFFfff') == -(1 << 32) + 1)

-- possible confusion with decimal exponent
assert(0E+1 == 0 and 0xE+1 == 15 and 0xe-1 == 13)


-- floating hexas
print('floating hexas')
assert(1.1 == '1.'+'.1')
assert(tonumber('1111111111') - tonumber('1111111110') ==
tonumber("  +0.001e+3 \n\t"))

assert(0.1e-30 > 0.9E-31 and 0.9E30 < 0.1e31)

assert(0.123456 > 0.123455)

assert(tonumber('+1.23E18') == 1.23*10.0^18)

-- testing order operators
print('testing order operators')
assert(not(1<1) and (1<2) and not(2<1))
assert(not('a'<'a') and ('a'<'b') and not('b'<'a'))
assert((1<=1) and (1<=2) and not(2<=1))
assert(('a'<='a') and ('a'<='b') and not('b'<='a'))
assert(not(1>1) and not(1>2) and (2>1))
assert(not('a'>'a') and not('a'>'b') and ('b'>'a'))
assert((1>=1) and not(1>=2) and (2>=1))
assert(('a'>='a') and not('a'>='b') and ('b'>='a'))
assert(1.3 < 1.4 and 1.3 <= 1.4 and not (1.3 < 1.3) and 1.3 <= 1.3)

-- testing mod operator
print ('testing mod operator')
assert(eqT(-4 % 3, 2))
assert(eqT(4 % -3, -2))
assert(eqT(-4.0 % 3, 2.0))
assert(eqT(4 % -3.0, -2.0))
assert(eqT(4 % -5, -1))
assert(eqT(4 % -5.0, -1.0))
assert(eqT(4 % 5, 4))
assert(eqT(4 % 5.0, 4.0))
assert(eqT(-4 % -5, -4))
assert(eqT(-4 % -5.0, -4.0))
assert(eqT(-4 % 5, 1))
assert(eqT(-4 % 5.0, 1.0))
assert(eqT(4.25 % 4, 0.25))
assert(eqT(10.0 % 2, 0.0))
assert(eqT(-10.0 % 2, 0.0))
assert(eqT(-10.0 % -2, 0.0))
assert(math.pi - math.pi % 1 == 3)
assert(math.pi - math.pi % 0.001 == 3.141)

print('very small numbers')
do   -- very small numbers
local i, j = 0, 20000
while i < j do
local m = (i + j) // 2
if 10^-m > 0 then
i = m + 1
else
j = m
end
end

print ('i is the smallest possible ten-exponent')
-- 'i' is the smallest possible ten-exponent
local b = 10^-(i - (i // 10))   -- a very small number
assert(b > 0 and b * b == 0)
local delta = b / 1000
assert(eq((2.1 * b) % (2 * b), (0.1 * b), delta))
assert(eq((-2.1 * b) % (2 * b), (2 * b) - (0.1 * b), delta))
assert(eq((2.1 * b) % (-2 * b), (0.1 * b) - (2 * b), delta))
assert(eq((-2.1 * b) % (-2 * b), (-0.1 * b), delta))
end


-- basic consistency between integer modulo and float modulo
for i = -10, 10 do
for j = -10, 10 do
if j ~= 0 then
assert((i + 0.0) % j == i % j)
end
end
end

for i = 0, 10 do
for j = -10, 10 do
if j ~= 0 then
assert((2^i) % j == (1 << i) % j)
end
end
end

do    -- precision of module for large numbers
local i = 10
while (1 << i) > 0 do
assert((1 << i) % 3 == i % 2 + 1)
i = i + 1
end

i = 10
while 2^i < math.huge do
assert(2^i % 3 == i % 2 + 1)
i = i + 1
end
end


-- non-portable tests because Windows C library cannot compute
-- fmod(1, huge) correctly
if not _port then
local function anan (x) assert(isNaN(x)) end   -- assert Not a Number
anan(0.0 % 0)
anan(1.3 % 0)
anan(math.huge % 1)
anan(math.huge % 1e30)
anan(-math.huge % 1e30)
anan(-math.huge % -1e30)
assert(1 % math.huge == 1)
assert(1e30 % math.huge == 1e30)
assert(1e30 % -math.huge == -math.huge)
assert(-1 % math.huge == math.huge)
assert(-1 % -math.huge == -1)
end




assert(eq(math.sin(-9.8)^2 + math.cos(-9.8)^2, 1))
assert(eq(math.tan(math.pi/4), 1))
assert(eq(math.sin(math.pi/2), 1) and eq(math.cos(math.pi/2), 0))
assert(eq(math.atan(1), math.pi/4) and eq(math.acos(0), math.pi/2) and
eq(math.asin(1), math.pi/2))
assert(eq(math.deg(math.pi/2), 90) and eq(math.rad(90), math.pi/2))
assert(math.abs(-10.43) == 10.43)
assert(eq(math.atan(1,0), math.pi/2))
assert(math.fmod(10,3) == 1)
assert(eq(math.sqrt(10)^2, 10))
assert(eq(math.log(2, 10), math.log(2)/math.log(10)))
assert(eq(math.log(2, 2), 1))
assert(eq(math.log(9, 3), 2))
assert(eq(math.exp(0), 1))
assert(eq(math.sin(10), math.sin(10%(2*math.pi))))


assert(tonumber(' 1.3e-2 ') == 1.3e-2)
assert(tonumber(' -1.00000000000001 ') == -1.00000000000001)

-- testing constant limits
-- 2^23 = 8388608
assert(8388609 + -8388609 == 0)
assert(8388608 + -8388608 == 0)
assert(8388607 + -8388607 == 0)



do   -- testing floor & ceil
assert(eqT(math.floor(3.4), 3))
assert(eqT(math.ceil(3.4), 4))
assert(eqT(math.floor(-3.4), -4))
assert(eqT(math.ceil(-3.4), -3))
assert(math.floor(1e50) == 1e50)
assert(math.ceil(1e50) == 1e50)
assert(math.floor(-1e50) == -1e50)
assert(math.ceil(-1e50) == -1e50)
for _, p in pairs({31, 32, 63, 64}) do
  assert(math.floor(2^p) == 2^p)
  assert(math.floor(2^p + 0.5) == 2^p)
  assert(math.ceil(2^p) == 2^p)
  assert(math.ceil(2^p - 0.5) == 2^p)
end
checkerror("number expected", math.floor, {})
checkerror("number expected", math.ceil, print)
assert(eqT(math.tointeger(minint), minint))
assert(eqT(math.tointeger(minint .. ""), minint))
assert(eqT(math.tointeger(maxint), maxint))
assert(eqT(math.tointeger(maxint .. ""), maxint))
assert(eqT(math.tointeger(minint + 0.0), minint))
assert(not math.tointeger(math.pi))
assert(not math.tointeger(-math.pi))
assert(math.floor(math.huge) == math.huge)
assert(math.ceil(math.huge) == math.huge)
assert(not math.tointeger(math.huge))
assert(math.floor(-math.huge) == -math.huge)
assert(math.ceil(-math.huge) == -math.huge)
assert(not math.tointeger(-math.huge))
assert(math.tointeger("34.0") == 34)
assert(not math.tointeger("34.3"))
assert(not math.tointeger({}))
end




do    -- testing max/min
checkerror("value expected", math.max)
checkerror("value expected", math.min)
assert(eqT(math.max(3), 3))
assert(eqT(math.max(3, 5, 9, 1), 9))
assert(math.max(maxint, 10e60) == 10e60)
assert(eqT(math.max(minint, minint + 1), minint + 1))
assert(eqT(math.min(3), 3))
assert(eqT(math.min(3, 5, 9, 1), 1))
assert(math.min(3.2, 5.9, -9.2, 1.1) == -9.2)
assert(math.min(1.9, 1.7, 1.72) == 1.7)
assert(math.min(-10e60, minint) == -10e60)
assert(eqT(math.min(maxint, maxint - 1), maxint - 1))
assert(eqT(math.min(maxint - 2, maxint, maxint - 1), maxint - 2))
end
-- testing implicit conversions

local a,b = '10', '20'
assert(a*b == 200 and a+b == 30 and a-b == -10 and a/b == 0.5 and -b == -20)
assert(a == '10' and b == '20')



print("testing 'math.random'")

local random, max, min = math.random, math.max, math.min

local function testnear (val, ref, tol)
return (math.abs(val - ref) < ref * tol)
end



do
local function aux (x1, x2)     -- test random for small intervals
  local mark = {}; local count = 0   -- to check that all values appeared
  while true do
    local t = random(x1, x2)
    assert(x1 <= t and t <= x2)
    if not mark[t] then  -- new value
      mark[t] = true
      count = count + 1
      if count == x2 - x1 + 1 then   -- all values appeared; OK
        return
      end
    end
  end
end

aux(-10,0)
aux(1, 6)
aux(1, 2)
aux(1, 13)
aux(1, 31)
aux(1, 32)
aux(1, 33)
aux(-10, 10)
aux(-10,-10)   -- unit set
aux(minint, minint)   -- unit set
aux(maxint, maxint)   -- unit set
aux(minint, minint + 9)
aux(maxint - 3, maxint)
end

-- empty interval
print('random empty interval')
assert(not pcall(random, minint + 1, minint))
assert(not pcall(random, maxint, maxint - 1))
assert(not pcall(random, maxint, minint))



print('OK')
