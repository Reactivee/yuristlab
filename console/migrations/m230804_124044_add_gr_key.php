<?php

use yii\db\Migration;

/**
 * Class m230804_124044_add_gr_key
 */
class m230804_124044_add_gr_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\GroupDocuments::tableName(), 'key', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230804_124044_add_gr_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230804_124044_add_gr_key cannot be reverted.\n";

        return false;
    }
    */
}
