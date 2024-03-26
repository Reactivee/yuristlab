<?php

use yii\db\Migration;

/**
 * Class m240325_233235_company_info
 */
class m240325_233235_company_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Company::tableName(), 'post', $this->string());
        $this->addColumn(\common\models\Company::tableName(), 'bank', $this->string());
        $this->addColumn(\common\models\Company::tableName(), 'schot', $this->string());
        $this->addColumn(\common\models\Company::tableName(), 'mfo', $this->string());
        $this->addColumn(\common\models\Company::tableName(), 'stir', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240325_233235_company_info cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240325_233235_company_info cannot be reverted.\n";

        return false;
    }
    */
}
