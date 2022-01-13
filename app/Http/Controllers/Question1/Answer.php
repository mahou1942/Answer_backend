<?php

namespace App\Http\Controllers\Question1;

use App\Http\Controllers\Controller;

class Answer extends Controller
{

    // 計數器
    private $count;

    public function __construct()
    {
        // 初始化
        $this->count = 0;
    }

    /**
     * 計算爬N階樓梯有幾種方法（假定一次只能上1, 2次）
     *
     * @param integer $n
     * @return integer
     */
    public function calTotalWay(int $n): int
    {
        // 假設n為零或小於零，則一律回傳0（不需要上樓梯，故0種）
        if ($n <= 0) {
            return 0;
        }

        $this->count++;
        if ($n === 1) {
            return 1;
        }

        if ($n === 2) {
            return 2;
        }

        return $this->calTotalWay($n - 1) + $this->calTotalWay($n - 2);
    }

    /**
     * 執行運算
     *
     * @return void
     */
    public function runCode(int $n = 10): void
    {
        // 計數器歸零
        $this->count = 0;
        // 記憶體佔用計算開始
        $startMemory = memory_get_usage();
        // 程式運行開始
        $start = microtime(true);

        // 計算N層樓梯共幾種方法
        $answer = $this->calTotalWay($n);

        // 程式執行結束
        $end = microtime(true);
        // 記憶體佔用記錄結束
        $endMemory = memory_get_usage();

        echo "您的樓梯層數是{$n}，共有{$answer}種上樓方式！" . "<br>";
        echo "程式計算共運行{$this->count}次" . "<br>";
        echo '程式執行時間共：' . number_format($end - $start, 5) . '秒' . '<br>';
        echo '程式記憶體共佔用：' . ($endMemory - $startMemory) . 'Bytes' . '<br>';
    }
}
