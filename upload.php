
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
//Code that handles uploading of the CSV
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
if(isset($_POST["submit"])) {
    $check = $_FILES["fileToUpload"]["tmp_name"];
    if($check !== false) {
     $uploadOk = 1;
    } else {

        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       //Converts the CSV to a readable format for the API
        $data =  array();
        $response = '';
        $csv= file_get_contents($target_file);
        $array = array_map("str_getcsv", explode("\n", $csv));
        $json = json_encode($array);
        $data['json'] = $json;



        $url = 'http://xxxxxxxxxxxx/Quick-SMS/postfile.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);




    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
