<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

$teachername="";

if($_SESSION['usertype']=='Teacher User'){
    $teachername=$_SESSION['name'];
}else{

    $teachername=$_SESSION['teachername'];

}

?>

<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Publication for ( <?php echo $teachername ?> )</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><i class="fa fa-cogs"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'teacher/teacher.php' ?>">Teacher</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Publication</li>
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
                                <form method="POST" action="publication_action.php">
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Save New Publication</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmsave" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body">
                    <div class="text-center">
                        <p id="show_error" class="text-danger"></p>
                    </div>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Teacher Name</label>
                                <input type="text" name="teacher" readonly value="<?php echo $teachername ?>" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Year</label>
                                <input type="number" name="year" class="form-control" placeholder="Enter Year">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Enter Date"
                                    value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Link</label>                               
                                <input class='form-control' type='text' placeholder='Enter Link' name='link'>
                              
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Host University</label>
                                <input type="text" name="hu" class="form-control" placeholder="Enter Host University name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Host Country</label>
                                <input type="text" name="hc" class="form-control" placeholder="Enter Host Country name">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Author Name</label>
                                <input type="text" name="an" class="form-control" placeholder="Enter Author Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">CoAuthor Name</label>
                                <input type="text" name="can" class="form-control" placeholder="Enter Coauthor Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Conference Name</label>
                                <input type="text" name="conname" class="form-control" placeholder="Enter Conference Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Local / Global </label><br>
                                <input type="radio" name="chklg" checked value='0' > Local
                                <input type="radio" name="chklg" value='1' > Global
                            </div>
                        </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Publication</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmedit" method="POST" enctype="multipart/form-data">
                
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Publication</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmdetail" method="POST" enctype="multipart/form-data">
                
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
            url: "<?php echo roothtml.'teacher/edit_publication_action.php'?>",
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

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);       
        var teacher = $("[name='teacher']").val();
        var year = $("[name='year']").val();
        var title = $("[name='title']").val();
        var hu = $("[name='hu']").val();
        var hc = $("[name='hc']").val();
        var an = $("[name='an']").val();
        var can = $("[name='can']").val();
        var conname = $("[name='conname']").val();      
        var link = $("[name='link']").val();
        if (teacher == '' || year == '' || title == '' || hu == '' || hc == '' || an =='' || can =='' || conname =='' || link =='') {
            $("#show_error").text('Please fill all data!');
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/edit_publication_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $("#show_error").text('');
                    swal("Successful!", "Save data is successfully.", "success");
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Save data is failed.", "error");
                }
                if (data == "wrongtype") {
                    swal("Information!", "Your file must be .jpg, .jpeg, .png!", "info");
                }
                if (data == "fill_link") {
                    swal("Information!", "Please must be fill file!!", "info");
                }
            }
        });
    });


    $(document).on("click", "#btnedit", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/edit_publication_action.php' ?>",
            data: {
                action: 'prepare',
                aid: aid
            },
            success: function(data) {
                $("#frmedit").html(data);
                $("#editmodal").modal("show");
            }
        });
    });


    $("#frmedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);     
        var teacher = $("[name='teacher1']").val();
        var year = $("[name='year1']").val();
        var title = $("[name='title1']").val();
        var hu = $("[name='hu1']").val();
        var hc = $("[name='hc1']").val();
        var an = $("[name='an1']").val();
        var can = $("[name='can1']").val();
        var conname = $("[name='conname1']").val();
        if (teacher == '' || year == '' || title == '' || hu == '' || hc == '' || an =='' || can =='' || conname =='') {
            $("#show_error").text('Please fill all data!');
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/edit_publication_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#show_error1").text('');
                    swal("Successful!", "Edit data is successfully.", "success");
                    load_pag();
                }else{
                    swal("Error!", "Edit data is failed.", "error");
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
                    url: "<?php echo roothtml.'teacher/edit_publication_action.php'; ?>",
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

    $(document).on("click", "#btndetail", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'teacher/edit_publication_action.php' ?>",
            data: {
                action: 'prepare_detail',
                aid: aid
            },
            success: function(data) {
                $("#frmdetail").html(data);
                $("#detailmodal").modal("show");
            }
        });
    });


});
</script>