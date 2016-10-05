<?php

// Buffer larger content areas
ob_start();

?>

<div class="container-fluid" style="margin-top:10px;">
    <?php if ($data['contestInfo']->isSubmitted == false) { ?>
        <!--View content starts here -->
        <!--need to validate that form values are set at OnSubmit-->
        <form action="<?php echo BASE_URL; ?>public/contest/submit" method="post" onsubmit="">
            <h1>
                Competition:
                <span><?=$data['contestInfo']->contestName?></span>&nbsp;
            </h1>
            <br/>
            <label for="schoolName">School name</label>
            <input type="text" name="schoolName" value="" />
            <br/>
            <input type="submit" name="submitCompForm" value="Send form" />
        </form>

    <?php
    }
    else { ?>
        <span>Submission status:</span>
        <br/>
        <?=$data['contestInfo']->submissionMessage?>
    <?php
    } ?>
</div>

<?php

// Assign all Page specific variables
$viewTitle = 'Contest';
$viewContent = ob_get_contents();

ob_end_clean();

// Load master page
require_once '../..'.BASE_URL.'public/master.php';

?>