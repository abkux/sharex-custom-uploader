<?php
$secret_key = "secret-key"; //Set This As Your Secret Key So Only You Have Access (Basically A Password)
$sharexdir = "directory/"; // Must include / after folder name
$domain_url = 'https://abku.dev'; // Domain name, must include / after domain
//If You Dont Have A SSL Certificate Then Keep It As Http (000webhost Has A Free SSL Certificate)
$lengthofstring = 5; //Length Of The File You Will Upload's Name

function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));

    $key = '';
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

if(isset($_POST['secret']))
{
    if($_POST['secret'] == $secret_key)
    {
        $filename = RandomString($lengthofstring);
        $target_file = $_FILES["sharex"]["name"];
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["sharex"]["tmp_name"], $sharexdir.$filename.'.'.$fileType))
        {
            echo $domain_url.$sharexdir.$filename.'.'.$fileType;
        }
            else
        {
           echo 'File Upload Failed - CHMOD/Folder Doesnt Exist';
        }
    }
    else
    {
        echo 'Invalid Secret Key';
    }
}
else
{
    echo 'No Post Data Recieved';
}
?>