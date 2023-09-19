<?php

use yii\db\Migration;

/**
 * Class m230918_071536_social_employ
 */
class m230918_071536_social_employ extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_employ}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'icon' => $this->string(),
            'img' => $this->string(),
            'key' => $this->integer(),
            'link' => $this->string(),
        ]);
        $this->createTable('{{%hobbies}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'icon' => $this->string(),
            'img' => $this->string(),
        ]);
        $this->addColumn('about_employ', 'begin_date', $this->integer());
        $this->addColumn('about_employ', 'end_date', $this->integer());
        $this->addColumn('about_employ', 'text_ru', $this->string());
        $this->addColumn('about_employ', 'text_uz', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230918_071536_social_employ cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230918_071536_social_employ cannot be reverted.\n";

        return false;
    }
    */
}
