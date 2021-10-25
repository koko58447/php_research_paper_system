<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

?>

<title>Internet Service Plan | Student</title>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Student</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Student</li>
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
                                <form method="POST" action="student_action.php">
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
                <h4 class="modal-title" id="myLargeModalLabel">Save New Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmsave" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Staff Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Father Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Enter Father Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">NRC</label>
                                <input type="text" name="nrc" class="form-control" placeholder="Enter NRC No">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Choose gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Religion</label>
                                <select class="form-control" name="religion">
                                    <option value="">Choose religion</option>
                                    <option value="ဗုဒ္ဓဘာသာ">ဗုဒ္ဓဘာသာ</option>
                                    <option value="ခရစ်ယာဉ်ဘာသာ">ခရစ်ယာဉ်ဘာသာ</option>
                                    <option value="ဟိန္ဒူဘာသာ">ဟိန္ဒူဘာသာ</option>
                                    <option value="အခြား">အခြား</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nationality</label>
                                <select class="form-control" name="nation">
                                    <option value="">Choose nationality</option>
                                    <option value="ဗမာ">ဗမာ</option>
                                    <option value="မွန်">မွန်</option>
                                    <option value="ရခိုင်">ရခိုင်</option>
                                    <option value="ရှမ်း">ရှမ်း</option>
                                    <option value="ကရင်">ကရင်</option>
                                    <option value="ကချင်">ကချင်</option>
                                    <option value="ချင်း">ချင်း</option>
                                    <option value="ကယား">ကယား</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth"
                                    value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="dept">
                                    <option value="">Select department</option>
                                    <?php echo load_department(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Phone No</label>
                                <input type="text" name="phno" class="form-control" placeholder="Enter Phone No">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="simpleFormEmail">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter email">
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
                                <label for="simpleFormEmail">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address">
                            </div>
                        </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmedit" method="POST" enctype="multipart/form-data">
                
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="changefilemodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ဓါတ်ပုံပြင်ဆင်ခြင်း</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="frmfileedit" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class='modal-body'>
                    <input type='hidden' name='faid' />
                    <input type='hidden' name='action' value='fileupdate' />
                    <input type='hidden' name='oldpath' />
                    <div class='form-group'>
                        <label for='usr'> Image :</label><br>
                        <img src='' id="image_show" style='width:100%;height:250px;' />
                    </div>
                    <div class='form-group'>
                        <label for='usr'>ဖိုင်အသစ်ထည့်ရန် :</label>
                        <div class='border border-primary p-1'>
                            <input type='file' id='file2' accept='.pdf,.docx,.xls,.xlsx,.png,.jpeg,.jpg' name='file2'>
                        </div>
                        <span>File must be : .jpg, .jpeg, .png</span>
                    </div>
                    <div class="text-center">
                        <p id="show_error2" class="text-danger"></p>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-primary'><i class="fa fa-edit"></i>&nbsp;Edit</button>
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
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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
        var name = $("[name='name']").val();
        var nrc = $("[name='nrc']").val();
        var dept = $("[name='dept']").val();
        if (name == '' || nrc == '' || dept == '') {
            $("#show_error").text('Please fill all data!');
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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
            }
        });
    });


    $(document).on("click", "#btnedit", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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
        var name = $("[name='ename']").val();
        var nrc = $("[name='enrc']").val();
        var dept = $("[name='edept']").val();
        if (name == '' || nrc == '' || dept == '') {
            $("#show_error1").text('Please fill all data!');
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
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
                    url: "<?php echo roothtml.'student/student_action.php'; ?>",
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

    $(document).on("click", "#btnchangeimg", function(e) {
        var aid = $(this).data("aid");
        var path = $(this).data("path");

        $("[name='faid']").val(aid);
        $("[name='oldpath']").val(path);
        var aa = "";
        if (path == '') {
            aa = "<?php echo roothtml.'upload/student/noimage.jpg' ?>";
        } else {
            aa = "<?php echo roothtml.'upload/student/' ?>" + path;
        }
        
        $("#image_show").attr("src", aa);
        $("#changefilemodal").modal("show");
    });

    $("#frmfileedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var ff = $("#file2").val();
        if(ff == ''){
            $("#show_error2").html("Choose your image file.");
            return false;
        }
        $("#changefilemodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == "nofile") {
                    swal("Information!", "Please select file.", "info");
                }
                if (data == "wrongtype") {
                    swal("Warning!", "Your file must be .png, .jpeg, .jpg!",
                        "warning");
                }
                if (data == "success") {
                    $("#show_error2").html("");
                    swal("Successful!", "Update file success.", "success");
                    $("#frmfileedit")[0].reset();
                    load_pag();
                }
                if (data == "fail") {
                    swal("Error!", "Update file failed.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnactivity", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var name = $(this).data("name");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/student_action.php' ?>",
            data: {
                action: 'goactivity',
                aid: aid,
                name:name
            },
            success: function(data) {
                location.href="<?php echo roothtml.'student/add_activity.php' ?>";
            }
        });
    });

    $(document).on("click", "#btnpaper", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var name = $(this).data("name");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'student/studentpaper_action.php' ?>",
            data: {
                action: 'show1',
                aid: aid
              
            },
            success: function(data) {
                location.href="<?php echo roothtml.'student/studentpaper.php' ?>";
            }
        });
    });


});
</script>