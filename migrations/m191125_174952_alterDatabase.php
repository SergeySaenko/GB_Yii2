<?php

use yii\db\Migration;

/**
 * Class m191125_174952_alterDatabase
 */
class m191125_174952_alterDatabase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->execute('ALTER DATABASE DEFAULT CHARACTER SET utf8;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191125_174952_alterDatabase cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191125_174952_alterDatabase cannot be reverted.\n";

        return false;
    }
    */
}
