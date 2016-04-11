<?php
//中文翻译:ziggear 
//你可以自由修改和发布，但不要删除注释和作者信息。

// Sidebar Views (侧边栏文字)
$language['ACP_BAN_IP']='禁止IP';
$language['ACP_FORUM']='论坛设置';
$language['ACP_USER_GROUP']='用户组设置';
$language['ACP_STYLES']='主题设置';
$language['ACP_LANGUAGES']='语言设置';
$language['ACP_CATEGORIES']='分类设置';
$language['ACP_TRACKER_SETTINGS']='Tracker设置';
$language['ACP_OPTIMIZE_DB']='定制数据库';
$language['ACP_CENSORED']='词语过滤设置';
$language['ACP_DBUTILS']='数据库设置';
$language['ACP_HACKS']='插件管理';
$language['ACP_HACKS_CONFIG']='插件设置';
$language['ACP_MODULES']='模板管理';
$language['ACP_MODULES_CONFIG']='模版设置';
$language['ACP_MASSPM']='站内信群发';
$language['ACP_PRUNE_TORRENTS']='淘汰无效种子';
$language['ACP_PRUNE_USERS']='淘汰无效用户';
$language['ACP_SITE_LOG']='查看站点日志';
$language['ACP_SEARCH_DIFF']='Search Diff.';
$language['ACP_BLOCKS']='功能模块设置';
$language['ACP_POLLS']='调查设置';
$language['ACP_MENU']='管理面板';
$language['ACP_FRONTEND']='内容管理';
$language['ACP_USERS_TOOLS']='用户管理';
$language['ACP_TORRENTS_TOOLS']='种子管理';
$language['ACP_OTHER_TOOLS']='其他管理';
$language['ACP_MYSQL_STATS']='MySql 状态';
$language['XBTT_BACKEND']='xbtt 选项';
$language['XBTT_USE']='使用 <a href="http://xbtt.sourceforge.net/tracker/" target="_blank">xbtt</a> 作为备用服务器?';
$language['XBTT_URL']='xbtt 的url范例 http://localhost:2710';
$language['GENERAL_SETTINGS']='Tracker基本设定';
$language['TRACKER_NAME']='站点名称';
$language['TRACKER_BASEURL']='站点URL (不需要url结尾处的 /)';
$language['TRACKER_ANNOUNCE']='本站的 Announce URL(每行一条url)'.($XBTT_USE?'<br />'."\n".'<span style="color:#FF0000; font-weight: bold;">请详细检查announce url是否正确, 你已启用 xbtt 备用服务器...</span>':'');
$language['TRACKER_EMAIL']='Tracker/站长 email';
$language['TORRENT_FOLDER']='种子文件夹';
$language['ALLOW_EXTERNAL']='允许外部种子';
$language['ALLOW_GZIP']='启用GZIP';
$language['ALLOW_DEBUG']='在页脚显示调试信息';
$language['ALLOW_DHT']='禁用 DHT (种子中的私有标志)<br />'."\n".'将会应用在之后上传的种子中';
$language['ALLOW_LIVESTATS']='启用实时状态监测 (注意:可能会增加服务器负载!)';
$language['ALLOW_SITELOG']='启用基本站点日志 (记录用户/种子操作)';
$language['ALLOW_HISTORY']='启用历史记录 (用户/种子)';
$language['ALLOW_PRIVATE_ANNOUNCE']='私有tracker服务器(PT站请勾选)';
$language['ALLOW_PRIVATE_SCRAPE']='私有的Scrape'; //意义不明确……
$language['SHOW_UPLOADER']='显示贡献者昵称';
$language['USE_POPUP']='使用弹窗来显示种子详情/上传者';
$language['DEFAULT_LANGUAGE']='默认语言';
$language['DEFAULT_CHARSET']='默认字符集<br />'."\n".'(推荐设为GB2312)';
$language['DEFAULT_STYLE']='默认风格';
$language['MAX_USERS']='最大用户数 (数字, 0 为不限)';
$language['MAX_TORRENTS_PER_PAGE']='每页显示种子数';
$language['SPECIFIC_SETTINGS']='Tracker详细设定';
$language['SETTING_INTERVAL_SANITY']='完整性检查间隔 (秒, 0 为禁用)<br />建议设为 1800 (30分钟)';
$language['SETTING_INTERVAL_EXTERNAL']='外部更新间隔 (秒, 0 为禁用)<br />请依外部种子的数量调整';
$language['SETTING_INTERVAL_MAX_REANNOUNCE']='最大reannounce间隔 (秒)';//此处不翻译reannounce
$language['SETTING_INTERVAL_MIN_REANNOUNCE']='最小reannounce间隔 (秒)';
$language['SETTING_MAX_PEERS']='最大上传者请求数 (数字)';
$language['SETTING_DYNAMIC']='允许动态种子 (不建议使用)';
$language['SETTING_NAT_CHECK']='NAT 检查';
$language['SETTING_PERSISTENT_DB']='保持数据库连接 (不建议使用)';//原文为“Persistent connections (Database, not recommended)”
$language['SETTING_OVERRIDE_IP']='允许用户重定向到检测的IP';
$language['SETTING_CALCULATE_SPEED']='计算下载速度和已下载字节数';
$language['SETTING_PEER_CACHING']='表缓存 (可能会稍微增加服务器负担)';
$language['SETTING_SEEDS_PID']='同一PID允许有的最大做种者人数';
$language['SETTING_LEECHERS_PID']='同一PID允许有的最大下载者人数';
$language['SETTING_VALIDATION']='验证方式';//或为“验证模式”
$language['SETTING_CAPTCHA']='安全注册(使用验证码, 需要GD和Freetype库)';
$language['SETTING_FORUM']='论坛链接, 可以是:<br /><li>填 <font color="#FF0000">internal</font> 或留空以使用tracker自带论坛</li><li>填 <font color="#FF0000">smf</font> 连接 <a target="_new" href="http://www.simplemachines.org">Simple Machines Forum</a></li><li>你自己的论坛解决方案 (在此填上url)</li>';
$language['BLOCKS_SETTING']='主页设定';
$language['SETTING_CLOCK']='时钟格式';
$language['SETTING_FORUMBLOCK']='论坛模块显示';//原文“Forum Block Type”，为了通顺，不直译。
$language['SETTING_NUM_NEWS']='显示最新公告条目 (数字)';
$language['SETTING_NUM_POSTS']='显示论坛主题条目 (数字)';
$language['SETTING_NUM_LASTTORRENTS']='显示最新种子条目 (数字)';
$language['SETTING_NUM_TOPTORRENTS']='显示最受欢迎种子条目 (数字)';
$language['CLOCK_ANALOG']='指针';//"Analog"
$language['CLOCK_DIGITAL']='数字';//"Digital"
$language['FORUMBLOCK_POSTS']='最新回复';
$language['FORUMBLOCK_TOPICS']='最后被回复的主题';
$language['CONFIG_SAVED']='设置都已被正确保存!';
$language['CACHE_SITE']='缓存更新间隔 (秒, 0 为禁用)';
$language['ALL_FIELDS_REQUIRED']='所有信息都需要填上!';
$language['SETTING_CUT_LONG_NAME']='当种子名称超过x个字符后切除多出的 (0 为不限制)';
$language['MAILER_SETTINGS']='邮件设定';
$language['SETTING_MAIL_TYPE']='邮件发送类型';
$language['SETTING_SMTP_SERVER']='SMTP服务器';
$language['SETTING_SMTP_PORT']='SMTP端口';
$language['SETTING_SMTP_USERNAME']='SMTP用户名';
$language['SETTING_SMTP_PASSWORD']='SMTP密码';
$language['SETTING_SMTP_PASSWORD_REPEAT']='重复SMTP密码';
$language['XBTT_TABLES_ERROR']='你需要导入 xbtt 的数据表 (请查阅 xbtt 安装指南) 到你的数据库中这样 xbtt 才能作为备用服务器!';
$language['XBTT_URL_ERROR']='xbtt 基本 url 已被指派!';

