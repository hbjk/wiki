<?php

/*西医体检项目模型*/
namespace frontend\models;

use yii\db\ActiveRecord;

class ArticleCat extends ActiveRecord
{
    //与文章关联
    public function getWesternCheck()
    {
        return $this->hasMany(WesternCheck::className(),['cid' => 'cat_id']);
    }

    // all second sorts
    public static function allSorts()
    {

        $result = self::find()
                        ->andFilterWhere(['fid'=> 0])
                        ->andFilterWhere(['!=', 'cid', 0])
                        ->all();

        return $result;
    }
}