<?php

use yii\db\Migration;
use backend\models\menu\Menus;
use backend\models\menu\MenuItems;

class m210317_052636_menus extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(Menus::tableName(), [
            'id' => $this->primaryKey(),
            'key' => $this->string(32)->notNull()->unique(),
            'name' => $this->string(32)->notNull(),
            'description' => $this->text()->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(Menus::STATUS_INACTIVE),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable(MenuItems::tableName(), [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->null(),
            'label' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'class' => $this->string()->null(),
            'icon' => $this->string()->null(),
            'description' => $this->text()->null(),
            'weight' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(MenuItems::STATUS_INACTIVE),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-menu_items-menu_id', MenuItems::tableName(), 'menu_id', Menus::tableName(), 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk-menu_items-parent_id', MenuItems::tableName(), 'parent_id', MenuItems::tableName(), 'id', 'CASCADE', 'NO ACTION');

        $this->insert(Menus::tableName(), [
            'id' => 1,
            'key' => 'admin_menu',
            'name' => 'Admin menu',
            'description' => '',
            'status' => Menus::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->batchInsert(MenuItems::tableName(),
            ['id', 'menu_id', 'parent_id', 'label', 'url', 'class', 'icon', 'description', 'weight', 'status', 'created_at', 'updated_at'],
            [
                [1, 1, NULL, 'Tools', '#', 'fa fa-tasks', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [2, 1, 1, 'Gii', '/gii', 'fa fa-code', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [3, 1, 1, 'Debug', '/debug', 'fa fa-code-fork', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [4, 1, NULL, 'Administrator', '#', 'fa fa-user-secret', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [5, 1, 4, 'Users', '/admin/user', 'fa fa-users', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [6, 1, 4, 'Roles', '/admin/role', 'fa fa-universal-access', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [7, 1, 4, 'Permissions', '/admin/permission', 'fa fa-key', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [8, 1, 4, 'Routes', '/admin/route', 'fa fa-link', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [9, 1, 4, 'Rules', '/admin/rule', 'fa fa-thumb-tack', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [10, 1, NULL, 'Translate manager', '#', 'fa fa-recycle', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [11, 1, 10, 'Languages', '/translatemanager/language/list', 'fa fa-language', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [12, 1, 10, 'Optimizer', '/translatemanager/language/optimizer', 'fa fa-spinner', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [13, 1, 10, 'Scan', '/translatemanager/language/scan', 'fa fa-search', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [14, 1, NULL, 'Contents', '#', 'fa fa-codepen', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [15, 1, 14, 'Menus', '/menu/index', 'fa fa-list', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
                [16, 1, 14, 'Files', '/site/files', 'fa fa-hdd-o', '', '', 0, MenuItems::STATUS_ACTIVE, time(), time()],
            ]
        );
    }

    public function down()
    {
        $this->dropTable(MenuItems::tableName());
        $this->dropTable(Menus::tableName());
    }
}
