<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

// english installation file //

$install_lang["charset"]                = "ISO-8859-1";
$install_lang["lang_rtl"]               = FALSE;
$install_lang["step"]                   = "Paso:";
$install_lang["welcome_header"]         = "Bienvenid@";
$install_lang["welcome"]                = "Bienvenid@ a la instalación de xbtitFM.";
$install_lang["installer_language"]     = "Idioma:";
$install_lang["installer_language_set"] = "Activar este idioma";
$install_lang["start"]                  = "Empezar";
$install_lang["next"]                   = "Siguiente";
$install_lang["back"]                   = "Volver";
$install_lang["requirements_check"]     = "Comprobar Requisitos";
$install_lang["reqcheck"]               = "Comprobar Req.";
$install_lang["settings"]               = "Configuración";
$install_lang["system_req"]             = "<p>".$GLOBALS["btit-tracker"]."&nbsp;".$GLOBALS["current_btit_version"]." requiere PHP 4.1.2 o superior y una base de datos MYSQL.</p>";
$install_lang["list_chmod"]             = "<p>Antes de empezar, comprueba que has subido todos los archivos, y que has dado permisos a los siguientes archivos (0777 debería ser suficiente).</p>";
$install_lang["view_log"]               = "Ver Log de Cambios completo";
$install_lang["here"]                   = "aquí";
$install_lang["settingup"]              = "Configurando el tracker";
$install_lang["settingup_info"]         = "Configuración básica";
$install_lang["sitename"]               = "Nombre de la Web";
$install_lang["sitename_input"]         = "xbtitFM";
$install_lang["siteurl"]                = "URL";
$install_lang["siteurl_info"]           = "Sin la última /";
$install_lang["mysql_settings"]         = "Configuración MySQL<br />\nCrear un usuario y base de datos MySQL, Escribe los detalles aquí";
$install_lang["mysql_settings_info"]    = "Configuración de la Base de Datos.";
$install_lang["mysql_settings_server"]  = "Servidor MySQL (localhost funciona en la mayoría de los servidores)";
$install_lang["mysql_settings_username"] = "Usuario MySQL";
$install_lang["mysql_settings_password"] = "Contraseña MySQL";
$install_lang["mysql_settings_database"] = "Base de datos MySQL";
$install_lang["mysql_settings_prefix"]  = "Prefijo de Tabla MySQL";
$install_lang["cache_folder"]           = "Carpeta de Cache";
$install_lang["torrents_folder"]        = "Carpeta de Torrents";
$install_lang["badwords_file"]          = "badwords.txt";
$install_lang["chat.php"]               = "chat.php";
$install_lang["write_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">se puede modificar!</span>";
$install_lang["write_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">NO se puede modificar!</span> (0777)";
$install_lang["write_file_not_found"]   = "<span style=\"color:#FF0000; font-weight: bold;\">NO ENCONTRADO!</span>";
$install_lang["mysqlcheck"]             = "Comprobación de conexión MySQL";
$install_lang["mysqlcheck_step"]        = "Comprobando MySQL";
$install_lang["mysql_succes"]           = "<span style=\"color:#00FF00; font-weight: bold;\">Conexión realizada a la base de datos!</span>";
$install_lang["mysql_fail"]             = "<span style=\"color:#FF0000; font-weight: bold;\">Fallo la conexión con la base de datos!</span>";
$install_lang["back_to_settings"]       = "Vuelve y rellena los campos necesarios.";
$install_lang["saved"]                  = "guardado";
$install_lang["file_not_writeable"]     = "El archivo <b>./include/settings.php</b> no es modificable.";
$install_lang["file_not_exists"]        = "El archivo <b>./include/settings.php</b> no existe.";
$install_lang["not_continue_settings"]  = "No puedes continuar con la instalación hasta que el archivo sea modificable.";
$install_lang["not_continue_settings2"] = "No puedes continuar con este archivo.";
$install_lang["settings.php"]           = "./include/settings.php";
$install_lang["can_continue"]           = "Puedes continuar y cambiralo después.";
$install_lang["mysql_import"]           = "Importar MySQL";
$install_lang["mysql_import_step"]      = "Imp. SQL";
$install_lang["create_owner_account"]   = "Creando cuenta de administrador";
$install_lang["create_owner_account_step"] = "Crear Administrador";
$install_lang["database_saved"]         = "El archivo database.sql se ha importado a la base de datos.";
$install_lang["create_owner_account_info"] = "Aquí puedes crear una cuenta de administrador.";
$install_lang["username"]               = "Usuario";
$install_lang["password"]               = "Contraseña";
$install_lang["password2"]              = "Repetir contraseña";
$install_lang["email"]                  = "Email";
$install_lang["email2"]                 = "Repetir email";
$install_lang["is_succes"]              = "esta acabado.";
$install_lang["no_leave_blank"]         = "No dejes nada en blanco.";
$install_lang["not_valid_email"]        = "No es un email valido.";
$install_lang["pass_not_same_username"] = "La contraseña no puede ser igual que el usuario.";
$install_lang["email_not_same"]         = "Las direcciones de email no coinciden.";
$install_lang["pass_not_same"]          = "Las contraseñas no coinciden.";
$install_lang["site_config"]            = "Configuración del Tracker";
$install_lang["site_config_step"]       = "Conf. Tracker";
$install_lang["default_lang"]           = "Idioma por defecto";
$install_lang["default_style"]          = "Estilo por defecto";
$install_lang["torrents_dir"]           = "Directorio de Torrents";
$install_lang["validation"]             = "Modo de validación";
$install_lang["more_settings"]          = "*&nbsp;&nbsp;&nbsp;Más parametros en el <u>Panel de Administrador</u> cuando la instalación se complete.";
$install_lang["tracker_saved"]          = "Los parametros se han guardado.";
$install_lang["finished"]               = "Finalizando la instalación";
$install_lang["finished_step"]          = "Paso finalizado";
$install_lang["succes_install1"]        = "La instalación se ha completado!";
$install_lang["succes_install2a"]       = "<p>Has instalado ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>La instalación se ha bloqueado y <b>install.php</b> se ha eliminado para prevenir que se use de nuevo.</p>";
$install_lang["succes_install2b"]       = "<p>Has instalado ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"].".</p><p>Recomendamos que bloquees la instalaciónu. Puedes hacerlo cambiando el archivo <b>install.unlock</b> a <b>install.lock</b> y eliminando el archivo <b>install.php</b>.</p>";
$install_lang["succes_install3"]        = "<p>El equipo de BTITeam espera que disfrutes del uso y que nos visites en nuestro <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">foro</a>.</p>";
$install_lang["go_to_tracker"]          = "Ir al Tracker";
$install_lang["forum_type"]             = "Tipo de Foro";
$install_lang["forum_internal"]         = "Foro interno xbtitFM";
$install_lang["forum_smf"]              = "Foro Simple Machines";
$install_lang["forum_other"]            = "Foro Externo - escribe la url aquí -->";
$install_lang["smf_download_a"]         = "<strong>Si usas el foro Simple Machines:</strong><br /><br/ >Descarga la ultima versión <a target='_new' href='http://www.simplemachines.org/download/'>aquí</a> y sube el contenido a la carpeta \"smf\" y <a target='_new' href='smf/install.php'>cliquea aquí</a> para instalarlo.*<br /><strong>(Usa los mismos parametros de la base de datos para proceder a la instalación).<br /><br /><font color='#FF0000'>Una vez instalado</font></strong> da permisos al archivo SMF English language(<strong>";
$install_lang["smf_download_b"]         = "</strong>) a 777 y haz click en <strong>Siguiente</strong> para continuar con la instalación de xbtitFM.<br /><br /><strong>* Ambos enlaces se abrirán en una nueva ventana para prevenir la perdida de información de la instalación xbtitFM.</strong></p>";
$install_lang["smf_err_1"]              = "No se encuentra el foro Simple Machines en la carpeta \"smf\" Instalalo antes de seguir.<br /><br />Click <a href=\"javascript: history.go(-1);\">aquí</a> para volver a la pagina anterio.";
$install_lang["smf_err_2"]              = "No se encuentra el foro Simple Machines en la base de datos, instalalo antes de seguir.<br /><br />Click <a href=\"javascript: history.go(-1);\">aquí</a> para volver a la pagina anterior.";
$install_lang["smf_err_3a"]             = "Imposible escribir en el archivo de idioma SMF English languaje (<strong>";
$install_lang["smf_err_3b"]             = "</strong>) da permisos CHMOD a 777 antes de seguir.<br /><br />Click <a href=\"javascript: history.go(-1);\">aquí</a> para volver a la página anterior.";
$install_lang["allow_url_fopen"]        = "Valor php.ini para \"allow_url_fopen\" (mejor si esta ON)";
$install_lang["allow_url_fopen_ON"]        = "<span style=\"color:#00FF00; font-weight: bold;\">ON</span>";
$install_lang["allow_url_fopen_OFF"]        = "<span style=\"color:#FF0000; font-weight: bold;\">OFF</span>";
$install_lang["succes_upgrade1"]        = "La actualización se ha completado!";
$install_lang["succes_upgrade2a"]       = "<p>Has actualizado correctamente ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." en tu tracker.</p><p>La actualización se ha bloqueado para prevenir que alguien vuelva a usarla, tambíen puedes eliminar el archivo <b>upgrade.php+install.php</b> para un mejor protección.</p>";
$install_lang["succes_upgrade2b"]       = "<p>Has actualizado correctamente ".$GLOBALS["btit-tracker"]." ".$GLOBALS["current_btit_version"]." en tu tracker.</p><p>Recomendamos que bloquees la instalación. Puedes hacerlo cambiando de nombre el archivo <b>install.unlock</b> a <b>install.lock</b> o eliminando el archivo <b>upgrade.php+install.php</b>.</p>";
$install_lang["succes_upgrade3"]        = "<p>El equipo de BTITeam espera que disfrutes del uso y que nos visites en nuestro <a href=\"http://www.xbtitfm.com/forum/index.php\" target=\"_blank\">foro</a>.</p>";
$install_lang['error_mysql_database']   = 'El instalador no puede acceder a la base de datos &quot;<i>%s</i>&quot; .  En algunos servidores, debes crear la base de datos en tu panel de administrador antes de poder usar xbtitFM.  A veces hay que añadir algún prefijo - como tu usuario - a los nombres de las base de datos.';
$install_lang['error_message_click']    = 'Click aquí';
$install_lang['error_message_try_again']= 'reintentar';
$install_lang["torrentimg_dir"] = "Carpeta de torrentimg";
$install_lang["torrentstats_dir"] = "Carpeta de torrentstats";
$install_lang["subtitles_dir"] = "Carpeta de subtitles";
$install_lang["nforep_dir"] = "Carpeta de nfo/rep";
$install_lang["imdbcache_dir"] = "Carpeta de imdb/cache";
$install_lang["imdbimg_dir"] = "Carpeta de imdb/images";
$install_lang["googimg_dir"] = "Carpeta de googly/imgs";
$install_lang["avatar_dir"] = "Carpeta de avatar";
$install_lang["sxd_dir"] = "Carpeta sxd/backup";
$install_lang["thetvdb_dir"] = "Carpeta thetvdb";

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