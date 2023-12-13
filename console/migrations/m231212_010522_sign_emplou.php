<?php

use yii\db\Migration;

/**
 * Class m231212_010522_sign_emplou
 */
class m231212_010522_sign_emplou extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'sign', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231212_010522_sign_emplou cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_010522_sign_emplou cannot be reverted.\n";

        return false;
    }
    */
}
