<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article_cat}}".
 *
 * @property integer $cid
 * @property string $name
 * @property integer $pid
 * @property integer $sort
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class ArticleCat extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['cname'], 'string', 'max' => 50],
            [['hidden_fields'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => '编号',
            'cname' => '名称',
            'fid' => '上级id',
            'sort' => '排序',
            'status' => '状态',
            'hidden_fields' => '需隐藏字段',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }
}
