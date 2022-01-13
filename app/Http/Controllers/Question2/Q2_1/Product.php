<?php

namespace App\Http\Controllers\Question2\Q2_1;

use App\Http\Controllers\Question2\Q2_1\Pchome;
use App\Http\Controllers\Question2\Q2_1\Ruten;
use App\Http\Controllers\Question2\Q2_1\Yahoo;

class Product
{
    // 儲存訂閱電商平台
    private $subscribers;
    // 電商更新失敗名單
    private $faildUpdateSubscribers;

    // 產品新消息
    private $news = '產品A詳細資訊';

    public function __construct()
    {
        // 初始化
        $this->faildUpdateSubscribers = [];
        $this->subscribers = new \SplObjectStorage;
        // 新增Yahoo物件進入訂閱者
        $this->subscribers->attach(new Yahoo());
        // 新增Pchome物件進入訂閱者
        $this->subscribers->attach(new Pchome());
        // 新增露天物件進入訂閱者
        $this->subscribers->attach(new Ruten());
    }

    /**
     * 產品發佈調用API
     *
     * @return void
     */
    public function publish(): bool
    {
        // 電商更新失敗名單初始化
        $this->faildUpdateSubscribers = [];
        foreach ($this->subscribers as $subscriber) {
            // 更新成功處理
            if ($subscriber->update($this)) {
                echo $subscriber::name . '已收到商品發佈通知' . '<br>';
                // 更新失敗處理
            } else {
                // 紀錄電商名字
                $this->faildUpdateSubscribers[] = $subscriber::name;
            }
        }

        // 如果所有電商都沒有更新失敗回傳True，反之回傳False（判斷電商更新失敗名單）
        if (count($this->faildUpdateSubscribers) === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 取得產品新消息
     *
     * @return string
     */
    public function getNews(): string
    {
        return $this->news;
    }

}
