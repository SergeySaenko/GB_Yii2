<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $time
 * @property int $isBlocking
 * @property int $frequency
 * @property int $reminder
 * @property string $email
 * @property string $file
 * @property string $createAt
 * @property int $userId
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date', 'userId'], 'required'],
            [['date', 'time', 'createAt'], 'safe'],
            [['isBlocking', 'frequency', 'reminder', 'userId'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['file'], 'string', 'max' => 200],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'isBlocking' => Yii::t('app', 'Is Blocking'),
            'frequency' => Yii::t('app', 'Frequency'),
            'reminder' => Yii::t('app', 'Reminder'),
            'email' => Yii::t('app', 'Email'),
            'file' => Yii::t('app', 'File'),
            'createAt' => Yii::t('app', 'Create At'),
            'userId' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }
}
