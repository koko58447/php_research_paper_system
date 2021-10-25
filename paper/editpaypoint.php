<?php 

include('../config.php');

if(isset($_SESSION['userid'])) {


include(root.'master/header.php');

$title=$_GET['name'];
$sname=$_GET['sname'];
$aid=$_GET['aid'];
$sid=$_GET['sid'];
$teacherid=$_SESSION['teacherid'];
$previous = "javascript:history.go(-1)";

?>
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Pay Point</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'home/home.php' ?>">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><i class="fa fa-file-o"></i>&nbsp;<a class="parent-item"
                            href="<?php echo roothtml.'paper/pointshow.php' ?>">Show Point</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><i class="fa fa-file-o"></i>&nbsp;<a class="parent-item"
                            href="<?php echo $previous ?>">Detail Point</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Pay Point</li>
                </ol>
            </div>
        </div>
        <!-- start Payment Details -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head text-center">
                        <header>
                            <h3>Title : <span class="text-success">"<?php echo $title ?>"</span></h3><br>
                            <h4>Student Name : <span class="text-primary"><?php echo $sname ?></span></h4>
                            
                        </header>
                       
                    </div>
                    <form id="frmsave">
                    <input type="hidden" name="pid" value="<?php echo $aid ?>" />
                    <input type="hidden" name="sid" value="<?php echo $sid ?>" />
                    <div class="card-body p-t-20">
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">1</span> Topic</label>
                                <select class="form-control" required name="topic">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="topiccom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">2</span> Abstract</label>
                                <select class="form-control" required name="abstract">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="abstractcom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">3</span> Introduction</label>
                                <select class="form-control" required name="intro">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="introcom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">4</span> Literature Review</label>
                                <select class="form-control" required name="review">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="reviewcom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">5</span> Research Methodology</label>
                                <select class="form-control" required name="research">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="researchcom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">6</span> Findings and Discussion</label>
                                <select class="form-control" required name="finding">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="findingcom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">7</span> Conclusion</label>
                                <select class="form-control" required name="conclusion">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="conclusioncom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col col-4">
                                <label><span class="badge badge-primary">8</span> References</label>
                                <select class="form-control" required name="reference">
                                    <option value="">Select Point</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>                      
                                </select>
                            </div>
                            <div class="col col-8">
                                <label>Comments</label>
                                <textarea rows="3" name="referencecom" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr class="text-danger"> 
                        <div class="text-center m-2 p-2"> 
                            <a href="<?php echo roothtml.'paper/checkpaper.php' ?>" class="btn btn-primary">< Back</a>      
                            <input type="submit" value="Submit" id="btnpoint" class="btn btn-success" /> 
                            <input type="button" id="btnshowresult" class="btn btn-default" value="Show Point" /> 
                            &nbsp;&nbsp;&nbsp;
                            <label class="text-success" id="showresult"></label>
                           
                        </div>                    
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

    $(document).on("click", "#btnpoint", function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'paper/paypoint_action.php' ?>",
            data: $("#frmsave").serialize() + "&action=save",
            success: function(data) {             
                if (data == 1) {                   
                    swal("Successful", "save data success.", "success"); 
                    location.href="<?php echo roothtml.'paper/pointshow.php' ?>";                   
                }else if(data==0) {
                    swal("Error", "Error save.", "error");
                }else if(data=="duplicate data"){
                    swal("Error", "Duplicate Data.", "error");
                }
            }
        });       

    });

    $(document).on("click", "#btnshowresult", function(e) {
        var topic=Number($("[name='topic'").val());
        var abstract=Number($("[name='abstract'").val());
        var introduction=Number($("[name='intro'").val());
        var review=Number($("[name='review'").val());
        var research=Number($("[name='research'").val());
        var finding=Number($("[name='finding'").val());
        var conclusion=Number($("[name='conclusion'").val());
        var reference=Number($("[name='reference'").val());
        var total=topic+abstract+introduction+review+research+finding+conclusion+reference;       
        $("#showresult").html("Show Point : " +total+" Points");

    });

    
});
</script>