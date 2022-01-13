<?php

namespace App\Http\Controllers\Question2\Q2_1;

interface Platform
{
    /**
     * 更新平台狀況
     *
     * @param Product $product 產品物件
     * @return void
     */
    public function update(Product $product): bool;
}
