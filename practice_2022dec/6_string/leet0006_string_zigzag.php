<?php
// command line php xx.php
/*
 * https://leetcode.com/problems/zigzag-conversion/
 * 6. Zigzag Conversion
 */

$str1 = "PAHNAPLSIIGYIR";
echo "input $str1 \n";
$solution = new Solution();
$result1 = $solution->convert($str1, 3);
echo "result is ".$result1."\n";

class Solution {

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        //put into a metrics with 2 indexes, row and column
        //this method is easier to understand
         $strLength = strlen($s);
        if ($strLength <= 1 || $numRows <= 1) {
            return $s;
        }
        
        $metrics = [];
        $i = 0;
        $rowNum = 0;
        $colNum = 0;
        $section = 1; //two sections
        while ($i < $strLength) {
            $metrics[$rowNum][$colNum] = $s[$i];
            //movedown
            if ($section == 1) { 
                //column the same, row++
                if ($rowNum == $numRows-1) {//first section last row
                    $section = 2; //next section starts
                    $rowNum--;
                    $colNum++;
                }
                else {
                    $rowNum++;
                }
            }
            else if ($section == 2) {
                if ($rowNum == 0) {
                    $section = 1;
                    $rowNum++;
                }
                else {
                    $rowNum--;
                    $colNum++;
                }
            }
            
            $i++;
           
        }
        
        $result = '';
        foreach ($metrics as $row => $arr) {
            $result .= implode($arr);
        }
        
        return $result;
        
        
    }
    
    /*
     * 利用数学规律
     */
    function convert_deprecated($s, $numRows) {
        //string index % 2n-2, every cycle, from 0 to 2n-2-1
        //0 to n-1, set key the same ++ 
        // n to 2n-2-1: key--
        $strLength = strlen($s);
        if ($strLength <= 1 || $numRows <= 1) {
            return $s;
        }
        
        $strArr = [];
        $i = 0;
        while ($i < $strLength) {
            $char = $s[$i];
            $reminder = $i % (2*$numRows-2);
            if ($reminder <= ($numRows-1)) {
                $strArr[$reminder] .= $char;
            }
            else {
                if ($reminder == $numRows) {
                    $newIndex = $numRows -2;
                } 
                $strArr[$newIndex] .= $char;
                $newIndex--;
            }
            $i++;
        }
        
        print_r($strArr);
        $result = implode($strArr);
        
        return $result;
    }
}