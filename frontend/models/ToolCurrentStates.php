<?php

namespace app\models;

use Codeception\Command\Console;
use Yii;

/**
 * This is the model class for table "tool_current_states".
 *
 * @property string $name Must be unique
 * @property int $state Can be used for anything
 * @property string $state_text Assign to state. Delimiter is '|'
 */
class ToolCurrentStates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_current_states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state', 'state_text'], 'required'],
            [['state'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['state_text'], 'string', 'max' => 1024],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'state' => 'State',
            'state_text' => 'State Text',
        ];
    }
    /**
     * Returns the state and the assigned description
     */
    public function getGastroState() {
        $record = self::findOne(['name' => 'gastrostate']);
        if ($record) {
            $states = explode('|', $record->state_text);
            error_log($record->state . " ---> " . $states[$record->state] );
            return isset($states[$record->state]) ? $states[$record->state] : null;
        }
        return null;
    }
}
