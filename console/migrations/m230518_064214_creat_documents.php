<?php

use yii\db\Migration;

/**
 * Class m230518_064214_creat_documents
 */
class m230518_064214_creat_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_documents}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%category_documents}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'group_id' => $this->smallInteger(),
            'parent_id' => $this->smallInteger(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%type_documents}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'category_id' => $this->smallInteger(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'path' => $this->string(),
        ]);
//
//        // add foreign key for table `category_documents`
//        $this->addForeignKey(
//            'fk-type_documents-category_id',
//            'type_documents',
//            'category_id',
//            'category_documents',
//            'id',
//            'CASCADE'
//        );

        $this->createTable('{{%main_document}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'category_id' => $this->smallInteger(),
            'group_id' => $this->smallInteger(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'path' => $this->string(),
            'time_begin' => $this->integer(),
            'time_end' => $this->integer(),
        ]);


        // add foreign key for table `category_documents`
//        $this->addForeignKey(
//            'fk-main_document-category_id',
//            'main_document',
//            'category_id',
//            'category_documents',
//            'id',
//            'CASCADE'
//        );

        $this->createTable('{{%attached_document}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'main_document_id' => $this->smallInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'path' => $this->string(),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230518_064214_creat_documents cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230518_064214_creat_documents cannot be reverted.\n";

        return false;
    }
    */
}
