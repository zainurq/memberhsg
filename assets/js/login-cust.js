/*
    custom by : haris
*/

function handleIt(){
    var _id         = document.getElementById("id").value;
    var _useremail  = document.getElementById("username").value;
    var _password   = document.getElementById("password").value;

    if(_useremail == '') {
        var myModal = new bootstrap.Modal(document.getElementById('userWarning'));
        myModal.show();
    }else if (_password == ''){
        var myModal = new bootstrap.Modal(document.getElementById('pswdWarning'));
        myModal.show();
    }else{
        $.ajax({
            url: 'assets/api/process.php?action=login', 
            type:'GET', // Atau 'POST' jika sesuai
            data: { 
                id: _id, 
                useremail: _useremail,
                password: _password,
            },
            success: function (response) {
                flag = response;
                if(flag === 'failed'){
                    var myModal = new bootstrap.Modal(document.getElementById('logindWarning'));
                    myModal.show();
                }else{
                    //$('#result').html(response);
                    window.location.href = "index.php";
                }
            },
            error: function () {
                alert('Gagal menjalankan PHP script.');
            }
        });
    }
}

$(document).ready(function () {
    $('#login-customer').click(function () {
        var _id         = document.getElementById("id").value;
        var _useremail  = document.getElementById("username").value;
        var _password   = document.getElementById("password").value;

        if(_useremail == '') {
            var myModal = new bootstrap.Modal(document.getElementById('userWarning'));
            myModal.show();
        }else if (_password == ''){
            var myModal = new bootstrap.Modal(document.getElementById('pswdWarning'));
            myModal.show();
        }else{
            $.ajax({
                url: 'assets/api/process.php?action=login', 
                type:'GET', // Atau 'POST' jika sesuai
                data: { 
                    id: _id, 
                    useremail: _useremail,
                    password: _password,
                },
                success: function (response) {
                    flag = response;
                    if(flag === 'failed'){
                        var myModal = new bootstrap.Modal(document.getElementById('logindWarning'));
                        myModal.show();
                    }else{
                        //$('#result').html(response);
                        window.location.href = "index.php";
                    }
                },
                error: function () {
                    alert('Gagal menjalankan PHP script.');
                }
            });
        }
    });

    $('#login-hadiah').click(function () {
        var _id         = document.getElementById("idnumber").value;
        var _linktype   = document.getElementById("linktype").value;
        var _useremail  = document.getElementById("username").value;
        var _password   = document.getElementById("password").value;

        if(_useremail == '') {
            var myModal = new bootstrap.Modal(document.getElementById('userWarning'));
            myModal.show();
        }else if (_password == ''){
            var myModal = new bootstrap.Modal(document.getElementById('pswdWarning'));
            myModal.show();
        }else{
            $.ajax({
                url: 'assets/api/process.php?action=loginhadiah', 
                type:'GET', // Atau 'POST' jika sesuai
                data: { 
                    id: _id, 
                    useremail: _useremail,
                    password: _password,
                },
                success: function (response) {
                    flag = response;
                    if(flag === 'failed'){
                        var myModal = new bootstrap.Modal(document.getElementById('logindWarning'));
                        myModal.show();
                    }else{
                        //$('#result').html(response);
                        window.location.href = "checkout.php?giftid="+_id+"&type="+_linktype;
                    }
                },
                error: function () {
                    alert('Gagal menjalankan PHP script.');
                }
            });
        }
    });

    $('#forgot-password').click(function () {
        var _old         = document.getElementById("oldpasswordInput").value;
        var _newpassword = document.getElementById("newpasswordInput").value;
        var _oldpassword = document.getElementById("confirmpasswordInput").value;

        if(_old == '') {
            var myModal = new bootstrap.Modal(document.getElementById('userWarning'));
            myModal.show();
        }else if (_newpassword == ''){
            var myModal = new bootstrap.Modal(document.getElementById('pswdWarning'));
            myModal.show();
        }else if (_oldpassword == ''){
            var myModal = new bootstrap.Modal(document.getElementById('pswdWarning'));
            myModal.show();
        }else{
            $.ajax({
                url: 'assets/api/process.php?action=login', 
                type:'GET', // Atau 'POST' jika sesuai
                data: { 
                    id: _id, 
                    useremail: _useremail,
                    password: _password,
                },
                success: function (response) {
                    flag = response;
                    if(flag === 'failed'){
                        var myModal = new bootstrap.Modal(document.getElementById('logindWarning'));
                        myModal.show();
                    }else{
                        window.location.href = "home.php";
                    }
                },
                error: function () {
                    alert('Gagal menjalankan PHP script.');
                }
            });
        }
    });

    $('#reload-peserta').click(function() {
        location.reload();
    });
});
