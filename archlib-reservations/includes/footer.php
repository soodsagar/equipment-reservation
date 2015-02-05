
    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>





    <?php
    if (isset($_SESSION['loggedIn'])){
        if ($_SESSION['loggedIn'] == true){
            echo "<script>

        $(function(){
            $('#admin-links').css({display: 'block'});
        });


             </script>";
        }

    }


    ?>


</body>

</html>
