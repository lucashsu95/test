<?php
// 记录开始时间
$start_time = microtime(true);

$fileName = 'out.txt';
$file = fopen($fileName, "w");

// <-------------------main Start------------------>

$code = str_replace(['I', 'O', 'W', 'Z'], [34, 35, 32, 33], readline());
$code = str_pad($code, 10, '0');
$sum = $code[0] + $code[9];
for ($i = 8, $j = 2; $i >= 1; $i--, $j++) {
    if (array_key_exists($j, $code)) {
        $sum += $code[$j] * $i;
    }
}
$result = ($sum % 10 === 0) ? 'Y' : 'N';
fwrite($file, $result);

// <-------------------main End------------------>


fclose($file);

// 记录结束时间
$end_time = microtime(true);
// 计算时间差
$execution_time = ($end_time - $start_time) * 1000; // 毫秒
// 输出执行时间
echo "程序执行时间为： " . round($execution_time, 2) . " 毫秒";
