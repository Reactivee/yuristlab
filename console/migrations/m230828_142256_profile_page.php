<?php

use yii\db\Migration;

/**
 * Class m230828_142256_profile_page
 */
class m230828_142256_profile_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%about_employ}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'icon' => $this->string(),
            'img' => $this->string(),
            'key' => $this->integer(),
            'text' => $this->text(),
            'status' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230828_142256_profile_page cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230828_142256_profile_page cannot be reverted.\n";

        return false;
    }
    */
}
