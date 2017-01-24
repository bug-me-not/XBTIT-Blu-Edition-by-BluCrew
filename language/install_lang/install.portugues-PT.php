<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    Este arquivo é parte do xbtit.
//
// A redistribuição e o uso nas formas originais e binárias, com ou sem modificações,
// São permitidas desde que sejam cumpridas as seguintes condições:
//
//   1. Redistribuições do código-fonte devem manter o aviso de copyright acima,
//      Esta lista de condições e a seguinte isenção.
//   2. As redistribuições na forma binária devem reproduzir o aviso de copyright acima,
//      Esta lista de condições e a seguinte isenção de documentos
//      E / ou outros materiais fornecidos com a distribuição.
//   3. O nome do autor não pode ser usado para endossar ou promover produtos
//      Derivados deste software sem permissão específica por escrito.
//
// Este software é fornecida pelo autor como é''e `` qualquer expressas ou implícitas
// GARANTIAS, incluindo, mas não limitado a, garantias implícitas de
// COMERCIALIZAÇÃO E ADEQUAÇÃO PARA UMA FINALIDADE ESPECÍFICA RENUNCIADOS.
// Em nenhum caso o autor deve ser responsabilizado por quaisquer danos diretos, indiretos, incidentais,
// ESPECIAL, EXEMPLAR OU DANOS CONSEQÜENTES (INCLUSIVE, MAS NÃO LIMITADO
// Para, AQUISIÇÃO DE bens ou serviços; PERDA DE USO, DADOS OU
// LUCROS; OU INTERRUPÇÃO DE NEGÓCIOS) porém causados e em qualquer teoria de
// RESPONSABILIDADE, SEJA EM CONTRATO, RESPONSABILIDADE RIGOROSA, OU DELITO (INCLUINDO
// Negligência ou outra) decorrente de alguma forma para fora da utilização deste software,
// Mesmo que advertido da possibilidade de tais danos.
//
////////////////////////////////////////////////////////////////////////////////////

// arquivo de instalação em português BR //

