<?php

include ('connection.php');

switch($_GET['action'])
{
	case 'Login':
		$email 		= $_GET['email'];
		$password 	= $_GET['password'];
		$identifier = $_GET['identifier'];
		$flag		= $_GET['flag'];
	
		$query = "update member_hsg set identifier = '".$identifier."', login = ".$flag." 
					where email = '".$email."' and password = '".md5($password)."'";
					
		$queryB = "update hm_mobileapps.member_hsg set identifier = '".$identifier."', login = ".$flag." 
					where email = '".$email."' and password = '".md5($password)."'";			
		
		$result = $db->query($query);
		$resultB = $db->query($queryB);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	// case 'SetPassword':
	// 	$password = $_GET['password'];
	// 	$email = $_GET['email'];
	
	// 	$query = "update developer.member_hsg set password = md5('".$password."'), setpassword = 1 
	// 				where email = '".$email."'";
					
	// 	$queryB = "update developer.member_hsg set password = md5('".$password."'), setpassword = 1 
	// 				where email = '".$email."'";			
		
	// 	$result = $db->query($query);
	// 	$resultB = $db->query($queryB);
		
	// 	mysqli_close($db);
	// 	echo json_encode($result);
	// break;
	case 'SetPassword':
        $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        // Gunakan md5 jika Anda ingin tetap menggunakan md5
        $hashedPassword = md5($newPassword);

        // Perbarui kata sandi menggunakan prepared statement untuk menghindari SQL injection
        $query = "UPDATE member_hsg SET password = ?, setpassword = 1 WHERE email = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $hashedPassword, $email);
        $result = mysqli_stmt_execute($stmt);

        mysqli_close($db);

        echo json_encode(['success' => $result]);
        break;

	
	case 'EditProfile':
		$firstname 	 = $_GET['firstname'];
		$lastname 	 = $_GET['lastname'];
		$phonenumber = $_GET['phonenumber'];
		$email 		 = $_GET['email'];
		$birthdate	 = $_GET['birthdate'];
		$identifier  = $_GET['identifier'];
	
		$query = "update member_hsg set firstname = '".$firstname."', lastname = '".$lastname."', phonenumber = '".$phonenumber."', email = '".$email."', birthdate = '".$birthdate."'   
					where identifier = '".$identifier."'";
					
		$queryB = "update hm_mobileapps.member_hsg set firstname = '".$firstname."', lastname = '".$lastname."', phonenumber = '".$phonenumber."', email = '".$email."', birthdate = '".$birthdate."'   
					where identifier = '".$identifier."'";			
		
		$result = $db->query($query);
		$resultB = $db->query($queryB);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
		
	case 'Logout':
		$identifier = $_GET['identifier'];
	
		$query  = "update member_hsg set login = 0, identifier = '' where identifier = '".$identifier."'";
		$queryB = "update hm_mobileapps.member_hsg set login = 0, identifier = '' where identifier = '".$identifier."'";
		
		$result = $db->query($query);
		$resultB = $db->query($queryB);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'ResetPassword':
		$password = $_GET['password'];
		$email = $_GET['email'];
	
		$query = "update member_hsg set password = '".md5($password)."' where email = '".$email."'";
		$queryB = "update hm_mobileapps.member_hsg set password = '".md5($password)."' where email = '".$email."'";
		$queryC = "update hm_mobileapps.resetpassword set status = 1 where email = '".$email."'";
		
		$result = $db->query($query);
		$resultB = $db->query($queryB);
		$resultC = $db->query($queryC);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'cekNotif':
		$identifier = $_GET['identifier'];
		$notif = $_GET['notif'];
		
		$query = "update member_hsg set notif = ".$notif." where identifier = '".$identifier."'";
		$queryB = "update hm_mobileapps.member_hsg set notif = ".$notif." where identifier = '".$identifier."'";
		
		$result = $db->query($query);
		$resultB = $db->query($queryB);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'readNotif':
		$memberid = $_GET['memberid'];
		$promoid  = $_GET['promoid'];
		
		$query = "insert into member_hsg_notif (memberid, idpromo, flag) values ('".$memberid."', '".$promoid."', 1)";
		
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
		echo $query;
	break;
	
	case 'setImageProfile':
		$memberid = $_GET['memberid'];
		$image	  = $_GET['image'];
		
		$query = "update member_hsg_custom set image = '".$image."' where memberid = '".$memberid."'";
		
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	 
	case 'UploadImage':
		$memberid = $_GET['memberid'];
		$image	  = $_GET['image'];
		$kode	  = $_GET['kode'];
		$id		  = $_GET['id'];
		
		$query = "insert into hm_mobileapps.member_hsg_upload values ('".$memberid."', '".$kode."', '".$image."', now(), '".$id."', 0, 0, null)";
		
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'UpdateAlamat':
		$memberid = $_GET['memberid'];
		$kel	  = $_GET['kel'];
		$kec	  = $_GET['kec'];
		$prov	  = $_GET['prov'];
		$kdpos	  = $_GET['kdpos'];
		$almt	  = $_GET['almt'];
		
		$query = "update hm_mobileapps.member_hsg set kelurahan = '".$kel."', kecamatan = '".$kec."', province = '".$prov."', 
													  zipcode = '".$kdpos."', address = '".$almt."' 
				  where memberid = '".$memberid."'";
		
		$memberOld = "update member_personal set kelurahan = '".$kel."', kecamatan = '".$kec."', city = '".$prov."', 
													  post_code = '".$kdpos."', street = '".$almt."' 
						where no_member = '".$memberid."'";	
		
		$result = $db->query($query);
		$resultOld = $db->query($memberOld);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
	
	case 'RemoveAcc':
		$memberid = $_GET['memberid'];
		
		$query = "update hm_mobileapps.member_hsg  set login = 0, status = 0 where memberid = '".$memberid."'";
		
		$result = $db->query($query);
		
		mysqli_close($db);
		echo json_encode($result);
	break;
}
?>