<?php

include_once("'sessionController.php");

$user_id = $_SESSION['user_id'];

class Option
{
    public function insert($conn, $level, $description, $url, $user_id)
    {
        $sql_query = "
                INSERT INTO opcoes_menu (
                    descricao_opcao,
                    nivel_opcao,
                    url_opcao,
                    status_opcao,
                    idUsuario,
                    data_cadastro
                ) values(
                     $description,
                     $level,
                     $url,
                     'S',
                     $user_id,
                     NOW()
                )      
            ";
    }

    public function update($conn, $level, $description, $url, $idOption, $user_id)
    {

        $sql_query = "
            UPDATE opcoes_menu SET 
            descricao_opcao = '$description',
            nivel_opcao = '$level',
            url_opcao = '$url',
            id_usuario = '$user_id'
            where id_opcao='$idOption'
        ";
        $data = mysqli_query($conn, $sql_query)
        if ($data) {
            return "Cadastro Realizado";
        }
    }

    public function delete($conn, $idOption)
    {
        $sql_query = "
            DELETE  FROM opcoes_menu WHERE id_opcao = '$idOption'
        ";

        
    }

    public function get_info($conn, $idOption)
    {
        $sql_query = "SELECT * FROM opcoes_menu";
    }

    public function change_status($conn, $idOption,  $status)
    {
        $sql_query = "UPDATE opcoes_menu SET status_opcao = '$status'";
    }
}