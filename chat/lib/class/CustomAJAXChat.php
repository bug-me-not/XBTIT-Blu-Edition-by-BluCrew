<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

class CustomAJAXChat extends AJAXChat {

	// Returns an associative array containing userName, userID and userRole
	// Returns null if login is invalid
	function getValidLoginUserData() {

		$customUsers = $this->getCustomUsers();

		global $CURUSER;

		if(isset($CURUSER)) {
			// Check if we have a valid registered user:

			foreach($customUsers as $key=>$value) {
				if(isset($CURUSER)) {
					$userData = array();
					$userData['userID'] = $CURUSER['uid'];
					$userData['userName'] = $this->trimUserName($CURUSER['username']);
					$userData['userRole'] = $this->checkUsergroup($CURUSER['id']);

					return $userData;
				}
			}

			return null;
		} else {
			// Guest users:
			return $this->getGuestUser();
		}
	}

	// Store the channels the current user has access to
	// Make sure channel names don't contain any whitespace
	function &getChannels() {
		if($this->_channels === null) {
			$this->_channels = array();

			$customUsers = $this->getCustomUsers();

			// Get the channels, the user has access to:
			if($this->getUserRole() == AJAX_CHAT_ADMIN) {
				$validChannels = $customUsers[1]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_MODERATOR) {
				$validChannels = $customUsers[2]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLURG){
				$validChannels = $customUsers[3]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_TRUSTEE){
				$validChannels = $customUsers[4]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_VIP) {
				$validChannels = $customUsers[5]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_UPLOADER){
				$validChannels = $customUsers[6]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUGOD){
				$validChannels = $customUsers[7]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUJUNKIE){
				$validChannels = $customUsers[8]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUADDICT){
				$validChannels = $customUsers[9]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUMASTER){
				$validChannels = $customUsers[10]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUWARRIOR){
				$validChannels = $customUsers[11]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_BLUUSER){
				$validChannels = $customUsers[12]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_RECRUIT){
				$validChannels = $customUsers[13]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_LEECHER){
				$validChannels = $customUsers[14]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_SUPERLEECH){
				$validChannels = $customUsers[15]['channels'];
			}elseif($this->getUserRole() == AJAX_CHAT_USER) {
				$validChannels = $customUsers[16]['channels'];
			}else {
				$validChannels = $customUsers[0]['channels'];
			}

			// Add the valid channels to the channel list (the defaultChannelID is always valid):
			foreach($this->getAllChannels() as $key=>$value) {
				if ($value == $this->getConfig('defaultChannelID')) {
					$this->_channels[$key] = $value;
					continue;
				}
				// Check if we have to limit the available channels:
				if($this->getConfig('limitChannelList') && !in_array($value, $this->getConfig('limitChannelList'))) {
					continue;
				}
				if(in_array($value, $validChannels)) {
					$this->_channels[$key] = $value;
				}
			}
		}
		return $this->_channels;
	}

	// Store all existing channels
	// Make sure channel names don't contain any whitespace
	function &getAllChannels() {
		if($this->_allChannels === null) {
			// Get all existing channels:
			$customChannels = $this->getCustomChannels();

			$defaultChannelFound = false;

			foreach($customChannels as $name=>$id) {
				$this->_allChannels[$this->trimChannelName($name)] = $id;
				if($id == $this->getConfig('defaultChannelID')) {
					$defaultChannelFound = true;
				}
			}

			if(!$defaultChannelFound) {
				// Add the default channel as first array element to the channel list
				// First remove it in case it appeard under a different ID
				unset($this->_allChannels[$this->getConfig('defaultChannelName')]);
				$this->_allChannels = array_merge(
					array(
						$this->trimChannelName($this->getConfig('defaultChannelName'))=>$this->getConfig('defaultChannelID')
					),
					$this->_allChannels
				);
			}
		}
		return $this->_allChannels;
	}

	function &getCustomUsers() {
		// List containing the registered chat users:
		$users = null;
		require(AJAX_CHAT_PATH.'lib/data/users.php');
		return $users;
	}

	function getCustomChannels() {
		// List containing the custom channels:
		$channels = null;
		require(AJAX_CHAT_PATH.'lib/data/channels.php');
		// Channel array structure should be:
		// ChannelName => ChannelID
		return array_flip($channels);
	}


