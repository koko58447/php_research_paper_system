<?php
include('../config.php');

if($_POST["action"] == 'show'){  

    $limit_per_page=""; 
    if($_POST['entry']==""){
        $limit_per_page=10; 
    } else{
        $limit_per_page=$_POST['entry']; 
    }
    
    $page="";
    $no=0;
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

    $chkdate="";

    if($dtfrom!='' || $dtto!=''){

        $chkdate=" and Date(l.Date)>='{$dtfrom}' and Date(l.Date)<='{$dtto}' ";

    }
    if($search == ''){        
        $sql="select l.*,u.UserName from tbllog l,tbluser u 
        where l.UserID=u.AID".$chkdate."
        order by l.AID desc limit {$offset},{$limit_per_page}";
    }else{
        $sql="select l.*,u.UserName from tbllog l,tbluser u 
        where l.UserID=u.AID".$chkdate." and (l.Description like '%$search%' or u.UserName like '%$search%') 
        order by l.AID desc limit {$offset},{$limit_per_page}";
    }

       
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table id="example" class="table table-bordered table-striped responsive nowrap">
        <thead>
        <tr>
            <th width="7%;">စဉ်</th>
            <th>Description</th>
            <th>UserName</th>
            <th>Date</th>            
        </tr>
        </thead>
        <tbody>
        ';
        
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $out.="<tr>
                <td>{$no}</td>
                <td>{$row["Description"]}</td>
                <td>{$row["UserName"]}</td>
                <td>{$row["Date"]}</td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        $sql_total="";
        if($search == ''){        
            $sql_total="select l.*,u.UserName from tbllog l,tbluser u 
            where l.UserID=u.AID".$chkdate."
            order by l.AID desc ";
        }else{
            $sql_total="select l.*,u.UserName from tbllog l,tbluser u 
            where l.UserID=u.AID".$chkdate." and (l.Description like '%$search%' or u.UserName like '%$search%') 
            order by l.AID desc";
        }
        $record = mysqli_query($con,$sql_total) or die("fail query");
        $total_record = mysqli_num_rows($record);
        $total_links = ceil($total_record/$limit_per_page);

        $out.='<div class="float-left"><p>Total Records -  ';
        $out.=$total_record;
        $out.='</p></div>';

        $out.='<div class="float-right">
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
                if($next_id > $total_links){
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
        echo"<h3>No Record Found</h3>";
    }

}


if($_POST["action"] == 'excel')
{
    $search = $_POST['ser'];
    $dtto = $_POST['dtto'];
    $dtfrom = $_POST['dtfrom'];

    $chkdate="";

    if($dtfrom!='' || $dtto!=''){

        $chkdate=" and Date(l.Date)='{$dtfrom}' and Date(l.Date)<='{$dtto}' ";

    }

    if($search == ''){        
        $sql="select l.*,u.UserName from tbllog l,tbluser u where l.UserID=u.AID".$chkdate;
    }else{
        $sql="select l.*,u.UserName from tbllog l,tbluser u where l.UserID=u.AID".$chkdate." and (l.Description like '%$search%' or u.UserName like '%$search%')";
    }

    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "LogReport-".date('d-m-Y').".xls";
    if(mysqli_num_rows($result) > 0)
    {
        $out .= '
        <head><meta charset="utf-8"></head>
        <table >  
            <tr>
                    <td colspan="4" align="center"><h3>Log History</h3></td>
            </tr>
            <tr><td colspan="4"><td></tr>
            <tr><td colspan="4"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Description</th>  
                <th style="border: 1px solid ;">UserName</th>  
                <th style="border: 1px solid ;">Date</th>
       
            </tr>';
        $no=0;
        while($row = mysqli_fetch_array($result))
        {
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Description"].'</td>  
                    <td style="border: 1px solid ;">'.$row["UserName"].'</td>  
                    <td style="border: 1px solid ;">'.$row["Date"].'</td>  
                
                </tr>';
        }
        $out .= '</table>';
        
        
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$fileName);

        echo $out;
            
    }else{
        echo "No Record Found.";
    }
    
}



?>