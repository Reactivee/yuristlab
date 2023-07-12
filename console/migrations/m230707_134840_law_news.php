<?php

use yii\db\Migration;

/**
 * Class m230707_134840_law_news
 */
class m230707_134840_law_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%law_news}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'icon' => $this->string(),
        ]);
        $this->createTable('{{%law_content}}', [
            'id' => $this->primaryKey(),
            'law_id' => $this->integer(),
            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'text_ru' => $this->text(),
            'text_uz' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
            'image' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230707_134840_law_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230707_134840_law_news cannot be reverted.\n";

        return false;
    }
    */
}
