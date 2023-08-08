<?php

use yii\db\Migration;

/**
 * Class m230807_095734_add_gr_main
 */
class m230807_095734_add_gr_main extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'sub_category_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230807_095734_add_gr_main cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230807_095734_add_gr_main cannot be reverted.\n";

        return false;
    }
    */
}
