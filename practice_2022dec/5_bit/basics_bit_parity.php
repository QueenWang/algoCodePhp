<?php
// command line php xx.php
/*
 * parity是奇数偶数的意思,
 * from LX: parity bit，校检位， 背景是传输的时候check所有bit的sum，加多一个parity bit作为checksum，判定传输的准确性
 * https://www.geeksforgeeks.org/finding-the-parity-of-a-number-efficiently/?ref=gcse
 * Note: Parity of a number is used to define if the total number of set-bits(1-bit in binary representation) 
 * in a number is even or odd. If the total number of set-bits in the binary representation of 
 * a number is even then the number is said to have even parity, otherwise, it will have odd parity
 * 
 * PHP bitwise operation, number input output is integer, but computation is based on bit. 
 * check examples
 * Computation will convert integer to bit and compute, then convert back to decimal integer for output
 * & : AND
 * | : OR
 * ^: exclusive OR, 1 or 0 case, 1^1 will be 0
 * 
 * bit shift
 * $a >> $n: integer $a bits shift $n steps to the right
 * $a << $n: to the left
 * 
 * 负数表达方式, complement all postive integer bits, and also +1
 * https://en.wikipedia.org/wiki/Two%27s_complement
 */

echo "\n == compuate parity bit == \n";
$num = 9;
echo "\n input number: ".$num."\n";
 echo decbin($num)."\n";

 $num2 = -9;
echo "\n input number: ".$num2."\n";
 echo decbin($num2)."\n";
 
 //return;
$solution = new Solution();
$result1 = $solution->computeParityBit($num); 

echo "result:". $result1."\n";



$result2 = $solution->computeParityBit($num2); 

echo "result:". $result2."\n";


class Solution {

    /**
     * @param integer $a
     * @return integer
     */
    function computeParityBit($num) {
        //idea is to use bitwise operation, check each bit parity from right to left
        //shift bit out by 1 position to to the right
        $count = 0;
        $binStr = decbin($num);
        $binLen = strlen($binStr);
        echo "binary length = ".$binLen."\n";
        
        for ($i=1; $i<=$binLen; $i++) { //using bit number length to end loop, do not do value condition like $number value
            //echo $num."= bin ".decbin($num)."\n";
            $setBit = $num & 1; //return 0 or 1
            $count += $setBit;
            $num = $num >> 1; //shift to right by 1 step, note negative number has signed bit
        }
        
        $isOdd = $count & 1; //last bit is 1 then odd (result is 1)
        
       return $isOdd;
    }
}