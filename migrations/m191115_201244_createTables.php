<?php

use yii\db\Migration;

/**
 * Class m191115_201244_createTables
 */
class m191115_201244_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('activity', [
        'id'=>$this->primaryKey(),
        'title'=>$this->string(150)->notNull(),
        'description'=>$this->text(),
        'date'=>$this->dateTime()->notNull(),
        'time'=>$this->time(),
        'isBlocking'=>$this->boolean()->notNull()->defaultValue(0),
        'frequency'=>$this->integer()->notNull()->defaultValue(0),
        'reminder'=>$this->boolean(),
        'email'=>$this->string('150'),
        'file'=>$this->string('200'),
        'createAt'=> $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
      ]);

      $this->createTable('users', [
        'id'=>$this->primaryKey(),
        'email'=>$this->string('150')->notNull(),
        'passwordHash'=>$this->string('150'),
        'authKey'=>$this->string('150'),
        'token'=>$this->string('150'),
        'createAt'=> $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
      ]);

      $this->createIndex('emailUniqueIndex','users','email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }
}
