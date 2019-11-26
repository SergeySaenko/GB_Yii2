<?php

use yii\db\Migration;

/**
 * Class m191125_220438_add_end_time
 */
class m191125_220438_add_end_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('users','endDate', $this->dateTime()->notNull()->defaultExpression();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191125_220438_add_end_time cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191125_220438_add_end_time cannot be reverted.\n";

        return false;
    }
    */
}
