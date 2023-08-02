<?php

use yii\db\Migration;

/**
 * Class m230802_113900_lawyer_conc
 */
class m230802_113900_lawyer_conc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'lawyer_conclusion_path', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230802_113900_lawyer_conc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230802_113900_lawyer_conc cannot be reverted.\n";

        return false;
    }
    */
}
