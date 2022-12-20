<?php
// command line php xx.php
//https://leetcode.com/problems/integer-to-roman/
//12. Integer to Roman


$num = 3;
echo "\n input num: ".$num."\n";

$solution = new Solution();
$result1 = $solution->intToRoman($num);  
echo " result:".$result1."\n";


$num2 = 58;
echo "\n input num: ".$num2."\n";

$result2 = $solution->intToRoman($num2);  
echo " result:".$result2."\n";




class Solution {

    /**
     * @param Integer $num
     * @return String
     */
    function intToRoman($num) {
        //https://leetcode.cn/problems/integer-to-roman/solutions/774611/zheng-shu-zhuan-luo-ma-shu-zi-by-leetcod-75rs/?orderBy=most_relevant
        //official anwser is to create a hashtable from big to small
        //then traverse this hash table to find a match >= mapped value
        $romanList = [
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];
        
        $result = '';
        foreach ($romanList as $val => $symbol) {
            while ($num >= $val) {
                $num = $num - $val;
                $result = $result.$symbol;
            }
        }
        return $result;
    }
    
    function intToRoman_deprecate($num) {
        if ($num<=0) {
            return 0;
        }
        //idea from right to left check each digit
        //below is kun naive thought
        $i = 1;
        $result = '';
        $roman1Char=[
            1 => 'I',
            2 => 'X',
            3 => 'C',
            4 => 'M'
        ];
        $roman5Char=[
            1 => 'V',
            2 => 'L',
            3 => 'D'
        ];
        While ($num != 0) {
            $digit = $num % 10;
            $num = ($num-$digit)/10;
            
            if ($digit != 0) { //if 0, just skip, no need process
                //handle conversion              
                if ($digit <= 3) {
                    for ($j=1; $j<=$digit; $j++) {
                        $result = $roman1Char[$i].$result; 
                    }
                }
                else if ($digit == 4) {
                    $result = $roman1Char[$i].$roman5Char[$i].$result;
                }
                else if ($digit <= 8) {
                     for ($j=6; $j<=$digit; $j++) {
                        $result = $roman1Char[$i].$result; 
                    }
                    $result = $roman5Char[$i].$result;
                }
                else if ($digit == 9) {
                    $result = $roman1Char[$i].$roman1Char[$i+1].$result;
                }
            }
            
            $i++;        
        }
        
        return $result;
    }
}