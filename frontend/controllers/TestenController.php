<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\WesternCheck;
use frontend\models\Visitor;
use frontend\models\ArticleCat;

class TestenController extends Controller
{
    public $ptable;
    static $test = array();

    public function init()
    {
        $WesternCheck = new WesternCheck();
        $this->ptable = $WesternCheck;
    }

    //new page
    public function actionIndex()
    {

        //default member
        $id = 1;

        //all second sorts
        $sorts = ArticleCat::allSorts();

        //default western medicine
        $view = Yii::$app->view->params['name'] = '西医';
        $view = Yii::$app->view->params['sorts'] = $sorts;
        $testdatas = WesternCheck::allfind($id);

        return $this->render('index', [
            'testdatas' => $testdatas,
            'sorts' => $sorts,
        ]);

    }

    public function actionPage($id)
    {
        $testone = $this->ptable->findOne($id);
        if(!$testone) {
            return $this->redirect('/');
        }
        $user_IP = Yii::$app->request->userIP;
        //浏览量，同一个ip同一天登陆等于一个浏览量
        if($user_IP) {
            $result = Visitor::active($id, $user_IP);
        }
        if($result) {
            if(time() - $result['updated_at'] > 24 * 3600) {
                $result->updated_at = time();
                $result->save(false);
                $testone->views++;
                $testone->save();
            }
        } else {
            $visitor = new Visitor();
            $visitor->ip = $user_IP;
            $visitor->check_id = $id;
            $visitor->save(false);
            $testone->views++;
            $testone->save();
        }
        $testdatas = $this->ptable->active($id);
        $this->layout = "nav-main";
        return $this->render('page', [
            'testone' => $testone,
            'testdatas' => $testdatas
        ]);
    }


    //old page
    public function actionOld()
    {
        $view = Yii::$app->view->params['name'] = '西医';
        $testdatas = $this->ptable->allfind();

        return $this->render('old', [
            'testdatas' => $testdatas,
        ]);
    }

    public function actionPagen($id)
    {
        $testone = $this->ptable->findOne($id);

        if (!$testone) {
            return $this->redirect('/');
        }

        $user_IP = Yii::$app->request->userIP;

        //浏览量，同一个ip同一天登陆等于一个浏览量
        if ($user_IP) {
            $result = Visitor::active($id, $user_IP);
        }

        if ($result) {

            if (time() - $result['updated_at'] > 24 * 3600) {
                $result->updated_at = time();
                $result->save(false);

                $testone->views++;
                $testone->save();
            }

        } else {
            $visitor = new Visitor();
            $visitor->ip = $user_IP;
            $visitor->check_id = $id;
            $visitor->save(false);

            $testone->views++;
            $testone->save();
        }

        $testdatas = $this->ptable->active($id);

        return $this->render('pagen', [
            'testone' => $testone,
            'testdatas' => $testdatas
        ]);
    }

    public function actionError()
    {
        return $this->redirect('/');
    }

    public function actionHealth($id)
    {
        $timearr = [
            'beginToday' => mktime(0, 0, 0, date('m'), date('d'), date('Y')), //获取今日开始时间戳和结束时间戳
            'beginYesterday' => mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')), //获取昨日起始时间戳和结束时间戳
            'beginweek' => time() - 7 * 24 * 60 * 60, //获取一周内起始时间戳和结束时间戳
            'beginmonth' => time() - 30 * 24 * 60 * 60, //获取一月内起始时间戳和结束时间戳
        ];

        //qiniu config
        $qiniu = Yii::$app->params['qiniu'];

        //all articles
        $allarticles = WesternCheck::oneSortArticles($id);

        //all second sorts
        $sorts = ArticleCat::allSorts();

        $view = Yii::$app->view->params['name'] = '养生';
        $view = Yii::$app->view->params['sorts'] = $sorts;
        return $this->render('health', [
            'allarticles' => $allarticles,
            'qiniu' => $qiniu,
            'timearr' => $timearr,
        ]);

    }

    //24 solar terms
    public function actionSolar()
    {
        $this->layout = "nav-main";

        return $this->render('solar');
    }
}