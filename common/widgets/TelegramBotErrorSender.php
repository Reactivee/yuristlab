<?php

namespace common\widgets;
/**
 * Created by PhpStorm.
 */


use yii\base\Widget;
use Yii;
use yii\helpers\ArrayHelper;

class TelegramBotErrorSender extends Widget
{
    public $error;
    public $id;
    public $where;
    public $line;

    public function init()
    {
        $user = Yii::$app->user->identity->username;

        $iError = json_encode($this->error);
        $iError .= '  #' . $this->line;
//        $iError .= $this->id;

        self::sendNotify('admin', $iError, self::token['prizmalogsbot']);

    }


    public function run()
    {

    }

    public const token = [
        'yurlab' => '6231719571:AAFAIQz5SIeUdsQfEF-cK5UHtKM9nZZhMnQ',
    ];

    public static function sendNotify($key, $message, $token = self::token['yurlab'])
    {


        $data = [
            'text' => $message ?? 'Message not found',
            'chat_id' => 358681686,
            'parse_mode' => 'html'
        ];

        try {
            $res = file_get_contents("https://api.telegram.org/bot6231719571:AAFAIQz5SIeUdsQfEF-cK5UHtKM9nZZhMnQ/sendMessage?" . http_build_query($data));

        } catch (\Exception $e) {

        }
        //print_r("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
        //print_r(file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data)));


    }

}