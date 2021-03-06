<?php

namespace FavoriteController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Favorite\Favorite;
Configuration::controller('Favorite');

class FavoriteController implements Controller
{

    public static function instance(): Favorite
    {
        session_start();
        return new Favorite($_SESSION['id'], $_POST['id']);
    }

    public static function save()
    {
        $favorite = self::instance();
        echo $favorite->save() ? "setted" : "failed";
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function destroy()
    {
        $favorite = self::instance();
        echo $favorite->delete($_POST['id']) ? "unsetted" : "failed";
    }

    public static function table()
    {
        $res = Favorite::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/favorite/row.php";
    }

    public static function details()
    {
        $detail = Favorite::getDetail($_POST['id']);
        $count = $detail->rowCount();
        require_once "../views/favorite/detail.php";
    }
}
$function = (string)$_POST['func'];
FavoriteController::$function();