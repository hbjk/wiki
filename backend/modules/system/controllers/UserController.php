<?php

namespace app\modules\system\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * Default controller for the `system` module
 */
class UserController extends Controller
{
    public function actionList()
    {
        if(\Yii::$app->request->get('search')) {
            $keyword = \Yii::$app->request->get('search');
            $where = [
                'or',
                ['like', 'username', $keyword],
                ['like', 'mobile_num', $keyword],
            ];
            $provider = new ActiveDataProvider([
                'query' => User::find()
                    ->where($where)
                    ->andWhere([User::tableName() . '.status' => User::STATUS_ACTIVE])
                    ->orderBy(['id'=>SORT_DESC]),
            ]);
            $provider->setSort(false);
        }else{
            $users = User::find()->orderBy(['id'=>SORT_DESC]);
            $provider = new ActiveDataProvider([
                'query' => $users,
            ]);
            $provider->setSort(false);
        }

        return $this->render('list', [
                'provider' => $provider,
                'search' => isset($keyword) ? $keyword : '',
            ]);
    }

    public function actionAdd()
    {
        return $this->renderContent('添加会员');
    }

//    public function actionUser_search()
//    {
//        $keyword = \Yii::$app->request->post('search');
//
//        $where = [
//            'or',
//            ['like', 'username', $keyword],
//            ['like', 'mobile_num', $keyword],
//        ];
//        $modelDataProvider = new ActiveDataProvider([
//            'query' => User::find()
//                ->orderBy('id desc')
//                ->where([User::tableName() . '.status' => User::STATUS_ACTIVE])
//                ->andWhere($where),
//            'pagination' => [
//                'pageSize' => 2
//            ],
//        ]);
//
//        return $this->render('list', ['provider'=>$modelDataProvider, 'search'=>$keyword]);
//exit;
//
//        $lists = User::find()
//            ->where([
//                User::tableName() . '.status' => User::STATUS_ACTIVE
//            ])
//            ->andWhere([
//                'or',
//                ['like', 'username', $keyword],
//                ['like', 'mobile_num', $keyword],
//            ]);
//        $count = $lists->count();
//        $pagination = new Pagination([
//            'pageSize' => 2,
//            'totalCount' => $count,
//        ]);
//        $list = $lists->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//
//        var_dump($list);
//        var_dump($pagination);
//        exit;
//
//        if(($m->load(\Yii::$app->request->post(), '')) && ($m->search!=='')){
//
//            User::find()
//                ->where([
//                    User::tableName() . '.status' => User::STATUS_ACTIVE
//                ])
//                ->andWhere([
//                    'or',
//                    ['like', 'username', $m->search],
//                    ['like', 'mobile_num', $m->search],
//                ]);
//            $search = new Search([
//                'defaultOrder' => ['id' => SORT_DESC],
//                'model' => User::className(),
//                'scenario' => 'default',
////            'relations' => ['comment' => []], // 关联表（可以是Model里面的关联）
//                'partialMatchAttributes' => ['mobile_num','username'], // 模糊查询
//                'pageSize' => 4
//            ]);
//            $dataProvider = $search->search([
//                'Search' => [
//                    'mobile_num'=>$m->search,
//                    'username'=>$m->search
//                ]
//            ]);
//            $dataProvider->query->andWhere([
//                User::tableName() . '.status' => User::STATUS_ACTIVE
//            ]);
//            return $this->render('list', ['provider'=>$dataProvider, 'search'=>$m->search]);
//        } else {
//            return $this->redirect(['user/list']);
//        }
//    }

    public function actionRole()
    {
        return $this->render('role');
    }

    public function actionPermission()
    {
        return $this->renderContent('Permission');
    }
}
