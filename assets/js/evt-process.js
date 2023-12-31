/*
    custom by : haris
*/

function checkOutIt(){
    var _giftid = document.getElementById("giftid").value;
    var _fname  = document.getElementById("firstname").value;
    var _lname  = document.getElementById("lastname").value;
    var _phone  = document.getElementById("phonenumber").value;
    var _uname  = document.getElementById("username").value;
    var _city   = document.getElementById("comboCity").value;
    var _kec    = document.getElementById("subdistrict").value;
    var _kel    = document.getElementById("comboDistrict").value;
    var _kdpos  = document.getElementById("zipcode").value;
    var _alamat = document.getElementById("address").value;
    var _email  = document.getElementById("email").value;

    $.ajax({
        url: 'assets/api/process.php?action=checkout', 
        type:'GET', // Atau 'POST' jika sesuai
        data: { 
            giftid: _giftid,
            firstname: _fname,
            lastname: _lname,
            phonenumber: _phone,
            username: _uname,
            comboCity: _city,
            subdistrict: _kec,
            comboDistrict: _kel,
            zipcode: _kdpos,
            address: _alamat,
            email: _email,
        },
        success: function (response) {
            flag = response;
            if(flag === 'failed'){
                var myModal= new bootstrap.Modal(document.getElementById('warningModal'));
                myModal.show();
            }else{
                var myModal= new bootstrap.Modal(document.getElementById('suksesModal'));
                myModal.show();
            }
        },
        error: function () {
            alert('Gagal menjalankan PHP script.');
        }
    });

    $('#reload-page').click(function() {
        location.reload();
    });
}

function checkOutCart(){
    var _id     = document.getElementById("custid").value;
    var _fname  = document.getElementById("firstname").value;
    var _lname  = document.getElementById("lastname").value;
    var _phone  = document.getElementById("phonenumber").value;
    var _uname  = document.getElementById("username").value;
    var _city   = document.getElementById("comboCity").value;
    var _kec    = document.getElementById("subdistrict").value;
    var _kel    = document.getElementById("comboDistrict").value;
    var _kdpos  = document.getElementById("zipcode").value;
    var _alamat = document.getElementById("address").value;
    var _email  = document.getElementById("email").value;

    $.ajax({
        url: 'assets/api/process.php?action=checkoutcart', 
        type:'GET', // Atau 'POST' jika sesuai
        data: { 
            custid: _id,
            firstname: _fname,
            lastname: _lname,
            phonenumber: _phone,
            username: _uname,
            comboCity: _city,
            subdistrict: _kec,
            comboDistrict: _kel,
            zipcode: _kdpos,
            address: _alamat,
            email: _email,
        },
        success: function (response) {
            flag = response;
            if(flag === 'failed'){
                var myModal= new bootstrap.Modal(document.getElementById('warningModal'));
                myModal.show();
            }else{
                var myModal= new bootstrap.Modal(document.getElementById('suksesModal'));
                myModal.show();
            }
        },
        error: function () {
            alert('Gagal menjalankan PHP script.');
        }
    });

    $('#reload-page').click(function() {
        location.reload();
    });
}

function checkOutHadiah(){
    var _id     = document.getElementById("giftid").value;
    var _fname  = document.getElementById("firstname").value;
    var _lname  = document.getElementById("lastname").value;
    var _phone  = document.getElementById("phonenumber").value;
    var _uname  = document.getElementById("username").value;
    var _city   = document.getElementById("comboCity").value;
    var _kec    = document.getElementById("subdistrict").value;
    var _kel    = document.getElementById("comboDistrict").value;
    var _kdpos  = document.getElementById("zipcode").value;
    var _alamat = document.getElementById("address").value;
    var _email  = document.getElementById("email").value;

    $.ajax({
        url: 'assets/api/process.php?action=checkout_hadiah', 
        type:'POST', // Atau 'POST' jika sesuai
        data: { 
            giftid: _id,
            firstname: _fname,
            lastname: _lname,
            phonenumber: _phone,
            username: _uname,
            comboCity: _city,
            subdistrict: _kec,
            comboDistrict: _kel,
            zipcode: _kdpos,
            address: _alamat,
            email: _email,
        },
        success: function (response) {
            flag = response;
            if(flag === 'failed'){
                var myModal= new bootstrap.Modal(document.getElementById('warningModal'));
                myModal.show();
            }else{
                window.location.href = "checkout.php?giftid="+_id+"&type=Hadiah";
            }
        },
        error: function () {
            alert('Gagal menjalankan PHP script.');
        }
    });

    $('#reload-page').click(function() {
        location.reload();
    });
}

var buttons = document.querySelectorAll(".button-delete");

// Menambahkan event listener ke setiap tombol
buttons.forEach(function(button) {
    button.addEventListener("click", function() {
        var _custid = document.getElementById("custid").value;
        var _sku = button.parentElement.parentElement.getAttribute("data-rowid");

        $.ajax({
            url: 'assets/api/process.php?action=deleteItem', 
            type:'GET', // Atau 'POST' jika sesuai
            data: { 
                custid: _custid, 
                sku: _sku,
            },
            success: function () {
                window.location.href = "cart.php?custid="+_custid;
            },
            error: function () {
                alert('Gagal menjalankan PHP script.');
            }
        });
    });
});

$(document).ready(function () {
    $('#cancel-checkout').click(function () {
        var _custid = document.getElementById("custid").value;
        $.ajax({
            url: 'assets/api/process.php?action=cancelCheckout', 
            type:'GET', // Atau 'POST' jika sesuai
            data: { 
                custid: _custid, 
            },
            success: function (response) {
                window.location.href = "cart.php?custid="+_custid;
            },
            error: function () {
                alert('Gagal menjalankan PHP script.');
            }
        });
    });
    
    $('#reload-peserta').click(function() {
        location.reload();
    });
});