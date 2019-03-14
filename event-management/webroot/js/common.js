var host = window.location.host;
var ajax_url = '';
var proto = window.location.protocol;

ajax_url = proto + "//" + host;


$(document).ready(function () {

    /** jQuery.validator.addMethod("specialChars", function( value, element ) {
     var regex = new RegExp("^[a-zA-Z0-9]+$");
     var key = value;
     
     if (!regex.test(key)) {
     return false;
     }
     return true;
     }, "please use only alphanumeric or alphabetic characters"); **/

    jQuery.validator.addMethod("alphanumeric", function (value, element) {
        return this.optional(element) || /^[a-z\d\-_\s]+$/i.test(value);
    }, "Letters, numbers,space and underscores allowed");

    $.validator.addMethod('lessthan', function (value, element, param) {
        return this.optional(element) || parseFloat(value) < parseFloat($(param).val());
    }, 'Invalid value');
    $.validator.addMethod('greaterthan', function (value, element, param) {
        return this.optional(element) || parseFloat(value) >= parseFloat($(param).val());
    }, 'Invalid value');


    $('.activeDeactive').on('click', function () {
        var e = $(this);
        bootbox.confirm("Are you sure you want to change the status of this?", function (result) {
            if (result) {
                id = e.attr('data-id');
                calltype = e.attr('data-type');
                status = e.attr('data-status');

                jQuery.ajax({
                    url: ajax_url + "/user/changestatus",
                    data: {
                        'id': e.attr('data-id'),
                        type: calltype,
                        status: e.attr('data-status'),
                        field: e.attr('data-field')
                    },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        e.html('<img src="' + ajax_url + '/images/loaders/loader4.gif">');
                    },
                    complete: function () {

                    },
                    success: function (json) {
                        if (json.exception_message) {
                            bootbox.dialog({
                                closeButton: true,
                                message: json.exception_message,
                                title: "Alert",
                                buttons: {
                                    main: {
                                        label: "Ok",
                                        className: "btn-danger",
                                        callback: function () {

                                        }
                                    }
                                }
                            });
                        } else if (json.success) {
                            if (json.status == '1') {
                                e.html('<img data-tooltip="tooltip" src="' + ajax_url + '/images/status_green.png" alt="Active" title="Active , click here to deactivate">');
                                e.attr('data-status', json.status);
                                e.attr('data-type', calltype);
                                e.attr('data-id', id);
                            }
                            else {
                                e.html('<img data-tooltip="tooltip" src="' + ajax_url + '/images/status_red.png" alt="Inactive" title="Inactive , click here to activate">');
                                e.attr('data-status', json.status);
                                e.attr('data-type', calltype);
                                e.attr('data-id', id);
                            }
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                    }
                });
            }
        });
    });

    $(".changecompany").on('click', function () {
        id = $(this).data('companyid');
        name = $(this).data('companyname');
        if (id != "" && name != "") {
            jQuery.ajax({
                url: ajax_url + "/user/changecompany",
                data: {
                    'id': id,
                    'name': name,
                },
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (json) {
                    if (json.exception_message) {
                        bootbox.dialog({
                            closeButton: true,
                            message: json.exception_message,
                            title: "Alert",
                            buttons: {
                                main: {
                                    label: "Ok",
                                    className: "btn-danger",
                                    callback: function () {

                                    }
                                }
                            }
                        });
                    } else if (json.success) {
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        }
    });

    //purcahse request form validation


    $('#i_ref_project_id').change(function () {
        var project_id = $(this).val();
        if (project_id != '')
        {
            jQuery.ajax({
                url: ajax_url + "purchase_requests/get_wbs_list",
                data: {
                    'i_ref_company_id': $('#i_ref_company_id').val(),
                    'project_id': project_id,
                },
                type: 'post',
                dataType: 'json',
                success: function (json) {
                    if (json.response.status == 'success') {
                        $('.wbs-list').html(json.response.wbs);
                    }
                }
            });
        }
        else
        {
            $('.wbs-list').html("<option value=''>--Select WBS--</option>");
        }
            $('.sub-pkg-list').html("<option value=''>--Select Package--</option>");
            $('.work-pkg-list').html("<option value=''>--Select Work Package--</option>");
    });
    //get list of cost centers
    $('#i_ref_department_id').change(function () {
        var department_id = $(this).val();
        var project_id = $('#i_ref_project_id').val();
        if (department_id != '')
        {
            jQuery.ajax({
                url: ajax_url + "purchase_requests/get_cc_list",
                data: {
                    i_ref_company_id: $('#i_ref_company_id').val(),
                    department_id: department_id,
                    project_id: project_id
                },
                type: 'post',
                dataType: 'json',
                success: function (json) {
                    $('.cost-centers-list').html(json.cc_options);
                }
            });
        }
        else
        {
            $('.cost-centers-list').html("<option value=''>--Select Cost Center--</option>");
        }
        //reset Wbs
        $('.sub-pkg-list').val('');
        $('.work-pkg-list').html("<option value=''>--Select Work Package--</option>");
    });


    $('.wbs-list').on('click', function(){        
    
        var wbs_id = $(this).val();
        var i = $(this).attr('item-count');
        if (wbs_id != '')
        {
            jQuery.ajax({
                url: ajax_url + "purchase_requests/get_wbs_list",
                data: {
                    'i_ref_company_id': $('#i_ref_company_id').val(),
                    'wbs_id': wbs_id,
                },
                type: 'post',
                dataType: 'json',
                success: function (json) {
                    if (json.response.status == 'success') {
                        $('#i_ref_subpackage_group_id' + i).html(json.response.wbs);
                    }
                }
            });
        }
        else
        {
            $('#i_ref_subpackage_group_id' + i).html("<option value=''>--Select Package--</option>");
        }
    });
    //get list of work package
    $(document).on('change', '.sub-pkg-list', function (e) {
        var wbs_sub_id = $(this).val();
        var i = $(this).attr('item-count');
        if (wbs_sub_id != '')
        {
            jQuery.ajax({
                url: ajax_url + "purchase_requests/get_wbs_list",
                data: {
                    i_ref_company_id: $('#i_ref_company_id').val(),
                    wbs_sub_id: wbs_sub_id,
                    i_ref_department_id: $('#i_ref_department_id').val(),
                    i_ref_project_id: $('#i_ref_project_id').val()
                },
                type: 'post',
                dataType: 'json',
                success: function (json) {
                    if (json.response.status == 'success') {
                        $('#i_ref_workpackage_id' + i).html(json.response.wbs);
                    }
                }
            });
        }
        else
        {
            $('#i_ref_workpackage_id' + i).html("<option value=''>--Select Work Package--</option>");
        }
    });

    $("#add-new-item").click(function () {
        var i = $('#line-item-count').val();
        var project_id = $('#i_ref_project_id').val();
        jQuery.ajax({
            url: ajax_url + "purchase_requests/new_line_item",
            data: {
                'i': i,
                'project_id': project_id,
                i_ref_company_id: $('#i_ref_company_id').val(),
                department_id: $('#i_ref_department_id').val()
            },
            type: 'post',
            beforeSend: function () {
                $("#loader").html("<img src='" + ajax_url + "images/loaders/loader3.gif'>");
                $(".invoices_amount").html('0');
            },
            success: function (response) {
                $("#loader").html('');
                if (response != '') {
                    $('.line-items').append(response);
                    $('#line-item-count').val(parseInt(i) + 1);

                    $("#noOfLineItems").html($('#line-item-count').val());
                }
            }
        });
    });

    $(".delete-item").on('click', function(){

        var id = $(this).attr('id');
        $('.' + id).remove();

        var i = $('#line-item-count').val();
        $('#line-item-count').val(parseInt(i) - 1);
        $("#noOfLineItems").html($('#line-item-count').val());

        var i = 1;
        $('.item-section').each(function () {
            $(this).find('.list-item-name').html(i);
            i = i + 1;
        });

        calculatePrice();
    });


    $('.i_price,.i_qty,#PurchaseRequestVcTax').keyup(function(){
       calculatePrice();
    });

    $('.importance-radio').click(function () {
        var imp = $(this).html();
        $("#vc_importance").val(imp);
    });

    $('.approval-radio').click(function () {
        var imp = $(this).html();
        $("#vc_approval").val(imp);
    });

});
function calculatePrice()
{
    var sum = 0;
    var tax = $("#PurchaseRequestVcTax").val();
    $('.item-section').each(function () {
        var q = $(this).find('.i_qty').val();

        if (q == '')
            q = 0;

        var p = $(this).find('.i_price').val();
        if (p == '')
            p = 0;

        sum = sum + (parseInt(q) * parseInt(p));
    });
    $("#subTotalAmt").html(sum);

    if (tax == '')
        $("#totalAmt").html(sum);
    else
        $("#totalAmt").html(sum + parseInt(tax));
}

function validatePurchaseReq()
{
    $('#createPurchaseRequest').validate();
    var v = $('#createPurchaseRequest').valid();
    if (v == true)
    {
        var dataString = $("#createPurchaseRequest").serialize();
        jQuery.ajax({
            url: ajax_url + "purchase_requests/checkBugdet",
            data: dataString,
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $("#loader2").html("<img src='" + ajax_url + "images/loaders/loader3.gif'>");
            },
            success: function (json) {
                if (json.response.status == 'error') {
                    bootbox.dialog({
                        closeButton: true,
                        message: json.response.message,
                        title: "Alert",
                        buttons: {
                            success: {
                                label: "Yes",
                                className: "btn-success",
                                callback: function () {
                                    var string = {
                                        'i_ref_department_id': $('#i_ref_department_id').val(),
                                        'i_ref_company_id': $('#i_ref_company_id').val(),
                                        'i_ref_bu_id': $('#i_ref_bu_id').val(),
                                        'i_ref_user_id': $('#i_ref_originator_id').val(),
										'total_amt': $('#totalAmt').html().trim(),
                                        'url': 'Roles/get_parent_id.json',
										'flag': json.response.flag
                                    };
                                    get_service_data(string);
                                }
                            },
                            main: {
                                label: "No",
                                className: "btn-danger",
                                callback: function () {
                                    $("#loader2").html('');
                                },
                            }
                        }
                    });
                }
                else if (json.response.status == 'success') {
                    $("#loader2").html('');
                    $('#createPurchaseRequest').attr('onsubmit', '');
                    $('#createPurchaseRequest').submit();
                }
            }
        });
    }
    return false;
}

function get_service_data(dataString)
{
	if(dataString.flag == 1){
		bootbox.dialog({
			closeButton: true,
			message: 'Your budget has exceeded the limit of CC Plan and WBS Plan. Do you want to proceed?',
			title: "Alert",
			buttons: {
				success: {
					label: "Yes",
					className: "btn-success",
					callback: function () {
							jQuery.ajax({
								url: ajax_url + "purchase_requests/get_service_data",
								data: dataString,
								type: 'post',
								dataType: 'json',
								success: function (json) {
									$("#parent_id").val(json.response.UserDetail.i_ref_user_id);
									$('#e_cc_wbs').val(dataString.flag);
									$('#createPurchaseRequest').attr('onsubmit', '');
									$('#createPurchaseRequest').submit();
									$("#loader2").html('');
								}
							});
					}
				},
				main: {
					label: "No",
					className: "btn-danger",
					callback: function () {
						$("#loader2").html('');
					},
				}
			}
		});
	}else{
		jQuery.ajax({
			url: ajax_url + "purchase_requests/get_service_data",
			data: dataString,
			type: 'post',
			dataType: 'json',
			success: function (json) {
				$("#parent_id").val(json.response.UserDetail.i_ref_user_id);
				$('#e_cc_wbs').val(dataString.flag);
				$('#createPurchaseRequest').attr('onsubmit', '');
				$('#createPurchaseRequest').submit();
				$("#loader2").html('');
			}
		});
	}
   
}

function changeLoadingText(e) {
    var loadingText = e.data('loading-text');
    var afterLoadingText = e.data('after-loading-text');
    var disableEnable = (e.attr('disabled') ? false : true);
    e.val(loadingText).attr('disabled', disableEnable);
    e.data('loading-text', afterLoadingText);
    e.data('after-loading-text', loadingText);
}

function autoRefresh(fnc, dLay) {
    window[fnc]();
    setTimeout(function () {
        autoRefresh(fnc, dLay);
    }, parseInt(dLay));
}

function clear_form_elements(formm) {

    $(formm).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'hidden':
            case 'text':

            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

function getInvoiceAmount()
{
    var fromDate = $("#DateFrom").val();
    var toDate = $("#DateTo").val();
    var cc = $("#InvoiceItemCostCenterName").val();

    $("#InvoiceReportForm").validate();
    if (!$('#InvoiceReportForm').valid()) {
        return false;
    }
    jQuery.ajax({
        url: ajax_url + "reports/get_invoice_amount",
        data: {'from': fromDate, 'to': toDate, 'costCenter': cc},
        type: 'post',
        dataType: 'json',
        beforeSend: function () {
            $("#loader").html("<img src='" + ajax_url + "images/loaders/loader4.gif'>");
            $(".invoices_amount").html('0');
        },
        success: function (json) {
            $("#loader").html('');
            if (json.response.status == 'error') {
                bootbox.dialog({
                    closeButton: true,
                    message: json.response.message,
                    title: "Alert",
                    buttons: {
                        main: {
                            label: "Ok",
                            className: "btn-danger",
                            callback: function () {

                            }
                        }
                    }
                });
            } else if (json.response.status == 'success') {
                $(".invoices_amount").html(json.response.price);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {

        }
    });
}

function exportData(param1)
{
    var param2 = $('.originatorList').val();
    window.open(ajax_url + 'reports/pending_purchased_request/' + param1 + '/export/' + param2, '_blank');
}
