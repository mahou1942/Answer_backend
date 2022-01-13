<?php

namespace App\Http\Controllers\Question2\Q2_2;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Question2\Q2_2\Product;

class Client extends Controller
{
    // 產品
    private $product;
    // 平台
    private $yahoo, $shopee, $ruten, $pchome;

    public function __construct()
    {
        // 宣告產品
        $this->product = new Product();

        // 宣告網購平台物件
        $this->yahoo = new Yahoo();
        $this->shopee = new Shopee();
        $this->ruten = new Ruten();
        $this->pchome = new Pchome();

        // 增加訂閱者（原本已經訂閱的平台）
        $this->product->attach($this->pchome);
        $this->product->attach($this->yahoo);
        $this->product->attach($this->ruten);
    }

    public function runCode()
    {
        // 因為主管需求，進行需求變更（移除Yahoo，並新增Shopee）
        $this->product->attach($this->shopee);
        $this->product->detach($this->yahoo);
        // 產品發佈
        $this->product->publish();
    }

}
