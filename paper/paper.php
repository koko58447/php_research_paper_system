<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<style>
.text-line {
    background-color: transparent;
    color: balck;
    outline: none;
    outline-style: none;
    outline-offset: 0;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 10px 10px;
    width: 100%;
}
</style>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Research Paper</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Research Paper</li>
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
                                <form method="POST" action="paper_action.php">
                                    <input type="hidden" name="hid">
                                    <input type="hidden" name="ser">
                                    <input type="hidden" name="dtfrom">
                                    <input type="hidden" name="dtto">
                                    <button type="button" id="btnnew" class="btn btn-info"><i
                                            class="fa fa-plus"></i>&nbsp;New</button>
                                    <button type="submit" name="action" value="excel" class="btn btn-primary"><i
                                            class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                                </form>
                            </div>
                        </header>
                        <div class="pull-right p-t-10 p-r-20">
                            <div class="form-inline">
                                <label for="email" class="mr-sm-2">From : </label>
                                <input type="date" value="<?php echo date('Y-m-d') ?>" name="from"
                                    class="form-control mb-2 mr-sm-2" placeholder="Enter email" id="email">
                                <label for="email" class="mr-sm-2">To : </label>
                                <input type="date" value="<?php echo date('Y-m-d') ?>" name="to"
                                    class="form-control mb-2 mr-sm-2" placeholder="Enter email" id="email">
                                <button type="submit" id="btnsearch" class="btn btn-primary">Search</button>
                            </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New Research Paper</h4>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <form id="frmsave" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="simpleFormEmail">Title Paper</label>
                        <textarea name="title" cols="10" rows="5" auotfocous class="form-control"></textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="usr" style="font-size:14px;color:gray;">Student</label>
                        <div class="border border-info">
                            <select name="student" class="form-control"
                               >
                                <option value="">Select Student</option>
                                <?php echo load_student() ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class='form-group'>
                        <label for='usr'>File</label>
                        <div class='border border-primary p-1'>
                            <input type='file' id='file1' name='file1'>
                        </div>
                    </div>
                    <div class="text-center">
                        <span id="show_error" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button id="btnsave" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>&nbsp;Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="filemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">ဖိုင်ပြင်ဆင်ခြင်း</h4>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <form id="frmfile" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="changefile">
                <input type="hidden" name="aid">
                <input type="hidden" name="path">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="simpleFormEmail">Old File</label>
                        <input type="text" name="old" class="form-control" readonly>
                    </div>
                    <div class='form-group'>
                        <label for='usr'>New File</label>
                        <div class='border border-primary p-1'>
                            <input type='file' id='file2' name='file2'>
                        </div>
                    </div>
                    <div class="text-center">
                        <span id="show_error1" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button id="btnfileupdate" type="submit" class="btn btn-primary">
                        <i class="fa fa-edit"></i>&nbsp;ပြင်ဆင်မည်</button>
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
                <h4 class="modal-title" id="myLargeModalLabel">ပြင်ဆင်ခြင်း</h4>
                <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
            </div>
            <form id="frmedit" method="post" enctype="multipart/form-data">
                <input type="hidden" name="eaid">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="simpleFormEmail">Title Paper</label>
                        <textarea name="etitle" cols="10" rows="5" auotfocous class="form-control"></textarea>
                       
                    </div>
                    <div class="form-group">
                        <label for="usr" style="font-size:14px;color:gray;">Student</label>
                        <div class="border border-info">
                            <select name="estudent" class="form-control"
                               >
                              
                                <?php echo load_student() ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Date</label>
                        <input type="date" name="edate" class="form-control" >
                    </div>
                    <div class="text-center">
                        <span id="show_error3" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button id="btneditsave" type="submit" class="btn btn-primary">
                        <i class="fa fa-edit"></i>&nbsp;Edit</button>
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
        var dtto = $("[name='dtto']").val();
        var dtfrom = $("[name='dtfrom']").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'paper/paper_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                entryvalue: entryvalue,
                search: search,
                dtto: dtto,
                dtfrom: dtfrom
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

    $(document).on("click", '#btnsearch', function() {
        var dtfrom = $("[name='from']").val();
        var dtto = $("[name='to']").val();
        $("[name='dtto']").val(dtto);
        $("[name='dtfrom']").val(dtfrom);
        load_pag();
    });

    $(document).on("click", "#btnnew", function() {
        $("#frmsave")[0].reset();
        $("#newmodal").modal("show");
    });

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var title = $("[name='title']").val();
        var student = $("[name='student']").val();
        var file = $("#file1").val();       
        if (file == '' || title == '' || student == '') {
            $("#show_error").html("Please fill all data.");
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'paper/paper_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
              
                if (data == "nofile") {
                    swal("Information!", "Please select file.","info");
                }
                if (data == "success") {
                    $("#show_error").html("");
                    swal("Successful!", "Update file success.","success");
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Update file failed.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnchangefile", function(e) {
        var aid = $(this).data("aid");
        var path = $(this).data("path");
        var old = $(this).data("old");
        $("[name='aid']").val(aid);
        $("[name='old']").val(old);
        $("[name='path']").val(path);
        $("#filemodal").modal("show");
    });

    $("#frmfile").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var file = $("#file2").val();
        if (file == '') {
            $("#show_error1").html("Please choose file.");
            return false;
        }
        $("#filemodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'paper/paper_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "nofile") {
                    swal("Information!", "Please select file.","info");
                }
                if (data == "success") {
                    $("#show_error1").html("");
                    swal("Successful!", "Update file success.","success");
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Update file failed.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnedit", function(e) {
        var aid = $(this).data("aid");
        var title = $(this).data("title");
        var date = $(this).data("date");
        var sname = $(this).data("sname");
        var sid = $(this).data("sid");
        $("[name='eaid']").val(aid);
        $("[name='etitle']").val(title);
        $("[name='edate']").val(date);
        $("[name='estudent']").val(sid);     

        $("#editmodal").modal("show");
    });

    $(document).on("click", "#btneditsave", function(e) {
        var title = $("[name='etitle']").val();
        var date = $("[name='edate']").val();
        var aid = $("[name='eaid']").val();
        var student = $("[name='estudent']").val();
        if (date == '' || title == '' || student=='') {
            $("#show_error3").html("Please fill all data.");
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'paper/paper_action.php' ?>",
            data: {
                action: 'edit',
                aid: aid,
                title: title,
                date: date,
                student:student
            },
            success: function(data) {
                if (data == 1) {
                    $("#show_error3").html("");
                    swal("Success!", "Update data successfully.", "success");
                    load_pag();
                }else{
                    swal("Error!", "Update data failed.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var path = $(this).data("path");
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
                    url: "<?php echo roothtml.'paper/paper_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid,
                        path: path
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