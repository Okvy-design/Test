</div> <!-- end #wrapper -->

<!-- JS SB Admin -->
<script src="<?= base_url('admin/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('admin/js/sb-admin-2.min.js') ?>"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('admin/vendor/chart.js/Chart.min.js') ?>"></script>
<?= $this->renderSection('scripts') ?>



<script src="<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(
            {
                "paging": true,
                "ordering": true,
                "info": true,
                
                // --- TAMBAHKAN INI ---
                "autoWidth": false,  
            }
        ); // Pastikan inisialisasi ini ada
    });
</script>
</body>
</html>
