<?php
/**
 * Date: 02.02.2016
 * Time: 0:01
 */

namespace mihaildev\viewReplacer;

use Yii;
use yii\helpers\ArrayHelper;


class ViewReplacer
{
    static $isInit = false;
    public static function init(){
        if(self::$isInit)
            return;

        if(empty(Yii::$app->view->theme)){
            Yii::$app->view->theme = Yii::createObject('yii\base\Theme');
        }

        if(empty(Yii::$app->view->theme->pathMap)){
            if (($basePath = Yii::$app->view->theme->getBasePath()) !== null){
                Yii::$app->view->theme->pathMap[Yii::$app->getBasePath()] = [$basePath];
            }
        }

        self::$isInit = true;
    }

    public static function replace($path, $toPath = null){
        self::init();
        if(is_array($path)){
            foreach($path as $from=>$to)
                self::replace($from, $to);
        }elseif(!empty($toPath)){
            if(empty(Yii::$app->view->theme->pathMap[$path]))
                Yii::$app->view->theme->pathMap[$path] = [];
            elseif(is_string(Yii::$app->view->theme->pathMap[$path]))
                Yii::$app->view->theme->pathMap[$path] = [Yii::$app->view->theme->pathMap[$path]];

            Yii::$app->view->theme->pathMap[$path] = ArrayHelper::merge(Yii::$app->view->theme->pathMap[$path], (array) $toPath);
        }
    }
}