// BAN FORM (禁止规则)
$language['BAN_NOTE']='在禁止IP面板, 你可以查看以禁止的IP段和设置新的禁止IP段.<br />'."\n".'你必须输入从起始IP到终止IP的IP间隔.';
$language['BAN_NOIP']='目前没有禁止的IP段';
$language['BAN_FIRSTIP']='起始IP';
$language['BAN_LASTIP']='终止IP';
$language['BAN_COMMENTS']='备注';
$language['BAN_REMOVE']='删除';
$language['BAN_BY']='操作人';//禁止IP的人
$language['BAN_ADDED']='日期';
$language['BAN_INSERT']='插入新的禁止IP段';
$language['BAN_IP_ERROR']='非法IP地址.';
$language['BAN_NO_IP_WRITE']='抱歉, 你没有填上IP地址!';
$language['BAN_DELETED']='禁止的IP段已从数据库中删除.<br />'."\n".'<br />'."\n".'<a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=banip&amp;action=read">返回\"禁止IP\"面板</a>';

// LANGUAGES (语言选项)
$language['LANGUAGE_SETTINGS']='语言设置';
$language['LANGUAGE']='语言';
$language['LANGUAGE_ADD']='导入语言包';
$language['LANGUAGE_SAVED']='恭喜, 语言设置已修改';

