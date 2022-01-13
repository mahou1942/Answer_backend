<?php

namespace App\Http\Controllers\Question2\Q2_1;

use App\Http\Controllers\Question2\Q2_1\Platform;

class Ruten implements Platform
{
    // 平台名字
    public const name = 'Ruten';
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
