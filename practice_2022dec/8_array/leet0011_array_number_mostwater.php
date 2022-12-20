<?php
// command line php xx.php
//https://leetcode.com/problems/container-with-most-water/
//11. Container With Most Water


class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    
    function maxArea ($height) {
        //using two pointers, 1 from left and 1 from right
        // area = min(hi, hj) * (j-i), next pointer move away from the lower value to find potential max
        //https://leetcode.cn/problems/container-with-most-water/solutions/11491/container-with-most-water-shuang-zhi-zhen-fa-yi-do/?orderBy=most_relevant
        $max = 0;
        $count = count($height);
        
        $i=0; 
        $j=$count-1;
        while ($i < $j) {       
            if ($height[$i] <= $height[$j]) {
                $area = $height[$i] * ($j-$i);
                $i++;   
            }
            else {
                $area = $height[$j] * ($j-$i);
                $j--; 
            }
            //check max
            if ($area > $max) {
                $max = $area;
            }
            
        }
        return $max; 
        
        
    }
    function maxArea_deprecated($height) {
        
        //native idea is to search every combination, N*N
        //but out of limit
        
        $max = 0;
        $count = count($height);
        
        for ($i=0; $i<$count; $i++) {
            //check every combination
            for ($j=$i+1; $j<$count; $j++) {
                $newNum = ($j-$i) * min($height[$i], $height[$j]);
                if ($newNum > $max) {
                    $max = $newNum;
                }
            }
        }
        return $max; 
        
    }
}