// STYLES (风格选项)
$language['STYLE_SETTINGS']='主题设置';
$language['STYLE_EDIT']='编辑主题';
$language['STYLE_ADD']='导入新主题';
$language['STYLE_NAME']='主题名称';
$language['STYLE_URL']='主题 URL';
$language['STYLE_FOLDER']='选择主题包 ';//原为“Style&rsquo;s folder” 在安装主题页面，翻译为“选择主题包"较合适
$language['STYLE_NOTE']='在主题设置中你可以管理你的主题, 需要增加主题, 你需要先将文件夹上传到ftp空间对应的目录.';

// CATEGORIES (目录设置)
$language['CATEGORY_SETTINGS']='分类设置';
$language['CATEGORY_IMAGE']='分类图片';
$language['CATEGORY_ADD']='添加新分类';
$language['CATEGORY_SORT_INDEX']='分类序号';//原文“Sort Index”不直译
$language['CATEGORY_FULL']='分类';
$language['CATEGORY_EDIT']='编辑分类';
$language['CATEGORY_SUB']='上级分类';//“Sub-Category”本该是“子类”，而其实是“上级分类”
$language['CATEGORY_NAME']='分类';

// CENSORED (审查词汇)
$language['CENSORED_NOTE']='<b>每行放置一个</b>你需要过滤的词 (这个词将会被 *censored* 替换)';
$language['CENSORED_EDIT']='编辑词语过滤';

