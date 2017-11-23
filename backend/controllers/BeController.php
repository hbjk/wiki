<?php
namespace backend\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UserForm;
use yii\widgets\ActiveForm;


/**
 * Be controller
 */
class BeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => [
                    'login',
                    'logout',
                    'error',
                    'login_validate',
                    'maintenance',
                    'index',
                    'captcha',
                    'login_ajax',
                ],
                'rules' => [
                    [
                        'actions' => ['error', 'maintenance', 'captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'login_validate', 'login_ajax'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4,
                'height' => 44,
                'offset' => -3
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
    public function actionCia()
    {
        $url = Url::to(['system/user/list',  'sort'=>'mobile_num']);
        var_dump($url);
        var_dump(Url::to(['system/user/list', 'search' => '18']));

        var_dump(Url::to(['post/view', 'id' => '18', 'title'=>"text"]));
        var_dump(Url::to(['post/view', 'title' => 'text']));
        return $this->renderContent('cia'.$_GET['a']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new UserForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $this->layout='main-login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogin_ajax()
    {
        if (!Yii::$app->request->isAjax){
            return $this -> goHome();
        }

        $model = new UserForm();
        if(($model->load(Yii::$app->request->post())) && $model->login()) {
            echo json_encode(['status', '200']);
        }
    }

    public function actionLogin_validate()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new UserForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * 开启catchALL后默认页
     *
     * @return string
     */
    public function actionMaintenance()
    {
        return $this->renderPartial('maintenance');
    }

}
