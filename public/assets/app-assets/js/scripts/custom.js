$(function() {
    $("#categoryId").chosen();
});

$('#categoryId').on('change', (e, params) => {
    try {
        let option;

        if (params.hasOwnProperty("selected")) {
            option = params.selected;
        } else {
            option = $("#categoryId").find(':selected').val();
        }

        if (option == 0) {
            $('#categoryId').removeAttr('multiple');
            $('#categoryId').chosen("destroy");
        } else {
            $('#categoryId').attr('multiple', 'multiple');
            $('#categoryId').trigger("chosen:updated");
        }
    } catch(e) {
        $('#categoryId').attr('multiple', 'multiple');
        $('#categoryId').chosen();
    }
});

function checkOthers(anchor, target) {
    if(target === 'rate') {
        return switchRateFields(anchor)
    } else if(target === 'duration') {
        return switchDurationFields(anchor)
    } else if(target === 'year') {
        return switchYearFields(anchor)
    } else if(target === 'band') {
        return switchBandFields(anchor)
    } else {
        return false
    }
}

function switchRateFields(reverse = null) {
    try {
        const optionalField = $("#rateOthers");

        if(reverse === true) {
            const field = $("#rateMain");
            optionalField.removeAttr("required name");
            optionalField.attr('style', 'display:none !important');

            field.attr('style', 'display:inline !important');
            field.attr('required', 'required');
            field.attr('id', 'rate');
            field.attr('name', 'rate');
            field.prop('selectedIndex', 0);

            $("#rateSection").find('#back').attr('style', 'display:none !important')
        } else {
            const field = $("#rate");
            const selected = field.find(":selected").val();

            if(selected === "others") {
                //remove the conflicting attributes
                field.removeAttr("name required");
                //change the field id
                field.attr('id', 'rateMain');
                //hide the field from view
                field.attr('style', 'display:none !important');


                //show the new field and make it required
                optionalField.attr('style', 'display:inline !important');
                optionalField.attr("required", "required");
                optionalField.attr("name", "rate");

                $("#rateSection").find('#back').attr('style', 'display:inline !important')
            } else {
                return false;
            }
        }
    } catch(error) {
        console.log(error)
    }
}


function switchDurationFields(reverse = null) {
    try {
        const optionalField = $("#durationOthers");

        if (reverse === true) {
            const field = $("#durationMain");
            optionalField.removeAttr("required name");
            optionalField.attr('style', 'display:none !important');

            field.attr('style', 'display:inline !important');
            field.attr('required', 'required');
            field.attr('id', 'duration');
            field.attr('name', 'duration');
            field.prop('selectedIndex', 0);

            $("#durationSection").find('#back').attr('style', 'display:none !important')
        } else {
            const field = $("#duration");
            const selected = field.find(":selected").val();

            if (selected === "others") {
                //remove the conflicting attributes
                field.removeAttr("name required");
                //change the field id
                field.attr('id', 'durationMain');
                //hide the field from view
                field.attr('style', 'display:none !important');

                //show the new field and make it required
                optionalField.attr('style', 'display:inline !important');
                optionalField.attr("required", "required");
                optionalField.attr("name", "duration");

                $("#durationSection").find('#back').attr('style', 'display:inline !important')
            } else {
                return false;
            }
        }
    } catch (error) {
        console.log(error)
    }
}

function switchYearFields(reverse = null) {
    try {
        const optionalField = $("#yearOthers");

        if (reverse === true) {
            const field = $("#yearMain");
            optionalField.removeAttr("required name");
            optionalField.attr('style', 'display:none !important');

            field.attr('style', 'display:inline !important');
            field.attr('required', 'required');
            field.attr('id', 'year')
            field.attr('name', 'year');
            field.prop('selectedIndex', 0)

            $("#yearSection").find('#back').attr('style', 'display:none !important')
        } else {
            const field = $("#year");
            const selected = field.find(":selected").val();

            if (selected == "others") {
                //remove the conflicting attributes
                field.removeAttr("name required")
                //change the field id
                field.attr('id', 'yearMain')
                //hide the field from view
                field.attr('style', 'display:none !important');

                //show the new field and make it required
                optionalField.attr('style', 'display:inline !important');
                optionalField.attr("required", "required");
                optionalField.attr("name", "year");

                $("#yearSection").find('#back').attr('style', 'display:inline !important')
            } else {
                return false;
            }
        }
    } catch (error) {
        console.log(error)
    }
}

function switchBandFields(reverse = null) {
    try {
        const optionalField = $("#bandOthers");

        if (reverse === true) {
            const field = $("#bandMain");
            optionalField.removeAttr("required name");
            optionalField.attr('style', 'display:none !important');

            field.attr('style', 'display:inline !important');
            field.attr('required', 'required');
            field.attr('id', 'band');
            field.attr('name', 'band');
            field.prop('selectedIndex', 0);

            $("#bandSection").find('#back').attr('style', 'display:none !important')
        } else {
            const field = $("#band");
            const selected = field.find(":selected").val();

            if (selected === "others") {
                //remove the conflicting attributes
                field.removeAttr("name required");
                //change the field id
                field.attr('id', 'bandMain');
                //hide the field from view
                field.attr('style', 'display:none !important');

                //show the new field and make it required
                optionalField.attr('style', 'display:inline !important');
                optionalField.attr("required", "required");
                optionalField.attr("name", "band");

                $("#bandSection").find('#back').attr('style', 'display:inline !important')
            } else {
                return false;
            }
        }
    } catch (error) {
        console.log(error.message)
    }
}

function verifyBandInput(e) {
    const code = e.which || e.keycode;

    if ((code >= 48 && code <= 57) || code == 8 || (code >= 35 && code <= 40) || code == 46 || code == 189 || code == 32 || code == 109 || code == 188 || code == 173) {
        return true
    } else {
        return false
    }
}
