<?php

namespace frontend\controllers;

use common\models\documents\AttachedDocumentSearch;
use common\models\documents\TypeDocuments;
use common\models\documents\TypeDocumentsSearch;
use Yii;
use yii\web\Controller;
use common\models\LoginForm;


/**
 * Site controller
 */
class TemplatesController extends Controller
{


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $types = TypeDocuments::find()->all();
        $searchModel = new TypeDocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'types' => $types,
            'dataProvider' => $dataProvider
        ]);
    }

}
