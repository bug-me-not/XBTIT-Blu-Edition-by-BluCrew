<?php
$language['ACCOUNT_CREATED']='Conta Criada';
$language['USER_NAME']='Usuário';
$language['USER_PWD_AGAIN']='Repita a Senha';
$language['USER_PWD']='Senha';
$language['USER_STYLE']='Estilo';
$language['USER_LANGUE']='Idioma';
$language['IMAGE_CODE']='Código da Imagem';
$language['INSERT_USERNAME']='Você deve inserir um nome de usuário!';
$language['INSERT_PASSWORD']='Você deve inserir uma senha!';
$language['DIF_PASSWORDS']='As senhas não correspondem!';
$language['ERR_NO_EMAIL']='É preciso digitar um endereço de email válido';
$language['USER_EMAIL_AGAIN']='Repita o e-mail';
$language['ERR_NO_EMAIL_AGAIN']='Repita o e-mail';
$language['DIF_EMAIL']='Os e-mails não correspondem!';
$language['SECURITY_CODE']='Responda a pergunta';
# Password strength
$language['WEEK']='Fraca';
$language['MEDIUM']='Media';
$language['SAFE']='Segura';
$language['STRONG']='Forte';
$language['ERR_GENERIC']='Generic Error: '.sql_error();
//INVITATION SYSTEM
global $SITENAME, $BASEURL, $SITEEMAIL;
$language['INVIT_MSGINFO']='Você solicitou uma nova conta no '.$SITENAME;
$language['INVIT_MSGINFO1']='<br /><br />'.'Sua conta está aguardando a confirmação do membro que lhe convidou. Enquanto sua conta é confirmada você não tem acesso total ao site.';
$language['INVIT_MSGINFO2A']='<br /><br />'.'Informação da Conta:'.'<br />'.'Usuário:';
$language['INVIT_MSGINFO2B']='Senha:';
$language['INVIT_MSGINFO3']='<br /><br />'.'----------------'.'<br /><br />'.'Caso não queira se registrar no '.$SITENAME.', por favor devolva este email para '.$SITEEMAIL;
$language['INVIT_MSG_AUTOCONFIRM3']='<br /><br />'.'----------------'.'<br /><br />'.'Você pode visitar agora'.'<br /><br />'.$BASEURL.'/index.php&page=login'.
									'<br /><br />'.'e usar suas informações para logar.'.'<br /><br />'.
									'Boa Sorte e Divirta-se no '.$SITENAME.'!'.'<br /><br /><br />'.'----------------'.'<br /><br />'.
									'Caso não queira se registrar no '.$SITENAME.', por favor devolva este email para '.$SITEEMAIL;
$language['REG_CONFIRM']='Confirmação da Conta';
$language['INVITATION_ONLY']='Desculpe, mas os registros estão fechados.<br>Você precisa de um convite para se registrar.';
$language['WELCOME_INVITE']='Bem Vindo! Você aceitou o convite de um de nossos usuários.<br />Você pode agora se registrar.';
$language['INVITE_EMAIL_SENT1']='Um e-mail de confirmação foi enviado para o endereço de e-mail específicado';
$language['INVITE_EMAIL_SENT2']='<br />Você precisa´ra esperar até que o usuário que enviou o convite confirme sua conta.';
$language['INVITE_EMAIL_SENT3']='Um e-mail foi enviado para o endereço de e-mail específicado';
$language['INVITE_EMAIL_SENT4']='<br />Você pode agora <a href="index.php?page=login">LOGIN</a>. Boa Sorte e Divirta-se no '.$SITENAME.'!';
$language['INVALID_INVITATION']='Seu código de convite é inválido.';
$language['ERR_INVITATION']='<br />Solicite so usuário que lhe convidou um novo convite.';

?>