<?php
$language["ACP_BAN_IP"]="Banir IPs";
$language["ACP_FORUM"]="Configurações do Fórum";
$language["ACP_USER_GROUP"]="Configurações do grupo usuários";
$language["ACP_STYLES"]="Configurações dos Estilos";
$language["ACP_LANGUAGES"]="Configurações de Idiomas";
$language["ACP_CATEGORIES"]="Configurações de Categorias";
$language["ACP_TRACKER_SETTINGS"]="Configurações do tracker";
$language["ACP_OPTIMIZE_DB"]="Otimizar sua base de dados";
$language["ACP_CENSORED"]="Configurações de palavras Censuradas";
$language["ACP_DBUTILS"]="Utilitários da base de dados";
$language["ACP_HACKS"]="Hacks";
$language["ACP_HACKS_CONFIG"]="Configurações dos Hacks";
$language["ACP_MODULES"]="Modulos";
$language["ACP_MODULES_CONFIG"]="Configurações dos Modulos";
$language["ACP_MASSPM"]="Mensagens privadas em massa";
$language["ACP_PRUNE_TORRENTS"]="Punir Torrents";
$language["ACP_PRUNE_USERS"]="Punir usuários";
$language["ACP_SITE_LOG"]="Ver o Log do Site";
$language["ACP_SEARCH_DIFF"]="Pesquisar Diferença.";
$language["ACP_BLOCKS"]="Configurações dos Blocos";
$language["ACP_POLLS"]="Configurações de Enquetes";
$language["ACP_MENU"]="Menu Admin";
$language["ACP_FRONTEND"]="Configurações do Conteúdo";
$language["ACP_USERS_TOOLS"]="Ferramentas do usuário";
$language["ACP_TORRENTS_TOOLS"]="Ferramentas dos Torrent's";
$language["ACP_OTHER_TOOLS"]="Outras Ferramentas";
$language["ACP_MYSQL_STATS"]="Estatísticas MySql";
$language["XBTT_BACKEND"]="Opções xbtt";
$language["XBTT_USE"]="Use <a href=\"http://xbtt.sourceforge.net/tracker/\" target=\"_blank\">xbtt</a> como backend?";
$language["XBTT_URL"]="url base xbtt e.g. http://localhost:2710";
$language["GENERAL_SETTINGS"]="Outros ajustes";
$language["TRACKER_NAME"]="Nome do site";
$language["TRACKER_BASEURL"]="URL base do Tracker (Sem Última /)";
$language["TRACKER_ANNOUNCE"]="Tracker's Announce URLS (Uma URL por linha)".($XBTT_USE?"<br />\n<span style=\"color:#FF0000; font-weight: bold;\">Verifique o seu url Announce duas vezes, para que você ative xbtt backend...</span>":"");
$language["TRACKER_EMAIL"]="E-mail do proprietário(Owner)do Tracker";
$language["TORRENT_FOLDER"]="Pasta Torrent";
$language["ALLOW_EXTERNAL"]="Permitir torrents Externos";
$language["ALLOW_GZIP"]="Ativar GZIP";
$language["ALLOW_DEBUG"]="Mostrar Debug infos na página do fundo";
$language["ALLOW_DHT"]="Desabilitar DHT (Bandeira privada no torrent)<br />\nserá ajustado somente em um novo torrent";
$language["ALLOW_LIVESTATS"]="Ativar estatística em tempo real (Alerta para alta carga no servidor!)";
$language["ALLOW_SITELOG"]="Ativar log básico do site (Log mudança em torrentes / usuários)";
$language["ALLOW_HISTORY"]="Ativar Histórico Básico (torrentes / usuários)";
$language["ALLOW_PRIVATE_ANNOUNCE"]="Announce Privado";
$language["ALLOW_PRIVATE_SCRAPE"]="Scrape Privado";
$language["SHOW_UPLOADER"]="Mostrar Nick dos Uploader's";
$language["USE_POPUP"]="Use Popup para detalhes Torrents / peers";
$language["DEFAULT_LANGUAGE"]="Idioma Padrão";
$language["DEFAULT_CHARSET"]="Defiir a codificação padrão<br />\n(Se o seu idioma não exibir corretamente, tente UTF-8)";
$language["DEFAULT_STYLE"]="Estilo padrão";
$language["MAX_USERS"]="Usuários Maximo (Numérico, 0 = sem limites)";
$language["MAX_TORRENTS_PER_PAGE"]="Torrents por Página";
$language["SPECIFIC_SETTINGS"]="Configurações específicas do Tracker's";
$language["SETTING_INTERVAL_SANITY"]="intervalo de Higiene (Numérico segundos, 0 = Desativado)<br />Valor Bom, se estiver ativado, é 1800 (30 minutos)";
$language["SETTING_INTERVAL_EXTERNAL"]="Atualização Externa por intervalo (numérico segundo, 0 = Desativado)<br />Dependendo de quantos torrent externo";
$language["SETTING_INTERVAL_MAX_REANNOUNCE"]="Máximo reannounce por intervalo (numérico segundo)";
$language["SETTING_INTERVAL_MIN_REANNOUNCE"]="Minimo reannounce por intervalo (numérico segundo)";
$language["SETTING_MAX_PEERS"]="N. Max de pedido por peers (numérico)";
$language["SETTING_DYNAMIC"]="Permitir Torrents Dinâmico (não recomendado)";
$language["SETTING_NAT_CHECK"]="Verificar NAT";
$language["SETTING_PERSISTENT_DB"]="Conexões persistentes (base de dados, não recomendado)";
$language["SETTING_OVERRIDE_IP"]="Permitir aos usuários sobrepor ip detectado";
$language["SETTING_CALCULATE_SPEED"]="Calcular Velocidade e Downloaded bytes";
$language["SETTING_PEER_CACHING"]="Tabela caches (deverá diminuir um pouco de carga)";
$language["SETTING_SEEDS_PID"]="Numero Max De seeds com o mesmo PID";
$language["SETTING_LEECHERS_PID"]="Numero Max De leechers com o mesmo PID";
$language["SETTING_VALIDATION"]="Modo de Validação";
$language["SETTING_CAPTCHA"]="Registro Seguro (Utiliza Código de Imagem, GD+Freetype Bibliotecas são necessárias)";
$language["SETTING_FORUM"]="Link do Fórum, Pode ser:<br /><li><font color='#FF0000'>interno</font> Ou vazio (sem valor) para fórum interno</li><li><font color='#FF0000'>smf</font> Para integrar <a target='_new' href='http://www.simplemachines.org'>Simple Machines Fórum</a></li><li>Seu próprio fórum solução (Especifique url na caixa)</li>";
$language["BLOCKS_SETTING"]="Índice / Blocos / página / configurações";
$language["SETTING_CLOCK"]="Tipo de Relógio";
$language["SETTING_FORUMBLOCK"]='Bloco Tipo Forum';
$language["SETTING_NUM_NEWS"]="Limite de blocos de Últimas Notícias (numérico)";
$language["SETTING_NUM_POSTS"]="Limite blocos para o Fórum (numérico)";
$language["SETTING_NUM_LASTTORRENTS"]="Limite blocos para Últimos Torrents (numérico)";
$language["SETTING_NUM_TOPTORRENTS"]="Limite blocos para Torrents mais populares (numérico)";
$language["CLOCK_ANALOG"]="Analógico";
$language["CLOCK_DIGITAL"]="Digital";
$language["FORUMBLOCK_POSTS"]='Últimos Posts';
$language["FORUMBLOCK_TOPICS"]='Últimos Posts Ativos';
$language["CONFIG_SAVED"]="A configuração foi salva corretamente!";
$language["CACHE_SITE"]="intervalo do Cache (numérico segundos, 0 = desativado)";
$language["ALL_FIELDS_REQUIRED"]="Todos os campos são obrigatórios!";
$language["SETTING_CUT_LONG_NAME"]="Torrents Cortar nome longo após x caracteres (0 = não corta)";
$language["MAILER_SETTINGS"]="Correio";
$language["SETTING_MAIL_TYPE"]="Tipo de Mail";
$language["SETTING_SMTP_SERVER"]="Servidor SMTP";
$language["SETTING_SMTP_PORT"]="Porta SMTP";
$language["SETTING_SMTP_USERNAME"]="Nome de Usuário SMTP";
$language["SETTING_SMTP_PASSWORD"]="Senha SMTP";
$language["SETTING_SMTP_PASSWORD_REPEAT"]="Senha SMTP(Repetir)";
$language["XBTT_TABLES_ERROR"]="Você deve importar tabelas xbtt (veja nas instruções de instalação xbtt) em sua base de dados antes de ativar xbtt backend!";
$language["XBTT_URL_ERROR"]="URL base Xbtt é obrigatória!";
// BAN FORM
$language["BAN_NOTE"]="Nesta parte do painel admin., você pode ver os IPs banidos e banir novos IPs de acessar o tracker.<br />\nVocê deve inserir um intervalo de (primeiro IP) a (último IP).";
$language["BAN_NOIP"]="Não há IPs banidos";
$language["BAN_FIRSTIP"]="Primeiro IP";
$language["BAN_LASTIP"]="Último IP";
$language["BAN_COMMENTS"]="Comentários";
$language["BAN_REMOVE"]="Remover";
$language["BAN_BY"]="Por";
$language["BAN_ADDED"]="Data";
$language["BAN_INSERT"]="Inserir nova faixa de IP proibidos";
$language["BAN_IP_ERROR"]="Endereço de IP ruim.";
$language["BAN_NO_IP_WRITE"]="Você não escreveu um endereço IP. Desculpe!";
$language["BAN_DELETED"]="O intervalo desse IP foi excluído da base de dados.<br />\n<br />\n<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banip&amp;action=read\">Voltar para Banir IP</a>";
// LANGUAGES
$language["LANGUAGE_SETTINGS"]="Configurações de Idiomas";
$language["LANGUAGE"]="Idioma";
$language["LANGUAGE_ADD"]="Inserir novo Idioma";
$language["LANGUAGE_SAVED"]="Parabéns, o idioma foi modificado";
// STYLES
$language["STYLE_SETTINGS"]="Estilo / temas configurações";
$language["STYLE_EDIT"]="Editar Estilo";
$language["STYLE_ADD"]="Inserir novo Estilo";
$language["STYLE_NAME"]="Nome do Estilo";
$language["STYLE_URL"]="URL do Estilo";
$language["STYLE_FOLDER"]="Pasta do Estilo ";
$language["STYLE_NOTE"]="Nesta seção você pode gerenciar suas configurações de estilo, mas você deve fazer upload dos arquivos por ftp ou sftp.";
// CATEGORIES
$language["CATEGORY_SETTINGS"]="Configurações de Categorias";
$language["CATEGORY_IMAGE"]="Imagem da Categoria";
$language["CATEGORY_ADD"]="Inserir nova Categoria";
$language["CATEGORY_SORT_INDEX"]="Classificar Índice";
$language["CATEGORY_FULL"]="Categoria";
$language["CATEGORY_EDIT"]="Editar Categoria";
$language["CATEGORY_SUB"]="Sub-Categoria";
$language["CATEGORY_NAME"]="Categoria";
// CENSORED
$language["CENSORED_NOTE"]="Escrever <b>uma palavra por linha</b> para censurar a mesma (Será alterado para *censurado*)";
$language["CENSORED_EDIT"]="Editar Palavras Censuradas";
// BLOCKS
$language["BLOCKS_SETTINGS"]="Configurações dos Blocos";
$language["ENABLED"]="Ativado";
$language["ORDER"]="Ordem";
$language["BLOCK_NAME"]="Nome do Bloco";
$language["BLOCK_POSITION"]="Posição";
$language["BLOCK_TITLE"]="Idioma / título (será usado para exibir o título traduzido)";
$language["BLOCK_USE_CACHE"]="Colocar este bloco em Cache?";
$language["ERR_BLOCK_NAME"]="Você deve selecionar um dos arquivo ativado no nome da dropdown!";
$language["BLOCK_ADD_NEW"]="Adicionar Novo Bloco";
// POLLS (more in lang_polls.php)
$language["POLLS_SETTINGS"]="Configurações de Enquetes";
$language["POLLID"]="ID da Enquete";
$language["INSERT_NEW_POLL"]="Adicionar nova Enquete";
$language["CANT_FIND_POLL"]="Não é possível encontrar a enquete";
$language["ADD_NEW_POLL"]="Adicionar Enquete";
// GROUPS
$language["USER_GROUPS"]="Configurações do grupo usuários (Clique no nome do grupo para editar)";
$language["VIEW_EDIT_DEL"]="Ver/Editar/Apagar";
$language["CANT_DELETE_GROUP"]="Este Rank/grupo não pode ser cancelado!";
$language["GROUP_NAME"]="Nome dos Grupos";
$language["GROUP_VIEW_NEWS"]="Ver Notícias";
$language["GROUP_VIEW_FORUM"]="Ver Fórum";
$language["GROUP_EDIT_FORUM"]="Editar Fórum";
$language["GROUP_BASE_LEVEL"]="Escolha rank básico";
$language["GROUP_ERR_BASE_SEL"]="Erro no rank básico selecionado!";
$language["GROUP_DELETE_NEWS"]="Apagar Notícias";
$language["GROUP_PCOLOR"]="Prefixo da Cor (como ";
$language["GROUP_SCOLOR"]="Suffixo da Cor (como ";
$language["GROUP_VIEW_TORR"]="Ver Torrents";
$language["GROUP_EDIT_TORR"]="Editar Torrents";
$language["GROUP_VIEW_USERS"]="Ver Usuários";
$language["GROUP_DELETE_TORR"]="Apagar Torrents";
$language["GROUP_EDIT_USERS"]="Editar Usuários";
$language["GROUP_DOWNLOAD"]="Pode fazer Download";
$language["GROUP_DELETE_USERS"]="Apagar Usuários";
$language["GROUP_DELETE_FORUM"]="Apagar Fórum";
$language["GROUP_GO_CP"]="Pode acessar Admin CP";
$language["GROUP_EDIT_NEWS"]="Editar Notícias";
$language["GROUP_ADD_NEW"]="Adicionar novo Grupo";
$language["GROUP_UPLOAD"]="Pode fazer Upload";
$language["GROUP_WT"]="Aguardando tempo do Ratio <1";
$language["GROUP_EDIT_GROUP"]="Editar Grupo";
$language["GROUP_VIEW"]="Ver";
$language["GROUP_EDIT"]="Editar";
$language["GROUP_DELETE"]="Apagar";
$language["INSERT_USER_GROUP"]="Inserir novo Grupo de Usuários";
$language["ERR_CANT_FIND_GROUP"]="Não é possível encontrar este grupo!";
$language["GROUP_DELETED"]="O grupo foi excluído!";
// MASS PM
$language["USERS_FOUND"]="Usuários encontrados";
$language["USERS_PMED"]="Mensagens enviadas para esses Usuários";
$language["WHO_PM"]="PM a ser enviado para?";
$language["MASS_SENT"]="Enviar PM em Massa!!!";
$language["MASS_PM"]="PM en Massa";
$language["MASS_PM_ERROR"]="É talvez seja uma boa idéia escrever algo antes de enviá-lo!!!!";
$language["RATIO_ONLY"]="Só este ratio";
$language["RATIO_GREAT"]="Maior que este ratio";
$language["RATIO_LOW"]="Inferior que este ratio";
$language["RATIO_FROM"]="De";
$language["RATIO_TO"]="Para";
$language["MASSPM_INFO"]="Info.";
// PRUNE USERS
$language["PRUNE_USERS_PRUNED"]="Punir usuários";
$language["PRUNE_USERS"]="Punir usuários";
$language["PRUNE_USERS_INFO"]="Digite o número de dias que os usuários estão a ser consideradas como /mortos\ (que não conectaram a partir de x dias ou tenha se cadastrado a partir de x dias e ainda não entrou no site)";
// SEARCH DIFF
$language["SEARCH_DIFF"]="Procurar Diferença.";
$language["SEARCH_DIFF_MESSAGE"]="Mensagem";
$language["DIFFERENCE"]="Diferença";
$language["SEARCH_DIFF_CHANGE_GROUP"]="Mudar Grupo de Usuários";
// PRUNE TORRENTS
$language["PRUNE_TORRENTS_PRUNED"]="Punir torrents";
$language["PRUNE_TORRENTS"]="Punir torrents";
$language["PRUNE_TORRENTS_INFO"]="Digite o número de dias que os torrents estão a ser considerados como \"Morto\"";
$language["LEECHERS"]="leecher(s)";
$language["SEEDS"]="seed(s)";
// DBUTILS
$language["DBUTILS_TABLENAME"]="Nome da Tabela";
$language["DBUTILS_RECORDS"]="Records";
$language["DBUTILS_DATALENGTH"]="Tamanho dos Dados";
$language["DBUTILS_OVERHEAD"]="Excedeu";
$language["DBUTILS_REPAIR"]="Reparar";
$language["DBUTILS_OPTIMIZE"]="Otimizar";
$language["DBUTILS_ANALYSE"]="Analizar";
$language["DBUTILS_CHECK"]="Checar";
$language["DBUTILS_DELETE"]="Apagar";
$language["DBUTILS_OPERATION"]="Operação";
$language["DBUTILS_INFO"]="Info.";
$language["DBUTILS_STATUS"]="Status";
$language["DBUTILS_TABLES"]="Tabelas";
// MYSQL STATUS
$language["MYSQL_STATUS"]="Status MySQL";
// SITE LOG
$language["SITE_LOG"]="Log do Site";
// FORUMS
$language["FORUM_MIN_CREATE"]="Rank minimo que pode criar";
$language["FORUM_MIN_WRITE"]="Rank minimo que pode Escrever";
$language["FORUM_MIN_READ"]="Rank minimo que pode Ler";
$language["FORUM_SETTINGS"]="Configurações do Fórum";
$language["FORUM_EDIT"]="Editar Fórum";
$language["FORUM_ADD_NEW"]="Adicionar novo Fórum";
$language["FORUM_PARENT"]=" Fórum Pai";
$language["FORUM_SORRY_PARENT"]="(Infelizmente, não posso ter sub fórum, porque eu sou um sub fórum)";
$language["FORUM_PRUNE_1"]="Há tópicos e/ou mensagens neste fórum!<br />Você perderá todos os dados...<br />";
$language["FORUM_PRUNE_2"]="Tem certeza que quer apagar este fórum";
$language["FORUM_PRUNE_3"]="Voltar.";
$language["FORUM_ERR_CANNOT_DELETE_PARENT"]="Você não pode apagar um fórum que tem sub fórum, passe o sub fórum para outro e tente novamente";
// MODULES
$language["ADD_NEW_MODULE"]="Aicionar novo Modulo";
$language["TYPE"]="Tipo";
$language["DATE_CHANGED"]="Data da mudança";
$language["DATE_CREATED"]="Data de criação";
$language["ACTIVE_MODULES"]="Modulos Ativos: ";
$language["NOT_ACTIVE_MODULES"]="Modulos inativos: ";
$language["TOTAL_MODULES"]="Total de Modulos: ";
$language["DEACTIVATE"]="Desativado";
$language["ACTIVATE"]="Ativado";
$language["STAFF"]="Staff";
$language["MISC"]="Diversos";
$language["TORRENT"]="Torrent";
$language["STYLE"]="Estilo";
$language["ID_MODULE"]="ID";
// HACKS
$language["HACK_TITLE"]="Titulo";
$language["HACK_VERSION"]="Versão";
$language["HACK_AUTHOR"]="Autor";
$language["HACK_ADDED"]="Adicionado";
$language["HACK_NONE"]="Não existe nenhum hack instalado";
$language["HACK_ADD_NEW"]="Adicionar novo hack";
$language["HACK_SELECT"]="Selecionar";
$language["HACK_STATUS"]="Status";
$language["HACK_INSTALL"]="Instalar";
$language["HACK_UNINSTALL"]="Desinstalar";
$language["HACK_INSTALLED_OK"]="Hack foi instalado com sucesso!<br />\nPara ver quais hacks estão instalados voltar a <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">Painel Admin (Hacks)</a>";
$language["HACK_BAD_ID"]="Erro ao obter informação do hack com este ID.";
$language["HACK_UNINSTALLED_OK"]="Hack foi instalado com sucesso!<br />\nPara ver quais hacks estão instalados voltar a <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=hacks&amp;action=read\">Painel Admin (Hacks)</a>";
$language["HACK_OPERATION"]="Operação";
$language["HACK_SOLUTION"]="Solução";
// added rev 520
$language['HACK_WHY_FTP']='Algum dos arquivos que o hack precisa modificar está sem permissão. <br />'."\n".'Isto precisa ser modificado no FTP dando a permissão CHMOD ou criando os arquivos e pastas. <br />'."\n".'Sua infrmação de FTP está temporáriamente SALVA para a operaçõa de instalação do HACK.';
$language['HACK_FTP_SERVER']='FTP Server';
$language['HACK_FTP_PORT']='FTP Porta';
$language['HACK_FTP_USERNAME']='FTP Usuário';
$language['HACK_FTP_PASSWORD']='FTP Senha';
$language['HACK_FTP_BASEDIR']='Caminho local para o xbtit (caminho para a raiz do seu usuário FTP)';
// USERS TOOLS
$language['USER_NOT_DELETE']='Você não pode deletar Visitante e ou você mesmo!';
$language['USER_NOT_EDIT']='Você não pode editar Visitante e ou você mesmo!';
$language['USER_NOT_DELETE_HIGHER']='Você não pode deletar usuários com RANK maior que o seu.';
$language['USER_NOT_EDIT_HIGHER']='Você não pode editar usuários com RANK maior que o seu.';
$language['USER_NO_CHANGE']='Nenhuma alteração foi feita.';


