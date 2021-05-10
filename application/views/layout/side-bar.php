<!-- Start Left menu area -->
<div class="left-sidebar-pro">
  <nav id="sidebar" class="">
    <div class="sidebar-header">
      <a href="index.html"><img class="main-logo" src="<?php echo base_url('optimum'); ?>/img/logo/logo.png" alt="" /></a>
      <strong><a href="index.html"><img src="<?php echo base_url('optimum'); ?>/img/logo/logosn.png" alt="" /></a></strong>
    </div>
    <div class="left-custom-menu-adp-wrap comment-scrollbar">
      <nav class="sidebar-nav left-sidebar-menu-pro">
        <ul class="metismenu" id="menu1">
          <?php if ($this->session->userdata('id')): ?>
            <li>
              <a class="has-arrow" href="index.html">
                <span class="educate-icon educate-home icon-wrap"></span>
                <span class="mini-click-non">Admin Option</span>
              </a>
              <ul class="submenu-angle" aria-expanded="true">
                <li><a title="Menus List" href="<?php echo base_url('menu/add') ?>"><span class="educate-icon educate-menu icon-wrap"></span><span class="mini-sub-pro">Site Menus</span></a></li>
                <li><a title="Menus List" href="<?php echo base_url('topic/add') ?>"><span class="educate-icon educate-nav icon-wrap"></span><span class="mini-sub-pro">Add Topics</span></a></li>
                <li><a title="Menus List" href="<?php echo base_url('article/add') ?>"><span class="educate-icon educate-pages icon-wrap"></span><span class="mini-sub-pro">Add Article</span></a></li>
              </ul>
            </li>
          <?php endif; ?>
           <?php if (isset($side_menu)): ?>
            <?php foreach ($side_menu as $value):?>
                <?php if (!empty($value->topic_article)): ?>
                  <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                      <span class="educate-icon educate-course icon-wrap"></span>
                      <span class="mini-click-non"><?php echo $value->topic_title; ?></span>
                    </a>
                    <ul class="submenu-angle" aria-expanded="false">
                      <?php $topic_article = json_decode($value->topic_article); ?>
                      <?php foreach ($topic_article as $key => $topic): ?>
                        <li><a title="<?php echo $topic->article_title ?>" href="<?php echo base_url('index.php?menu=').$value->menu_parent."&topic=".$value->topic_url."&article=". $topic->article_url?>"><span class="educate-icon educate-data-table icon-wrap"></span><span class="mini-sub-pro"><?php echo $topic->article_title ?></span></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                  <?php else: ?>
                    <li>
                      <a title="Side Menu List" href="<?php echo base_url('index.php?menu=').$value->menu_parent."&topic=".$value->topic_url ?>">
                        <span class="educate-icon educate-course icon-wrap"></span>
                        <span class="mini-sub-pro">
                          <?php echo $value->topic_title; ?>
                        </span>
                      </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </nav>
</div>
<!-- End Left menu area -->
