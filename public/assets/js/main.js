// #https://stackoverflow.com/questions/46643667/javascript-function-is-not-defined-with-laravel-mix
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//
function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}

window.SavingActivationLeadFNE = function (url, form, redirect, value) {
    // function SavingActivationLead(url, form, redirect) {
    $("#remarks").val(value);
    if (confirm("are you sure all information accurate, Kindly make sure before proceed?")) {
        // console.log("Accepted")
        // } else {
        // console.log("Declined")
        var rizwan = document.getElementById(form);
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#loading_num3").show();
                // // $(".request_call").hide();
                $('.waves-button-input').prop('disabled', true);
                // $('#' + btn).prop('disabled', true);

            },
            success: function (data) {
                // alert(data);
                if ($.isEmptyObject(data.error)) {
                    alert(data.success + "Hello");
                    $("#loading_num3").hide();
                    $('.waves-button-input').prop('disabled', false);
                    // window.location.href = 'https://soft.riuman.com/admin/activation'
                    window.location.href = redirect;
                } else {
                    $('.waves-button-input').prop('disabled', false);
                    // alert("S");
                    $("#loading_num3").hide();

                    printErrorMsg(data.error);
                }
            },
            error: function (data) {
                printErrorMsg(data.responseJSON);

                // alert(data.responseJSON);
                // console.log(data.responseJSON);
                // alert("fail");
            }

        });
    }

}
window.SavingActivationLead = function (url, form, redirect) {
    // function SavingActivationLead(url, form, redirect) {
    // $("#remarks").val(value);
    if (confirm("are you sure all information accurate, Kindly make sure before proceed?")) {
        // console.log("Accepted")
        // } else {
        // console.log("Declined")
        var rizwan = document.getElementById(form);
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#loading_num3").show();
                // // $(".request_call").hide();
                $('.waves-button-input').prop('disabled', true);
                // $('#' + btn).prop('disabled', true);

            },
            success: function (data) {
                // alert(data);
                if ($.isEmptyObject(data.error)) {
                    alert(data.success + "Hello");
                    $("#loading_num3").hide();
                    $('.waves-button-input').prop('disabled', false);
                    // window.location.href = 'https://soft.riuman.com/admin/activation'
                    window.location.href = redirect;
                } else {
                    $('.waves-button-input').prop('disabled', false);
                    // alert("S");
                    $("#loading_num3").hide();

                    printErrorMsg(data.error);
                }
            },
            error: function (data) {
                printErrorMsg(data.responseJSON);

                // alert(data.responseJSON);
                // console.log(data.responseJSON);
                // alert("fail");
            }

        });
    }

}
//
// function VerifyLeadBlog(url, form, redirect) {
//     var rizwan = document.getElementById(form);
//     tinymce.triggerSave();
//
window.CallLogForm = function (id, form, url) {
    // function CallLogForm(id, form, url) {
    var rizwan = document.getElementById(form);
    // alert(id)
    // $("#btn_"+id).removeClass('btn-danger'); //versions newer than 1.6
    // $("#btn_"+id).AddClass('btn-danger'); //versions newer than 1.6
    // alert(id);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#request_login" + id).show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (msg) {
            //    alert(msg);
            if (msg == 1) {
                $("#btn_" + id).prop('value', 'Submitted'); //versions newer than 1.6
                $("#btn_" + id).prop('disabled', true); //versions newer than 1.6
            } else {
                alert("Something Wrong");
            }
            // var k = msg.split('###');
            // $("#dob").val(k[1]);
            // $("#expiry").val(k[2]);
            // $("#activation_emirate_expiry").val(k[2]);
            // var age = getAge(k[1]);
            // $("#age").val(age);
            // //  alert(age);

            // if (age < 21) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Age less than 21',
            //         text: 'User is not eligible for this package!',
            //         //  footer: '<a href>Why do I have this issue?</a>'
            //     })
            // }
        }
        // }
    });

}
//
//
window.CallLogFormFNE = function (id, url, redirectForm) {
    // alert(url);
    // function CallLogForm(id, form, url) {
    // var rizwan = document.getElementById(form);
    // alert(id)
    var status = $("#remarks_call_log_" + id).val();
    var number_id = $("#number_id_" + id).val();
    var user_id = $("#userid_" + id).val();
    var systemid = $("#systemid" + id).val();
    console.log(systemid);
    // console.log(number_id);
    // $("#btn_"+id).removeClass('btn-danger'); //versions newer than np1.6
    // $("#btn_"+id).AddClass('btn-danger'); //versions newer than 1.6
    // alert(id);
    // console.log(remarks);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
            number_id: number_id,
            user_id: user_id,
            status: status,
            systemid: systemid,
        },
        url: url,
        cache: false,
        beforeSend: function () {},
        success: function (msg) {
            // console.log(msg);
            if (msg == 1) {
                $("#btn_" + id).prop('value', 'Submitted'); //versions newer than 1.6
                $("#btn_" + id).prop('disabled', true); //versions newer than 1.6
                console.log(status);
                if (status == 'NewFNELead' || status == 'UpgradeFNELead') {
                    console.log(redirectForm);
                    window.location.href = redirectForm;
                }
            } else {
                alert("Something Wrong");
            }
        }
    });

}
//
window.VerifyLeadBlog = function (url, form, redirect) {
    // function SavingActivationLead(url, form, redirect) {
    if (confirm("are you sure all information accurate, Kindly make sure before proceed?")) {
        // console.log("Accepted")
        // } else {
        // console.log("Declined")
        var rizwan = document.getElementById(form);
        tinymce.triggerSave();

        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#loading_num3").show();
                // // $(".request_call").hide();
                $('.waves-button-input').prop('disabled', true);
                // $('#' + btn).prop('disabled', true);

            },
            success: function (data) {
                // alert(data);
                if ($.isEmptyObject(data.error)) {
                    alert(data.success);
                    $("#loading_num3").hide();
                    $('.waves-button-input').prop('disabled', false);
                    // window.location.href = 'https://soft.riuman.com/admin/activation'
                    window.location.href = redirect;
                } else {
                    $('.waves-button-input').prop('disabled', false);
                    // alert("S");
                    $("#loading_num3").hide();

                    printErrorMsg(data.error);
                }
            },
            error: function (data) {
                $('.waves-button-input').prop('disabled', false);
                printErrorMsg(data.responseJSON);

                // alert(data.responseJSON);
                // console.log(data.responseJSON);
                // alert("fail");
            }

        });
    }

}

