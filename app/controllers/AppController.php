<?php

namespace app\controllers;

use app\models\AppModel;
use ishop\base\Controller;
use ishop\App;
use ishop\Cache;

class AppController extends Controller{

    public function __construct($route){
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('cats', self::cacheCategory());
        App::$app->setProperty('items', self::cacheItems());
    }

    public static function cacheCategory(){
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        $cache->set('cats','');
        if(!$cats){
            $cats = \R::getAssoc("SELECT id, title, alias FROM mlr_categories WHERE published = 1 ORDER BY created_time DESC LIMIT 5");
            $cache->set('cats', $cats);
        }
        return $cats;
    }

    public static function cacheItems(){
        $cache = Cache::instance();
        $items = $cache->get('items');
        $cache->set('items','');
        if(!$items){
            $items = \R::getAssoc("SELECT id, catid, title, alias FROM mlr_content WHERE state = 1 ORDER BY created DESC");
            $cache->set('items', $items);
        }
        return $items;
    }

}