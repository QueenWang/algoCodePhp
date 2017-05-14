<?php
/*
 * $argv: problem #1 input of two strings for comparison
 * List of string problems
 * 1. compareString3: binary safe comparison, stringcmp in PHP
 * 2. getFirstNoDuplicateChar: get first non duplicate char from a string
 */
//use compareString3 function as standard
//problem: binary safe comparison, stringcmp function in PHP (return > 0, <0 or O)
//input: $string1, $string2
//output: -1 if $string1<$string2, 1 if >, 0 if the same
//idea: compare each char, since length is different, get min length and compare until min length
//if char1><char2 then return, if not, equal, continue. After loop compare length
echo "\n compareString \n";
echo (empty('0') ? 1 : 0)."\n";
$test = substr('test', 4, 1);
echo FALSE === $test ? "FALSE" : "not FALSE";
echo("\n");
echo '' === $test ? "emptry string" : "not emptry string";
  echo("\n");      
$string1 = $argv[1];
$string2 = $argv[2];

echo "string1=$string1, string2=$string2 \n";
echo "default strcmop result: ".strcmp($string1, $string2)."\n";
echo "function 1 result: ".compareString($string1, $string2)."\n";
echo "function 2 result: ".compareString2($string1, $string2)."\n";
echo "function 3 result: ".compareString3($string1, $string2)."\n";

//not accurate
function compareString ($string1, $string2) {
    $str1Length = strlen($string1);
    for ($i=0; $i<$str1Length; $i++) {
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
function compareString2 ($string1, $string2) {
    $str1Length = strlen($string1);
    $str2Length = strlen($string2);
    $maxLength = max($str1Length, $str2Length);
    for ($i=0; $i<$maxLength; $i++) {
        $char1 = substr($string1, $i, 1);
        $char2 = substr($string2, $i, 1);
        if (FALSE !== $char1 && FALSE !== $char2) {
           if ($char1 > $char2) {
                return 1;
            }
            else if ($char1 < $char2) {
                return -1;
            }
        }
        else if (FALSE !== $char1) {
            return 1;
        }
        else if (FALSE !== $char2) {
            return -1;
        }
    }
    
    return 0;
}

function compareString3 ($string1, $string2) {
    $str1Length = strlen($string1);
    $str2Length = strlen($string2);
    $minLength = min($str1Length, $str2Length);
    for ($i=0; $i<$minLength; $i++) {//both have sub char
        //$char1 = substr($string1, $i, 1);
        //$char2 = substr($string2, $i, 1);
        $char1 = $string1[$i];
        $char2 = $string2[$i];
        if ($char1 > $char2) {
            return 1;
        }
        else if ($char1 < $char2) {
            return -1;
        }
    }
    if ($str1Length == $str2Length) {
        return 0;
    }
    else if ($str1Length > $str2Length) {
        return 1;
    }
    else {
        return -1;
    }
}

/*
 * == getFirstNoDuplicateChar ==
 */
echo "\n getFirstNoDuplicateChar \n";
echo getFirstNoDuplicateChar("singaporegoodtimefastcool")."\n";

function getFirstNoDuplicateChar($string) {
    $strLength = strlen($string);
    $countArr = array();
    for ($i=0; $i<$strLength; $i++) {
        $char = $string[$i];
        if (isset($countArr[$char])) {//with duplciate
            $countArr[$char] += 1;
        }
        else {
            $countArr[$char] = 1;
        }
    }
    print_r($countArr);
    foreach ($countArr as $char=>$count) {
        if ($count == 1 ) {
            return $char;
        }
    }
}
