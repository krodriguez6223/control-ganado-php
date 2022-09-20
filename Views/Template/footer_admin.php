
  <script>
        const base_url = "<?= base_url(); ?>";
    </script>

 <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/popper.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/main.js"></script>
    <script src="<?= media(); ?>/js/plugins/all.min.js"></script>
    
     <!-- page specific javascript-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>

    <!-- Data table plugin-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
   
    <script type="text/javascript" src="<?= media();?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/dataTables.responsive.min.js"></script>

    <!-- script de exportacion de archivos DataTable (copy- pdf-scv)-->
    <script type="text/javascript" src="<?= media();?>/js/plugins/dataTables.buttons.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/jszip.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/buttons.html5.min.js"></script>

     <!-- Data plugin para graficos de hichchatrs-->
    <script type="text/javascript" src="<?= media();?>/js/plugins/highcharts.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/exporting.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/export-data.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/accessibility.js"></script>
    <!-- Data plugin para iconos-->
    <script type="text/javascript" src="<?= media();?>/js/plugins/lord-icon-2.1.0.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/functions_admin.js"></script>
    
    <!-- daterangepicker plugin para filtrar datos-->
    <script type="text/javascript" src="<?= media();?>/js/plugins/adminlte.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/daterangepicker.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_function_js']; ?>"></script>
    
   
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
        </div>
</body>
</html>