<?php

use yii\db\Migration;

/**
 * Class m230630_212332_sub_Cat
 */
class m230630_212332_sub_Cat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sub_category_documents}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string()->notNull()->unique(),
            'name_ru' => $this->string()->notNull()->unique(),
            'parent_id' => $this->smallInteger(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230630_212332_sub_Cat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230630_212332_sub_Cat cannot be reverted.\n";

        return false;
    }
    */
}
