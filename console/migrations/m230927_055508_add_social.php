<?php

use yii\db\Migration;

/**
 * Class m230927_055508_add_social
 */
class m230927_055508_add_social extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'instagram', $this->string());
        $this->addColumn(\common\models\Employ::tableName(), 'telegram', $this->string());
        $this->addColumn(\common\models\Employ::tableName(), 'facebook', $this->string());
        $this->addColumn(\common\models\Employ::tableName(), 'other', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230927_055508_add_social cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230927_055508_add_social cannot be reverted.\n";

        return false;
    }
    */
}
