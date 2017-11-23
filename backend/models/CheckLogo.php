<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%check_logo}}".
 *
 * @property integer $id
 * @property string $check_logo
 */
class CheckLogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%check_logo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['check_logo'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'check_logo' => '图标值',
        ];
    }
}
