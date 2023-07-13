<?php
namespace backend\modules\admin\models\rule;

use common\models\User;
use yii\rbac\Item;
use yii\rbac\Rule;

class CreaditRule extends Rule
{

    public function execute($user, $item, $params)
    {
        $user_model = User::findOne($user);
       return isset($params['creadit'])? ($params['creadit']->api_user_id === $user_model->api_user_id) : false;
    }
}