$install_lang["charset"]                = "ISO-8859-1";
$install_lang["lang_rtl"]               = "FALSO";
$install_lang["step"]                   = "PASSO:";
$install_lang["welcome_header"]         = "Bem-vindo";
$install_lang["welcome"]                = "Bem-vindo à instalação do novo xbtitFM.";
$install_lang["installer_language"]     = "Idioma:";
$install_lang["installer_language_set"] = "Activar este idioma";
$install_lang["start"]                  = "Iniciar";
$install_lang["next"]                   = "Próximo";
$install_lang["back"]                   = "Anterior";
$install_lang["requirements_check"]     = "A verificar requisitos";
$install_lang["reqcheck"]               = "A verificar requisitos";
$install_lang["settings"]               = "Configurações";
$install_lang["system_req"]             = "<p>O ".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." requer o PHP 4.1.2 ou superior e uma base de dados MYSQL.</p>";
$install_lang["list_chmod"]             = "<p>Antes de prosseguir, certifique-se de que todos os ficheiros foram carregados, e que os seguintes arquivos têm permissões adequadas para permitir que este script escreva neles (chmod 0777 deverá ser suficiente).</p>";
$install_lang["view_log"]               = "Pode visualizar o relatório de alterações";
$install_lang["here"]                   = "aqui";
$install_lang["settingup"]              = "Configurar o seu tracker";
$install_lang["settingup_info"]         = "Configurações básicas";
$install_lang["sitename"]               = "Nome do site";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "Url do site";
$install_lang["siteurl_info"]           = "sem barra direita \"/\"";
$install_lang["mysql_settings"]         = "Configurações do MySQL<br />\nCrie um utilizador e base de dados MySQL, e coloque os detalhes aqui";
$install_lang["mysql_settings_info"]    = "Definições da base de dados.";
$install_lang["mysql_settings_server"]  = "Servidor MySQL (localhost funciona para a maioria dos servidores)";
$install_lang["mysql_settings_username"] = "Nome de utilizador MySQL";
$install_lang["mysql_settings_password"] = "Senha MySQL";
$install_lang["mysql_settings_database"] = "Base de Dados MySQL";
$install_lang["mysql_settings_prefix"]  = "Prefixo da Tabela MySQL";
$install_lang["cache_folder"]           = "./cache/";
$install_lang["torrents_folder"]        = "./torrents/";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">É gravável!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Não é gravável!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">NÃO ENCONTRADO!</span>";
$install_lang["mysqlcheck"]             = "A verificar conexão MySQL";
$install_lang["mysqlcheck_step"]        = "A verificar MySQL";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Sucesso, conectado à base de dados!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Falha, a conexão não pôde ser estabelecida!</span>";
$install_lang["back_to_settings"]       = "Volte e preencha as informações necessárias.";
$install_lang["saved"]                  = "gravado";
$install_lang["file_not_writeable"]     = "O arquivo <b>./include/settings.php</b> Não é gravável.";
$install_lang["file_not_exists"]        = "O arquivo <b>./include/settings.php</b> Não existe.";
$install_lang["not_continue_settings"]  = "Não pode continuar com a instalação sem esse arquivo ser gravável.";
$install_lang["not_continue_settings2"] = "Não pode continuar com esse arquivo.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "Pode continuar e alterar isto mais tarde.";
$install_lang["mysql_import"]           = "Importar Base de Dados MySQL";
$install_lang["mysql_import_step"]      = "Importar SQL";
$install_lang["create_owner_account"]   = "A criar conta do proprietário (Owner)";
$install_lang["create_owner_account_step"] = "Criar Proprietário (Owner)";
$install_lang["database_saved"]         = "A base de dados .sql foi importada para a sua base de dados.";
$install_lang["create_owner_account_info"] = "Aqui pode criar a conta do proprietário (Owner).";
$install_lang["username"]               = "Nome de Utilizador";
$install_lang["password"]               = "Senha";
$install_lang["password2"]              = "Repetir a Senha";
$install_lang["email"]                  = "E-mail";
$install_lang["email2"]                 = "Repetir e-mail";
$install_lang["is_succes"]              = "Conta criada";
$install_lang["no_leave_blank"]         = "Não deixe nada em branco.";
$install_lang["not_valid_email"]        = "Este não é um endereço de e-mail válido.";
$install_lang["pass_not_same_username"] = "Senha não pode ser o mesmo que o nome do utilizador.";
$install_lang["email_not_same"]         = "Os endereços de e-mail não coincidem.";
$install_lang["pass_not_same"]          = "As senhas não coincidem.";
$install_lang["site_config"]            = "Configurações do Tracker";
$install_lang["site_config_step"]       = "Config. Tracker.";
$install_lang["default_lang"]           = "Idioma Padrão";
$install_lang["default_style"]          = "Estilo Padrão";
$install_lang["torrents_dir"]           = "Directório Torrents ";
$install_lang["validation"]             = "Modo de Validação";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Mais configurações no <u>Painel Admin.</u> quando a instalação estiver concluída.";
$install_lang["tracker_saved"]          = "As definições foram guardadas.";
$install_lang["finished"]               = "A finalizar a instalação";
$install_lang["finished_step"]          = "A finalizar";
$install_lang["succes_install1"]        = "A instalação está concluída!";
$install_lang["succes_install2a"]       = "<p>Você instalou com sucesso o ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>A instalação foi bem-sucedida, trancada e o ficheiro <b>install.php</b> foi excluído para evitar que seja usado novamente.</p>";
$install_lang["succes_install2b"]       = "<p>Você instalou com sucesso o ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Aconselhamos que bloqueie a instalação. Pode fazer isso renomeando o arquivo <b>install.unlock</b> para <b>install.lock</b> e apagando o arquivo <b>install.php</b>.</p>";
$install_lang["succes_install3"]        = "<p>Esperamos (BTITeam) que aprecie o uso deste produto e aguardamos por si no nosso <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">fórum</a>.</p>";
$install_lang["go_to_tracker"]          = "Ir para o seu tracker";
$install_lang["forum_type"]             = "Tipo de Fórum";
$install_lang["forum_internal"]         = "xbtitFM Fórum Interno";
$install_lang["forum_smf"]              = "Fórum Simple Machines";
$install_lang["forum_other"]            = "Fórum externo - Digite url aqui  -->";
$install_lang["smf_download_a"]         = "<strong>Se utiliza o fórum Simple Machines:</strong><br /><br/ >Por favor faça o download da versão mais recente do fórum Simple Machines <a target='_new' href='http://www.simplemachines.org/download/'>aqui</a> e envie o conteúdo do arquivo para a pasta \"smf \" e <a target='_new' href='smf/install.php'>clique aqui</a> para instalar.*<br /><strong>(Por favor, use a mesma base de dados e detalhes que usou para esta proceder a esta instalação).<br /><br /><font color='#FF0000'>Depois da instalação,</font></strong> altere o CHMOD do arquivo de idioma Inglês do SMF (<strong>";
$install_lang["smf_download_b"]         = "</strong>) para 777 e clique em <strong>Próxima</strong> para prosseguir com a instalação xbtitFM.<br /><br /><strong>* Ambos os links serão abertos numa nova janela / aba para evitar perder o seu lugar na instalação xbtitFM.</strong></p>";
$install_lang["smf_err_1"]              = "Não é possível encontrar Fórum Simple Machines na pasta \"smf\", por favor, instale-o antes de prosseguir.<br /><br />Clique <a href=\"javascript: history.go(-1);\">aqui</a> Para voltar à página anterior.";
$install_lang["smf_err_2"]              = "Não é possível encontrar Forum Simple Machines no base de dados, por favor, instale-o antes de prosseguir.<br /><br />Clique <a href=\"javascript: history.go(-1);\">aqui</a> Para voltar à página anterior.";
$install_lang["smf_err_3a"]             = "Impossível escrever no arquivo de idioma Inglês do SMF(<strong>";
$install_lang["smf_err_3b"]             = "</strong>) Por favor, altere CHMOD para 777 antes de prosseguir.<br /><br />Clique <a href=\"javascript: history.go(-1);\">aqui</a> Para voltar à página anterior.";
$install_lang["allow_url_fopen"]        = "Valor php.ini para \"allow_url_fopen\" (O melhor é \"ON\")";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "A actualização foi concluída!";
$install_lang["succes_upgrade2a"]       = "<p>Você actualizou com sucesso o ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." no seu tracker.</p><p>A actualização foi bem sucedida e bloqueada para prevenir que seja utilizada novamente, mas recomendamos que exclua também o <b>upgrade.php+install.php</b>, para proteção extra.</p>";
$install_lang["succes_upgrade2b"]       = "<p>Você actualizou com sucesso o ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." no seu tracker.</p><p>Aconselhamos que bloqueie a instalação. Pode fazer isso renomeando o arquivo <b>install.unlock</b> para <b>install.lock</b> e apagando os arquivos <b>upgrade.php+install.php</b>.</p>";
$install_lang["succes_upgrade3"]        = "<p>Esperamos (BTITeam) que aprecie o uso deste produto e esperamos vê-lo novamente no nosso <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">fórum</a>.</p>";
$install_lang['error_mysql_database']   = 'O instalador não pôde aceder à base de dados &quot;<i>%s</i>&quot;. Com alguns hosts, tem de criar a base de dados no seu painel administrativo antes de poder usá-lo (xbtitFM) . Alguns também adicionam prefixos - como o seu nome de usuário - a sua base de dados.';
$install_lang['error_message_click']    = 'Clique aqui';
$install_lang['error_message_try_again']= 'Para tentar novamente';
$install_lang["torrentimg_dir"] = "./torrentimg/";
$install_lang["torrentstats_dir"] = "./torrentstats/";
$install_lang["subtitles_dir"] = "./subtitles/";
$install_lang["nforep_dir"] = "./nfo/rep/";
$install_lang["imdbcache_dir"] = "./imdb/cache/";
$install_lang["imdbimg_dir"] = "./imdb/images/";
$install_lang["googimg_dir"] = "./googly/imgs/";
$install_lang["avatar_dir"] = "./avatar/";
$install_lang["sxd_dir"] = "./sxd/backup/";
$install_lang["thetvdb_dir"] = "./thetvdb";

