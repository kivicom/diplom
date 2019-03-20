<?php

namespace app\controllers;

use app\models\Comment;

class CommentController extends AppController
{
    public function addAction()
    {
        //debug($_POST); die('CommentController');
        if(!empty($_POST)){
            $comment = new Comment();
            $data = $_POST;
            $comment->load($data);
            if(!$comment->validate($data)){
                $comment->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                if($comment_id = $comment->save('mlr_comment')){
                    $_SESSION['success'] = 'Комментарий успешно добавлен!';
                    foreach($comment->attributes as $k => $v){
                        $_SESSION['comment'][$k] = $v;
                    }
                }else{
                    $_SESSION['error'] = 'При добавлении комментария возникла ошибка!';
                }
            }
            redirect();
        }
    }

    public function reviewAction()
    {
        $allComments = $this->getTree();

        debug($allComments);

        $this->setMeta('Отзывы', 'Все отзывы...', 'Отзывы...');
        $this->set(compact('allComments'));
        return $allComments;
    }


    protected function getTree(){
        $tree = [];
        $allComments = Comment::getAllComments();
        if(!$allComments){
            throw new \Exception('Страница не найдена', 404);
        }
        foreach ($allComments as $id=>&$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $allComments[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

}