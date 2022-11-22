-- $Id: testes/strings.lua $
-- See Copyright Notice in file all.lua

print('testing strings and string library')

local maxi = math.maxinteger-1
local mini = math.mininteger+1


local function checkerror (msg, f, ...)
  local s, err = pcall(f, ...)

  assert(not s)
end


-- testing string comparisons
assert('alo' < 'alo1')
assert('' < 'a')
assert('alo\0alo' < 'alo\0b')
assert('alo\0alo\0\0' > 'alo\0alo\0')
assert('alo' < 'alo\0')
assert('alo\0' > 'alo')
assert('\0' < '\1')
assert('\0\0' < '\0\1')
assert('\1\0a\0a' <= '\1\0a\0a')
assert(not ('\1\0a\0b' <= '\1\0a\0a'))
assert('\0\0\0' < '\0\0\0\0')
assert(not('\0\0\0\0' < '\0\0\0'))
assert('\0\0\0' <= '\0\0\0\0')
assert(not('\0\0\0\0' <= '\0\0\0'))
assert('\0\0\0' <= '\0\0\0')
assert('\0\0\0' >= '\0\0\0')
assert(not ('\0\0b' < '\0\0a\0'))

-- testing string.sub
assert(string.sub("123456789",2,4) == "234")
assert(string.sub("123456789",7) == "789")
assert(string.sub("123456789",7,6) == "")
assert(string.sub("123456789",7,7) == "7")
assert(string.sub("123456789",0,0) == "")
assert(string.sub("123456789",-10,10) == "123456789")
assert(string.sub("123456789",1,9) == "123456789")
assert(string.sub("123456789",-10,-20) == "")
assert(string.sub("123456789",-1) == "9")
assert(string.sub("123456789",-4) == "6789")
assert(string.sub("123456789",-6, -4) == "456")
assert(string.sub("123456789", mini, -4) == "123456")
assert(string.sub("123456789", mini, maxi) == "123456789")
assert(string.sub("123456789", mini, mini) == "")
assert(string.sub("\000123456789",3,5) == "234")
assert(("\000123456789"):sub(8) == "789")

-- testing string.find
assert(string.find("123456789", "345") == 3)
a,b = string.find("123456789", "345")
assert(string.sub("123456789", a, b) == "345")
assert(string.find("1234567890123456789", "345", 3) == 3)
assert(string.find("1234567890123456789", "345", 4) == 13)
assert(not string.find("1234567890123456789", "346", 4))
assert(string.find("1234567890123456789", ".45", -9) == 13)
assert(not string.find("abcdefg", "\0", 5, 1))
assert(string.find("", "") == 1)
assert(string.find("", "", 1) == 1)
assert(not string.find("", "", 2))
assert(not string.find('', 'aaa', 1))
assert(('alo(.)alo'):find('(.)', 1, 1) == 4)

assert(string.len("") == 0)
assert(string.len("\0\0\0") == 3)
assert(string.len("1234567890") == 10)

