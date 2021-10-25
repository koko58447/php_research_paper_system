<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<?php 

$teacherid=$_SESSION['userid'];
$teachername="";
$nrc="";
$dob="";
$deptid="";
$deptname="";
$rankid="";
$rankname="";
$salary="";
$startdate="";
$religion="";
$gender="";
$phno="";
$rmk="";
$address="";
$path="";
$aid="";

$nrc="";
$sql="select s.*,d.Name as dname,d.AID as daid,r.Name as rname,r.AID as raid from tblstaff s,tbldepartment d,tblrank r
 where s.DepartmentID=d.AID and s.RankID=r.AID and s.AID={$teacherid}";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_array($result);
    $aid=$row["AID"];
    $teachername=$row["Name"];
    $nrc=$row["NRC"];
    $dob=$row["DOB"];
    $deptid=$row["daid"];
    $deptname=$row["dname"];
    $rankid=$row["raid"];
    $rankname=$row["rname"];
    $salary=$row["Salary"];
    $startdate=$row["StartDate"];
    $religion=$row["Religion"];
    $gender=$row["Gender"];
    $phno=$row["PhoneNo"];
    $rmk=$row["Rmk"];
    $address=$row["Address"];
    $path=$row["Img"];

}


?>

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Profile Teacher</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>                  
                    <li class="active">Edit Profile Teacher</li>
                </ol>
            </div>
        </div>
        <!-- start Payment Details -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>
                            <h4>အချက်အလက်ပြင်ဆင်ရန်</h4>

                        </header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <form id="frmsave" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_teacher">
                <input type="hidden" name="aid" value="<?php echo $aid ?>">
                    <div class="card-body p-t-20">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Teacher Name</label>
                                    <input type="text" value="<?php echo $teachername ?>" name="staffname" class="form-control"
                                        placeholder="Enter Staff Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">NRC</label>
                                    <input type="text" value="<?php echo $nrc ?>" name="nrc" class="form-control" placeholder="Enter NRC No">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth"
                                    value="<?php echo $dob ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="dept">
                                        <option value="<?php echo $deptid ?>"><?php echo $deptname ?></option>
                                        <?php echo load_department(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rank</label>
                                    <select class="form-control" name="rank">
                                        <option value="<?php echo $rankid ?>"><?php echo $rankname ?></option>
                                        <?php echo load_rank(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Salary</label>
                                    <input type="text" value="<?php echo $salary ?>" name="salary" class="form-control" placeholder="Enter Salary">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Start Date</label>
                                    <input type="date" name="startdt" class="form-control"
                                        placeholder="Enter start date" value="<?php echo $startdate ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Religion</label>
                                    <select class="form-control" name="religion">
                                        <option value="<?php echo $religion ?>"><?php echo $religion ?></option>
                                        <option value="ဗုဒ္ဓဘာသာ">ဗုဒ္ဓဘာသာ</option>
                                        <option value="ခရစ်ယာဉ်ဘာသာ">ခရစ်ယာဉ်ဘာသာ</option>
                                        <option value="ဟိန္ဒူဘာသာ">ဟိန္ဒူဘာသာ</option>
                                        <option value="အခြား">အခြား</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Phone No</label>
                                    <input type="text" value="<?php echo $phno ?>" name="phno" class="form-control" placeholder="Enter Phone No">
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Remark</label>
                                    <input type="text" value="<?php echo $rmk ?>" name="rmk" class="form-control" placeholder="Enter Remark">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Address</label>
                                    <input type="text" value="<?php echo $address ?>" name="address" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Profile Image</label>
                                    <div class='border border-gray p-1 form-control'>
                                        <input type='file' accept=".jpg,.jpeg,.png" id='file1' name='file1'>
                                    </div>
                                    <span>File must be : .jpg, .jpeg, .png</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Show Image</label>
                                    <div class='border border-gray p-1'>
                                        <img src="<?php echo roothtml.'upload/staff/teacher/'.$path ?>" width="50%;" />
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">                        
                        <button type="submit" id="btnedit" class="btn btn-primary"><i
                                class="fa fa-edit"></i>ပြန်လည်ပြင်ဆင်မည်</button>
                    </div>
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

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);       
        var staffname = $("[name='staffname']").val();
        var nrc = $("[name='nrc']").val();
        var dept = $("[name='dept']").val();
        var rank = $("[name='rank']").val();
        var salary = $("[name='salary']").val();
        if (staffname == '' || nrc == '' || dept == '' || salary == '' || rank=='') {
            $("#show_error").text('Please fill all data!');
            return false;
        }       
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/teacher_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $("#show_error").text('');
                    swal("Successful!", "Edit data is successfully.", "success");
                   location.href="<?php echo roothtml.'teacher/edit_teacher.php' ?>";
                }
                if (data == "fail") {
                    swal("Error!", "Edit data is failed.", "error");
                }
                if (data == "wrongtype") {
                    swal("Information!", "Your file must be .jpg, .jpeg, .png!", "info");
                }
            }
        });
    });


});
</script>