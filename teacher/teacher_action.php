<?php
include('../config.php');

$action = $_POST["action"];

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
          $sql="select * from tblstaff where ChkStatus=1 order by AID desc limit $offset,$limit_per_page";
      }else{ 
          $sql="select * from tblstaff where Name like '%$search%' and ChkStatus=1 order by AID desc limit $offset,$limit_per_page";  
      }
      
      $result=mysqli_query($con,$sql) or die("SQL a Query");
      $out="";
      if(mysqli_num_rows($result) > 0){
          $out.='
            <table class="table display product-overview mb-30 table-striped table-hover" id="support_table5">
                <thead>
                    <tr>
                        <th width="7%;">No</th>                     
                        <th>Teacher Name</th>
                        <th>NRC</th>
                        <th>Gender</th>
                        <th>PhoneNo</th>
                        <th>Salary</th> 
                        <th width="17%" class="text-center">Action</th>
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
                  <td>{$row["NRC"]}</td>    
                  <td>{$row["Gender"]}</td> 
                  <td>{$row["PhoneNo"]}</td>
                  <td>{$row["Salary"]}</td>
                  <td>
                  <a href='#' class='btn btn-tbl-edit btn-xs btn-success' 
                  data-toggle='tooltip' data-placement='bottom' title='Change File'                                           
                        id='btnchangeimage'
                        data-aid='{$row['AID']}'
                        data-img='{$row['Img']}'>
                        <i class='fa fa-file-o'></i>
                    </a>
                    <a href='#' class='btn btn-tbl-edit btn-xs' 
                        data-original-title='Profile' 
                        id='btnedit'
                        data-aid='{$row['AID']}'>
                        <i class='fa fa-pencil'></i>
                    </a>
                    <a href='#' class='btn btn-tbl-delete btn-xs' 
                        id='btndelete'
                        data-aid='{$row['AID']}'
                        data-img='{$row['Img']}'>
                        <i class='fa fa-trash-o'></i>
                    </a>
                    <a href='#' class='btn btn-tbl-edit btn-xs btn-primary' 
                        id='btnpublication'
                        data-aid='{$row['AID']}'
                        data-name='{$row['Name']}'>
                        <i class='fa fa-save'></i>
                    </a>
                  </td>
              </tr>";
          }
          $out.="</tbody>";
          $out.="</table><br><br>";
  
          $sql_total="";
          if($search == ''){
              $sql_total="select AID from tblstaff where ChkStatus=1";
          }else{
              $sql_total="select AID from tblstaff where ChkStatus=1 and Name like '%$search%'";
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
                    <th>Teacher Name</th>
                    <th>NRC</th>
                    <th>Gender</th>
                    <th>PhoneNo</th>
                    <th>Salary</th> 
                    <th width="10%" class="text-center">Edit</th>
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
  
    $staffname = $_POST["staffname"];
    $nrc = $_POST["nrc"];
    $dob = $_POST["dob"];
    $dept = $_POST["dept"];
    $salary = $_POST["salary"];
    $startdt = $_POST["startdt"];
    $religion = $_POST["religion"];
    $gender = $_POST["gender"];
    $phno = $_POST["phno"];
    $rmk = $_POST["rmk"];
    $address = $_POST["address"];   

    if($_FILES['file1']['name'] != ''){  
        $filename = $_FILES['file1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file1']['tmp_name'];
        $valid_extension = array("png","jpg","jpeg");

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/staff/teacher/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql="insert into tblstaff (Name,NRC,DOB,DepartmentID,Salary,StartDate,Religion,
                Gender,Address,PhoneNo,Img,Rmk,ChkStatus) values ('{$staffname}','{$nrc}',
                '{$dob}','{$dept}','{$salary}','{$startdt}','{$religion}','{$gender}','{$address}',
                '{$phno}','{$new_filename}','{$rmk}',1)";

                if(mysqli_query($con,$sql)){
                    save_log($_SESSION["username"]." သည် teacher အားအသစ်သွင်းသွားသည်။");
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
        $sql="insert into tblstaff (Name,NRC,DOB,DepartmentID,Salary,StartDate,Religion,
        Gender,Address,PhoneNo,Rmk,ChkStatus) values ('{$staffname}','{$nrc}',
        '{$dob}','{$dept}','{$salary}','{$startdt}','{$religion}','{$gender}','{$address}',
        '{$phno}','{$rmk}',1)";

        if(mysqli_query($con,$sql)){
            save_log($_SESSION["username"]." သည် teacher အားအသစ်သွင်းသွားသည်။");
            echo "success";
        }
        else{
            echo "fail";
        }
    } 
}


