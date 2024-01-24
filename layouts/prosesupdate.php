<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $province = $_POST['province'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];

    $updateQuery = "UPDATE member_hsg 
                    SET firstname=?, lastname=?, phonenumber=?, province=?, kecamatan=?, kelurahan=?, zipcode=?, address=?
                    WHERE memberid=?";
    
    $updateStmt = mysqli_prepare($link, $updateQuery);
    
    mysqli_stmt_bind_param($updateStmt, 'sssssssss', $firstname, $lastname, $phonenumber, $province, $kecamatan, $kelurahan, $zipcode, $address, $_SESSION['kd_member']);

    if (mysqli_stmt_execute($updateStmt)) {
        header('Location: ../profile.php');
        exit();
    } else {
        echo "Gagal melakukan pembaruan: " . mysqli_error($link);
        exit();
    }
} else {
    header('Location: profile.php');
    exit();
}
?>
