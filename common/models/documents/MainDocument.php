<?php

namespace common\models\documents;

use common\models\Company;
use common\models\Employ;
use common\models\User;
use DocxMerge\DocxMerge;
use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "main_document".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $category_id
 * @property int|null $group_id
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property string|null $path
 * @property int|null $time_begin
 * @property int|null $time_end
 * @property string|null $code_conclusion
 * @property string|null $code_document
 * @property int|null $signed_lawyer
 * @property string|null $lawyer_conclusion_path
 * @property int|null $step
 */
class MainDocument extends \yii\db\ActiveRecord
{
    public $attached;
    public $files;
    public $deleted_files;

    const NEW = 1;
    const EDITED = 2;
    const DELETED = 9;
    const NOTSEND = 3;
    const SUCCESS = 4;
    const ERROR = 5;
    const REJECTED = 6;
    const SIGNING = 7;
    const SIGNED = 8;
    const BOSS_SIGNED = 10;
    const TOBOSS = -10;

    const STEP_BOSS = 20;
    const STEP_LAWYER = 21;
    const STEP_EMPLOYER = 22;
    const STEP_BOSS_FINISH = 23;


    public function getStatusName($status = null)
    {
        $array = [
            self::NEW => 'Yangi',
            self::EDITED => "Korib chiqilmoqda",
            self::DELETED => "O'chirilgan",
            self::NOTSEND => "Yuborilmagan",
            self::SUCCESS => "Ijobiy xulosa",
            self::ERROR => "Salbiy xulosa",
            self::REJECTED => "Rad etilgan",
            self::SIGNING => "Imzolashda",
            self::SIGNED => "Imzolandi",
            self::BOSS_SIGNED => "Rahbar Imzolandi",
            self::TOBOSS => "Rahbar imzosi",
        ];

        return $status ? $array[$status] : $array;
    }

    public static function getStatusNameArr($status = null)
    {
        $array = [
            self::NEW => 'Yangi',
            self::EDITED => "Korib chiqilmoqda",
            self::DELETED => "O'chirilgan",
//            self::NOTSEND => "Yuborilmagan",
            self::SUCCESS => "Ijobiy xulosa",
            self::ERROR => "Salbiy xulosa",
            self::REJECTED => "Rad etilgan",
            self::SIGNING => "Imzolashda",
            self::SIGNED => "Imzolandi",
        ];

        return $status ? $array[$status] : $array;
    }

    public static function getStatusNameColored($status = null)
    {
        $array = [
            self::NEW => '<div class=" badge badge-primary badge-pill">Yangi</div>',
            self::EDITED => '<div class="badge badge-info badge-pill">Korib chiqilmoqda</div>',
            self::DELETED => '<div class="badge badge-danger badge-pill">O\'chirilgan</div>',
            self::NOTSEND => '<div class="badge badge-warning badge-pill">Yuborilmagan</div>',
            self::SUCCESS => '<div class="badge badge-success badge-pill">Ijobiy xulosa</div>',
            self::ERROR => '<div class="badge badge-danger badge-pill">Salbiy xulosa</div>',
            self::REJECTED => '<div class="badge badge-info badge-pill">Rad etilgan</div>',
            self::SIGNING => '<div class="badge badge-primary badge-pill">Imzolashda</div>',
            self::SIGNED => '<div class="badge badge-success badge-pill">Imzolandi</div>',
            self::TOBOSS => '<div class="badge badge-warning badge-pill">Rahbar imzosi kutilmoqda</div>',
            self::BOSS_SIGNED => '<div class="badge badge-warning badge-pill">Rahbar tomonidan imzolandi</div>',
        ];

        return $status ? $array[$status] : $array;
    }

    public static function getStatusNameColor($status = null)
    {
        $array = [
            self::NEW => 'btn btn-inverse-secondary btn-fw',
            self::EDITED => "btn btn-inverse-primary btn-fw",
            self::DELETED => "btn btn-inverse-danger  btn-fw",
            self::NOTSEND => "btn btn-inverse-primary btn-fw",
            self::SUCCESS => "btn btn-inverse-success btn-fw",
            self::ERROR => "btn btn-inverse-warning btn-fw",
            self::REJECTED => "btn btn-inverse-light btn-fw",
            self::SIGNING => "btn btn-inverse-success btn-fw",
            self::SIGNED => "btn btn-inverse-primary btn-fw",
        ];

        return $status ? $array[$status] : $array;
    }

