<?php

use yii\db\Migration;

/**
 * Class m231130_225114_news_views
 */
class m231130_225114_news_views extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'views', $this->integer());
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'part', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231130_225114_news_views cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231130_225114_news_views cannot be reverted.\n";

        return false;
    }
    */
}
