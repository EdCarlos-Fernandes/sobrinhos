<?php
require_once '../_config/conx.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM tb_usuario WHERE reset_token = '$token'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($query);

    if (!$user) {
        echo "Token inválido ou expirado.";
        exit();
    }

    if (isset($_POST['submit'])) {
        $newPassword = $_POST['new_password'];

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE tb_usuario SET password_user = '$hashedPassword', reset_token = NULL WHERE id = {$user['id']}";
        $updateQuery = mysqli_query($conn, $updateSql);

        if ($updateQuery) {
            echo "Senha redefinida com sucesso!";
        } else {
            echo "Erro ao redefinir a senha.";
        }
    }
} else {
    echo "Token não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>
    <form action="" method="post">
        <label for="new_password">Nova Senha</label>
        <input type="password" name="new_password" required>
        <button type="submit" name="submit">Redefinir Senha</button>
    </form>
</body>
</html>
