<?php
$images = json_decode($article->images);
if (!$images->image_fulltext){
    $images->image_fulltext = 'images/post1.jpg';
}
?>
<div class="single">
    <div class="single-grid">
        <?php if ($images->image_fulltext):?>
            <img src="<?=$images->image_fulltext;?>" alt=""/>
        <?php endif;?>
        <h1><?=$article->title?></h1>
        <p><?=$article->introtext?><?=$article->fulltext?></p>
    </div>
    <ul class="comment-list">
        <h5 class="post-author_head">Written by <a href="#" title="Posts by admin" rel="author">admin</a></h5>
        <li><img src="images/avatar.png" class="img-responsive" alt="">
            <div class="desc">
                <p>View all posts by: <a href="#" title="Posts by admin" rel="author">admin</a></p>
            </div>
            <div class="clearfix"></div>
        </li>
    </ul>
    <div class="content-form">
        <h3>Оставьте комментарий</h3>
        <form method="post" action="comment/add" id="comment" role="form" data-toggle="validator">
            <div class="form-group has-feedback">
                <input class="form-control" type="text" name="name" id="name" placeholder="Имя" value="<?=isset($_SESSION['user']['name']) ? h($_SESSION['user']['name']) : '';?>" <?=isset($_SESSION['user']['name']) ? 'readonly' : '';?> required/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group has-feedback">
                <input class="form-control" type="text" name="email" id="Email" placeholder="Email" value="<?=isset($_SESSION['user']['name']) ? h($_SESSION['user']['email']) : '';?>" <?=isset($_SESSION['user']['email']) ? 'readonly' : '';?> required/>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="form-group has-feedback">
                <textarea class="form-control" name="comment" id="comment" placeholder="Комментарий" data-error="Комментарий должен быть не менее 20 символов" data-minlength="" required></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
            <input type="hidden" value="<?=$article->id?>" name="article_id" />
            <input type="hidden" value="<?=isset($_SESSION['user']['id']) ? h($_SESSION['user']['id']) : '';?>" name="user_id" />
            <input type="hidden" value="0" name="parent_id" />
            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-default" required>Оставить комментарий</button>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <?php if(!empty($articleComments)) :?>
        <div id="comments">
            <?php foreach ($articleComments as $parent => $articleComment) :?>
                <div class="comment_block" data-comment_id="<?=$articleComment['id'];?>" data-parent_id="<?=$articleComment['parent_id'];?>">
                    <div class="headblock">
                        <div class="mc-comment-avatar-td">
                            <a href="javascript:void(0)" class="mc-comment-author">
                                <img class="mc-comment-avatar" src="https://lh4.googleusercontent.com/-B0NF3T4_p14/AAAAAAAAAAI/AAAAAAAAChc/AaoeXrjvwk8/photo.jpg" alt="Avatar">
                            </a>
                        </div>
                        <div class="username"><?= $articleComment['name'];?></div>
                    </div>
                    <div class="mc-comment-body-inner">
                        <div class="comment"><?= $articleComment['comment'];?></div>
                    </div>
                    <div class="mc-comment-footer">
                        <p class="message-time"><?= $articleComment['date'];?></p>
                        <p class="button-answer" onclick="openEditor(<?= $articleComment['id'];?>)">Ответить</p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    <div class="clearfix"></div>
</div>