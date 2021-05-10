<ul class="nav navbar-nav mai-top-nav">
  <?php if (isset($menus)): ?>
    <?php foreach ($menus as $value): ?>

      <li class="nav-item"><a href="<?php echo base_url("index.php?menu=".$value->sitemenu_url) ?>" class="nav-link"><?php echo $value->sitemenu_title ?></a>
      </li>
    <?php endforeach; ?>
  <?php endif; ?>
</ul>
