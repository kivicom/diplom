<?php

namespace app\widgets\categ;

use ishop\App;
use ishop\Cache;

class Categories
{
    protected $data_c;
    protected $data_i;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'div';
    protected $class = 'category';
    protected $table_c = 'mlr_categories';
    protected $table_i = 'mlr_contents';
    protected $cache = 3600;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = [])
    {
        $this->tpl = __DIR__ . '/categ_tpl/categ.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);

        if(!$this->menuHtml){
            $this->data_c = App::$app->getProperty('cats');
            $this->data_i = App::$app->getProperty('items');

            if(!$this->data_c){
                $this->data_c = $cats = \R::getAssoc("SELECT id, title, alias FROM mlr_categories WHERE published = 1 ORDER BY created_time DESC LIMIT 5");
            }
            if(!$this->data_i){
                $this->data_i = $items = \R::getAssoc("SELECT id, catid, title, alias FROM mlr_content WHERE state = 1 ORDER BY created DESC");
            }
            $this->tree = $this->getTree();

            $this->menuHtml = $this->getMenuHtml($this->tree);

            if($this->cache){
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }

        }
        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        if(!empty($this->attrs)){
            foreach($this->attrs as $k => $v){
                $attrs .= " $k='$v' ";
            }
        }
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function getTree()
    {
        $tree = [];
        $data_c = $this->data_c;
        $data_i = $this->data_i;
        foreach ($data_c as $cid=>&$node){
            foreach ($data_i as $iid=>&$unit){
                if (!in_array($unit['catid'], $node) ){
                    $tree[$cid] = &$node;
                }
                if (in_array($unit['catid'], $unit)){
                    $data_c[$unit['catid']]['childs'][$iid] = &$unit;
                }
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        $cnt = 0;
        foreach($tree as $id => $category){
            if($cnt < 5) {
                $str .= $this->catToTemplate($category, $tab, $id);
            }
            $cnt++;
        }

        return $str;
    }

    protected function catToTemplate($category, $tab, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}