<?php

namespace common\models\documents;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\faker\FixtureController;

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
    const BOSS_SIGNED = 8;

    const TOBOSS = -10;


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
            self::NOTSEND => "Yuborilmagan",
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
            self::NEW => '<div class="badge badge-outline-primary badge-pill">Yangi</div>',
            self::EDITED => '<div class="badge badge-outline-info badge-pill">Korib chiqilmoqda</div>',
            self::DELETED => '<div class="badge badge-outline-danger badge-pill">O\'chirilgan</div>',
            self::NOTSEND => '<div class="badge badge-outline-warning badge-pill">Yuborilmagan</div>',
            self::SUCCESS => '<div class="badge badge-outline-success badge-pill">Ijobiy xulosa</div>',
            self::ERROR => '<div class="badge badge-outline-danger badge-pill">Salbiy xulosa</div>',
            self::REJECTED => '<div class="badge badge-outline-info badge-pill">Rad etilgan</div>',
            self::SIGNING => '<div class="badge badge-outline-primary badge-pill">Imzolashda</div>',
            self::SIGNED => '<div class="badge badge-outline-success badge-pill">Imzolandi</div>',
            self::TOBOSS => '<div class="badge badge-outline-warning badge-pill">Rahbar imzosi</div>',
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
            [['status', 'name_uz', 'path', 'category_id', 'type_group_id'], 'required'],
            [['category_id', 'group_id', 'type_group_id', 'status', 'created_at', 'updated_at', 'created_by', 'time_begin', 'time_end', 'user_id', 'company_id'], 'integer'],
            [['name_uz', 'name_ru', 'code_document', 'code_conclusion'], 'string', 'max' => 255],

            [['doc_about', 'attached', 'path', 'files', 'deleted_files', 'conclusion_uz'], 'safe']
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

    public function getSubCategory()
    {
        return $this->hasOne(CategoryDocuments::className(), ['id' => 'group_id']);
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

    public function afterSave($insert, $changedAttributes)
    {


        if (isset($changedAttributes['status']) && $this->status === self::SUCCESS) {

            $this->generateCodes();
            $this->generateConclusion();

        }
        if (isset($changedAttributes['status']) && $this->status === self::BOSS_SIGNED) {
            $this->generateCheckOrder();
        }
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            if (Yii::$app->user->identity->employ->company)
                $this->company_id = Yii::$app->user->identity->employ->company->id;
            $this->generateDocCode();
        }

        return parent::beforeSave($insert);
    }

    public function generateCheckOrder()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();

        $user_name = Yii::$app->user->identity->username;
//        dd($user_name);
        $phpWord = new PHPWord();
        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
//        $get_img = file_get_contents($img);
        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
//        dd(Yii::getAlias('@frontend')  . $item->path);
//        $folder = '/web/uploads/docs/';
//        $uploads_folder = Yii::getAlias('@frontend') . $folder;

        /*Write qr */
        $qrCode = (new \Da\QrCode\QrCode('Elektron doc'))
            ->setSize(430)
            ->setMargin(0);

        $qrCode->writeFile(Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png');

        $img = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $this->code_document . '.png';

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/' . $item->path);

        $templateProcessor->setValue('fio', $user_name);
        $templateProcessor->setValue('date', date('d-m-Y H:i:s', $this->updated_at));
        $templateProcessor->setValue('code_doc', $this->code_document);
        $templateProcessor->setValue('code_conclusion', $this->code_conclusion);
        $templateProcessor->setImageValue('qr', $img);
//        $templateProcessor->setValue('id', $this->id);
//        $templateProcessor->setValue('code', $this->code);
//        $templateProcessor->setValue('company_name', $this->company->official_name);
//        $templateProcessor->setValue('inn', $this->company->stir);
//        $templateProcessor->setValue('adress', $this->company->address);
//        $templateProcessor->setValue('need_delivery', $this->need_deliver ? 'Да' : 'Нет');

//        $this->check_order = '/uploads/order/docs/' . $this->generateCheckOrderName() . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/' . $item->path);
//        $this->save();
    }

    public function generateCodes()
    {
//        $generateDoc_Code = Yii::$app->security->generateRandomString(8);
        $generateDoc_Conclusion = Yii::$app->security->generateRandomString(9);
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

        $user_name = Yii::$app->user->identity->employ->first_name;

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

        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/' . $item->path);

        $section = $phpWord->addSection();

        $table = $section->addTable(['alignment' => 'center', 'borderSize' => 1, 'borderColor' => 'black', 'afterSpacing' => 10, 'Spacing' => 10, 'cellMargin' => 5]);

        $TableFontStyle = ['bold' => true, 'size' => 12, 'valign' => 'text-center', 'alignment' => 'text-center'];
        $cellRowSpan = ['vMerge' => 'restart', 'alignment' => 'center'];
        $cellRowContinue = ['vMerge' => 'continue'];
        $cellColSpan = ['gridSpan' => 2, 'alignment' => 'center'];
        $fancyTableCellBtlrStyle = ['valign' => 'center', 'alignment' => 'center'];

        $table->addRow();
        $table->addCell(2000, $cellRowSpan)->addText('${myImage}');
//        $table->addCell(2000, $cellRowSpan)->addText("2");
        $table->addCell(4000, $cellColSpan)->addText("Qr ni skanerlang", $TableFontStyle);
//        $table->addCell(2000, $cellRowSpan)->addText("6");
//        $templateProcessor->setComplexBlock('table_var', $table);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
//        $table->addCell(null, $cellRowContinue);
        $table->addCell(2000)->addText("FISH", $TableFontStyle);
        $table->addCell(2000)->addText($user_name, $TableFontStyle);
//        $table->addCell(null, $cellRowContinue);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText('Sana', $TableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText( date('d-m-Y H:i:s', $this->updated_at), $TableFontStyle);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText("Xujjat kodi", $TableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText($this->code_document, $TableFontStyle);

        $table->addRow();
        $table->addCell(null, $cellRowContinue);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText("Xulosa kodi", $TableFontStyle);
        $table->addCell(2000, $fancyTableCellBtlrStyle)->addText($this->code_conclusion, $TableFontStyle);


        $break = $section->addPageBreak();
        $section->addTextBreak(1);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        $objWriter->save(Yii::getAlias('@frontend') . '/web/uploads/docs/asdaaaa.docx');


//        $templateFile = Yii::getAlias('@frontend') . '/web/uploads/docs/asd.docx';

//        $content = file_get_contents($templateFile);

        $templateProcessor->setComplexBlock('table', $table);
        $templateProcessor->setComplexBlock('break', $break);
        $templateProcessor->setValue('conclusion', 'Yurist xulosa');
        $templateProcessor->setImageValue('myImage', $img);


//        echo file_get_contents(Yii::getAlias('@frontend') . '/web/uploads/docs/asd.docx');

        /*last step*/
//        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/uploads/docs/asda.docx');
        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/' . $item->path);


//        $contents = file_get_contents(Yii::getAlias('@frontend') . '/web/uploads/docs/asda.docx');
//
//        $handle = fopen(Yii::getAlias('@frontend') . '/web/uploads/docs/asdaaaa.docx', "r");
//        $word = fopen(Yii::getAlias('@frontend') . '/web/uploads/docs/asdaaaa.docx', "w");

//        fwrite($word, $contents);
//        $copy = copy(Yii::getAlias('@frontend') . '/web/uploads/docs/asdaaaa.docx', Yii::getAlias('@frontend') . '/web/uploads/docs/asda.docx');
//        dd($copy);
    }


}
