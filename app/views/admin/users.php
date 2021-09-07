<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Users</h2>
    <a href="<?=ROOT?>auth/register" class="btn btn sm btn-primary">New User</a>
</div>


<div class="poster">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Access Level</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->users as $user): ?>
                <tr>
                    <td><?= $user->displayName();?></td>
                    <td><?= $user->email?></td>
                    <td><?= ucwords($user->acl) ?></td>
                    <td></td>
                    <td>
                        <a href="<?=ROOT?>auth/register/<?=$user->id?>" class="btn btn-sm btn-info">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->partial('partials/pager'); ?>
</div>
<?php $this->end(); ?>