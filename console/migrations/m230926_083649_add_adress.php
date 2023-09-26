<?php

use yii\db\Migration;

/**
 * Class m230926_083649_add_adress
 */
class m230926_083649_add_adress extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'address', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230926_083649_add_adress cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230926_083649_add_adress cannot be reverted.\n";

        return false;
    }
    */
}
