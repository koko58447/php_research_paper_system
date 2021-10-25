<?php

include('../config.php');
    
    if(isset($_GET['file_id'])){
        $id = $_GET['file_id'];

        $userid=$_SESSION['userid'];

        $sqlinch="select AID from tblpublication where UserID=$userid and DocumentID=$id";
        $res1=mysqli_query($con,$sqlinch);
        if(mysqli_num_rows($res1) > 0){ 

        }else{
            $dt = date("Y-m-d H:i:s");
            $sqlin="insert into tbldownloadproject (DocumentID,UserID,Date) values ({$id},{$userid},'{$dt}')";
            mysqli_query($con,$sqlin);
        }

        //echo $id;
        $sql = "select FilePath from tblprojectdoc where AID=$id";
        $result = mysqli_query($con,$sql);
        $file = mysqli_fetch_array($result);
        $filepath = root.'upload/myproject/'.$file['FilePath'];

        if(file_exists($filepath)){
            header('Content-Type: application/octet-stream');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename='.
            basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma:public');
            header('Content-Length:'. filesize($filepath));        
            readfile($filepath);
            exit;        
        }
    }
    
?>