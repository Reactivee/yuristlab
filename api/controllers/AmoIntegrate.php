<?php

public
function actionAmo()
{
    $res = Yii::$app->request->post();
    // Формируем текст примечания

    if ($res['leads']['add'] || $res['contacts']['add']) {
        $card = $res['contacts']['add'] ? $res['contacts']['add'][0] : $res['leads']['add'][0];
        $note_text = "Создана карточка: " . $card['name'] . "\n";
        $note_text .= "Ответственный: " . $card['responsible_user_id'] . "\n";
        $note_text .= "Время добавления: " . date("Y - m - d H:i:s", $card['last_modified']);
    } else {
        $card = $res['contacts']['update'] ? $res['contacts']['update'][0] : $res['leads']['update'][0];
        $note_text = "Изменения в карточке:" . $card['name'] . "\n";
        $note_text .= "Время изменения: " . date("Y - m - d H:i:s", $card['last_modified']);
    }

    // Save data to a text file
    $file = 'webhook_data.txt';
    $current = file_get_contents($file);
    $current .= $note_text . "\n\n";
    file_put_contents($file, $current);


}