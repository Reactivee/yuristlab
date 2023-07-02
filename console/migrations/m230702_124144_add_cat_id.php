<?php

use yii\db\Migration;

/**
 * Class m230702_124144_add_cat_id
 */
class m230702_124144_add_cat_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\ContentNews::tableName(), 'category_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230702_124144_add_cat_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230702_124144_add_cat_id cannot be reverted.\n";

        return false;
    }
    */
}
