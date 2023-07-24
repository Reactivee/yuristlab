<?php

use yii\db\Migration;

/**
 * Class m230721_111650_company_id_main
 */
class m230721_111650_company_id_main extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'company_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230721_111650_company_id_main cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230721_111650_company_id_main cannot be reverted.\n";

        return false;
    }
    */
}
