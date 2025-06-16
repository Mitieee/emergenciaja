<?php
include 'db.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $novaSenha = $_POST["senha"];
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
        $update = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt2 = $conn->prepare($update);
        $stmt2->bind_param("ss", $senhaCriptografada, $email);
        $stmt2->execute();
        $mensagem = "Senha atualizada com sucesso: $email";
        $stmt2->close();
    } else {
        $mensagem = "E-mail não encontrado.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    <link rel="icon" href="imagem/emergencia.png" type="image/x-icon">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;     
            height: 100vh;          
            margin: 0;
            font-family: Arial;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
                .grupo {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .grupo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        input {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        button {
            font-size: 18px;
            font-weight: 600;
            background-color: #40DD00;
            border-radius: 8px;
            border: 0;
            padding: 15px;
            width: 100%;
            cursor: pointer;
        }
        .mensagem {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
      <img src="imagem/emergenciaja.png" alt="emergenciaja" style="width: 150px; height: 80px; ">
        <h2>Recuperar Senha</h2>
        <form method="POST">
            <div class="grupo">
                <img src="imagem/email.png" alt="E-mail">
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="grupo">
                <img src="imagem/senha.png" alt="Senha">
                <input type="password" name="senha" id="senha" placeholder="Digite a nova senha" required>
            </div>
            <button type="submit">Enviar</button>
        </form><br>  <a href="conta.php" style="display: inline-block; color: black; text-decoration: none;">Voltar para o login</a>
        <?php if (isset($mensagem)): ?>
            <div class="mensagem"><?php echo $mensagem; ?></div>
        <?php endif; ?>
    </div>
        <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>
</html>