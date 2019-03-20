<div class="container">
    <div class="content-grids">
        <div class="col-md-12 content-main">
            <div class="content-grid">
                <?php if(!empty($articles)): ?>
                    <?php foreach ($articles as $article):?>
                        <div class="content-grid-info">
                            <img src="images/post1.jpg" alt=""/>
                            <div class="post-info">
                                <h4><a href="article/<?=$article['alias']?>"><?=$article['title']?></a>  <?=$article['created']?> / 27 Comments</h4>
                                <p><?=$article['introtext']?></p>
                                <a href="article/<?=$article['alias']?>"><span></span>Читать больше</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>
                <h2>По данному запросу нет материалов</h2>
                <?php endif;?>
            </div>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>