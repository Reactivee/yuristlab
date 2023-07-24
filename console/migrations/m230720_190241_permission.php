<?php

use yii\db\Migration;

/**
 * Class m230720_190241_permission
 */
class m230720_190241_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'key' => $this->string(),
            'logo' => $this->string(),
            'address' => $this->string(),
            'type' => $this->integer(),
            'official' => $this->string(),
            'desc' => $this->text(),
            'director' => $this->integer(),
            'status' => $this->smallInteger(),
        ]);

        $this->createTable('jobs', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'status' => $this->integer(),
            'key' => $this->string(),
            'desc' => $this->text(),
            'type' => $this->integer()
        ]);

        $this->createTable('employ', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'status' => $this->integer(),
            'user_id' => $this->integer(),
            'key' => $this->string(),
            'desc' => $this->text(),
            'type' => $this->integer(),
            'phone' => $this->string(),
            'photo' => $this->string(),
            'company_id' => $this->integer(),
            'role' => $this->integer(),
            'login' => $this->string()
        ]);

        $this->createTable('get_job', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'user_id' => $this->integer(),
            'employ_id' => $this->integer(),
        ]);




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230720_190241_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230720_190241_permission cannot be reverted.\n";

        return false;
    }
    */
}
