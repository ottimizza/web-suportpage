//isset checa se o botão enviar foi clicado e só vai disparar o email se for verdadeiro
	if(isset($_POST['Enviar'])){
    $assunto = "Resolvi meu problema na página";

    // pegando os dados do formulário suporte
    $msg = "Nome: " . $_POST["form13"] . "<br>";
    $msg .= "Email: " . $_POST["form15"] . "<br>";
    $msg .= "Empresa: " . $_POST["form14"] . "<p>";
    $msg .= "Mensagem:<br>" . $_POST["form16"];

    // email 
    $destinatario = "suporte@ottimizza.com.br";

    // headers que prepara a mensagem
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $_POST["form22"] . "<" . $_POST["form23"] . ">\r\n";
    $headers .= "Reply-To: " . $_POST["form23"] . "\r\n";

    // envia o email...
    mail($destinatario,$assunto,$msg,$headers);

    // volta para  formulario.html
    header("Location: formulario.html");
}