if($action == 'prepare'){
    $aid = $_POST["aid"];
    $sql="select s.*,d.Name as dname from tblstaff s,tbldepartment d 
    where s.DepartmentID=d.AID and s.AID=$aid";
    $result=mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='action' value='edit'>
        <input type='hidden' name='aid' value='{$aid}'>
        <div class='modal-body'>
            <div class='text-center'>
                <p id='show_error1' class='text-danger'></p>
            </div>
            <div class='row'>               
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Teacher Name</label>
                        <input type='text' name='staffname1' value='{$row['Name']}' class='form-control' placeholder='Enter Teacher Name'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>NRC</label>
                        <input type='text' name='nrc1' value='{$row['NRC']}' class='form-control' placeholder='Enter NRC No'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Date of Birth</label>
                        <input type='date' name='dob1' class='form-control' placeholder='Enter Date of Birth'
                            value='{$row['DOB']}'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Department</label>
                        <select class='form-control' name='dept1'>
                            <option value='{$row['DepartmentID']}'>{$row['dname']}</option>";
                            $out.=load_department();
                        $out.="</select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Salary</label>
                        <input type='text' name='salary1' value='{$row['Salary']}' class='form-control' placeholder='Enter Salary'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Start Date</label>
                        <input type='date' name='startdt1' class='form-control' placeholder='Enter start date'
                            value='{$row['StartDate']}'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label>Religion</label>
                        <select class='form-control' name='religion1'>
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
                        <label>Gender</label>
                        <select class='form-control' name='gender1'>
                            <option value='{$row['Gender']}'>{$row['Gender']}</option>
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                        </select>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Phone No</label>
                        <input type='text' name='phno1' value='{$row['PhoneNo']}' class='form-control' placeholder='Enter Phone No'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Remark</label>
                        <input type='text' name='rmk1' value='{$row['Rmk']}' class='form-control' placeholder='Enter Remark'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='simpleFormEmail'>Address</label>
                        <input type='text' name='address1' value='{$row['Address']}' class='form-control' placeholder='Enter Address'>
                    </div>
                </div>
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
      
    $aid=$_POST['aid'];
    $sql="update tblstaff set Name='{$_POST['staffname1']}',
    NRC='{$_POST['nrc1']}',DOB='{$_POST['dob1']}',DepartmentID='{$_POST['dept1']}',
    Salary='{$_POST['salary1']}',StartDate='{$_POST['startdt1']}',Religion='{$_POST['religion1']}',
    Gender='{$_POST['gender1']}',Address='{$_POST['address1']}',PhoneNo='{$_POST['phno1']}' where AID={$aid}";
    if(mysqli_query($con,$sql)){
        save_log($_SESSION["username"]." သည် staff အားပြင်ဆင်သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }

}

if($action == 'delete'){
      $aid = $_POST["aid"];

      $oldpath = $_POST['img'];
        if(!empty($_POST['img'])){
            unlink(root.'upload/staff/teacher/'.$oldpath);
        } 

      $sql = "delete from tblstaff where AID=$aid";     
      if(mysqli_query($con,$sql)){
          save_log($_SESSION["username"]." သည် teacher အားဖျက်သွားသည်။");
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
                unlink(root.'upload/staff/teacher/'.$oldpath);
            } 

            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/staff/teacher/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql = "update tblstaff set Img='{$new_filename}' where AID=$aid";
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
        $sql="select s.*,d.Name as dname from tblstaff s,tbldepartment d 
        where s.DepartmentID=d.AID and s.ChkStatus=1 order by s.AID desc";
    }else{ 
        $sql="select s.*,d.Name as dname from tblstaff s,tbldepartment d 
        where s.DepartmentID=d.AID and s.ChkStatus=1 and (s.Name like '%$search%') 
        order by s.AID desc";  
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "TeacherReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                    <td colspan="13" align="center"><h3>Teacher List</h3></td>
            </tr>
            <tr><td colspan="13"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Teacher Name</th>  
                <th style="border: 1px solid ;">NRC</th>
                <th style="border: 1px solid ;">DOB</th>  
                <th style="border: 1px solid ;">Department</th>
                <th style="border: 1px solid ;">Salary</th>  
                <th style="border: 1px solid ;">Start Date Name</th>
                <th style="border: 1px solid ;">Religion</th>  
                <th style="border: 1px solid ;">Gender</th>
                <th style="border: 1px solid ;">Address</th>  
                <th style="border: 1px solid ;">Phone No</th> 
                <th style="border: 1px solid ;">Rmk</th>  
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>
                    <td style="border: 1px solid ;">'.$row["NRC"].'</td>
                    <td style="border: 1px solid ;">'.$row["DOB"].'</td>
                    <td style="border: 1px solid ;">'.$row["dname"].'</td>
                    <td style="border: 1px solid ;">'.$row["Salary"].'</td>
                    <td style="border: 1px solid ;">'.$row["StartDate"].'</td>
                    <td style="border: 1px solid ;">'.$row["Religion"].'</td>
                    <td style="border: 1px solid ;">'.$row["Gender"].'</td>
                    <td style="border: 1px solid ;">'.$row["Address"].'</td>
                    <td style="border: 1px solid ;">'.$row["PhoneNo"].'</td>
                    <td style="border: 1px solid ;">'.$row["Rmk"].'</td>
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
                <td colspan="13" align="center"><h3>Staff Lists</h3></td>
            </tr>
            <tr><td colspan="13"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Teacher Name</th>  
                <th style="border: 1px solid ;">NRC</th>
                <th style="border: 1px solid ;">DOB</th>  
                <th style="border: 1px solid ;">Department</th>
                <th style="border: 1px solid ;">Salary</th>  
                <th style="border: 1px solid ;">Start Date Name</th>
                <th style="border: 1px solid ;">Religion</th>  
                <th style="border: 1px solid ;">Gender</th>
                <th style="border: 1px solid ;">Address</th>  
                <th style="border: 1px solid ;">Phone No</th> 
                <th style="border: 1px solid ;">Rmk</th>  
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="12" class="text-center">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}

if($action=='publication'){
    $aid=$_POST['aid'];
    $name=$_POST['name'];
    $_SESSION['teacherid']=$aid;
    $_SESSION['teachername']=$name;
}

if($action == 'edit_teacher'){  
    
    $aid = $_POST["aid"];  
    $staffname = $_POST["staffname"];
    $nrc = $_POST["nrc"];
    $dob = $_POST["dob"];
    $dept = $_POST["dept"];
    $rank = $_POST["rank"];
    $salary = $_POST["salary"];
    $startdt = $_POST["startdt"];
    $religion = $_POST["religion"];
    $gender = $_POST["gender"];
    $phno = $_POST["phno"];
    $rmk = $_POST["rmk"];
    $address = $_POST["address"];   

    if($_FILES['file1']['name'] != ''){  
        $filename = $_FILES['file1']['name'];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);
        $old_path = $_FILES['file1']['tmp_name'];
        $valid_extension = array("png","jpg","jpeg");

        $oldpath = $_POST['oldpath'];
        if(!empty($_POST['oldpath'])){
            unlink(root.'upload/staff/teacher/'.$oldpath);
        } 

        if(in_array($extension,$valid_extension)){  
            $new_filename = rand(1,100) ."_". $filename;
            $new_path = root."upload/staff/teacher/". $new_filename;
            if(move_uploaded_file($old_path,$new_path)){
                $sql="update tblstaff set Name='{$staffname}',NRC='{$nrc}',DOB='{$dob}',
                DepartmentID='{$dept}',RankID='{$rank}',Salary='{$salary}',StartDate='{$startdt}',
                Religion='{$religion}',Gender='{$gender}',Address='{$address}',
                PhoneNo='{$phno}',Img='{$new_filename}',Rmk='{$rmk}' where AID=$aid";

                if(mysqli_query($con,$sql)){
                    save_log($_SESSION["username"]." သည် teacher အားပြင်ဆင်သွားသည်");
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
        $sql="update tblstaff set Name='{$staffname}',NRC='{$nrc}',DOB='{$dob}',
            DepartmentID='{$dept}',RankID='{$rank}',Salary='{$salary}',StartDate='{$startdt}',
            Religion='{$religion}',Gender='{$gender}',Address='{$address}',
            PhoneNo='{$phno}',Rmk='{$rmk}' where AID=$aid";

        if(mysqli_query($con,$sql)){
            save_log($_SESSION["username"]." သည် teacher အားပြင်ဆင်သွားသည်");
            echo "success";
        }
        else{
            echo "fail";
        }
    } 
}




?>