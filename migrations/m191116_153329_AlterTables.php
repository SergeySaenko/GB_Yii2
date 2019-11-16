<?php

use yii\db\Migration;

/**
 * Class m191116_153329_AlterTables
 */
class m191116_153329_AlterTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('activity','userId', $this->integer()->notNull());
      $this->addForeignKey('activityUserFK','activity','userId','users',
        'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activityUserFK','ativity');
        $this->dropColumn('activity','userId');
    }
}
