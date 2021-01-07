<?php
$gp = array(1,3,4,5,6);
for ($a=0;$a < count($gp);$a++)
{
$group = $gp[$a];
$file = 'd:\lixo\dir_'.$group.'.txt';

$t = file_get_contents($file);

$ln = explode(chr(13),$t);
$sql = "insert into lattes_group_member ".chr(10)."(gm_group, gm_lattes_id, gm_status) values ".chr(10);
$fr = 0;
for ($r=0;$r < count($ln);$r++)
    {
        $l = $ln[$r];
        $file = substr($l,37,16);
        $type = substr($l,54,3);
        if ($type == 'zip')
            {
            if ($fr > 0) { $sql .= ', '.chr(10); }
            $fr++;
            $sql .= "($group,'$file',1)";
            }
    }
file_put_contents('group_'.$group.'sql',$sql);
}
echo "Total de ".$fr." curriculos";