//INVITATION SYSTEM
$language['ACP_INVITATION_SYSTEM']='Sistema de Convites';
$language['ACTIVE_INVITATIONS']='Ativar Sistema de Convites:';
$language['PRIVATE_TRACKER']='Tracker Privado';
$language['PRIVATE_TRACKER_INFO']='Por segurança, quando setado o tracker para "Privado",<br />"Máximos Usuários" será mudado para "1".';
$language['ACP_INVITATIONS']='Convites';
$language['VALID_INV_MODE']='Confirmação do Usuário que convidou ?';
$language['INVITE_TIMEOUT']='Dias para validação de convites<br />( em dias )';
$language['INVITED_BY']='Convidado por';
$language['SENT_TO']='Enviado para';
$language['DATE_SENT']='Data do Envio';
$language['INV_WELCOME']='Bem Vindo ao Painel do Sistema de COnvites.<br />Ativando este sistema você negará com que novos usuários<br />se registrem sem um convite.';
$language['HASH']='Hash';
$language['VALID_INV_MODE']='Confirmação Necessária';
$language['VALID_INV_EXPL']='<i>Usuário que convidou precisa confirmar a conta do convidado.</i>';
$language['INVITE_TIMEOUT']='Dias para validação de convites<br />( em dias )';
$language['GIVE_INVITES_TO']='Dar Convites';
$language['NUM_INVITES']='Número de Convites';
$language['INVITES_SETTINGS']='Configurações';
$language['INVITES_LIST']='Lista de Convites';
$language['SENDINV_CONFIRM']='Tem certeza que deseja enviar este Convite?';
$language['ERR_SENDINVS']='Por Favor, escolha usuário ou level.';
$language['SENDINV_EXPL']='Se o nome do usuário não for inserido, rank será selecionado automáticamente.';
$language['RECYCLE_DATE']='Período de recyclagem';
$language['RECYCLE_EXPL']='<i>Período em <u>dias</u> que os convites serão reciclados</i>';
$language["ACP_FM_HACK_CONFIG"]='FM Hacks Configuração';
$language["ACP_NO_HACKS_ENABLED"]='Nenhum Hack Ligado';
$language['HACK_INFO']='Ligar/Desligar Hacks aqui.<br /><br /><b>Você não pode desligar um hack caso ele seja pré-requisito de outro e este esteja ligado.</b> Por favor passe o mouse em cima da <img src="images/info.png"> imagem abaixo para saber qual eh o hack pre-requisito deste.';
global $BASEURL;
$language['HACK_INFO_2']='<b>Nota: Os HACKS intalados tem múltiplos contribuidores, por favor <a target="_blank" href="'.$BASEURL.'/FM-Hacks.txt">clique aqui</a> para mais informações.</b>';
$language['HACK_ENABLED']='Ligado';
$language['HACK_DISABLED']='Desligado';
$language['SUBMIT'] = 'Execute';
$language['PRE_OF'] = 'Pre-requisito de';


