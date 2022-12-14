<?php
// command line php xx.php

$str1 = "abcabcbb";
echo "\n input string: ".$str1."\n";

echo "\n == no repeating char max length == \n";
$solution = new Solution();
$result1 = $solution->lengthOfLongestSubstring($str1); //use pointer, which will change the origional array 
echo "result:".$result1."\n";

$str2 = "au";
echo "\n input string: ".$str2."\n";

echo "\n == no repeating char max length == \n";
$solution = new Solution();
$result2 = $solution->lengthOfLongestSubstring($str2); //use pointer, which will change the origional array 
echo "result:".$result2."\n";

/*
 *  https://leetcode.com/problems/longest-substring-without-repeating-characters/
 * 3. Longest Substring Without Repeating Characters
 */
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        //thinking process, check for each poistion as starting char, how long, then get the biggest
        //php string function: strlen, substring ($s, startingPos, how many)
        $maxPos = strlen($s)-1;
        $charCheck = []; //moving window concept
        $movingFinishPos = -1;
        $maxLen = $maxPos<0 ? 0 : 1; //default is min 1 char
        $length = $maxLen;
        $maxLenStartingPos = 0;
        $maxChartSet = [];
        for ($i=0; $i<=$maxPos; $i++) {
            //check how many char no duplicate, using associated array for duplicate check
            $startingChar = substr($s, $i, 1);
            if (!isset($startingChar)) {
                $charCheck[$startingChar] = $i;
                $movingFinishPos++;
            }
            
            for ($j=$movingFinishPos+1; $j<=$maxPos; $j++) {
                $char = substr($s, $j, 1);
                if (!isset($charCheck[$char])) { //no duplicate, continue to next
                    $charCheck[$char] = $j;
                }
                else {//duplicate found
                    $movingFinishPos = $j-1;//$j pos having duplicate
                    break;//break $j loop
                    
                }
            }
            
            //finish one position check
            if (count($charCheck) > $maxLen) {
                $maxLen = count($charCheck);
                $maxLenStartingPos = $i;
                $maxChartSet = $charCheck;
            }
           
            if ($movingFinishPos == $maxPos) { //skip next $i check
                break;
            }
            //handle next moving char list, remove first
            unset($charCheck[$startingChar]);
            
        }
        print_r($maxChartSet);
        
        return $maxLen;
        
    }
}