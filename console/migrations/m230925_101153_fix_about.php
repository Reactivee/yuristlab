<?php

use common\models\user\AboutEmploy;
use common\models\user\SocialEmploy;
use yii\db\Migration;

/**
 * Class m230925_101153_fix_about
 */
class m230925_101153_fix_about extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(AboutEmploy::tableName(), 'employ_id', $this->integer());
        $this->addColumn(SocialEmploy::tableName(), 'employ_id', $this->integer());
        $this->addColumn(\common\models\news\LawNews::tableName(), 'link', $this->string());
        $this->addColumn(\common\models\user\Hobbies::tableName(), 'employ_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230925_101153_fix_about cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230925_101153_fix_about cannot be reverted.\n";

        return false;
    }
    */
}
