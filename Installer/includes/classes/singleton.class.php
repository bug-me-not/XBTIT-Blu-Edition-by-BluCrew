<?php
/**
 * Ron Burgundy
 * Singleton Class
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @license     Commercial
 * @link        http://bizlogicdev.com
 * @link        http://rbrgvnd.com
 * @link        http://phpbuilder.com/columns/Singleton-PHP5/Octavia_Anghel112310.php3
 *
 * @since       Friday, March 04, 2011 / 04:09 PM UTC+1 mknox
 * @edited      $Date: 2011-03-10 12:38:09 +0100 (Thu, 10 Mar 2011) $ $Author: mknox $
 * @version     $Revision: 1 $
 *
 * @package     Ron Burgundy
 * @subpackage  Singleton
 */

class Singleton
{
    private static $_instances = array();

    // lock down the constructor, therefore the class cannot be externally instantiated
    private function __construct() {}

    // prevent any object or instance of that class to be cloned
    public function __clone()
    {
        trigger_error('Cannot clone instance of Singleton pattern ...', E_USER_ERROR );
    }

    // prevent any object or instance to be deserialized
    public function __wakeup()
    {
        trigger_error('Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );
    }

    // a single globally accessible static method
    public static function getInstance($_class = null, $args = '')
    {
        if(is_null($_class)) {
            trigger_error('Cannot instantiate class, missing class name ...', E_USER_ERROR );
        }

        if(!array_key_exists($_class, self::$_instances)) {
            //echo('Class '.$_class.' was instantiated and the instance was added in the singleton\'s array ...<br />');
            self::$_instances[$_class] = new $_class($args);
        } else {
            //echo('The instance of '.$_class.' was extracted from the singleton\'s array ...<br />');
        }

        return self::$_instances[$_class];
    }
}