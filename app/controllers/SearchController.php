<?php

namespace app\controllers;

class SearchController extends AppController{

    public function typeaheadAction(){
        if($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if($query){
                $articles = \R::getAll('SELECT id, title FROM mlr_content WHERE title LIKE ? LIMIT 11', ["%{$query}%"]);
                echo json_encode($articles);
            }
        }
        die;
    }

    public function indexAction()
    {
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query){
            $articles = \R::find('mlr_content', "title LIKE ?", ["%{$query}%"]);
        }
        $this->setMeta('Поиск по: ' . h($query));
        $this->set(compact('articles', 'query'));
    }

}