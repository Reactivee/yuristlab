<?php

use yii\db\Migration;

/**
 * Class m230716_095457_col_doc
 */
class m230716_095457_col_doc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'code_document', $this->string());
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'code_conclusion', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230716_095457_col_doc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230716_095457_col_doc cannot be reverted.\n";

        return false;
    }
    */
}
