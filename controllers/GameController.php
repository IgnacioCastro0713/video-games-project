<?php

namespace GameController;

include '../config/Configuration.php';
use Configuration\Configuration;
use InterfaceModel\InterfaceController as Controller;
use Utilities\Utilities;
use Game\Game;
Configuration::controller('Game');

class GameController implements Controller
{

    public static function instance(): Game
    {
        return new Game($_POST['nombre'], $_POST['genero'], $_POST['descripcion'], $_POST['lanzamiento'], $_POST['estudio']);
    }

    public static function save()
    {
        $game = self::instance();
        $continue = true;
        $platforms = explode(',', $_POST['plataformas']);
        if ($game->save()) {
            foreach ($platforms as $platform) {
                if (!$game->setEnvironment($platform)) {
                    $continue = false;
                    Utilities::message('No se ha podido relacionar el autor: ' . $platform, 'alert alert-danger');
                }
            }
            if ($continue)
                Utilities::messageToast('Guardado correctamente','success', 'game/');
        } else
            Utilities::message('No se ha podido guardar el juego', 'alert alert-danger');
    }

    public static function update()
    {
        $game = self::instance();
        $continue = true;
        $platforms = explode(',', $_POST['plataformas']);
        if ($game->update($_POST['id'])){
            if (Game::unSetEnvironment($_POST['id'])){
                $game->setId($_POST['id']);
                foreach ($platforms as $platform) {
                    if ($platform === "")
                        continue;
                    if (!$game->setEnvironment($platform)) {
                        $continue = false;
                        Utilities::message('No se ha podido relacionar la plataforma: ' . $platform, 'alert alert-danger');
                    }
                }
                if ($continue)
                    Utilities::messageToast('Guardado correctamente','success', 'game/');
            } else
                Utilities::message('No se ha podido eliminar las relaciones de la plataforma', 'alert alert-danger');
        } else
            Utilities::message('No se ha podido guardar la canción o no se han realizado cambios.', 'alert alert-danger');
    }

    public static function destroy()
    {
        if (Game::unSetFavorite($_POST['id'])){
            if (Game::unSetEnvironment($_POST['id'])) {
                echo Game::delete($_POST['id']);
            } else
                echo "false2";
        } else
            echo "false1";
    }

    public static function table()
    {
        $res = Game::search($_POST['search']);
        $count = $res->rowCount();
        echo $count;
        require_once "../views/game/row.php";
    }
}
$function = (string)$_POST['func'];
GameController::$function();