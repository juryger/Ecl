/**
 * Created by juryger on 8/10/2016.
 */

/**
 * Event handler for change value of school dropdown list.
 * @param mixed selected <p>selected item from dropdown list</p>
 */
function onSchoolSelected(selected) {
    var schoolPhone = selected.value.split(';')[1];
    $("form[name='contestForm']").children("input[name='schoolPhone']").val(schoolPhone);
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
 * Falidate contest form submission.
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

function sendFormAjax(pFormName, pUrl, pResult) {
    var msg = $('#' + pFormName).serialize();
    $.ajax({
        type: 'POST',
        url: pUrl,
        data: msg,
        success: function(data) {
            $('#' + pResult).html(data);
        },
        error:  function(xhr, str){
            alert('Error occurred during sending form to server through AJAX, code:' + xhr.responseCode + ', msg: ' + str);
        }
    });
}