// window.setlocale = function (code) {
//     console.log(code);
// }

// alert("Zoom");
// function OnLo(){
//     alert("Zoom");
// }
// OnLo();

window.NameApi = function (url, form) {
    // alert(form);
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $("#loading_num1").show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (msg) {
            $("#loading_num1").hide();
            //    alert(msg);
            var k = msg.split('###');
            // console.log(k[3] + ' ' + $k[4]);
            // $("#front_id").val(k[3]);
            $("#full_name").val(k[0]);
            $("#emirate_id").val(k[1]);
            $("#emirate_expiry").val(k[2]);
            $("#dob").val(k[3]);
            // $("#name").val(k[1]);
            // $("#CustomerNameAct").val(k[1]);
            // $("#emirate_id_form").val(k[2]);
            // $("#activation_emirate_expiry").val(k[2]);
            //  $("#application_date").val(k[3] + ' ' + k[4]);
        },
        error: function (data) {
            $('.waves-button-input').prop('disabled', false);
            printErrorMsg(data.responseJSON);

            // alert(data.responseJSON);
            // console.log(data.responseJSON);
            // alert("fail");
        }
        // }
    });
    // }
    // }));
}

window.myconversation = function () {
    // alert($(".chat_input").val());
    var remarks = $(".chat_input").val();
    var id = $("#leadid").val();
    var url = $("#ChatAjaxUrl").val();
    var saler_id = $("#saler_id").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
            remarks: remarks,
            saler_id: saler_id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            $(".chat_input").val('');
            // $(".chat_input").empty();
        },
        success: function (res) {
            // alert(res);
            // console.log(res);
            var data = $.trim(res);
            // alert(data);
            // $("#leadno").text(data);
            $(".msg_container_base").html(data);
            // $(".msg_sent").text('<p>Lorem ipsum</p>');
            // location.reload();
            // if (res) {
            //     $('#package_id').append($("<option/>", {
            //         value: '',
            //         text: 'Select'
            //     }));
            //     $.each(res, function (key, value) {

            //         $('#package_id').append($("<option/>", {
            //             value: key,
            //             text: value
            //         }));
            //     });
            // }
            // var value = $.trim(value);
            // $("#fetch_teacher").html(value);
        }
    });
}
window.myconversation2 = function (redirect) {
    // alert($(".chat_input").val());
    var remarks = $(".chat_input").val();
    var id = $("#leadid").val();
    var url = $("#ChatAjaxUrl").val();
    var saler_id = $("#saler_id").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
            remarks: remarks,
            saler_id: saler_id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            $(".chat_input").val('');
            // $(".chat_input").empty();
        },
        success: function (res) {
            if ($.isEmptyObject(res.error)) {
                alert(res.success + "Hello");
                $("#loading_num3").hide();
                $('.waves-button-input').prop('disabled', false);
                // window.location.href = 'https://soft.riuman.com/admin/activation'
                window.location.href = redirect;
            } else {
                $('.waves-button-input').prop('disabled', false);
                // alert("S");
                $("#loading_num3").hide();

                printErrorMsg(data.error);
            }
        }
    });
}
//
// function change_feedback(id)
window.change_feedback = function (id) {
    // console.log(id)
    // var a =id;
    var a = $("#remarks_call_log_" + id).val();
    console.log("HHO" + a);
    if (a == 'Follow up') {
        $("#RemarksLabel").show();
        $("#other_" + id).show();
    } else {
        $("#RemarksLabel").hide();
        $("#other_" + id).hide();
    }
}
//
window.MyPlanFNE = function (id) {
    // console.log(id)
    // var a =id;
    var a = $("#plans").val();
    // console.log("HHO" + a);
    if (a == 5 || a == 6 || a == 7 || a == 8) {
        $("#fne_req_box").show();
        // $("#other_" + id).show();
        $("#is_old").hide();
    } else {
        $("#fne_req_box").hide();
        $("#is_old").show();
        // $("#other_" + id).hide();
    }
}
//
//
window.CheckFNEType = function (id) {
    // console.log(id)
    // var a =id;
    var a = $("#leadtype").val();
    // console.log("HHO" + a);
    if (a == 'FNE') {
        $("#jamgae").hide();
        // $("#other_" + id).show();
        // $("#is_old").hide();
    } else {
        $("#jamgae").show();
        // $("#is_old").show();
        // $("#other_" + id).hide();
    }
}
//
window.CheckRemarkZone = function (id) {
    // console.log(id)
    // var a =id;
    var a = $("#is_status").val();
    // console.log("HHO" + a);
    if (a == 'OutZone' || a == 'Invalid' || a == 'Commercial' || a == 'not_eligible') {
        // $("#jamgae").hide();
        $("#DuResource").prop('disabled', true);

        // $("#other_" + id).show();
        // $("#is_old").hide();
    } else {
        $("#DuResource").prop('disabled', false);
        // $("#jamgae").show();
        // $("#is_old").show();
        // $("#other_" + id).hide();
    }
}
//
window.uploadImageCMID = function (url, id) {
    var formData = new FormData();
    formData.append('imageFile', document.getElementById('imageFile' + id).files[0]);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log('Image uploaded successfully');
        },
        error: function (xhr, status, error) {
            console.error('Error uploading image');
        }
    });
}
// function change_feedback(id)
window.account_status = function (id) {
    // console.log(id)
    // var a =id;
    var a = $("#account_status_" + id).val();
    // console.log("HHO" + a);
    if (a == '') {
        $("#BtnStatus_" + id).prop('disabled', true);
        $("#BtnStatus_" + id).removeClass('btn-success');
        $("#BtnStatus_" + id).addClass('btn-secondary');
        // $("#BtnStatus_"+id).prop('disabled',);
        // $("#other_" + id).show();
    } else {
        $("#BtnStatus_" + id).prop('disabled', false);
        $("#BtnStatus_" + id).removeClass('btn-secondary');
        $("#BtnStatus_" + id).addClass('btn-success');
        // $("#RemarksLabel").hide();
        // $("#other_" + id).hide();
    }
}
//
window.checkbill = function (url, type, id, number) {
    //    console.log(id);
    console.log(url);
    console.log(type);
    // $("#dpExist").show();
    // var number = $("#number"+id).val();
    //    var type = 'number';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            number: number,
            type: type
            //    data:data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
            $("#results").html('<p>Loading Wait</p>');
            $('.waves-button-input').prop('disabled', true);
        },
        success: function (msg) {
            // alert(msg);
            $("#open_amount_" + id).val(msg);
            // $('.waves-button-input').prop('disabled', false);
            // window.location.reload();
            // window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
//


// function VerifyLead(url, form, redirect) {
window.VerifyLead = function (url, form, redirect) {
    if (confirm("are you sure all information accurate, Kindly make sure before proceed?")) {

        var rizwan = document.getElementById(form);
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#loading_num3").show();
                // // $(".request_call").hide();
                $('.waves-button-input').prop('disabled', true);
                // $('#' + btn).prop('disabled', true);

            },
            success: function (data) {
                // alert(data);
                if ($.isEmptyObject(data.error)) {
                    // alert(data.success);
                    // window.location.href = data.success;
                    // // window.open = data.success;
                    // window.open(data.success, '_blank');
                    setTimeout(() => {
                        $("#loading_num3").hide();
                        $('.waves-button-input').prop('disabled', false);
                        // alert(data.success);
                        alert("wait meanwhile we are redirecting you...");
                        window.location.href = redirect;
                    }, 20);
                } else {
                    $('.waves-button-input').prop('disabled', false);
                    // alert("S");
                    $("#loading_num3").hide();

                    printErrorMsg(data.error);
                }
            }

        });
    }
}




