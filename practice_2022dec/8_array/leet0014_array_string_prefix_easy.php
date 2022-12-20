<?php
// command line php xx.php
/*
 * https://leetcode.com/problems/longest-common-prefix/
 * 14. Longest Common Prefix
 */

$arr = ["flower","flow","flight"];
echo "input str arr ".json_encode($arr)." \n";
$solution = new Solution();
$result1 = $solution->longestCommonPrefix($arr);
echo "result is ".$result1."\n";

class Solution {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) {
        //naive thought is to traverse and validate char by char
        
        $firstStrLen = strlen($strs[0]);
        $count = count($strs);
        
        $prefix = '';
        for ($i=0; $i<$firstStrLen; $i++) {
            $isCommon = TRUE;
            $char = $strs[0][$i];
            
            for ($j=1; $j<$count; $j++) {
                if ($strs[$j][$i] != $char) {
                    $isCommon = FALSE;
                    break;
                }
            }
            if ($isCommon) {
                $prefix .= $char;
            }
            else {
                break;
            }
        }
        
        return $prefix;
        
    }
}