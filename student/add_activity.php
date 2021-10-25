<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<title>Internet Service Plan | Student Activity</title>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Student Activity For ( <?php echo $_SESSION['stuname'] ?>)</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><i class="fa fa-user"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'student/student.php' ?>">Student</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Student Activity</li>
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
                                <form method="POST" action="add_activity_action.php">
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
                                                placeholder="Searching . . . . .">
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
                <h4 class="modal-title" id="myLargeModalLabel">Save New Student Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmsave" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_activity">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="simpleFormEmail">Activity Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Staff Name">
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Remark</label>
                        <input type="text" name="rmk" class="form-control" placeholder="Enter Father Name">
                    </div>
                    <div class="text-center">
                        <p id="show_error" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button type="submit" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Student Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmedit">
                <div class="modal-body">
                    <input type="hidden" name="aid">
                    <div class="form-group">
                        <label for="simpleFormEmail">Activity Name</label>
                        <input type="text" name="name1" class="form-control" placeholder="Enter activity name">
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Remark</label>
                        <input type="text" name="rmk1" class="form-control" placeholder="Enter remark">
                    </div>
                    <div class="text-center">
                        <p id="show_error1" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button type="button" id="btneditsave" class="btn btn-primary"><i
                            class="fa fa-edit"></i>Edit</button>
                </div>
            </form>
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
            url: "<?php echo roothtml.'student/add_activity_action.php' ?>",
            data: {
                action: 'show_activity',
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

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var name = $("[name='name']").val();
        var rmk = $("[name='rmk']").val();
        if (name == '' || rmk == '') {
            $("#show_error").text('Please fill all data!');
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/add_activity_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#show_error").text('');
                    swal("Successful!", "Save data is successfully.", "success");
                    load_pag();
                }else{
                    swal("Error!", "Save data is failed.", "error");
                }
            }
        });
    });


    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        var name = $(this).data("name");
        var rmk = $(this).data("rmk");
        $("[name='aid']").val(aid);
        $("[name='name1']").val(name);
        $("[name='rmk1']").val(rmk);
        $("#editmodal").modal("show");
    });

    $(document).on("click", "#btneditsave", function() {
        var aid = $("[name='aid']").val();
        var name = $("[name='name1']").val();
        var rmk = $("[name='rmk1']").val();
        if (name == '' || rmk == '') {
            $("#show_error").text('Please fill all data!');
            return false;
        }  
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/add_activity_action.php'?>",
            data: {
                action: 'edit',
                aid: aid,
                name: name,
                rmk: rmk
            },
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Edit data successfully.", "success");
                    $("#show_error1").text("");
                    load_pag();
                } else {
                    swal("Fail", "Edit data fail.", "error");
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
                    url: "<?php echo roothtml.'student/add_activity_action.php'; ?>",
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