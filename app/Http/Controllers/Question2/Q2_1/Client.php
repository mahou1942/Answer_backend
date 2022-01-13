<?php

namespace App\Http\Controllers\Question2\Q2_1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Question2\Q2_1\Product;

class Client extends Controller
{
    // 產品
    private $product;

    public function __construct()
    {
        // 建立產品
        $this->product = new Product();
    }

    public function runCode()
    {
        // 產品發佈
        $this->product->publish();
    }

}
