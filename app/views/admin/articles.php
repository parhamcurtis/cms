<?php $this->start('content'); ?>
<div class="d-flex justify-content-between align-items-center">
   <h2>Your Articles</h2>
   <a class="btn btn-primary" href="<?= ROOT?>admin/article/new">New Article</a>
</div>

<div class="poster">
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Title</th>
                <th>Create Date</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->articles as $article): ?>
                <tr>
                    <td><?= $article->title?></td>
                    <td><?= date("M j, Y ~ g:i a", strtotime($article->created_at))?></td>
                    <td><?= $article->status?></td>
                    <td class="text-right">
                        <a href="<?=ROOT?>admin/article/<?=$article->id?>" class="btn btn-sm btn-info">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick="deleteArticle('<?=$article->id?>')">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $this->partial('partials/pager');?>
</div>

<script>
    function deleteArticle(id){
        if(window.confirm("Are you sure you want to delete this article? This cannot be undone!")){
            window.location.href = `<?=ROOT?>admin/deleteArticle/${id}`;
        }
    }
</script>

<?php $this->end(); ?>