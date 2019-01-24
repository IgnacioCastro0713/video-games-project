<?php
include '../config/InterfaceController.php'; // TODO: Required, doesn't change.
include '../config/Alert.php'; // TODO: Required, doesn't change.
include '../model/User.php'; // TODO: Change according to the model.

use InterfaceModel\InterfaceController as Controller; //TODO: Required doesn't change.
use Alert\Alert; // TODO: Required, doesn't change.
use User\User; // TODO: Change according to the model.

class UserController implements Controller
{
    public static function newObj()
    {
        return new User($_POST['usuario'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass']);
    }

    public static function save()
    {
        $user = self::newObj();
        if (!$user->find()) {
            if ($user->save()) {
                Alert::toast("Guardado correctamente", "success", "user/index.php");
            } else
                Alert::message('No se ha podido guardar el usuario.', 'alert alert-danger');
        } else
            Alert::message('¡Nombre de usuario ya ha sido utilizado!', 'alert alert-danger');
    }

    public static function update()
    {
        //
    }

    public static function destroy()
    {
        //
    }

    public static function table()
    {
        $res = User::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/user/row.php";
    }
}
$function = (String)$_POST['function'];
UserController::$function();