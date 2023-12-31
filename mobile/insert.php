<?php

include ('connection.php');
//include_once('Mail.php');

switch($_GET['action'])
{
	case 'RegisterMember':
		$firstname 	= $_GET['firstname'];
		$lastname	= $_GET['lastname'];
		$idktp		= $_GET['idktp'];
		$birthplace	= $_GET['birthplace'];
		$birthdate 	= $_GET['birthdate'];
		$phonenumb 	= $_GET['phonenumb'];
		$email 		= $_GET['email'];
		$address 	= $_GET['address'];
		$province 	= $_GET['province'];
		$zipcode 	= $_GET['zipcode'];
		$identifier	= $_GET['identifier'];
	
		$query = "insert into development.member_hsg(reqid, firstname, lastname, phonenumber, email,password, identifier, login, setpassword,
													    notif, idktp, birthplace, birthdate, address, province, zipcode, memberid, flag)
		
				  values (null, '".$firstname."', '".$lastname."', '".$phonenumb."', '".$email."', MD5(123456), '".$identifier."', 1, 0, 0, 
							    '".$idktp."', '".$birthplace."', '".$birthdate."', '".$address."', '".$province."', 
							    '".$zipcode."', '', 1)";
		
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
		echo $query;
	break;
	
	case 'RegisterMemberX':
        $firstname  = $_POST['firstname'];
        $lastname   = $_POST['lastname'];
        $idktp      = $_POST['idktp'];
        $birthplace = $_POST['birthplace'];
        $birthdate  = $_POST['birthdate'];
        $phonenumb  = $_POST['phonenumb'];
        $email      = $_POST['email'];
        $address    = $_POST['address'];
        $province   = $_POST['province'];
        $zipcode    = $_POST['zipcode'];
        $kelurahan  = $_POST['kelurahan'];
        $kecamatan  = $_POST['kecamatan'];

        $query = "INSERT INTO development.member_hsg(reqid, firstname, lastname, phonenumber, email, password, login, setpassword,
                                                    notif, idktp, birthplace, birthdate, address, province, zipcode, memberid, flag, kelurahan, kecamatan)
                  VALUES (null, '".$firstname."', '".$lastname."', '".$phonenumb."', '".$email."', MD5(123456),  1, 0, 0, 
                          '".$idktp."', '".$birthplace."', '".$birthdate."', '".$address."', '".$province."', 
                          '".$zipcode."', '', 1, '".$kelurahan."', '".$kecamatan."')";

        $result = $db->query($query);

        mysqli_close($db);
        echo json_encode($result);
		header('Location: ../login.php');
   		exit();
	break;
	
	case 'PoinTrans':
		$memberid = $_GET['memberid'];
		$poin = $_GET['poin'];
		$sku = $_GET['sku'];
		$user = $_GET['user'];
		
		$query = "insert into development.pointransaction (reqid, memberid, poinused, giftid, transdate, transtime)
					values (null, '".$memberid."', ".$poin.", '".$sku."', curDate(), curTime())";
					
		$update = "insert into point_member (kd_member, point, invoice, flag, exp, create_by, date_create, time_create, payment)
					values ('".$memberid."', ".$poin.", '".$sku."', 'use', curDate(), '".$user."', curDate(), curTime(), '901')";

		$sold = "update development.poin_item_gift set stock = stock - 1 where sku = '".$sku."'";

		$result = $db->query($query);
		$resupdate = $db->query($update);
		$ressold = $db->query($sold);
		
		mysqli_close($db);
		echo json_encode($result);
		
	break;
	
	case 'SendEmail':
		
		$email = $_GET['email'];

		$headers['From']    = 'admin@hsg.co.id';
		$headers['To']      = $email;
		$headers['Subject'] = 'Reset Password';

		$body = 'Test message';

		$smtpinfo["host"] = "smtp.server.com";
		$smtpinfo["port"] = "25";
		$smtpinfo["auth"] = true;
		$smtpinfo["username"] = "admin@hsg.co.id";
		$smtpinfo["password"] = "helihan77*";


		$mail_object =& Mail::factory("smtp", $smtpinfo); 

		$mail_object->send($email, $headers, $body);
	break;
	
	case 'ForgotPassword':
		$email = $_GET['email'];
		
		function getAcak(){
			$rand = rand(10000, 100);
			
			return $rand;
		}
		
		$kode = getAcak();
		
		$query = "insert into development.forgotpassword
				  select memberid, email, '".$kode."', 'Ready', now() 
					from development.member_hsg 
					where email = '".$email."'";

		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'Register':
		$promo = $_GET['promo'];
		$memberid = $_GET['memberid'];
		
		$query = "insert into htwarehouse.eventvapehan values ('".$promo."', '".$memberid."', now(), 1)";
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
}

?>