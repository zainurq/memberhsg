/*
    custom by : haris
*/

var buttons = document.querySelectorAll(".button-delete");

// Menambahkan event listener ke setiap tombol
buttons.forEach(function(button) {
    button.addEventListener("click", function() {
        var _custid = document.getElementById("custid").value;

        // Mendapatkan atribut data "data-rowid" dari baris yang sesuai dengan tombol yang diklik
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
    $('#delete-item').click(function () {
        var _custid = document.getElementById("custid").value;
        
        // Mendapatkan atribut data "data-rowid" dari baris yang sesuai dengan tombol yang diklik
        var rowId = button.parentElement.parentElement.getAttribute("data-rowid");

        // Menggunakan "rowId" untuk mengidentifikasi baris yang sesuai
        var selectedRow = document.querySelector('tr[data-rowid="' + rowId + '"]');

        // Mengambil data dari sel-sel dalam baris
        var data1 = selectedRow.cells[0].textContent; // Data dari sel pertama
        var data2 = selectedRow.cells[1].textContent; // Data dari sel kedua
        
        // Melakukan sesuatu dengan data yang diperoleh
        console.log("Data 1: " + data1);
        console.log("Data 2: " + data2);

        /*$.ajax({
            url: 'assets/api/process.php?action=deleteItem', 
            type:'GET', // Atau 'POST' jika sesuai
            data: { 
                custid: _custid, 
                sku: _sku,
            },
            success: function (response) {
                window.location.href = "cart.php?custid="+_custid;
            },
            error: function () {
                alert('Gagal menjalankan PHP script.');
            }
        });*/
    });
    
    $('#reload-peserta').click(function() {
        location.reload();
    });
});