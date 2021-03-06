<?php

use Utilities\Utilities;
require_once '../home/auth.php';
require '../../config/Connection.php';
require '../../config/core/Utilities.php';
if ($_GET['id'] !== "")
    $row = Utilities::getById('usuario', $_GET['id']);
if (!$row) Utilities::redirect('user');
require_once '../layouts/head.php';
require_once '../layouts/navbar.php';
?>
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
            <div class="row row-grid justify-content-center align-items-center text-left">
                <div id="response"></div>
                <div class="col-lg-12 col-md-12 border-primary" style="border-radius: 10px; background-color: #1e1e26">
                    <br>
                    <h1 class="category-absolute text-info">Editar usuario.</h1>
                    <form method="post" id="form" action="">
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label for="nombre">Nombre</label>
                                <div class="form-group">
                                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre"
                                           value="<?php echo $row->nombre; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apaterno">Apellido Paterno</label>
                                <div class="form-group">
                                    <input id="apaterno" name="apaterno" type="text" class="form-control" placeholder="Apellido paterno"
                                           value="<?php echo $row->apaterno; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="amaterno">Apellido Materno</label>
                                <div class="form-group">
                                    <input id="amaterno" name="amaterno" type="text" class="form-control" placeholder="Apellido materno"
                                           value="<?php echo $row->amaterno; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="usuario">Usuario</label>
                                <div class="form-group">
                                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="usuario"
                                           value="<?php echo $row->usuario; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="pass">Nueva contraseña</label>
                                <div class="form-group">
                                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Cueva contraseña" required>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="pass">Confirmar nueva contraseña</label>
                                <div class="form-group">
                                    <input id="pass_conf" name="pass_conf" type="password" class="form-control" placeholder="Confirmar contraseña" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="admin">Administrador</label>
                                <input type="checkbox" name="checkbox" value="1" id="admin" class="bootstrap-switch"
                                       <?php if ($row->admin) echo "checked";?>
                                       data-on-label="Sí"
                                       data-off-label="No"
                                />
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" onclick="" value="Editar">
                            <br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
    $("#form").validate({
        errorElement: 'small',
        errorClass: 'text-danger',
        rules: {
            usuario: {
                minlength: 5
            },
            pass: {
                minlength: 5
            },
            pass_conf:{
                minlength: 5,
                equalTo: "#pass"
            }
        },
        messages: {
            usuario: {
                required: "El usuario no puede quedar vacío.",
                minlength: "El usuario debe contener al menos 5 carácteres."
            },
            pass: {
                required: "La contraseña no puede quedar vacía.",
                minlength: "La contraseña debe contener al menos 5 carácteres."
            },
            pass_conf:{
                required: "Debe confimar contraseña.",
                equalTo: "Las contraseñas no coiciden."
            },
            nombre: "El nombre no puede quedar vacío.",
            apaterno: "El apellido paterno no puede quedar vacío.",
            amaterno: "El apellido materno no puede quedar vacío."
        },
        highlight: function(element){
            $(element)
                .closest('.form-group')
                .addClass('has-danger');
        },
        unhighlight: function(element){
            $(element)
                .closest('.form-group')
                .removeClass('has-danger')
                .addClass('has-success');
        },
        submitHandler: function () {
            appVue.sendData({
                'id': <?php echo $_GET['id']; ?>,
                "nombre" : $('#nombre').val(),
                "apaterno" : $('#apaterno').val(),
                "amaterno" : $('#amaterno').val(),
                "usuario" : $('#usuario').val(),
                "pass" : $('#pass').val(),
                "admin": $('#admin').is(":checked") ? 1 : 0,
                "pass_conf": $('#pass_conf').val(),
                "func" : 'update'
            }, 'UserController');
        },
        invalidHandler: function () {
            appVue.toast('error', 'Ingrese la información correctamente.');
        }
    });
</script>
