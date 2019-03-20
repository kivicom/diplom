<?php if ($articles) :?>
		<?php foreach ($articles as $article):?>
			<div class="content-grid-info">
				<div class="post-info">
					<h4><a href="article/<?=$article->alias;?>"><?=$article->title;?></a>  <?=$article->created;?> / 27 Comments</h4>
					<a href="article/<?=$article->alias;?>"><span></span>Читать больше</a>
				</div>
			</div>
		<?php endforeach;?>
		<?php if($pagination->countPages > 1):?>
			<?=$pagination;?>
		<?php endif;?>
<?php endif;?>