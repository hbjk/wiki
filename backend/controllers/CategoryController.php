<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;



/**
 * Category controller
 */
class CategoryController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

//        //获取uploadToken
//        $hbPublicToken = Yii::$app->cache->get('hbpublictoken');
//        if(empty($hbPublicToken)){
//            $hbPublicToken = $qiniu->getUploadToken('hbpublic');
//            Yii::$app->cache->set('hbpublictoken', $hbPublicToken, 3600);
//        }
//        $filesystem = $qiniu->getDisk('hbpublic');
////        $filesystem->writeStream($path,$stream,$token)
//        dump($hbPublicToken);

        exit;
        return $this->render('index');
    }

}