$language["ACP_SEEDBONUS"]="SeedBonus Configuração";
$language["BONUS"]="Pontos ganhos por hora de seeding";
$language["PRICE_VIP"]="Preço por rank VIP";
$language["PRICE_CT"]="Preço por CustomTitle";
$language["PRICE_NAME"]="Preço para trocar nome do Usuário";
$language["PRICE_GB"]="Preço por GB";
$language["POINTS"]="Pontos";
$language["SEEDBONUS_UPDATED"]="SeedBonus Configurações Atualizadas";
$language["ENABLE"] = "Ligar";
$language["AWARD_FOR"] = "Pontos ganhos para";
$language["ALL_TORR"] = "Todos torrents semeados";
$language["ONE_TORR"] = "Um torrento semeado apenas";
$language["BON_FOR_UPLOAD"] = "Pontos ganhos por enviar um torrent novo";
$language["PRICE_FOR_INVITES"] = "Preço para Convites";
$language["SB_INVITE"] = "Convite";
$language["SB_INVITES"] = "Convites";
$language["SB_DELAY"] = "Tempo para premiação (Horas)";
$language["BON_FOR_COMMENT"] = "Pontos ganhos por comentar um torrent";
$language["BON_FOR_FORUM_POST"] = "Pontos ganhos por postar no fórum";
$language["SB_PNT_4_UPL"] = "Pontos ganhso apenas se você estiver enviando torrents atualmente";
$language["SB_MIN_UL_RATE"] = "Rate mínimo de Upload em KB/s";
$language["SB_MAX_PER_HOUR"] = "Máximo número de pontos que se pode ganhar semenado por hora";
$language["SB_PNTS_4_SHOUT"] = "Pontos ganhos por fazer um shout";
$language["SB_PNTS_4_RADIO"] = "Pontos ganhos por hora escutando a radio";
$language["SB_ALLOW_GIFT"] = "Permite aos usuários a fazer doação de seus pontos a outros usuários";
$language["SB_GIFTMAX"] = "Valor máximo de doação";


