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
      $this->addColumn('activity','endDate', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('activity','endDate');
    }
}
