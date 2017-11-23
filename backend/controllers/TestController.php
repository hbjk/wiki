<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use app\models\WesternCheck;
use app\models\CheckLogo;
use app\models\ArticleCat;
use yii\widgets\ActiveForm;


class TestController extends Controller
{

    public $ptable;

    public function init(){
        $WesternCheck = new WesternCheck();
        $this->ptable = $WesternCheck;
    }

    //文章列表
    public function actionList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $post = $request->post();
                $test = WesternCheck::findOne($post['id']);
                $test->sort = $post['sort'];
                if (!$test->validate()){
                    throw new Exception($test->getFirstErrors());
                }
                $test->update();
                return ['done'=>true];
            }catch(Exception $e){
                return ['done'=>false,'error'=>$e->getMessage()];
            }
        }
        $p = $request->post();
        $where = $curcid = '';
        if(!empty($p)){
            $where = ($p['cat']=='0') ? '' : ['cat_id'=>$p['cat']];
            $curcid = $p['cat'];
        }
        $provider = new ActiveDataProvider([
            'query' => WesternCheck::find()
                ->JoinWith('cat')
                ->where($where)
                ->orderBy([
                    'id' => SORT_DESC,
                ]),
            'pagination' => [
                'defaultPageSize' => 12
            ]
        ]);
        $cats = ArticleCat::find()
            ->select('cid,cname')
            ->asArray()
            ->all();
        foreach ($cats as $v){
            $cat[$v['cid']] = $v['cname'];
        }
        return $this->render('list',[
            'provider' => $provider,
            'cat' => $cat,
            'cat_id' => $curcid
        ]);
    }

    //添加体检项目
    public function actionAdd()
    {
        $model = new WesternCheck();
        $cats = ArticleCat::find()
            ->select('cid,cname')
            ->asArray()
            ->all();
        foreach ($cats as $v){
            $cat[$v['cid']] = $v['cname'];
        }
        if (Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            try {
                $model->load(Yii::$app->request->post());

                if($model->save()==false){
                    $errors = array_values($model->getFirstErrors());
                    throw new Exception($errors[0]);
                }
                return ['done'=>true];
            }catch(Exception $e){
                return ['done'=>false,'error'=>$e->getMessage()];
            }
        }
        return $this->render('add',[
            'model' => $model,
            'cat' => $cat
        ]);
    }

    //更新体检项目
    public function actionUpdate($id)
    {
        $cats = ArticleCat::find()
            ->select('cid,cname')
            ->asArray()
            ->all();
        foreach ($cats as $v){
            $cat[$v['cid']] = $v['cname'];
        }


        $model = WesternCheck::findOne($id);
        if (Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            try{
                $model->load(Yii::$app->request->post());
                if($model->save()==false){
                    $errors = array_values($model->getFirstErrors());
                    throw new Exception($errors[0]);
                }
                return ['done'=>true];
            }catch (Exception $e){
                return ['done'=>false,'error'=>$e->getMessage()];
            }
        }

        return $this->render('update',[
            'model' => $model,
            'cat' => $cat
        ]);
    }

    //删除体检项目
    public function actionDel($id)
    {
        $testdata = WesternCheck::findOne($id);
        if($testdata->delete()){
            return $this->redirect('list');
        }
    }

}