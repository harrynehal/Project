
jQuery(document).ready(function () {

    $("#addUser").validate({
        rules: {
            "username": {
                required: true,
                minlength: 3,
                maxlength: 32,
                alphanumeric: true,
                /*remote: {
                    url: ajax_url + '/business-units/uniqueCheck',
                    type: 'post',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                }*/
            },
            'password': {
                required: true
            },
        },
        messages: {
            "username": {
                required: "Please enter the username.",
                minlength: "Minimum 3 characters required.",
                maxlength: "Maximum 32 characters required.",
                //alphanumeric : "Only alpha numeric characters allowed"
            },
            'password': {
                required: "Please enter password."
            }
        }
    });
    
});
