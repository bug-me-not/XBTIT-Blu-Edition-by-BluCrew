<?php

// smf_import.php arquivo de idioma

$lang[0]="Sim";
$lang[1]="Não";
$lang[2]="<center><u><strong><font size='4' face='Arial'>Fase 1: Requisitos iniciais</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>Os arquivos SMF estão presentes na pasta \"smf\" ?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Por favor, <a target='_new' href='http://www.simplemachines.org/download/'>faz o download do SMF</a> e envia o conteúdo do arquivo para a pasta \"smf\".<br />Se a pasta \"smf\" não existir, cria uma na raiz do teu tracker e envia<br />o conteúdo do arquivo para ela.<br /><br />Uma vez enviado"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>P"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="Para instalares o SMF <a target='_new' href='smf/install.php'>clica aqui</a>*<br /><br /><strong>* Por favor, utiliza os mesmos detalhes de login da base de dados do teu tracker.<br />Podes usar qualquer prefixo na base de dados<br />(excluindo o prefixo usado pelo tracker quando aplicável).<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>Podes actualizar esta página depois da tarefa ter sido concluída.</font></strong></center>";
$lang[10]="<center><strong>O SMF está instalado?<font color='";
$lang[11]="Arquivo não encontrado.";
$lang[12]="Arquivo encontrado, mas é impossivel escrever nele";
$lang[13]="<center><strong>O arquivo SMF de erros padrão em Inglês está disponível e gravável?<font color='";
$lang[14]="<center><strong>O arquivo smf.sql está presente na pasta \"sql\" ?<font color='";
$lang[15]="<br /><center><strong>O arquivo de Idioma (";
$lang[16]=")<br />não existe, certifica-te <font color='#FF0000'><u>de que todos os arquivos SMF</u></font> foram enviados!<br /><br />";
$lang[17]=")<br />não é gravável, <font color='#FF0000'><u>por favor, faz CHMOD 777 neste arquivo para</u></font><br /><br />";
$lang[18]="<br /><center><strong>O smf.sql não existe, <font color='#FF0000'><u>certifica-te de que esse arquivo está presente na pasta \"sql\".</u></font><br />(Íncluído com a distribuição XBTIT!)<br /><br />";
$lang[19]="<br /><center>Todos os requisitos foram cumpridos, por favor <a href='";
$lang[20]="'>clica aqui para continuar</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>Passo 2: Configuração inicial</font></strong></u></center><br />";
$lang[22]="<center>Agora que tudo está confirmado, vamos modificar a base de dados,<br />para fazer tudo de acordo com o tracker.</center><br />";
$lang[23]="<center><form name=\"db_pwd\" action=\"smf_import.php\" method=\"GET\">Digita a senha da base de dados:&nbsp;<input name=\"pwd\" size=\"20\" /><br />\n<br />\n<strong><input type=\"submit\" name=\"confirm\" value=\"yes\" size=\"20\" />para prosseguires</strong><input type=\"hidden\" name=\"act\" value=\"init_setup\" /></form></center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>Passo 3: A importar os membros do tracker</font></strong></u></center><br />";
$lang[25]="<center>Agora que a base de dados foi configurada correctamente, vamos começar a importar os membros do tracker.<br />Isto pode levar algum tempo se tiveres um grande número de membros na tua base de dados, por isso, sê paciente e permite<br />que o script faça o seu trabalho.<br /><br /><strong>Por favor, <a href='".$_SERVER["PHP_SELF"]."?act=member_import&amp;confirm=yes'>clica aqui</a> para prosseguires.</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>Desculpa</font></strong></u></center><br />";
$lang[27]="<center>Lamentamos, mas este recurso destina-se a ser usado apenas uma vez e descartarmos o script.<br />Assim que é utilizado, este arquivo é bloqueado!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font> As contas do fórum foram criadas com sucesso, por favor <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=no'>clica aqui</a> para prosseguires.</center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'>Passo 4: A importar o layout do fórum e posts</font></strong></u></center><br />";
$lang[31]="<center>Esta é a fase final da importação do fórum, que irá importar os seus actuais fóruns BTIT para o SMF.<br />Eles serão importados para uma nova categoria chamada \"A minha importação IPV \",<br />Por favor, <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=yes'>clica aqui</a> para prosseguires.</center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Importação Completa</font></strong></u></center><br />";
$lang[33]="<center><font face=\"Arial\" size=\"2\">Efectua o <a target='_new' href='smf/index.php?action=login'>	
Login para o novo fórum SMF</a>.<br />Usa os teus detalhes do tracker e vai para<br />a <strong>Centro de Administração</strong>. Em seguida, selecciona <strong>Manutenção do Fórum</strong> e executa<br /><strong>Encontrar e reparar erros.</strong> seguido por <strong>Recontar todos os totais e estatísticas do Fórum.</strong><br />para afinar a importação e reparar posts, contas, etc.<br /><br /><strong><font color='#0000FF'>O teu fórum SMF integrado deverá, em seguida, estar pronto a utilizar.</font></strong></font></center>";
$lang[34]="<center><u><strong><font size=\"4\" face=\"Arial\" color=\"#FF0000\">ERROR!</font></strong></u></center><br />\n<br />\n<center><font face=\"Arial\" size=\"3\">Digitaste a senha errada ou não és o proprietário(Owner) deste tracker!<br />\nO teu IP foi autenticado.</font></center>";
$lang[35]="</body>\n</html>\n";
$lang[36]="<center>Não é possível escrever em:<br /><br /><b>";
$lang[37]="</b><br /><br />Certifica-te de que este arquivo é gravável, em seguida, executa este script novamente.</center>";
$lang[38]="<center><br /><font color=red size=4><b>Acesso Negado</b></font></center>";
?>