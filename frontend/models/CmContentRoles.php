<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cm_content_roles".
 *
 * @property int $content_id
 * @property string $role_name
 */
class CmContentRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cm_content_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_id', 'role_name'], 'required'],
            [['content_id'], 'integer'],
            [['role_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'role_name' => 'Role Name',
        ];
    }
}
