<?php

namespace Tests\Feature;

use Tests\TestCase;

class question1Test extends TestCase
{
    // 測試問題一基本題的路由是否可正常訪問
    public function testGetQuestions1Basic()
    {
        $n = rand(1, 5);
        $response = $this->get('/api/question1/basic/' . $n);
        // 是否可以正常訪問
        $response->assertStatus(200);
    }

    // 測試問題一優化題的路由是否可正常訪問
    public function testGetQuestions1Advance()
    {
        $n = rand(1, 5);
        $response = $this->get('/api/question1/advance/' . $n);
        // 是否可以正常訪問
        $response->assertStatus(200);
    }
}
