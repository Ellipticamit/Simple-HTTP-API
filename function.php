<?php
ob_start();
header('Access-Control-Allow-Origin: *');
require_once ('apidb_connect.php');
$db = new DB_CONNECT();

		function register($name, $email, $profileUrl, $contact, $emergencycontact, $password,$type)
			{
				$userid = '';
				$query = mysql_query("INSERT INTO userregister (userId,name,email,profileUrl,contact,emergencycontact,password,type) VALUES ('','".$name."', '".$email."', '".$profileUrl."', '".$contact."', '".$emergencycontact."', '".$password."', '".$type."')");
						if(!$query )
							{
								$response["success"] = 0;
								$response["message"] = "Error occur. Try again.";
								return json_encode($response);
							}
						$sqls = mysql_query("SELECT * FROM userregister WHERE name = '".$name."'");
						while($rows = mysql_fetch_array($sqls)) 
									{
										$userid = $rows['userId'];
									}
						$response["success"] = 1;
						$response["userid"] = $userid;
						return json_encode($response);
			}
			
			function login($email, $password)
			{
				$sql = mysql_query("SELECT * FROM userregister WHERE email = '".$email."' AND password = '".$password."' ");
				if(!$sql) { 
						$response["success"] = 0;
						$response["message"] = "Database Error. Try Again.!";
						return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0){
						while($rows = mysql_fetch_array($sql)) 
									{
										$userid = $rows['userId'];
									}
						$response["success"] = 1;
						$response["userid"] = $userid;
						return json_encode($response);
				}
				else{
						$response["success"] = 0;
						$response["message"] = "Invalid Login";
						return json_encode($response);
				}
		        }
			function drivingtips($tipdetail, $tipcategory, $tipuploadtime)
			{
					$query = mysql_query("INSERT INTO drivingtips (tipid, tipdetail, tipcategory,tipuploadtime) VALUES ('','".$tipdetail."', '".$tipcategory."', '".$tipuploadtime."')");
					if(!$query)
						{
							$response["success"] = 0;
							$response["message"] = "Error occur. Try again.";
							return json_encode($response);
						}
					else{
							$response["success"] = 1;
							$response["message"] = "Successfully Uploaded";
							return json_encode($response);
					}
			}
			function getdrivingtips()
			{
					$query = mysql_query("SELECT * FROM `drivingtips`");
					if(!$query)
						{
							$response["success"] = 0;
							$response["message"] = "Error occur. Try again.";
							return json_encode($response);
						}
					elseif(mysql_num_rows($query) > 0) {
						$response["drivingtips"] = array();
						while($row = mysql_fetch_array($query)) {
							$drivingtips['tipId'] = $row['tipid'];
							$drivingtips['tipDetail'] = $row['tipdetail'];
							$drivingtips['tipCategory'] = $row['tipcategory'];
							$drivingtips['tipUploadtime'] = $row['tipuploadtime'];
							array_push($response["drivingtips"], $drivingtips);
						}
						$response["success"] = 1;
						return json_encode($response);
					}
					else 	
					{		
						$response["success"] = 1;
						$response["message"] = "Empty";	
						return json_encode($response);
					}	
			}
			function drivingtipofday()
			{
					$query = mysql_query("SELECT * FROM `drivingtips` where `tipofday` = 1");
					if(!$query)
						{
							$response["success"] = 0;
							$response["message"] = "Error occur. Try again.";
							return json_encode($response);
						}
					elseif(mysql_num_rows($query) > 0) {
						$response["drivingtips"] = array();
						while($row = mysql_fetch_array($query)) {
							$drivingtips['tipId'] = $row['tipid'];
							$drivingtips['tipDetail'] = $row['tipdetail'];
							$drivingtips['tipCategory'] = $row['tipcategory'];
							$drivingtips['tipUploadtime'] = $row['tipuploadtime'];
							array_push($response["drivingtips"], $drivingtips);
						}
						$response["success"] = 1;
						return json_encode($response);
					}
					else 	
					{		
						$response["success"] = 1;
						$response["message"] = "Empty";	
						return json_encode($response);
					}	
			}
			function drivingtipscategory($category)
			{
					$query = mysql_query("SELECT * FROM `drivingtips` where `tipcategory` = '".$category."'");
					if(!$query)
						{
							$response["success"] = 0;
							$response["message"] = "Error occur. Try again.";
							return json_encode($response);
						}
					elseif(mysql_num_rows($query) > 0) {
						$response["drivingtipcategory"] = array();
						while($row = mysql_fetch_array($query)) {
							$drivingtipcategory['tipId'] = $row['tipid'];
							$drivingtipcategory['tipDetail'] = $row['tipdetail'];
							$drivingtipcategory['tipCategory'] = $row['tipcategory'];
							$drivingtipcategory['tipUploadtime'] = $row['tipuploadtime'];
							array_push($response["drivingtipcategory"], $drivingtipcategory);
						}
						$response["success"] = 1;
						return json_encode($response);
					}
					else 	
					{		
						$response["success"] = 1;
						$response["message"] = "Empty";	
						return json_encode($response);
					}	
			}
			
			function state()
			{
				$sql = mysql_query("SELECT * FROM `state`");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["statelist"] = array();
					while($row = mysql_fetch_array($sql)) {
						$statelist['stateId'] = $row['stateId'];
						$statelist['stateName'] = $row['stateName'];
						array_push($response["statelist"], $statelist);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function getstate($stateId)
			{
				$sql = mysql_query("SELECT * FROM `state` where `stateId` = '".$stateId."'");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["statelist"] = array();
					while($row = mysql_fetch_array($sql)) {
						$statelist['stateId'] = $row['stateId'];
						$statelist['stateName'] = $row['stateName'];
						array_push($response["statelist"], $statelist);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function city()
			{
				$sql = mysql_query("SELECT * FROM `city`");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["citylist"] = array();
					while($row = mysql_fetch_array($sql)) {
						$citylist['cityId'] = $row['cityId'];
						$citylist['stateId'] = $row['stateId'];
						$citylist['cityName'] = $row['cityName'];
						array_push($response["citylist"], $citylist);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function getcity($cityId)
			{
				$sql = mysql_query("SELECT * FROM `city` where cityId = '".$cityId."' ");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["citylist"] = array(); $citylist['localitylist'] = array();
					while($row = mysql_fetch_array($sql)) {
						$citylist['cityId'] = $row['cityId'];
						$citylist['stateId'] = $row['stateId'];
						$citylist['cityName'] = $row['cityName'];
							$query = mysql_query("SELECT * FROM `locality` where `cityId`= '".$cityId."'");
								if(mysql_num_rows($query) > 0)
								{	
									while($rows = mysql_fetch_array($query)) {
										$localitylist['localityId'] = $rows['localityId'];
										$localitylist['locaityName'] = $rows['localityName'];
										array_push($citylist["localitylist"], $localitylist);
										
									}
								}
						
						array_push($response["citylist"], $citylist);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function locality()
			{
				$sql = mysql_query("SELECT * FROM `locality`");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["locality"] = array();
					while($row = mysql_fetch_array($sql)) {
						$locality['locaityId'] = $row['locaityId'];
						$locality['cityId'] = $row['cityId'];
						$locality['stateId'] = $row['stateId'];
						$locality['localityName'] = $row['localityName'];
						array_push($response["locality"], $locality);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function getlocality($locaityId)
			{
				$sql = mysql_query("SELECT * FROM `locality` where localityId = '".$locaityId."'");
				if(!$sql) { 
					$response["success"] = 0;
					$response["message"] = "Database Error. Try Again.!";
					return json_encode($response);
				}
				elseif(mysql_num_rows($sql) > 0) {
					$response["locality"] = array();
					while($row = mysql_fetch_array($sql)) {
						$locality['locaityId'] = $locaityId;
						$locality['cityId'] = $row['cityId'];
						$locality['stateId'] = $row['stateId'];
						$locality['localityName'] = $row['localityName'];
						array_push($response["locality"], $locality);
					}
					$response["success"] = 1;
					return json_encode($response);
				}
				else 	
				{		
					$response["success"] = 1;
					$response["message"] = "Empty List";	
					return json_encode($response);
				}		
			}
			function gallery($photoUrl,$photoCaption,$uploadedBy,$uploadedtime)
			{
				$query = mysql_query("INSERT INTO gallery (photoId,photoUrl,photoCaption,uploadedBy,uploadedTime) VALUES ('','".$photoUrl."', '".$photoCaption."', '".$uploadedBy."', '".$uploadedtime."')");
				if(!$query )
					{
						$response["success"] = 0;
						$response["message"] = "Error occur. Try again.";
						return json_encode($response);
					}
					$response["success"] = 1;
					return json_encode($response);
			}
			function gallerycomments($photoId,$userId,$commentDetail,$commentTime)
			{
				$query = mysql_query("INSERT INTO gallerycomments (commentId,photoId,userId,commentDetail,commentTime) VALUES ('','".$photoId."', '".$userId."', '".$commentDetail."', '".$commentTime."')");
				if(!$query )
					{
						$response["success"] = 0;
						$response["message"] = "Error occur. Try again.";
						return json_encode($response);
					}
					$response["success"] = 1;
					return json_encode($response);
			}
			function trafficstatus($stateId,$cityId,$localityId,$traffic,$userId,$alternateroute)
			{
				$query = mysql_query("INSERT INTO trafficstatus (statusId,stateId,cityId,localityId,trafficstatus,userId,alternateroute) VALUES ('','".$stateId."', '".$cityId."', '".$localityId."', '".$traffic."','".$userId."', '".$alternateroute."')");
			
				if(!$query )
					{
						$response["success"] = 0;
						$response["message"] = "Error occur.";
						return json_encode($response);
					}
					$response["success"] = 1;
					return json_encode($response);
			}
			function gettrafficstatus($stateId,$cityId,$localityId,$traffic,$userId,$alternateroute)
			{
				$query = mysql_query("INSERT INTO trafficstatus (statusId,stateId,cityId,localityId,trafficstatus,userId,alternateroute) VALUES ('','".$stateId."', '".$cityId."', '".$localityId."', '".$traffic."','".$userId."', '".$alternateroute."')");
			
				$query = mysql_query("SELECT * FROM `drivingtips`");
					if(!$query)
						{
							$response["success"] = 0;
							$response["message"] = "Error occur. Try again.";
							return json_encode($response);
						}
					elseif(mysql_num_rows($query) > 0) {
						$response["gettrafficstatus"] = array();
						while($row = mysql_fetch_array($query)) {
							$gettrafficstatus['statusId'] = $row['statusId'];
							$gettrafficstatus['stateId'] = $row['stateId'];
							$gettrafficstatus['cityId'] = $row['cityId'];
							$gettrafficstatus['localityId'] = $row['localityId'];
							$gettrafficstatus['trafficstatus'] = $row['trafficstatus'];
							$gettrafficstatus['userId'] = $row['userId'];
							$gettrafficstatus['alternateroute'] = $row['alternateroute'];
							array_push($response["gettrafficstatus"], $gettrafficstatus);
						}
						$response["success"] = 1;
						return json_encode($response);
					}
					else 	
					{		
						$response["success"] = 1;
						$response["message"] = "Empty";	
						return json_encode($response);
					}
			}
			function gallerylist()
			{
				$sql = mysql_query("SELECT * FROM `gallery`");
					if(!$sql) 
					{ 	
						$response["success"] = 0;
						$response["message"] = "Database Error. Try Again.!";
						return json_encode($response);
					}
					elseif(mysql_num_rows($sql) > 0)
					{
						$response["gallerylist"] = array(); $gallerylist['gallerycomment'] = array();  $gallerycomment = array();
						while($row = mysql_fetch_array($sql)) {
							$gallerylist['photoId'] = $row['photoId'];
							$gallerylist['photoUrl'] = $row['photoUrl'];
							$gallerylist['photoCaption'] = $row['photoCaption'];
								$query = mysql_query("SELECT * FROM `gallerycomments` where `photoId`= '".$gallerylist['photoId']."'");
								if(mysql_num_rows($query) > 0)
								{	
									while($rows = mysql_fetch_array($query)) {
										$gallerycomment['CommentDetail'] = $rows['commentDetail'];
										$gallerycomment['CommentTime'] = $rows['commentTime'];
										$usernamequery = mysql_query("SELECT * FROM `userregister` where `userId`= '".$rows['userId']."'");
										while($usernamerow = mysql_fetch_array($usernamequery)) { $gallerycomment['userName'] = $usernamerow['name']; }
										array_push($gallerylist["gallerycomment"], $gallerycomment);
									}
								}
							$gallerylist['uploadedBy'] = $row['uploadedBy'];
							$gallerylist['uploadedTime'] = $row['uploadedTime'];
							array_push($response["gallerylist"], $gallerylist);
							$gallerylist['gallerycomment'] = array(); 
						}
						$response["success"] = 1;
						return json_encode($response);
					}
					else 
					{
						$response["success"] = 1;
						$response["message"] = "No Gallery Image";
						return json_encode($response);
					}		
			}
	
		
		
			
?>
