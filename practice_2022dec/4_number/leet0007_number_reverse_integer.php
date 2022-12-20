<?php
// command line php xx.php
//https://leetcode.com/problems/reverse-integer/


$num = -123;
echo "\n input num: ".$num."\n";

$solution = new Solution();
$result1 = $solution->reverse($num);  
echo " result:".$result1."\n";


$num2 = 2147483647;
echo "\n input num: ".$num2."\n";

$result2 = $solution->reverse($num2);  
echo " result:".$result2."\n";




class Solution {

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x) {
        //using math to resolve
        //CN https://leetcode.cn/problems/reverse-integer/solutions/211865/tu-jie-7-zheng-shu-fan-zhuan-by-wang_ni_ma/?orderBy=most_relevant
        //other ideas: convert to string, using strrev in php ==> this method is not good, not able to handle max bit properly
        
        $small = -1 * pow(2, 31); //-2147483648
        $large = pow(2, 31)-1; //2147483647
        
        echo "small=$small , large=$large \n"; 
        $reverse = 0;
        while ($x !== 0) {
            $digit = $x % 10; //get reminder
            $x = ($x-$digit)/10;
            
            echo "digit=$digit , x=$x\n";
            
            //if outside range, need to return 0;
            //as $reverse is within small-large as well, so need to check before buidling *10
            //and check /10 number first
            if ($reverse>=214748365 || ($reverse>=214748364 && $digit>7) ) {
                echo "reach boundary\n";
                return 0;
            }
            
            if ($reverse<=-214748365 || ($reverse<=-214748364 && $digit<-8) ) {
                echo "reach boundary\n";
                return 0;
            }
            
            //build reverse
            $reverse = $reverse*10 + $digit;
 
        }
        
        
        return $reverse;
    }
}