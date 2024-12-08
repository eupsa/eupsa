<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['name'];
$email = $_POST['email'];
$mensagem = $_POST['message'];

if (empty($nome) || empty($email) || empty($mensagem)) {
    echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos.']);
    exit;
}

function enviarEmail($nome, $email, $mensagem)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pedrooosxz@gmail.com'; 
        $mail->Password = 'iejz uozp aarb shuo'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('pedrooosxz@gmail.com', 'Contato de ' . $nome);
        $mail->addAddress('pedruuu291@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Mensagem de Contato';

        $body = "
        <!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Nova Mensagem de Contato</title>
        </head>
        <body>
            <h3>Nova Mensagem de Contato</h3>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>E-mail:</strong> $email</p>
            <p><strong>Mensagem:</strong> $mensagem</p>
        </body>
        </html>";

        $mail->Body = $body;
        $mail->send();
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Mensagem enviada com sucesso! Assim que possível entraremos em contato!'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao enviar: ' . $mail->ErrorInfo
        ]);
    }
}

enviarEmail($nome, $email, $mensagem);
