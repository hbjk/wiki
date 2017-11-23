<?php

/*西医体检项目模型*/
namespace frontend\models;

use yii\db\ActiveRecord;

use yii\behaviors\TimestampBehavior;

class Visitor extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public static function active($id,$user_IP)
    {
        $result = self::find()
                ->andWhere(['check_id' => $id])
                ->andWhere(['ip' => $user_IP])
                ->one();
        return $result;
    }
}