<?php
$n = $_GET['factor'];
$result = [];
function fun($n,$end = 40,$count = 0){
    global $result;
    $count ++ ;
    $result[$count - 1] = $count % $n == 0 ? "$count is multiple $n" : $count;
    if(--$end){
        fun($n,$end,$count);
    }
}
fun($n);

var_dump($result);