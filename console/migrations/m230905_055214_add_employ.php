<?php

use yii\db\Migration;

/**
 * Class m230905_055214_add_employ
 */
class m230905_055214_add_employ extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'passport', $this->string());
        $this->addColumn(\common\models\Employ::tableName(), 'inn', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230905_055214_add_employ cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230905_055214_add_employ cannot be reverted.\n";

        return false;
    }
    */
}
