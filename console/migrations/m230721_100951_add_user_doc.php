<?php

use yii\db\Migration;

/**
 * Class m230721_100951_add_user_doc
 */
class m230721_100951_add_user_doc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'user_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230721_100951_add_user_doc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230721_100951_add_user_doc cannot be reverted.\n";

        return false;
    }
    */
}
