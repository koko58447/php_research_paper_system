<?php 

include("config.php");

$action=$_POST["action"];

if($action=="login"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="select * from tbluser  
    where UserName='{$username}' and Password='{$password}'";
    $result = mysqli_query($con,$sql); 
    
    

    if(mysqli_num_rows($result) > 0){
       
        $row = mysqli_fetch_array($result);
        $_SESSION["userid"] =$row['AID'];        
        $_SESSION["username"] =$row['UserName'];
        $_SESSION["password"] =$row['Password'];
        $_SESSION["usertype"]=$row['UserType'];
        $_SESSION["teacherid"]=$row['StaffID'];

        $staffid = $row['StaffID'];
        $sql1 = "select DepartmentID,Name,Img from tblstaff where AID=$staffid";
        $result1 = mysqli_query($con,$sql1);
        $row1 = mysqli_fetch_array($result1);
        $_SESSION["staffdeptid"]=$row1['DepartmentID'];
        $_SESSION["name"] =$row1['Name'];
        if($row1['Img']==null || $row1['Img']==''){
            $_SESSION["img"]="noimage.jpg";
        }else{
            $_SESSION["img"]=$row1['Img'];
        }
        
                  
        echo 1;

    }else{
        session_unset();
        echo 0;
    }
}

if($action=="logout"){    
      session_unset();
      echo 1;
}






?>