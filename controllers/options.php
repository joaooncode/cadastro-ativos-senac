<?php

include_once("sessionController.php");

$user_id = $_SESSION['user_id'] ?? null;

class Option
{
    public function insert($conn, $level, $description, $url, $user_id, $id_menu_superior)
    {
        $stmt = $conn->prepare("
            INSERT INTO opcoes_menu (
                descricao_opcao,
                nivel_opcao,
                url_opcao,
                status_opcao,
                idUsuario,
                id_menu_superior,
                data_cadastro
            ) VALUES (?, ?, ?, 'S', ?, ?, NOW())
        ");

        $stmt->bind_param("sssii", $description, $level, $url, $user_id, $id_menu_superior);

        if ($stmt->execute()) {
            return "Cadastro Realizado";
        } else {
            return "Erro: " . $stmt->error;
        }
    }

    public function update($conn, $level, $description, $id_nivel_superior, $url, $idOption, $user_id)
    {
        $query = "
            UPDATE opcoes_menu SET 
            descricao_opcao = '$description',
            nivel_opcao = '$level',
            url_opcao = '$url',
            idUsuario = '$user_id',
            id_menu_superior = '$id_nivel_superior'
            WHERE id_opcao = '$idOption'
        ";

        $stmt = $conn->prepare($query);


        // $stmt->bind_param("ssiiii", $description, $level, $url, $user_id, $id_nivel_superior, $idOption);

        if ($stmt->execute()) {
            return "Opção atualizada com sucesso";
        } else {
            return "Erro: " . $stmt->error;
        }
    }

    public function delete($conn, $idOption)
    {
        $stmt = $conn->prepare("DELETE FROM opcoes_menu WHERE id_opcao = ?");
        $stmt->bind_param("i", $idOption);

        if ($stmt->execute()) {
            return "Opção excluída com sucesso";
        } else {
            return "Erro: " . $stmt->error;
        }
    }

    public function get_info($conn, $idOption)
    {
        if ($idOption) {
            $stmt = $conn->prepare("SELECT * FROM opcoes_menu WHERE id_opcao = ?");
            $stmt->bind_param("i", $idOption);
        } else {
            $stmt = $conn->prepare("SELECT * FROM opcoes_menu");
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        } else {
            return "Nenhum registro encontrado";
        }
    }

    public function busca_superior($conn, $level)
    {
        $stmt = $conn->prepare("SELECT * FROM opcoes_menu WHERE nivel_opcao = ?");
        $stmt->bind_param("i", $level);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        } else {
            return "Nenhum registro encontrado";
        }
    }

    public function change_status($conn, $idOption, $status)
    {
        $stmt = $conn->prepare("UPDATE opcoes_menu SET status_opcao = ? WHERE id_opcao = ?");
        $stmt->bind_param("si", $status, $idOption);

        if ($stmt->execute()) {
            return "Status Alterado";
        } else {
            return "Erro: " . $stmt->error;
        }
    }
}