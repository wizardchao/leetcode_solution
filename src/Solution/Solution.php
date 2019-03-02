<?php
namespace Solution;

class Solution{
  public function solve(){
    echo '111';
  }

  public function touchIndex($file){
    if(copy(__DIR__.'/problem/index.php',$file)){
      return 1;
    }
    return 0;
  }

  public function touchSolution($file){
    if(copy(__DIR__.'/problem/Solution.php',$file)){
      return 1;
    }
    return 0;
  }


}
