<?php
/**
 * Created by PhpStorm.
 * User: dw
 * Date: 2017/10/13
 * Time: 16:06
 */

namespace app\models;

class N8Folder  {

    /**
     * 递归建立文件夹
     * @author abei
     */
    public static function RecursiveMkdir($path){
        if (!file_exists($path)) {
            self::RecursiveMkdir(dirname($path));
            @mkdir($path, 0777);
        }
    }

    static public function createItemPath($type = 'data',$ext='xls'){
        $year = date('Y');
        $day = date('md');
        $n = \Yii::$app->security->generateRandomString(32).'.'.$ext;
        $save_path = "{$type}/{$year}/{$day}";

        $path = 'static/'.$save_path;
        self::RecursiveMkdir($path);
        return array(
            'save_path'=>$path. '/' . $n,
            'web_path'=>$save_path. '/' . $n
        );
    }
}