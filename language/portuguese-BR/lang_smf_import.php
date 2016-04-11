<?php

// smf_import.php arquivo de idioma

$lang[0]="Sim";
$lang[1]="Não";
$lang[2]="<center><u><strong><font size='4' face='Arial'>Fase 1: Requisitos iniciais</font></strong></u></center><br />";
$lang[3]="<center><strong><font face='Arial' size='2'>Os arquivos SMF estão presentes na pasta \"smf\" ?<font color='";
$lang[4]="'>&nbsp;&nbsp;&nbsp; ";
$lang[5]="</font></center></strong>";
$lang[6]="<br /><center>Por favor <a target='_new' href='http://www.simplemachines.org/download/'>faça o download SMF</a> E envie o conteúdo do arquivo para a pasta \"smf\" .<br />Se você não tem a pasta \"smf\", criar uma na raiz de seu tracker e enviar<br />O conteúdo do arquivo para ele.<br /><br />Uma vez enviado"; // p at end is an lowercase p for use with $lang[8]
$lang[7]="<br /><center>P"; // P at end is an uppercase p for use with $lang[8]
$lang[8]="Instale SMF por <a target='_new' href='smf/install.php'>clique aqui</a>*<br /><br /><strong>* Por favor, use  os mesmos detalhes do login da base de dados para o seu tracker,<br />Você pode usar qualquer prefixo na base de dados (excluindo o prefixo usado pelo<br />tracker Quando aplicável)<br /><br />";
$lang[9]="<font color='#0000FF' size='3'>Você pode atualizar esta página depois de ter concluído a tarefa necessária!</font></strong></center>";
$lang[10]="<center><strong>SMF esta instalado?<font color='";
$lang[11]="Arquivo não encontrado!";
$lang[12]="Arquivo encontrado, mas não pode ser escrito!";
$lang[13]="<center><strong>Arquivo SMF padrão de erros em Inglês esta disponível e gravável?<font color='";
$lang[14]="<center><strong>O arquivo smf.sql esta presente na pasta \"sql\" ?<font color='";
$lang[15]="<br /><center><strong>Arquivo de Idioma (";
$lang[16]=")<br />Está faltando, certifique <font color='#FF0000'><u>se todos arquivos SMF</u></font> foram enviados!<br /><br />";
$lang[17]=")<br />não e gravável, <font color='#FF0000'><u>por favor de CHMOD 777 neste arquivo para</u></font><br /><br />";
$lang[18]="<br /><center><strong>Está faltando o smf.sql, <font color='#FF0000'><u>Queira garantir que esse arquivo está presente na pasta \"sql\" .</u></font><br />(Ele esta incluído com a distribuição XBTIT!)<br /><br />";
$lang[19]="<br /><center>Todos os requisitos foram cumpridos, por favor <a href='";
$lang[20]="'>cliqua aqui para continuar</a></center>";
$lang[21]="<center><u><strong><font size='4' face='Arial'>Estágio 2: Configuração inicial</font></strong></u></center><br />";
$lang[22]="<center>Agora que tudo está confirmado é hora de modificar a base de dados<br />Para fazer tudo de acordo com o tracker.</center><br />";
$lang[23]="<center><form name=\"db_pwd\" action=\"smf_import.php\" method=\"GET\">Digite a senha da base de dados:&nbsp;<input name=\"pwd\" size=\"20\" /><br />\n<br />\n<strong>por favor <input type=\"submit\" name=\"confirm\" value=\"yes\" size=\"20\" /> Para prosseguir</strong><input type=\"hidden\" name=\"act\" value=\"init_setup\" /></form></center>";
$lang[24]="<center><u><strong><font size='4' face='Arial'>Estágio 3: Importando os membros do tracker</font></strong></u></center><br />";
$lang[25]="<center>Agora, o banco de dados foi configurado corretamente é hora de começar a importar os membros do tracker,<br />Isto pode levar algum tempo se você tiver um grande numero de membro na sua base de dados por isso, seja paciente e permita<br />que o script faça o seu trabalho!<br /><br /><strong>por favor <a href='".$_SERVER["PHP_SELF"]."?act=member_import&amp;confirm=yes'>clique aqui</a> para prosseguir</center>";
$lang[26]="<center><u><strong><font size='4' face='Arial'>Desculpe</font></strong></u></center><br />";
$lang[27]="<center>Lamentamos, mas este se destina a ser um recurso usado apenas uma vez e descartarmos o script, desde que você já tenha usado, este arquivo e bloqueado!</center>";
$lang[28]="<center><br /><strong><font color='#FF0000'><br />";
$lang[29]="</strong></font> As contas do Fórum foram criadas com sucesso, por favor <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=no'>clique aqui</a> para prosseguir</center>";
$lang[30]="<center><u><strong><font size='4' face='Arial'>Fase 4: Importando o layout do fórum e posts</font></strong></u></center><br />";
$lang[31]="<center>Esta é a fase final da importação do fórum, este irá importar os seus actuais BTI Fóruns para o SMF,<br />Eles serão importados para uma nova categoria chamada \"Minha importação IPV \",<br />Por favor <a href='".$_SERVER["PHP_SELF"]."?act=import_forum&amp;confirm=yes'>clique aqui</a> para prosseguir</center>";
$lang[32]="<center><u><strong><font size='4' face='Arial'>Importação Completa</font></strong></u></center><br />";
$lang[33]="<center><font face=\"Arial\" size=\"2\">Por favor <a target='_new' href='smf/index.php?action=login'>	
Login para o novo fórum SMF</a> Use seus detalhes do Tacker e vai para<br />a <strong>Administração Central</strong> Em seguida, selecione <strong>Manutenção do Fórum </strong> e execute<br /><strong>Localizar e reparar os erros.</strong> seguido por <strong>Recontagem total de todos os fóruns <br />e estatísticas.</strong> Para arrumar a importação e fixar o post contas etc.<br /><br /><strong><font color='#0000FF'>Seu Fórum SMF integrado deverá, em seguida, estar pronto para uso!</font></strong></font></center>";
$lang[34]="<center><u><strong><font size=\"4\" face=\"Arial\" color=\"#FF0000\">ERROR!</font></strong></u></center><br />\n<br />\n<center><font face=\"Arial\" size=\"3\">Você digitou a senha errada ou você não o proprietário(owner) deste tracker!<br />\nObserve que o seu IP já foi autenticado.</font></center>";
$lang[35]="</body>\n</html>\n";
$lang[36]="<center>Não é possível escrever a:<br /><br /><b>";
$lang[37]="</b><br /><br />Certifique se este arquivo é gravável, em seguida, executar este script novamente.</center>";
$lang[38]="<center><br /><font color=red size=4><b>Acesso Negado</b></font></center>";
?>