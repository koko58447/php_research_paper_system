<?php
include('../config.php');

$action = $_POST["action"];

$usertype="";

$deptid=$_SESSION['staffdeptid'];

if($_SESSION['usertype']=="Department User"){

   $usertype=" and s.DepartmentID=$deptid";

}


if($action == 'show'){  

    $limit_per_page=""; 
    if($_POST['entryvalue']==""){
        $limit_per_page=10; 
    } else{
        $limit_per_page=$_POST['entryvalue']; 
    }
    
    $page="";
    if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
    }
    else{
        $page=1;
    }

    $offset = ($page-1) * $limit_per_page; 

   
    
    $search = $_POST['search'];
    if($search == ''){         
        $sql="select s.*,d.Name as dname from tblstudent s,tbldepartment d 
        where s.DepartmentID=d.AID".$usertype. " order by s.AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select s.*,d.Name as dname from tblstudent s,tbldepartment d 
        where s.DepartmentID=d.AID ".$usertype. "  and (s.Name like '%$search%' or 
        s.Email like '%$search%' or s.FatherName like '%$search%' or d.Name like '%$search%')  
        order by s.AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table display product-overview mb-30 table-striped table-hover" id="support_table5">
            <thead>
                <tr>
                    <th width="7%;">No</th>                     
                    <th>Name</th>
                    <th>FatherName</th>
                    <th>NRC</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>PhoneNo</th> 
                    <th width="7%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
        ';
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out.="<tr>
                <td>{$no}</td>                 
                <td>{$row["Name"]}</td>
                <td>{$row["FatherName"]}</td>    
                <td>{$row["NRC"]}</td> 
                <td>{$row["dname"]}</td>
                <td>{$row["Gender"]}</td>
                <td>{$row["PhoneNo"]}</td>
                <td class='text-center'>
                    <div class='dropdown'>
                        <a class='btn btn-link font-30 p-0 line-height-1'
                            href='#' role='button' data-toggle='dropdown'>
                            <i class='material-icons'>more_vert</i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list p-1'>  
                            ";                               
                        $out.="
                            <a href='#' id='btnchangeimg' class='dropdown-item'
                                data-aid='{$row['AID']}'
                                data-path='{$row['Img']}'><i
                                class='fa fa-image text-primary'
                                style='font-size:15px;'></i>
                                Change Image</a>
                            <a href='#' id='btnedit' class='dropdown-item'
                                data-aid='{$row['AID']}'><i
                                class='fa fa-edit text-success'
                                style='font-size:15px;'></i>
                                Edit</a>
                            <a href='#' id='btndelete' class='dropdown-item'
                                data-aid='{$row['AID']}'><i
                                class='fa fa-close text-danger'
                                style='font-size:15px;'></i>
                                Delete</a>
                            <a href='#' id='btnactivity' class='dropdown-item'
                                data-aid='{$row['AID']}'
                                data-name='{$row['Name']}'><i
                                class='fa fa-trophy text-primary'
                                style='font-size:15px;'></i>
                                Activity</a> 
                            <a href='#' id='btnpaper' class='dropdown-item'
                                data-aid='{$row['AID']}'
                                data-name='{$row['Name']}'><i
                                class='fa fa-file-o text-info'
                                style='font-size:15px;'></i>
                                Paper</a>                           
                        </div>
                    </div>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table><br><br>";

        $sql_total="";
        if($search == ''){         
            $sql_total="select s.AID from tblstudent s,tbldepartment d 
            where s.DepartmentID=d.AID".$usertype. "  order by s.AID desc";
        }else{ 
            $sql_total="select s.AID from tblstudent s,tbldepartment d 
            where s.DepartmentID=d.AID".$usertype. "  and (s.Name like '%$search%' or 
            s.Email like '%$search%' or s.FatherName like '%$search%' or d.Name like '%$search%')  
            order by s.AID desc";  
        }
        $record = mysqli_query($con,$sql_total) or die("fail query");
        $total_record = mysqli_num_rows($record);
        $total_links = ceil($total_record/$limit_per_page);

        $out.='<div class="pull-left"><p>Total Records -  ';
        $out.=$total_record;
        $out.='</p></div>';

        $out.='<div class="pull-right">
                <ul class="pagination">
            ';      
        
        $previous_link = '';
        $next_link = '';
        $page_link = '';

        if($total_links > 4){
            if($page < 5){
                for($count = 1; $count <= 5; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }else{
                $end_limit = $total_links - 5;
                if($page > $end_limit){
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for($count = $end_limit; $count <= $total_links; $count++)
                    {
                        $page_array[] = $count;
                    }
                }else{
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for($count = $page - 1; $count <= $page + 1; $count++)
                    {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }            

        }else{
            for($count = 1; $count <= $total_links; $count++)
            {
                $page_array[] = $count;
            }
        }

        for($count = 0; $count < count($page_array); $count++){
            if($page == $page_array[$count]){
                $page_link .= '<li class="page-item active">
                                    <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                                </li>';

                $previous_id = $page_array[$count] - 1;
                if($previous_id > 0){
                    $previous_link = '<li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a>
                                    </li>';
                }
                else{
                    $previous_link = '<li class="page-item disabled">
                                            <a class="page-link" href="#">Previous</a>
                                    </li>';
                }

                $next_id = $page_array[$count] + 1;
                if($next_id >= $total_links){
                    $next_link = '<li class="page-item disabled">
                                        <a class="page-link" href="#">Next</a>
                                </li>';
                }else{
                    $next_link = '<li class="page-item">
                                    <a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a>
                                </li>';
                }
            }else{
                if($page_array[$count] == '...')
                {
                    $page_link .= '<li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li> ';
                }else{
                    $page_link .= '<li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
                                    </li> ';
                }
            }
        }

        $out .= $previous_link . $page_link . $next_link;

        $out .= '</ul></div>';

        echo $out; 
        
    }
    else{
    $out.='
    <table class="table display product-overview mb-30" id="support_table5">
        <thead>
            <tr>
                <th width="7%;">No</th>                     
                <th>Name</th>
                <th>FatherName</th>
                <th>NRC</th>
                <th>Department</th>
                <th>Gender</th>
                <th>PhoneNo</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center" colspan="8">No record found.</td>
        </tr>
        </tbody>
    </table>';
    echo $out;
    }
  
}



if($action == 'save'){      
    $name = $_POST["name"];
    $fname = $_POST["fname"];
    $nrc = $_POST["nrc"];
    $gender = $_POST["gender"];
    $religion = $_POST["religion"];
    $nation = $_POST["nation"];
    $dob = $_POST["dob"];
    $dept = $_POST["dept"];
    $phno = $_POST["phno"];
    $email = $_POST["email"];
    $address = $_POST["address"];   

    if($_FILES['file1']['name'] != ''){  
        $filename = $_FILES['file1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file1']['tmp_name'];
        $valid_extension = array("png","jpg","jpeg");

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/student/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql="insert into tblstudent (Name,FatherName,NRC,Gender,Religion,Nation,Email,PhoneNo,Address,DepartmentID,DOB,Img) 
                values ('{$name}','{$fname}','{$nrc}','{$gender}','{$religion}','{$nation}','{$email}','{$phno}','{$address}','{$dept}','{$dob}','{$new_filename}')";

                if(mysqli_query($con,$sql)){
                    save_log($_SESSION["username"]." သည် student အားအသစ်သွင်းသွားသည်။");
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
            else{
                echo "fail";
            }
        }
        else{
            echo "wrongtype";
        }       
    }
    else{
        $sql="insert into tblstudent (Name,FatherName,NRC,Gender,Religion,Nation,Email,PhoneNo,Address,DepartmentID,DOB) 
        values ('{$name}','{$fname}','{$nrc}','{$gender}','{$religion}','{$nation}','{$email}','{$phno}','{$address}','{$dept}','{$dob}')";
        
        if(mysqli_query($con,$sql)){
            save_log($_SESSION["username"]." သည် student အားအသစ်သွင်းသွားသည်။");
            echo "success";
        }
        else{
            echo "fail";
        }
    } 
}


if($action == 'prepare'){
    $aid = $_POST["aid"];
    $sql="select s.*,d.Name as dname from tblstudent s,tbldepartment d 
    where s.DepartmentID=d.AID and s.AID=$aid";
    $result=mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='action' value='edit'>
        <input type='hidden' name='eaid' value='{$aid}'>
        <div class='modal-body'>
            <div class='row'>                        
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Name</label>
                        <input type='text' name='ename' value='{$row['Name']}' class='form-control' placeholder='Enter Staff Name'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Father Name</label>
                        <input type='text' name='efname' value='{$row['FatherName']}' class='form-control' placeholder='Enter Father Name'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>NRC</label>
                        <input type='text' name='enrc' value='{$row['NRC']}' class='form-control' placeholder='Enter NRC No'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Gender</label>
                        <select class='form-control' name='egender'>
                            <option value='{$row['Gender']}'>{$row['Gender']}</option>
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                        </select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Religion</label>
                        <select class='form-control' name='ereligion'>
                            <option value='{$row['Religion']}'>{$row['Religion']}</option>
                            <option value='ဗုဒ္ဓဘာသာ'>ဗုဒ္ဓဘာသာ</option>
                            <option value='ခရစ်ယာဉ်ဘာသာ'>ခရစ်ယာဉ်ဘာသာ</option>
                            <option value='ဟိန္ဒူဘာသာ'>ဟိန္ဒူဘာသာ</option>
                            <option value='အခြား'>အခြား</option>
                        </select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Nationality</label>
                        <select class='form-control' name='enation'>
                            <option value='{$row['Nation']}'>{$row['Nation']}</option>
                            <option value='ဗမာ'>ဗမာ</option>
                            <option value='မွန်'>မွန်</option>
                            <option value='ရခိုင်'>ရခိုင်</option>
                            <option value='ရှမ်း'>ရှမ်း</option>
                            <option value='ကရင်'>ကရင်</option>
                            <option value='ကချင်'>ကချင်</option>
                            <option value='ချင်း'>ချင်း</option>
                            <option value='ကယား'>ကယား</option>
                        </select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Date of Birth</label>
                        <input type='date' name='edob' class='form-control' placeholder='Enter Date of Birth'
                        value='{$row['DOB']}'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Department</label>
                        <select class='form-control' name='edept'>
                            <option value='{$row['DepartmentID']}'>{$row['dname']}</option>
                            ".load_department()."
                        </select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Phone No</label>
                        <input type='text' name='ephno' value='{$row['PhoneNo']}' class='form-control' placeholder='Enter Phone No'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Email</label>
                        <input type='text' name='eemail' value='{$row['Email']}' class='form-control' placeholder='Enter email'>
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Address</label>
                        <input type='text' name='eaddress' value='{$row['Address']}' class='form-control' placeholder='Enter Address'>
                    </div>
                </div>
            </div>
            <div class='text-center'>
                <p id='show_error1' class='text-danger'></p>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'><i
                    class='fa fa-close'></i>Close</button>
            <button type='submit' id='btneditsave' class='btn btn-primary'><i
                    class='fa fa-edit'></i>Edit</button>
        </div>
        ";

        echo $out;
    }
}

if($action == 'edit'){       
    $aid=$_POST['eaid'];
    $sql="update tblstudent set Name='{$_POST['ename']}',NRC='{$_POST['enrc']}',DOB='{$_POST['edob']}',DepartmentID='{$_POST['edept']}',Nation='{$_POST['enation']}', 
    Religion='{$_POST['ereligion']}',Gender='{$_POST['egender']}',Address='{$_POST['eaddress']}',PhoneNo='{$_POST['ephno']}',FatherName='{$_POST['efname']}',Email='{$_POST['eemail']}'  
    where AID={$aid}";
   
    if(mysqli_query($con,$sql)){
        save_log($_SESSION["username"]." သည် student အားပြင်ဆင်သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }

}

if($action == 'delete'){
      $aid = $_POST["aid"];
      $sql = "delete from tblstudent where AID=$aid";     
      if(mysqli_query($con,$sql)){
          save_log($_SESSION["username"]." သည် student အားဖျက်သွားသည်။");
          echo 1;
      }
      else{
          echo 0;
      }
      
}


if($action == 'fileupdate'){
    if($_FILES['file2']['name'] != ''){    
        
        $aid = $_POST['faid'];

        $filename = $_FILES['file2']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file2']['tmp_name'];
        $valid_extension = array("pdf","xls","xlsx","docx","png","jpg","jpeg");
        if(in_array($extension,$valid_extension)){
            //to delete file under upload folder
            $oldpath = $_POST['oldpath'];
            if(!empty($_POST['oldpath'])){
                unlink(root.'upload/student/'.$oldpath);
            } 

            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/student/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "update tblstudent set Img='{$new_filename}' where AID=$aid";
                if(mysqli_query($con,$sql)){
                    echo "success";
                }
                else{
                    echo "fail";
                }
            }
            else{
                echo "fail";
            }
        }
        else{
            echo "wrongtype";
        }       
    }
    else{
        echo "nofile";
    }
}


if($action=='excel'){

    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select s.*,d.Name as dname from tblstudent s,tbldepartment d 
        where s.DepartmentID=d.AID".$usertype. " order by s.AID desc";
    }else{ 
        $sql="select s.*,d.Name as dname from tblstudent s,tbldepartment d 
        where s.DepartmentID=d.AID".$usertype. " and (s.Name like '%$search%' or 
        s.Email like '%$search%' or s.FatherName like '%$search%' or d.Name like '%$search%')  
        order by s.AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "StudentReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                    <td colspan="12" align="center"><h3>Student List</h3></td>
            </tr>
            <tr><td colspan="12"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Name</th>  
                <th style="border: 1px solid ;">Father Name</th> 
                <th style="border: 1px solid ;">NRC</th>
                <th style="border: 1px solid ;">Date Of Birth</th> 
                <th style="border: 1px solid ;">Gender</th>  
                <th style="border: 1px solid ;">Religion</th>
                <th style="border: 1px solid ;">Nation</th>  
                <th style="border: 1px solid ;">Email</th>
                <th style="border: 1px solid ;">PhoneNo</th>  
                <th style="border: 1px solid ;">Address</th>
                <th style="border: 1px solid ;">Department</th>  
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>
                    <td style="border: 1px solid ;">'.$row["FatherName"].'</td>
                    <td style="border: 1px solid ;">'.$row["NRC"].'</td>
                    <td style="border: 1px solid ;">'.$row["DOB"].'</td>
                    <td style="border: 1px solid ;">'.$row["Gender"].'</td>
                    <td style="border: 1px solid ;">'.$row["Religion"].'</td>
                    <td style="border: 1px solid ;">'.$row["Nation"].'</td>
                    <td style="border: 1px solid ;">'.$row["Email"].'</td>
                    <td style="border: 1px solid ;">'.$row["PhoneNo"].'</td>
                    <td style="border: 1px solid ;">'.$row["Address"].'</td>
                    <td style="border: 1px solid ;">'.$row["dname"].'</td>
                </tr>';
        }
        $out .= '</table>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$fileName);
        echo $out;
    }else{
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
        <tr>
        <td colspan="12" align="center"><h3>Student List</h3></td>
        </tr>
        <tr><td colspan="12"><td></tr>
        <tr>  
            <th style="border: 1px solid ;">No</th>  
            <th style="border: 1px solid ;">Name</th>  
            <th style="border: 1px solid ;">Father Name</th> 
            <th style="border: 1px solid ;">NRC</th>
            <th style="border: 1px solid ;">Date Of Birth</th> 
            <th style="border: 1px solid ;">Gender</th>  
            <th style="border: 1px solid ;">Religion</th>
            <th style="border: 1px solid ;">Nation</th>  
            <th style="border: 1px solid ;">Email</th>
            <th style="border: 1px solid ;">PhoneNo</th>  
            <th style="border: 1px solid ;">Address</th>
            <th style="border: 1px solid ;">Department</th>  
        </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="12">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}


if($action == 'goactivity'){
    unset($_SESSION['studentaid']);
    $aid = $_POST['aid'];
    $name = $_POST['name'];
    $_SESSION['studentaid'] = $aid;
    $_SESSION['stuname'] = $name;
}

if($action == 'gomark'){
    unset($_SESSION['studentaid']);
    $aid = $_POST['aid'];
    $name = $_POST['name'];
    $_SESSION['studentaid'] = $aid;
    $_SESSION['stuname'] = $name;
}




?>