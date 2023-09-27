<?php

use yii\db\Migration;

/**
 * Class m230927_081830_add_adge
 */
class m230927_081830_add_adge extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'age', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230927_081830_add_adge cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230927_081830_add_adge cannot be reverted.\n";

        return false;
    }
    */
}
