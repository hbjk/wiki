<?php

/*西医体检项目模型*/
namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\ArticleCat;

class WesternCheck extends ActiveRecord
{
    //与图标关联
    public function getCheckLogo()
    {
        return $this->hasOne(CheckLogo::className(),['id' => 'check_logo_id']);
    }

    //与分类关联
    public function getArticleCat()
    {
        return $this->hasOne(ArticleCat::className(),['cid' => 'cat_id']);
    }

    public static function active($id)
    {
        $result = self::find()
                        ->where(['!=', 'id', $id])
                        ->orderBy('created_at DESC')
                        ->limit(5)
                        ->all();
        return $result;
    }

    //某栏目无子分类下所有文章
    public static function allfind($id)
    {
        $result = self::find()
                        ->where(['cat_id' => $id])
                        ->orderBy([
                        'sort' => SORT_ASC
                        ])->all();

        return $result;
    }

    //无限极
    public static function catetree($id)
    {

        $cateres = ArticleCat::find()->all();
        $arr = self::sort($cateres,$id);
        return $arr;

    }

    //无限极具体方法
    public static function sort($data,$id=0)
    {

        static $arr = array();

        foreach ($data as $k => $v) {
            if($v['fid'] == $id)
            {
                $arr[] = $v['cid'];
                self::sort($data,$v['cid']);
            }
        }

        return $arr;
    }

    //某个栏目下所有文章
    public static function oneSortArticles($id)
    {

        $arr = self::catetree($id);
        $articlesarr = [];

        foreach($arr as $a)
        {
            $result = self::find()
                ->where(['cat_id' => $a])
                ->all();

            $sort = ArticleCat::find()
                            ->select(['cname'])
                            ->where(['cid'=>$a])
                            ->one();

            $cname = $sort -> cname;
            $articlesarr[$cname] = $result;
        }

        return $articlesarr;
    }
}