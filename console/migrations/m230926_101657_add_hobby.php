<?php

use yii\db\Migration;

/**
 * Class m230926_101657_add_hobby
 */
class m230926_101657_add_hobby extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\Employ::tableName(), 'hobby', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230926_101657_add_hobby cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230926_101657_add_hobby cannot be reverted.\n";

        return false;
    }
    */
}
