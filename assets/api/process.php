<?php
include '../../layouts/config.php';

// Initialize the session
switch($_GET['action'])
{
    case 'cek':
        for($i = 1; $i <= 100; $i++) {
            echo randomHuruf(3).randomAngka().'<br>';
        }
        
    break;

    case 'loginCustomer':
        $id       = $_GET['id'];
        $username = $_GET['username'];
        $password = $_GET['password'];

        $query = "select memberid from gift_member where email = '".$username."' and password = md5('".$password."') limit 1";

        $exec = mysqli_query($link, $query);

        if(mysqli_num_rows($exec) == 1){
            // Store data in session variables
            while($row = mysqli_fetch_array($exec)) {
                $_SESSION["loggedin"] = true;
                $_SESSION["memberid"] = $row['memberid'];
                $_SESSION["useremail"] = $username;
            }
        }else{
            header("location:../../login.php?id=".$id."&pesan=gagal")or die(mysql_error());
            // mysql_error();
        }
    break;

    case 'signup':
        $id = $_GET['id'];
        $useremail = $_POST['useremail'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "insert into gift_user (userid, useremail, phonenumber, password, registerdate) 
                  values (null, '".$useremail."', '".$username."', md5('".$password."'), curDate())";

        $hadiah = "insert into gift_hadiah values ('".$useremail."', '".$id."', now(), 'Pending', null)";          

        $exec = mysqli_query($link, $query);
        $execGift = mysqli_query($link, $hadiah);

        header("location:../../index.php");
    break;

    case 'login':
        $id = $_GET['id'];
        $useremail = $_GET['useremail'];
        $password = $_GET['password'];

        $query = "select userid, username from gift_user where useremail = '".$useremail."' and password = md5('".$password."')";

        $exec = mysqli_query($link, $query);
        
        if($exec){
            foreach($exec as $row){
                $custid = $row['userid'];
            }
            
            if(mysqli_num_rows($exec) == 1) {
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['useremail'] = $useremail;
                $_SESSION['custid'] = $custid;
                echo 'success';
            }else{
                echo 'failed';
            }
        }
    break;

    case 'loginhadiah':
        $id = $_GET['id'];
        $useremail = $_GET['useremail'];
        $password = $_GET['password'];

        $query = "select userid, username from gift_user where useremail = '".$useremail."' and password = md5('".$password."')";

        $cekType = "select type from gift_linkitem where linkid = '".$id."' limit 1";
        
        $hadiah = "insert into gift_hadiah values ('".$useremail."', '".$id."', now(), 'Pending', null)";

        $poin = "insert into gift_point
                    select (select userid from gift_user where useremail = '".$useremail."' limit 1), 
                    (select nominal from gift_itemmaster where sku = a.sku limit 1) as poin, linkid, 'get', '".$useremail."', curDate(), curTime(), null
                    from gift_linkitem a
                    where linkid = '".$id."'";     

        $updhadiah = "update gift_linkitem set status = 'Used' where linkid = '".$id."'";

        $exec = mysqli_query($link, $query);
        $extype = mysqli_query($link, $cekType);
        
        if($exec){
            if(mysqli_num_rows($exec) == 1) {
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['useremail'] = $useremail;

                //proses cek dapat hadiah or poin
                while($row = mysqli_fetch_array($extype)) {
                    if($row['type'] == 'Poin'){
                        $execGetPoin = mysqli_query($link, $poin);
                    }else{
                        $execgift = mysqli_query($link, $hadiah);
                    }
                }

                $execupd  = mysqli_query($link, $updhadiah);
                echo 'success';
            }else{
                echo 'failed';
            }
        }
    break;

    case 'resetPassword':
        $email = $_POST['email'];
        $oldpasswordInput = $_POST['oldpasswordInput'];
        $newpasswordInput = $_POST['newpasswordInput'];
        $confirmpasswordInput = $_POST['confirmpasswordInput'];

        $cek = "select useremail from gift_user where useremail = '".$email."' and password = md5('".$oldpasswordInput."') limit 1";

        $execCek = mysqli_query($link, $cek);
        
        if($execCek){
            if(mysqli_num_rows($execCek) == 1) {
                $query = "update gift_user set password = md5('".$confirmpasswordInput."') where useremail = '".$email."'";
                $exec = mysqli_query($link, $query);

                header("location:../../ij-profile-settings.php?reset=success");
            }else{
                echo $cek;
                header("location:../../ij-profile-settings.php?reset=failed");
            }
        }
    break;

    case 'addtocart':
        $sku = $_GET['sku'];
        $poin = $_GET['poin'];
        $custid = $_GET['custid'];

        $query = "insert into gift_orderdtl values ('', '".$sku."', 1, ".$poin.", '".$custid."', now(), null)";
        
        $exec = mysqli_query($link, $query);
    break;

    case 'deleteItem':
        $custid = $_GET['custid'];
        $sku = $_GET['sku'];

        $query = "delete from gift_orderdtl where custid = '".$custid."' and orderid = '' and sku = '".$sku."'";

        $exec = mysqli_query($link, $query);
    break;

    case 'cancelCheckout':
        $custid = $_GET['custid'];

        $query = "delete from gift_orderdtl where custid = ".$custid." and orderid = ''";

        $exec = mysqli_query($link, $query);
    break;

    case 'updateUser':
        $firstname      = $_POST['firstname'];
        $lastname       = $_POST['lastname'];
        $phonenumber    = $_POST['phonenumber'];
        $username       = $_POST['username'];
        $comboCity      = $_POST['comboCity'];
        $comboDistrict  = $_POST['comboDistrict'];
        $subdistrict    = $_POST['subdistrict'];
        $zipcode        = $_POST['zipcode'];
        $address        = $_POST['address'];
        $email          = $_POST['email'];


        $query = "update gift_user set firstname = '".$firstname."', lastname = '".$lastname."', username = '".$username."', phonenumber = '".$phonenumber."', 
                                       city = '".$comboCity."', kelurahan = '".$comboDistrict."', kecamatan = '".$subdistrict."', zip = '".$zipcode."', address = '".$address."' 
                    where useremail = '".$email."'";

        $exec = mysqli_query($link, $query);     

        header("location:../../ij-profile-settings.php?cek=success");

    break;

    case 'checkout':
        $giftid = $_GET['giftid'];
        $fname  = $_GET['firstname'];
        $lname  = $_GET['lastname'];
        $phone  = $_GET['phonenumber'];
        $uname  = $_GET['username'];
        $city   = $_GET['comboCity'];
        $kec    = $_GET['comboDistrict'];
        $kel    = $_GET['subdistrict'];
        $kdpos  = $_GET['zipcode'];
        $alamat = $_GET['address'];
        $email  = $_GET['email'];

        $query = "update gift_user set firstname = '".$fname."', lastname = '".$lname."', username = '".$uname."', phonenumber = '".$phone."', 
                                       city = '".$city."', kelurahan = '".$kec."', kecamatan = '".$kel."', zip = '".$kdpos."', address = '".$alamat."' 
                    where useremail = '".$email."'";
        
        $cek = "update gift_hadiah set status = 'CheckOut' where giftid = '".$giftid."'";                    
     
        $exec = mysqli_query($link, $query);
        $execCek = mysqli_query($link, $cek);
    break;

    case 'checkout_hadiah':
        $giftid = $_POST['giftid'];
        $fname  = $_POST['firstname'];
        $lname  = $_POST['lastname'];
        $phone  = $_POST['phonenumber'];
        $uname  = $_POST['username'];
        $city   = $_POST['comboCity'];
        $kec    = $_POST['comboDistrict'];
        $kel    = $_POST['subdistrict'];
        $kdpos  = $_POST['zipcode'];
        $alamat = $_POST['address'];
        $email  = $_POST['email'];

        $query = "update gift_user set firstname = '".$fname."', lastname = '".$lname."', username = '".$uname."', phonenumber = '".$phone."', 
                                       city = '".$city."', kelurahan = '".$kec."', kecamatan = '".$kel."', zip = '".$kdpos."', address = '".$alamat."' 
                    where useremail = '".$email."'";
        
        $cek = "update gift_hadiah set status = 'CheckOut' where giftid = '".$giftid."'";                    
     
        $exec = mysqli_query($link, $query);
        $execCek = mysqli_query($link, $cek);
    break;

    case 'checkoutcart':
        $custid = $_GET['custid'];

        $fname  = $_GET['firstname'];
        $lname  = $_GET['lastname'];
        $phone  = $_GET['phonenumber'];
        $uname  = $_GET['username'];
        $city   = $_GET['comboCity'];
        $kec    = $_GET['comboDistrict'];
        $kel    = $_GET['subdistrict'];
        $kdpos  = $_GET['zipcode'];
        $alamat = $_GET['address'];
        $email  = $_GET['email'];

        $query = "update gift_user set firstname = '".$fname."', lastname = '".$lname."', username = '".$uname."', phonenumber = '".$phone."', 
                                       city = '".$city."', kelurahan = '".$kec."', kecamatan = '".$kel."', zip = '".$kdpos."', address = '".$alamat."' 
                    where userid = '".$custid."'";
        

        //Generate id order
        $numb = mysqli_query($link, "select nomor from numbersequence where code = 'gif' limit 1");
        while($b=mysqli_fetch_array($numb)){
            $orderid = "ORD".sprintf("%'.06d", $b['nomor']);
        }

        mysqli_query($link, "update numbersequence set nomor = nomor + 1 where code = 'gif'");

        $queryhdr = "insert into gift_orderhdr values ('".$orderid."', '".$custid."', 'Pending', curDate(), curTime(), now(), now())";
        $querydtl = "update gift_orderdtl set orderid = '".$orderid."' where custid = '".$custid."' and orderid = ''";
        $queryhist1 = "insert into gift_orderhist values ('".$orderid."', 1, '', now())";
        $queryhist2 = "insert into gift_orderhist values ('".$orderid."', 2, '', now())";

        $exec = mysqli_query($link, $query);
        
        $exechdr = mysqli_query($link, $queryhdr);
        $execdtl = mysqli_query($link, $querydtl);
        
        $exechist1 = mysqli_query($link, $queryhist1);
        $exechist2 = mysqli_query($link, $queryhist2);
        
        echo 'success';
    break;

    case 'uploadImage':
        $id = $_GET['id'];
        $fileImg = str_replace(".", "", $id);

        $uploadDir =  $_SERVER['DOCUMENT_ROOT'] . "/gift-ij/assets/images/users/"; // Direktori tempat gambar akan disimpan
        $query = "update gift_user set profile_image = '".$fileImg."' where useremail = '".$id."'";

        if ($_FILES["profile-img-file-input"]["error"] == UPLOAD_ERR_OK) {
            $tempName = $_FILES["profile-img-file-input"]["tmp_name"];
            $fileName = $_FILES["profile-img-file-input"]["name"];

            $newFileName = $fileImg.'.jpg';

            // Pindahkan gambar dari direktori sementara ke direktori tujuan
            if (move_uploaded_file($tempName, $uploadDir . $newFileName)) {
                $exec = mysqli_query($link, $query);
                echo $query;
                echo "Gambar berhasil diunggah dan disimpan.";
            } else {
                echo "Gagal menyimpan gambar.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    break;    
}
?>