<?php

include_once("sessionController.php");

$user_id = $_SESSION['user_id'] ?? null;

class Option
{
    public function insert($conn, $level, $description, $url, $user_id, $idMenuSuperior)
    {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("
            INSERT INTO opcoes_menu (
                descricao_opcao,
                nivel_opcao,
                url_opcao,
                status_opcao,
                idUsuario,
                data_cadastro,
                id_menu_superior
            ) VALUES (?, ?, ?, 'S', ?, NOW())
        ");

        $stmt->bind_param("sssi", $description, $level, $url, $user_id);

        if ($stmt->execute()) {
            return "Cadastro Realizado";
        } else {
            return "Erro: " . $stmt->error;
        }
    }

    public function update($conn, $level, $description, $url, $idOption, $user_id)
    {
        $stmt = $conn->prepare("
            UPDATE opcoes_menu SET 
            descricao_opcao = ?,
            nivel_opcao = ?,
            url_opcao = ?,
            id_usuario = ?
            WHERE id_opcao = ?
        ");

        $stmt->bind_param("sssii", $description, $level, $url, $user_id, $idOption);

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
        $sql = "
    Update opcoes_menu set status_opcao ='$status' where id_opcao='$idOption'
  ";
        $result = mysqli_query($conn, $sql) or die(false);
        if ($result) {
            return "Status Alterado";
        }
    }
}