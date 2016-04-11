<?php
// Language File for Sypex Dumper 2
$LNG = array(

// Information about the language file
'ver'				=> 20004, // Dumper version
'translated'		=> 'Tárcio Zemel <tarciozemel@gmail.com> (http://desenvolvimentoparaweb.com)', // Contacts
'name'				=> 'Português Brasileiro ', // Lang name

// Toolbar
'tbar_backup'		=> 'Exportar',
'tbar_restore'		=> 'Importar', 
'tbar_files'		=> 'Arquivos',
'tbar_services'		=> 'Serviços',
'tbar_options'		=> 'Opções',
'tbar_createdb'		=> 'Criar DB',
'tbar_connects'		=> 'Conexão',
'tbar_exit'			=> 'Sair',

// Names of objects in the tree
'obj_tables'		=> 'Tabelas',
'obj_views'			=> 'Views',
'obj_procs'			=> 'Procedures',
'obj_funcs'			=> 'Funções',
'obj_trigs'			=> 'Triggers',
'obj_events'		=> 'Eventos',

// Export
'zip_max'			=> 'max',
'zip_min'			=> 'min',
'zip_none'			=> 'Descomprimido',
'default'			=> 'padrão',
'combo_db'			=> 'Database (Schema):', 
'combo_charset'		=> 'Charset:', 
'combo_zip'			=> 'Compressão:', 
'combo_comments'	=> 'Comentário:',
'del_legend'		=> 'Autodeletar se:',
'del_date'			=> 'idade dos arquivos maior que %s dias',
'del_count'			=> 'número de arquivos maior que %s',
'tree'				=> 'Selecione objetos:',
'no_saved'			=> 'Jobs não salvos',
'btn_save'			=> 'Salvar',
'btn_exec'			=> 'Executar',

// Import	
'combo_file'		=> 'Arquivo:',
'combo_strategy'	=> 'Restaurar strategy:',
'ext_legend'		=> 'Opções extendidas:',
'correct'			=> 'Correção de charset',
'autoinc'			=> 'Resetar AUTO_INCREMENT',

// Log
'status_current'	=> 'Status atual:',
'status_total'		=> 'Status total:',
'time_elapsed'		=> 'Decorrido:',
'time_left'			=> 'Restante:',
'btn_stop'			=> 'Parar',
'btn_pause'			=> 'Pausar',
'btn_resume'		=> 'Continuar',
'btn_again'			=> 'Repetir',
'btn_clear'			=> 'Limpar log',

// Files
'btn_delete'		=> 'Deletar',
'btn_download'		=> 'Download',
'btn_open'			=> 'Abrir',

// Services
'opt_check'			=> 'Opções de Check:',
'opt_repair'		=> 'Opções de Reparar:',
'btn_delete_db'		=> 'Deletar DB',
'btn_check'			=> 'Check',
'btn_repair'		=> 'Reparar',
'btn_analyze'		=> 'Analizar',
'btn_optimize'		=> 'Otimizar',

// Options
'cfg_legend'		=> 'Configurações básicas:',
'cfg_time_web'		=> 'Limite de tempo web (segundos):',
'cfg_time_cron'		=> 'Limite de tempo cron (segundos):',
'cfg_backup_path'	=> 'Caminho para a pasta de backup:',
'cfg_backup_url'	=> 'URL da pasta de backup:',
'cfg_globstat'		=> 'Estatísticas globais:',
'cfg_extended'		=> 'Configurações avançadas:',
'cfg_charsets'		=> 'Filtro de charset:',
'cfg_only_create'	=> 'Criar apenas tipos:',
'cfg_auth'			=> 'Cadeia de autorização:',
'cfg_confirm'		=> 'Pedir confirmação para:',
'cfg_conf_import'	=> 'importar',
'cfg_conf_file'		=> 'deletar arquivo',
'cfg_conf_db'		=> 'deletar database',

// Connection
'con_header'		=> 'Configurações de Conexão',
'connect'			=> 'Conexão',
'my_host'			=> 'Servidor:',
'my_port'			=> 'Porta:',
'my_user'			=> 'Usuário:',
'my_pass'			=> 'Senha:',
'my_pass_hidden'	=> 'Senha não é mostrada',
'my_comp'			=> 'Protocolo de compressão',
'my_db'				=> 'Databases:',
'btn_cancel'		=> 'Cancelar',

// Save Job
'sj_header'			=> 'Salvar trabalho',
'sj_job'			=> 'Trabalho',
'sj_name'			=> 'Nome (eng.):',
'sj_title'			=> 'Descrição:',

// Create DB
'cdb_header'		=> 'Criar novo database',
'cdb_detail'		=> 'Detalhes',
'cdb_name'			=> 'Nome:',
'combo_collate'		=> 'Collation:',
'btn_create'		=> 'Criar',

// Authorization
'js_required'		=> 'JavaScript deve estar habilitado',
'auth'				=> 'Autorização',
'auth_user'			=> 'Usuário:',
'auth_remember'		=> 'lembrar',
'btn_enter'			=> 'Entrar',
'btn_details'		=> 'Detalhes',

// Log messages
'not_found_rtl'		=> 'arquivo RTL não existe',
'backup_begin'		=> 'Começar a exportar DB `%s`',
'backup_TC'			=> 'Exportar tabela `%s`',
'backup_VI'			=> 'Exportar view `%s`',
'backup_PR'			=> 'Exportar procedure `%s`',
'backup_FU'			=> 'Exportar função `%s`',
'backup_EV'			=> 'Exportar evento `%s`',
'backup_TR'			=> 'Exportar trigger `%s`',
'continue_from'		=> 'das posições %s',
'backup_end'		=> 'Exportação do database `%s` terminada.',
'autodelete'		=> 'Autodeletar arquivos antigos:',
'del_by_date'		=> '- `%s` - deletar (por data)',
'del_by_count'		=> '- `%s` - deletar (por contagem)',
'del_fail'			=> '- `%s` - falha na deleção',
'del_nothing'		=> '- não há arquivos para deletar',
'set_names'			=> 'Especificar encoding da conexão: `%s`',
'restore_begin'		=> 'Começar importação do DB `%s`',
'restore_TC'		=> 'Importar tabela `%s`',
'restore_VI'		=> 'Importar view `%s`',
'restore_PR'		=> 'Importar procedure `%s`',
'restore_FU'		=> 'Importar função `%s`',
'restore_EV'		=> 'Importar evento `%s`',
'restore_TR'		=> 'Importar trigger `%s`',
'restore_keys'		=> 'Habilitar indexes',
'restore_end'		=> 'Restauração do backup do DB `%s` concluída.',
'stop_1'			=> 'Execução interrompida pelo usuário',
'stop_2'			=> 'Execução parada pelo usuário',
'stop_3'			=> 'Execução parada pelo timer',
'stop_4'			=> 'Execução parada pelo timeout',
'stop_5'			=> 'Execução interrompida devido a um erro',
'job_done'			=> 'Job finalizado',
'file_size'			=> 'Tamanho do arquivo',
'job_time'			=> 'Tempo gasto',
'seconds'			=> 'segundos',
'job_freeze'		=> 'O processo não é atualizado há mais de 30 segundos. Clique em Continuar',
'stop_job'			=> 'Parar requisição',

// For JS
'js' => array(
	
	// Tabs names
	'backup'		=> 'Exportar database (schema)',
	'restore'		=> 'Importar database (schema)',
	'log'			=> 'Log',
	'result'		=> 'Resultados',
	'files'			=> 'Arquivos',
	'services'		=> 'Serviços',
	'options'		=> 'Opções',

	// Tables header
	'dt'			=> 'Data/tempo',
	'action'		=> 'Ação',
	'db'			=> 'Database',
	'type'			=> 'Tipo',
	'tab'			=> 'Abas',
	'records'		=> 'Registros',
	'size'			=> 'Tamanho',
	'comment'		=> 'Comentários',

	// AJAX Status
	'load'			=> 'Carregando',
	'run'			=> 'Executando...',
	'sdb'			=> 'Criar novo database',
	'sc'			=> 'Salvar conexão',
	'sj'			=> 'Salvar job',
	'so'			=> 'Salvar opções',

	// Messages
	'pro'			=> 'Opção disponível apenas na versão Pro',
	'err_fopen'		=> 'Não é possível abrir o arquivo',
	'err_sxd2'		=> 'Ver conteúdo do arquivo disponível apenas para os arquivos criados por sypex Dumper 2',
	'err_empty_db'	=> 'Database vazia',
	'fdc'			=> 'Confirma a exclusão do(s) arquivo(s)?',
	'ddc'			=> 'Confirma a exclusão do(s) database(s)?',
	'fic'			=> 'Confirma a importação do(s) arquivo(s)?',

	// Sizes
	'sizes'			=> array('B', 'KB', 'MB', 'GB'),
)
);
?>
