/**
 * Created by juryger on 8/10/2016.
 */

/**
 * Event handler for change value of school dropdown list.
 * @param mixed selected <p>selected item from dropdown list</p>
 */
function onSchoolSelected(selected) {
    var schoolPhone = selected.value.split(';')[1];
    $("input#schoolPhone").val(schoolPhone);
}

/**
 * Event handler of choosing one of the answers from available radioboxes.
 * @param mixed selected <p>selected answer radiobox item</p>
 */
function onContestAnswerSelected(selected) {
    var answerId = selected.value;
    $("input[name='selectedAnswerId']").val(answerId);
}

/**
 * Validate contest form submission.
 * @returns {boolean} true - form validated without errors, false - validation errors.
 */
function validateContestForm() {
    var validationSummary = $("label[name='validationSummary']");

    var selectedSchool = $("select[name='schoolSelect']").prop("value");
    if (selectedSchool == null || selectedSchool == "Choose here...") {
        validationSummary.html("Select school from list.");
        return false;
    }

    var answerId = $("input[name='selectedAnswerId']").val();
    if (answerId == null || answerId == "") {
        validationSummary.html("Chose on of the answers.");
        return false;
    }

    validationSummary.html("");
    return true;
}

function sendFormAjax(pContestForm, pContestUrl, pContestSubmitResult) {
    $.ajax({
        type: 'POST',
        url: pContestUrl,
        data: pContestForm.serialize(),
        success: function(data) {
            pContestForm.hide();
            pContestSubmitResult.html(data);
        },
        error:  function(xhr, str){
            pContestSubmitResult.html('Error occurred during sending form to server through AJAX, code:' + xhr.responseCode + ', msg: ' + str);
        }
    });
}

function checkInputValidity(inputField, failValidationText, successValidationText){
    inputField.setCustomValidity(
        inputField.validity.patternMismatch ?
            failValidationText :
            successValidationText);
}

function assignContestFormValidationListeners() {
    var classRoom = document.getElementById("classRoom");
    classRoom.addEventListener("blur", function (event) {
        checkInputValidity(classRoom, "Enter two capital letters followed by two digits.", "");
    });

    var pupilEmail = document.getElementById("pupilEmail");
    pupilEmail.addEventListener("blur", function (event) {
        checkInputValidity(pupilEmail, "Enter valid email address (see hint for more details)", "");
    });

    var schoolPhone = document.getElementById("schoolPhone");
    schoolPhone.addEventListener("blur", function (event) {
        checkInputValidity(schoolPhone, "Enter NZ local or international (started from +64) phone number (see hint for more details)", "");
    });
}