<?php

use yii\db\Migration;

/**
 * Class m200715_142504_ownerRole
 */
class m200715_142504_ownerRole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->add($auth->createRole('owner'));
        $ownerRole = $auth->getRole('owner');
        $auth->assign($ownerRole, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200715_142504_ownerRole cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200715_142504_ownerRole cannot be reverted.\n";

        return false;
    }
    */
}
