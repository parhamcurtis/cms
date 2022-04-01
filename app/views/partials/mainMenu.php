<?php 
  use Core\H;
  use App\Models\{Categories, Users};
  global $currentUser;
  $categories = Categories::findAllWithArticles();
  $authors = Users::findAuthorsWithArticles();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?=ROOT?>">Freeskills</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto my-lg-0 navbar-nav-scroll">
      <?= H::navItem('blog/index', 'Home'); ?>
      
      <li class="<?=H::activeClass('blog/category/:id','nav-item dropdown')?>">
        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdownLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="categoryDropdownLink">
          <?= H::navItem('blog/category/0', 'Uncategorized', true);?>
          <?php foreach($categories as $category):?>
            <?= H::navItem('blog/category/' . $category->id, $category->name, true); ?>
          <?php endforeach;?>
        </ul>
      </li>

      <li class="<?=H::activeClass('blog/author/:id','nav-item dropdown')?>">
        <a href="#" class="nav-link dropdown-toggle" id="authorDropdownLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Authors</a>
        <ul class="dropdown-menu" aria-labelledby="authorDropdownLink">
            <?php 
              foreach($authors as $author) {
                echo H::navItem('blog/author/' . $author->id, $author->displayName(), true);
              }
            ?>
        </ul>
      </li>
    </ul>

    <ul class="navbar-nav d-flex">
      <?php if(!$currentUser): ?>
        <?= H::navItem('auth/login', 'Log In'); ?>
      <?php endif; ?>

      <?php if($currentUser): ?>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="accountDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Hello <?= $currentUser->fname;?>
          </a>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
            <?= H::navItem('admin/articles', 'Author Portal', true);?>
            <li><hr class="dropdown-divider"></li>
            <?= H::navItem('auth/logout', 'Log Out', true); ?>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>