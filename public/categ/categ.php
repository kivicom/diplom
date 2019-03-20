<?php $parent = isset($category['childs']); ?>

<div>
    <a href="<?=($parent == 1) ? "category" : "article"; ?>/<?=$category['alias'];?>">
        <?=$category['title'];?>
    </a>
    <?php if(isset($category['childs'])): ?>
        <div class="articles" style="padding-left: 10px; margin-bottom: 10px;">
            <small style="text-transform: lowercase;">
                <?=$this->getMenuHtml($category['childs']);?>
            </small>
        </div>
    <?php endif; ?>
</div>