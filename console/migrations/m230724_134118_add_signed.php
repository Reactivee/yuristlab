<?php

use yii\db\Migration;

/**
 * Class m230724_134118_add_signed
 */
class m230724_134118_add_signed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'signed_lawyer', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230724_134118_add_signed cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230724_134118_add_signed cannot be reverted.\n";

        return false;
    }
    */
}
