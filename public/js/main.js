/**
 * Created by Refflect on 04.10.2017.
 */

function addToCart(itemId){
    console.log('js - addToCart()');
    $.ajax({
        type: 'POST',
        async: 'false',
        url: '/cart/addtocart/' + itemId + '/',
        dataType: 'json',
        success: function(data){
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']),
                $('#addCart_' + itemId).hide(),
                $('#removeCart_' + itemId).show()
            }

        }
    });
}

function removeFromCart(itemId){
    console.log('js - removeFromCart('+itemId+')');
    $.ajax({
        type: 'POST',
        async: 'false',
        url: '/cart/removefromcart/' + itemId + '/',
        dataType: 'json',
        success: function(data){
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']),
                $('#addCart_' + itemId).show(),
                $('#removeCart_' + itemId).hide()
            }

        }
    });
}

function conversionPrice(itemId) {
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemTotalPrice = newCnt * itemPrice;

    $('#itemTotalPrice_' + itemId).html(itemTotalPrice);
}

function getData(obj_form) {
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
         if (this.name && this.name != '') {
             hData[this.name] = this.value;
             console.log('hData[' + this.name + '] = ' + this.value);
         }
    });
    return hData;
}

function registerNewUser() {
    var postData = getData('#registerBox');

    $.ajax({
        type: 'POST',
        async: 'false',
        url: "/user/register/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data['success']) {
                alert(data['message']);

                $('#registerBox').hide();
                $('#userLink').attr('href','/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show();
                //
                $('#loginBox').hide();
                $('btnSaveOrder').show();
            } else{
                alert(data['message']);
            }
        }
    });
}

function logout() {
    console.log('Logout');
    $.ajax({
        type: 'POST',
        url: '/user/logout/',
        success: function() {
            console.log('user logged out');
            $('#registerBox').show();
            $('#userBox').hide();
        }
    });
}

function login() {
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();

    var postData = "email=" + email + "&pwd=" + pwd;

    $.ajax({
        type: 'POST',
        async: 'false',
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data['success']) {
                $('#registerBox').hide();
                $('#loginBox').hide();

                $('#userLink').attr('href','/user/');
                $('#userLink').html(data['displayName']);
                $('#userBox').show();

                $('#name').val(data['name']);
                $('#phone').val(data['phone']);
                $('#adress').val(data['adress']);

                $('#btnSaveOrder').show();

                // $('#loginBox').hide();

            } else{
                alert(data['message']);
            }
        }
    });
}

function showRegisterBox() {
    $('#registerBoxHidden').toggleClass('hidden');
}

function updateUserData() {
    console.log('js - updateUserData');
    var phone = $('#newPhone').val();
    var name = $('#newName').val();
    var adress = $('#newAdress').val();
    var pwd1 = $('#newPwd1').val();
    var pwd2 = $('#newPwd2').val();
    var curPwd = $('#curPwd').val();

    var postData = {phone: phone,
        name: name,
        adress: adress,
        pwd1: pwd1,
        pwd2: pwd2,
        curPwd: curPwd
    };

    $.ajax({
        type: 'POST',
        async: 'false',
        url: "/user/update/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data['success']) {
                $('#userLink').html(data['userName']);
                alert(data['message']);
            } else{
                alert(data['message']);
            }
        }
    });
}

function saveOrder(){
    var postData = getData('form');
    $.ajax({
        type: 'POST',
        async: 'false',
        url: "/cart/saveorder/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data['success']) {
                alert(data['message']);
                document.location = '/';
             } else{
                alert(data['message']);
            }
        }
    });
}

function showProducts(id){
    var objName = "#purchasesForOrderId_" + id;
    $(objName).toggleClass('hidden');
}