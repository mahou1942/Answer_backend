<?php

namespace Tests\Feature;

use Tests\TestCase;

class question2Test extends TestCase
{
    // 測試2-1接口是否可正常執行
    public function testGet2_1()
    {
        $response = $this->get('/api/question2/2-1');
        // 是否可以正常訪問
        $response->assertStatus(200);
    }

    // 測試2-2接口是否可正常執行
    public function testGet2_2()
    {
        $response = $this->get('/api/question2/2-2');
        // 是否可以正常訪問
        $response->assertStatus(200);
    }
}
