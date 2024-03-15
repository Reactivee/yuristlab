<?php

use yii\db\Migration;

/**
 * Class m240314_223447_add_template
 */
class m240314_223447_add_template extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Company::tableName(), 'template_doc', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240314_223447_add_template cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240314_223447_add_template cannot be reverted.\n";

        return false;
    }
    */
}
