<?php
// command line php xx.php
/* A palindrome is a word, sentence, verse, or even number that reads the same backward or forward
 * 回文
 * single char considered as TRUE
 * 1 <= s.length <= 1000
 */


class Solution {

    /**
     * @param Integer $x
     * @return Boolean
     */
    function isPalindrome($x) {
        $str = strval($x); //maybe (string) 
        
        $lastPos = strlen($str) - 1;
        if ($lastPos < 0) { //empty input
            return false;
        }
        
        if ($lastPos == 0) { //length = 1
            return true;
        }
        
        $i = 0;
        $j = $lastPos;
        while ($i <= $j) {
            if ($str[$i] != $str[$j]) {
                return false;
            }
            $i++;
            $j--;
        }
        return true;
        
        
    }
}