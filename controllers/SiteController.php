<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    private $url = 'https://api.telegram.org/bot5176485026:AAErX78KRuBl0cAOdByWdLgudAdkkPQ5od0/';
    private $offset = '';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        $updates = $this->sendRequest('getUpdates', ['offset' => 476511670]);
        foreach ($updates['result'] as $update) {
            $chat_id = $update['message']['chat']['id'];
            var_dump($chat_id . PHP_EOL);
            $this->sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => 'Yaa']);
        }
        var_dump($updates);
        //return $this->render('index');
    }

    private function sendRequest($method, $params = [])
    {
        if (!empty($params)) {
            $url = $this->url . $method . '?' . http_build_query($params);
        } else {
            $url = $this->url . $method;
        }
        return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
    }
}
