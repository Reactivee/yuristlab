<?php

namespace frontend\controllers;

use common\models\documents\AttachedDocumentSearch;
use common\models\documents\TypeDocuments;
use common\models\documents\TypeDocumentsSearch;
use common\models\forms\CreateDocForm;
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
        $form = new CreateDocForm();
        $form->load($this->request->queryParams);

        $dataProvider = $searchModel->searchTemplate($form);
//    dd($dataProvider->models);
//        dd($this->request->queryParams);
        return $this->render('index', [
            'types' => $types,
            'dataProvider' => $dataProvider,
            'model' => $form
        ]);
    }

}
