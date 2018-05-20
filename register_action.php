<?php 

session_start();
ob_start();
$host="fdb21.awardspace.net";      
$username="2729660_sonal"; 
$password="Password@sn01"; 
$db_name="2729660_sonal"; 
//$tbl_name="members"; 

$con=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name") or die(mysqli_error($con));

if(isset($_POST)) {
    error_reporting(E_ALL);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    $rand_no=rand();
    move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        

    $image=basename( $_FILES["picture"]["name"],".jpg"); // used to store the filename in a variable
       
    $firstnamae=strip_tags($_POST['firstname']);
    $lastname=strip_tags($_POST['lastname']);
    $picture=strip_tags($_FILES['picture']['name']);
    $email=strip_tags($_POST['email']);
    $phone=strip_tags($_POST['phone']);
    $job_title=strip_tags($_POST['job_title']);
    

    if(empty($_POST['id'])){
            $add_user_query="INSERT INTO user_profiles (firstname, lastname, email,phone,job_title,profile_pic)
                     VALUES ('{$firstnamae}','{$lastname}','{$email}','{$phone}','{$job_title}','{$picture}')";
            $con->query($add_user_query);
            $_SESSION['user_id'] = $con->insert_id;
    }else{
            echo $add_user_query="UPDATE user_profiles SET firstname= '{$firstnamae}', lastname= '{$lastname}',
            email= '{$email}' , phone = '{$phone}' , job_title = {$job_title} , profile_pic = '{$picture}'
            WHERE id= {$_POST['id']}";
                     
            $con->query($add_user_query);
            $_SESSION['user_id'] = $_POST['id'];
    }
    
    //echo "->";print_r($_SESSION['user_id']);
    slack('from web');
    header("Location: view_detail.php?msg=success_author");
    

    
}

function slack($msg){
echo "inside";
$ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "k5zxdwQmTLKzL77D7Dd26N4m",
    	"channel" => '#general', //"#mychannel",
    	"text" => $msg, //"Hello, Foo-Bar channel message.",
    	"username" => "testproject",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    
    print_r($result);
   
}




















?>