// BLOCKS (功能模块)
$language['BLOCKS_SETTINGS']='功能模块设置';
$language['ENABLED']='可用';
$language['ORDER']='定制';//原文为“Order”
$language['BLOCK_NAME']='模块名称';
$language['BLOCK_POSITION']='位置';
$language['BLOCK_TITLE']='语言标记 (将显示为翻译之后的标题)';
$language['BLOCK_USE_CACHE']='为此模块缓存?';
$language['ERR_BLOCK_NAME']='你必须在下拉菜单中选择一个可用的文件!';
$language['BLOCK_ADD_NEW']='增加新模块';
// POLLS (more in lang_polls.php) (调查设置 详细设置在lang_polls.php)
$language['POLLS_SETTINGS']='调查设置';
$language['POLLID']='调查ID';
$language['INSERT_NEW_POLL']='增加新调查';
$language['CANT_FIND_POLL']='无法找到此调查';
$language['ADD_NEW_POLL']='新调查';//“Add Poll”
// GROUPS (用户组)
$language['USER_GROUPS']='用户组设置 (点击组名以编辑)';
$language['VIEW_EDIT_DEL']='查看/修改/删除';
$language['CANT_DELETE_GROUP']='此 等级/用户组 无法删除!';
$language['GROUP_NAME']='用户组名称';
$language['GROUP_VIEW_NEWS']='查看公告';
$language['GROUP_VIEW_FORUM']='论坛';
$language['GROUP_EDIT_FORUM']='修改论坛';
$language['GROUP_BASE_LEVEL']='选择用户组模板';
$language['GROUP_ERR_BASE_SEL']='选择用户组模板错误!';
$language['GROUP_DELETE_NEWS']='删除公告';
$language['GROUP_PCOLOR']='前缀色 (例如 ';
$language['GROUP_SCOLOR']='后缀色 (例如 ';
$language['GROUP_VIEW_TORR']='查看种子';
$language['GROUP_EDIT_TORR']='修改种子';
$language['GROUP_VIEW_USERS']='查看用户';
$language['GROUP_DELETE_TORR']='删除种子';
$language['GROUP_EDIT_USERS']='修改用户';
$language['GROUP_DOWNLOAD']='下载权限';
$language['GROUP_DELETE_USERS']='删除用户';
$language['GROUP_DELETE_FORUM']='删除论坛';
$language['GROUP_GO_CP']='可进入管理面板';
$language['GROUP_EDIT_NEWS']='修改公告';
$language['GROUP_ADD_NEW']='增加新用户组';
$language['GROUP_UPLOAD']='上传权限';
$language['GROUP_WT']='用户组排队时间 <1';
$language['GROUP_EDIT_GROUP']='编辑用户组权限';
$language['GROUP_VIEW']='查看';
$language['GROUP_EDIT']='修改';
$language['GROUP_DELETE']='删除';
$language['INSERT_USER_GROUP']='增加新用户组';
$language['ERR_CANT_FIND_GROUP']='无法找到此组!';
$language['GROUP_DELETED']='用户组已被删除!';
// MASS PM (站内信群发)
$language['USERS_FOUND']='已找到的用户';//"users found"
$language['USERS_PMED']='已群发的用户';//“users PMed”
$language['WHO_PM']='要把站内信发送给谁?';
$language['MASS_SENT']='站内信已群发!';
$language['MASS_PM']='站内信群发';
$language['MASS_PM_ERROR']='请在提交之前填上需要群发的内容!';
$language['RATIO_ONLY']='仅发给这个比率的用户';
$language['RATIO_GREAT']='发给比率大于此值的用户';
$language['RATIO_LOW']='发给比率小于此值的用户';
$language['RATIO_FROM']='发件人';
$language['RATIO_TO']='收件人';
$language['MASSPM_INFO']='信息';
// PRUNE USERS (淘汰用户)
$language['PRUNE_USERS_PRUNED']='已被淘汰的用户';
$language['PRUNE_USERS']='淘汰用户';//“Prune”译为淘汰应该比较合适
$language['PRUNE_USERS_INFO']='设置系统认为是"无效用户"的离开天数 (连续未上线天数或注册后未验证天数)';
// SEARCH DIFF
$language['SEARCH_DIFF']='Search Diff.';//一直没想好这个怎么翻译
$language['SEARCH_DIFF_MESSAGE']='信息';//message
$language['DIFFERENCE']='差异';//“Difference”
$language['SEARCH_DIFF_CHANGE_GROUP']='更改用户组';
// PRUNE TORRENTS (淘汰种子)
$language['PRUNE_TORRENTS_PRUNED']='已被淘汰的种子';
$language['PRUNE_TORRENTS']='淘汰无效种子';
$language['PRUNE_TORRENTS_INFO']='设置系统认为是"无效种子"的失效天数';
$language['LEECHERS']='下载者';
$language['SEEDS']='做种者';

// DBUTILS
$language['DBUTILS_TABLENAME']='表名';
$language['DBUTILS_RECORDS']='记录数';
$language['DBUTILS_DATALENGTH']='数据大小';
$language['DBUTILS_OVERHEAD']='溢出';//“Overhead”暂时译为“溢出”
$language['DBUTILS_REPAIR']='修复';
$language['DBUTILS_OPTIMIZE']='优化';
$language['DBUTILS_ANALYSE']='分析';
$language['DBUTILS_CHECK']='检查';
$language['DBUTILS_DELETE']='删除';
$language['DBUTILS_OPERATION']='操作';
$language['DBUTILS_INFO']='信息';
$language['DBUTILS_STATUS']='状态';
$language['DBUTILS_TABLES']='数据表';

// MYSQL STATUS 
$language['MYSQL_STATUS']='MySQL 状态';

// SITE LOG
$language['SITE_LOG']='站点日志';

