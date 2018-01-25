<?php
/* Convert Derwent to Line */

/*******************************************************************************************************************************/
/* SYSTEM SETS */
function cr()
{
	return(chr(13).chr(10));
}
/*******************************************************************************************************************************/
/* MAIN */
echo 'Convert WinTab format to Text - v0.17.04.29'.cr();
echo 'by Rene F. Gabriel Junior';
echo cr();

$cmd = '';
if (defined('STDIN')) {
  $cmd = strtolower($argv[1]);
}

switch($cmd)
	{
		case '-c':
			break;
		default:
			$txt = ''.cr();
			$txt = ''.cr();
			$txt = 'HELP'.cr();
			$txt = '-c convert DERWENT to Line'.cr();

			echo $txt;
			break;
	}
?>