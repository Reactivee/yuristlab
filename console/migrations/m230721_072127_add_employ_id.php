<?php

use yii\db\Migration;

/**
 * Class m230721_072127_add_employ_id
 */
class m230721_072127_add_employ_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\User::tableName(), 'employ_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230721_072127_add_employ_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230721_072127_add_employ_id cannot be reverted.\n";

        return false;
    }
    */
}
