<?php

namespace Tests\Unit;

use App\Http\Controllers\Question2\Q2_2\Pchome;
use App\Http\Controllers\Question2\Q2_2\Product;
use App\Http\Controllers\Question2\Q2_2\Ruten;
use App\Http\Controllers\Question2\Q2_2\Shopee;
use App\Http\Controllers\Question2\Q2_2\Yahoo;
use PHPUnit\Framework\TestCase;

class question2_2Test extends TestCase
{
    protected $Product, $Pchome, $Ruten, $Yahoo;

    public function setUp(): void
    {
        $this->Product = new Product();
        $this->Pchome = new Pchome();
        $this->Ruten = new Ruten();
        $this->Yahoo = new Yahoo();
        $this->Shopee = new Shopee();
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
