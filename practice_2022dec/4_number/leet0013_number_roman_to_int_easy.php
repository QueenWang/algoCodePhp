<?php
// command line php xx.php
//https://leetcode.com/problems/integer-to-roman/
//12. Integer to Roman

$str = 'LVIII';
echo "\n input str: ".$str."\n";

$solution = new Solution();
$result1 = $solution->romanToInt($str);  
echo " result:".$result1."\n";


$str2 = 'MCMXCIV';
echo "\n input str: ".$str2."\n";

$result2 = $solution->romanToInt($str2);  
echo " result:".$result2."\n";




class Solution {
    /**
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $twoCharMap = [
            'IV' => 4,
            'IX' => 9,
            'XL' => 40,
            'XC' => 90,
            'CD' => 400,
            'CM' => 900
        ];
        $oneCharMap = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000
        ];
        
        $len = strlen($s);
        $i = 0;
        $result = 0;
        while ($i < $len) {
            //check first two char
            $twoChar = substr($s, $i, 2);
            if (isset($twoCharMap[$twoChar])) {
                $result += $twoCharMap[$twoChar];
                $i += 2;
            }
            else {
                $result += $oneCharMap[$s[$i]];
                $i++;
            }
        }
        return $result;
        
    }
    
}