// pre_verification_js
$(".box:checked").next().addClass("blue");


//
// $('#remarks_').change(function () {
//     // alert("eooo");
//     $('#province').attr('disabled', this.value == "other1");
// });
//
$('#state').change(function () {
    // alert("eooo");
    $('#province').attr('disabled', this.value == "other1");
});

$("#state2").change(function () {
    $("#province2").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state3").change(function () {
    $("#province3").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state_gender").change(function () {
    //   alert("s");
    $("#p_gender3").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state4").change(function () {
    $("#province4").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state_emirates").change(function () {
    // alert("s");
    $("#province_emirates").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state_area").change(function () {
    // alert("s");
    $("#state__area").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state_language").change(function () {
    // alert("s");
    $("#province_language").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state5").change(function () {
    $("#province5").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state_emirate_num").change(function () {
    $("#province_original_id1").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state6").change(function () {
    $("#province6").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state7").change(function () {
    $("#province7").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state8").change(function () {
    $("#province8").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state9").change(function () {
    $("#province9").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state10").change(function () {
    $("#province10").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state11").change(function () {
    $("#province11").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state12").change(function () {
    $("#province12").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state13").change(function () {
    $("#province13").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state14").change(function () {
    $("#province14").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#device_duration_state").change(function () {
    $("#device_duration").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state15").change(function () {
    $("#province15").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state16").change(function () {
    $("#province16").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});

