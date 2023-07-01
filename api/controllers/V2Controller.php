<?php


namespace api\controllers;


use common\models\documents\AttachedDocument;
use common\models\User;
use Yii;

use yii\rest\Controller;

class V2Controller extends Controller
{
    public $token = 'asdasd';

    public function actionHack()
    {

//        $cv_file_content=file_get_contents('http://yurist.loc/exam.doc'));
//        $handle = fopen('http://yurist.loc/exam.doc', "r");
        return $this->token;
//        return 'http://yurist.loc/exam.doc';
//        return Yii::$app->request->post();

        // Generate a Word file first using Docx.js or any other library
//        $fileContents = 'http://yurist.loc/exam.doc'; // function to generate Word file and retrieve binary
//
//        // Create a response object and set the file as the content
//        $response = Yii::$app->response;
//        $response->format = \yii\web\Response::FORMAT_RAW;
//        $response->content = $fileContents;
//
//        // Set headers to indicate that a file is being sent as a binary attachment
//        $response->headers->add('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//        $response->headers->add('Content-Disposition', 'attachment; filename="example.docx"');
//        $response->headers->add('Content-Length', strlen($fileContents));
//
//        // Send the response
//        return $response;
//        $fileContents = file_get_contents('http://yurist.loc/helloWorld.docx');
//        return $fileContents;
//        $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
//// Adding a section to the document
//        $section = $phpWord->addSection();
//        $section->addText('Hello World!');
//
//// Saving the document as a binary
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        $objWriter->save('hello_world.docx');

// Reading the binary contents of the file
//        $fileContents = file_get_contents('hello_world.docx');
//        return [
//            'asd'
//        ];

    }


}
