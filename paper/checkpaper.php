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
                    <div class="page-title">Check Paper</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Check Paper</li>
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
                                <form method="POST" action="checkpaper_action.php">
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
            url: "<?php echo roothtml.'paper/checkpaper_action.php' ?>",
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

    $(document).on("click", '#btnpaypoint', function() {

        
        var aid = $(this).data('aid');
        var studentname = $(this).data('sname');
        var name = $(this).data('name');
        var stuid = $(this).data('sid');
        window.location.href="<?php echo roothtml.'paper/paypoint.php?aid=' ?>"+aid+"&sname="+studentname+"&name="+name+"&sid="+stuid;
        
    });
   


});
</script>