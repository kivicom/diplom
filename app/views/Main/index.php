

    <div class="content-grid">
        <?php if ($recentlyArticles) :?>
            <?php foreach ($recentlyArticles as $recentlyArticle):?>
                <div class="content-grid-info">
                    <img src="images/post1.jpg" alt=""/>
                    <div class="post-info">
                        <h4><a href="article/<?=$recentlyArticle['alias']?>"><?=$recentlyArticle['title']?></a>  <?=$recentlyArticle['created']?> / 27 Comments</h4>
                        <p><?=$recentlyArticle['introtext']?></p>
                        <a href="article/<?=$recentlyArticle['alias']?>"><span></span>Читать больше</a>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>

