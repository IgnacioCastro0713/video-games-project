<?php require_once '../layouts/head.php'; ?>
<script type="text/javascript">
    let controller = "UserController.php";
</script>
<body class="landing-page">
    <div class="wrapper">
        <div class="page-header">
            <img src="../../assets/img/blob.png" class="path">
            <img src="../../assets/img/path2.png" class="path2">
            <img src="../../assets/img/triunghiuri.png" class="shapes triangle">
            <img src="../../assets/img/waves.png" class="shapes wave">
            <img src="../../assets/img/patrat.png" class="shapes squares">
            <img src="../../assets/img/cercuri.png" class="shapes circle">
            <div class="content-center">
                <div class="row justify-content-between align-items-center text-left">
                    <div class="col-lg-12 col-md-6" style="background-color: #1e1e26">
                        <?php require_once '../layouts/search.php' ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">id</th>
                                <th>Usuario</th>
                                <th>Nombre completo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="response">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(table(controller));
</script>