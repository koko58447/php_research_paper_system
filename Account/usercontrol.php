<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<title>K Young Unity | User Control</title>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">UserControl</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Usercontrol</li>
                </ol>
            </div>
        </div>
        <!-- start Payment Details -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>
                            <div class="btn-group">
                                <form method="POST" action="usercontrol_action.php">
                                    <input type="hidden" name="hid">
                                    <input type="hidden" name="ser">
                                    <button type="button" id="btnnew" class="btn btn-info"><i
                                            class="fa fa-plus"></i>&nbsp;New</button>
                                    <button type="submit" name="action" value="excel" class="btn btn-primary"><i
                                            class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                                </form>
                            </div>
                        </header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body p-t-20">

                        <input type="hidden" name="hid">
                        <input type="hidden" name="ser">
                        <table width="100%">
                            <tr>
                                <td width="15%">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Show</label>
                                        <div class="col-sm-6">
                                            <select id="entry" class="custom-select btn-sm">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td width="50%" class="float-right">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Search</label>
                                        <div class="col-sm-9">
                                            <input type="search" class="form-control" id="searching"
                                                placeholder="Search by username or usertype">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="table-wrap">
                            <div id="show_table" class="table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Payment Details -->
    </div>
</div>
<!-- end page content -->

<div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Save User Control</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmsave">
            <div class="modal-body">
                <p id="show_error" class="text-danger">
                <p>
                <div class="form-group">
                    <label for="simpleFormEmail">User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter User Name">
                </div>

                <div class="form-group">
                    <label for="simpleFormEmail">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                </div>

                <div class="form-group">
                    <label for="simpleFormEmail">Confirm Password</label>
                    <input type="password" name="compassword" class="form-control" placeholder="Enter Confirm Password">
                </div>
                <div class="form-group">
                    <label>Staff Name</label>
                    <select class="form-control" name="staff">
                        <option value="">Select Teacher Name</option>
                       <?php echo load_staff(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>User Type</label>
                    <select class="form-control" name="usertype">
                        <option value="">Select UserType</option>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>                      
                    </select>
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fa fa-close"></i>Close</button>
                <button type="submit" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit User Control</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmedit">
           
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fa fa-close"></i>Close</button>
                <button type="submit" id="btneditsave" class="btn btn-primary"><i class="fa fa-save"></i>Edit</button>
            </div>
        </div>
    </div>
</div>


<?php  include(root.'master/footer.php');
    include(root.'master/ajaxloader.php');

}else{

  include(root.'error/error.php');
  
}
  
?>

<script>
$(document).ready(function() {

    function load_pag(page) {
        var entryvalue = $("[name='hid'").val();
        var search = $("[name='ser'").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'Account/usercontrol_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                entryvalue: entryvalue,
                search: search
            },
            success: function(data) {
                $("#show_table").html(data);
            }
        });
    }
    load_pag();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pag(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entryvalue = $(this).val();
        $("[name='hid'").val(entryvalue);
        load_pag();
    });


    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser'").val(serdata);
        load_pag();
    });

    $(document).on("click", "#btnnew", function() {
        $("#frmsave")[0].reset();
        $("#newmodal").modal("show");
    });

    $(document).on("click", "#btnsave", function(e) {
        e.preventDefault();
        var username = $("[name='username']").val();
        var password = $("[name='password']").val();
        var compassword = $("[name='compassword']").val();
        var usertype = $("[name='usertype']").val();
        var staff = $("[name='staff']").val();

        if (password != compassword) {
            $("#show_error").text("Password and Confirm password is not match.");
            return false;
        }

        if (username == '' || usertype == '' || password == "" || staff=="") {
            $("#show_error").text("Please Fill Data.");
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'Account/usercontrol_action.php' ?>",
            data: {
                action: 'save',
                username: username,
                password: password,
                usertype: usertype,
                staff:staff
            },
            success: function(data) {
                if (data == 1) {
                    swal("Successful", "save data success.", "success");
                    $("#show_error").text("");
                    load_pag();
                } else {
                    swal("Error", "Error Save.", "error");
                }

            }
        });

    });

    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        var username = $(this).data("username");
        var password = $(this).data("password");
        var usertype = $(this).data("usertype");
        var staff = $(this).data("staff");
        var staffname = $(this).data("staffname");

        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'Account/usercontrol_action.php' ?>",
            data: {
                action: 'editprepare',
                aid:aid,
                username:username,
                password:password,
                usertype:usertype,
                staff:staff,
                staffname:staffname
            },
            success: function(data) {
                $("#frmedit").html(data);
                $("#editmodal").modal("show");
            }
        });


        
    });

    $(document).on("click", "#btneditsave", function() {
        var aid = $("[name='aid']").val();
        var username = $("[name='username1']").val();
        var password = $("[name='password1']").val();
        var compassword = $("[name='compassword1']").val();
        var usertype = $("[name='usertype1']").val();
        var staff = $("[name='staff1']").val();
        if (password != compassword) {
            swal("Error", "Password and Confirm password is not match.", "error");
            return false;
        }

        if (username == '' || usertype == '' || staff=='') {
            $("#show_error1").text("Please Fill Data.");
            return false;
        }

        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'Account/usercontrol_action.php' ?>",
            data: {
                action: 'edit',
                aid: aid,
                username: username,
                password: password,
                usertype: usertype,
                staff:staff
            },
            success: function(data) {              
                if (data == 1) {
                    swal("Successful", "edit data success.", "success");
                    $("#show_error1").text("");
                    load_pag();
                } else {
                    swal("Error", "Error Edit.", "error");
                }
            }
        });
    });

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
                    url: "<?php echo roothtml.'Account/usercontrol_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid
                    },
                    beforeSend: function() {
                        $(".loader").show();
                    },
                    success: function(data) {
                        $(".loader").hide();
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