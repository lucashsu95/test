<?php
##身分證檢驗

// 記錄開始時間
$start_time = microtime(true);

$fileName = 'out.txt';
$file = fopen($fileName, "w");
// <-------------------main Start------------------>

$Lary = ['I', 'O', 'W', 'Z'];

$code = str_replace($Lary, [34, 35, 32, 33], readline());
$flag = 10;
for($i = 0 ; $i < 26 ; $i++){
    $val = chr($i + 65);
    if(!in_array($val,$Lary)){
        $code = str_replace($val, $flag,$code);
        $flag ++;
    }
}

$Lstr = substr($code,1,strlen($code) - 2);

$sum = $code[0] + $code[strlen($code) - 1];

for($i = 0,$j = 9 ; $i < 9 ; $i++,$j--){
    $sum += $Lstr[$i] * $j;
}

$result = $sum % 10 === 0 ? 'Y' : 'N';

echo $result;

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