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
    $dtto = $_POST['dtto'];
    $dtfrom = $_POST['dtfrom'];
    $sql="";
    if($search == ''){ 
        if($dtfrom=='' || $dtto==''){
            $sql="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
            where p.StudentID=s.AID order by p.AID desc limit $offset,$limit_per_page";
        }else{
            $sql="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
            where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
            order by p.AID desc limit $offset,$limit_per_page";
        }    
    }else{ 
        if($dtfrom=='' || $dtto==''){
            $sql="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
            where p.StudentID=s.AID and (p.Name like '%$search%' or s.Name like '%$search%')
            order by p.AID desc limit $offset,$limit_per_page";
        }else{    
            $sql="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
            where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
            and (p.Name like '%$search%' or s.Name like '%$search%')
            order by p.AID desc limit $offset,$limit_per_page";        
        }   
    }
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
            <table class="table display product-overview mb-30 table-striped table-hover" id="support_table5">
                <thead>
                    <tr>
                        <th width="7%;">No</th>
                        <th>Title Paper</th>
                        <th>Student Name</th>
                        <th>Date</th>
                        <th>File</th>
                        <th width="7%;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
        ';
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $urllink=roothtml.'upload/papers/'.$row['PdfFile'];
            $url=roothtml.'paper/paypoint.php?aid='.$row['AID'].'&sname='.
            $row['sname'].'&sid='.$row['StudentID'].'&name='.$row['Name'];
           
            $out.="<tr>
                <td>{$no}</td>  
                <td>{$row["Name"]}</td>
                <td>{$row["sname"]}</td>
                <td>".enDate($row["Date"])."</td> 
                <td>{$row["ViewFile"]}</td> 
                <td class='text-center'>
                    <div class='dropdown'>
                        <a class='btn btn-link font-30 p-0 line-height-1'
                            href='#' role='button' data-toggle='dropdown'>
                            <i class='material-icons'>more_vert</i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list p-1'>  
                            ";                               
                        $out.="
                            <a href='{$urllink}' class='dropdown-item'
                                data-aid='{$row['AID']}'><i
                                class='fa fa-cloud-download text-success'
                                style='font-size:15px;'></i>
                                Download</a> 
                            <a href='{$url}' class='dropdown-item'
                                 ><i
                                class='fa fa-check text-primary'
                                style='font-size:15px;'></i>
                                Pay Point</a>                            
                        </div>
                    </div>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table><br><br>";

        $sql_total="";
        if($search == ''){ 
            if($dtfrom=='' || $dtto==''){
                $sql_total="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
                where p.StudentID=s.AID order by p.AID desc";
            }else{
                $sql_total="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
                where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
                order by p.AID desc";
            }    
        }else{ 
            if($dtfrom=='' || $dtto==''){
                $sql_total="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
                where p.StudentID=s.AID and (p.Name like '%$search%' or s.Name like '%$search%')
                order by p.AID desc";
            }else{    
                $sql_total="select p.*,s.Name as sname from tblpaper p ,tblstudent s    
                where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
                and (p.Name like '%$search%' or s.Name like '%$search%')
                order by p.AID desc";        
            }   
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
                <th>Title Paper</th>
                <th>Student Name</th>
                <th>Date</th>
                <th>File</th>
                <th width="7%;" class="text-center">Action</th>
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

if($action=='excel'){

    $search = $_POST['ser'];
    $dtto = $_POST['dtto'];
    $dtfrom = $_POST['dtfrom'];
    $sql="";
    if($search == ''){ 
        if($dtfrom=='' || $dtto==''){
            $sql="select p.*,s.Name as sname from tblpaper p,tblstudent s 
            where p.StudentID=s.AID order by p.AID desc";
        }else{
            $sql="select p.*,s.Name as sname from tblpaper p,tblstudent s 
            where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
            order by p.AID desc";
        }    
    }else{ 
        if($dtfrom=='' || $dtto==''){
            $sql="select p.*,s.Name as sname from tblpaper p,tblstudent s 
            where p.StudentID=s.AID and (p.Name like '%$search%' or s.Name like '%$search%')
            order by p.AID desc";
        }else{    
            $sql="select p.*,s.Name as sname from tblpaper p,tblstudent s 
            where p.StudentID=s.AID and p.Date>='{$dtfrom}' and p.Date<='{$dtto}' 
            and (p.Name like '%$search%' or s.Name like '%$search%')
            order by p.AID desc";        
        }   
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "PaperReport".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '<head><meta charset="utf-8" /></head>
        <table >  
            <tr>
                    <td colspan="6" align="center"><h3>Paper List</h3></td>
            </tr>
            <tr><td colspan="6"><td></tr>
            <tr>                       
                <th width="7%;" style="border: 1px solid ;">No</th>
                <th style="border: 1px solid ;">Title Paper</th>
                <th style="border: 1px solid ;">Student Name</th>
                <th style="border: 1px solid ;">Date</th>
                <th style="border: 1px solid ;">File</th> 
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {          

            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Name"].'</td>
                    <td style="border: 1px solid ;">'.$row["sname"].'</td>
                    <td style="border: 1px solid ;">'.enDate($row["Date"]).'</td>
                    <td style="border: 1px solid ;">'.$row["ViewFile"].'</td>
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
                <td colspan="6" align="center"><h3>Staff Lists</h3></td>
            </tr>
            <tr><td colspan="6"><td></tr>
            <tr>  
                <th width="7%;" style="border: 1px solid ;">No</th>
                <th style="border: 1px solid ;">Title Paper</th>
                <th style="border: 1px solid ;">Student</th>
                <th style="border: 1px solid ;">Date</th>
                <th style="border: 1px solid ;">File</th>    
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