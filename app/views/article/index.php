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
                <li><a href="<?php echo BASE_URL; ?>public/article/index/tools">Tools and equipment</a></li> <!--class="active"-->
                <li><a href="<?php echo BASE_URL; ?>public/article/index/accident"><strike>Accident prevention</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/article/index/matters"><strike>Carving matters</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/article/index/drawings"><strike>Drawing patterns</strike></a></li>
                <li><a href="<?php echo BASE_URL; ?>public/article/index/techniques"><strike>Carving techniques</strike></a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"
             style="margin-left:160px; position:absolute; padding-left:30px;">
            <h1 class="page-header">
                <?=$data['sectionInfo']->title?>
            </h1>

            <?php if ($data['sectionInfo']->id == 'tools'):?>
                <?php if ($data['action'] == 'open'):?>
                    <?php require_once '../app/views/article/article.php';?>
                <?php else: ?>
                    <?php require_once '../app/views/article/list.php';?>
                <?php endif; ?>
            <?php elseif ($data['sectionInfo']->id == 'accident'): ?>
                <span>The content of page Accident prevention</span>
            <?php elseif ($data['sectionInfo']->id == 'matters'): ?>
                <span>The content of page Wood matters</span>
            <?php elseif ($data['sectionInfo']->id == 'drawings'): ?>
                <span>The content of page Drawing patters</span>
            <?php elseif ($data['sectionInfo']->id == 'techniques'): ?>
                <span>The content of page Carving techniques</span>
            <?php else: ?>
                <span style="color: red">There is no such page: </span>
                <?=$data['sectionInfo']->title?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php

// Assign all Page specific variables
$viewTitle = 'Carving basis';
$viewContent = ob_get_contents();

ob_end_clean();

// Load master page
require_once '../..'.BASE_URL.'public/master.php';

?>