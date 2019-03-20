<?php

namespace app\controllers;

use app\models\Comment;

class ArticleController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $article = \R::findOne('mlr_content', 'alias = ? AND state = 1', [$alias]);

        if(!$article){
            throw new \Exception('Страница не найдена', 404);
        }
        $comments = new Comment();
        $articleComments = '';
        if($comments->getArticleComments($article->id)){
            $articleComments = $comments->getArticleComments($article->id);
        }
        $this->setMeta($article->title, 'Описание...', 'Ключевики...');
        $this->set(compact('article', 'articleComments'));
    }
}