    public static function getStatusNameColorRound($status = null)
    {
        $array = [
            self::NEW => 'badge badge-pill badge-outline-secondary',
            self::EDITED => "  badge badge-pill badge-outline-primary",
            self::DELETED => "   btn-fw badge badge-pill badge-outline-danger",
            self::NOTSEND => "  badge badge-pill badge-outline-primary",
            self::SUCCESS => " badge badge-pill badge-outline-success",
            self::ERROR => " badge badge-pill badge-outline-warning",
            self::REJECTED => " badge badge-pill badge-outline-light",
            self::SIGNING => " badge badge-pill badge-outline-success",
            self::SIGNED => "badge badge-pill badge-outline-primary",
        ];

        return $status ? $array[$status] : $array;
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_document';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'name_uz', 'path'], 'required'],
            [['category_id', 'group_id', 'type_group_id', 'status', 'created_at', 'updated_at', 'created_by', 'time_begin', 'time_end', 'user_id', 'company_id', 'sub_category_id'], 'integer'],
            [['name_uz', 'name_ru', 'code_document', 'code_conclusion'], 'string', 'max' => 255],

            [['doc_about', 'attached', 'path', 'files', 'deleted_files', 'conclusion_uz', 'signed_lawyer', 'lawyer_conclusion_path', 'step'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
            'category_id' => 'Category ID',
            'group_id' => 'Group ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'path' => 'Path',
            'time_begin' => 'Time Begin',
            'time_end' => 'Time End',
            'code_document' => 'code_conclusion',
            'code_conclusion' => 'code_conclusion',
        ];
    }


    public function saveFiles($file = null)
    {

        $docs = json_decode($this->files, true);

        if (!empty($docs)) {
            foreach ($docs as $key => $item) {

                $doc = new AttachedDocument();
                $doc->main_document_id = $this->id;
                $doc->path = $item['path'];
//                $doc->name_ru = $item['generate_name'];
//                $doc->name_uz = $item['generate_name'];
                $doc->save();

                if (!$doc->save()) {
//                    dd($doc->errors);
                    return false;
                }

            }
        }
        return true;
    }

    public function saveFilesApi($file = null, $id)
    {

        $doc = new AttachedDocument();
        $doc->main_document_id = $id;
        $doc->path = $file['path'];
//                $doc->name_ru = $item['generate_name'];
//                $doc->name_uz = $item['generate_name'];
        $doc->save();

        if (!$doc->save()) {

            return false;
        }

        return true;
    }


    public static function getByStatusDocuments($key)
    {

        $main = MainDocument::find()->where(['status' => $key])->count();
        return $main;

    }

    public function getCategory()
    {
        return $this->hasOne(CategoryDocuments::className(), ['id' => 'category_id']);
    }

    public static function getAllCategory($doc_id = null)
    {
        $array = CategoryDocuments::find()->where(['status' => 1, 'parent_id' => null])->asArray()->all();

        if ($doc_id)
            $array = self::find()->where(['status' => 1, 'parent_id' => null, 'group_id' => $doc_id])->asArray()->all();

        return ArrayHelper::map($array, 'id', 'name_uz');
    }


    public static function subAllGetCategory()
    {
        $array = CategoryDocuments::find()
            ->where(['status' => 1])
            ->andWhere(['not', ['parent_id' => null]])
            ->asArray()
            ->all();

        return ArrayHelper::map($array, 'id', 'name_ru');
    }

    public static function subAllGroup()
    {
        $array = GroupDocuments::find()
            ->where(['status' => 1])
            ->asArray()
            ->all();

        return ArrayHelper::map($array, 'id', 'name_uz');
    }

    public static function subAllType()
    {
        $array = TypeDocuments::find()
            ->where(['status' => 1])
            ->asArray()
            ->all();

        return ArrayHelper::map($array, 'id', 'name_uz');
    }


    public static function getAllCompany()
    {
        $comp = Company::find()->all();
        return ArrayHelper::map($comp, 'id', 'name_uz');
    }

    public function getSubCategory()
    {
        return $this->hasOne(CategoryDocuments::className(), ['id' => 'sub_category_id']);
    }


    public function getGroup()
    {
        return $this->hasOne(GroupDocuments::className(), ['id' => 'group_id']);
    }

    public function getType()
    {
        return $this->hasOne(TypeDocuments::className(), ['id' => 'type_group_id']);
    }

    public function getAttach()
    {
//        dd('asd');
        return $this->hasMany(AttachedDocument::className(), ['main_document_id' => 'id']);
    }

    public function getEmploy()
    {
        return $this->hasOne(Employ::className(), ['id' => 'created_by']);
    }

    public function getLawyer()
    {
        return $this->hasOne(Employ::className(), ['id' => 'user_id']);
    }


    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {

        if (isset($changedAttributes['status']) && $this->status === self::SUCCESS) {
//            $this->generateConclusion();
//            $this->signed_lawyer = Yii::$app->user->identity->employ->id;

        }
//    dd($changedAttributes);
        if (isset($changedAttributes['status']) && $this->status === self::BOSS_SIGNED) {
//            $this->generateCheckOrder();
//            $this->margeDocs();

        }

    }

    public function beforeSave($insert)
    {

        if ($this->isNewRecord) {
            if (Yii::$app->user->identity->employ->company) {
                $this->company_id = Yii::$app->user->identity->employ->company->id;
                $this->created_by = Yii::$app->user->identity->employ->id;
                $this->generateDocCode();

            } else {
                return false;
            }
        }
//
//        $this->makeBossPDF();
//        return false;

        if ($this->oldAttributes['status'] !== $this->status && $this->status === self::SUCCESS) {
            if (Yii::$app->user->identity->employ->role == Employ::LAWYER) {
                if ($this->category) {
                    $this->generateCodes();
                    $this->generateLawyerConclusion();
                }
//                if (!$this->signed_lawyer)
//                    $this->signed_lawyer = Yii::$app->user->identity->employ->id;
            }
//            dd('asd');
            if (!$this->signed_lawyer)
                $this->signed_lawyer = Yii::$app->user->identity->employ->id;

        }

        if ($this->oldAttributes['status'] !== $this->status && $this->status === self::BOSS_SIGNED) {


            if (!$this->category && !$this->lawyer_conclusion_path) {

                $this->generateCheckOrder();

            }

            if (!$this->category && $this->lawyer_conclusion_path) {
                $this->generateSignBossDoc();
                $this->margeDocsByBoss();
//                $this->generateSignTable();
//                dd('asd');
            }

//            if (!$this->lawyer_conclusion_path)
//                $this->generateCheckOrder();

            if ($this->lawyer_conclusion_path && $this->category)
                $this->margeDocs();
        }

        return parent::beforeSave($insert);
    }

    public function generateCheckOrder()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])
            ->one();

        $user_name = Yii::$app->user->identity->employ->first_name . ' ' . Yii::$app->user->identity->employ->last_name;

        $phpWord = new PHPWord();
        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
        $domen = Url::base('https');
        $link = $domen . '/documents/d?id=' . $this->code_document;

        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode($link))
            ->setSize(430)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png');

        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png';

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/' . $item->path);
        $templateProcessor->setValue('fio', $user_name);
        $templateProcessor->setValue('date', date('d-m-Y H:i:s', $this->updated_at));
        $templateProcessor->setValue('code_doc', $this->code_document);
        $templateProcessor->setValue('code_conclusion', $this->code_conclusion);
        $templateProcessor->setImageValue('qr',
            array('path' => $img,
                'width' => 100,
                'height' => 100,
                'ratio' => true));

        //        $this->check_order = '/uploads/order/docs/' . $this->generateCheckOrderName() . '.docx';
        $filename = Yii::getAlias('@frontend') . '/web/' . $item->path;
        $templateProcessor->saveAs($filename);
        if ($filename)
            chmod($filename, 0644);
        // Make sure you have `dompdf/dompdf` in your composer dependencies.
