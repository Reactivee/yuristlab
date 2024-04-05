<?php

use yii\db\Migration;

/**
 * Class m240328_212915_templates_base
 */
class m240328_212915_templates_base extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_templates}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'group_id' => $this->integer(),
            'path' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240328_212915_templates_base cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240328_212915_templates_base cannot be reverted.\n";

        return false;
    }
    */
}
