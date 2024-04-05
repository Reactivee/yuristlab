<?php

use yii\db\Migration;

/**
 * Class m240328_214034_temp_comp
 */
class m240328_214034_temp_comp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\CompanyTemplates::tableName(), 'company_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240328_214034_temp_comp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240328_214034_temp_comp cannot be reverted.\n";

        return false;
    }
    */
}
