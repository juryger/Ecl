<?php

// Buffer larger content areas
ob_start();

?>

<div class="container-fluid" style="margin-top:10px;">
    <h1>
        <span><?=$data['contestInfo']->competition->title?></span>&nbsp;
    </h1>
    <br/>
    <span><?=$data['contestInfo']->competition->description?></span>&nbsp;
    <br/>
    <?php if ($data['contestInfo']->isSubmitted == false) { ?>
        <!--need to validate that form values are set at OnSubmit-->
        <form action="<?php echo BASE_URL; ?>public/contest/submit" method="post" onsubmit="">
            <label for="classRoom">Class room</label>
            <input type="text" name="classRoom" value="" />
            <br/>
            <label for="schoolName">School name</label>
            <input type="text" name="schoolName" value="" />
            <br/>
            <label for="pupilEmail">Pupil email address</label>
            <input type="text" name="pupilEmail" value="" />
            <br/>
            <label for="schoolPhone">School phone number</label>
            <input type="text" name="schoolPhone" value="" />
            <br/>
            <div name="question">
                <?php
                echo $data['contestInfo']->question."</br>";
                ?>
                <div name="answers">
                    <?php
                    foreach($data['contestInfo']->answers as $answer) {
                    ?>
                        <input type="radio" name="anAnswer" value="<?php echo $answer['ID']; ?>"> <?php $answer['AnswerText']?><br>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <br/>
            <input type="submit" name="submitCompForm" value="Send form" />
            <input type="hidden" name="compId" value="<?=$data['contestInfo']->compId?>" />
            <input type="hidden" name="questionId" value="<?=$data['contestInfo']->questionId?>" />
        </form>
    <?php
    }
    else { ?>
        <!-- todo: output user input data retrieved from database (i.e. question text, selected answer)-->
        <h2>Thank you for your participation in competition! Your answer is accepted and in case of win your will receive a notification to provided email address.</h2>
        <br/>
        <span>You competition question was:</span>
        <br/>
        <?=$data['contestInfo']->question?>
        <br/>
        <span>You answered as:</span>&nbsp;
        <?=$data['contestInfo']->proposedAnswer?>
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