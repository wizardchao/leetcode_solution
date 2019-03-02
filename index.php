<?php

require_once('./vendor/autoload.php');

use Solution\Solution;

$param_arr = getopt('q:f:p:r');
$problems_name=$param_arr['q'];  //问题名
$fun_name=$param_arr['f']; //函数名
$param_name=$param_arr['p'];  //参数名
$rm_name=$param_arr['r'];
if (empty($problems_name) && empty($fun_name)) {
    echo json_encode(array(
    'status' => 201,
    'message' =>'参数不能为空！',
  ));
}
$solution=new Solution();
$re=$solution->solve();

if (!is_dir(__DIR__.'/problems')) {
    mkdir(__DIR__.'/problems', 0777);
}
if (!is_dir(__DIR__.'/problems/'.$problems_name)) {
    mkdir(__DIR__.'/problems/'.$problems_name, 0777);
}

if ($rm_name==1 || !file_exists(__DIR__.'/problems/'.$problems_name.'/index.php')) {
    $file=__DIR__.'/problems/'.$problems_name.'/index.php';
    $solution->touchIndex($file);
}

if ($rm_name==1 || !file_exists(__DIR__.'/problems/'.$problems_name.'/Solution.php')) {
    $file=__DIR__.'/problems/'.$problems_name.'/Solution.php';
    $solution->touchSolution($file);
}


$file=__DIR__.'/problems/'.$problems_name.'/Solution.php';
$arr=file(__DIR__.'/problems/'.$problems_name.'/Solution.php');
$arr[4] = "public function ".$fun_name."(){";
file_put_contents($file, implode("", $arr));

$file=__DIR__.'/problems/'.$problems_name.'/Solution.php';
$arr=file(__DIR__.'/problems/'.$problems_name.'/Solution.php');
$arr[4] = "public function ".$fun_name."($".$param_name."){".PHP_EOL;
file_put_contents($file, implode("", $arr));

$file=__DIR__.'/problems/'.$problems_name.'/index.php';
$arr=file(__DIR__.'/problems/'.$problems_name.'/index.php');
$arr[6] = '$'.$param_name.'=[];'.PHP_EOL;
$arr[7]="$".'solution=new Solution();'.PHP_EOL;
$arr[8] = '$'.'re=$solution->'.$fun_name.'($'.$param_name.');'.PHP_EOL;
$arr[9]='exit($'.'re)';
file_put_contents($file, implode("", $arr));
