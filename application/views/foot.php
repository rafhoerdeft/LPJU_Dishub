    <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer d-none d-sm-none d-md-block"> © 2019 LPJU APP for DISHUB Kab. Magelang by DISKOMINFO Kab. Magelang </footer>
        <footer class="footer d-block d-sm-block d-md-none"> © 2019 LPJU APP by DISKOMINFO</footer>


        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->


</div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <?php foreach ($foot as $val) { ?>
        
        <script src="<?= base_url().$val ?>"></script>

    <?php } ?>

    <?php
        if (isset($js_link)) {
            foreach ($js_link as $js) {
     ?>
                <script src="<?= $js ?>"></script>
    <?php }} ?>


    <?php 
    if (isset($script)) {
        foreach ($script as $scr) {
    ?>
        
        <script type="text/javascript">
            <?= $scr ?>
        </script>

    <?php }} ?>

    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
        }(window, document, jQuery);
    </script>

    <script type="text/javascript">
        function inputAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            // alert(charCode);
            if (charCode > 31 && (charCode < 46 || charCode > 57))

            return false;
            return true;
        }
    </script>

    <script type="text/javascript">
        lightbox.option({
            'albumLabel':   "picture %1 of %2",
            'fadeDuration': 300,
            'resizeDuration': 150,
            'wrapAround': true
        })
    </script>

    <script type="text/javascript">
        $('#alert-notification').delay(2000).fadeOut();;
    </script>

</body>

</html>