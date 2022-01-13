<?php

namespace App\Http\Controllers\Question2\Q2_2;

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
    }

    /**
     * 增加電商平台
     *
     * 遵循Solid中的依賴反轉（Dependency Inversion Principle）原則，依賴高層模組，而非低層模組，
     * 舉例來說，桌子是高層模組，方桌、圓桌是低層模組，如果依賴方桌，則使用圓桌會出錯。
     * @param Platform $platform
     * @return void
     */
    public function attach(Platform $platform): void
    {
        $this->subscribers->attach($platform);
    }

    /**
     * 移除電商平台
     *
     * 遵循Solid中的依賴反轉（Dependency Inversion Principle）原則，依賴高層模組，而非低層模組，
     * 舉例來說，桌子是高層模組，方桌、圓桌是低層模組，如果依賴方桌，則使用圓桌會出錯。
     * @param Platform $platform
     * @return void
     */
    public function detach(Platform $platform): void
    {
        $this->subscribers->detach($platform);
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
