<?php

use yii\db\Migration;

/**
 * Class m231212_223144_court_doc
 */
class m231212_223144_court_doc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'court_doc', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231212_223144_court_doc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_223144_court_doc cannot be reverted.\n";

        return false;
    }
    */
}