$("#state17").change(function () {
    $("#province17").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state18").change(function () {
    $("#province18").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#state19").change(function () {
    $("#province19").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
});
//
$('#province').change(function () {
    $('#province1').val($('#province').val());
});
$('#state__area').change(function () {
    $('#state_area_hidden').val($('#state__area').val());
});

$('#province2').change(function () {
    $('#province22').val($('#province2').val());
});

$('#p_gender3').change(function () {
    $('#p_gender').val($('#p_gender3').val());
});
$('#province3').change(function () {
    $('#province33').val($('#province3').val());
});
$('#province4').change(function () {
    $('#province44').val($('#province4').val());
});
$('#province_original_id1').change(function () {
    $('#province_original_id11').val($('#province_original_id1').val());
});
$('#province5').change(function () {
    $('#province55').val($('#province5').val());
});
$('#province6').change(function () {
    $('#province66').val($('#province6').val());
});
$('#province7').change(function () {
    $('#province77').val($('#province7').val());
});
$('#province8').change(function () {
    $('#province88').val($('#province8').val());
});
$('#province9').change(function () {
    $('#province99').val($('#province9').val());
});
$('#province10').change(function () {
    $('#province100').val($('#province10').val());
});
$('#province11').change(function () {
    $('#province111').val($('#province11').val());
});
$('#province12').change(function () {
    $('#province112').val($('#province12').val());
});
$('#province13').change(function () {
    $('#province113').val($('#province13').val());
});
$('#province14').change(function () {
    $('#province114').val($('#province14').val());
});
$('#province15').change(function () {
    $('#province115').val($('#province15').val());
});
$('#province16').change(function () {
    $('#province116').val($('#province16').val());
});
$('#province17').change(function () {
    $('#province117').val($('#province17').val());
});
$('#province_emirates').change(function () {
    $('#province__emirates').val($('#province_emirates').val());
});
$('#province_language').change(function () {
    $('#province__language').val($('#province_language').val());
});
$('#province18').change(function () {
    $('#province118').val($('#province18').val());
});
$('#province19').change(function () {
    $('#province119').val($('#province19').val());
});


