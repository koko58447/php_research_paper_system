<?php 

session_start();

$con=new mysqli("localhost","root","root","efl");
mysqli_set_charset($con,"utf8");

define('root',__DIR__.'/');

define('roothtml','http://localhost/efl_myanmar/');

define('curlink',basename($_SERVER['SCRIPT_NAME']));

$remain_qty=3;


function GetString($sql)
{
    global $con;
    $str="";   
    $result=mysqli_query($con,$sql) or die("Query Fail");
    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_array($result);
       $str= $row[0];
    }

    return $str;
}


function load_department()
{
    global $con;
    $sql="select * from tbldepartment";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}


function load_staff()
{
    global $con;
    $sql="select AID,Name from tblstaff";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_student()
{
    global $con;
    $sql="select AID,Name from tblstudent";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_bonus()
{
    global $con;
    $sql="select AID,Name from tblbonus";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}


function load_cut()
{
    global $con;
    $sql="select AID,Name from tblcut";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}


function load_subject_with_aid($aid)
{
    global $con;
    $sql="select AID,Name from tblsubject where SemesterID=$aid";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_semester()
{
    global $con;
    $sql="select AID,Name from tblsemester";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_subject()
{
    global $con;
    $sql="select AID,Name from tblsubject";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_teacher()
{
    global $con;
    $sql="select AID,Name from tblstaff where ChkStatus=1";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function load_rank()
{
    global $con;
    $sql="select AID,Name from tblrank";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}


function load_time()
{
    global $con;
    $sql="select AID,Name from tbltime";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["Name"]}</option>";
    }
    return $out;
}

function check_grade($sql){

    $str="";
    if($sql==0){
        $str="Select Option";
    }else if($sql==1){
        $str="Weak";
    }else if($sql==2){
        $str="Normal";
    }else if($sql==3){
        $str="Good";
    }else if($sql==4){
        $str="Very Good";
    }

    return $str;
}


function save_log($des)
{ 
    global $con;
    $userid=$_SESSION["userid"];
    $dt=date('Y-m-d H:i:s');
    $sql="insert into tbllog (Description,UserID,Date) values ('{$des}'
    ,$userid,'{$dt}')";
    mysqli_query($con,$sql);   
}

function toMyanmar($number)
{
        $array = [
            '0' => '၀',
            '1' => '၁',
            '2' => '၂',
            '3' => '၃',
            '4' => '၄',
            '5' => '၅',
            '6' => '၆',
            '7' => '၇',
            '8' => '၈',
            '9' => '၉',
        ];
        return strtr($number, $array);
}


function toEnglish($number)
{
        $array = [
            '၀' => '0',
            '၁' => '1',
            '၂' => '2',
            '၃' => '3',
            '၄' => '4',
            '၅' => '5',
            '၆' => '6',
            '၇' => '7',
            '၈' => '8',
            '၉' => '9',
        ];
        return strtr($number, $array);
}

function mmDate($date)
{
    $date = date_create($date);
    $date = date_format($date,"d-m-Y");
    return toMyanmar($date);
}

function enDate($date)
{
    $date = date_create($date);
    $date = date_format($date,"d-m-Y");
    return $date;
}



?>