<script>
$(document).ready(function() {

    $(document).ajaxStart(function() {
        $(".loader").show();
    });

    $(document).ajaxComplete(function() {
        $(".loader").hide();
    });

    $(document).ajaxError(function() {
        swal('error', 'Ajax Error', 'error');
    });

    

});
</script>