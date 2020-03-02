<!-- Layout -->
 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 
<?php
 
/* Valores recebidos do formulário  */
$arquivo = $_FILES['arquivo'];
$nome = $_POST['form13'];
$replyto = $_POST['replyto']; // Email que será respondido
$mensagem_form = $_POST['form25'];
$assunto = $_POST['Financeiro'];
$msg1 = "Email: " . $_POST["form15"] . "<br>";
$msg2 = "Empresa " . $_POST["form14"] . "<p>";

/* Destinatário e remetente - EDITAR SOMENTE ESTE BLOCO DO CÓDIGO */
$to = "suporte@dottimizza.com.br";
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
<br><strong>Empresa:</strong> $msg2
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
if(mail($to, $assunto, $mensagem, $headers,$msg1,$msg2))
{
 echo "<br><br><center><b><font color='green'>Mensagem enviada com sucesso!";
} 
 else
 {
 echo "<br><br><center><b><font color='red'>Ocorreu um erro ao enviar a mensagem!";
}
?>