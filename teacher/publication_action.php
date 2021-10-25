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
          $sql="select p.*,s.Name from tblpublication p,tblstaff s where s.AID=p.TeacherID".$usertype." order by p.AID desc limit $offset,$limit_per_page";
      }else{ 
        $sql="select p.*,s.Name from tblpublication p,tblstaff s where s.AID=p.TeacherID".$usertype." and (s.Name like '%$search%' or p.title like '%$search%' or p.year like '%$search%') 
        order by p.AID desc limit $offset,$limit_per_page";
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
                        <th>Title</th>
                        <th>Year</th>
                        <th>Date</th>
                        <th>Host University</th> 
                        <th>Host Country</th> 
                        <th>Author Name</th> 
                        <th>Co-author Name</th> 
                        <th>Conference Name</th>
                        <th width="10%" class="text-center">Edit</th>
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
                  <td>{$row["Title"]}</td>    
                  <td>{$row["Year"]}</td> 
                  <td>{$row["Date"]}</td>
                  <td>{$row["HostUni"]}</td>
                  <td>{$row["HostCountry"]}</td>
                  <td>{$row["Author"]}</td>
                  <td>{$row["CoAuthor"]}</td>
                  <td>{$row["ConferenceName"]}</td>


                  <td class='text-center'>
                    <div class='dropdown dropleft'>
                        <a data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <span class='text-primary' style='cursor:pointer;font-size:15px;'>
                            <i class='material-icons'>more_vert</i>
                            </span>
                        </a>
                        <div class='dropdown-menu'>
                            <a href='#' id='btnedit' class='dropdown-item'
                                data-aid='{$row['AID']}' data-toggle='modal'
                                data-target='#editmodal'><i class='fa fa-edit text-primary'
                                    style='font-size:13px;'></i>
                                Edit</a>
                            <div class='dropdown-divider'></div>
                            <a href='#' id='btndelete' class='dropdown-item'
                                data-aid='{$row['AID']}'><i
                                    class='fa fa-trash text-danger'
                                    style='font-size:13px;'></i>
                                Delete</a>
                            <div class='dropdown-divider'></div>

                            <a href='download.php?file_id={$row['AID']}' id='btndownload' class='dropdown-item'
                            data-aid='{$row['AID']}'><i
                                class='fa fa-eye text-primary'
                                style='font-size:13px;'></i>
                            Detail</a>
                            
                    </a>
                                                            
                        </div>
                    </div>
                </td>




                  
              </tr>";
          }
          $out.="</tbody>";
          $out.="</table><br><br>";
  
          $sql_total="";
          if($search == ''){
              $sql_total="select p.AID from tblpublication p,tblstaff s
              where p.TeacherID=s.AID".$usertype."";
          }else{
            $sql_total="select p.AID from tblpublication p,tblstaff s
            where p.TeacherID=s.AID and (s.Name like '%$search%' or p.Title like '%$search%' or p.year like '%$search%' ) 
            order by p.AID desc";
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
            <th>Title</th>
            <th>Year</th>
            <th>Date</th>
            <th>Host University</th> 
            <th>Host Country</th> 
            <th>Author Name</th> 
            <th>Co-author Name</th> 
            <th>Conference Name</th>
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
  
    $teacher = $_POST["teacher"];
    $title = $_POST["title"];
    $year = $_POST["year"];
    $date = $_POST["date"];
    $hu = $_POST["hu"];
    $hc = $_POST["hc"];
    $author = $_POST["an"];
    $coauthor = $_POST["can"];
    $conname = $_POST["conname"];
    $link = $_POST["link"];
    $chklg = $_POST["chklg"];
     
    $sql="insert into tblpublication (TeacherID,Title,Year,Date,Link,HostUni,HostCountry,
    Author,CoAuthor,ConferenceName,ChkLG) values ({$teacher},'{$title}',
    {$year},'{$date}','{$link}','{$hu}','{$hc}','{$author}','{$coauthor}',
    '{$conname}',{$chklg})";

    if(mysqli_query($con,$sql)){
        save_log($_SESSION["username"]." သည် publication အားအသစ်သွင်းသွားသည်။");
        echo "success";
    }
    else{
        echo "fail";
    }
    
    
}


