<?php

use yii\db\Migration;

/**
 * Class m230808_104954_main_step
 */
class m230808_104954_main_step extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'step', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230808_104954_main_step cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230808_104954_main_step cannot be reverted.\n";

        return false;
    }
    */
}
