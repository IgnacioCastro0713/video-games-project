<?php
namespace Utilities;

use Connection\Connection as Conn;

class Utilities
{

    public static function messageToast($message, $type, $location)
    {
        echo "<script type='text/javascript'>
        appVue.Toast.fire({
          type: '{$type}',
          title: '{$message}'
        }).then(() => {
          setTimeout(\"location . href = '../$location'\", 0)
        });</script>";
    }

    public static function redirect($location)
    {
        header('Location:../'.$location);
    }

    public static function message($message, $type)
    {
        echo "<div class=\"{$type} alert-with-icon\">
                <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <i class=\"tim-icons icon-simple-remove\"></i>
                </button>
            <span data-notify=\"icon\" class=\"tim-icons icon-alert-circle-exc\"></span>
            <span>
              <b> Error! - </b> {$message}</span>
          </div>";
    }

    /**
     * @param $table
     * @param $id
     * @return bool
     */
    public static function getById($table, $id)
    {
        $response =  Conn::get()->query("SELECT * FROM {$table} WHERE id = {$id}");
        if ($response->rowCount())
            return $response->fetchAll(\PDO::FETCH_OBJ)[0];
        else
            return false;
    }

    public static function select($table, $identifier, $default)
    {
        $sql = "SELECT * FROM {$table}";
        $res = Conn::get()->query($sql);
        $rows = $res->fetchAll();
        echo "<select id=\"{$identifier}\" name='{$identifier}' class=\"form-control\" required>";
        echo "<option style='color: #0a0c0d' value=\"\">Seleccione una opción</option>";
        foreach ($rows as $row){
            echo "<option  style='color: #0a0c0d' value='{$row['id']}'";
            if ($row['id'] === $default)
                echo "selected";
            echo ">{$row['nombre']} - {$row['sede']}</option>";
        }
        echo "</select>";
    }

    public static function checkbox($checked)
    {
        $sql = "SELECT * FROM plataforma";
        $res = Conn::get()->query($sql);
        $rows = $res->fetchAll();
        foreach ($rows as $row){
            echo "
            <label class=\"form-check-label\" id='plataforma-parent'>
                <input type='checkbox' class='form-check-input' id='plataforma' name='plataforma' value='{$row['id']}' required ";
                if ($checked) {
                    $sqlcheck = "SELECT e.plataforma_id FROM entorno e INNER JOIN plataforma p on e.plataforma_id = p.id where e.juego_id = {$checked}";
                    $response = Conn::get()->query($sqlcheck);
                    $checks = $response->fetchAll();
                    foreach ($checks as $check){
                        if ($row['id'] == $check['plataforma_id'])
                            echo "checked";
                    }
                }
                echo ">{$row['nombre']} &nbsp;";
                echo "<span class=\"form-check-sign\">
                            <span class=\"check\"></span>
                      </span>
            </label>";
        }
    }
}