if($action == 'prepare'){
    $aid = $_POST['aid'];
    $sql="select p.*,s.Name as teachername from tblstaff s,tblpublication p 
    where s.AID=p.TeacherID and p.AID=$aid";
    $result=mysqli_query($con,$sql);
    $out="";
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        $out.="
        <input type='hidden' name='action' value='edit'>
        <input type='hidden' name='aid' value='{$aid}'>
                <div class='modal-body'>
                    <div class='text-center'>
                        <p id='show_error' class='text-danger'></p>
                    </div>
                    <div class='row'>                        
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Teacher Name</label>
                                <select class='form-control' name='teacher1'>
                                    <option value='{$row['TeacherID']}'>{$row['teachername']}</option>";
                                    $out.=load_teacher();
                                    $out.="</select>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Title</label>
                                <input type='text' name='title1' class='form-control' placeholder='Enter Title' value='{$row['Title']}'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Year</label>
                                <input type='number' name='year1' value='{$row['Year']}' class='form-control' placeholder='Enter Year'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Date</label>
                                <input type='date' name='date1' value='{$row['Date']}' class='form-control' placeholder='Enter Date'
                                    value= >
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Link</label>
                                <input type='text' name='link1' value='{$row['Link']}' class='form-control' placeholder='Enter Link'
                                    value= >
                            </div>
                        </div>
    
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Host University</label>
                                <input type='text' name='hu1' value='{$row['HostUni']}' class='form-control' placeholder='Enter Host University name'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Host Country</label>
                                <input type='text' name='hc1' value='{$row['HostCountry']}' class='form-control' placeholder='Enter Host Country name'>
                            </div>
                        </div>
                        
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Author Name</label>
                                <input type='text' name='an1' value='{$row['Author']}' class='form-control' placeholder='Enter Author Name'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>CoAuthor Name</label>
                                <input type='text' name='can1' value='{$row['CoAuthor']}' class='form-control' placeholder='Enter Coauthor Name'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='simpleFormEmail'>Conference Name</label>
                                <input type='text' name='conname1' value='{$row['ConferenceName']}' class='form-control' placeholder='Enter Conference Name'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='simpleFormEmail'>Local / Global </label><br>";
                            if($row['ChkLG']==0){
                                $out.="

                                <input type='radio' name='chklg1' checked value='0' > Local 
                                <input type='radio' name='chklg1' value='1' > Global 

                                ";
                            }else{

                                $out.="

                                <input type='radio' name='chklg1'  value='0' > Local 
                                <input type='radio' name='chklg1' checked value='1' > Global 

                                ";

                            }

                            $out.="
                            
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
    $teacher = $_POST["teacher1"];
    $title = $_POST["title1"];
    $year = $_POST["year1"];
    $date = $_POST["date1"];
    $hu = $_POST["hu1"];
    $hc = $_POST["hc1"];
    $author = $_POST["an1"];
    $coauthor = $_POST["can1"];
    $conname = $_POST["conname1"];
    $link = $_POST["link1"];
    $chklg = $_POST["chklg1"];
    $sql="update tblpublication set TeacherID={$teacher},
    Title='{$title}',Year={$year},Date='{$date}',
    HostUni='{$hu}',HostCountry='{$hc}',Author='{$author}',
    CoAuthor='{$coauthor}',ConferenceName='{$conname}',Link='{$link}',ChkLG={$chklg} where AID={$aid}";
   // echo $sql;
    if(mysqli_query($con,$sql)){
        save_log($_SESSION["username"]." သည် publication အားပြင်ဆင်သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }

}

if($action == 'delete'){
      $aid = $_POST["aid"];
      $sql = "delete from tblpublication where AID=$aid";     
      if(mysqli_query($con,$sql)){
          save_log($_SESSION["username"]." သည် Publication အားဖျက်သွားသည်။");
          echo 1;
      }
      else{
          echo 0;
      }
      
}


if($action=='excel'){
    echo "excel";

    $search = $_POST['ser'];
      if($search == ''){         
          $sql="select p.*,s.Name from tblpublication p,tblstaff s where s.AID=p.TeacherID".$usertype."  order by p.AID desc";
      }else{ 
        $sql="select p.*,s.Name from tblpublication p,tblstaff s where s.AID=p.TeacherID".$usertype."  and (s.Name like '%$search%' or p.title like '%$search%' or p.year like '%$search%') 
        order by p.AID desc";
      }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "PublicationReport_".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                    <td colspan="13" align="center"><h3>Publication List</h3></td>
            </tr>
            <tr><td colspan="13"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Teacher Name</th>  
                <th style="border: 1px solid ;">Title</th>
                <th style="border: 1px solid ;">Year</th>  
                <th style="border: 1px solid ;">Date</th>
                <th style="border: 1px solid ;">Host University</th>  
                <th style="border: 1px solid ;">Host Country</th>
                <th style="border: 1px solid ;">Author Name</th>  
                <th style="border: 1px solid ;">Co-Author Name</th>
                <th style="border: 1px solid ;">Conference Name</th>  
            </tr>';


        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>
                    <td style="border: 1px solid ;">'.$row["Title"].'</td>
                    <td style="border: 1px solid ;">'.$row["Year"].'</td>
                    <td style="border: 1px solid ;">'.$row["Date"].'</td>
                    <td style="border: 1px solid ;">'.$row["HostUni"].'</td>
                    <td style="border: 1px solid ;">'.$row["HostCountry"].'</td>
                    <td style="border: 1px solid ;">'.$row["Author"].'</td>
                    <td style="border: 1px solid ;">'.$row["CoAuthor"].'</td>
                    <td style="border: 1px solid ;">'.$row["ConferenceName"].'</td>
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
                <td colspan="13" align="center"><h3>Publication Lists</h3></td>
            </tr>
            <tr><td colspan="13"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Teacher Name</th>  
                <th style="border: 1px solid ;">Title</th>
                <th style="border: 1px solid ;">Year</th>  
                <th style="border: 1px solid ;">Date</th>
                <th style="border: 1px solid ;">Host University</th>  
                <th style="border: 1px solid ;">Host Country</th>
                <th style="border: 1px solid ;">Author Name</th>  
                <th style="border: 1px solid ;">Co-Author Name</th>
                <th style="border: 1px solid ;">Conference Name</th> 
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="10" class="text-center">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}




?>