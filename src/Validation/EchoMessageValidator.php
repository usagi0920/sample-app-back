<?php
declare(strict_types=1);

namespace App\Validation;

use Cake\Validation\Validator;

class EchoMessageValidator
{
    public static function getValidator(): Validator
    {
        $validator = new Validator();
        $validator
            ->requirePresence('message', true, 'message は必須です') // フィールドが存在しない場合のエラー
            ->notEmptyString('message', 'message は必須です'); // 空文字列ではないかチェック
        $validator
            ->requirePresence('item', true, 'item は必須です')
            ->notEmptyString('item', 'item は必須です');

        return $validator;
    }
}