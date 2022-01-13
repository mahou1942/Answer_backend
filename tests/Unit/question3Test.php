<?php

namespace Tests\Unit;

use App\Http\Controllers\Question3\ApiResponse;
use PHPUnit\Framework\TestCase;

class question3Test extends TestCase
{

    protected $ApiResponse, $ShoppingCart;

    public function setUp(): void
    {
        $this->ApiResponse = $this->getObjectForTrait(ApiResponse::class);
    }

    /**
     * 測試回傳API
     *
     * @return void
     */
    public function testApiResponse()
    {
        // 預設格式
        $response = $this->ApiResponse->apiResponse();
        $this->assertEquals($response, [
            'code' => 6,
            'status' => 'error',
            'message' => '',
            'data' => [],
        ]);

        // 測試值
        $response = $this->ApiResponse->apiResponse(0, true, 'hello', [1, 2, 3]);
        $this->assertEquals($response, [
            'code' => 0,
            'status' => 'success',
            'message' => 'hello',
            'data' => [1, 2, 3],
        ]);
    }
}
