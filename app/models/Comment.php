<?php

namespace app\models;


class Comment extends AppModel
{
    public $attributes = [
        'parent_id' => '0',
        'article_id' => '',
        'user_id' => '',
        'name' => '',
        'email' => '',
        'comment' => '',
        'published' => '1',
    ];

    public function getUserComments($user_id)
    {
        $commentsUser = \R::findAll('mlr_comment', 'user_id = ?', [$user_id]);
        return $commentsUser;
    }

    public function getArticleComments($article_id)
    {
        $commentsArticle = \R::getAssoc('SELECT * FROM mlr_comment WHERE article_id = ? AND published = 1', [$article_id]);
        return $commentsArticle;
    }

    public static function getAllComments()
    {
        return \R::getAssoc('SELECT * FROM mlr_comment');
    }
}