<?php
if (isset($_POST[ 'enviar' ]) && $_POST[ 'enviar' ] == 'enviar')
{

	require_once("addons.fn.php");
	require_once("class.phpmailer.php");
	require_once("class.smtp.php");
	
	__POST("data","nome","email","telefone","assunto","mensagem");
	$body = '
<table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#bdddec" style="color:#333;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;">
  <tbody>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="0" align="center" width="600">
          <tbody>
            <tr>
              <td style="text-align:center;padding:27px 0 20px 0;">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#ffffff" style="border-left:1px solid #97b1bd;border-right:1px solid #97b1bd;background-color:#ffffff;padding:40px 50px 45px 50px;"><table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
                  <tbody>
                    <tr>
                      <td style="padding-bottom:15px;"><h1 style="font-size:26px;font-weight:normal;text-align:center;color:#404040;line-height:34px;"> <strong>Olá!</strong>, Você recebeu email de contato enviado por '.$nome.'</h1></td>
                    </tr>
                  </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
                  <tbody>
                    <tr>
                      <td style="padding-top:20px;"></td>
                    </tr>
                    <tr>
                      <td style="border:1px solid #d7d7d7;padding:20px;font-size:14px;background:#f2f2f2;padding:30px;"><table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
                          <tbody>
                            <tr>
                              <td style="padding-bottom:20px;"><h3 style="font-size:18px;text-align:center;color:#404040;font-weight:normal;"><strong>'.$nome.' </strong>postou a seguinte mensagem</h3></td>
                            </tr>
                            <tr>
                              <td style="text-align:center;"><strong style="color: #222;"> '.$assunto.'</strong><br /></td>
                            </tr>
                            <tr>
                              <td style="padding-top:10px;text-indent: 35px;padding-top:10px;text-align:justify;"><span style="color: #666;">'.$mensagem.'</span></td>
                            </tr>
							<tr>
                              <td style="padding-top:10px; font-size:10px" align="center">Para entrar em contato com '.$nome.' ultilize '.$email.'  '.$telefone.' </td>
                            </tr>
							<tr>
                              <td style="padding-top:20px; font-size:10px; color: #396" align="left" >Mensagem foi enviada em '.$data.'</td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table border="0" cellspacing="0" cellpadding="0" width="600" style="color:#808080;font-size:13px;line-height:18px;">
                  <tbody>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td><ul style="padding:10px 40px 30px 40px;list-style:none;">
                          <li style="padding:0 0 15px 0;border-bottom:1px solid #acc6d1;color:#56727e;">
                            
                          </li>
                          <li style="padding:15px 0 0 0;border-top:1px solid #deeef6;">
                            <div style="font-size:11px;text-align:center;color:#56727e;">© '.date("Y").' Observatorio Do Tabaco</div>
                          </li>
                        </ul></td>
                    </tr>
                    <tr>
                      <td style="padding:15px 0 0 0;border-top:1px solid #B3D4E4;"><div style="font-size:11px;text-align:center;color:#56727e;">Este &eacute; um email via contato do Site observatoriodotabaco.com.br Se notar qualquer engano ou erro por favor entre em contato com o desenvolvedor do site.
                          FeehGb@live.com</div></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>';

	
	
	
	
	
	if (empty($nome) || empty($email) || empty($mensagem))
	{
		echo '<div class="success-error">Oops! Tentativa de envio falhou! entre em contato com administrador da página </div>';
		$erro = true;
	}
	else
	{
		$AddAddress = array(
					"Felipe Basilio" => "feehgb@live.com",
					"Deser" => "deser@deser.org.br",
					"Cleimary Zotti" => "cleimary@deser.org.br"
				);
		$mail = new PHPMailer();
		
		$mail->IsSMTP();
		$mail->SetLanguage('br');
		$mail->Host = "mail.observatoriodotabaco.com.br";
		$mail->Port = 26;
		$mail->SMTPAuth = true;
		$mail->Username = "no-reply@observatoriodotabaco.com.br";
		$mail->Password = "ot(f17b91)";
		$mail->FromName = utf8_decode($nome);
		$mail->From     = "no-reply@observatoriodotabaco.com.br";
		$mail->AddReplyTo($email, $nome);
		
		foreach($AddAddress as $nameSend => $emailSend)
		{
			$mail->AddAddress($emailSend, $nameSend);
		}
		
		//$mail->AddAddress("webmaster@moalbuggy.com.br", "Felipe Basilio");
		
		$mail->Subject = utf8_decode('Você recebeu um novo email de ' . $nome .', pelo site observatoriodotabaco.com.br');
		
		$mail->WordWrap = 100;
		$mail->IsHTML(true);
		$mail->Body .= utf8_decode($body);
		
		if(!$mail->Send()) {
   			echo 'Message could not be sent.<br />';
  		 	echo 'Mailer Error: ' . $mail->ErrorInfo;
  		 	exit;
		}else{
			echo 'Sua mensagem foi enviada com sucesso.<br /> Aguarde.! Em breve entraremos em contato';
		}
	}
}

?>
