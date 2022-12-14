<?php
// command line php xx.php
/* https://leetcode.com/problemset/all/?page=1&topicSlugs=bit-manipulation
 * 
 */
echo "\n == add binary == \n";
$bin1 = '11';
$bin2 = '1';
echo "\n input binary string: ".$bin1.",".$bin2."\n";


$solution = new Solution();
$result1 = $solution->addBinary($bin1, $bin2); 

echo "add binary result:". $result1."\n";


/*
 *  https://leetcode.com/problems/add-binary/
 * 67. Add Binary
 * CN (having solution): https://leetcode.cn/problems/add-binary/
 * 
 * geeks https://www.geeksforgeeks.org/program-to-add-two-binary-strings/
 * 
 */

class Solution {

    /**
     * @param String $a
     * @param String $b
     * @return String
     */
    function addBinary($a, $b) {
        //thought 1: converting binary to decimal(integer) then sum, then converting baack, not working properly
        //这个方法不适用，原因主要是data type intger/decimal 都是有最大限制的， how many bits，超过这个限制就没办法了
        //运算的精细度问题,因此，为了适用于长度较大的字符串计算，我们应该使用更加健壮的算法。
        //考虑基本的加法实现，从最末尾开始，每2进一
        $aLen = strlen($a);
        $bLen = strlen($b);
        $maxLen = max($aLen, $bLen);
        
        $result = '';
        $carry = 0;
        for ($i=1; $i<=$maxLen; $i++) {
            $aCharVal = $i<=$aLen ? (int) substr($a, ($aLen-$i), 1) : 0; //get the position from left to most a
            $bCharVal = $i<=$bLen ? (int) substr($b, ($bLen-$i), 1) : 0;
            
            $sum = $aCharVal + $bCharVal + $carry;
            switch ($sum) {
                case 3:
                    $result = '1'.$result;
                    $carry = 1;
                    break;
                case 2:
                    $result = '0'.$result;
                    $carry = 1;
                    break;
                case 1:
                    $result = '1'.$result;
                    $carry = 0;
                    break;
                case 0:
                    $result = '0'.$result;
                    $carry = 0;
                    break;
            }
        }
        
        if ($carry == 1) { //remember handling last bit on the left
            $result = '1'.$result;
        }
        return $result;
    }
}