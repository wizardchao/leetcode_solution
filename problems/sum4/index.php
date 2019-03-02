<?php

require_once('Solution.php');
use Solution\Solution;
$ar=[];
$solution=new Solution();
$re=$solution->sol($ar);
exit($re)