//        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
//// Any writable directory here. It will be ignored.
//        Settings::setPdfRendererPath('vendor/hkvstore/dompdf');
//        $generateName = Yii::$app->security->generateRandomString() . uniqid();
//        $pdf_file = $generateName . '.pdf';
//        $phpWord = IOFactory::load($filename, 'Word2007');
////
//        $phpWord->save(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $pdf_file, 'PDF');
//        $this->path = '/uploads/docs/' . $pdf_file;


    }

    public function generateCodes()
    {
//        $generateDoc_Code = Yii::$app->security->generateRandomString(8);
        $generateDoc_Conclusion = Yii::$app->security->generateRandomString(9);
        if (!$this->code_conclusion)
            $this->code_conclusion = $generateDoc_Conclusion;
//        $this->code_document = $generateDoc_Code;

    }

    public function generateDocCode()
    {
        $generateDoc_Code = Yii::$app->security->generateRandomString(8);
//        $generateDoc_Conclusion = Yii::$app->security->generateRandomString(9);
//        $this->code_conclusion = $generateDoc_Conclusion;
        $this->code_document = $generateDoc_Code;

    }

    public function generateConclusion()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();

        $user_name = Yii::$app->user->identity->employ->first_name . ' ' . Yii::$app->user->identity->employ->last_name;

        $phpWord = new PHPWord();

        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);

        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode('Elektron doc'))
            ->setSize(100)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png');

        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png';

        $section = $phpWord->addSection();

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/' . $item->path);
//        $templateProcessor->setImageValue('myImage', $img);

        $templateProcessor->setValue('fio', 'asaaad');

        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/' . $item->path);
        $filename = Yii::getAlias('@frontend') . '/web/' . $item->path;
        if ($filename)
            chmod($filename, 0644);

    }

    public function generateLawyerConclusion()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();

        $user_name = Yii::$app->user->identity->employ->first_name . ' ' . Yii::$app->user->identity->employ->last_name;

        $phpWord = new PHPWord();

        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
        $domen = Url::base('https');
        $link = $domen . '/documents/d?id=' . $this->code_conclusion;
        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode($link))
            ->setSize(100)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_conclusion . '.png');

        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_conclusion . '.png';

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/uploads/templates/sign-template.docx');

        $templateProcessor->setValue('fio', $user_name);
        $templateProcessor->setValue('date', date('d-m-Y H:i:s', $this->updated_at));
        $templateProcessor->setValue('code_doc', $this->code_document);
        $templateProcessor->setValue('code_conclusion', $this->code_conclusion);
        $templateProcessor->setValue('conclusion', $this->conclusion_uz);
        $templateProcessor->setImageValue('qr',
            array('path' => $img,
                'width' => 100,
                'height' => 100,
                'ratio' => true));

        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx');
        $filename = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx';

        if ($filename)
            chmod($filename, 0644);

        $this->lawyer_conclusion_path = '/uploads/docs/' . $this->code_document . '.docx';

    }

    public function margeDocs()
    {
        $generateName = Yii::$app->security->generateRandomString() . uniqid();
        $fileExt = pathinfo($this->path, PATHINFO_EXTENSION);
        $newName = $generateName . '.' . $fileExt;

        $dm = new DocxMerge();
        $marged = $dm->merge([
            Yii::getAlias('@frontend') . '/web/' . $this->path,
            Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx'
        ], Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName);

        $this->path = '/uploads/docs/' . $newName;

        $filename = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName;
        if ($filename)
            chmod($filename, 0644);

    }

    public function margeDocsByBoss()
    {
        $generateName = Yii::$app->security->generateRandomString() . uniqid();
        $fileExt = pathinfo($this->path, PATHINFO_EXTENSION);
        $newName = $this->code_document . $generateName . '.' . $fileExt;
        $lawyer_doc = Yii::getAlias('@frontend') . '/web/' . $this->lawyer_conclusion_path;
        $sign_doc = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx';

        if (file_exists($lawyer_doc) && file_exists($sign_doc)) {

            $dm = new DocxMerge();
            $marged = $dm->merge([
                $lawyer_doc,
                $sign_doc,
            ], Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName);

            $this->lawyer_conclusion_path = '/uploads/docs/' . $newName;

            $filename = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName;
            if ($filename)
                chmod($filename, 0777);
        }

    }

    public function generateSignBossDoc()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();

        $user_name = Yii::$app->user->identity->employ->first_name . ' ' . Yii::$app->user->identity->employ->last_name;

        $phpWord = new PHPWord();

        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;

        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
        $domen = Url::base('https');
        $link = $domen . '/documents/d?id=' . $this->code_document;
        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode($link))
            ->setSize(100)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png');
        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png';

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/uploads/templates/sign-template-boss.docx');
        $templateProcessor->setValue('fio', $user_name);
        $templateProcessor->setValue('date', date('d-m-Y H:i:s', $this->updated_at));
        $templateProcessor->setValue('code_doc', $this->code_document);

        $templateProcessor->setImageValue('qr',
            array('path' => $img,
                'width' => 100,
                'height' => 100,
                'ratio' => true));

        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx');
        $filename = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx';

        if ($filename)
            chmod($filename, 0777);


    }

    public function generateSignTable()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();

        $user_name = Yii::$app->user->identity->employ->first_name . ' ' . Yii::$app->user->identity->employ->last_name;

        $phpWord = new PHPWord();

        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode('Elektron doc'))
            ->setSize(100)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_conclusion . '.png');

        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_conclusion . '.png';

        $section = $phpWord->addSection();

        $TableFontStyle = [
            'bold' => true,
            'marginTop' => '100',
            'afterSpacing' => 1,
            'Spacing' => 1,
            'cellMargin' => 1,
            'size' => 14,
            'alignItems' => 'center',
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ];

        $cellRowSpan = ['vMerge' => 'restart', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
        $cellRowContinue = ['vMerge' => 'continue'];
        $fancyTableCellBtlrStyle = ['valign' => 'center', 'alignment' => 'center'];
//        $section->addPageBreak();
        $cellColSpan = ['gridSpan' => 2,
            'alignItems' => 'center',
            'marginTop' => '100',
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
//        $fancyTableCellBtlrStyle = ['valign' => 'center', 'alignment' => 'center'];

        $section->addTextBreak(1);

//        $table = $section->addTable(['borderSize' => 1, 'borderColor' => 'black', 'afterSpacing' => 10, 'Spacing' => 10, 'cellMargin' => 100]);
        $table = $section->addTable(['marginTop' => '100', 'borderSize' => 1, 'borderColor' => 'black', 'afterSpacing' => 10, 'Spacing' => 100, 'cellMargin' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'ratio' => true]);

        $table->addRow();
//        $table->addCell(2000, $cellRowSpan)->addText('${myImage}');
//        $table->addCell(2000, $cellRowSpan)->addText("2");
//        $table->addCell(2000, $cellRowSpan)->addText('${myImage}');
        $table->addCell(2000, $cellRowSpan)->addImage($img, array('width' => 70, 'height' => 70, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'ratio' => true));
        $table->addCell(4000, $cellColSpan)->addText("Qr ni skanerlang", $TableFontStyle);
//        $table->addCell(2000, $cellRowSpan)->addText("6");
//        $templateProcessor->setComplexBlock('table_var', $table);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
//        $table->addCell(null, $cellRowContinue);

        $table->addCell(2000)->addText("FISH", $TableFontStyle);
        $table->addCell(4000)->addText($user_name, $TableFontStyle);
//        $table->addCell(null, $cellRowContinue);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText('Sana', $TableFontStyle);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText(date('d-m-Y H:i:s', $this->updated_at), $TableFontStyle);
//        $table->addCell(4000, $TableFontStyle)->addText('Sana', $TableFontStyle);
//        $table->addCell(4000, $TableFontStyle)->addText(date('d-m-Y H:i:s', $this->updated_at), $TableFontStyle);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText("Xujjat kodi", $TableFontStyle);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText($this->code_document, $TableFontStyle);
//        $table->addCell(4000, $TableFontStyle)->addText("Xujjat kodi", $TableFontStyle);
//        $table->addCell(4000, $TableFontStyle)->addText($this->code_document, $TableFontStyle);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText("Xulosa kodi", $TableFontStyle);
        $table->addCell(4000, $fancyTableCellBtlrStyle)->addText($this->code_conclusion, $TableFontStyle);
//        $section->addText($this->conclusion_uz);
//        $table->addCell(4000, $TableFontStyle)->addText("Xulosa kodi", $TableFontStyle);
//        $table->addCell(4000, $TableFontStyle)->addText($this->code_conclusion, $TableFontStyle);

        $section->addTextBreak(1);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $objWriter->save(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx');


    }

    public function makeBossPDF()
    {
        $lawyer_doc = Yii::getAlias('@frontend') . '/web/' . $this->path;
        $sign_doc = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.docx';
//
//        $converter = new OfficeConverter($lawyer_doc);
//        $converter->convertTo('output-file.pdf'); //generates pdf file in same directory as test-file.docx
//        $converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx

//        $converter = new OfficeConverter('test-file.docx', 'path-to-outdir');


//        dd($lawyer_doc);
        if (file_exists($lawyer_doc)) {

            // Make sure you have `dompdf/dompdf` in your composer dependencies.
            Settings::setPdfRendererName(Settings::PDF_RENDERER_MPDF);
// Any writable directory here. It will be ignored.
            Settings::setPdfRendererPath('.');

            $phpWord = IOFactory::load($lawyer_doc, 'Word2007');
            $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
            $xmlWriter->save('result.odt');

            dd('asd');
        }
        dd('asd');
    }


}
