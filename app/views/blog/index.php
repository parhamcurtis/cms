<?php $this->start('content'); ?>
<h2><?= $this->heading?></h2>

<div class="articles-wrapper">
    <?php foreach($this->articles as $article): ?>
        <div class="card article-preview">
            <img src="<?=ROOT . $article->img?>" class="card-img-top" />
            <div class="card-body">
                <h5 class="card-title"><?= $article->title ?></h5>
                <p>By <a href="<?=ROOT?>blog/author/<?=$article->user_id?>"><?=$article->fname . ' ' . $article->lname?></a></p>
                <div class="card-text"><?= html_entity_decode($article->body) ?></div>
                <a href="<?=ROOT?>blog/details/<?=$article->id?>" class="text-info">Read More</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php $this->partial('partials/pager'); ?>
<?php $this->end(); ?>