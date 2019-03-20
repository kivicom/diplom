<?php if($allComments) : ?>
<h1>Все отзывы нашего сайта</h1>
<br>
    <div id="comments">
        <?php foreach ($allComments as $allComment) :?>
        <?php if($allComment['parent_id'] == 0): ?>
            <div class="comment_block" data-comment_id="<?=$allComment['comment_id'];?>" data-parent_id="<?=$allComment['parent_id'];?>">
                <div class="headblock">
                    <?=$allComment['comment_id'];?>
                    <div class="mc-comment-avatar-td">
                        <a href="javascript:void(0)" class="mc-comment-author">
                            <img class="mc-comment-avatar" src="https://lh4.googleusercontent.com/-B0NF3T4_p14/AAAAAAAAAAI/AAAAAAAAChc/AaoeXrjvwk8/photo.jpg" alt="Avatar">
                        </a>
                    </div>
                    <div class="username"><?=$allComment['name'];?></div>
                </div>
                <div class="mc-comment-body-inner">
                    <div class="comment"><?= $allComment['comment'];?></div>
                </div>
                <div class="mc-comment-footer">
                    <p class="message-time"><?= $allComment['date'];?></p>
                    <p class="button-answer" onclick="openEditor(<?=$allComment['comment_id'];?>)">Ответить</p>
                </div>
                <?php if(isset($allComment['childs'])): ?>
                    <?php foreach ($allComment['childs'] as $child) :?>
                        <?=$child['comment_id'] ;?>
                    <?php endforeach;?>
                <?php endif; ?>
            </div>
        <?php endif;?>
        <?php endforeach;?>
    </div>
<?php else:?>
    К сожалению, отзывов еще никто не добавил...
<?php endif;?>
