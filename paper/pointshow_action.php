<?php
include('../config.php');

$action = $_POST["action"];


function check_situation($point){
    $situation="";
    if(($point>=1 && $point<=4) || ($point>=5 && $point<=8)){
        $situation="‘Directing’ Working under high directive and low supportive situation";

    }elseif(($point>=9 && $point<=12) || ($point>=13 && $point<=16)){
        $situation="‘Coaching’ Working under high directive and high supportive situation";       
    }elseif(($point>=17 && $point<=20) || ($point>=21 && $point<=24)){
        $situation="‘Supporting’ Working under low directive and high supportive situation";
             
    }elseif(($point>=25 && $point<=28) || ($point>=29 && $point<=32)){
        $situation="‘Delegating’ Working under low directive and low supportive situation";
             
    }

    return $situation;


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
          $sql="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
          ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
          tblresult r,tblstudent s,tblpaper p 
          where r.StudentID=s.AID and r.PaperID=p.AID 
          group by r.StudentID,r.PaperID,s.Name,p.Name  
          order by r.AID desc limit $offset,$limit_per_page";
      }else{ 
        $sql="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
        ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
        tblresult r,tblstudent s,tblpaper p 
        where r.StudentID=s.AID and r.PaperID=p.AID and (s.Name like '%$search%' or 
         p.Name like '%$search%') 
         group by r.StudentID,r.PaperID,s.Name,p.Name  
        order by r.AID desc limit $offset,$limit_per_page";
          
      }
      
      $result=mysqli_query($con,$sql) or die("SQL a Query");
      $out="";
      if(mysqli_num_rows($result) > 0){
          $out.='
            <table class="table display product-overview mb-30 table-striped table-hover" id="support_table5">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th>Student Name</th>
                        <th>Title Paper</th>
                        <th>Checker</th>
                        <th>Point</th>
                        <th>Situation</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
          ';
          $no=0;
          while($row = mysqli_fetch_array($result)){
              $no = $no + 1;
             
              $total=round($row["stotal"]);
              $strsituation=check_situation($total);
              $out.="<tr>
                  <td>{$no}</td>
                  <td>{$row["sname"]}</td>
                  <td>{$row["pname"]}</td>
                  <td>{$row["count"]}</td>
                  <td class='text-danger'><b>".$total."</b></td>
                  <td>{$strsituation}</td>
                  <td class='text-center'>                    
                            ";                               
                        $out.=" 
                        <a href='#' id='btndetail' class='dropdown-item'
                                data-aid='{$row['PaperID']}'
                                data-pname='{$row['pname']}'
                                data-sname='{$row['sname']}'
                                data-sid='{$row['StudentID']}'
                                ><i
                                class='fa fa-eye text-success'
                                style='font-size:15px;'></i>
                                </a> 
                            
                </td>
              </tr>";
          }
          $out.="</tbody>";
          $out.="</table><br><br>";
  
          $sql_total="";
          if($search == ''){         
            $sql_total="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
            ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
            tblresult r,tblstudent s,tblpaper p 
            where r.StudentID=s.AID and r.PaperID=p.AID 
            group by r.StudentID,r.PaperID,s.Name,p.Name  
            order by r.AID desc";
        }else{ 
          $sql_total="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
          ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
          tblresult r,tblstudent s,tblpaper p 
          where r.StudentID=s.AID and r.PaperID=p.AID and (s.Name like '%$search%' or 
           p.Name like '%$search%') 
           group by r.StudentID,r.PaperID,s.Name,p.Name  
          order by r.AID desc";
            
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
                    <th width="7%">No</th>
                    <th>Student Name</th>
                    <th>Title Paper</th>
                    <th>Checker</th>
                    <th>Point</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center" colspan="6">No record found.</td>
            </tr>
            </tbody>
        </table>';
        echo $out;
      }
  
}


if($action == 'delete'){

      $aid = $_POST["aid"];
      $sql = "delete from tblresult where AID=$aid"; 
      if(mysqli_query($con,$sql)){
          save_log($_SESSION["username"]." သည် PayPoint အားဖျက်သွားသည်။");
          echo 1;
      }
      else{
          echo 0;
      }
      
}


if($action=='excel'){

    $search = $_POST['ser'];
    if($search == ''){         
        $sql="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
        ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
        tblresult r,tblstudent s,tblpaper p 
        where r.StudentID=s.AID and r.PaperID=p.AID 
        group by r.StudentID,r.PaperID,s.Name,p.Name  
        order by r.AID desc";
    }else{ 
      $sql="select Count(r.PaperID) as count,Sum(r.Total)/Count(r.PaperID) as stotal
      ,r.StudentID,r.PaperID,s.Name as sname,p.Name as pname from 
      tblresult r,tblstudent s,tblpaper p 
      where r.StudentID=s.AID and r.PaperID=p.AID and (s.Name like '%$search%' or 
       p.Name like '%$search%') 
       group by r.StudentID,r.PaperID,s.Name,p.Name  
      order by r.AID desc";
        
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "PointShowReport".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                    <td colspan="6" align="center"><h3>Point Show List</h3></td>
            </tr>
            <tr><td colspan="6"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Student Name</th>  
                <th style="border: 1px solid ;">Title Paper</th> 
                <th style="border: 1px solid ;">Checker</th> 
                <th style="border: 1px solid ;">Point</th> 
                <th style="border: 1px solid ;">Situation</th>    
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $total=(int)$row["stotal"];
            $strsituation=check_situation($total);
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["sname"].'</td> 
                    <td style="border: 1px solid ;">'.$row["pname"].'</td> 
                    <td style="border: 1px solid ;">'.$row["count"].'</td> 
                    <td style="border: 1px solid ;">'.$total.'</td> 
                    <td style="border: 1px solid ;">'.$strsituation.'</td> 
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
                <td colspan="6" align="center"><h3>Point Show Lists</h3></td>
            </tr>
            <tr><td colspan="6"><td></tr>
            <tr>  
            <th style="border: 1px solid ;">No</th>  
            <th style="border: 1px solid ;">Student Name</th>  
            <th style="border: 1px solid ;">Title Paper</th> 
            <th style="border: 1px solid ;">Checker</th> 
            <th style="border: 1px solid ;">Point</th> 
            <th style="border: 1px solid ;">Situation</th>    
            </tr>
            <tr>
                <td style="border: 1px solid ;" colspan="6">No record found.</td>
            </tr>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$fileName);
            echo $out;
    }   
}




?>