<?php

namespace App\Http\Controllers\Question3;

trait ApiResponse
{
    public function apiResponse(int $code = 6, bool $status = false, string $message = '', array $data = []): array
    {
        /**
         *  code（狀態碼）說明
         *  1：新增商品成功
         *  2：移除商品成功
         *  3：更新商品數量成功
         *  4：取得購物車總共價格成功
         *  5：取得購物車內項目清單列表成功
         *  6：錯誤
         */
        return ([
            'code' => $code,
            'status' => $status ? 'success' : 'error',
            'message' => $message,
            'data' => $data,
        ]);
    }
}
