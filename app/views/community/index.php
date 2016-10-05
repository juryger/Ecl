<?php

// Buffer larger content areas
ob_start();

?>

<!--View content starts here -->

<div class="container-fluid" style="margin-top:10px;">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"
             style="float:left; position:static;width:200px">
            <div class="sidebar-module">
                <ul class="nav nav-sidebar">
                    <li><a href="<?php echo BASE_URL; ?>public/community/index/events" class="active">Events</a></li>
                    <li><a href="<?php echo BASE_URL; ?>public/community/index/members"><strike>Members</strike></a></li>
                    <li><a href="<?php echo BASE_URL; ?>public/community/index/gallery"><strike>Works gallery</strike></a></li>
                </ul>
            </div>
            <div class="sidebar-module">
                <h4>Events calendar</h4>
                <ol class="list-unstyled">
                    <li><a href="#"><strike>March 2014</strike></a></li>
                    <li><a href="#"><strike>February 2014</strike></a></li>
                    <li><a href="#"><strike>January 2014</strike></a></li>
                    <li><a href="#"><strike>December 2013</strike></a></li>
                    <li><a href="#"><strike>November 2013</strike></a></li>
                    <li><a href="#"><strike>October 2013</strike></a></li>
                    <li><a href="#"><strike>September 2013</strike></a></li>
                </ol>
            </div>
            <div class="sidebar-module">
                <h4><strike>Events banner</strike></h4>
                <a href="#">
                    <img src="../..<?php echo BASE_URL; ?>public/images/maori.jpg" width="95%"/>
                </a>
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"
             style="margin-left:200px; position:absolute; padding-left:30px; width:650px;">
            <h1 class="page-header">
                <?=$data['sectionInfo']->title?>
            </h1>

            <?php if ($data['sectionInfo']->id == 'events'):?>
                <?php if ($data['action'] == 'open'):?>
                    <?php require_once '../app/views/community/event.php';?>
                <?php else: ?>
                    <?php require_once '../app/views/community/list.php';?>
                <?php endif; ?>
            <?php elseif ($data['sectionInfo']->id == 'members'): ?>
                <span>The content of page Community members</span>
            <?php elseif ($data['sectionInfo']->id == 'gallery'): ?>
                <span>The content of page Works gallery of community members</span>
            <?php else: ?>
                <span style="color: red">There is no such page: </span>
                <?=$data['sectionInfo']->title?>
            <?php endif; ?>

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