$(document).on('click', '#icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $(".chat-window:last-child").css("margin-left");
    size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $("#chat_window_1").clone().appendTo(".container");
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $("#chat_window_1").remove();
});



// function imageIsLoaded1(e) {
window.imageIsLoaded1 = function (e) {
    $("#myImg1").show();
    $('#myImg1').attr('src', e.target.result);
};
$(function () {
    $("#front_img").change(function () {
        // console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded1;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

// function imageIsLoaded1(e) {
window.imageIsLoadedProfile = function (e) {
    $("#myImg").show();
    $('#myImg').attr('src', e.target.result);
};
$(function () {
    $("#profile_pic").change(function () {
        // console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoadedProfile;
            reader.readAsDataURL(this.files[0]);
        }
    });
});
// function imageIsLoaded1(e) {
window.imageIsLoadedCnicFront = function (e) {
    $("#CnicFrontImg").show();
    $('#CnicFrontImg').attr('src', e.target.result);
};
$(function () {
    $("#CnicFront").change(function () {
        // console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoadedCnicFront;
            reader.readAsDataURL(this.files[0]);
        }
    });
});
// function imageIsLoaded1(e) {
window.imageIsLoadedCnicBack = function (e) {
    $("#CnicBackImg").show();
    $('#CnicBackImg').attr('src', e.target.result);
};
$(function () {
    $("#CnicBack").change(function () {
        // console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoadedCnicBack;
            reader.readAsDataURL(this.files[0]);
        }
    });
});


// window.VerifyLead = function (url, form, redirect)
window.imageIsLoaded2 = function (e) {
    $("#myImg2").show();

    $('#myImg2').attr('src', e.target.result);
};
$(function () {
    $("#back_img").change(function () {
        console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded2;
            reader.readAsDataURL(this.files[0]);
        }
    });
});
window.imageIsLoaded3 = function (e) {
    $("#myImg3").show();

    $('#myImg3').attr('src', e.target.result);
};
$(function () {
    $("#additional_documents").change(function () {
        console.log('ok');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded3;
            reader.readAsDataURL(this.files[0]);
        }
    });
});
$('#inlineRadio1').click(function () {
    $("#fullemirateid").show();
    $("#lastfive").hide();
    $("#emirate_id_last_five").val('');
});
$('#inlineRadio2').click(function () {
    $("#lastfive").show();
    $("#fullemirateid").hide();
    $("#emirate_id").val('');


});

$("#lead_type").change(function () {
    // alert("s");
    // $("#state__area").attr("disabled", this.value == "other1");
    if (this.value == 'P2P') {
        $("#InlineRadioCheck").show();
    } else {
        $("#InlineRadioCheck").hide();
    }
    // or $("#flap-drop").toggle(this.value!="23");
});
$("#status_entry").change(function () {
    // alert("s");
    // $("#state__area").attr("disabled", this.value == "other1");
    if (this.value == 'Not Available') {
        $(".showme").hide();
        $("#btnEntry").prop('disabled', false);
        // $('#' + btn).prop('disabled', true);
        //
    } else {
        $(".showme").show();
        $("#btnEntry").prop('disabled', true);
        // $("#InlineRadioCheck").hide();
    }
    // or $("#flap-drop").toggle(this.value!="23");
});
$('#address').change(function () {
    if ($.trim($('#address').val()).length < 1) {
        $("#btnEntry").prop('disabled', true);
        console.log("Address");
        // $('#output').html('Someway your box is being reported as empty... sadness.');

    } else {
        $("#btnEntry").prop('disabled', false);
        console.log("Address2");

        // $('#output').html('Your users managed to put something in the box!');
        //No guarantee it isn't mindless gibberish, sorry.

    }
});

