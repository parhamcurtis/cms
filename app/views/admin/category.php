<?php 
    use Core\FH;
    $this->start('content');
?>
<div class="row">
    <div class="col-md-8 offset-md-2 poster">
        <h2><?= $this->heading ?></h2>

        <form method="post">
            <div class="row">
                <?= FH::csrfField(); ?>
                <?= FH::inputBlock('Category Name', 'name', $this->category->name, ['class' =>'form-control'], ['class' => 'form-group col-md-12'], $this->errors); ?>
            </div>

            <div class="text-right">
                <a href="<?=ROOT?>admin/categories" class="btn btn-secondary">Cancel</a>
                <input class="btn btn-primary" value="Save" type="submit" />
            </div>
        </form>
    </div>
</div>

<?php $this->end(); ?>