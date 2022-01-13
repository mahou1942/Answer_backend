<?php

namespace App\Http\Controllers\Question3;

// 這邊不使用框架的Session，使用原生Session進行存取，宣告使用
session_start([
    // 設置的Cookie有效期限為一天
    'cookie_lifetime' => 86400,
]);

use App\Http\Controllers\Controller;
// response封裝（目的：統一回傳標準）
use App\Http\Controllers\Question3\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 需求：
 * 1. 新增商品
 * 2. 移除商品
 * 3. 更新商品數量
 * 4. 取得購物車總共價格
 * 5. 取得購物車內項目清單列表（顯示品名、數量、單價、總價格）
 *
 * 規定：
 * 1. 設計出「一個」PHP物件
 * 2. 使用Session作為儲存方式（這邊採前後端分離，需要注意CORS問題）
 */
class ShoppingCart extends Controller
{
    use ApiResponse;

    // 購物車總價
    private $totalCount;

    public function __construct()
    {
        // 如果Session不存在，則建立
        if (!isset($_SESSION['$productList'])) {
            $_SESSION['$productList'] = [];
        }

        // 購物車總價
        $this->totalCount = 0;

    }

    /**
     * 1. 新增商品
     *
     * @param Request $request
     * @return array
     */
    public function addProduct(Request $request): array
    {
        // 驗證
        $validator = Validator::make(
            $request->all(),
            [

                'pid' => 'required', // 商品編號
                'name' => 'required', // 商品名稱
                'price' => 'required|numeric|min:1', // 商品價格
                'num' => 'required|numeric|min:1', // 商品數量
            ],
            [
                'pid.required' => 'pid不可為空',
                'name.required' => 'name不可為空',
                'price.required' => 'price不可為空',
                'price.numeric' => 'price必須是數字',
                'price.min' => 'price最小必須是1',
                'num.required' => 'num不可為空',
                'num.numeric' => 'num必須是數字',
                'num.min' => 'num最小必須是1',
            ]
        );

        // 驗證失敗
        if ($validator->fails()) {
            return $this->apiResponse(6, false, '參數錯誤', [$validator->errors()]);
        }

        // 查找購物車是否存在商品
        $index = array_search($request->pid, array_column($_SESSION['$productList'], 'pid'));

        // 如果購物車已經存在這個商品
        if ($index !== false) {
            return $this->apiResponse(6, false, '該商品已存在購物車');
        }

        // 新增商品
        $_SESSION['$productList'][] = [
            'pid' => $request->pid,
            'name' => $request->name,
            'price' => $request->price,
            'num' => $request->num,
            'inputNum' => 1,
        ];

        return $this->apiResponse(1, true, '新增商品成功');

    }

    /**
     * 2. 移除商品
     *
     * @param string $pid
     * @return array
     */
    public function removeProduct(string $pid): array
    {
        // 查找購物車是否存在商品
        $index = array_search($pid, array_column($_SESSION['$productList'], 'pid'));

        // 如果購物車不存在這個商品，則退出
        if ($index === false) {
            return $this->apiResponse(6, false, '該商品不存在購物車');
        }

        // 移除商品
        array_splice($_SESSION['$productList'], $index, 1);

        return $this->apiResponse(2, true, '商品移除成功！');

    }

    /**
     * 3. 更新商品數量
     *
     * @param Request $request
     * @return array
     */
    public function updateProductNum(Request $request): array
    {
        // 驗證
        $validator = Validator::make(
            $request->all(),
            [

                'pid' => 'required', // 商品編號
                'num' => 'required|numeric|min:1', //商品數量
            ],
            [
                'pid.required' => 'pid不可為空',
                'num.required' => 'num不可為空',
                'num.numeric' => 'num必須是數字',
                'num.min' => 'num最小必須是1',
            ]
        );

        // 驗證失敗
        if ($validator->fails()) {
            return $this->apiResponse(6, false, '參數錯誤', [$validator->errors()]);
        }

        // 查找購物車是否存在商品
        $index = array_search($request->pid, array_column($_SESSION['$productList'], 'pid'));

        // 如果購物車不存在這個商品，則退出
        if ($index === false) {
            return $this->apiResponse(6, false, '該商品不存在購物車');
        }

        // 更新數量
        $_SESSION['$productList'][$index]['num'] = $request->num;
        return $this->apiResponse(3, true, '更新商品數量成功', $this->getCurrentProductList());
    }

    /**
     * 4. 取得購物車總共價格
     *
     * @return array
     */
    public function getTotalPrice(): array
    {
        // 計算購物車總價
        foreach ($_SESSION['$productList'] as $data) {
            // 單價 乘於 數量
            $this->totalCount += $data['price'] * $data['num'];
        }

        return $this->apiResponse(4, true, '購物車商品總價查詢成功', ['count' => $this->totalCount]);
    }

    /**
     * 取得購物車內項目清單列表（顯示品名、數量、單價、總價格）
     *
     * @return array
     */
    public function getCurrentProductList(): array
    {
        // $_SESSION['$productList'] = [];
        // 計算項目清單總價
        foreach ($_SESSION['$productList'] as $index => $data) {
            $_SESSION['$productList'][$index]['total'] = 0;
            // 單價 乘於 數量
            $_SESSION['$productList'][$index]['total'] += $data['price'] * $data['num'];
        }
        return $this->apiResponse(5, true, '商品清單查詢成功', $_SESSION['$productList']);
    }

}
