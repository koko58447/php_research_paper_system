<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Department</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Department</li>
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
                                <form method="POST" action="department_action.php">
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
                                                placeholder="Search by Name">
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
                <h4 class="modal-title" id="myLargeModalLabel">Save New Department</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p id="show_error" class="text-danger"></p>
                </div>
                <div class="form-group">
                    <label for="simpleFormEmail">Department Name</label>
                    <input type="text" name="deptname" class="form-control" placeholder="Enter department name">
                </div>
            </div>
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
                <h4 class="modal-title" id="myLargeModalLabel">Edit Department</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="frmedit">
                <input type="hidden" name="aid">
                <div class="text-center">
                    <p id="show_error1" class="text-danger"></p>
                </div>
                <div class="form-group">
                    <label for="simpleFormEmail">Department Name</label>
                    <input type="text" name="deptname1" class="form-control" placeholder="Enter department name">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fa fa-close"></i>Close</button>
                <button type="submit" id="btneditsave" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button>
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
            url: "<?php echo roothtml.'setting/department_action.php' ?>",
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
        $("#newmodal").modal("show");
    });

    $(document).on("click", "#btnsave", function(e) {
        e.preventDefault();
        var deptname = $("[name='deptname']").val();
        if (deptname == '') {
            $("#show_error").text("Please fill data.");
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/department_action.php' ?>",
            data: {
                action: 'save',
                deptname: deptname
            },
            success: function(data) {
                if (data == 1) {
                    $("#show_error").text("");
                    $("[name='deptname']").val("");
                    swal("Successful", "save data success.", "success");
                    load_pag();
                } else {
                    swal("Error", "Error Save.", "error");
                }

            }
        });

    });

    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        var deptname = $(this).data("deptname");
        $("[name='aid'").val(aid);
        $("[name='deptname1'").val(deptname);
        $("#editmodal").modal("show");
    });

    $(document).on("click", "#btneditsave", function() {
        var aid = $("[name='aid']").val();
        var deptname = $("[name='deptname1']").val();
        if (deptname == '') {
            $("#show_error1").text("Please fill data.");
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/department_action.php' ?>",
            data: {
                action: 'edit',
                aid: aid,
                deptname: deptname,
            },
            success: function(data) {
                if (data == 1) {
                    $("#show_error1").text("");
                    swal("Successful", "edit data success.", "success");
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
                    url: "<?php echo roothtml.'setting/department_action.php'; ?>",
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