// Donation History by DiemThuy -->
$language['ACP_DON_HIST']='Histórico de Doações';
$language['ACP_DON_HIST_SET']='Configuração do Histórico de Doações';
$language['ACP_UNITS'] = 'Unidades';
$language['ACP_USE_AUTO_PM'] = 'Use Auto PM';
$language['ACP_THANK_PM_TEXT'] = 'Texto da PM de agradecimento';
$language['ACP_DONATION'] = 'Doação';
$language['ACP_AMOUNT'] = 'Valor';
$language['ACP_USERNAME'] = 'Usuário';
$language['ACP_EDIT_DON'] = 'Editar Doações';
$language['ACP_NONE_YET'] = 'nada ainda';
$language['ACP_SHORT_DON'] = 'Don';
// <-- Donation History by DiemThuy


// Advanced Auto Donation System by DiemThuy -->
$language['ACP_DONATE']='VIP & Donações Configurações';
$language['AADS_NOTHING'] = 'nada';
$language['AADS_HERE'] = 'aqui';
$language['AADS_YET'] = 'ainda';
$language['AADS_YES'] = 'sim';
$language['AADS_NO_TIMED_RANK'] = 'sem rank temporário';
$language['AADS_NO_OLD_RANK'] = 'sem rank antigo';
$language['AADS_NO_UPLOAD'] = 'sem upload';
$language['AADS_NO'] = 'não';
$language['AADS_DEM_PRO'] = 'proteção desligada';
$language['AADS_PP_INFO'] = 'Você precisa de uma conta PayPal Business e IPN ativado no seu perfil do PayPal para isso funcionar!!';
$language['AADS_MODE'] = 'Teste ou Real';
$language['AADS_UNITS'] = 'Unidades';
$language['AADS_VIP_TRACKER'] = 'VIP Rank ID';
$language['AADS_VIP_SMF'] = 'VIP Rank ID SMF';
$language['AADS_PP_SAND_MAIL'] = 'Sandbox Email';
$language['AADS_PP_MAIL'] = 'PayPal Email';
$language['AADS_VIP_DAYS'] = '1 Euro/Dollar = .. Vip Dias';
$language['AADS_GB_AMT'] = '1 Euro/Dollar = .. GB';
$language['AADS_NEEDED'] = 'Necessário';
$language['AADS_RECEIVED'] = 'Recebido';
$language['AADS_NUM_NO_POINTS'] = '(Numérico) Sem pontos';
$language['AADS_DUE_DATE'] = 'Data Final';
$language['AADS_DUE_DATE_VALUE'] = '31/01/10';
$language['AADS_NUM_DON'] = 'Número de Doadores por Bloco';
$language['AADS_SC_BL_TEXT'] = 'Bloco de Rolagem de Texto';
$language['AADS_EN_SC_LINE'] = 'Ligar Linha de Rolagem';
$language['AADS_DON_HIST_BR'] = 'Histórico de Doações';
$language['AADS_SIM_DON_DISP_BR'] = 'Histórico de Doações Simples';
$language['AADS_VIP'] = 'VIP';
$language['AADS_LNAME'] = 'Último Nome';
$language['AADS_DDATE'] = 'Data da Doação';
$language['AADS_VIP_BET'] = 'VIP entre';
$language['AADS_VIP_DAYS'] = 'VIP dias por unidades';
$language['AADS_GB_BET'] = 'GB entre';
$language['AADS_GB_PER_UNIT'] = 'GB por unidade';
$language['AADS_AND_UP'] = 'e acima é';
$language['AADS_UNITS_IS'] = 'unidades são';
// <-- Advanced Auto Donation System by DiemThuy

