<?php
/*
 * @package AJAX_Chat_Commands
 * @author Jared Williams
 * @copyright (c) Jared Williams 2013
 * @link https://www.jaredwilliams.com.au
 */
 
$textParts[0] = strtolower($textParts[0]);

for ($i=0; $i<99; $i++) {
	if (empty($textParts[$i]))		$textParts[$i] = '';
}


switch($textParts[0]) {
	case '!like':
		if ($textParts[1] && $textParts[2]) {
			$this->insertChatBotMessage($this->getChannel(),"I'm liking your ".$textParts[1]." idea, ".$textParts[2]."!");
		} elseif ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"I'm liking this ".$textParts[1]." idea!");
		} else {
			$this->insertChatBotMessage($this->getChannel(),"I'm liking this idea!");
		}
	break;
	case '!time':
		$this->insertChatBotMessage($this->getChannel(),"Time: ".date('G:i a'));
	break;
	case '!away':
		// $query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotpotato'");
		// $hotpotato 	= mysql_fetch_array($query);
		
		// if (!$query) {
			// $hotpotato['value'] == 'off';
		// }
		
		$announce = TRUE;
		
		if ($textParts[1] == 'quiet') {
			$announce = FALSE;
		}

		if (strpos($this->getUserName(),'_(Away)') == FALSE) {
			if ($announce == TRUE) $this->insertChatBotMessage($this->getChannel(),'[color=purple][b]'.$this->getLoginUserName().'[/b] has set their status to away[/color]');
			$this->setUserName($this->getLoginUserName().'_(Away)');
		} else {
			//if ($hotpotato['value'] == 'off') {
				if ($announce == TRUE) $this->insertChatBotMessage($this->getChannel(),'[color=purple][b]'.$this->getLoginUserName().'[/b] is back[/color]');
				$this->setUserName($this->getLoginUserName());
			//} else {
			//	$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You cannot set yourself as back during Hot Potato");
			//}
		}

		$this->updateOnlineList();
		$this->addInfoMessage($this->getUserName(), 'userName');
	break;
	case '!jump':
		if ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"/me jumps over ".$textParts[1]." with her scooter");
		} else {
			$this->insertChatBotMessage($this->getChannel(),"/me jumps off a ramp with her scooter");
		}
	break;
	case '!lick':
		if ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"/me licks ".$textParts[1]." on behalf of ".$this->getUserName());
		} else {
			$this->insertChatBotMessage($this->getChannel(),"/me licks ".$this->getUserName());
		}
	break;
	case '!hug':
		if ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"/me hugs ".$textParts[1]." on behalf of ".$this->getUserName());
		} else {
			$this->insertChatBotMessage($this->getChannel(),"/me hugs ".$this->getUserName());
		}
	break;
	case '!moon':
		// If not permitted or user not specified, kick self
		if ($this->getUserRole() == AJAX_CHAT_ADMIN && $textParts[1] != NULL) {
			if ($textParts[1] == 'random') {
				$array = $this->getOnlineUsersData();
				shuffle($array);

				$textParts[1] = $array[0]['userName'];
			}				

			// If user specified, kick them
			if($this->getIDFromName($textParts[1]) != NULL) {
				$this->insertChatBotMessage($this->getChannel(),$textParts[1].", in the name of Princess Celestia you are exiled to --- the MOON!");

				// Kick user
				$this->kickUser($textParts[1], '0', $this->getIDFromName($textParts[1]));

				$this->insertChatBotMessage($this->getChannel(),'[color=silver][i]'.$textParts[1]." has been kicked[/i][/color]");
			} else {
				$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] I can't kick a pony that doesn't exist");
			}
		} else {
			$this->insertChatBotMessage($this->getChannel(),"You want to exile yourself to the moon, ".$this->getUserName()."? So be it!");

			$this->kickUser($this->getUserName(), '0', $this->getIDFromName($this->getUserName()));

			$this->insertChatBotMessage($this->getChannel(),'[color=silver][i]'.$this->getUserName()." has been kicked[/i][/color]");
		}
	break;
	case '!poke':
		if ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"/me pokes ".$textParts[1]." on behalf of ".$this->getUserName());
		} else {
			$this->insertChatBotMessage($this->getChannel(),"/me pokes ".$this->getUserName());
		}
	break;
	case '!poke':
		if ($textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"/me pokes ".$textParts[1]." on behalf of ".$this->getUserName());
		} else {
			$this->insertChatBotMessage($this->getChannel(),"/me pokes ".$this->getUserName());
		}
	break;
	case '!identify':
		// Only allow admins to work on the database
		if ($this->getUserRole() == AJAX_CHAT_ADMIN && $textParts[1]) {
			$this->insertChatBotMessage($this->getChannel(),"Username is ".$textParts[1]." and the user ID is ".$this->getIDFromName($textParts[1]));
		} else {
			$this->insertChatBotMessage($this->getChannel(),"Your username is ".$this->getUserName()." and your user ID is ".$this->getIDFromName($this->getUserName()));
		}
	break;
	case '!flip':
		$winner = NULL;

		if (rand(1,2)==1) {
			$result = 'heads';
			if ($textParts[1])		$winner = '('.$textParts[1].')';
		} else {
			$result = 'tails';
			if ($textParts[2])		$winner = '('.$textParts[2].')';
		}

		$this->insertChatBotMessage($this->getChannel(),"/me flips a coin, landing on ".$result." ".$winner);
	break;
	case '!randomuser':
		$array = $this->getOnlineUsersData();
		shuffle($array);

		$output = $array[0]['userName'];

		$this->insertChatBotMessage($this->getChannel(),'I picked [b]'.$output.'[/b]');
	break;
	case '!quote':
		$allquote=array(
			'You got a problem with blank flanks?',
			'I said, you got a problem wiht blank flanks?',
			'It means she could be great at anything. The possibilities are, like, endless.',
			'...and she\'s not stuck being stuck-up like you two.',
			'We thought we were the only two.',
			'Name\'s Scootaloo',
			'How could we not be? We\'re totally alike. We don\'t have cutie marks, Diamond Tiara and Silver Spoon drive us crazy...',
			'I\'m liking this idea!',
			'The Cutie Mark Three?',
			'What do you say we celebrate with some of these delicious cupcakes?',

			'Hey Sweetie Belle!',
			'Even, if it takes us all night!',
			'Cutie Mark Crusaders sleepover at Rarity\'s! Yay!',
			'Oh, wow! That\'s so cool!',
			'We\'re on a crusade, a mission!',
			'Cutie Mark Crusaders sleepover at Fluttershy\'s cottage! Yay!',
			'I\'m gonna get my mark first!',
			'I\'m staying up all night!',
			'We are the Cutie Mark Crusaders!',
			'Arrrr... I am a dangerous creature from the Everfree Forrest! Rrrarr!',
			'You can never catch me! I am far too powerful and dangerous!',
			'Hammer',
			'Hammer. Hammer! Hammer.',
			'We were making a table?',
			'We are definitely not Cutie Mark Carpenters',
			'But we\'re not even tired!',
			'Don\'t worry, Fluttershy, the Cutie Mark Crusaders will handle this!',
			'That not how you call a chicken.',
			'That\'s so funny I forgot to laugh.',
			'Why, you...',
			'The head of a chicken and the body of a snake? That doesn\'t sound scary, that sounds silly!',
			'Two Chickens?',
			'You\'re like the queen of stares.',

			'TLC as in Tender Loving Care or Totally Lost Cause?',
			'I\'m just no good at lyrics. Coming up with words is like... really hard.',

			'Tree sap and pine needles, but no cutie mark',
			'Yeah.. You know where we can find a cannon at this hour?',
			'We can start with the coolest pony in Ponyville...',
			'No you guys. I said cool you know what I\'m talking about. She\'s fast! She\'s tough! She\'s not afraid of anything.',
			'No! The greatest flier to ever come out of Cloudsdale',
			'Rainbow Dash!',
			'Why don\'t we ever smash into Rainbow Dash?!',
			'Ooh! Ooh! Me! Me! Me! I\'ll do whatever you want, Rainbow Dash!',
		);

		$this->insertChatBotMessage($this->getChannel(),$allquote[array_rand($allquote)]);
	break;
	case '!randep':
		$allep=array(
			'[S01 E01] Friendship Is Magic - Part 1 (Mare in the Moon)',
			'[S01 E02] Friendship Is Magic - Part 2 (Elements of Harmony)',
			'[S01 E03] The Ticket Master',
			'[S01 E04] Applebuck Season',
			'[S01 E05] Griffon The Brush-Off',
			'[S01 E06] Boast Busters',
			'[S01 E07] Dragonshy',
			'[S01 E08] Look Before You Sleep',
			'[S01 E09] Bridle Gossip',
			'[S01 E10] Swarm Of The Century',
			'[S01 E11] Winter Wrap Up',
			'[S01 E12] Call of the Cutie',
			'[S01 E13] Fall Weather Friends',
			'[S01 E14] Suited for Success',
			'[S01 E15] Feeling Pinkie Keen',
			'[S01 E16] Sonic Rainboom',
			'[S01 E17] Stare Master',
			'[S01 E18] The Show Stoppers',
			'[S01 E19] A Dog and Pony Show',
			'[S01 E20] Green Isn\'t Your Color',
			'[S01 E21] Over a Barrel',
			'[S01 E22] A Bird in the Hoof',
			'[S01 E23] The Cutie Mark Chronicles',
			'[S01 E24] Owl\'s Well That Ends Well',
			'[S01 E25] Party Of One',
			'[S01 E26] The Best Night Ever',

			'[S02 E01] The Return of Harmony - Part 1',
			'[S02 E02] The Return of Harmony - Part 2',
			'[S02 E03] Lesson Zero',
			'[S02 E04] Luna Eclipsed',
			'[S02 E05] Sisterhooves Social',
			'[S02 E06] The Cutie Pox',
			'[S02 E07] May The Best Pet Win',
			'[S02 E08] The Mysterious Mare Do Well',
			'[S02 E09] Sweet and Elite',
			'[S02 E10] Secret of My Excess',
			'[S02 E11] Hearth\'s Warming Eve',
			'[S02 E12] Family Appreciation Day'
		);

		$this->insertChatBotMessage($this->getChannel(),$allep[array_rand($allep)]);
	break;

	//***************************** DATABASE
	case '!db':
		// Only allow admins to work on the database
		if ($this->getUserRole() == AJAX_CHAT_ADMIN) {
			// Check if starts with "ajax_chat" for security
			if (substr($textParts[2],0,9) == 'ajax_chat') {
				switch (strtolower($textParts[1])) {
					case 'add':
						// Table				Name                Value
						if ($textParts[2] && $textParts[3] != NULL && $textParts[4] != NULL) {						
							$query = mysql_query("INSERT INTO ".mysql_real_escape_string($textParts[2])." (`id`, `name`, `value`, `user`) VALUES (NULL, '".mysql_real_escape_string($textParts[3])."', '".mysql_real_escape_string($textParts[4])."', '".$this->getIDFromName($this->getUserName())."');");

							if ($query == TRUE) {
								$lastquery = mysql_insert_id();

								$this->insertChatBotMessage($this->getPrivateMessageID(),"Entry added to database successfully as entry number ".$lastquery);
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a value to add (and optionally a name)");
						}
					break;
					case 'delete':
						//	Table				ID
						if ($textParts[2] && is_numeric($textParts[3])) {
							$query = mysql_query("SELECT * FROM ".mysql_real_escape_string()." WHERE id='".mysql_real_escape_string($textParts[3])."'");

							$result = mysql_fetch_array($query);

							// If user added the entry, allow him to remove it
							if ($query && ($this->getIDFromName($this->getUserName()) == $result['user'] || $this->getUserRole() == AJAX_CHAT_ADMIN)) {
								$query = mysql_query("DELETE FROM ".$textParts[2]." WHERE id=".$textParts[3]."");

								if ($query == TRUE) { 
									$this->insertChatBotMessage($this->getPrivateMessageID(),"Entry removed from the database successfully");
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
								}
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission to remove that entry");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a ID number to remove");
						}
					break;
					case 'show':
						//	Table				ID num
						if ($textParts[2] && $textParts[3]) {
							$query = mysql_query("SELECT * FROM ".mysql_real_escape_string($textParts[2])." WHERE id='".mysql_real_escape_string($textParts[3])."'");

							if ($query) {
								$return = NULL;

								while ($result = mysql_fetch_array($query)) {
									$return = "Name: \"".$result['name']."\" Value: \"".$result['value']."\"";
								}

								$this->insertChatBotMessage($this->getPrivateMessageID(),$return);
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide an ID number to show"
							);
						}
					break;
					case 'list':
						if ($textParts[2]) {
							$query = mysql_query("SELECT * FROM ".mysql_real_escape_string($textParts[2])."");
							$numrows = mysql_num_rows($query);

							if ($query) {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"Listing ".$numrows." entries");

								// Cycle through all entries
								while ($result = mysql_fetch_array($query)) {
									$values.='
										'.$result['id'].": \"". $result['name']."\" added by ".$this->getNameFromID($result['user']);
								}

								// Output
								$this->insertChatBotMessage($this->getPrivateMessageID(),$values);
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						}
					break;

	//					case 'special':
	//						$query = mysql_query("CREATE TABLE `ajax_chat_score` (
	//							`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	//							`correct` INT NOT NULL,
	//							`incorrect` INT NOT NULL,
	//							`user` INT NOT NULL)
	//						");
	//
	//						if ($query) {
	//							$this->insertChatBotMessage($this->getPrivateMessageID(),"Special database command performed");
	//						} else {
	//							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error ".mysql_error());
	//						}
	//					break;

					default:
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You can only perform add, remove, show and list on the database"
						);
					break;
				}
			} else {
				$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You can only perform operations on AJAX chat tables");
			}
		} else {
			$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You are not allowed to do this");
		}
	break;

	//***************************** USER COMMANDS
	case '!cmd':
		$_operation = $textParts[1];
		
		switch ($_operation) {
			case 'add':
				$_name = $textParts[2];
				$_value = $textParts[3];
				$_lock = $textParts[4];
			
				// If command name and value exist
				if ($_name && $_value) {
					$query = mysql_query("SELECT * FROM ajax_chat_usercustom WHERE name='".mysql_real_escape_string($_name)."'");
					$rows = mysql_num_rows($query);
					
					// Make sure locked parameter is safe
					if ($_lock == 'lock') {
						$_lock = 1;
					} elseif ($_lock == 'unlock') {
						$_lock = 0;
					} else {
						$_lock = -1;
					}
					
					if ($query) {
						// If not in database, add, otherwise replace
						if ($rows != 1) {
							if ($_lock == -1) $_lock = 0;
						
							// Insert new command
							$query = mysql_query("INSERT INTO ajax_chat_usercustom (`id`, `name`, `value`, `locked`, `lastuser`, `user`) VALUES (NULL, '".mysql_real_escape_string($_name)."', '".mysql_real_escape_string($_value)."', '".$_lock."', '".$this->getUserID()."', '".$this->getUserID()."')");

							if ($query == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"Custom command [b]".$_name."[/b] has been added by ".$this->getUserName());
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							// Get current values
							$custom = mysql_fetch_array($query);
							$author = $custom['user'];
							$lastuser = $custom['lastuser'];
							$locked = $custom['locked'];
						
							// If not locked OR original author is updating, update it
							if ($locked == 0 || $this->getUserID() == $author) {
								// If original author, make sure it's locked
								if ($this->getUserID() == $author) {
									// Add to message if it has changed
									if ($_lock == 1) {
										$islocked = ' (now locked)';
									} elseif ($_lock == 0) {
										$islocked = ' (now unlocked)';
									} else {
										$islocked = '';
									}
								} else {
									// Use current status
									$_lock = $locked;
									$islocked = '';
									
									// Tell user they cannot change it
									if ($_lock) {
										$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You cannot lock or unlock a command that is not yours");
									}
								}
								
								$query = mysql_query("UPDATE ajax_chat_usercustom SET value='".mysql_real_escape_string($_value)."',locked='".$_lock."',lastuser='".$this->getUserID()."' WHERE name='".mysql_real_escape_string($_name)."'");
		
								if ($query) {
									$this->insertChatBotMessage($this->getChannel(),"Custom command [b]".$_name."[/b] has been updated by ".$this->getUserName()."".$islocked."");
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
								}
							} else {
								if ($this->getNameFromID($author)) {
									$lockedby = ' (by '.$this->getNameFromID($author).')';
								} else {
									$lockedby = '';
								}
							
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] This custom command is locked".$lockedby);
							}
						}
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide all required parameters");
				}
			break;
			case 'list':
				// If all is specified, list every command
				if ($textParts[2] != 'all') {
					$extra = " WHERE user='".$this->getUserID()."'";
				} else {
					$extra = '';
				}
				
				$query = mysql_query("SELECT * FROM ajax_chat_usercustom".$extra."");

				if ($query) {
					$message = '';
					
					// Loop through all commands adding name and user for the final display
					while ($cmd = mysql_fetch_array($query)) {
						$message .= '
						[b]'.$cmd['name'].'[/b]';
						
						if ($textParts[2] == 'all' && $this->getNameFromID($cmd['user'])) {
							$message .= ', added by '.$this->getNameFromID($cmd['user']).'';
						}
						
						if ($this->getNameFromID($cmd['lastuser'])) {
							$message .= ', last updated by '.$this->getNameFromID($cmd['lastuser']).'';
						}
						
						if ($cmd['locked'] == 1) {
							$message .= ' [color=red](locked)[/color]';
						}
					}
					
					$this->insertChatBotMessage($this->getPrivateMessageID(),"Listing custom commands...".$message);
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
				}
			break;
			case 'lookup':
				// If a command was passed
				if ($textParts[2]) {
					$query = mysql_query("SELECT * FROM ajax_chat_usercustom WHERE name='".$textParts[2]."'");
					$numrows = mysql_num_rows($query);

					if ($numrows == 1) {
						$message = '';
						
						$cmd = mysql_fetch_array($query);
						
						$message .= '[b]'.$cmd['name'].'[/b], added by ';

						if ($this->getNameFromID($cmd['user'])) {
							$message .= ''.$this->getNameFromID($cmd['user']).'';
						} else {
							$message .= 'user ID '.$cmd['user'];
						}

						$message .= ', last updated by ';

						if ($this->getNameFromID($cmd['lastuser'])) {
							$message .= ''.$this->getNameFromID($cmd['lastuser']).'';
						} else {
							$message .= 'user ID '.$cmd['lastuser'];
						}

						if ($cmd['locked'] == 1) {
							$message .= ' [color=red](locked)[/color]';
						}

						$this->insertChatBotMessage($this->getPrivateMessageID(),"Found: ".$message);
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Could not find command");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a command to look up");					
				}
			break;
			default:
				$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Provide a parameter, !cmd ADD NAME VALUE -LOCK/UNLOCK, !cmd LIST -ALL or !cmd LOOKUP");
		}
	break;

	//***************************** TRIVIA
	case '!trivia':
		switch ($textParts[1]) {
			case 'ask':
				//  Question            Answer
				if ($textParts[2] != NULL && $textParts[3] != NULL) {
					// Check if it's started
					$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");

					// Check if the question and answer is empty
					$query1 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='question'");
					$query2 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='answer'");
					$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='lastanswer'");

					if ($query && $query1 && $query2) {
						$trivia = mysql_fetch_array($query);
						$question = mysql_fetch_array($query1);
						$answer = mysql_fetch_array($query2);

						// If trivia is on and they are empty, fill them
						if ($trivia['value'] == 'on') {
							if ($question['value'] == NULL && $answer['value'] == NULL) {
								// Update the question and answer entries in the database
								$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='".mysql_real_escape_string($textParts[2])."',user='".$this->getIDFromName($this->getUserName())."' WHERE name='question'");
								$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='".mysql_real_escape_string($textParts[3])."',user='".$this->getIDFromName($this->getUserName())."' WHERE name='answer'");

								// If successful, announce question to ALL CHANNELS
								if ($query1 == TRUE && $query2 == TRUE) {
									// Tell user privately
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=blue]Trivia:[/color] Question asked!");

									// Announce it
									$this->insertChatBotMessage('Public',"[color=blue]Trivia:[/color] Question: [i]".$textParts[2]."[/i]");

									// If user wants to add it to the permanent list, do it
									if ($textParts[4] == 'add') {
										// Add to database
										$query3 = mysql_query("INSERT INTO `ajax_chat_trivia` VALUES('','".mysql_real_escape_string($textParts[2])."','".mysql_real_escape_string($textParts[3])."','".$this->getIDFromName($this->getUserName())."')");

										if ($query3 == TRUE) {
											// Tell user
											$this->insertChatBotMessage($this->getPrivateMessageID(),"Question and answer has been added to the trivia database");
										} else {
											$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
										}
									}
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
								}
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Somebody has already asked a question");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Trivia isn't on");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error (check if the question, answer and trivia entries exist in database)");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a question and answer");
				}
			break;
			case 'add':
				//  Question            Answer
				if ($textParts[2] != NULL && $textParts[3] != NULL) {
					// Add to database
					$query3 = mysql_query("INSERT INTO `ajax_chat_trivia` VALUES('','".mysql_real_escape_string($textParts[2])."','".mysql_real_escape_string($textParts[3])."','".$this->getIDFromName($this->getUserName())."')");

					if ($query3 == TRUE) {
						// Tell user
						$this->insertChatBotMessage($this->getPrivateMessageID(),"Question and answer has been added to the trivia database");
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a question and answer");
				}
			break;
			case 'answer':
				//  Answer
				if ($textParts[2] != NULL) {
					$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='answer'");
					$query_question = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='question'");

					if ($query && $query_question) {
						$answer = mysql_fetch_array($query);
						$question = mysql_fetch_array($query_question);

						// Check for last answer
						$query1 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='lastanswer'");
						if ($query1) {
							$return = mysql_fetch_array($query1);
							$lastanswerer = $return['value'];
						} else {
							$lastanswerer = 'NOT SET';
						}

						// Debug
						//$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=green]Special:[/color] ".$this->getUserName()." you are user ID ".$this->getIDFromName($this->getUserName())." and the last user to answer was user ID ".$lastanswerer." and the question was asked by user ID ".$question['user']);

						/// If user didn't try answering last time and is not the asker
						if ($this->getIDFromName($this->getUserName()) != $lastanswerer) {
							if ($this->getIDFromName($this->getUserName()) != $question['user']) {
								// Check if answer is available
								if ($answer['value'] != NULL) {
									$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='".$this->getIDFromName($this->getUserName())."' WHERE name='lastanswer'");

									// If answer matches database answer and they aren't the asker
									if (strtolower($textParts[2]) == strtolower($answer['value'])) {
										// Update the question and answer entries in the database
										$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='question'");
										$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='answer'");

										// Refresh last answer
										$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='lastanswer'");

										// Success!
										$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] Correct! ".$this->getUserName()." has answered correctly with \"".$answer['value']."\"");

										// If successful, announce answers are open
										if ($query1 == TRUE && $query2 == TRUE) {

										} else {
											$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
										}

										// If speedround is on, ask a new question
										$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='speedround'");

										if ($query) {
											$speedround = mysql_fetch_array($query);

											if ($speedround['value'] == 'on') {
												$this->insertMessage("!trivia");
											}
										}
									} else {
										$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=blue]Trivia:[/color] Incorrect");
									}
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] No answer to guess (either trivia mode is off or there is no question)");
								}
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You cannot answer your own question");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You cannot answer more than once in a row");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide an answer with !trivia answer VALUE");
				}
			break;
			case 'speedround':
				// Only admins or mods
				if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
					$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");

					if ($query && $textParts[2]) {
						$trivia = mysql_fetch_array($query);

						if ($trivia['value'] == 'on') {
							if ($textParts[2] == 'on') {
								$query = mysql_query("UPDATE `ajax_chat_custom` SET value='on' WHERE name='speedround'");

								if ($query == TRUE) {
									$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] Speed round [color=green]on[/color]");
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
								}
							} else {
								$query = mysql_query("UPDATE `ajax_chat_custom` SET value='off' WHERE name='speedround'");

								if ($query == TRUE) {
									$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] Speed round [color=red]off[/color]");
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
								}
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Trivia mode is off");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a setting");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
				}
			break;
			case 'status':
				$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");
				$query1 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='question'");

				if ($query && $query1) {
					$trivia = mysql_fetch_array($query);
					$question = mysql_fetch_array($query1);

					if ($trivia['value'] == 'on')		{ $status = 'Trivia mode is [color=green][b]on[/b][/color]'; } else  { $status .= 'Trivia mode is [color=red][b]off[/b][/color]'; }
					if ($question['value'] == '')		{ $status .= ', there is no question'; } else { $status .= ', question is [i]'.$question['value'].'[/i]'; }

					$this->insertChatBotMessage($this->getPrivateMessageID(),$status);
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
				}
			break;
			case 'on':
				// Only admins can turn it on
				if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR || $this->getIDFromName($this->getUserName()) == 9 || $this->getIDFromName($this->getUserName()) == 24) {
					// Check if it's already started
					$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");

					if ($query) {
						$trivia = mysql_fetch_array($query);

						// If not started, start it
						if ($trivia['value'] == 'on') {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Trivia has already started, type !trivia OFF to turn it off");
						} else {
							$query = mysql_query("UPDATE `ajax_chat_custom` SET value='on' WHERE name='trivia'");

							// Update the question and answer entries in the database
							$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='question'");
							$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='answer'");
							$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name=Sc'lastanswer'");

							$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='voteskip'");

							if ($query == TRUE && $query1 == TRUE && $query2 == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] [color=green]Trivia is now on[/color]");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
				}
			break;
			case 'off':
				// Only admins can turn it off
				if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR || $this->getIDFromName($this->getUserName()) == 9 || $this->getIDFromName($this->getUserName()) == 24) {
					// Check if it's already started
					$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");

					if ($query) {
						$trivia = mysql_fetch_array($query);

						// If it's started, stop it
						if ($trivia['value'] == 'off') {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"Trivia is already off, type !trivia ON to turn it on");
						} else {
							$query = mysql_query("UPDATE `ajax_chat_custom` SET value='off' WHERE name='trivia'");

							// Update the question and answer entries in the database
							$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='question'");
							$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='answer'");
							$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='lastanswer'");

							$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='voteskip'");

							if ($query == TRUE && $query1 == TRUE && $query2 == TRUE) {					
								$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] [color=red]Trivia is now off[/color]");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
				}
			break;
			case 'voteskip':
				// Check if voting is on
				$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='voteskip'");

				// Calculate the number of votes required
				$onlineusers = count($this->getOnlineUsers());
				$odd = NULL;

				if( $odd = $onlineusers%2 ) {
					// Remove 1
					$onlineusers = $onlineusers - 1;
				} else {
					$onlineusers = $onlineusers;
				}

				$votesreq = $onlineusers / 2;
				$votesreq1 = $votesreq;

				if ($query) {
					$trivia = mysql_fetch_array($query);

					// If it has a value
					if ($trivia['value'] != '') {

						// Add 1 to votes
						$newcount = $trivia['value'] + 1;

						// If vote count is higher than the required number
						if ($newcount >= $votesreq) {
							// Update the question and answer entries in the database
							$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='question'");
							$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='answer'");
							$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='lastanswer'");

							$query4 = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='voteskip'");

							if ($query1 == TRUE && $query2 == TRUE && $query3 == TRUE && $query4 == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] Required votes to skip has been reached, question skipped!");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							// Increase by one
							$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newcount."' WHERE name='voteskip'");

							$this->insertChatBotMessage($this->getChannel(),$this->getUserName()." has voted to skip the current question (".$newcount." votes, ".$votesreq1." required)");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
				}
			break;
			case 'reset':
				if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR || $this->getIDFromName($this->getUserName()) == 9 || $this->getIDFromName($this->getUserName()) == 24) {
					$this->insertChatBotMessage($this->getChannel(),"[color=blue]Trivia:[/color] Quick resetting");
					$this->insertMessage("!trivia off");
					$this->insertMessage("!trivia on");
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
				}
			break;
			default:
				// Check if it's started
				$query = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='trivia'");

				// Check if the question and answer is empty
				$query1 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='question'");
				$query2 = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='answer'");

				if ($query && $query1 && $query2) {
					$trivia = mysql_fetch_array($query);
					$question = mysql_fetch_array($query1);
					$answer = mysql_fetch_array($query2);

					// If trivia is on and they are empty, fill them
					if ($trivia['value'] == 'on') {
						if ($question['value'] == NULL && $answer['value'] == NULL) {
							// Get random question from the database
							//$query5 = mysql_query("SELECT * FROM `ajax_chat_trivia` WHERE user != '".$this->getIDFromName($this->getUserName())."' ORDER BY RAND()");
							//WHERE user <> '".$this->getIDFromName($this->getUserName())."'
							$query5 = mysql_query("SELECT * FROM `ajax_chat_trivia` ORDER BY RAND()");
							$random = mysql_fetch_array($query5);

							$textParts[2] = $random['name'];
							$textParts[3] = $random['value'];

							// Update the question and answer entries in the database
							$query1 = mysql_query("UPDATE `ajax_chat_custom` SET value='".mysql_real_escape_string($textParts[2])."',user='".$random['user']."' WHERE name='question'");
							$query2 = mysql_query("UPDATE `ajax_chat_custom` SET value='".mysql_real_escape_string($textParts[3])."',user='".$random['user']."' WHERE name='answer'");

							// If successful, announce question to ALL CHANNELS
							if ($query1 == TRUE && $query2 == TRUE) {
								// If user isn't in channel, don't try to add their NULL username
								if ($this->getNameFromID($random['user']) == '' && $this->getNameFromID($random['user'].'_(Away)') == '') { 
									$addedby = NULL;
								} else {
									$addedby =  " (asked by ".$this->getNameFromID($random['user']).")";
								}

								// Public message
								$this->insertChatBotMessage('Public',"[color=blue]Trivia:[/color] Question: [i]".$textParts[2]."[/i] [color=silver](".$random['id'].")[/color] ".$addedby);

								// Reset last answer attempt so same user can attempt this question
								$query3 = mysql_query("UPDATE `ajax_chat_custom` SET value='' WHERE name='lastanswer'");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Somebody has already asked a question");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Trivia isn't on");
					}
				} else {
					$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error, check if the question, answer and trivia entries are there");
				}
			break;
		}
	break;
	
	//***************************** HOT POTATO
	case '!hot':
		$query_game = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotpotato'");
		$query_user = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotuser'");
		$query_count = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotcount'");

		// Check if the database entries exist and populate arrays if they do
		if ($query_game && $query_user && $query_count) {
			$hotpotato 	= mysql_fetch_array($query_game);
			$hotuser 		= mysql_fetch_array($query_user);
			$hotcount 	= mysql_fetch_array($query_count);
						
			// Get all users
			$array = $this->getOnlineUsersData();
			
			// Set usercount
			$usercount = 0;
			
			// Remove self and anyone away
			foreach ($array as $user => $userinfo) {
				if ($this->getUserID() == $userinfo['userID']) {
					unset($array[$user]);
					
					$usercount = $usercount + 1;
				} elseif (strpos($this->getNameFromID($userinfo['userID']),'_(Away)') != FALSE) {
					unset($array[$user]);
				} else {
					$usercount = $usercount + 1;
				}
			}
			
			$array = array_values($array);
		
			// To select a random user
			shuffle($array);

			// Fill
			$randuser_id = $array[0]['userID'];
			$randuser_username = $array[0]['userName'];
		
			// Proceed
			switch ($textParts[1]) {
//				case 'throw':
//					// Check if game is on
//					if ($hotpotato['value'] == 'on') {
//						// Get ID of user to throw at
//						$to_username = $textParts[2];
//						$to_userid = $this->getIDFromName($to_username);
//						
//						// If user exists, attempt to throw
//						if ($to_userid != 0) {
//							// If user has the potato
//							if ($this->getUserID() == $hotuser['user']) {
//								// Attempt to throw based on chance
//								if (rand(0,10) > 3) {
//									// Calculate new time based on pass count
//									$newtime = strtotime('-17 seconds',time());
//
//									// Update the database with how many times its been passed
//									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newcounter."' WHERE name='hotcount'");
//									
//									// Update the database with new user
//									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newtime."',user='".$to_userid."' WHERE name='hotuser'");
//									
//									// Increase pass counter
//									$newcounter = $hotcount['value'] + 1;
//
//									// Update the database with how many times its been passed
//									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newcounter."' WHERE name='hotcount'");
//
//									// Output: Has been passed to user
//									$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] ".$this->getUserName()." has deliberately passed the potato to [b]".$to_username."[/b] they have 3 seconds to pass (using !hot)");
//								} else {
//									// Reset counter
//									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='hotcount'");
//									
//									// Reset user
//									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='',user='0' WHERE name='hotuser'");
//									
//									// Output: Tried to pass it but failed
//									$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] ".$this->getUserName()." tried to deliberately pass the potato to [b]".$to_username."[/b] and failed and were kicked [u]and banned for 1 minute[/u]");
//									
//									// Kick user
//									$this->kickUser($this->getUserName(), '1', $this->getIDFromName($this->getUserName()));
//								}
//							} else {
//								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You don't have the potato");
//							}
//						} else {
//							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You must provide a user to attempt to throw it to");
//						}
//					} else {
//						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Hot Potato is not on");
//					}
//				break;
				case 'elim':
					// Only admins can turn on elimination mode
					if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
						// If it is on, turn on elimination mode
						if ($hotpotato['value'] == 'on') {
							$query_elim = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotelim'");

							$hotelim = mysql_fetch_array($query_elim);
						
							// Change message status and database value
							if ($hotelim['value'] == 'on') {
								$status = '[color=red]off[/color]';
								$value = 'off';
							} else {
								$status = '[color=green]on[/color]';
								$value = 'on';
							}
							
							// Toggle it
							$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$value."' WHERE name='hotelim'");
							
							if ($query == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] Elimination mode is ".$status);
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You cannot start elimination mode when Hot Potato is off");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
					}
				break;
				case 'on':
					// Only admins or mods
					if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
						// If not started, start it
						if ($hotpotato['value'] == 'off') {
							// Turn it on
							$query_on = mysql_query("UPDATE `ajax_chat_custom` SET value='on' WHERE name='hotpotato'");

							// Clear user values
							$query_user = mysql_query("UPDATE `ajax_chat_custom` SET value='',user='0' WHERE name='hotuser'");
								
							// Clear counter
							$query_counter = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='hotcount'");
							
							if ($query_on == TRUE && $query_user == TRUE && $query_counter == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] Hot potato is now [color=green]on[/color]");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Hot potato has already started, type !hot OFF to turn it off");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
					}
				break;
				case 'off':
					// Only admins or mods
					if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
						// If it is on, turn it off
						if ($hotpotato['value'] == 'on') {
							// Turn it off
							$query_off = mysql_query("UPDATE `ajax_chat_custom` SET value='off' WHERE name='hotpotato'");

							// Clear user values
							$query_user = mysql_query("UPDATE `ajax_chat_custom` SET value='',user='0' WHERE name='hotuser'");
							
							// Clear counter
							$query = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='hotcount'");
							
							if ($query_off == TRUE && $query_user == TRUE) {
								$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] Hot potato is now [color=red]off[/color]");
							} else {
								$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Hot potato is already off, type !hot ON to turn it on");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
					}
				break;
				case 'reset':
					if ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
						$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] Quick resetting");
						$this->insertMessage("!hot off");
						$this->insertMessage("!hot on");
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
					}
				break;
				case 'shout':
					$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] [b]It's starting starting soon![/b] Type /away to not play (you cannot change from away once the Hot Potato is on!)");
				break;
				case 'help':
					$this->insertChatBotMessage($this->getChannel(),"When Hot Potato starts, a virtual hot potato is thrown at a random user and they have a time limit to pass it on before they lose");
					
					$this->insertChatBotMessage($this->getChannel(),"Use !hot to pass the potato when it is thrown to you");
				break;
				default:
					// Check if game is on and there are enough people to play
					if ($hotpotato['value'] == 'on') {
						
						// If user is participating
						if (strpos($this->getUserName(),'_(Away)') == FALSE) {
							// Elimination mode
							$query_elim = mysql_query("SELECT * FROM `ajax_chat_custom` WHERE name='hotelim'");

							if ($query_elim) {
								$hotelim = mysql_fetch_array($query_elim);
							} else {
								$hotelim = array('value' => 'off');
							}

							$elim = $hotelim['value'];
							$currentuser = $hotuser['user'];
							$passcount = $hotcount['value'];

							// If more than 2 users or;
							// If not last user but elimination round is on, so game continues to last user
							if ($usercount > 2 || ($usercount != 1 && $elim == 'on')) {
								// If user has the potato or;
								// If elimination round is on and is ready to continue game (user is 0) or;
								// If elimination round is on and there are more than 0 passes or user is admin
								if($this->getIDFromName($this->getUserName()) == $hotuser['user'] || 
											($elim == 'on' && ($currentuser == '0' && $passcount > 0 || ($passcount == 0 && $this->getUserRole() == AJAX_CHAT_ADMIN))))
								{
									
									// Calculate different timeframes user can throw
									if ($hotcount['value'] >= 20 && $hotcount['value'] < 30) {
										$count = '18';
									} elseif ($hotcount['value'] >= 30) {
										$count = '19';
									} else {
										// Take seconds off depending on turn number
										switch ($hotcount['value']) {
											case '0':
												$count = '0';
											break;
											case '1':
												$count = '1';
											break;
											case '2':
												$count = '2';
											break;
											break;
											case '3':
												$count = '4';
											break;
											case '4':
												$count = '6';
											break;
											case '5':
												$count = '8';
											break;
											case '6':
												$count = '10';
											break;
											case '7':
												$count = '12';
											break;
											case '8':
												$count = '14';
											break;
											default:
												$count = '16';
										}
									}

									// Remove seconds from current time and add
									$newtime = strtotime('-'.$count.' seconds',time());

									// Calculate how long they have to pass it
									$throwtime = 20 - $count;
									
									// Add plural
									if ($throwtime == 1) {
										$plural = '';
									} else {
										$plural = 's';
									}

									// Increase pass counter
									$newcounter = $hotcount['value'] + 1;

									// Update the database with how many times its been passed
									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newcounter."' WHERE name='hotcount'");

									// Update the database with new user
									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".$newtime."',user='".$randuser_id."' WHERE name='hotuser'");

									// If elimination round is on and any ready to pass it
									if ($hotelim['value'] == 'on' && $hotuser['user'] == '0') {
										$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] The potato has been passed to [b]".$randuser_username."[/b] (".$throwtime." second".$plural." to throw, pass ".$hotcount['value'].", throw with !hot)");
									} else {
										// Announce it has been passed
										$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] ".$this->getUserName()." has passed the hot potato to [b]".$randuser_username."[/b] (".$throwtime." seconds to throw, pass ".$hotcount['value'].", throw with !hot)");
									}

									// Announce sudden death
									if ($hotcount['value'] == 20) {
										$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] Sudden death! 2 seconds inbetween throws!");
									} elseif ($hotcount['value'] == 30) {
										$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] [color=red]Super sudden death engaged! 1 second inbetween throws![/color]");
									}
								// If no user has the potato and user is allowed, throw it randomly
								} elseif ($hotuser['user'] == '0' && ($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR)) {
									if (array_count_values($array) > 2) {
										// Update with random user
										$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".time()."',user='".$randuser_id."' WHERE name='hotuser'");

										// Reset counter
										$query = mysql_query("UPDATE `ajax_chat_custom` SET value='1' WHERE name='hotcount'");

										if ($query == TRUE) {
											// Output: Moderator throws at random user
											$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] An ignited potato is thrown randomly at [b]".$randuser_username."[/b] (20 seconds to throw, throw with !hot)");
										} else {
											$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
										}
									} else {
										$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Must have more than 2 available players");
									}
								} else {
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You don't have the potato");
								}
							} else {
								if ($elim == 'on' && $usercount == 1) {
									$this->insertChatBotMessage($this->getChannel(),"[color=orange]Hot Potato:[/color] We have a winner! [b]".$this->getUsername()."[/b] was the winner after ".$hotcount['value']." passes!");
									
									// Turn it off
									$query_off = mysql_query("UPDATE `ajax_chat_custom` SET value='off' WHERE name='hotpotato'");

									// Clear user values
									$query_user = mysql_query("UPDATE `ajax_chat_custom` SET value='',user='0' WHERE name='hotuser'");

									// Clear counter
									$query = mysql_query("UPDATE `ajax_chat_custom` SET value='0' WHERE name='hotcount'");
								} else {							
									$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Hot Potato requires more than 2 players");
								}
							}
						} else {
							$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You are not participating");
						}
					} else {
						$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Hot Potato is not on");
					}
				break;
			}
		}
	break;

	// Bot help
	case '!help':
		$this->insertChatBotMessage($this->getPrivateMessageID(),"These are my commands: !lick USER, !jump USER, !hug USER, !like IDEA USER, !flip A B, !quote, !image, !video, !randep, !time, !poke USER, !moon, !randomuser, !trivia HELP, !cmd, !away");
	break;

	// Enable debug
	case '!debug':
		if ($this->getUserRole() == AJAX_CHAT_ADMIN) {
			$query = mysql_query("UPDATE `ajax_chat_custom` SET value='".mysql_real_escape_string($textParts[1])."' WHERE name='debug'");

			if ($query == TRUE) {
				$this->insertChatBotMessage($this->getPrivateMessageID(),"Debug changed successfully");
			} else {
				$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Database error");
			}
		} else {
			$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] You do not have permission");
		}
	break;
	
	case '/away':
