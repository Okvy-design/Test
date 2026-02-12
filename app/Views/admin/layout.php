<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('admin/header'); ?>
</head>
<body id="page-top">

    <div id="wrapper">
        <?= $this->include('admin/sidebar'); ?>
        <div id="content-wrapper" class="d-flex flex-column bg-white">
    <div id="content"> 
        <?= $this->include('admin/topbar'); ?>
        <div class="container-fluid"> 
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
    </div>
            <?= $this->include('admin/footer'); ?>
        </div>
    </div>
    
</body>
</html>