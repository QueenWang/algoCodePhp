<?php

/*
 * $argv: problem #1 input of two strings for comparison
 * List of string & array problems
 * 1. compareString3: binary safe comparison, stringcmp in PHP
 * 2. getFirstNoDuplicateChar: get first non duplicate char from a string
 * 3. string permutation problem (anagram字谜）
 *  - findPermutationsArrayNoDuplicate: no duplicate, array input
 *  -  findPermutationsStr: with duplicate for string, hashtable to check for duplicates val as key 
 * 4. isPermutable: Given two strings, decide if one is permutation of another: use hash table for frequencey
 */

//use compareString3 function as standard
//problem: binary safe comparison, stringcmp function in PHP (return > 0, <0 or O)
//input: $string1, $string2
//output: -1 if $string1<$string2, 1 if >, 0 if the same
//idea: compare each char, since length is different, get min length and compare until min length
//if char1><char2 then return, if not, equal, continue. After loop compare length
echo "\n compareString \n";
echo (empty('0') ? 1 : 0) . "\n";
$test = substr('test', 4, 1);
echo FALSE === $test ? "FALSE" : "not FALSE";
echo("\n");
echo '' === $test ? "emptry string" : "not emptry string";
echo("\n");
$string1 = $argv[1];
$string2 = $argv[2];

echo "string1=$string1, string2=$string2 \n";
echo "default strcmop result: " . strcmp($string1, $string2) . "\n";
echo "function 1 result: " . compareString($string1, $string2) . "\n";
echo "function 2 result: " . compareString2($string1, $string2) . "\n";
echo "function 3 result: " . compareString3($string1, $string2) . "\n";

//not accurate
function compareString($string1, $string2) {
    $str1Length = strlen($string1);
    for ($i = 0; $i < $str1Length; $i++) {
        $char1 = substr($string1, $i, 1);
        $char2 = substr($string2, $i, 1);
        if (FALSE === $char2) {
            return 1;
        }
        if ($char1 > $char2) {
            return 1;
        }
        if ($char1 < $char2) {
            return -1;
        }
    }
    //1==2, 1<2 length
    if ($str1Length < strlen($string2)) {
        return -1;
    }
    return 0;
}

//not accurate
function compareString2($string1, $string2) {
    $str1Length = strlen($string1);
    $str2Length = strlen($string2);
    $maxLength = max($str1Length, $str2Length);
    for ($i = 0; $i < $maxLength; $i++) {
        $char1 = substr($string1, $i, 1);
        $char2 = substr($string2, $i, 1);
        if (FALSE !== $char1 && FALSE !== $char2) {
            if ($char1 > $char2) {
                return 1;
            } else if ($char1 < $char2) {
                return -1;
            }
        } else if (FALSE !== $char1) {
            return 1;
        } else if (FALSE !== $char2) {
            return -1;
        }
    }

    return 0;
}

function compareString3($string1, $string2) {
    $str1Length = strlen($string1);
    $str2Length = strlen($string2);
    $minLength = min($str1Length, $str2Length);
    for ($i = 0; $i < $minLength; $i++) {//both have sub char
        //$char1 = substr($string1, $i, 1);
        //$char2 = substr($string2, $i, 1);
        $char1 = $string1[$i];
        $char2 = $string2[$i];
        if ($char1 > $char2) {
            return 1;
        } else if ($char1 < $char2) {
            return -1;
        }
    }
    if ($str1Length == $str2Length) {
        return 0;
    } else if ($str1Length > $str2Length) {
        return 1;
    } else {
        return -1;
    }
}

/*
 * == getFirstNoDuplicateChar ==
 */
echo "\n == getFirstNoDuplicateChar == \n";
echo getFirstNoDuplicateChar("singaporegoodtimefastcool") . "\n";

function getFirstNoDuplicateChar($string) {
    $strLength = strlen($string);
    $countArr = array();
    for ($i = 0; $i < $strLength; $i++) {
        $char = $string[$i];
        if (isset($countArr[$char])) {//with duplciate
            $countArr[$char] += 1;
        } else {
            $countArr[$char] = 1;
        }
    }
    print_r($countArr);
    foreach ($countArr as $char => $count) {
        if ($count == 1) {
            return $char;
        }
    }
}

/*
 * == findPermutations ==
 * check if items are unique
 */
echo "\n == findPermutationsStr == \n";
$test = "stop";
echo "test1: $test \n";
print_r(findPermutationsStr($test));
echo "\n";

