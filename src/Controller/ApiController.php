<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use App\Validation\EchoMessageValidator; // 追加

class ApiController extends Controller
{    
    public function echoMessage()
    {
        // POSTリクエストのみを許可
        $this->request->allowMethod(['post']);
        // クライアントから送られてきた 'message''item' を取得
        $message = $this->request->getData('message');
        $item = $this->request->getData('item');
        $data = $this->request->getData();
        // $errors = [];

        // バリデーション
        // if (empty($data['message'])) {
        //     $errors['message'] = 'message は必須です';
        // }

        // if (empty($data['item'])) {
        //     $errors['item'] = 'item は必須です';
        // }

        // Validatorクラスを使ってバリデーションを実行
        $validator = EchoMessageValidator::getValidator();  // ← 変更: Validatorを取得
        $errors = $validator->validate($data);             // ← 変更: バリデーションを実行

        // エラーがあれば即返す
        if (!empty($errors)) {
            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'errors' => $errors,
                ], JSON_UNESCAPED_UNICODE));
        }

        // JSONレスポンスを返す（中に文字が入れられてる正常な時）
        return $this->response
            ->withStatus(200)
            ->withType('application/json') // JSONフォーマットであることを明示
            ->withStringBody(json_encode([
                'message' => $message,
                'item'=>$item,
            ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); // レスポンスボディにメッセージを詰める
    }

    public function items()
    {
        $this->request->allowMethod(['get']);

        $items = [
            ['value' => 1, 'label' => '項目1'],
            ['value' => 2, 'label' => '項目2'],
            ['value' => 3, 'label' => '項目3'],
        ];

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode(['items' => $items], JSON_UNESCAPED_UNICODE));
    }
}