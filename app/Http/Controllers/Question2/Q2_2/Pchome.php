<?php

namespace App\Http\Controllers\Question2\Q2_2;

use App\Http\Controllers\Question2\Q2_2\Platform;

class Pchome implements Platform
{
    // 平台名字
    public const name = 'Pchome';
    // 最新產品消息
    private $news;
    /**
     * 更新通知
     *
     * @param Product $product
     * @return void
     */
    public function update(Product $product): bool
    {
        // 更新最新產品消息
        $this->news = $product->getNews();
        return true;
    }
}
