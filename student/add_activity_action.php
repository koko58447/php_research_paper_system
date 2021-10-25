<?php
include('../config.php');

$action = $_POST["action"];

if($action == 'show_activity'){  

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
    $studentaid = $_SESSION['studentaid'];
    if($search == ''){         
        $sql="select a.*,s.Name as sname from tblstudent s,tblstudent_activity a 
        where a.StudentID=s.AID and a.StudentID=$studentaid order by a.AID desc limit $offset,$limit_per_page";
    }else{ 
        $sql="select a.*,s.Name as sname from tblstudent s,tblstudent_activity a 
        where a.StudentID=s.AID and a.StudentID=$studentaid and (s.Name like '%$search%' or a.Name like '%$search%')  
        order by a.AID desc limit $offset,$limit_per_page";  
    }
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table display product-overview mb-30 table-striped table-hover" id="support_table5">
            <thead>
                <tr>
                    <th width="7%;">No</th>                     
                    <th>Student Name</th>
                    <th>Activity Name</th>
                    <th>Remark</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
        ';
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out.="<tr>
                <td>{$no}</td>                 
                <td>{$row["sname"]}</td>
                <td>{$row["Name"]}</td>    
                <td>{$row["Rmk"]}</td> 
                <td class='text-center'>
                    <a href='#' class='btn btn-tbl-edit btn-xs' 
                        data-original-title='Profile' 
                        id='btnedit'
                        data-aid='{$row['AID']}'
                        data-name='{$row['Name']}'
                        data-rmk='{$row['Rmk']}'>
                        <i class='fa fa-pencil'></i>
                    </a>
                    <a href='#' class='btn btn-tbl-delete btn-xs' 
                        id='btndelete'
                        data-aid='{$row['AID']}'>
                        <i class='fa fa-trash-o'></i>
                    </a>
                  </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table><br><br>";

        $sql_total="";
        if($search == ''){         
            $sql_total="select a.AID from tblstudent s,tblstudent_activity a 
            where a.StudentID=s.AID and a.StudentID=$studentaid order by a.AID desc";
        }else{ 
            $sql_total="select a.AID from tblstudent s,tblstudent_activity a 
            where a.StudentID=s.AID and a.StudentID=$studentaid and (s.Name like '%$search%' or a.Name like '%$search%')  
            order by a.AID desc";  
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
                <th>Student Name</th>
                <th>Activity Name</th>
                <th>Remark</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center" colspan="5">No record found.</td>
        </tr>
        </tbody>
    </table>';

    echo $out;
    }
}

if($action == 'save_activity'){
    $name = $_POST['name'];
    $rmk = $_POST['rmk'];
    $studentaid = $_SESSION['studentaid'];
    $sql = "insert into tblstudent_activity (StudentID,Name,Rmk) values ($studentaid,'{$name}','{$rmk}')";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}



if($action=='edit'){
    $aid = $_POST['aid'];
    $name = $_POST['name'];
    $rmk = $_POST['rmk'];
    $sql="update tblstudent_activity set Name='{$name}',Rmk='{$rmk}' where AID=$aid";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($action=='delete'){
    $aid=$_POST['aid'];
    $sql="delete from tblstudent_activity where AID=$aid";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

if($action=='excel'){
    $search = $_POST['ser'];
    $sql="";
    $studentaid = $_SESSION['studentaid'];
    if($search == ''){         
        $sql="select a.*,s.Name as sname from tblstudent s,tblstudent_activity a 
        where a.StudentID=s.AID and a.StudentID=$studentaid order by a.AID desc";
    }else{ 
        $sql="select a.*,s.Name as sname from tblstudent s,tblstudent_activity a 
        where a.StudentID=s.AID and a.StudentID=$studentaid and (s.Name like '%$search%' or a.Name like '%$search%')  
        order by a.AID desc";  
    }
    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "StudentActivityReport".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '
        <head><meta charset="utf-8"></head>
        <table >  
            <tr>
                    <td colspan="4" align="center"><h3> Student Activity Lists</h3></td>
            </tr>
            <tr><td colspan="4"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Student Name</th> 
                <th style="border: 1px solid ;">Activity Name</th> 
                <th style="border: 1px solid ;">Remark</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["sname"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td> 
                    <td style="border: 1px solid ;">'.$row["Rmk"].'</td> 
                </tr>';
        }
        $out .= '</table>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$fileName);

        echo $out;
    }else{
        $out .= '<head><meta charset="utf-8"></head>
        <table >  
        <tr>
        <td colspan="4" align="center"><h3> Student Activity Lists</h3></td>
        </tr>
        <tr><td colspan="4"><td></tr>
        <tr>  
            <th style="border: 1px solid ;">No</th>  
            <th style="border: 1px solid ;">Student Name</th> 
            <th style="border: 1px solid ;">Activity Name</th> 
            <th style="border: 1px solid ;">Remark</th>
        </tr>
            <tr>
                <td colspan="4" style="border: 1px solid ;">No record found.</td>
            </tr>
        </table>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$fileName);

        echo $out;
    }
}




?>