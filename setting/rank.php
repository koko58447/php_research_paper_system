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
                    <div class="page-title">Rank</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Rank</li>
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
                                <form method="POST" action="rank_action.php">
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
                                                placeholder="Search by category name">
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
                <h4 class="modal-title" id="myLargeModalLabel">Save New Rank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmsave">
                <div class="modal-body">
                    <div class="text-center">
                        <p id="show_error" class="text-danger">
                        <p>
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Rank Name</label>
                        <input type="text" name="rank" class="form-control" placeholder="Enter category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-close"></i>Close</button>
                    <button type="button" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
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
                <h4 class="modal-title" id="myLargeModalLabel">Edit Rank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmedit">
                <div class="modal-body">
                    <input type="hidden" name="aid">
                    <div class="text-center">
                        <p id="show_error1" class="text-danger">
                        <p>
                    </div>
                    <div class="form-group">
                        <label for="simpleFormEmail">Rank Name</label>
                        <input type="text" name="rank1" class="form-control" placeholder="Enter category name">
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

    function load_data(page) {
        var entry = $("[name='hid']").val();
        var search = $("[name='ser']").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/rank_action.php'?>",
            data: {
                action: 'show',
                entry: entry,
                search: search,
                page_no: page
            },
            success: function(data) {
                $("#show_table").html(data);
            }
        });
    }

    load_data();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_data(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entry = $(this).val();
        $("[name='hid']").val(entry);
        load_data();
    });

    $(document).on("keyup", "#searching", function() {
        var search = $(this).val();
        $("[name='ser']").val(search);
        load_data();
    });

    $(document).on("click", "#btnnew", function() {
        $("#frmsave")[0].reset();
        $("#newmodal").modal("show");
    });

    $(document).on("click", "#btnsave", function() {
        var rank = $("[name='rank']").val();
        if (rank == '') {
            $("#show_error").text("Please fill data.");
            return false;
        }
        $("#newmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/rank_action.php'?>",
            data: {
                action: 'save',
                rank: rank
            },
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Save data successfully.", "success");
                    $("#show_error").text("");
                    load_data();
                } else {
                    swal("Fail", "Save data fail.", "error");
                }
            }
        });
    });


    $(document).on("click", "#btnedit", function() {
        var aid = $(this).data("aid");
        var rank = $(this).data("rank");
        $("[name='aid']").val(aid);
        $("[name='rank1']").val(rank);
        $("#editmodal").modal("show");
    });

    $(document).on("click", "#btneditsave", function() {
        var aid = $("[name='aid']").val();
        var rank = $("[name='rank1']").val();      
        if (rank == '') {
            $("#show_error1").text("Please fill data.");
            return false;
        }
        $("#editmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setting/rank_action.php'?>",
            data: {
                action: 'edit',
                aid: aid,
                rank: rank
            },
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Edit data successfully.", "success");
                    $("#show_error1").text("");
                    load_data();
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
                    url: "<?php echo roothtml.'setting/rank_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal("Successful", "Delete data success.", "success");
                            load_data();
                        } else {
                            swal("Error", "Delete data failed.", "error");
                        }
                    }
                });
            });
    });


});
</script>