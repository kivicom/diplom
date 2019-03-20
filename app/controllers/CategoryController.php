<?php

namespace app\controllers;

use ishop\App;
use ishop\libs\Pagination;

class CategoryController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $categoryId = \R::findOne('mlr_categories','alias = ? AND published = 1', [$alias]);

        $total = \R::count('mlr_content', 'catid = ? AND state = 1 ORDER BY created DESC', [$categoryId->id]);
        $page = isset($_GET['page']) ? (int)($_GET['page']) : 1;
		
        $perpage = App::$app->getProperty('pagination');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
		
        $articles = \R::findAll("mlr_content","catid = ? AND state = 1 ORDER BY created DESC LIMIT $start, $perpage", [$categoryId->id]);
        if(!$articles){
            throw new \Exception('Страница не найдена', 404);
        }
		if($this->isAjax()){
			$this->loadView('pageajax', compact('articles', 'pagination'));
        } 
        //debug($articles);
        $this->setMeta($categoryId->title,$categoryId->metadesc, $categoryId->metakey);
        $this->set(compact('articles', 'pagination'));
    }

}