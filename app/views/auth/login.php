<?php use Core\FH; ?>
<?php $this->start('content');?> 
<div class="row">
    <div class="col-md-8 offset-md-2 poster">
        <h2>Login</h2>

        <form method="POST">
            <?= FH::csrfField(); ?>
            <div class="row">
                <?= FH::inputBlock('Email', 'email', $this->user->email,['class' => 'form-control', 'type'=>'text'],['class' => 'form-group col-md-6'], $this->errors); ?>
                <?= FH::inputBlock('Password', 'password', $this->user->password, ['class' => 'form-control', 'type' => 'password'], ['class' => 'form-group col-md-6'], $this->errors); ?>
            </div>

            <div class="row">
                <div class="col">
                    <?= FH::check('Remember Me', 'remember', $this->user->remember == 'on', ['class' => 'form-check-input'], ['class' => 'form-group form-check'], $this->errors); ?>
                </div>
            </div>

            <div class="text-right">
                <a href="<?=ROOT?>auth/login" class="btn btn-secondary">Cancel</a>
                <input class="btn btn-primary" value="Log In" type="submit" />
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>