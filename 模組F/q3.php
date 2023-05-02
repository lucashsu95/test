<?php
// 記錄開始時間
$start_time = microtime(true);

$fileName = 'out.txt';
$file = fopen($fileName, "w");
// <-------------------main Start------------------>


$k = readline();
$key = readline();
$result = '';

foreach(str_split($key) as $data){
    $val = ord($data) - $k;
    $result .= chr($val);
}
fwrite($file, $result);


// <-------------------main End------------------>
fclose($file);

// 記錄結束時間
$end_time = microtime(true);
// 計算間時差
$execution_time = ($end_time - $start_time) * 1000; // 毫秒
// 輸出執行時間
echo "程序执行时间为： " . round($execution_time, 2) . " 毫秒";
?>