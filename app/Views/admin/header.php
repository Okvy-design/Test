<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Gayatri Art - <?= isset($title) ? $title : 'Dashboard' ?></title>

<link rel="icon" type="image/png" href="<?= base_url('admin/img/GA.png') ?>">
<link rel="shortcut icon" href="<?= base_url('admin/img/GA.png') ?>">

<link href="<?= base_url('admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('admin/css/sb-admin-2.min.css') ?>" rel="stylesheet">

<style>
    /* 1. Memaksa elemen utama content wrapper untuk full width */
    #content-wrapper {
        width: 100% !important;
        flex-grow: 1; 
    }
    
    /* 2. Memaksa area konten utama (#content) */
    #content {
        width: 100% !important;
    }

    /* 3. PENTING: Menimpa max-width pada class container-fluid */
    /* Ini adalah kunci karena sb-admin-2.min.css membatasi lebar ini */
    .container, .container-fluid {
        max-width: none !important; /* KUNCI: Menghapus batasan lebar di desktop */
        width: 100% !important;
        
        /* Menyesuaikan padding agar konten tidak menempel ke tepi */
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
        padding-top: 1.5rem !important; 
    }
</style>