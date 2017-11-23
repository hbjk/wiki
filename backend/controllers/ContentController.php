<?php
namespace backend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;


/**
 * 内容管理 controller
 */
class ContentController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 单页 action.
     *
     * @return string
     */
    public function actionPage()
    {
        $this->renderContent('page');
    }

    public function actionAdd_article()
    {
        $this->renderContent('发布文章');
    }

    public function actionArticle_list()
    {
        $this->renderContent('文章列表');
    }

    public function actionArticle_tag()
    {
        $this->renderContent('文章标签');
    }

    public function actionRecycle()
    {
        $this->renderContent('回收站');
    }
}
