/**
 * Created by juryger on 8/10/2016.
 */

function onSchoolSelected(selected) {
    var schoolPhone = selected.value.split(';')[1];
    $("form[name='contestForm']").children("input[name='schoolPhone']")[0].value = schoolPhone;
}