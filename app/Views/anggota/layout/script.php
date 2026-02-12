</div> <script src="<?= base_url('admin/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('admin/js/sb-admin-2.min.js') ?>"></script>

<?= $this->renderSection('scripts') ?> 

<script>
    // Contoh inisialisasi DataTables (hanya aktif jika elemen #dataTable ada)
    $(document).ready(function() {
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            }); 
        }
    });
</script>

</body>
</html>