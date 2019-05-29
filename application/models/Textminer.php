<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Form Helpers
 *
 * @package     CodeIgniter
 * @subpackage  TextMiner
 * @category    Text
 * @author      Rene F. Gabriel Junior <renefgj@gmail.com>
 * @link        http://www.sisdoc.com.br/CodIgniter
 * @version     v0.19.05.19
 */

class textminer extends CI_model {
    function email_extractor($string = '') {
        $list = preg_match_all('/([\w\d\.\-\_]+)@([\w\d\.\_\-]+)/mi', $string, $matches);
        
        $email = array();
        $e = $matches[0];
        
        for ($r=0;$r < count($e);$r++)
            {
                $em = $e[$r];
                $email[$em] = 1;
            }
        $sx = '';
        foreach ($email as $key => $value) {
            $sx .= $key.cr();            
        }
        return($sx);        
    }

    function form_1() {
        $form = new form;
        $cp = array();
        array_push($cp, array('$H8', '', '', False, False));
        array_push($cp, array('$T80:10', '', msg('text_to_process'), True, True));
        array_push($cp, array('$W80:10', '', msg('text_to_process'), True, True));
        array_push($cp, array('$B8', '', msg('process'), False, True));
        $sx = $form -> editar($cp, '');
        return ($sx);
    }

}
