<?php

namespace Tests\Feature;

use Tests\TestCase;

class question3Test extends TestCase
{
    // 測試新增商品API
    public function testAddProduct()
    {
        // 正確參數測試
        $correctData = [
            'pid' => 'test01', // 商品編號
            'name' => 'test', // 商品名稱
            'price' => 10, // 商品價格
            'num' => 1, // 商品數量
        ];

        // 錯誤參數測試
        $errorData = [
            'pid' => '', // 商品編號
            'name' => 'aaa', // 商品名稱
            'price' => -1312311100, // 商品價格
            'num' => -100123221313123, // 商品數量
        ];

        // 調用API
        $correctResponse = $this->call('POST', '/api/question3/addProduct', $correctData);
        $repeatResponse = $this->call('POST', '/api/question3/addProduct', $correctData);
        $errorData = $this->call('POST', '/api/question3/addProduct', $errorData);

        // 是否可以正常訪問＆Code狀態是否正確
        $correctResponse->assertStatus(200)->assertJsonFragment(['code' => 1, 'status' => 'success']);
        $repeatResponse->assertStatus(200)->assertJsonFragment(['code' => 6, 'status' => 'error']);
        $errorData->assertStatus(200)->assertJsonFragment(['code' => 6, 'status' => 'error']);

    }

    // 測試更新商品數量API
    public function testUpdateProductNum()
    {

        // 正確參數測試
        $correctData = [
            'pid' => 'test01', // 商品編號
            'num' => 10, // 商品數量
        ];

        // 錯誤參數測試
        $errorData = [
            'pid' => 'test05', // 商品編號
            'num' => 30, // 商品數量
        ];

        $errorData2 = [
            'pid' => '', // 商品編號
            'num' => 'G', // 商品數量
        ];

        $correctResponse = $this->call('PATCH', '/api/question3/updateProductNum', $correctData);
        $errorResponse = $this->call('PATCH', '/api/question3/updateProductNum', $errorData);
        $errorResponse2 = $this->call('PATCH', '/api/question3/updateProductNum', $errorData2);

        // 是否可以正常訪問＆Code狀態是否正確
        $correctResponse->assertStatus(200)->assertJsonFragment(['code' => 3, 'status' => 'success']);
        $errorResponse->assertStatus(200)->assertJsonFragment(['code' => 6, 'status' => 'error']);
        $errorResponse2->assertStatus(200)->assertJsonFragment(['code' => 6, 'status' => 'error']);
    }

    // 測試取得購物車總價API
    public function testGetTotalPrice()
    {
        $response = $this->get('/api/question3/getTotalPrice');
        // 是否可以正常訪問
        $response->assertStatus(200);
        // 回傳的格式是否正確
        $response->assertJsonFragment(['code' => 4, 'status' => 'success']);
    }

    // 測試取得購物車項目清單列表API
    public function getCurrentProductList()
    {
        $response = $this->get('/api/question3/getCurrentProductList');
        // 是否可以正常訪問
        $response->assertStatus(200);
        // 回傳的格式是否正確
        $response->assertJsonFragment(['code' => 5, 'status' => 'success']);
    }

    // 測試移除商品API
    public function testRemoveProduct()
    {
        $correctResponse = $this->call('DELETE', '/api/question3/removeProduct/test01');
        $errorData = $this->call('DELETE', '/api/question3/removeProduct/-123gadw');

        // 是否可以正常訪問＆Code狀態是否正確
        $correctResponse->assertStatus(200)->assertJsonFragment(['code' => 2, 'status' => 'success']);
        $errorData->assertStatus(200)->assertJsonFragment(['code' => 6, 'status' => 'error']);
    }

}
