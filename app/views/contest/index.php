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
        <!--todo: need to validate that form values are set and correct (on submit)-->
        <form name="contestForm" action="<?php echo BASE_URL; ?>public/contest/submit" method="post" onsubmit="">
            <label for="classRoom">Class room</label>
            <input type="text" name="classRoom" value="" />
            <br/>
            <label for="schoolName">School name</label>
            <select name="schoolSelect" onchange="onSchoolSelected(this)">
                <option selected disabled>Choose here...</option>
                <?php foreach($data['contestInfo']->schoolList as $school) {
                    $schoolKey = $school->schoolId.';'.htmlspecialchars($school->phone);
                    $schoolName = htmlspecialchars($school->name); ?>
                    <option value="<?php echo $schoolKey; ?>"><?php echo $schoolName; ?></option>
                <?php }
                ?>
            </select>
            <br/>
            <label for="pupilEmail">Pupil email address</label>
            <input type="email" name="pupilEmail" value="" />
            <br/>
            <label for="schoolPhone">School phone number</label>
            <input type="tel" name="schoolPhone" value="" />
            <br/>
            <div name="question">
                <?php echo $data['contestInfo']->question->questionText."</br>"; ?>
                <div name="answers">
                    <?php foreach($data['contestInfo']->proposedAnswers as $answer) { ?>
                        <input type="radio" name="proposedAnswer" value="<?php echo $answer->answerId; ?>"> <?php echo $answer->answerText ?><br>
                    <?php }
                    ?>
                </div>
            </div>
            <br/>
            <input type="hidden" name="cmpId" value="<?= $data['contestInfo']->competition->compId ?>" />
            <input type="hidden" name="questionId" value="<?= $data['contestInfo']->question->questionId ?>" />
            <input type="submit" name="submitCompForm" value="Send" />
        </form>
    <?php
    }
    else { ?>
        <h2>Thank you for participation in competition! Your answer is accepted and in case of win your will receive a notification to the your email address.</h2>
        <br/>
        <span>Your class number:</span>
        <br/>
        <?= $data['contestInfo']->competitor->classNumber ?>
        <br/>
        <span>Your email address:</span>
        <br/>
        <?= $data['contestInfo']->competitor->email ?>
        <br/>
        <span>Your school:</span>
        <br/>
        <?= $data['contestInfo']->selectedSchool->name ?>
        <br/>
        <span>Your school phone number:</span>
        <br/>
        <?= $data['contestInfo']->selectedSchool->phone ?>
        <br/>
        <span>Your competition question was:</span>
        <br/>
        <?= $data['contestInfo']->question->questionText ?>
        <br/>
        <span>You answered as:</span>&nbsp;
        <?=$data['contestInfo']->$selectedAnswer->answerText?>
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