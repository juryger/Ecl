<?php

// Buffer larger content areas
ob_start();

?>

<div class="container-fluid" style="margin-top:10px;">
    <?php if ($data['contestInfo']->isSubmitted == false) { ?>
        <h1>
            <span><?= $data['contestInfo']->competition->title ?></span>&nbsp;
        </h1>
        <em>
            <span><?=$data['contestInfo']->competition->description?></span>&nbsp;
        </em>
        <br/>
        <br/>
        <form name="contestForm" id="contestForm"
              action="javascript:sendFormAjax($('#contestForm'), '<?php echo BASE_URL; ?>public/contest/submit', $('#contestSubmitResult'));"
              method="post"
              onsubmit="return validateContestForm();">
            <ul class="form-style">
                <li>
                    <label for="classRoom">
                        Class room&nbsp;
                        <abbr title="examples of correct values: AB12 or EF09, incorrect values: ab12 or 1BC3">
                            <span class="required">*</span>
                        </abbr>
                    </label>
                    <input type="text" class="field-long" id="classRoom" name="classRoom" value=""
                           placeholder="Enter two capital letters followed by two digits (see hint for more details)"
                           pattern="^[A-Z]{2}[0-9]{2}$"
                           required />
                </li>
                <li>
                    <label for="schoolSelect">
                        School name&nbsp;
                        <abbr title="This field is mandatory">
                            <span class="required">*</span>
                        </abbr>
                    </label>
                    <select name="schoolSelect" class="field-select" onchange="onSchoolSelected(this)" required>
                        <option selected disabled>Choose here...</option>
                        <?php foreach($data['contestInfo']->schoolList as $school) {
                            $schoolKey = $school->schoolId.';'.htmlspecialchars($school->phone);
                            $schoolName = htmlspecialchars($school->name); ?>
                            <option value="<?php echo $schoolKey; ?>"><?php echo $schoolName; ?></option>
                        <?php }
                        ?>
                    </select>
                </li>
                <li>
                    <label for="pupilEmail">
                        Pupil email address&nbsp;
                        <abbr title="Example of correct value: someone@domain.org, incorrect value: bart simpson@springfield">
                            <span class="required">*</span>
                        </abbr>&nbsp;
                    </label>
                    <input type="text" class="field-long" id="pupilEmail" name="pupilEmail" value=""
                           placeholder="Enter valid email address (see hint for more details)"
                           pattern="^(([^<>()[\]\\.,;:\s@\x22]+(\.[^<>()[\]\\.,;:\s@\x22]+)*)|(\x22.+\x22))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$"
                           required />
                </li>
                <li>
                    <label for="schoolPhone">
                        School phone number&nbsp;
                        <abbr title="Examples of correct values: 03 5487725, 035487725, +64 (3) 548 7725; incorrect values: 03-548-7725, +64 333 548 7725">
                            <span class="required">*</span>
                        </abbr>
                    </label>
                    <input type="tel" class="field-long" name="schoolPhone" id="schoolPhone" value=""
                           placeholder="Enter NZ local or international (started from +64) phone number (see hint for more details)"
                           pattern="^(\+64\s?)?(?:\d{1,2}|\(\d{1,2}\))\s?\d{3}\s?\d{4}$"
                           required />
                </li>
                <li>
                    <label for="question">
                        Competition question&nbsp;
                        <abbr title="This field is mandatory">
                            <span class="required">*</span>
                        </abbr>
                    </label>
                    <div name="question" class="field-long">
                        <h3><?php echo $data['contestInfo']->question->questionText; ?></h3>
                        <div name="answers" class="field-long">
                            <?php foreach($data['contestInfo']->proposedAnswers as $answer) { ?>
                                <input type="radio" name="proposedAnswer"
                                       onclick="onContestAnswerSelected(this)"
                                       value="<?php echo $answer->answerId; ?>">
                                <?php echo $answer->answerText ?>
                                <br/>
                            <?php }
                            ?>
                        </div>
                    </div>
                </li>
                <li>
                    <input type="submit" name="submitCompForm" value="Submit" />
                </li>
            </ul>
            <input type="hidden" name="cmpId" value="<?= $data['contestInfo']->competition->cmpId ?>" />
            <input type="hidden" name="questionId" value="<?= $data['contestInfo']->question->questionId ?>" />
            <input type="hidden" name="selectedAnswerId" value="" required />
            <label name="validationSummary" style="color: red;"></label>
            <br/>
        </form>
        <br/>
        <!-- Will contain result of contest form submitting using AJAX-->
        <div id="contestSubmitResult"></div>
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

<script>
    $(function () {
        assignContestFormValidationListeners();
    });
</script>