//		if (strpos($this->getUserName(),'_(Away)') == FALSE) {
//			$this->insertChatBotMessage($this->getChannel(),'[color=purple][b]'.$this->getLoginUserName().'[/b] has set their status to away[/color]');
//			$this->setUserName($this->getLoginUserName().'_(Away)');
//		} else {
//			$this->insertChatBotMessage($this->getChannel(),'[color=purple][b]'.$this->getLoginUserName().'[/b] is back[/color]');
//			$this->setUserName($this->getLoginUserName());
//		}
//
//		$this->updateOnlineList();
//		$this->addInfoMessage($this->getUserName(), 'userName');
		
		$this->insertMessage('!away');
	break;
	case '/takeover':
		if($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
			$this->insertChatBotMessage( $this->getChannel(), $text );
		} else {
			$success = FALSE;
		}
	break;
	case '!mydefault':
		// If still a command, try to parse it as a custom command
		if (substr($textParts[0], 0, 1) == '!') {
			$com = ltrim($textParts[0],'!');

			$query = mysql_query("SELECT * FROM ajax_chat_usercustom WHERE name='".mysql_real_escape_string($com)."'");

			$custom = mysql_fetch_array($query);

			if (substr($custom['value'], 0, 1) == '!') {
				$custom['value'] = substr($custom['value'], 1);
			}

			if ($custom['value'])	{
				$this->insertMessage($custom['value']);
			} else {
				$this->insertChatBotMessage($this->getPrivateMessageID(),"[color=red]Error:[/color] Command not found");
			}
		} else {
			$success = FALSE;
		}
	break;
	default:
		$success = FALSE;
}
?>