//
$('#latest_status').change(function () {
 if (this.value == 'Cancelled') {
        $("#commisionDiv").show();
        // $("#btnEntry").prop('disabled', false);
        // $('#' + btn).prop('disabled', true);
        //
    } else {
        $("#commisionDiv").hide();

        // $(".showme").show();
        // $("#btnEntry").prop('disabled', true);
        // $("#InlineRadioCheck").hide();
    }
});
window.LoadMNPReport = function (url, status, loadingUrl) {
    var cc = $("#cc").val();
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            status: status,
            cc: cc,
        },
        beforeSend: function () {
            $("#AdminDashboard").html('<img src="' + loadingUrl + '" class="img-fluid text-center offset-md-6" style="width:35px;"></img>');
            // $("#loading_num3").html('<p> Loading </p>');
        },
        success: function (data) {
            // alert(data);
            // $("#loading_num3").hide();
            $("#AdminDashboard").html(data);
        }
    });
}

// WhatsApp MEssage to Client

window.BulkAssigner = function (url, form) {
    // function BulkAssigner(url, form) {
    // alert(form);
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#request_login" + id).show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
            $("#loading_num").show();
        },
        success: function (msg) {
            //    alert(msg);
            if (msg == 1) {
                $("#loading_num").hide();
                location.reload();
            } else {
                alert("Something wrong");
            }
            //  var k = msg.split('###');
            // // console.log(k[3] + ' ' + $k[4]);
            //  $("#name").val(k[1]);
            //  $("#CustomerNameAct").val(k[1]);
            //  $("#emirate_id").val(k[2]);
            //  $("#activation_emirate_expiry").val(k[2]);
            //  $("#application_date").val(k[3] + ' ' + k[4]);
        }
        // }
    });
    // }
    // }));
}
window.MyWhatsApp = function (id, data, url) {
    // console.log(number);
    // $("#dpExist").show();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            data: data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
        },
        success: function (msg) {
            // alert(msg);
            //    alert(msg);
            window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
window.GetNewNumber = function (id, url) {
    console.log(id);
    // $("#dpExist").show();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            //    data:data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
        },
        success: function (msg) {
            // alert(msg);
            //    alert(msg);
            if (msg == 1) {
                window.location.reload();
            } else {
                alert("Do Contact IT Team");
            }
            // window.location.reload();
            // window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
window.ClearDuplicate = function (id, url) {
    console.log(id);
    // $("#dpExist").show();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            //    data:data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
        },
        success: function (msg) {
            // alert(msg);
            //    alert(msg);
            if (msg == 1) {
                window.location.reload();
            } else {
                alert("Do Contact IT Team");
            }
            // window.location.reload();
            // window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
//
window.isNumberKey = function (evt) {
    var t = (evt.which) ? evt.which : event.keyCode;
    return !(t > 31 && (t < 48 || t > 57))
}
//
window.QuickPayChecker = function (url, type) {
    //    console.log(id);
    console.log(url);
    console.log(type);
    // $("#dpExist").show();
    var number = $("#number").val();
    //    var type = 'number';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            number: number,
            type: type
            //    data:data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
            $("#results").html('<p>Loading Wait</p>');
            $('.waves-button-input').prop('disabled', true);
        },
        success: function (msg) {
            // alert(msg);
            $("#results").html(msg);
            $('.waves-button-input').prop('disabled', false);
            // window.location.reload();
            // window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
// window.AccountStatus = function (id,url) {
//        console.log(id);
//        // $("#dpExist").show();
//        $.ajax({
//            type: "POST",
//            url: url,
//            data: {
//                id: id,
//             //    data:data,
//            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//            // contentType: false, // The content type used when sending data to the server.
//            // cache: false, // To unable request pages to be cached
//            // processData: false,
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            },
//            beforeSend: function () {
//                // $("#loading_num2").show();
//            },
//            success: function (msg) {
//                // alert(msg);
//             //    alert(msg);
//             if(msg == 1){
//                 window.location.reload();
//             }else{
//                 alert("Do Contact IT Team");
//             }
//             // window.location.reload();
//             // window.open(msg.success, '_blank');
//             // window.location.href = msg.success;

//            }
//            // }
//        });

// }


$('#select-all').click(function () {
    $(':checkbox').prop('checked', this.checked).change();
});


window.CheckSystemLog = function (url) {
    // console.log(id);
    var id = $("#logsystemid").val();
    // $("#dpExist").show();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id: id,
            //    data:data,
        }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        // contentType: false, // The content type used when sending data to the server.
        // cache: false, // To unable request pages to be cached
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            // $("#loading_num2").show();
        },
        success: function (msg) {
            // alert(msg);
            console.log(msg);
            var k = msg.split('###');
            $("#full_name").val(k[0]);
            $("#contact_number").val(k[1]);
            $("#alt_contact_number").val(k[1]);
            $("#account_id").val(k[2]);
            $("#fiveg_number").val(k[3]);
            $("#expiry").val(k[4]);
            //    alert(msg);
            // if (msg == 1) {
            //     window.location.reload();
            // } else {
            //     alert("Do Contact IT Team");
            // }
            // window.location.reload();
            // window.open(msg.success, '_blank');
            // window.location.href = msg.success;

        }
        // }
    });

}
//

