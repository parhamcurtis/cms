<?php use Core\FH; ?>
<?php $this->start('content'); ?>
<div class="row">
    <div class="col-md-8 offset-md-2 poster">
        <h2>Register</h2>

        <form action="" method="POST">
            <div class="row">
                <?= FH::inputBlock('First Name', 'fname', '', ['class' => 'form-control'], ['class' => 'form-group col-md-6'], $this->errors); ?>
                <?= FH::inputBlock('Last Name', 'lname', '', ['class' => 'form-control'], ['class' => 'form-group col-md-6'], $this->errors); ?>
                <?= FH::inputBlock('Email', 'email', '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'form-group col-md-6'], $this->errors); ?>

            </div>

            <div class="row">
                <?= FH::inputBlock('Password', 'password', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'form-group col-md-6'], $this->errors); ?>
                <?= FH::inputBlock('Confirm Password', 'confirm', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'form-group col-md-6'], $this->errors); ?>
            </div>

            <div class="text-right">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input class="btn btn-primary" value="Save" type="submit" />
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>