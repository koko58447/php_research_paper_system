<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<title>K Young Unity | Change Password</title>
<style>
.pass_show {
    position: relative
}

.pass_show .ptxt {

    position: absolute;

    top: 50%;

    right: 10px;

    z-index: 1;

    color: #f36c01;

    margin-top: -10px;

    cursor: pointer;

    transition: .3s ease all;

}

.pass_show .ptxt:hover {
    color: #333333;
}
</style>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Change Password</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Change Password</li>
                </ol>
            </div>
        </div>
        <!-- start Payment Details -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-body p-t-20">
                        <form id="frm">
                            <?php
                                $userid=$_SESSION['userid'];
                                $sql="select * from tbluser where AID=$userid";
                                $result=mysqli_query($con,$sql) or die("SQL Query");
                                $output="";
                                if(mysqli_num_rows($result) > 0){
                                    $no=1;
                                    while($row = mysqli_fetch_array($result)){
                            ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Current Password</label>
                                        <div class="form-group pass_show">
                                            <input type="password" value="<?php echo $row['Password'] ?>"
                                                class="form-control" name="password" placeholder="Current Password">
                                        </div>
                                        <label>New Password</label>
                                        <div class="form-group pass_show">
                                            <input type="password" class="form-control" name="newpassword"
                                                placeholder="New Password">
                                        </div>
                                        <label>Confirm Password</label>
                                        <div class="form-group pass_show">
                                            <input type="password" class="form-control" name="confirmpassword"
                                                placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" id="btnchangepassword" class="btn btn-info">Change
                                            Password</button>

                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                        </form>
                    </div>
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
    $('.pass_show').append('<span class="ptxt">Show</span>');

    $(document).on('click', '.pass_show .ptxt', function() {

        $(this).text($(this).text() == "Show" ? "Hide" : "Show");

        $(this).prev().attr('type', function(index, attr) {
            return attr == 'password' ? 'text' : 'password';
        });

    });


    $(document).on("click", "#btnchangepassword", function(e) {
        var newpassword = $("[name='newpassword']").val();
        var confirmpassword = $("[name='confirmpassword']").val();
        if (newpassword != confirmpassword) {
            swal("Error!", "New Password and Confirm Passwod not match.", "error");
            return false;
        }
        if (newpassword == '' || confirmpassword == '') {
            swal("Error!", "Please Fill Data.", "error");
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/usercontrol_action.php' ?>",
            data: $("#frm").serialize() + "&action=changepassword",
            success: function(data) {
                if (data == 1) {
                    swal("Successful!", "Change Password Successful.",
                        "success");
                    location.href =
                        "<?php echo roothtml.'setting/changepassword.php' ?>";

                }
            }
        });
    });

});
</script>