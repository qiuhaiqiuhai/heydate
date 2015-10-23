<?php
@$db = new mysqli('localhost','root', '', 'heydatedb');
// @ to ignore error message display //
if ($db->connect_error){
	echo "Database is not online"; 
	exit;
	// above 2 statments same as die() //
	}

if (!$db->select_db ("heydatedb"))
	exit("<p>Unable to locate the heydatedb database</p>");

function print_basic_info($userID, $db) {
// echo "<br>" .$query. "<br>";
    $query = 'select * from users_account '
           ."where userID=".$userID;
// echo "<br>" .$query. "<br>";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['name'].'<br/>'.
         $row['email'].'<br/>'.
         $row['birthdate'].'<br/>'.
         'Age:'.cal_age($row['birthdate']).'<br/>'.
         $row['gender'].'<br/>'.
         $row['city'].'<br/>'.
         $row['height'].'<br/>'.
         $row['education'].'<br/>';

    

    if ($row['profilePhoto']!=Null )
    {
        echo '<img src=users_profile_photo/'.$row['profilePhoto'].' height="100">';
    }elseif($row['gender'] == 'Male'){
        echo '<img src=users_profile_photo/default_male.jpg>';
    }else{
        echo '<img src=users_profile_photo/default_female.jpg>';
    }
}

function cal_age($birthdate) {
// echo "<br>" .$query. "<br>";
    $bday=date_create($birthdate);
    $today=date_create();
    $diff=date_diff($bday,$today);
    return $diff->y;
}


function photo_upload($photo_type, $target_dir ,$userID, $db, $isInsert) {
    //change profile photo
    if(file_exists($_FILES[$photo_type]['tmp_name'])||is_uploaded_file($_FILES[$photo_type]['tmp_name'])){

        $imageFileType = pathinfo($_FILES[$photo_type]["name"],PATHINFO_EXTENSION);
        $target_filename = $userID.($isInsert?'_'.time():'').'.'. $imageFileType;
        $target_path = $target_dir .$target_filename;
        echo $target_path; 
        $uploadOk = 1;


        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$photo_type]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_path)) {
            unlink($target_path);
        }
        // Check file size
        if ($_FILES[$photo_type]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$photo_type]["tmp_name"], $target_path)) {
                echo "The file ". basename( $_FILES[$photo_type]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }

        if($uploadOk != 0){

            if($isInsert){
                $sql = "INSERT INTO users_photo (userID, photo) 
                        VALUES ('$userID', '$target_filename')";
            }else{
                $sql = "UPDATE users_account set profilePhoto='$target_filename'
                where userID='$userID'; ";
            }
        //  echo "<br>". $sql. "<br>";
            $result = $db->query($sql);


            if (!$result) 
                echo "Your query failed.";
            else
                echo "Welcome ". $userID . ". You are now registered";
        } 

    }
}
?>	