window.check_location_url = function () {
    var location = $("#add_location").val();
    var longlat = /\/\@(.*),(.*),/.exec(location);
    console.log("sabtitut");
    console.log(longlat);
    console.log(location);
    if (longlat == null) {
        $("#location_error").html("<p class='alert alert-danger'>Please use Valid Url, or Complete URL, Sample: https://www.google.com/maps/place/Little+Hut+Restaurant/@25.2778584,55.3832735,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f5c375738485f:0xe7f816caec4bca51!8m2!3d25.2778584!4d55.3854622</p>");
        $(".btn").prop("disabled", true);
        $("#checker").prop("disabled", false);
    } else {
        $("#location_error").html("<p class='alert alert-dismissible alert-success'>Thank You for Valid URL !!</p>");
        var lng = longlat['1'];
        var lat = longlat['2'];
        $("#lat").val(lat);
        $("#lng").val(lng);
        //
        $("#lat_final").val(lat);
        $("#lng_final").val(lng);
        // $("#add_lat_lng").val(lat + ',' + lng);
        $(".btn").prop("disabled", false);

        // $('#result').html('lng: ' + lng + '<br />' + 'lat: ' + lat);
    }

}

$("#UpdateNum").on('click', function () {
    // alert("Working");
    $('#contact_number').removeAttr('readonly');
    $("#contact_number").val('');
    $("#contact_number").focus();
});
//
$('#CategoryType').on('change', function () {
    var selected = $(this).val();
    var PlanChangeUrl = $("#PlanChangeUrl").val();
    if(selected == 'P2P' || selected=='MNP'){
        $("#DocsList").show();
    }
    else{
        $("#DocsList").hide();
    }
    $.ajax({
        type: 'POST',
        url: PlanChangeUrl,
        data: {
            subcase: selected
        },
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            var $subcarousel = $('#plans').empty(); // remove previously loaded options
            for (i in data)
                $subcarousel.append('<option value = ' + data[i].id + '>' + data[i].plan_name + '</option>');
        }
    });
});
//
window.LoadPlanViewLead = function (selected, PlanChangeUrl,LeadId) {
    // var selected = $(this).val();
    var selected = $("#CategoryType").val();
    var PlanChangeUrl = $("#PlanChangeUrl").val();
    var leadid = $("#leadid").val();
    if(selected == 'P2P' || selected=='MNP'){
        $("#DocsList").show();
    }
    else{
        $("#DocsList").hide();
    }
    $.ajax({
        type: 'POST',
        url: PlanChangeUrl,
        data: {
            subcase: selected,
            leadid: leadid
        },
        // dataType: 'JSON',
        success: function (data) {
            console.log(data);
            $("#plans").html(data);
            // var $subcarousel = $('#plans').empty(); // remove previously loaded options
            // for (i in data)
            //     $subcarousel.append('<option value = ' + data[i].id + '>' + data[i].plan_name + '</option>');
        }
    });
}
//
window.UnMaskNumber = function (MaskUrl,id,eye) {

    $.ajax({
        type: 'POST',
        url: MaskUrl,
        data: {
            id: id,
            eye:eye,
        },
        // dataType: 'JSON',
        success: function (data) {
            // console.log(data);
            if(eye == 1){
                $(".fa-eye-slash").show();
                $(".fa-eye").hide();
            }else{
                $(".fa-eye-slash").hide();
                $(".fa-eye").show();
            }
            $("#contact_number").val(data);
            // var $subcarousel = $('#plans').empty(); // remove previously loaded options
            // for (i in data)
            //     $subcarousel.append('<option value = ' + data[i].id + '>' + data[i].plan_name + '</option>');
        }
    });
}

