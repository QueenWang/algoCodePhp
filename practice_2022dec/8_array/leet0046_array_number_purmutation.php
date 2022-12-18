<?php
// command line php xx.php
//https://leetcode.com/problems/permutations/description/
//46. Permutations



class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums) {
        $count = count($nums);
        if ($count <= 1) {
            return [$nums];
        }
        
        $lastItem = array_pop($nums);
        
        $subResult = $this->permute($nums); 
        
        $result = [];
        foreach ($subResult as $subItem) {
            //$result[] = array_merge($subItem, [$lastItem]);
            //$result[] = array_merge([$lastItem], $subItem);
            //for ($i=1; $i<count($subItem); $i++) {
            for ($i=0; $i<=count($subItem); $i++) { //here must be equal, ensure includeing left slice 0,0 (empty), right slice count(empty)
                $left = array_slice($subItem, 0, $i);
                $right = array_slice($subItem, $i);
                $result[] = array_merge($left, [$lastItem], $right);
            }
        }
        return $result;
        
    }
}

