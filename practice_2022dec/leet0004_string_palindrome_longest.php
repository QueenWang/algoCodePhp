<?php
// command line php xx.php
/* A palindrome is a word, sentence, verse, or even number that reads the same backward or forward
 * 回文
 * single char considered as TRUE
 * 1 <= s.length <= 1000
 */

$str1 = "cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc";
$solution = new Solution();
$result1 = $solution->longestPalindrome_deprecated($str1);
echo "result is ",$result1."\n";

class Solution {
    
    //optimized based on the deprecated function
    //idea is for [i, j] string, substring i+1, j-1 needs to be palindrome too
    //use dynmaic progrmming方式，re-use内部短长度的数值
    function longestPalindrome ($s) {
       $maxPos = strlen($s) - 1;
        
        if ($maxPos == 0) { //if single char, directly return
            return $s;
        }
        
        //length from small to big
        $pdata = [];
        $maxLength = 0;
        $result = '';
        for ($length = 1; $length <= $maxPos+1; $length++ ) {
            for ($i=0; $i<= $maxPos; $i++) {
                $j = $i + $length - 1;
                if ($j > $maxPos) {
                    break;
                }
                
                if ($i==$j) { //one number
                    $pdata[$i][$j] = true;
                }
                else if ($s[$i] != $s[$j]) {
                    $pdata[$i][$j] = false;
                }
                else if ($length == 2) { //value is the same
                    $pdata[$i][$j] = true;
                }
                else { 
                    $pdata[$i][$j] = $pdata[$i+1][$j-1]; //dynamic programing re-use smaller length result
                }
                
                if ($pdata[$i][$j] == true && $length > $maxLength) {
                    $maxLength = $length;
                    $result = substr($s, $i, $length);
                }
                
            }
        }
        return $result;
    }

    /**
     * @param String $s
     * @return String
     */
    //below works, but it is too time consuming N*N*N
    //native thought
    function longestPalindrome_deprecated ($s) {
        $maxPos = strlen($s) - 1;
        
        if ($maxPos == 0) { //if single char, directly return
            return $s;
        }
        //check starting postition, skip last position
        $maxLength = -1;
        $result = ''; 
        for ($i=0; $i<$maxPos; $i++) {
            //check every possibility
            for ($j=$i+1; $j<=$maxPos; $j++) {
                //check if this string is Palindrome
                $isPalindrome = TRUE;
                $a = $i;
                $b = $j;
                while ($a < $b) { //skip equal
                    if ($s[$a] != $s[$b]) {
                        $isPalindrome = FALSE;
                        break;
                    }
                    $a++;
                    $b--;
                }
                
                if ($isPalindrome && $j-$i+1 > $maxLength) { //found
                    $maxLength = $j-$i+1;
                    $result = substr($s, $i, $maxLength);
                }
            }
        }
        
        return $maxLength == -1? $s[0] : $result; //if no result found, return first char
    }
}