<?php

use yii\db\Migration;

/**
 * Class m191116_154858_InsertDate
 */
class m191116_154858_InsertDate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->insert('users',[
        'id'=>1,
        'email'=>'test1@test.pro',
        'passwordHash'=>'1'
      ]);
      $this->insert('users',[
        'id'=>2,
        'email'=>'test2@test.pro',
        'passwordHash'=>'1'
      ]);
      $this->batchInsert('activity',[
        'title', 'date', 'isBlocking', 'frequency', 'userId'
      ],[
        ['title1', date('Y-m-d'), 0, 0, 1],
        ['title1', date('Y-m-d'), 0, 1, 1],
        ['title1', date('Y-m-d'), 0, 2, 1],
        ['title1', date('Y-m-d'), 1, 0, 2],
        ['title1', date('Y-m-d'), 1, 2, 2],
        ['title1', '219-11-01', 1, 3, 2],
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->truncateTable('users');
    }
}
