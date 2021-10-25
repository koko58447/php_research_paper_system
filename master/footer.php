</div>
        <!-- end page container -->

        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; K Young Unity Team By 
                <a href="https://kyoungunity.com" target="_top" class="makerCss">kyoungunity.com</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- end footer -->
    </div>
   <!-- start js include path -->
   <script src="<?php echo roothtml.'lib/assets/plugins/jquery/jquery.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/plugins/popper/popper.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/plugins/jquery-blockui/jquery.blockui.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js' ?>"></script>
    <!-- bootstrap -->
    <script src="<?php echo roothtml.'lib/assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- Common js-->
    <script src="<?php echo roothtml.'lib/assets/js/app.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/layout.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/theme-color.js' ?>"></script>
    <!-- Material -->
    <script src="<?php echo roothtml.'lib/assets/plugins/material/material.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/pages/material_select/getmdl-select.js' ?>"></script>
    <!-- dropzone -->
    <script src="<?php echo roothtml.'lib/assets/plugins/dropzone/dropzone.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/plugins/dropzone/dropzone-call.js' ?>"></script>
    <!-- date and time 	 -->
    <script src="<?php echo roothtml.'lib/assets/plugins/flatpicker/flatpickr.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/pages/datetime/datetime-data.js' ?>"></script>
    <!-- animation -->
    <script src="<?php echo roothtml.'lib/assets/js/pages/ui/animations.js' ?>"></script>
    <!-- end js include path -->
    <!-- summernote -->
	<script src="<?php echo roothtml.'lib/assets/plugins/summernote/summernote.min.js' ?>"></script>
	<script src="<?php echo roothtml.'lib/assets/js/pages/summernote/summernote-data.js' ?>"></script>
    <!--select2-->
    <script src="<?php echo roothtml.'lib/assets/plugins/select2/js/select2.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/assets/js/pages/select2/select2-init.js' ?>"></script>
    <!-- Print -->
	<script src="<?php echo roothtml.'lib/printThis.js' ?>"></script>

    <script>
$(document).ready(function() {

    $(document).ajaxStart(function(){
            $(".loader").show(); 
      });

      $(document).ajaxComplete(function(){
            $(".loader").hide(); 

      });

      $(document).ajaxError(function(){
            swal('error','Ajax Error','error');

      });
      

    $('[data-toggle="tooltip"]').tooltip();   

    $(document).on("click", "#btnlogout", function(e) {

        e.preventDefault();

        swal({
            title: "Answer ?",
            text: "Are you sure Exit!",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes,Sure!",
            closeOnConfirm: false
        },
        function() {
                $.ajax({
                  type: "post",
                  url: "<?php echo roothtml.'index_action.php' ?>",
                  data: {
                        action: 'logout'
                  },
                  success: function(data) {

                        if (data == 1) {

                              location.href ="<?php echo roothtml.'index.php' ?>";


                        }



                  }
            });
        });
    });

    $(document).on("click","#btngopos",function(){
            var vno=$(this).data('vno');
            $.ajax({
                type: "post",
                url: "<?php echo roothtml.'pos/draft_action.php' ?>",
                data: {
                    action:'gopos',
                    vno:vno
                },        
                success: function (data) {
                    location.href="<?php echo roothtml.'pos/pos.php' ?>";
                }
            });

    });



});
</script>

</body>



</html>

