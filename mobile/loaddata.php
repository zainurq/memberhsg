<?php
	use PHPMailer\PHPMailer\PHPMailer;
	
    include ("connection.php");
	
	switch($_GET['action'])
    {
		
		case 'CekLogin':
			$email = $_GET['email'];
			$password = $_GET['password'];
			
			$query = "select memberid, firstname, phonenumber, login, setpassword, email, password, `status`
						from development.member_hsg
						where email = '".$email."' and password = '".md5($password)."'";
			            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
		break;
		
		case 'CekRda':
			$snrda	  = $_GET['snrda'];
			
			$query = "select valupload from development.member_hsg_upload where valupload = '".$snrda."' and kode = 'id' and verified = 1 limit 1";
			            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
		break;
		
		case 'CekRegister':
			$email 			= $_GET['email'];
			$phonenumber	= $_GET['phonenumber'];
			$identifier 	= $_GET['identifier'];
			
			$query = "select memberid from
					  (
						select memberid, email, phonenumber, identifier from member_hsg 
							union all 
						 select memberid, email, phonenumber, identifier from development.member_hsg
					  )x
					  where email = '".$email."' or phonenumber = '".$phonenumber."' or identifier = '".$identifier."' limit 1";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
		break;
		
		case 'getMember':
			$identifier = $_GET['identifier'];
			
			$query = "select *, (year(curDate()) - year(birthdate)) as umur from
						(select * from member_hsg
						union all
						select memberid, firstname, lastname, phonenumber, email, `password`, identifier, login, setpassword, 
							notif, birthdate, status
						from development.member_hsg)x 
						where identifier = '".$identifier."' limit 1";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);
			} else {
				echo 'null';
			}
		break;
		
		case 'getMemberx':
			$id = $_GET['id'];
			
			$query = "select *, (year(curDate()) - year(birthdate)) as umur from
						(select * from member_hsg
						union all
						select memberid, firstname, lastname, phonenumber, email, `password`, identifier, login, setpassword, notif, birthdate
						from development.member_hsg)x 
						where memberid = '".$id."' limit 1";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);
			} else {
				echo 'null';
			}
		break;
		
		case 'getDivisi':        
			
            $query = "select * from divisi where status = 1 and nomer not in (0) order by nomer asc";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getDivisiDev':        
			
            $query = "select *, case when validuntil <= curDate() then '1' else '0' end as cekvalid 
						from divisi where publish = 1 order by nomer asc";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getCurPassword':        
			$email = $_GET['email'];
			$password = $_GET['password'];
			
            $query = "select memberid from
						(select memberid, email, password from member_hsg union all select memberid, email, password from development.member_hsg )x 
						where email = '".$email."' and password = '".md5($password)."' limit 1";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getPromoDetail':        
			$divisi = $_GET['divisi'];
			
            $query = "select *, (select count(promoid) as total from htwarehouse.eventvapehan where promoid = x.idpromo) as total
					  from member_hsg_promo x
						where divisi = ".$divisi." and status = 1 and type = 'Member'";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getPromoDetailA':        
			$divisi = $_GET['divisi'];
			
            $query = "select *, (select count(promoid) as total from htwarehouse.eventvapehan where promoid = x.idpromo) as total
					  from member_hsg_promo x
						where divisi = ".$divisi." and status = 0 and type = 'Member'";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getPromoDetailx':        
			$id = $_GET['id'];
			
            $query = "select * from member_hsg_promo where idpromo = '".$id."'";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'getNotif':        
			$member = $_GET['member'];
			
			$query = "select * from
					 (select idpromo, titlepromo, subtitlepromo, image,
						(select memberid from member_hsg_notif where memberid = '".$member."' and idpromo = x.idpromo limit 1) as memberid,
							x.deksripsi, x.link, x.todate
								from member_hsg_promo x where `status` = 1)z 
					  where memberid is null";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'LoadImageProfile':        
			$member = $_GET['member'];
			
			$query = "select *, concat('http://103.106.79.238:81/hsgmember/profile/', image) as img 
						from member_hsg_custom where memberid = '".$member."'";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'ViewPoin':        
			$member = $_GET['member'];
			
			$query = "select ifnull(sum(point), 0) as poin from point_member 
						where kd_member = '".$member."'";
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)){
				echo json_encode($res);
			} else {
				echo 'null';
			}
        break;
		
		case 'HistoryTrans':        
			$member = $_GET['member'];
			$type = $_GET['type'];
			$fdate = $_GET['fdate'];
			$tdate = $_GET['tdate'];
			$flag = $_GET['flag'];
			
			if($type == 'use')
			{
				if($flag == 'cari')
				{
					$query = "select kd_member, invoice as no_invoice,
								ifnull((select itemname from development.poin_item_gift where sku = x.invoice limit 1), '') as itemgift, ifnull(point, 0) as point,
								date_create, time_create, flag, ifnull(noresi, '') as noresi, 
								ifnull((select courierid from indoongkir.courier where devid = x.delivery limit 1), '') as courierid,
								concat('http://103.106.79.238:81/hsgmember/images/giftpoin/', invoice, '.jpg') as urlimage
								from point_member x
								where kd_member = '".$member."' and flag = 'use' and date_create between '".$fdate."' and '".$tdate."'";
				}
				else
				{
					$query = "select kd_member, invoice as no_invoice, 
								ifnull((select itemname from development.poin_item_gift where sku = x.invoice limit 1), '') as itemgift, ifnull(point, 0) as point,
								date_create, time_create, flag, ifnull(noresi, '') as noresi, 
								ifnull((select courierid from indoongkir.courier where devid = x.delivery limit 1), '') as courierid,
								concat('http://103.106.79.238:81/hsgmember/images/giftpoin/', invoice, '.jpg') as urlimage
								from point_member x
								where kd_member = '".$member."' and flag = 'used' and point not in (0)
								order by concat(date_create, time_create) desc
								limit 15";
				}
			}
			else
			{
				if($flag == 'cari')
				{
					$query = "select * from
								(select a.no_invoice, a.invoice_date, a.time_transaction, 
								format((select sub_amount from invoice_payment where no_invoice = a.no_invoice limit 1), 0) as amt, ifnull(b.point, 0) as point
								from invoice_header a left join (select kd_member, invoice, point from point_member where flag = 'get') b
								on a.kd_member = b.kd_member and a.no_invoice = b.invoice
								where a.kd_member = '".$member."')x
								where point is not null and invoice_date between '".$fdate."' and '".$tdate."'
								order by invoice_date, time_transaction desc";
				}
				else
				{
					$query = "select * from
								(select a.no_invoice, a.invoice_date, a.time_transaction, 
								format((select sub_amount from invoice_payment where no_invoice = a.no_invoice limit 1), 0) as amt, ifnull(b.point, 0) as point
								from invoice_header a left join (select kd_member, invoice, point from point_member where flag = 'get') b
								on a.kd_member = b.kd_member and a.no_invoice = b.invoice
								where a.kd_member = '".$member."')x
								where point is not null
								order by concat(invoice_date, ' ', time_transaction) desc 
								limit 15";

				}
			}
            
            $result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)){
				echo json_encode($res);
			}else{
				echo 'null';
			}
        break;
		
		case 'InvoiceDetail':
			$invoice = $_GET['invoice'];
			
			$query = "select a.no_invoice, a.sku_product as SKU, b.barcode, b.productname, 
						case when b.color = '' and b.nic = '' then ''
								 when b.color = '' then concat('Nic : ', b.nic)
								 when b.nic   = '' then concat('Color : ', b.color)
						end as flag, 
						a.quantity as qty, format(a.price, 0) as harga, 
						case when a.flag_disc = 'Percent' then concat(a.discount, '%')
							 when a.flag_disc = 'Amount' then format(a.discount, 0)
							 else ''
						end as disc, 
						case when flag_disc = 'Percent' then format((ifnull(a.price, 0) - ((ifnull(a.price, 0) * a.discount) / 100)) * a.quantity, 0)
							 when flag_disc = 'Amount'  then format((ifnull(a.price, 0) - a.discount) * a.quantity, 0)
						else format(ifnull(a.price, 0), 0) * a.quantity end as net 
						from invoice_detail a left join htwarehouse.masterproduct b 
						on a.sku_product = b.sku
						where a.no_invoice = '".$invoice."'";
						
			$result = $db->query($query);

            while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            echo json_encode($res);			
		break;
		
		case 'getProvince':
			$query = "select distinct province from city order by province asc";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            echo json_encode($res);	
		break;
		
		case 'getCity':
			$query = "select city_name from indoongkir.city";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
            echo json_encode($res);	
		break;
		
		case 'getRegisterRDA':
			$memberid = $_GET['memberid'];
			
			$query = "select * from development.member_hsg_upload where memberid = '".$memberid."' and kode = 'id' and valupload not in ('')";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		case 'getWarningInfo':
			$query = "APAKAH ANDA BERUSIA 18 TAHUN KEATAS?\nPRODUK DI APLIKASI INI HANYA UNTUK ORANG DEWASA.\nDENGAN MEMASUKI APLIKASI INI, ANDA MENYATAKAN BAHWA ANDA SUDAH CUKUP UMUR UNTUK HUKUM MEROKOK DI NEGARA TEMPAT ANDA TINGGAL.\n\nARE YOU 18 YEARS OF AGE OR OLDER?\nTHE PRODUCTS ON THIS APP ARE INTENDED FOR ADULTS ONLY.\nBY ENTERING THIS APP, YOU CERTIFY THAT YOU ARE OF LEGAL SMOKING AGE IN THE STATE IN WHICH YOU RESIDE.";
						
			$res[]['message'] = $query;
        
			echo json_encode($res);	
		break;
		
		case 'getLoadGift':
		
			$query = "select idcategori, sku, itemname, poin, `status`, 
							concat('http://103.106.79.238:81/hsgmember/images/giftpoin/', sku, '.jpg') as urlimage
						from development.poin_item_gift 
					  where stock > 0 ";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		case 'getAlamat':
			$identifier = $_GET['identifier'];
		
			$query = "select * from
						(select kelurahan, kecamatan, province, zipcode, address 
						from development.member_hsg
						where identifier = '".$identifier."'
						union all
						select kelurahan, kecamatan, city, post_code, street  from member_personal
						where no_member in (select memberid from member_hsg where identifier = '".$identifier."'))x";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		// product 
		case 'getListNew':
			$flag = $_GET['flag'];
			$param = $_GET['param'];
			
			if($flag == 'vp') {
				$query = "select sku, productname, nic, color, if(nic = '', color, nic) as flag,
							TIMESTAMPDIFF(DAY,date_create,curDate()) as cek, 
							concat('http://103.106.79.238:81/hsgmoto/images/vapehan/', sku, '.jpg') as urlimage
							from htwarehouse.masterproduct
							where TIMESTAMPDIFF(DAY,date_create,curDate()) between 1 and 7
							limit ".$param;
			}
			else if($flag == 'moto') {
				$query = "select sku, productname, nic as size, 
							TIMESTAMPDIFF(DAY,date_create,curDate()) as cek, 
							if(urlimage is null, urlimage, concat('http://103.106.79.238:81/hsgmoto/images/moto/', sku, '.jpg')) as urlimage
							from hmwarehouse.masterproduct
							where TIMESTAMPDIFF(DAY,date_create,curDate()) between 1 and 20
							limit ".$param;
			}else if($flag == 'hp') {
				$query = "select *, TIMESTAMPDIFF(DAY, dateupload, curDate()) as cek
							from vp_pos.itemhanprint a
							where TIMESTAMPDIFF(DAY, dateupload, curDate()) <= 30";
				
			}else if($flag == 'ht') {
				$query = "select *, TIMESTAMPDIFF(DAY, dateupload, curDate()) as cek,
							(select nama_product from ht_pos.master_product_new where sku_product = a.sku limit 1) as productname
							from ht_pos.listitempromo a
							where flag = 1 and TIMESTAMPDIFF(DAY, dateupload, curDate()) <= 30";
			}
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		/*case 'SendEmail':
		
			$to = $_GET['to'];
			$subject = "Reset Password";
			$txt = "Hello world!";
			$headers = "From: it@hsg.co.id";

			mail($to,$subject,$txt,$headers);
		break;*/
		
		case 'CekEmail':
			$email = $_GET['email'];
			
			$query = "select * from
						(
							select memberid, firstname, phonenumber, login, setpassword, email, password 
							from member_hsg 
							union all
							select memberid, firstname, phonenumber, login, setpassword, email, password
							from development.member_hsg
						)x
						where email = '".$email."' limit 1";
						
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		case 'getForgotKey':
			$email = $_GET['email'];
			
			$query = "select * from development.forgotpassword 
						where email = '".$email."' and status = 'Ready' limit 1";
			
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		case 'CekResetPassword':
			$email = $_GET['email'];
			$kode = $_GET['kode'];
			
			$query = "select * from development.resetpassword where email = '".$email."' and kode = '".$kode."' and status = 0 limit 1";
			
			$result = $db->query($query);
			
			while($product = $result->fetch_assoc()){
                $res[] = $product;
            }
        
			mysqli_close($db);
			if(isset($res)) {
				echo json_encode($res);	
			} else {
				echo 'null';
			}
		break;
		
		case 'decrypt':
			$md5 = $_GET['md5'];
			$qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $md5 ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $md5 ) ) ), "\0");
			echo $qDecoded;
		break;
		
		case 'SendEmail':
			require_once "PHPMailer/PHPMailer.php";
			require_once "PHPMailer/SMTP.php";
			require_once "PHPMailer/Exception.php";

			$mail = new PHPMailer();
			
			$email = $_GET['email'];
			
			function getAcak(){
				$rand = rand(10000, 100);
				
				return $rand;
			}
			
			$nomor = getAcak();
			
			
			$query = "Call ResetPassword('".$email."', '".$nomor."')";
			$result = $db->query($query);
		
			mysqli_close($db);
			
			//SMTP Setting
			$mail->isSMTP();
			$mail->Host = "mail.vapehan.com";
			$mail->SMTPAuth = true;
			$mail->Username = "sales@vapehan.com";
			$mail->Password = "HSGHelihan77";
			$mail->Port = 587;
			$mail->SMTPSecure = "SSL";
			
			//Email Setting
			$mail->isHTML(true);
			$mail->setFrom("sales@vapehan.com", "no-reply");
			$mail->addAddress($email);
			$mail->Subject = "Reset Password";
			$mail->Body = "This is an automatically generated code from admin, key: ".$nomor;
			
			if($mail->send())
			{
				$res[]["reset"] = "A";
			}
			else
			{
				$res[]["reset"] = "B";
			}
			
			//echo json_encode($res);
			echo $mail->ErrorInfo;
		break;
	}
?>