assert(#"" == 0)
assert(#"\0\0\0" == 3)
assert(#"1234567890" == 10)

-- testing string.byte/string.char
assert(string.byte("a") == 97)
assert(string.byte("\xe4") > 127)
assert(string.byte(string.char(255)) == 255)
assert(string.byte(string.char(0)) == 0)
assert(string.byte("\0") == 0)
assert(string.byte("\0\0alo\0x", -1) == string.byte('x'))
assert(string.byte("ba", 2) == 97)
assert(string.byte("\n\n", 2, -1) == 10)
assert(string.byte("\n\n", 2, 2) == 10)
assert(string.byte("") == nil)
assert(string.byte("hi", -3) == nil)
assert(string.byte("hi", 3) == nil)
assert(string.byte("hi", 9, 10) == nil)
assert(string.byte("hi", 2, 1) == nil)
assert(string.char() == "")
assert(string.char(0, 255, 0) == "\0\255\0")
assert(string.char(0, string.byte("\xe4"), 0) == "\0\xe4\0")
assert(string.char(string.byte("\xe4l\0óu", 1, -1)) == "\xe4l\0óu")
assert(string.char(string.byte("\xe4l\0óu", 1, 0)) == "")
assert(string.char(string.byte("\xe4l\0óu", -10, 100)) == "\xe4l\0óu")

print('check error')
checkerror("out of range", string.char, 256)
checkerror("out of range", string.char, -1)
checkerror("out of range", string.char, math.maxinteger)
checkerror("out of range", string.char, math.mininteger)

print('upper/lower')
assert(string.upper("ab\0c") == "AB\0C")
assert(string.lower("\0ABCc%$") == "\0abcc%$")

print('repetitions')
assert(string.rep('teste', 0) == '')
assert(string.rep('tés\00tê', 2) == 'tés\0têtés\000tê')
assert(string.rep('', 10) == '')


-- repetitions with separator
print('repetitions with separator')
assert(string.rep('teste', 0, 'xuxu') == '')
assert(string.rep('teste', 1, 'xuxu') == 'teste')
assert(string.rep('\1\0\1', 2, '\0\0') == '\1\0\1\0\0\1\0\1')
assert(string.rep('', 10, '.') == string.rep('.', 9))
assert(not pcall(string.rep, "aa", maxi // 2 + 10))
assert(not pcall(string.rep, "", maxi // 2 + 10, "aa"))

assert(string.reverse"" == "")
assert(string.reverse"\0\1\2\3" == "\3\2\1\0")
assert(string.reverse"\0001234" == "4321\0")

for i=0,30 do assert(string.len(string.rep('a', i)) == i) end

assert(type(tostring(nil)) == 'string')
assert(type(tostring(12)) == 'string')
assert(string.find(tostring{}, 'table:'))
assert(string.find(tostring(print), 'function:'))
assert(#tostring('\0') == 1)
assert(tostring(true) == "true")
assert(tostring(false) == "false")
assert(tostring(-1203) == "-1203")
assert(tostring(1203.125) == "1203.125")
assert(tostring(-0.5) == "-0.5")
assert(tostring(-32767) == "-32767")
if math.tointeger(2147483647) then   -- no overflow? (32 bits)
  assert(tostring(-2147483647) == "-2147483647")
end
if math.tointeger(4611686018427387904) then   -- no overflow? (64 bits)
  assert(tostring(4611686018427387904) == "4611686018427387904")
  assert(tostring(-4611686018427387904) == "-4611686018427387904")
end

if tostring(0.0) == "0.0" then   -- "standard" coercion float->string
  assert('' .. 12 == '12' and 12.0 .. '' == '12.0')
  assert(tostring(-1203 + 0.0) == "-1203.0")
else   -- compatible coercion
  assert(tostring(0.0) == "0")
  assert('' .. 12 == '12' and 12.0 .. '' == '12')
  assert(tostring(-1203 + 0.0) == "-1203")
end


assert(string.format("\0%s\0", "\0\0\1") == "\0\0\0\1\0")

-- format x tostring
assert(string.format("%s %s", nil, true) == "nil true")
assert(string.format("%s %.4s", false, true) == "false true")
assert(string.format("%.3s %.3s", false, true) == "fal tru")




checkerror("table expected", table.concat, 3)
checkerror("at index " .. maxi, table.concat, {}, " ", maxi, maxi)
-- '%' escapes following minus signal
checkerror("at index %" .. mini, table.concat, {}, " ", mini, mini)


print('table.concat')
assert(table.concat{} == "")
assert(table.concat({}, 'x') == "")
assert(table.concat({'\0', '\0\1', '\0\1\2'}, '.\0.') == "\0.\0.\0\1.\0.\0\1\2")
local a = {}; for i=1,300 do a[i] = "xuxu" end
assert(table.concat(a, "123").."123" == string.rep("xuxu123", 300))
assert(table.concat(a, "b", 20, 20) == "xuxu")
assert(table.concat(a, "", 20, 21) == "xuxuxuxu")
assert(table.concat(a, "x", 22, 21) == "")
assert(table.concat(a, "3", 299) == "xuxu3xuxu")
assert(table.concat({}, "x", maxi, maxi - 1) == "")
assert(table.concat({}, "x", mini + 1, mini) == "")
assert(table.concat({}, "x", maxi, mini) == "")
assert(table.concat({[maxi] = "alo"}, "x", maxi, maxi) == "alo")
assert(table.concat({[maxi] = "alo", [maxi - 1] = "y"}, "-", maxi - 1, maxi)
        == "y-alo")

assert(not pcall(table.concat, {"a", "b", {}}))

a = {"a","b","c"}
assert(table.concat(a, ",", 1, 0) == "")
assert(table.concat(a, ",", 1, 1) == "a")
assert(table.concat(a, ",", 1, 2) == "a,b")
assert(table.concat(a, ",", 2) == "b,c")
assert(table.concat(a, ",", 3) == "c")
assert(table.concat(a, ",", 4) == "")




print('OK')
