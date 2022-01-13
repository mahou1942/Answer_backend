<?php

namespace Tests\Unit;

use App\Http\Controllers\Question1\Answer2;
use App\Http\Controllers\Question1\Answer;
use PHPUnit\Framework\TestCase;

class question1Test extends TestCase
{
    protected $answer, $answer2;

    public function setUp(): void
    {
        $this->answer = new Answer();
        $this->answer2 = new Answer2();
    }

    /**
     * 測試計算爬N階樓梯有幾種方法（基本版）（假定一次只能上1, 2次）API是否正常
     *
     * @return void
     */
    public function testAnswerCalTotalWay()
    {
        $this->assertEquals($this->answer->calTotalWay(1), 1);
        $this->assertEquals($this->answer->calTotalWay(10), 89);
        $this->assertEquals($this->answer->calTotalWay(0), 0);
        $this->assertEquals($this->answer->calTotalWay(-3), 0);
    }

    /**
     * 測試計算爬N階樓梯有幾種方法（優化版）（假定一次只能上1, 2次）API是否正常
     *
     * @return void
     */
    public function testAnswer2CalTotalWay()
    {
        $this->assertEquals($this->answer2->calTotalWay(1), 1);
        $this->assertEquals($this->answer2->calTotalWay(10), 89);
        $this->assertEquals($this->answer2->calTotalWay(0), 0);
        $this->assertEquals($this->answer2->calTotalWay(-3), 0);
    }
}
