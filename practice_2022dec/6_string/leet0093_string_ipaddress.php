<?php
// command line php xx.php
/*
 * https://leetcode.com/problems/restore-ip-addresses/?company_slug=bytedance
 */

$str1 = "25525511135";
echo "input $str1 \n";
$solution = new Solution();
$result1 = $solution->restoreIpAddresses($str1);
echo "result is ".json_encode($result1)."\n";

class Solution {

    /**
     * @param String $s
     * @return String[]
     */
    function restoreIpAddresses($s) {
        $result = [];
        $length = strlen($s);
        echo "length=$length \n";
        if ($length < 4 || $length > 12) { //
            return $result;
        }
        
        //get possible length combinations first
        $lenParts =[];
        for ($len1=1; $len1<=3; $len1++) {
            $leftover = $length-$len1;
            if ($leftover>=3 && $leftover <= 9 ) {
                for ($len2=1; $len2<=3; $len2++) {
                    $leftover = $length-$len1-$len2;
                    if ($leftover>=2 && $leftover <= 6 ) {
                        for ($len3=1; $len3<=3; $len3++) {
                            $leftover = $length-$len1-$len2-$len3;
                            if ($leftover>=1 && $leftover <= 3) {
                                $len4 = $leftover;
                                $lenParts[] = [$len1, $len2, $len3, $len4];
                            }
                        }
                    } 
                }
            }   
        }
        
        print_r($lenParts);
        //validate values
       foreach ($lenParts as $i => $items) {
           $startPos = 0;
           $isValid = TRUE;
           $ipFull = NULL;
           foreach ($items as $lenVal) {
               $ip = substr($s, $startPos, $lenVal);
               $startPos+=$lenVal;
               if (!$this->isValidIp($ip, $lenVal)) {
                   $isValid = FALSE;
                   break;
               }
               $ipFull = isset($ipFull) ? $ipFull.".".$ip : $ip;
           }
           if ($isValid) {
               $result[] = $ipFull;
           }
       } 
            
        return $result;
        
    }
    
    function isValidIp ($str, $len) {
        if ($len > 3 || $len < 1) {
            return false;
        }
        if (strval($str) > 255) {
            return false;
        }
        
        if ($len > 1 && substr($str, 0, 1) == '0') {
            return false;
        }
        return true;
    }
}