<?php
/**
 * Ron Burgundy
 * Core
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @license     Commercial
 * @link        http://bizlogicdev.com
 * @link        http://rbrgvnd.com
 *
 * @since       Sunday, March 30, 2014 / 09:45 PM UTC+1 mknox
 * @edited      $Date: 2011-03-10 12:38:09 +0100 (Thu, 10 Mar 2011) $ $Author: mknox $
 * @version     $Revision: 1 $
 *
 * @package     Ron Burgundy
 * @category    Core
 */

class RonBurgundy
{
    public function __construct()
    {
        $this->_defineConfig();
    }    
    
    /**
     * Get the config
     * 
     * @return  array
    */
    public function getConfig()
    {
        $filePath = BASEDIR.'/includes/config/rbrgvnd.ini';
        $ini = parse_ini_file( $filePath, true );
        
        if( !empty( $ini ) ) {
            foreach( $ini AS $key => $value ) {
                foreach( $value AS $valueKey => $valueValue ) {
                    // replace BASEDIR
                    if( preg_match( '/__BASEDIR__/', $valueValue  ) ) {
                        $ini[$key][$valueKey] = str_replace( '__BASEDIR__', BASEDIR, $valueValue );
                    }                    
                }
            }
        }
        
        return $ini;       
    }
    
    /**
     * Define the config
     *
     * @return  void
    */
    private function _defineConfig()
    {
        $config = $this->getConfig();  
        if( !empty( $config ) ) {
            foreach( $config AS $key => $value ) {
                foreach( $value AS $valueKey => $valueValue ) {
                    define( strtoupper( $key.'_'.$valueKey ), $valueValue );
                }
            }
        }  
    }
}