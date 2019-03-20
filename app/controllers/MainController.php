<?php

namespace app\controllers;

class MainController extends AppController {

    public function indexAction()
    {
        //Недавно опубликованные материалы.
        $recentlyArticles = \R::getAll('SELECT id, title, alias, introtext, images, created FROM mlr_content ORDER BY created DESC LIMIT 3');
        $sliders = $recentlyArticles;


        $this->setMeta('Главная страница', 'Описание...', 'Ключевики...');
        $this->set(compact('recentlyArticles','sliders'));
    }

}