$test = "aabb";
echo "test1: $test \n";
print_r(findPermutationsStr($test));
echo "\n";

function findPermutationsStr($string) {
    $strLength = strlen($string);
    if ($strLength == 1) {
        return array($string);
    }
    $lastChar = $string[$strLength - 1];
    $subStringLength = $strLength - 1;
    $subString = substr($string, 0, $subStringLength);
    $subResult = findPermutationsStr($subString);

    $result = array();
    foreach ($subResult as $eachItem) {
        //$val = $lastChar . $eachItem;
        //$result[$val] = $val;
        for ($i = 0; $i <= ($subStringLength); $i++) {
            $left = substr($eachItem, 0, $i);
            $right = substr($eachItem, $i, $subStringLength - $i);
            $val = $left . $lastChar . $right;
            if (!isset($result[$val])) { //if all chars are unique, then no need this
                $result[$val] = $val;
            }
        }
        //$val = $eachItem . $lastChar;
        //$result[$val] = $val;
    }

    return $result;
}


echo "\n == findPermutationsArrayNoDuplicate == \n";
$test = array("i", "love", "you");
echo "test1: \n";
print_r($test);
echo "\n";
print_r(findPermutationsArrayNoDuplicate($test));
echo "\n";

$test = array(1, 2, 3, 4);
echo "test2: \n";
print_r($test);
echo "\n";
print_r(findPermutationsArrayNoDuplicate($test));
echo "\n";


//https://docstore.mik.ua/orelly/webprog/pcook/ch04_26.htm#phpckbk-CHP-4-EX-6
function findPermutationsArrayNoDuplicate($array) {
    if (!is_array($array)) {
        return array();
    }
    $length = count($array);
    if ($length <= 1) {
        return array($array);
    }
    $lastItem = array_pop($array);

    $permutation = findPermutationsArrayNoDuplicate($array);

    $result = array();
    foreach ($permutation as $permuItem) {
       // $result[] = array_merge(array($lastItem), $permuItem);
        for ($i = 0; $i <= count($permuItem); $i++) {
            $left = array_slice($permuItem, 0, $i);
            $right = array_slice($permuItem, $i);
            $result[] = array_merge($left, array($lastItem), $right);
        }
        //$result[] = array_merge($permuItem, array($lastItem));
    }

    return $result;
}

/*
echo "\n pc_permute \n";
$test = array("i", "love", "you");
echo "test1: \n";
print_r($test);
echo "\n";
print_r(pc_permute($test));
echo "\n";

$test = array(1, 2, 3, 4);
echo "test2: \n";
print_r($test);
echo "\n";
print_r(pc_permute($test));
echo "\n";

//from PHP cookbook
function pc_permute($items, $perms = array()) {
    if (empty($items)) {
        echo join(' ', $perms) . "\n";
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            pc_permute($newitems, $newperms);
        }
    }
}
 * 
 */


//$array items can be string char, word in a sentance, numbers
//[a, b, c] ==> [[a, b, c] [a, c, b], ..]
//a + p(b,c)
//b + p(a, c)
//c + p(a,b)

/*
  function p(array):
  if (size(array) == 1): return array

  foreach item in array:
  print item : p(array - item)
  endforeach;
 * 
 */
/*
echo "\n == permutation == \n";

$test = array("i", "love", "you");
echo "test1: \n";
print_r($test);
echo "\n";
print_r(permutation($test));
echo "\n";

$test = array(1, 2, 3, 4);
echo "test2: \n";
print_r($test);
echo "\n";
print_r(permutation($test));
echo "\n";

//xiang logic: take one item out, prepend to the result elements
function permutation($array) {
    $size = count($array);
    if ($size <= 1) {
        return array($array);
    }
    
    $result = array();
    for ($i = 0; $i < $size; $i++) {
        $item = $array[$i];
        $left = array_slice($array, 0, $i);
        $right = array_slice($array, $i + 1);
        $subArr = array_merge($left, $right);
        $subResult = permutation($subArr);

        foreach ($subResult as $subItems) {
            $result[] = array_merge(array($item), $subItems);
        }
    }

    return $result;
}


echo "\n == findPermutationsArrayNoDuplicate2 == \n";
$test = array("i", "love", "you");
echo "test1: \n";
print_r($test);
echo "\n";
print_r(findPermutationsArrayNoDuplicate2($test));
echo "\n";

$test = array(1, 2, 3, 4);
echo "test2: \n";
print_r($test);
echo "\n";
print_r(findPermutationsArrayNoDuplicate2($test));
echo "\n";

//based on the PHP cookbook function
//take one item out each time and find the permutation of left over n-1 items
function findPermutationsArrayNoDuplicate2($array, $result=array(), &$finalResult=array()) {
    $size = count($array);
    if ($size <= 0) {
        $finalResult[] = $result;
    }
    for ($i = 0; $i < $size; $i++) {
        $newArr = $array;
        $item = $newArr[$i];
        array_splice($newArr, $i, 1);
        $newResult = $result;
        array_unshift($newResult, $item);
        findPermutationsArrayNoDuplicate2($newArr, $newResult, $finalResult);
    }
    
    return $finalResult;
}
*/


