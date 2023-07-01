<?php

use yii\db\Migration;

/**
 * Class m230629_190439_add_textarea
 */
class m230629_190439_add_textarea extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'type_group_id', $this->integer());
        $this->addColumn(\common\models\documents\MainDocument::tableName(), 'doc_about', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230629_190439_add_textarea cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230629_190439_add_textarea cannot be reverted.\n";

        return false;
    }
    */
}