// English definitions (Need translating)
$install_lang["forum_ipb"]              = "Invision Power Board";
$install_lang["ipb_download_a"]         = "<b>If using Invision Power Board:</b><br /><br/ >Please download the latest version of Invision Power Board from your <a target='_new' href='http://www.invisionpower.com/customer/'>Client Area</a> at Invision Power Services, extract the files somewhere on your computer and then upload the contents of the \"upload\" folder to the \"ipb\" folder.<br /><br />Once uploaded please make sure the \"cache\", \"hooks\", \"public\" and \"uploads\" folders are CHMOD'd to 777 recursively, rename \"conf_global.dist.php\" to \"conf_global.php\" and CHMOD that to 777 as well.<br /><br />Once done please <a target='_new' href='ipb/admin/install/index.php'>click here</a> to install it.*<br /><b>(Please use the same database credentials you used for this installation procedure and be sure to enter a database prefix, we suggest using <span style='color:blue;'>ipb_</span> as your prefix).<br /><br /><font color='#FF0000'>Once installed</font></b> please CHMOD the default cached English language file (<b>";
$install_lang["ipb_download_b"]         = "</b>) to 777 and click <b>Next</b> to continue with the xbtitFM installation.<br /><br /><b>* Both links will open into a new window/tab to prevent losing your place on the xbtitFM installation.</b></p>";
$install_lang["ipb_err_1"]              = "Can't find Invision Power Board in the \"ipb\" folder, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_2"]              = "Can't find Invision Power Board in the database, please install it before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_3a"]             = "Unable to write to the IPB English language file (<b>";
$install_lang["ipb_err_3b"]             = "</b>) please CHMOD to 777 before proceeding.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_4a"]             = "IPB English language file (<b>";
$install_lang["ipb_err_4b"]             = "</b>) doesn't exist, cannot proceed.<br /><br />Click <a href=\"javascript: history.go(-1);\">here</a> to return to the previous page.";
$install_lang["ipb_err_5"]             = "Unable to write to the IPB Config file (<b>";
$install_lang["ipb_err_6"]             = "Unable to write to the Tracker Config file (<b>";

?>