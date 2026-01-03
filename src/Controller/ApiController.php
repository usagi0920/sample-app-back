<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class ApiController extends Controller
{    
    public function echoMessage()
    {
        // POSTリクエストのみを許可
        $this->request->allowMethod(['post']);

        // クライアントから送られてきた 'message' を取得
        $message = $this->request->getData('message');

        // JSONレスポンスを返す
        return $this->response
            ->withStatus(200)
            ->withType('application/json') // JSONフォーマットであることを明示
            ->withStringBody(json_encode(['message' => $message],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); // レスポンスボディにメッセージを詰める
    }
}