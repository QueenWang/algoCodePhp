<?php
// command line php xx.php
/*
 * sorting leetcode https://leetcode.com/problemset/all/?topicSlugs=sorting&page=1 
 */

$arr = [2,0,2,1,1,0]; 
echo "\n input array: ".implode(',',$arr)."\n";


echo "\n == testing sort algo == \n";
$solution = new Solution();
$solution->sortColors($arr); //use pointer, which will change the origional array 
echo "sort result:".implode(',',$arr)."\n";

$arr2= [1,0];
echo "\n input array: ".implode(',',$arr2)."\n";
$solution->sortColors($arr2);
echo "sort color result:".implode(',',$arr2)."\n";

/*
 * https://leetcode.com/problems/sort-colors/
 * 75. Sort Colors
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        
        //$this->threeColorSort($nums);
        $this->threeColorSortV2($nums);
    } 
    
    //based on 3 values only 0, 1, 2
    function threeColorSort (&$nums) {
       //sort 0, find and swap to left
        $leftWallIndex = 0;
        for ($i=0; $i<count($nums); $i++) {
            if ($nums[$i] == 0 ) {
                if ($leftWallIndex != $i) {
                    //swap
                    $nums[$i] = $nums[$leftWallIndex];
                    $nums[$leftWallIndex] = 0;
                }
                $leftWallIndex++;
            }
        }
        
        //sort 1
        for ($i=$leftWallIndex; $i<count($nums); $i++) {
            if ($nums[$i] == 1) {
                if ($leftWallIndex != $i ) {
                    //swap
                    $nums[$i] = $nums[$leftWallIndex];
                    $nums[$leftWallIndex] = 1;
                }
                $leftWallIndex++;
            }
        }
        
        //no need to sort 2, rest is 2
    }
    
    
    //based on 3 values only 0, 1, 2
    //using one loop to traverse
    function threeColorSortV2 (&$nums) {
       //sort 0, find and swap to left
        $p0Index = -1;
        $p1Index = -1;
        for ($i=0; $i<count($nums); $i++) {
            if ($nums[$i] == 0 ) {
                $p0Index++;
                $p1Index++;
                if ($p0Index != $i) {
                    if ($p1Index > $p0Index) {
                        //swap $p0Index to $p1Index
                        $nums[$p0Index] = $nums[$p1Index];
                        $nums[$p1Index] = 1;                             
                    }
                    if ($p1Index != $i) {
                        //swap $p0Index to i
                        $nums[$i] = $nums[$p0Index];
                        $nums[$p0Index] = 0;
                    }
                }
                
            }
            else if ($nums[$i] == 1 ) {
                $p1Index++;
                if ($p1Index != $i) {
                    //swap
                    $nums[$i] = $nums[$p1Index];
                    $nums[$p1Index] = 1;
                }
                
            }
        }   
        //no need to sort 2, rest is 2
    }
    
    
}