//GOLD
$language["ACP_GOLD"]="Gold Torrents Configuração";


$language['ACP_FREECTRL']='Controle de Free Leech';
$language['FL_INFO'] = 'Free Leech, se ligado todos os torrents (incluindo novos uploads) serão Free Leech, nenhum status de dowload será gravado. (Apenas Upload)';
$language['FL_DTE'] = 'Data qpara expirar';
$language['FL_DATE_FORMAT'] = '[0000-00-00][Y/M/D] precisa ser neste formato';
$language['FL_TTE'] = 'Hora para expirar';
$language['FL_HOUR_FORMAT'] = '[00] precisa serm em horas inteiras';
$language['FL_ENABLE'] = 'Ligar';
$language['FL_HAPPY_HOUR'] = 'Happy Hour, se ligado Free Leech será ativado 1 hora por dia em horas randômicas';
$language['FL_EN_HAPPY_HOUR'] = 'Ligar Happy Hour';


$language["IMAGE_SETTING"]="IConfigurações de Imagem";
$language["ALLOW_IMAGE_UPLOAD"]="Permitir Upload de Imagem";
$language["ALLOW_SCREEN_UPLOAD"]="Permitir Upload de Screens";
$language["IMAGE_UPLOAD_DIR"]="Diretório de upload de imagem";
$language["FILE_SIZELIMIT"]="Tamanho limite da imagem";