// FORUMS (论坛设置)
$language['FORUM_MIN_CREATE']='可创建主题的最小用户组';
$language['FORUM_MIN_WRITE']='可回帖的最小用户组';
$language['FORUM_MIN_READ']='可看帖的最小用户组';
$language['FORUM_SETTINGS']='论坛设置';
$language['FORUM_EDIT']='编辑版面';
$language['FORUM_ADD_NEW']='创建版面';
$language['FORUM_PARENT']='上级版面';
$language['FORUM_SORRY_PARENT']='(抱歉, 无法设置上级版面, 此版面已经是上级版面)';
$language['FORUM_PRUNE_1']='版面中存在主题/帖子!<br />你将会失去所有数据...<br />';
$language['FORUM_PRUNE_2']='如果你确定删除这些版面';
$language['FORUM_PRUNE_3']='否则返回.';
$language['FORUM_ERR_CANNOT_DELETE_PARENT']='不能删除有子版面的版面, 如果确实要删除, 请将子版面移到其它位置';

// MODULES (模版设置)
$language['ADD_NEW_MODULE']='添加新模板';
$language['TYPE']='类型';
$language['DATE_CHANGED']='数据已修改';//这两个翻译存在问题
$language['DATE_CREATED']='数据已创建';
$language['ACTIVE_MODULES']='活动模板: ';
$language['NOT_ACTIVE_MODULES']='不活动模板: ';
$language['TOTAL_MODULES']='全部模板: ';
$language['DEACTIVATE']='反激活';//“Deactivate”
$language['ACTIVATE']='激活';
$language['STAFF']='站务组';
$language['MISC']='杂项';//“Miscellaneous”
$language['TORRENT']='种子';
$language['STYLE']='主题';
$language['ID_MODULE']='ID';

// HACKS (插件)
$language['HACK_TITLE']='插件';//“Title”
$language['HACK_VERSION']='当前版本';
$language['HACK_AUTHOR']='作者';
$language['HACK_ADDED']='添加日期';
$language['HACK_NONE']='暂时没有安装插件...';
$language['HACK_ADD_NEW']='添加新插件';
$language['HACK_SELECT']='选择';
$language['HACK_STATUS']='状态';
$language['HACK_INSTALL']='安装';
$language['HACK_UNINSTALL']='卸载';
$language['HACK_INSTALLED_OK']='成功安装插件!<br />'."\n".'查看当前插件信息请 <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">返回插件设置面板</a>';
$language['HACK_BAD_ID']='用此ID读取插件信息出错.';
$language['HACK_UNINSTALLED_OK']='成功卸载插件!<br />'."\n".'查看当前插件信息请 <a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=read">返回插件设置面板</a>';
$language['HACK_OPERATION']='操作';//“Operation”
$language['HACK_SOLUTION']='方案';//“Solution"

// added rev 520
$language['HACK_WHY_FTP']='一些插件需要修改的文件不可写入. <br />'."\n".'需要登入FTP使用chmod命令或直接创建文件和文件夹. <br />'."\n".'为了安装此插件, 你的FTP信息将会被临时缓存下来.';
$language['HACK_FTP_SERVER']='FTP 服务器';
$language['HACK_FTP_PORT']='FTP 端口';
$language['HACK_FTP_USERNAME']='FTP 用户名';
$language['HACK_FTP_PASSWORD']='FTP 密码';
$language['HACK_FTP_BASEDIR']='xbtit的本地路径 (FTP服务器的根目录)';

// USERS TOOLS (用户工具)
$language['USER_NOT_DELETE']='无法删除访客或删除你自己!';
$language['USER_NOT_EDIT']='无法编辑访客或编辑你自己!';
$language['USER_NOT_DELETE_HIGHER']='无法删除等级比你高的用户.';
$language['USER_NOT_EDIT_HIGHER']='无法编辑等级比你高的用户.';
$language['USER_NO_CHANGE']='没有作出更改.';

//Manual Hack Install (手动插件安装)
$language['MHI_VIEW_INSRUCT'] = '查看手动插件安装指南?';
$language['MHI_MAN_INSRUCT_FOR'] = '手动插件安装指南 - ';
$language['MHI_RUN_QUERY'] = '在phpMyAdmin执行以下SQL语句';
$language['MHI_IN'] = '在';//"In"
$language['MHI_ALSO_IN'] = '也在';
$language['MHI_FIND_THIS'] = '找出此项';//"find this"
$language['MHI_ADD_THIS'] = '添加此项';//"Add this"
$language['MHI_IT'] = '这个';//"it"
$language['MHI_REPLACE'] = '替换为';//"Replace with"
$language['MHI_COPY'] = '复制';
$language['MHI_AS'] = '为';//“as”
?>