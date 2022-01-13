<?php

namespace Tests\Unit;

use App\Http\Controllers\Question2\Q2_1\Pchome;
use App\Http\Controllers\Question2\Q2_1\Product;
use App\Http\Controllers\Question2\Q2_1\Ruten;
use App\Http\Controllers\Question2\Q2_1\Yahoo;
use PHPUnit\Framework\TestCase;

class question2_1Test extends TestCase
{
    protected $Product, $Pchome, $Ruten, $Yahoo;

    public function setUp(): void
    {
        $this->Product = new Product();
        $this->Pchome = new Pchome();
        $this->Ruten = new Ruten();
        $this->Yahoo = new Yahoo();

    }

    // 測試Pchome更新是否正常
    public function testPchomeUpdate()
    {
        $this->assertEquals($this->Pchome->update($this->Product), true);
    }

    // 測試Ruten更新是否正常
    public function testRutenUpdate()
    {
        $this->assertEquals($this->Ruten->update($this->Product), true);
    }

    // 測試Yahoo更新API是否正常
    public function testYahooUpdate()
    {
        $this->assertEquals($this->Yahoo->update($this->Product), true);
    }

    // 測試取得產品發布API是否正常
    public function testProductPublish()
    {
        $this->assertEquals(($this->Product->publish()), true);
    }

    // 測試取得產品消息API是否正常
    public function testProductGetNews()
    {
        // 測試回傳必須是字串
        $this->assertEquals(gettype($this->Product->getNews()), 'string');
    }

}
