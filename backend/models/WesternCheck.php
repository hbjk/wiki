<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class WesternCheck extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%western_check}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios(); // TODO: 不同分类定义不同场景

        $scenarios['xiyi'] = ['name', 'cat_id', 'slug', 'check_logo_id', 'cover', 'introduce', 'views', 'sort', 'created_at', 'updated_at'];
        $scenarios['slng'] = ['name', 'cat_id', 'slug', 'check_logo_id', 'cover', 'introduce', 'views', 'sort', 'created_at', 'updated_at'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'introduce', 'sort', 'cat_id'], 'required'],
            [['name','check_logo_id'], 'string', 'min' => 2, 'max' => 30],
            ['slug', 'string', 'min' => 2, 'max' => 100],
            ['sort', 'integer', 'min' => 0, 'max' => 10000],
            ['check_logo_id', 'default', 'value' => null],
            ['cover', 'default', 'value' => null],
            ['introduce', 'string', 'min' => 100, 'max' => 65535],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => '分类编号',
            'name' => '标题',
            'slug' => '描述',
            'check_logo_id' => '图标',
            'cover' => '封面图',
            'introduce' => '文章内容',
            'views' => '浏览量',
            'sort' => '排序',
            'created_at' => '添加时间',
            'updated_at' => '修改时间'
        ];
    }

    public function getCheckLogo()
    {
        return $this->hasOne(CheckLogo::className(), ['id' => 'check_logo_id']);
    }

    public function getCat()
    {
        return $this->hasOne(ArticleCat::className(), ['cid' => 'cat_id']);
    }
}