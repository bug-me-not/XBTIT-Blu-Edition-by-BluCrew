-- Delete the default permission masks and replace with new ones mirroring the tracker ranks
TRUNCATE TABLE `{$ipb_prefix}forum_perms`; 
INSERT INTO `{$ipb_prefix}forum_perms` (`perm_id`, `perm_name`) VALUES
(1, 'guest'),
(2, 'validating'),
(3, 'Members'),
(4, 'Uploader'),
(5, 'V.I.P.'),
(6, 'Moderator'),
(7, 'Administrator'),
(8, 'Owner');
TRUNCATE TABLE `{$ipb_prefix}groups`; 
INSERT INTO `{$ipb_prefix}groups` (`g_id`, `g_view_board`, `g_mem_info`, `g_other_topics`, `g_use_search`, `g_edit_profile`, `g_post_new_topics`, `g_reply_own_topics`, `g_reply_other_topics`, `g_edit_posts`, `g_delete_own_posts`, `g_open_close_posts`, `g_delete_own_topics`, `g_post_polls`, `g_vote_polls`, `g_use_pm`, `g_is_supmod`, `g_access_cp`, `g_title`, `g_append_edit`, `g_access_offline`, `g_avoid_q`, `g_avoid_flood`, `g_icon`, `g_attach_max`, `prefix`, `suffix`, `g_max_messages`, `g_max_mass_pm`, `g_search_flood`, `g_edit_cutoff`, `g_promotion`, `g_hide_from_list`, `g_post_closed`, `g_perm_id`, `g_photo_max_vars`, `g_dohtml`, `g_edit_topic`, `g_bypass_badwords`, `g_can_msg_attach`, `g_attach_per_post`, `g_topic_rate_setting`, `g_dname_changes`, `g_dname_date`, `g_mod_preview`, `g_rep_max_positive`, `g_rep_max_negative`, `g_signature_limits`, `g_can_add_friends`, `g_hide_online_list`, `g_bitoptions`, `g_pm_perday`, `g_mod_post_unit`, `g_ppd_limit`, `g_ppd_unit`, `g_displayname_unit`, `g_sig_unit`, `g_pm_flood_mins`, `g_max_notifications`, `g_max_bgimg_upload`) VALUES 
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 'guest', 1, 0, 0, 0, '', 500, '', '', 50, 5, 0, 0, '-1&-1', 0, 0, '1', '50:150:150', 0, 1, 0, 0, 0, 1, 3, 30, 0, 10, 1, '0:::::', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'validating', 1, 0, 0, 0, '', 0, '', '', 50, 0, 20, 0, '-1&-1', 0, 0, '2', '50:150:150', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0:::::', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 'Members', 1, 0, 0, 0, '', 500, '', '', 50, 5, 0, 0, '-1&-1', 0, 0, '3', '50:150:150', 0, 1, 0, 0, 0, 1, 3, 30, 0, 10, 1, '0:::::', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 'Uploader', 1, 0, 0, 0, '', 500, '', '', 50, 5, 0, 0, '-1&-1', 0, 0, '4', '50:150:150', 0, 1, 0, 0, 0, 1, 3, 30, 0, 10, 1, '0:::::', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 'V.I.P.', 1, 0, 0, 0, '', 500, '', '', 50, 5, 0, 0, '-1&-1', 0, 0, '5', '50:150:150', 0, 1, 0, 0, 0, 1, 3, 30, 0, 10, 1, '0:::::', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 'Moderator', 1, 0, 0, 0, 'public/style_extra/team_icons/staff.png', 500, '', '', 50, 5, 0, 0, '-1&-1', 0, 0, '6', '50:150:150', 0, 1, 0, 0, 0, 1, 3, 30, 0, 100, 10, '0:::::', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Administrator', 1, 1, 1, 1, 'public/style_extra/team_icons/admin.png', 0, '<span style=\'color:red\'>', '</span>', 50, 6, 20, 5, '-1&-1', 0, 1, '7', '500:170:240', 1, 1, 1, 1, 0, 2, 3, 30, 0, 100, 100, '0:::::', 1, 0, 1048512, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Owner', 1, 1, 1, 1, 'public/style_extra/team_icons/admin.png', 0, '<span style=\'color:red\'>', '</span>', 50, 6, 20, 5, '-1&-1', 0, 1, '8', '500:170:240', 1, 1, 1, 1, 0, 2, 3, 30, 0, 100, 100, '0:::::', 1, 0, 1048512, 0, 0, 0, 0, 0, 0, 0, 0, 0);
UPDATE `{$ipb_prefix}permission_index` SET `perm_view`='*', `perm_2`='',`perm_3`='', `perm_4`='',`perm_5`='',`perm_6`='',`perm_7`='' WHERE `app`='forums' AND `perm_type`='forum' AND `perm_type_id`=1;
UPDATE `{$ipb_prefix}permission_index` SET `perm_view`='*', `perm_2`='*',`perm_3`=',3,4,5,6,7,8,', `perm_4`=',3,4,5,6,7,8,',`perm_5`=',3,4,5,6,7,8,',`perm_6`=',3,4,5,6,7,8,',`perm_7`='' WHERE `app`='forums' AND `perm_type`='forum' AND `perm_type_id`=2;
UPDATE `{$ipb_prefix}permission_index` SET `perm_view`='*', `perm_2`=',3,4,5,6,7,8,', `perm_3`=',6,7,8,', `perm_4`='', `perm_5`='', `perm_6`='', `perm_7`='' WHERE `app`='calendar' AND `perm_type`='calendar';
UPDATE `{$ipb_prefix}cache_store` SET `cs_value`='a:0:{}', `cs_updated`=0 WHERE `cs_key`='group_cache';
TRUNCATE TABLE `{$ipb_prefix}members`; 
TRUNCATE TABLE `{$ipb_prefix}pfields_content`; 
TRUNCATE TABLE `{$ipb_prefix}profile_portal`;
