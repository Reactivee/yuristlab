<?php

namespace frontend\controllers;

use common\models\CompanyTemplates;
use common\models\documents\GroupDocuments;
use common\models\documents\TypeDocuments;
use common\models\Employ;
use common\models\LoginForm;
use common\widgets\TelegramBotErrorSender;
use DocxMerge\DocxMerge;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use PhpOffice\PhpWord\IOFactory;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [

                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//        $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
//// Adding a section to the document
//        $section = $phpWord->addSection();
//        $section->addText('Hello asdasd!');
//
//// Saving the document as a binary
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        $objWriter->save('hello_world.docx');

// Reading the binary contents of the file
//        $fileContents = file_get_contents('http://yurist.loc/exam.doc');
//        dd($fileContents);
//        return $fileContents;

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
//    dd('sd');
        $model = new SignupForm();
        $this->layout = 'blank';

        if ($model->load(Yii::$app->request->post())) {

            $user = $model->signup();
            if (!$user) {
                Yii::$app->session->setFlash('error', 'Registratsiya qilishda xatolik');
//                return $this->goHome();
            }

            $employ = new Employ();
            $employ->login = $model->login;
            $employ->first_name = $model->username;
            $employ->phone = $model->phone;
            $employ->inn = $model->inn;
            $employ->passport = $model->passport;
            $employ->user_id = $user->id;
            if ($employ->save()) {
                Yii::$app->session->setFlash('success', 'Muvaffaqiyatli ro\'yhatdan o\'tdingiz');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Registratsiya qilishda xatolik');
//            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionTestpdf()
    {
        $apiKey = 'idadajon@gmail.com_fb84dbf33493fe19e821a309860d7af871023fde6eef0bac85ef6ea94752b95649caafd5';
        // Cloud API asynchronous "DOC To PDF" job example.
// Allows to avoid timeout errors when processing huge or scanned PDF documents.


// The authentication key (API Key).
// Get your own by registering at https://app.pdf.co
//        $apiKey = "***********************************";

// Direct URL of source DOC or DOCX file. Check another example if you need to upload a local file to the cloud.
        $sourceFileUrl = "https://demo.alfatechno.uz//uploads/templates/6b9BjbphmTFJoKUWnE2Hf9Gp6rD_4Ag-.docx";


// Prepare URL for `DOC To PDF` API call
        $url = "https://api.pdf.co/v1/pdf/convert/from/doc";

// Prepare requests params
        $parameters = array();
        $parameters["url"] = $sourceFileUrl;
        $parameters["async"] = true; // (!) Make asynchronous job

// Create Json payload
        $data = json_encode($parameters);

// Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// Execute request
        $result = curl_exec($curl);

        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                if (!isset($json["error"]) || $json["error"] == false) {
                    // URL of generated PDF file that will available after the job completion
                    $resultFileUrl = $json["url"];
                    // Asynchronous job ID
                    $jobId = $json["jobId"];
//        dd($resultFileUrl);
                    // Check the job status in a loop
                    do {
                        $status = $this->CheckJobStatus($jobId, $apiKey); // Possible statuses: "working", "failed", "aborted", "success".

                        // Display timestamp and status (for demo purposes)
                        echo "<p>" . date(DATE_RFC2822) . ": " . $status . "</p>";

                        if ($status == "success") {
                            // Display link to the file with conversion results
                            echo "<div>## Conversion Result:<a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                            break;
                        } else if ($status == "working") {
                            // Pause for a few seconds
                            sleep(3);
                        } else {
                            echo $status . "<br/>";
                            break;
                        }
                    } while (true);
                } else {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>";
                }
            } else {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>";
                echo "<p>" . $result . "</p>";
            }
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

// Cleanup
        curl_close($curl);
        return 'sdf';
    }

    function CheckJobStatus($jobId, $apiKey)
    {
        $status = null;

        // Create URL
        $url = "https://api.pdf.co/v1/job/check";

        // Prepare requests params
        $parameters = array();
        $parameters["jobid"] = $jobId;

        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);

        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status_code == 200) {
                $json = json_decode($result, true);

                if (!isset($json["error"]) || $json["error"] == false) {
                    $status = $json["status"];
                } else {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>";
                }
            } else {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>";
                echo "<p>" . $result . "</p>";
            }
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

        // Cleanup
        curl_close($curl);

        return $status;
    }

    public function actionTest()
    {

        $wordFile = Yii::getAlias('@frontend') . '/web/uploads/docs/test.docx';

        $htmlFile = Yii::getAlias('@frontend') . '/web/uploads/docs/test.html';


//        $phpWord = IOFactory::load($wordFile);
//        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
//        $htmlWriter->save($htmlFile);
//        dd('asd');

        // Create an instance of the mPDF class
        $mpdf = new \Mpdf\Mpdf();

// Read the Word document
        $wordContent = file_get_contents($wordFile);
//        dd($wordContent);
// Convert Word content to HTML (you may need to install a library for this, like phpword/phpword)
        $phpWord = IOFactory::load($wordFile);
//        dd($phpWord);
        $htmlContent = IOFactory::createWriter($phpWord, 'HTML');
//        $htmlContent = YourWordToHtmlConversionFunction($wordContent);

        // Add the HTML content to the mPDF instance
        $mpdf->WriteHTML($htmlFile);

// Output the PDF
        $mpdf->Output(Yii::getAlias('@frontend') . '/web/uploads/docs/test.pdf', \Mpdf\Output\Destination::FILE);
        dd('asd');
    }

    public function actionGenerate()
    {
        $template_doc = Yii::getAlias('@frontend') . '/web' . Yii::$app->user->identity->employ->company->template_doc;
        $company_id = Yii::$app->user->identity->employ->company->id;

        $group = GroupDocuments::find()->all();
        $sub_category = TypeDocuments::find()->all();

        foreach ($sub_category as $item) {
            try {
                $date = date('d.m.Y.H.i.s');
                $path = Yii::getAlias('@frontend') . '/web' . $item->path;
                $generateName = uniqid() . '-' . $date;
                if (!file_exists($path)) {
                    continue;
                }

                $fileExt = pathinfo($item->path, PATHINFO_EXTENSION);
                $newName = $generateName . '.' . $fileExt;

                $folder = '/web/uploads/company-templates/' . $company_id;
                $uploads_folder = Yii::getAlias('@frontend') . $folder;
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                $new_path = Yii::getAlias('@frontend') . $folder . '/' . $newName;
                $dm = new DocxMerge();
                $marged = $dm->merge([
                    $template_doc,
                    $path,
                ], $new_path);

                $templates = CompanyTemplates::find()
                    ->where(['category_id' => $item->id, 'company_id' => $company_id])
                    ->one();

                if (!$templates)
                    $templates = new CompanyTemplates();
                $templates->path = $folder . '/' . $newName;
                $templates->category_id = $item->id;
                $templates->company_id = $company_id;
                $templates->save();
            } catch (\Exception $e) {
                dd($e);
            }


        }
    }

    public function actionAmo()
    {
        // Получаем данные из хука
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        TelegramBotErrorSender::widget(['error' => $data, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

        dd($data);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImRmNmFhZjBmZWFkMmEzZDNlY2MxZjhiNDFkMTdhNGE5NTlkYTBiZjRjNDlhZDUwMDg1NTExNTA2MWMwNDIxODM2OTk0ZWFiODc2NWRmZTVjIn0.eyJhdWQiOiJhYTQ0ZTdmMi01OTU1LTQ1NzEtYWQ2MS0xN2ViMWU5ZTUwNjEiLCJqdGkiOiJkZjZhYWYwZmVhZDJhM2QzZWNjMWY4YjQxZDE3YTRhOTU5ZGEwYmY0YzQ5YWQ1MDA4NTUxMTUwNjFjMDQyMTgzNjk5NGVhYjg3NjVkZmU1YyIsImlhdCI6MTcxNDk1MzcyOCwibmJmIjoxNzE0OTUzNzI4LCJleHAiOjE3MTcwMjcyMDAsInN1YiI6IjEwOTk4MzQyIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxNzI3NjI2LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iLCJmaWxlcyIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiLCJwdXNoX25vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiNTVkNjNkNTctZWVjYy00ZjliLTk0ZTktNDk2MzczMjE0NDFlIn0.EX3Zyve8uAOidpf3zDviRZ5JfOsNKfqVxaN_2pQkHtbbiP0mqGgLXD4EK1a7WJJXnR8RJaM2oiTmNNUMeQvRi3ibXRlOlJAywF1dlgua6kHwgdveywz_Uc9_2YB_BISdQ-Zten-5PhrnMsr9crz1pTXfPIM5lh2JyIi4IZ0wccwIOV3dKFAeiDx3MiH2z3pu9gUMwCj0ekZtjpPjExfCXy-Mc8wBmbt6DXBcnU4mhTOiZQXdXT8HpiCSMfZJmGTKPuwUalXSXwg0SNQPp7fOc82es9sJZ5pXLY6052opwq4lG8G01I6hRuL6Pu5EVM_KwrEcqOx0rXvjdzfC6VGy5g';
        $mainUrl = 'https://idadajoninomjonov.amocrm.ru';
        $contact = '/api/v4/contacts';
        // URL для запроса списка контактов
        $url = $mainUrl . $contact;

        // Заголовки запроса
        $headers = array(
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        );

        // Отправляем GET запрос к API AmoCRM
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        // Парсим ответ и возвращаем данные
        $data = json_decode($response, true);
        dd($data);
//        dd($data['_embedded']['contacts']);

// Выводим список контактов
        foreach ($data['_embedded']['contacts'] as $contact) {
            ?>
            <table>
                <tr>
                    <th>название</th>
                    <th>ответственного</th>
                    <th>время добавления</th>
                </tr>
                <tr>
                    <td><?= $contact['name'] ?></td>
                    <td><?= $contact['responsible_user_id'] ?></td>
                    <td><?= $contact['updated_at'] ?></td>
                </tr>

                <!--            <tr>названия  </tr>-->
                <!--            <tr>новые значения  </tr>-->
                <!--            <tr>время изменения </tr>-->
            </table>
            <?php
            echo "ID: " . $contact['id'] . "\n";
            echo "Имя: " . $contact['name'] . "\n";
            echo "Email: " . $contact['custom_fields_values'][0]['values'][0]['value'] . "\n"; // Предположим, что email - это первое кастомное поле
            // Выводите остальные данные по желанию
            echo "\n";
        }
    }
}
