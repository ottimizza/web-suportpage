<!-- Layout -->
 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 
<?php
 
/* Valores recebidos do formulário  */
$arquivo = $_FILES['arquivo'];
$nome = $_POST['form22'];
$replyto = $_POST['replyto']; // Email que será respondido
$mensagem_form = $_POST['form29'];
$assunto = $_POST['Integrar Empresa'];
$msg = "Email: " . $_POST["form23"] . "<br>";
$msg1 = "Código da Empresa: " . $_POST["form27"] . "<p>";
$msg2 = "Gestor: " . $_POST["form24"] . "<p>";
$msg3 = "Empresa a ser integrada " . $_POST["form25"] . "<p>";
$msg4 = "CNPJ " . $_POST["form26"] . "<p>";
$msg5 = "Horas de digitação" . $_POST["form28"] . "<p>";
/* Destinatário e remetente - EDITAR SOMENTE ESTE BLOCO DO CÓDIGO */
$to = "preentrega@dottimizza.com.br";
$remetente = "suporte@ottimizza.com.br"; // Deve ser um email válido do domínio
 
/* Cabeçalho da mensagem  */
$boundary = "XYZ-" . date("dmYis") . "-ZYX";
$headers = "MIME-Version: 1.0\n";
$headers.= "From: $remetente\n";
$headers.= "Reply-To: $replyto\n";
$headers.= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";  
$headers.= "$boundary\n"; 
 
/* Layout da mensagem  */
$corpo_mensagem = " 
<br>Suporte via Site
<br>--------------------------------------------<br>
<br><strong>Nome:</strong> $nome
<br><strong>Email:</strong> $replyto
<br><strong>Assunto:</strong> $assunto
<br><strong>Código Empresa:</strong> $msg1
<br><strong>Gestor:</strong> $msg2
<br><strong>Empresa a ser integrada:</strong> $msg3
<br><strong>CNPJ:</strong> $msg4
<br><strong>Horas de digitação:</strong> $msg5
<br><strong>Mensagem:</strong> $mensagem_form
<br><br>--------------------------------------------
";
 
/* Função que codifica o anexo para poder ser enviado na mensagem  */
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
 
    $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb"); // Abri o arquivo enviado.
 $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); // Le o arquivo aberto na linha anterior
 $anexo = base64_encode($anexo); // Codifica os dados com MIME para o e-mail 
 fclose($fp); // Fecha o arquivo aberto anteriormente
    $anexo = chunk_split($anexo); // Divide a variável do arquivo em pequenos pedaços para poder enviar
    $mensagem = "--$boundary\n"; // Nas linhas abaixo possuem os parâmetros de formatação e codificação, juntamente com a inclusão do arquivo anexado no corpo da mensagem
    $mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
    $mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
    $mensagem.= "$corpo_mensagem\n"; 
    $mensagem.= "--$boundary\n"; 
    $mensagem.= "Content-Type: ".$arquivo["type"]."\n";  
    $mensagem.= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";  
    $mensagem.= "Content-Transfer-Encoding: base64\n\n";  
    $mensagem.= "$anexo\n";  
    $mensagem.= "--$boundary--\r\n"; 
}
 else // Caso não tenha anexo
 {
 $mensagem = "--$boundary\n"; 
 $mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
 $mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
 $mensagem.= "$corpo_mensagem\n";
}
 
/* Função que envia a mensagem  */
if(mail($to, $assunto, $mensagem, $headers,$msg,$msg1,$msg2,$msg3,$msg4,$msg5))
{
 echo "<br><br><center><b><font color='green'>Mensagem enviada com sucesso!";
} 
 else
 {
 echo "<br><br><center><b><font color='red'>Ocorreu um erro ao enviar a mensagem!";
}
?>