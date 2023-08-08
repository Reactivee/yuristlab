<?php

use yii\db\Migration;

/**
 * Class m230807_072047_path_gr
 */
class m230807_072047_path_gr extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\GroupDocuments::tableName(), 'path', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230807_072047_path_gr cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230807_072047_path_gr cannot be reverted.\n";

        return false;
    }
    */
}
