<?php

// Buffer larger content areas
ob_start();

?>

<!--View content starts here -->

<div class="container-fluid" style="margin-top:10px;">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"
             style="position:static;">
            <ul class="nav nav-sidebar">
                <li><a href="<?php echo BASE_URL; ?>public/home/index/intro"><strike>Intro & How to start</strike></a></li> <!--class="active"-->
                <li><a href="<?php echo BASE_URL; ?>public/home/index/news"><strike>News</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/home/index/faq"><strike>FAQ</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/home/index/testimonials"><strike>Testimonials</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/home/index/subscription"><strike>Subsription</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/home/index/contacts"><strike>Contact Us</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/home/index/help"><strike>Help</strike></a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"
             style="margin-left:160px; position:absolute; width:550px; padding-left:30px;">
            <h1 class="page-header">
                <?=$data['sectionInfo']->title?>
            </h1>

            <!--todo: show content of selected page by require_once-->

            <?php if ($data['sectionInfo']->id == 'intro'): ?>
                <span>The content of page Introduction and How to start</span>
            <?php elseif ($data['sectionInfo']->id == 'news'): ?>
                <span>The content of page News</span>
            <?php elseif ($data['sectionInfo']->id == 'faq'): ?>
                <span>The content of page FAQs</span>
            <?php elseif ($data['sectionInfo']->id == 'subscription'): ?>
                <span>The content of page Subscription</span>
            <?php elseif ($data['sectionInfo']->id == 'contacts'): ?>
                <span>The content of page Contact Us</span>
            <?php elseif ($data['sectionInfo']->id == 'help'): ?>
                <span>The content of page Help</span>
            <?php elseif ($data['sectionInfo']->id == 'testimonials'): ?>
                <span>The content of page Help</span>
            <?php else: ?>
                <span style="color: red">There is no such page: </span>
                <?=$data['sectionInfo']->title?>
            <?php endif; ?>
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar"
            style="float:right;">
            <div class="sidebar-module sidebar-module-inset">
                <h4>News</h4>
                <p>17 June 2016</br>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>
            <div class="sidebar-module">
                <h4>Gallery</h4>
                <a href="<?php echo BASE_URL; ?>public/community/index/gallery">
                    <img src="../..<?php echo BASE_URL; ?>public/images/logo.png" title="work"/>
                </a>
            </div>
        </div>
    </div>
</div>

<?php

// Assign all Page specific variables
$viewTitle = 'About Us';
$viewContent = ob_get_contents();

ob_end_clean();

// Load master page
require_once '../..'.BASE_URL.'public/master.php';

?>