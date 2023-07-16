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
 */
class MainDocument extends \yii\db\ActiveRecord
{
    public $attached;
    public $files;
    public $deleted_files;

    const NEW = 1;
    const EDITED = 2;
    const DELETED = -1;
    const NOTSEND = 3;
    const SUCCESS = 4;
    const ERROR = 5;
    const REJECTED = 6;
    const SIGNING = 7;
    const SIGNED = 8;


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
            self::SIGNED => " w badge badge-pill badge-outline-primary",
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
            [['category_id', 'group_id', 'type_group_id', 'status', 'created_at', 'updated_at', 'created_by', 'time_begin', 'time_end'], 'integer'],
            [['name_uz', 'name_ru', 'code_document', 'code_conclusion'], 'string', 'max' => 255],
//            [['name_uz'], 'unique'],
//            [['name_ru'], 'unique'],
            [['doc_about', 'attached', 'path', 'files', 'deleted_files'], 'safe']
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

        if (isset($changedAttributes['status']) && $this->status === self::SIGNED) {
            $this->generateCheckOrder();
        }



    }

    public function generateCheckOrder()
    {
        $item = MainDocument::find()
            ->where([
                'id' => $this->id
            ])->one();
//        dd();
        $user_name = Yii::$app->user->identity->username;
//        dd($user_name);
        $phpWord = new PHPWord();
        $folder = '/web/uploads/temp/';
        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        \PhpOffice\PhpWord\Settings::setTempDir($uploads_folder);
//        dd(Yii::getAlias('@frontend')  . $item->path);
//        $folder = '/web/uploads/docs/';
//        $uploads_folder = Yii::getAlias('@frontend') . $folder;
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@frontend') . '/web/' . $item->path);

        $templateProcessor->setValue('fio', $user_name);
        $templateProcessor->setValue('date', date('d-m-Y H:i:s', $this->updated_at));
        $templateProcessor->setValue('code_doc', $this->id);
        $templateProcessor->setValue('code_conclusion', $this->id);
//        $templateProcessor->setValue('id', $this->id);
//        $templateProcessor->setValue('code', $this->code);
//        $templateProcessor->setValue('company_name', $this->company->official_name);
//        $templateProcessor->setValue('inn', $this->company->stir);
//        $templateProcessor->setValue('adress', $this->company->address);
//        $templateProcessor->setValue('need_delivery', $this->need_deliver ? 'Да' : 'Нет');
//


//        $this->check_order = '/uploads/order/docs/' . $this->generateCheckOrderName() . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@frontend') . '/web/' . $item->path);
//        $this->save();


    }


}
