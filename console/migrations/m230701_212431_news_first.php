<?php

use yii\db\Migration;

/**
 * Class m230701_212431_news_first
 */
class m230701_212431_news_first extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_news}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createTable('{{%category_recommendation}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createTable('{{%content_news}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'text_uz' => $this->text(),
            'text_ru' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);

        $this->createTable('{{%content_recommendation}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'text_uz' => $this->text(),
            'text_ru' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
            'path' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230701_212431_news_first cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230701_212431_news_first cannot be reverted.\n";

        return false;
    }
    */
}