$language["ACP_HITRUN"]="Hit & Run Configurações";
$language["HNR_BLOCK_SETTINGS"] = "Hit & Run Configuração do Bloco";
$language["HNR_SCROLLING_TEXT"] = "Texto de Rolagem";
$language["HNR_COUNT"] = "Numero de Hit & Runners mostrar";
$language["HNR_ERR_1"] = "Você não pode adicionar 2 regras para um mesmo grupo!";
$language["HNR_ACTIVE"] = "Ativo";
$language["HNR_SEEDTIME"] = "Tempo de Seeding";
$language["HNR_BANUSER"] = "Banir Usuário";
$language["HNR_ID_LEVEL"] = "id_level do grupo que você quer aplicar essas regras:";
$language["HNR_DOWN_TRIG"] = "Download mínimo (MB) requerido para engatilhar possível punição";
$language["HNR_RATIO_TRIG"] = "Ratio mínimo requerido para engatilhar punição/premiação:";
$language["HNR_MIN_SEED"] = "Tempo mínimo de seeding (horas) requerido para evitar punição:";
$language["HNR_TOLERANCE"] = "Tolenrância em dias (numero de dias permitidos antes do usuário ser elegível a punição):";
$language["HNR_UL_PUNISH"] = "Valor no Upload (MB) para tirar de usuários que Hitting & Running:";
$language["HNR_REW_SYS"] = "Sistema de Prêmiação - retorna montante retirando na punição + bonus após:";
$language["HNR_WARN_BRIDGE"] = "Faz uso do Alerta para fazer Hit & Runners visíveis para outros:";
$language["HNR_DAYS"] = "dias";
$language["HNR_FOR"] = "para";
$language["HNR_AFTER"] = "depois";
$language["HNR_WARNINGS"] = "alertas";
$language["HNR_BOOT_BRIDGE"] = "Faz uso do Booted Users Hack para kickar Hit & Runners:";
$language["HNR_BOOT_USER"] = "se ligado usuários serão kickados:";
$language["HNR_NEW_GROUP"] = "Adicionar novo Grupo";
$language["HNR_ID_LEVEL"] = "ID Level";
$language["HNR_USERGROUP"] = "User Group";
$language["HNR_MIN_DOWN"] = "Dowload Mínimo";
$language["HNR_MIN_RAT"] = "Ratio Mínimo";
$language["HNR_MIN_ST"] = "Mínimo tempo Semeando";
$language["HNR_TOL_DAYS"] = "Dias de Tolerância";
$language["HNR_UL_PUN"] = "Punição no Upload";
$language["HNR_REW"] = "Premio";
$language["HNR_WS"] = "Alerta Symbolo";
$language["HNR_FD"] = "Por DIas";
$language["HNR_WIB"] = "Alerta é Boot";
$language["HNR_WT"] = "Veses Alertado";
$language["HNR_BU"] = "Boot Usuários";

$language["ACP_AUTORANK"] = "Autorank Configuração";
$language["AUTORANK_INVALID"] = "Entrada Inválida, por favor coloque um número entre 1 e 23";
$language["AUTORANK_MAIN_1"] = "Para evitar overload no servidor apenas usuários logados em torrents serão scaneados para mudança de rank regularmente. A base de usuários inteira sera escaneada a cada 24 horas e vc pode setar a hora para esse scan abaixo.<br /><br /><b>Atenção:</b> Você deve definir esse tempo total de scaneamento para algo fora do pico mas também precisa ser uma hora em que ainda existem usuários visitando seu site, caso contrário, provavelmente não será engatilhado.<br /><br />Valores válidos são 0-23 (0 = meia-noite, 1 = 1:00am, 5=5:00am, 14=2:00pm etc.)";
$language["AUTORANK_MAIN_2"] = "Hora do Scan Total";
$language["AUTORANK_MAIN_3"] = "Você pode setar todos os outros valores para";
$language["AUTORANK_MAIN_4"] = "aqui";
$language["ACP_BOOTED"]="Usuários Kickados";
$language["ACP_BOOTED_NM"]="Usuário";
$language["ACP_BOOTED_EXP"]="Expira Hora";
$language["ACP_BOOTED_REA"]="Razão do Ban";
$language["ACP_BOOTED_WHO"]="Banido Por";

// --------> modpanel
$language['ACP_MODPANEL']='Staff Panel Configurações';
$language['MODCP_SECTION']='Setor (a seção que vc quer liberar seu mod/admin, é a parte do=xxxx no link):';
$language['MODCP_DESC']='Descrição (se vc usa uma definição de linguagem, a string da linguagem será usada, caso contrário a string que vc escreveu. Ex: vc colocou "ACP_BAN_IP" será mostrado "'.$language['ACP_BAN_IP'].'" ):';
$language['MODCP_URL']='URL (a URL que acessa o setor, {uid} será substituída pelo ID do usuário e {ucode} eg: link para banip é http://localhost/xbtit/index.php?page=admin&user={uid}&code={ucode}&do=category&action=read):';
$language['MODCP_NEWSECTION']='Adicionar Novo Setor';
$language['NO_SECTION_ACCESS']='Você não pode acessar este setor.';
// --------> modpanel



//RULES
$language["ACP_RULES_GROUP"]="Regras de Grupo";
$language["ACP_RULES"]="Regras";



