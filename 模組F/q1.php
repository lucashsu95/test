<?php
##最大最小值相加

// 記錄開始時間
$start_time = microtime(true);

// <-------------------main Start------------------>

$fileName = 'out.txt';
$file = fopen($fileName, "w");

$n = readline();

for($i = 0;$i < $n;$i++){
    $numbers = explode(' ',readline());
    $result = min($numbers) + max($numbers) . "\n";
    fwrite($file, $result);
}

fclose($file);

// <-------------------main End------------------>

// 記錄結束時間
$end_time = microtime(true);
// 計算間時差
$execution_time = ($end_time - $start_time) * 1000; // 毫秒
// 輸出執行時間
echo "程序执行时间为： " . round($execution_time, 2) . " 毫秒";
?>