//
 $('#secretcode').select2({
     placeholder: 'Please Search Secret Code',
     // dropdownParent: $('#AddSkill'),
     // tags: true,
     minimumInputLength: 2,
     ajax: {
         url: '/admin/search-number?id=' + $("#secretcode").val(),
         dataType: 'json',
         delay: 250,
         processResults: function (data) {
             return {
                 results: $.map(data, function (item) {
                     return {
                         text: item.number,
                         id: item.number
                     }
                     // alert(item.number);
                 })
             };
         }
     }
 });
//
//
 $('#numbertocode').select2({
     placeholder: 'Please Search Number',
     // dropdownParent: $('#AddSkill'),
     // tags: true,
     minimumInputLength: 2,
     ajax: {
         url: '/admin/search-code?id=' + $("#numbertocode").val(),
         dataType: 'json',
         delay: 250,
         processResults: function (data) {
             return {
                 results: $.map(data, function (item) {
                     return {
                         text: item.number,
                         id: item.number
                     }
                     // alert(item.number);
                 })
             };
         }
     }
 });
//
 $('#searchlead').select2({
     placeholder: 'Please Search Lead # CT',
     // dropdownParent: $('#AddSkill'),
     // tags: true,
     minimumInputLength: 2,
     ajax: {
         url: '/admin/search-lead-number?id=' + $("#searchlead").val(),
         dataType: 'json',
         delay: 250,
         processResults: function (data) {
             return {
                 results: $.map(data, function (item) {
                     return {
                         text: item.number,
                         id: item.number
                     }
                     // alert(item.number);
                 })
             };
         }
     }
 });

 window.search_number_id = function(number) {
     // alert(form);
     var url = $("#number_search_url").val();
     console.log(url);
     console.log(number);
     // var number = $("#check").val();
     // var rizwan = document.getElementById(form);
     $.ajax({
         type: "POST",
         url: url,
         data: {
             number,
             number
         }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
         // contentType: false, // The content type used when sending data to the server.
         // cache: false, // To unable request pages to be cached
         // processData: false,
         beforeSend: function () {
             // $("#request_login" + id).show();
             // // $(".request_call").hide();
             // $('#' + btn).prop('disabled', true);
             $("#loading_num").show();
         },
         success: function (msg) {
             //    alert(msg);
             $("#mylead").html(msg);
             // if (msg == 1) {
             //     $("#loading_num").hide();
             //     location.reload();
             // } else {
             //     alert("Something wrong");
             // }
             //  var k = msg.split('###');
             // // console.log(k[3] + ' ' + $k[4]);
             //  $("#name").val(k[1]);
             //  $("#CustomerNameAct").val(k[1]);
             //  $("#emirate_id").val(k[2]);
             //  $("#activation_emirate_expiry").val(k[2]);
             //  $("#application_date").val(k[3] + ' ' + k[4]);
         }
         // }
     });
     // }
     // }));
 }


 $("#secretcode").on("change", function () {
     // console.log($(this).val());
     // console.log()
     // console.log()
     search_number_id($(this).val());
     // console.log($(this).val());
 });
 $("#searchlead").on("change", function () {
     // console.log($(this).val());
     // console.log()
     // console.log()
     search_number_id($(this).val());
     // console.log($(this).val());
 });
 $("#numbertocode").on("change", function () {
     // console.log($(this).val());
     // console.log()
     // console.log()
     search_number_id($(this).val());
     // console.log($(this).val());
 });