$language["ACP_STICKY_TORRENTS"]="Sticky Config";
$language["STICKY_SETTINGS"]="Sticky Config";
$language["COLOR"]="Cor";
$language["LEVEL_STICKY"]="Quem pode FIXAR torrents? (padrão: Uploader)";


// Torrent Request
$language["TRAV_REQ_SET"] = "Config de Pedidos";
$language["TRAV_REQ_HO"] = "Pedido hack online";
$language["TRAV_REQ_IB"] = "Pedidos no bloco";
$language["TRAV_DUFRAP"] = "Dias até os Pedidos feitos serem deletados.";
$language["TRAV_REQ_PP"] = "Pedidos por página";
$language["TRAV_MILTPR"] = "min ID level para fazer pedidos";
$language["TRAV_ARIS"] = "Anunciar Pedido no shoutbox";
$language["TRAV_MRU"] = "Max Pedidos use";
$language["TRAV_MNOR"] = "Max numero de pedidos";
$language["TRAV_RRFFAR"] = "Premiação de Pedidos ( por atender totalmente ) Config";
$language["TRAV_RRS"] = "Sistema de premiação de Pedidos";
$language["TRAV_RIUOS"] = "Premiação em Uplaod ou SeedBonnus";
$language["TRAV_AIB"] = "Valor em bytes";
$language["TRAV_SBP"] = "Pontos em Seedbonus";
// Torrent Request

$language['XTD_ACP']='XTD Config';

$language["ACP_LOTTERY"]="Loteria";
$language["LOTT_SETTINGS"]="Loteria Config";
$language["EXPIRE_DATE"]="Termina Dia";
$language["EXPIRE_TIME"]="Termina Hora";
$language["EXPIRE_DATE_VIEW"]="(0000-00-00 precisa ser este formato)";
$language["EXPIRE_TIME_VIEW"]="em horas inteiras";
$language["IS_SET"]="é dia e hora corrente)";
$language["NUM_WINNERS"]="Número de Ganhadores";
$language["TICKET_COST"]="Valor a ser pago(por ticket)";
$language["MIN_WIN"]="Minimo valor para ganhar";
$language["LOTTERY_STATUS"]="Loteria Ligada";
$language["VIEW_SELLED"]="Ver Tickts Vendidos";
$language["ACP_SELLED_TICKETS"]="Tickets Vendidos";
$language["NO_TICKET_SOLD"]="Nenhum ticket vendido";
$language["TICKETS"]="tickets";
$language["PURCHASE"]="Comprar";
$language["SOLD_TICKETS"]="Tickets Vendidos";
$language["LOTTERY"]="Loteria";
$language["MAX_BUY"]="Máximo valor por usuário (tickets)";
$language["LOTT_ID"] = "Id";
$language["LOTT_USERNAME"] = "Usuário";
$language["LOTT_NUMBER_OF_TICKETS"] = "Número de tickets";
$language["BACK_TO_LOTTERY"]="Voltar a Loteria";
$language["LOTT_SENDER_ID"]="Sender ID for PM";
$language["ADMIN_SB_BANNED"] = "Shoutbox banned";

$language['tmsg1']="Ticker Message 1";
$language['tmsg2']="Ticker Message 2";
$language['tmsg3']="Ticker Message 3";
$language['tmsg4']="Ticker Message 4";

// Site Offline
$language["ACP_OFFLINE"]="Offline Config";
$language["OFFLINE_SETTING"]="Colocar Site Offline?";
$language["OFFLINE_MESSAGE"]="Mensagem Offline para usuários (max 200 caracteres, apenas admin pode acessar o site offline)";

// Download Ratio Check
$language["SETTING_MIN_DLRATIO"]="Ratio mínimo para baixar torrents";
$language["SETTING_CUSTOM_SETTINGS"]="Config Customizada";
$language["BYPASS_DLCHECK"]="Ignorar Checagem";

// Radio
$language["RAD_SETTINGS"]="Radio Config";
$language['djhead']="Dj List";

// Message Spy
$language["ACP_ISPY"]="Message Spy";
$language["DATE_SENT"]="Data de Envio";

// Sport Betting - Start
$language["SB_SETTINGS"] = "Sport Apostas Config";
$language["SB_MIN_IDL_2_BET"] = "Min id_level para apostar";
$language["SB_FOR_ID"] = "Numero do Fórum para postar";
$language["SB_FOR_USER_ID"] = "ID do membro do forum para postar com";
$language["SB_MAX_BON"] = "Pontos Máximos de Bonus";
// Sport Betting - End

// NEW USER DONATE UPLOAD
$language["SETTINGS_UPLOAD"]="Doação de Itens para Novos Membros.";
$language["VALUE_UPLOAD"]="Entre com o valor e escolha a unidade.";
$language["KB"]="Kb";
$language["MB"]="Mb";
$language["GB"]="Gb";
$language["TB"]="Tb";

// Add new Users in AdminCP
$language["ACP_ADD_USER"]='Adicionar Novo Usuário';
$language["NEW_USER_EMAIL"]='Envie um email para o novo usuário com a senha';
$language["NEW_USER_EMAIL_TEXT"]='
Olá %s,

Você foi adicionado no %s,
Usuário: %s
Senha: %s

Esperamos que você divirta-se conosco.
Saldações
A Staff';

// Torrents Limit
$language["MAX_TORRENTS"] = "Maximum Torrents";

// Client ban
$language['BAN_CLIENT']='Ban Cliente BitTorrent';
$language['REMOVE_CLIENTBAN']='Remover Cliente BitTorrent Ban';
$language['CLIENT_REMOVED']='Este cliente foi removido da lista de bannidos.<br /><br />';
$language['RETURN']='Retornar';
$language['UNBAN_MAIN']='Ao visitar esta página que você está indicando que você deseja remover o BAN do seguinte Cliente:';
$language['CONFIRM_ACTION']='Você tem certeza que quer fazer isso? (você não receberá nenhuma confirmação).';
$language['CLIENT_ALREADY_BANNED']='Este cliente já está bannido!';
$language['ALL_VERSIONS']='Todas versões';
$language['CLIENT_ADDED']='Este cliente foi adicionado a lista de bannidos.<br /><br />';
$language['NEED_A_REASON']='Você precisa colocar uma razão!';
$language['BAN_MAIN']='Ao visitar esta página que você está indicando que você deseja BANNIR o seguinte Cliente:';
$language['BAN_ALL_VERSIONS']='Bannir todas as versões?';
$language['REASON']='Razão';

