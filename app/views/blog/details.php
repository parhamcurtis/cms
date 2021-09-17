<?php $this->start('content'); ?>
<div class="poster">
    <div class="row mb-4">
        <div class="col flex-grow-1">
            <h1><?= html_entity_decode($this->article->title);?></h1>
            <p>By <a href="<?=ROOT?>blog/author/<?=$this->article->user_id?>"><?= $this->article->fname . ' ' . $this->article->lname;?></a></p>
            <p>Category <a href="<?=ROOT?>blog/category/<?=$this->article->category_id?>"><?= $this->article->category?></a></p>
        </div>
        <div class="col text-right">
            <img src="<?=ROOT . $this->article->img?>" alt="<?=$this->article->title?>" style="height: 175px; width: auto;" />
        </div>
    </div>

    <div>
        <?= html_entity_decode($this->article->body); ?>
    </div>
</div>
<?php $this->end(); ?>