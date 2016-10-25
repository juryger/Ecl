<?php

// Buffer larger content areas
ob_start();

?>

<div class="container-fluid" style="margin-top:10px;">
    <h1>
        <span><?= $data['contestInfo']->competition->title ?></span>&nbsp;
    </h1>
    <em>
        <span><?=$data['contestInfo']->competition->description?></span>&nbsp;
    </em>
    <br/>
    <br/>
    <?php if ($data['contestInfo']->isSubmitted == false) { ?>
        <!--todo: need to validate that form values are set and correct (on submit)-->
        <!--url for action: <?php echo BASE_URL; ?>public/contest/submit-->
        <form name="contestForm" id="contestForm" action="javascript:sendFormAjax('contestForm', '<?php echo BASE_URL; ?>public/contest/submit', 'ajaxResult');" method="post" onsubmit="return validateContestForm();">
            <label for="classRoom">Class room<abbr title="This field is mandatory">*</abbr>&nbsp;</label>
            <input type="text" name="classRoom" value="" required />
            <br/>
            <label for="schoolSelect">School name<abbr title="This field is mandatory">*</abbr>&nbsp;</label>
            <select name="schoolSelect" onchange="onSchoolSelected(this)" required>
                <option selected disabled>Choose here...</option>
                <?php foreach($data['contestInfo']->schoolList as $school) {
                    $schoolKey = $school->schoolId.';'.htmlspecialchars($school->phone);
                    $schoolName = htmlspecialchars($school->name); ?>
                    <option value="<?php echo $schoolKey; ?>"><?php echo $schoolName; ?></option>
                <?php }
                ?>
            </select>
            <br/>
            <label for="pupilEmail">Pupil email address<abbr title="This field is mandatory">*</abbr>&nbsp;</label>
            <input type="email" name="pupilEmail" value="" required />
            <br/>
            <label for="schoolPhone">School phone number<abbr title="This field is mandatory">*</abbr>&nbsp;</label>
            <input type="tel" name="schoolPhone" value="" required />
            <br/>
            <div name="question">
                <br/>
                <h3><?php echo $data['contestInfo']->question->questionText; ?><abbr title="This field is mandatory">*</abbr>&nbsp;</h3>
                <div name="answers">
                    <?php foreach($data['contestInfo']->proposedAnswers as $answer) { ?>
                        <input type="radio" name="proposedAnswer" onclick="onContestAnswerSelected(this)" value="<?php echo $answer->answerId; ?>"> <?php echo $answer->answerText ?><br>
                    <?php }
                    ?>
                </div>
            </div>
            <br/>
            <input type="hidden" name="cmpId" value="<?= $data['contestInfo']->competition->cmpId ?>" />
            <input type="hidden" name="questionId" value="<?= $data['contestInfo']->question->questionId ?>" />
            <input type="hidden" name="selectedAnswerId" value="" required />
            <label name="validationSummary" style="color: red;"></label>
            <br/>
            <input type="submit" name="submitCompForm" value="Send" />
        </form>
        <br/>
        <div id="ajaxResult"></div>
    <?php
    }
    else if (!$data['contestInfo']->response->isAlreadyRegistered) { ?>
        <span style="color: green;"><strong>Thank you for participation in competition!</strong></span>
        <br/>
        <span>Your class number:</span>&nbsp;
        <?= $data['contestInfo']->competitor->classNumber ?>
        <br/>
        <span>Your email address:</span>&nbsp;
        <?= $data['contestInfo']->competitor->email ?>
        <br/>
        <span>Your school:</span>&nbsp;
        <?= $data['contestInfo']->selectedSchool->name ?>
        <br/>
        <span>Your school phone number:</span>&nbsp;
        <?= $data['contestInfo']->selectedSchool->phone ?>
        <br/>
        <span>Your competition question:</span>&nbsp;
        <?= $data['contestInfo']->question->questionText ?>
        <br/>
        <span>You answered as:</span>&nbsp;
        <?= $data['contestInfo']->selectedAnswer->answerText ?>
    <?php } else { ?>
        <span style="color: red;">You have already responded to the competition question at <?= $data['contestInfo']->response->entryDate ?>.</span>
        <br/>
    <?php } ?>
</div>

<?php

// Assign all Page specific variables
$viewTitle = 'Contest';
$viewContent = ob_get_contents();

ob_end_clean();

// Load master page
require_once '../..'.BASE_URL.'public/master.php';

?>