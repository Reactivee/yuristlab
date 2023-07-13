<?php

use yii\db\Schema;
use yii\db\Migration;

class m210317_052430_i18n extends Migration
{
    /**
     * @var array The language table contains the list of languages.
     */
    protected $languages = [
        ['az-AZ', 'az', 'az', 'Azərbaycan dili', 'Azerbaijani', 0],
        ['de-DE', 'de', 'de', 'Deutsch', 'German', 0],
        ['en-US', 'en', 'us', 'English', 'English (US)', 0],
        ['en-GB', 'en', 'gb', 'English', 'English (UK)', 1],
        ['es-LA', 'es', 'la', 'Español', 'Spanish', 0],
        ['fr-FR', 'fr', 'fr', 'Français', 'French', 0],
        ['ru-RU', 'ru', 'ru', 'Русский', 'Russian', 1],
        ['tr-TR', 'tr', 'tr', 'Türkçe', 'Turkish', 0],
        ['uz-UZ', 'uz', 'uz', 'O`zbekcha', 'Uzbek', 1],
    ];

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'language_id' => Schema::TYPE_STRING . '(5) NOT NULL',
            'language' => Schema::TYPE_STRING . '(3) NOT NULL',
            'country' => Schema::TYPE_STRING . '(3) NOT NULL',
            'name' => Schema::TYPE_STRING . '(32) NOT NULL',
            'name_ascii' => Schema::TYPE_STRING . '(32) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'PRIMARY KEY (language_id)',
        ], $tableOptions);

        $this->batchInsert('{{%language}}', [
            'language_id',
            'language',
            'country',
            'name',
            'name_ascii',
            'status',
        ], $this->languages);

        $this->createTable('{{%language_source}}', [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_STRING . '(32) DEFAULT NULL',
            'message' => Schema::TYPE_TEXT,
        ], $tableOptions);

        $this->createTable('{{%language_translate}}', [
            'id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'language' => Schema::TYPE_STRING . '(5) NOT NULL',
            'translation' => Schema::TYPE_TEXT,
            'PRIMARY KEY (id, language)',
        ], $tableOptions);

        $this->createIndex('language_translate_idx_language', '{{%language_translate}}', 'language');

        $this->addForeignKey('language_translate_ibfk_1', '{{%language_translate}}', ['language'], '{{%language}}', ['language_id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('language_translate_ibfk_2', '{{%language_translate}}', ['id'], '{{%language_source}}', ['id'], 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%language_translate}}');
        $this->dropTable('{{%language_source}}');
        $this->dropTable('{{%language}}');
    }
}
