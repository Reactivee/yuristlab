<?php

use yii\db\Migration;

/**
 * Class m230702_120802_add_path_news
 */
class m230702_120802_add_path_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'path', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230702_120802_add_path_news cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230702_120802_add_path_news cannot be reverted.\n";

        return false;
    }
    */
}
