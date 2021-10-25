<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

$aid=$_GET['aid'];
$title=$_GET['name'];
$sname=$_GET['sname'];
$aid=$_GET['aid'];
$sid=$_GET['sid'];
?>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Detail Point</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><i class="fa fa-file-o"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'paper/pointshow.php' ?>">Show Point</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Detail Point</li>
                </ol>
            </div>
        </div>
        <!-- start Payment Details -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head text-center">
                        <header>
                            <h3>Title : <span class="text-success">"<?php echo $title ?>"</span></h3><br>
                            <h4>Student Name : <span class="text-primary"><?php echo $sname ?></span></h4>
                            
                        </header>
                       
                    </div>
                    <form id="frmsave">
                    <input type="hidden" name="pid" value="<?php echo $aid ?>" />
                    <input type="hidden" name="sid" value="<?php echo $sid ?>" />
                    <div class="card-body p-t-20">
                    <?php 

                    
                        $sql="select r.*,st.Name as stname,s.Name as sname,p.Name as pname
                         from tblresult r,tblstudent s,tblpaper p,tblstaff st where 
                        r.StudentID=s.AID and r.PaperID=p.AID and r.TeacherID=st.AID and r.PaperID=$aid";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result) > 0){
                            $no=0;
                            while($row = mysqli_fetch_array($result)){
                                $url=roothtml.'paper/editpaypoint.php?aid='.$row['PaperID'].'&sname='.
                                $row['sname'].'&sid='.$row['StudentID'].'&name='.$row['pname'];

                    ?>
                        <div class="row">
                            <table class="table border">
                                <tr class="bg-success">
                                    <th colspan='2'>Checker : <?php echo $row['stname'] ?></th>
                                    <th class="text-right">
                                        <!-- <a href='<?php echo $url ?>' class='btn btn-tbl-edit btn-xs' 
                                            data-original-title='Edit'  
                                            >
                                            <i class='fa fa-pencil'></i>
                                        </a> -->
                                        <a href='#' class='btn btn-tbl-delete btn-xs' 
                                            id='btndelete'
                                            data-aid='<?php echo $row['AID'] ?>'>
                                            <i class='fa fa-trash-o'></i>
                                        </a>
                                    
                                    </th>
                                </tr>
                                <tr class="bg-dark">
                                    <th>Components</th>
                                    <th>Point</th>
                                    <th>Comments</th>
                                </tr>
                                <tr>
                                    <td>Topic</td>
                                    <td><?php echo $row['Topic'] ?></td>
                                    <td><?php echo $row['TopicComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Abstract</td>
                                    <td><?php echo $row['Abstract'] ?></td>
                                    <td><?php echo $row['AbstractComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Introduction</td>
                                    <td><?php echo $row['Introduction'] ?></td>
                                    <td><?php echo $row['IntroductionComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Literature</td>
                                    <td><?php echo $row['Literature'] ?></td>
                                    <td><?php echo $row['LiteratureComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Research</td>
                                    <td><?php echo $row['Research'] ?></td>
                                    <td><?php echo $row['ResearchComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Finding</td>
                                    <td><?php echo $row['Finding'] ?></td>
                                    <td><?php echo $row['FindingComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Conclusion</td>
                                    <td><?php echo $row['Conclusion'] ?></td>
                                    <td><?php echo $row['ConclusionComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Reference</td>
                                    <td><?php echo $row['Reference'] ?></td>
                                    <td><?php echo $row['ReferenceComment'] ?></td>
                                </tr>
                                <tr>
                                    <td>Total Point</td>
                                    <td colspan='2' class="text-danger"><b><?php echo $row['Total'] ?> Points</b></td>
                                </tr>
                            </table>                        
                        </div>
                        <hr>
                    <?php }} ?>
                        
                    </form>
                </div>
            </div>
        </div>
        <!-- end Payment Details -->
    </div>
</div>
<!-- end page content -->



<?php  include(root.'master/footer.php');
    include(root.'master/ajaxloader.php');

}else{

  include(root.'error/error.php');
  
}
  
?>

<script>
$(document).ready(function() {

    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        swal({
                title: "Delete?",
                text: "Are you sure delete!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo roothtml.'paper/pointshow_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid
                    },
                    success: function(data) {                       
                        if (data == 1) {
                            swal("Successful", "Delete data success.", "success");
                            load_pag();
                        } else {
                            swal("Error", "Delete data failed.", "error");
                        }
                    }
                });
            });
    });


    
});
</script>