// Ban Button
$language["ACP_BB"]="Botão de Ban - IP Range";
$language["ACP_BB_USER"]="Botão de Ban - Usuário";
$language["BB_SETTINGS"] = "Botão de Ban Config";
$language["BB_LEVEL"] = "Min Ban Level";
$language["BB_DAYS"] = "Ban Dias";
$language["BB_NONE_YET_1"] = "Aqui";
$language["BB_NONE_YET_2"] = "não";
$language["BB_NONE_YET_3"] = "há";
$language["BB_NONE_YET_4"] = "IP's";
$language["BB_NONE_YET_5"] = "BANNIDOS";
$language["BB_NONE_YET_6"] = "ainda";
$language["BB_NONE_YET_7"] = "!";
$language["BB_USERS"] = "usuários";
$language["BB_NOT_ANYMORE"] = "Não mais";
$language["BB_TEXT_1"] = "Os usuários desta lista estão bannidos pelo Botão de Ban, é uma faixa de IP temporárias e banne do tracker tambem por";
$language["BB_TEXT_2"] = "dias, é temporário pelo risco de bannir outros usuários da mesma faixa de IP, o usuário bannido provavelmente desistirá depois de tentar por algum tempo.";
$language["BB_TEXT_3"] = "Os usuários desta lista estão bannidos pelo Botão de Ban, ficará bannido até alguem o retirar da lista, também esta bannido do traker.";
$language["BB_FIRST_IP"] = "Primeiro IP";
$language["BB_LAST_IP"] = "Ultimo IP";
$language["BB_BAN_ADDED"] = "Ban Adicionado";
$language["BB_BAN_EXPIRE"] = "Ban Expira";
$language["BB_ADDED_BY"] = "Adicionado por";
$language["BB_USER_COMM"] = "User & Comment";
$language["BB_DEL"] = "Deletar";
$language["BB_COMM"] = "Comentário";
$language["BB_IP_BANNED"] = "IP Range Banido";

// Ratio Editor
$language["ACP_RATIO_EDITOR"] = "Editor de Ratio";
$language["RATIO_USERNAME"] = "Usuário";
$language["RATIO_UPLOADED"] = "Enviado";
$language["RATIO_DOWNLOADED"] = "Baixado";
$language["RATIO_INPUT_MEASURE"] = "Selecione a medida da entrada:";
$language["RATIO_BYTES"] = "Bytes";
$language["RATIO_K_BYTES"] = "KBytes";
$language["RATIO_M_BYTES"] = "MBytes";
$language["RATIO_G_BYTES"] = "GBytes";
$language["RATIO_T_BYTES"] = "TBytes";
$language["RATIO_ACTION"] = "Ação:";
$language["RATIO_ADD"] = "Adicionar";
$language["RATIO_REMOVE"] = "Remover";
$language["RATIO_REPLACE"] = "Mudar";
$language["RATIO_HEADER"] = "Update Ratio do Usuário";
$language["RATIO_SUCCES"] = "Sucesso";
$language["RATIO_UPDATE_SUCCES"] = "Você alterou o RATIO do usuário com SUCESSO";

// Duplicate Accounts
$language["DUPLICATES"]="Duplicados";
$language["ERR_USERS_NOT_FOUND"]="Nenhum suário achado!";

// Report High Upload Speed
$language["RHUS_HIGH_UL_SUP"] = "Denúncia de ALTA VELOCIDADE de UL";
$language["RHUS_EN_SYS"] = "Ligar Sistema";
$language["RHUS_DIS"] = "Desligado";
$language["RHUS_REP_FROM"] = "Denúncie velocidade de (KB/s)";
$language["RHUS_REP_TU"] = "Denúncia Veses / Usuário";
$language["RHUS_ONLY_ONCE"] = "apenas uma";
$language["RHUS_NO_LIM"] = "sem limites";

// Twitter Update
$language["TWIT_REG"] = "Autorizar Post no Twitter";
$language["TWIT_AUTH_1"] = "Para liberar o tracker a fazer POSTS em seu tYwiter você precisa";
$language["TWIT_AUTH_2"] = "clickar aqui";
$language["TWIT_AUTH_3"] = "e logar na sua conta do Twitter. E você vai ver parecido com isso";
$language["TWIT_AUTH_4"] = "Você precisa colocar agora o número do PIN que você recebeu dentro da caixa abaixo e clicar no botão \"Submit\" ";
$language["TWIT_SUBMIT"] = "Enviar";
$language["TWIT_BAD_PIN"] = "Numero PIN errado, o valor colocado deve ser numérico e conter 7 caracteres. Confira os dados e tente novamente.";
$language["TWIT_REG_MISS_1"] = "Código de autorização faltando, por favor";
$language["TWIT_REG_MISS_2"] = "reinicie o processo";
$language["TWIT_SUCCESS"] = "Autorização de Twitter aplicado, agora seus novos torrets serão anunciados em seu Twitter automaticamente.";
$language["TWIT_CURL_REQ"] = "<span style='color:red'><b>(cURL extension required to enable)</b></span>";

// Torrent Moderation
$language["ACP_ADD_WARN"]="Razões de Moderação de Torrent";
$language["WARN_TITLE"]="Título da Razão";
$language["WARN_TEXT"]="Explicação da Razão";
$language["WARN_ADD_REASON"]="Adicionar NOVA Razão";
$language["TRUSTED"]="Aprovado";
$language["TRUSTED_MODERATION"]="Moderação de Aprovação";
$language["TORRENT_STATUS"]="Status do Torrent";
$language["TORRENT_MODERATION"]="Moderação";
$language["MODERATE_TORRENT"] = "Moderar";
$language["MODERATE_STATUS_OK"] = "Ok";
$language["MODERATE_STATUS_BAD"] = "Ruin";
$language["MODERATE_STATUS_UN"] = "Não Moderado";
$language["FRM_CONFIRM_VALIDATE"] = "Confirmar Validação";
$language["MODERATE_PANEL"] = "CP de Moderação";


?>