	//Custom functions needed.
	function checkUsergroup($id_level)
   {
      if($id_level == 7 || $id_level == 8){
         return AJAX_CHAT_ADMIN; //For admin and Owner user groups
      }elseif($id_level == 6 || $id_level == 14){
         return AJAX_CHAT_MODERATOR; //Moderator User group OR System BOT
      }elseif($id_level == 12){
			return AJAX_CHAT_BLURG;
		}elseif($id_level == 20){
			return AJAX_CHAT_TRUSTEE;
		}elseif($id_level == 5){
         return AJAX_CHAT_VIP;
      }elseif($id_level == 4){
			return AJAX_CHAT_UPLOADER;
		}elseif($id_level == 18){
			return AJAX_CHAT_BLUGOD;
		}elseif($id_level == 22){
			return AJAX_CHAT_BLUJUNKIE;
		}elseif($id_level == 19){
			return AJAX_CHAT_BLUADDICT;
		}elseif($id_level == 17){
			return AJAX_CHAT_BLUMASTER;
		}elseif($id_level == 16){
			return AJAX_CHAT_BLUWARRIOR;
		}elseif($id_level == 13){
			return AJAX_CHAT_BLUUSER;
		}elseif($id_level == 3){
			return AJAX_CHAT_RECRUIT;
		}elseif($id_level == 15){
			return AJAX_CHAT_LEECHER;
		}elseif($id_level == 11){
			return AJAX_CHAT_SUPERLEECH;
		}/*elseif($id_level == 9 || $id_level == 2){
         return AJAX_CHAT_USER;
      }*/else{
         return AJAX_CHAT_GUEST;
      }
   }
   
  // Add custom commands (Speak as Blu_Bot)
function parseCustomCommands($text, $textParts) {
	if($this->getUserRole() == AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
		switch($textParts[0]) {
			case '/takeover':
			$this->insertChatBotMessage( $this->getChannel(), $text );
			return true;
			default:
			return false;

  //NSFW 
	       case '/nsfw':
$text = str_replace('/nsfw ','',$text); //remove the "/nsfw " part

if ($text == "/nsfw") {	
			$say = " image is not safe for work";
		} else {
			$say = "[img]" . $text . "#nsfw[/img]";	// This appends the #nsfw fragment to the image, allowing the css rules 
													// supplied in nsfw.css to catch it, and apply the svg blur filter.
		}
$this->insertChatBotMessage( $this->getChannel(), $this->getUserName(). $say );
	return true; 

  // User Away Mod		
	case '/away':
		$this->insertChatBotMessage($this->getChannel(), $this->getLoginUserName().' has set their status to Away');
		$this->setUserName($this->getLoginUserName().'[Away]');
		$this->updateOnlineList();
		$this->addInfoMessage($this->getUserName(), 'userName');
		return true;
	case '/online':
		$this->insertChatBotMessage($this->getChannel(), $this->getLoginUserName().' has set their status to Online');
		$this->setUserName($this->getLoginUserName());
		$this->updateOnlineList();
		$this->addInfoMessage($this->getUserName(), 'userName');
		return true;
		
  // Global Annoucment 	
		case '/wall':
            if($this->getUserRole()==AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
                $text = str_replace('/wall','',$text);
                $users=$this->getCustomUsers(); // Had to change my Yii call, this may breaks… :/
                switch($this->getUserRole()) { // BBCode colors for the roles
                    case AJAX_CHAT_ADMIN: $col="blue"; break;
                    case AJAX_CHAT_MODERATOR: $col="orange"; break;
                }
                foreach($users as $id=>$user) {
                    $this->insertChatBotMessage(
                        $this->getPrivateMessageID($id),
                        '[color=red][i]'.$this->getLang("wall").'[/i][/color]|[color='.$col.'][b]'.$this->getUserName().'[/b][/color]: '.$text
                    );
                }
            } else {
                $this->insertChatBotMessage(
                    $this->getPrivateMessageID(),
                    '/error CommandNotAllowed '.$textParts[0]
                );
            }
            return true;
		}
	}
} 

}
