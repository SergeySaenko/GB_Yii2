<?php

use yii\db\Migration;

/**
 * Class m191125_210936_update_users
 */
class m191125_210936_update_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->update('users',
        ['passwordHash'=>\Yii::$app->security->generatePasswordHash('123456')],'id=2'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191125_210936_update_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191125_210936_update_users cannot be reverted.\n";

        return false;
    }
    */
}
