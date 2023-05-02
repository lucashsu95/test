<?php
##質數判斷

// 記錄開始時間
$start_time = microtime(true);

// <-------------------main Start------------------>

$fileName = 'out.txt';
$file = fopen($fileName, "w");


function prime($val){
    for($i = 2;$i<($val ** 0.5) + 1;$i++){
        if($val % $i == 0){
            return 'N';
        }
    }
    return 'Y';
}

$n = readline();

for($i = 0;$i < $n;$i++){
    $result = prime(readline()) . "\n";
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