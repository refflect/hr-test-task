
function getData(form) {
    let data = {};
    $('input, textarea, select', form).each(function(){
        if (this.name && this.name != '') {
        	data[this.name] = this.value;
        	if ( this.type == 'checkbox' ){
        		console.log(this.checked);
                data[this.name] = this.checked ? 1 : 0;
        	}
        }
    });
    return data;
}

function saveUser() {
    let postData = getData('#users_editor');
    console.log(postData);
    $.ajax({
        type: 'POST',
        url: "/user/save/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert(data['message']);
            if (data['success']) {
                location.reload();
            }
        }
    });
}

function deleteUser() {
    let postData = $("#user_id").val();

    console.log('delete user: ' + postData);
    $.ajax({
        type: 'POST',
        url: "/user/delete/",
        data: {'id' : postData},
        dataType: 'json',
        success: function(data) {
            console.log(data);
            alert(data['message']);
            if (data['success']) {
                location.reload();
            }
        }
    });
}

//> Update user
$(".row").click(function () {
    let data = {};
    $(this).find("td").each(function () {
        if ($(this).data('val') != undefined) {
            data[$(this).data('name')] = $(this).data('val');
        }
    })
    data['startdate'] = (data['startdate'] != undefined) ? data['startdate'] :  now();

    bindValues(data);
});

$(".js-tab_add").click(function () {
    $(".js-tab_update").removeClass('tab_active');
    $(this).addClass('tab_active');
    $(".users-editor.hidden").removeClass('hidden');
    $("#btn_user_delete").addClass('hidden');
    clearValues();
});

function bindValues(data) {
    console.log(data);
    $("#user_id").val(data.id);
    $("#user_name").val(data.name);
    $("#user_position").val(data.position);
    $("#user_status").prop('checked', data.status);
    $("#user_startdate").val(data.startdate);

    $(".users-editor.hidden").removeClass('hidden');
    $(".js-tab_add").removeClass('tab_active');
    $(".js-tab_update").addClass('tab_active');
    $("#btn_user_delete").removeClass('hidden');
}

function clearValues(){
    $("#user_id").val('');
    $("#user_name").val('');
    $("#user_position").val('');
    $("#user_status").prop('checked', true);
    $("#user_startdate").val(now());

}

//<

//> Helpers

function now(){
    return new Date().toISOString().slice(0,10);
}

//<