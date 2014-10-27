<?php		
	
		
		$base = $_REQUEST["userprofile"];
		$name = $_REQUEST["name"];
		$email = $_REQUEST["email"];
		$contact = $_REQUEST["contact"];
		$emergencycontact = $_REQUEST["emergencycontact"];
		$password = $_REQUEST["password"];
		$type = $_REQUEST["type"];
				
//if (isset($base)) 
//{	 
	$suffix = createRandomID();
	$image_name = "img_".$suffix."_".date("Y-m-d-H-m-s").".png";
	$binary = base64_decode($base);
	$dir1="/home/hackholi/public_html/api/uploads/".$image_name;
	$profileUrl = "uploads/".$image_name;
	if (!file_exists($dir))
	{
		//calling database function
		register($name, $email, $profileUrl, $contact, $emergencycontact, $password,$type);

	//header("Content-Type: bitmap; charset=utf-8");
	$file = fopen($dir1, "wb");
	fwrite($file, $binary);
	fclose($file); if (!file_exists($dir1)) {  chmod($dir1,0777);} 
	
	}
	else 
	{ 
		register($name, $email, $profileUrl, $contact, $emergencycontact, $password, $type);

	//header("Content-Type: bitmap; charset=utf-8");
	$file = fopen("/home/hackholi/public_html/api/uploads" . $image_name, "wb");
	fwrite($file, $binary);
	fclose($file);
      	 if (!file_exists($dir1)) {  chmod($dir1,0777); } 
	die($image_name);
	}	
//}
//else
 //{ die("No POST"); }

function createRandomID()
 {
	$chars = "abcdefghijkmnopqrstuvwxyz0123456789?";
	//srand((double) microtime() * 1000000);
	$i = 0;
	$pass = "";
	while ($i <= 5)
	{
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
function register($name, $email, $profileUrl, $contact, $emergencycontact, $password, $type)
{
		$host="localhost"; 		
		$username="hackholi_api"; 
		$passwords="P4ssword"; 
		$db_name="hackholi_api"; 

		$conn = mysql_connect($host, $username, $passwords);
		if(!$conn )
		{ die('Could not connect:' . mysql_error()); }
		mysql_select_db('hackholi_api');
	
		$sql = mysql_query("INSERT INTO `userregister` (userId,name,email,profileUrl,contact,emergencycontact,password,type) VALUES ('','".$name."', '".$email."', '".$profileUrl."', '".$contact."', '".$emergencycontact."', '".$password."', '".$type."')");
		
		$retval = mysql_query($sql, $conn);
		if(!$retval )	{ }	   
		mysql_close($conn);
}
?>
