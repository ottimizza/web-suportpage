//isset checa se o botão enviar foi clicado e só vai disparar o email se for verdadeiro
	if(isset($_POST['Enviar'])){
    $assunto = "Integrar Empresa";

    // pegando os dados do formulário suporte
    $msg = "Responsável pelo Fechamento: " . $_POST["form22"] . "<br>";
    $msg .= "Email: " . $_POST["form23"] . "<br>";
	$msg .= "Gestor: " . $_POST["form24"] . "<p>";
	$msg .= "Empresa a ser integrada " . $_POST["form25"] . "<p>";
	$msg .= "Código da empresa na contabilidade: " . $_POST["form27"] . "<p>";
	$msg .= "CNPJ " . $_POST["form26"] . "<p>";
    $msg .= "Horas de digitação" . $_POST["form28"] . "<p>";
    $msg .= "Mensagem:<br>" . $_POST["form29"];

    // email 
    $destinatario = "preentrega@ottimizza.com.br";

    // headers que prepara a mensagem
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $_POST["form22"] . "<" . $_POST["form23"] . ">\r\n";
    $headers .= "Reply-To: " . $_POST["form23"] . "\r\n";

    // envia o email...
    mail($destinatario,$assunto,$msg,$headers);

    // volta para E-mail Preentrega.html
    header("Location: Preentrega.html");
}