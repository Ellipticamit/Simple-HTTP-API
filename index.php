<?php 
    require_once("apifunction.php");
    date_default_timezone_set("Asia/Kolkata");
 
if(isset($_GET['action'])) { $action = strtolower(mysql_real_escape_string($_GET['action'])); } 
else { $action= ''; }
$img_file = 'logo.jpg';
$imgData = base64_encode(file_get_contents($img_file));

	if ($action == "register")
		{
			$name = $_REQUEST['name'];
			$email = $_REQUEST['email'];
			$contact = $_REQUEST['contact'];
			$emergencycontact = $_REQUEST['emergencycontact'];
			$password = $_REQUEST['password'];
			$type= $_REQUEST['type'];
	
			$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$length = 5;
			$fileName = '';
				for($i = 0; $i < $length; $i++) {
				   $fileName .= $chars[mt_rand(0, 34)];
				}
			$profileUrl = "uploads/$fileName.jpg";
			
			$encoded_photo = $_REQUEST['userprofile'];
			$photo = base64_decode($encoded_photo);
			$file = fopen($profileUrl , 'wb');
			fwrite($file, $photo);
			fclose($file); 
			
			$register = register($name, $email, $profileUrl, $contact, $emergencycontact, $password, $type);
			echo $register;
		}
	elseif ($action == 'login')
		{
			$email = mysql_real_escape_string($_REQUEST['email']);
			$password = mysql_real_escape_string($_REQUEST['password']);
			$login = login($email,$password);
			echo $login;
		}
	elseif ($action == 'drivingtips')
		{  
			$tipdetail = mysql_real_escape_string($_REQUEST['tipdetail']);
			$tipcategory = mysql_real_escape_string($_REQUEST['tipcategory']);
			$tipuploadtime = date('m/d/Y h:i a', time());
			
			$drivingtips = drivingtips($tipdetail, $tipcategory, $tipuploadtime);
			echo $drivingtips;	
		}
	elseif ($action == 'state')
		{  
			$state = state();
			echo $state;	
		}
	elseif ($action == 'getstate')
		{  
			$stateId = mysql_real_escape_string($_REQUEST['stateId']);
			$getstate = getstate($stateId);
			echo $getstate;		
		}
	elseif ($action == 'city')
		{  
			$city = city();
			echo $city;	
		}
	elseif ($action == 'getcity')
		{  
			$cityId = mysql_real_escape_string($_REQUEST['cityId']);
			$getcity = getcity($cityId);
			echo $getcity;		
		}
	elseif ($action == 'getlocality')
		{  
			$localityId = mysql_real_escape_string($_REQUEST['localityId']);
			$getlocality = getlocality($localityId);
			echo $getlocality;	
		}
	elseif ($action == 'locality')
		{  
			$locality = locality();
			echo $locality;	
		}
	elseif ($action == 'gallery')
		{  
			$photoCaption = mysql_real_escape_string($_REQUEST['photoCaption']);
			$uploadedBy = mysql_real_escape_string($_REQUEST['uploadedBy']);
			
			$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$length = 5;
			$fileName = '';
				for($i = 0; $i < $length; $i++) {
				   $fileName .= $chars[mt_rand(0, 34)];
				}
			$photoUrl = "uploads/$fileName.jpg";
			
			$encoded_photo = $_POST['photoUrl'];
			$photo = base64_decode($encoded_photo);
			$file = fopen($photoUrl , 'wb');
			fwrite($file, $photo);
			fclose($file); 
			
			$uploadedtime = date('m/d/Y h:i a', time());
			$gallery = gallery($photoUrl,$photoCaption,$uploadedBy,$uploadedtime);
			echo $gallery;	
		}
	elseif ($action == 'gallerycomments')
		{  
			$photoId = mysql_real_escape_string($_REQUEST['photoId']);
			$userId = mysql_real_escape_string($_REQUEST['userId']);
			$commentDetail = mysql_real_escape_string($_REQUEST['commentDetail']);
			$commentTime = date('m/d/Y h:i a', time());
			
			$gallerycomments = gallerycomments($photoId,$userId,$commentDetail,$commentTime);
			echo $gallerycomments;	
		}
	elseif ($action == 'trafficstatus')
		{  
			$alternateroute = '';
			$stateId = mysql_real_escape_string($_REQUEST['stateId']);
			$cityId = mysql_real_escape_string($_REQUEST['cityId']);
			$localityId = mysql_real_escape_string($_REQUEST['localityId']);
			$traffic = mysql_real_escape_string($_REQUEST['traffic']);
			$userId = mysql_real_escape_string($_REQUEST['userId']);
			
			if(isset($_REQUEST['alternateroute'])) { $alternateroute = mysql_real_escape_string($_REQUEST['alternateroute']); }
			
			$trafficstatus = trafficstatus($stateId,$cityId,$localityId,$traffic,$userId,$alternateroute);
			echo $trafficstatus;	
		}
	elseif ($action == 'gettrafficstatus')
		{  
			$gettrafficstatus = gettrafficstatus();
			echo $gettrafficstatus;	
		}
	elseif ($action == 'gallerylist')
		{  
			$gallerylist = gallerylist();
			echo $gallerylist;	
		}
	elseif ($action == 'getdrivingtips')
		{  
			$getdrivingtips = getdrivingtips();
			echo $getdrivingtips;	
		}
	elseif ($action == 'drivingtipofday')
		{  
			$drivingtipofday = drivingtipofday();
			echo $drivingtipofday;	
		}
	elseif ($action == 'drivingtipscategory')
		{  
			$category = mysql_real_escape_string($_REQUEST['category']);
			$drivingtipscategory = drivingtipscategory($category);
			echo $drivingtipscategory;	
		}
	elseif ($action == 'test') {
		echo 'test';
		}	
	

 


?>
