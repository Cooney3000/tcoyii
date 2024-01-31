<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cm_content".
 *
 * @property int $id
 * @property string $name Content name
 * @property string $description What is this content used for? How should it be handled?
 * @property string $title This is the title, e.g. in an article
 * @property string $body This is used as the main text, e.g. the body in an article
 */
class CmContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cm_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'title', 'body'], 'required'],
            [['body'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['description', 'title'], 'string', 'max' => 512],
            [['type','img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'title' => 'Title',
            'body' => 'Body',
            'img' => 'Image',
        ];
    }
    public function getCmContentRoles()
    {
        return $this->hasMany(CmContentRoles::className(), ['content_id' => 'id'], [['type', 'img'], 'safe']);
    }
}
