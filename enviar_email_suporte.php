//isset checa se o botão enviar foi clicado e só vai disparar o email se for verdadeiro
	if(isset($_POST['Enviar'])){
    $assunto = "Solicitação de Suporte";

    // pegando os dados do formulário suporte
    $msg = "Contador: " . $_POST["form22"] . "<br>";
    $msg .= "Email: " . $_POST["form23"] . "<br>";
    $msg .= "Código da Empresa: " . $_POST["form24"] . "<p>";
    $msg .= "Mensagem:<br>" . $_POST["form26"];

    // email 
    $destinatario = "suporte@ottimizza.com.br";

    // headers que prepara a mensagem
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $_POST["form22"] . "<" . $_POST["form23"] . ">\r\n";
    $headers .= "Reply-To: " . $_POST["form23"] . "\r\n";

    // envia o email...
    mail($destinatario,$assunto,$msg,$headers);

    // volta para E-mail Suporte.html
    header("Location: e-mail_suporte.html");
}