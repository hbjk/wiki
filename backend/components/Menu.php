<?php

namespace backend\components;

use yii;
use rmrevin\yii\fontawesome\component\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $labelTemplate = '{label}';

    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a href="{url}">{icon}<span>{label}</span>{badge}</a>';

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'sidebar-menu');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $renderedItem = parent::renderItem($item);
        if (isset($item['badge'])) {
            $badgeOptions = ArrayHelper::getValue($item, 'badgeOptions', []);
            Html::addCssClass($badgeOptions, 'label pull-right');
        } else {
            $badgeOptions = null;
        }
        return strtr(
            $renderedItem,
            [
                '{icon}' => isset($item['icon'])
                    ? new Icon($item['icon'], ArrayHelper::getValue($item, 'iconOptions', []))
                    : '',
                '{badge}' => (
                    isset($item['badge'])
                        ? Html::tag('small', $item['badge'], $badgeOptions)
                        : ''
                    ) . (
                    isset($item['items']) && count($item['items']) > 0
                        ? new Icon('fa fa-angle-left pull-right')
                        : ''
                    ),
            ]
        );
    }

    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }


//            $routeCount = count($arrayRoute);
//            if ($routeCount == 2) {
//                if ($arrayRoute[0] !== $arrayThisRoute[0]) {
//                    return false;
//                }
//            } elseif ($routeCount == 3) {
//                if ($arrayRoute[0] !== $arrayThisRoute[0]) {
//                    return false;
//                }
//                if (isset($arrayRoute[1]) && $arrayRoute[1] !== $arrayThisRoute[1]) {
//                    return false;
//                }
//            } else {
//                return false;
//            }
            $arrayRoute = explode('/',ltrim($route, '/'));
            $arrayThisRoute = explode('/',$this->route);

            $routeCount = count($arrayRoute);
            if ($routeCount == 2) {
                if ($arrayRoute[0] !== $arrayThisRoute[0]) {
                    return false;
                }
            } elseif ($routeCount == 3) {
                if ($arrayRoute[0] !== $arrayThisRoute[0]) {
                    return false;
                }
                if (isset($arrayRoute[1]) && $arrayRoute[1] !== $arrayThisRoute[1]) {
                    return false;
                }
            } else {
                return false;
            }

//            if (ltrim($route, '/') !== $this->route) {
//                return false;
//            }

            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}