echo "\n == isPermutable == \n";

$test1 = array("i", "love", "you");
$test2 = array("love", "you", "i");
echo "case 1: ".(isPermutable($test1, $test2) ? 'YES' : "NO");
echo "\n";

$test1 = array(1, 2, 3, 4);
$test2 = array(2, 3, 4, 1);
echo "case 2: ".(isPermutable($test1, $test2) ? 'YES' : "NO");
echo "\n";

$test1 = array(1, 2, 3, 4);
$test2 = array(2, 3, 4, 5);
echo "case 3: ".(isPermutable($test1, $test2) ? 'YES' : "NO");
echo "\n";
//ideas: two approaches
//- one is to use hash table to store the fequency of each item O(N)
//- another method is to use sorting, quick sort NlogN

//use hash table, input arary elements can be any item
function isPermutable ($array1, $array2) {
    if (count($array1) != count($array2)) {
        return false;
    }
    $map1 = array();
    $map2 = array();
    for ($i=0; $i<count($array1); $i++) {
        $map1[$array1[$i]] = isset($map1[$array1[$i]]) ? $map1[$array1[$i]]+1 : 1;
        $map2[$array2[$i]] = isset($map2[$array2[$i]]) ? $map2[$array2[$i]]+1 : 1;
    }
    
    if (count($map1) != count($map2)) {
        return false;
    }
    foreach ($map1 as $index => $count) {
        if ($map2[$index] != $count) {
            return false;
        }
    }
    return true;
}

echo "\n == isPermutableBySorting == \n";

$test1 = array("a", "b", "c");
$test2 = array("c", "b", "a");
echo "case 1: ".(isPermutableBySorting($test1, $test2) ? 'YES' : "NO");
echo "\n";

$test1 = array(1, 2, 3, 4);
$test2 = array(2, 3, 4, 1);
echo "case 2: ".(isPermutableBySorting($test1, $test2) ? 'YES' : "NO");
echo "\n";

$test1 = array(1, 2, 3, 4);
$test2 = array(2, 3, 4, 5);
echo "case 3: ".(isPermutableBySorting($test1, $test2) ? 'YES' : "NO");
echo "\n";

//input array element can be number, or char for sorting
function isPermutableBySorting ($array1, $array2) {
    if (count($array1) != count($array2)) {
        return false;
    }
    
    //sort($array1);
    //sort($array2);
    quicksort($array1);
    quicksort($array2);
    
    foreach ($array1 as $index => $val) {
        if ($array2[$index] != $val) {
            return false;
        }
    }
    return true;
}

//implement php sort function by quick sort
function quicksort(&$array) {
    quicksort_partition($array, 0, count($array)-1);  
}

function quicksort_partition (&$array, $startIndex, $endIndex) {
    if ($startIndex >= $endIndex) {
        return false;
    }
    $pivotIndex = $startIndex;
    $pivot = $array[$pivotIndex];
    
    $leftwallIndex = $pivotIndex;
    for ($i=$startIndex+1; $i<=$endIndex; $i++) {
        if ($array[$i] <= $pivot) { //swap to left side    
            $leftwallIndex++;
            $temp = $array[$i];
            $array[$i] = $array[$leftwallIndex];
            $array[$leftwallIndex-1] = $temp;
            $array[$leftwallIndex] = $pivot;          
        }
    }
    quicksort_partition($array, $startIndex, $leftwallIndex-1);
    quicksort_partition($array,  $leftwallIndex+1, $endIndex);
}

//TODO
//Given two arrays, return an array that contains all elements that are in the intersection of both
//input: $array1, $array2
//output: $intersectArr