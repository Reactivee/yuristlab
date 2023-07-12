<?php

use yii\db\Migration;

/**
 * Class m230707_120341_add_news_co
 */
class m230707_120341_add_news_co extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'sub_title_uz', $this->text());
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'sub_title_ru', $this->text());
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'conclusion_uz', $this->text());
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'conclusion_ru', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230707_120341_add_news_co cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230707_120341_add_news_co cannot be reverted.\n";

        return false;
    }
    */
}
