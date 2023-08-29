<?php
require_once "../_config/conx.php";
require_once "../_config/data.php";
require_once "../source/EmailSender.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM tb_usuario WHERE email_user = '$email'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $token = bin2hex(random_bytes(32));

        $updateSql = "UPDATE tb_usuario SET reset_token = '$token' WHERE id = {$user['id']}";
        mysqli_query($conn, $updateSql);

        $emailSender = new Email\EmailSender();
        $sent = $emailSender->sendPasswordResetEmail($email, $token);

        if ($sent) {
            echo "E-mail de redefinição de senha enviado com sucesso!";
        } else {
            echo "Erro ao enviar o e-mail.";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci Minha Senha</title>
</head>
<body>
    <h2>Esqueci Minha Senha</h2>
    <form action="forgot-password.php" method="post">
        <label for="email">E-mail</label>
        <input type="email" name="email" required>
        <button type="submit" name="submit">Enviar Link de Redefinição</button>
    </form>
</body>
</html>
