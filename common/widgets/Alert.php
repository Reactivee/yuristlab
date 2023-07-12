<?php

namespace common\widgets;

use simialbi\yii2\toastr\Toastr;
use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap4\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [

        'error' => Toastr::TYPE_ERROR,
        'danger' => Toastr::TYPE_WARNING,
        'success' => Toastr::TYPE_SUCCESS,
        'info' => Toastr::TYPE_INFO,
        'warning' => Toastr::TYPE_WARNING,

    ];
    /**
     * @var array the options for rendering the close button tag.
     * Array will be passed to [[\yii\bootstrap\Alert::closeButton]].
     */
    public $closeButton = [];


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $flash) {

            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array)$flash as $i => $message) {

                echo Toastr::widget([
                    'type' => $this->alertTypes[$type],
                    'title' => $message,
                    'message' => '',
                    'closeButton' => true,
                    'debug' => false,
                    'newestOnTop' => false,
                    'positionClass' => Toastr::POSITION_TOP_FULL_WIDTH,
                    'progressBar' => true

                ]);
//                echo \yii\bootstrap4\Alert::widget([
//                    'body' => $message,
//                    'closeButton' => $this->closeButton,
//                    'options' => array_merge($this->options, [
//                        'id' => $this->getId() . '-' . $type . '-' . $i,
//                        'class' => $this->alertTypes[$type] . $appendClass,
//                    ]),
//                ]);
            }

            $session->removeFlash($type);
        }
    }
}
