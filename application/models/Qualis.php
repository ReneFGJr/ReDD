<?php
class qualis extends CI_model {
    function set_srj_area($j,$a,$q)
        {
            $sql = "select * from qualis.sjr_journals
                        where sj_journal = $j
                            AND sj_area = $a
                            AND sj_quartil = '$q' ";
                            
            $rlt = $this->db->query($sql);
            $rlt = $rlt->result_array();
            if (count($rlt) == 0)
                {
                    $sqli = "insert into qualis.sjr_journals 
                                (sj_journal, sj_area, sj_quartil)
                                values
                                ($j,$a,'$q')";
                    $rlti = $this->db->query($sqli);
                }
        }
    
    function area_sjr($area) {
        $area = troca($area, '(Q1)', '');
        $area = troca($area, '(Q2)', '');
        $area = troca($area, '(Q3)', '');
        $area = troca($area, '(Q4)', '');
        $area = trim($area);
        $sql = "select * from qualis.sjr_area where sa_name = '$area' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            $sqli = "insert into qualis.sjr_area (sa_name) values ('$area')";
            $rlti = $this -> db -> query($sqli);
        }
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            echo "Ops, Erro de área " . $area;
            exit ;
        }
        return ($rlt[0]['id_sa']);
    }

    function inport_sjr() {
        $file = 'Z:/Artigo/2019/QUALISxSJR/SJR/scimagojr2018.csv';
        $file_handle = fopen($file, "r");
        $ln = 0;
        $areas = array();
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            if ($ln > 0) {
                $line = utf8_encode($line);
                if (strlen($line) > 10) {
                    $l = $line;
                    $l = troca($l, '""', '');
                    $l = troca($l, "'", '´');
                    $l = troca($l, '"', ';');
                    $l = splitx(';', $l);

                    $issn = troca($l[4], ',', ';');
                    $issn = splitx(";", $issn . ';');
                    for ($r = 0; $r < count($issn); $r++) {
                        $issn[$r] = $this -> issnl_find($issn[$r]);
                    }
                    if (count($issn) > 1) {
                        if ($issn[0] != $issn[1]) {
                            $j = $this -> issn($issn[1], $issn[0]);
                        }
                    }
                    $issn = $issn[0];
                    $j = $this->issn($issn, $l[2],$l[15]);
                    
                    /* Áreas do Conhecimento */
                    for ($r = 18; $r < count($l); $r++) {
                        $ar = $l[$r];
                        $q = '';
                        if (strpos($ar,'(Q1)') > 0) { $q = 'Q1'; }
                        if (strpos($ar,'(Q2)') > 0) { $q = 'Q2'; }
                        if (strpos($ar,'(Q3)') > 0) { $q = 'Q3'; }
                        if (strpos($ar,'(Q4)') > 0) { $q = 'Q4'; }
                        
                        $ar = troca($ar, '(Q1)', '');
                        $ar = troca($ar, '(Q2)', '');
                        $ar = troca($ar, '(Q3)', '');
                        $ar = troca($ar, '(Q4)', '');
                        $ar = trim($ar);
                        if (!isset($areas[$ar]))
                            {
                                $areas[$ar] = $this -> area_sjr($ar);                                
                            }
                        $id_a = $areas[$ar];
                        $this->set_srj_area($j,$areas[$ar],$q);
                        
                    }
                }
            }
            $ln++;

        }
        fclose($file_handle);

    }

    function inport() {
        $f = $this -> files();
        echo "1";
        for ($r = 0; $r < count($f); $r++) {
            $fl = $f[$r];
            $fn = $fl;
            while (strpos($fn, '/')) {
                $fn = strtoupper(substr($fn, strpos($fn, '/') + 1, strlen($fn)));
            }

            $area = $this -> area($fn);
            echo '<br><tt>' . $fn . '</tt>';

            $file = $fl;
            $file_handle = fopen($file, "r");
            $ln = 0;
            while (!feof($file_handle)) {
                $line = fgets($file_handle);
                if ($ln > 0) {
                    $line = utf8_encode($line);
                    if (strlen($line) > 10) {
                        $l = troca($line, ';', '.,');
                        $l = troca($l, '""', '');
                        $l = troca($l, "'", '´');
                        $l = troca($l, '"', ';');
                        $l = splitx(';', $l);
                        if ((count($l) == 3) and (strlen($l[0]) == 9)) {
                            $j = $this -> issn($l[0], $l[1]);
                            $q = $this -> qualisj($j, $l[2], $area);
                        } else {
                            echo '==erro==>' . $line;
                            //exit;
                        }
                    }
                }
                $ln++;

            }
            fclose($file_handle);
        }
    }

    function qualisj($j = '', $q = '', $area = '') {
        $qu = array('A1', 'A2', 'A3', 'A4', 'A5', 'B1', 'B2', 'B3', 'B4', 'B5', 'C');
        $ok = 0;
        for ($r = 0; $r < count($qu); $r++) {
            if ($q == $qu[$r]) { $ok = 1;
            } // existe qualis
        }
        if ($ok == 0) {
            echo "Erros Qualis " . $q;
            exit ;
        }
        $sql = "select * 
                        FROM qualis.area_qualis 
                        WHERE aq_area = $area 
                            AND aq_qualis = '$q' 
                            AND aq_journal = '$j' ";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        if (count($rlt) == 0) {
            $sqli = "insert into qualis.area_qualis (aq_area,aq_qualis,aq_journal) 
                            values ('$area','$q','$j')";
            $rlti = $this -> db -> query($sqli);
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
        }
        if (count($rlt) == 0) {
            echo "OPS " . $issn;
            exit ;
        }
        return ($rlt[0]['id_aq']);
    }

    function issn($issn, $journal,$country='') {
        $sql = "select * from qualis.issn_l where issn = '$issn'";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $issn = $rlt[0]['issn_l'];
        }
        $sql = "select * from qualis.journals where j_issn = '$issn'";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        if (count($rlt) == 0) {
            $sqli = "insert into qualis.journals (j_issn,j_name,j_country) values ('$issn','$journal','$country')";
            $rlti = $this -> db -> query($sqli);
            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
        } else {
            if ((strlen($rlt[0]['j_country']) == 0) and (strlen($country) > 0))
                {
                    $sqlu = "update qualis.journals set j_country = '$country' where id_j = ".$rlt[0]['id_j'];
                    $rlti = $this -> db -> query($sqlu);
                }
        }
        if (count($rlt) == 0) {
            echo "OPS " . $issn;
            exit ;
        }
        return ($rlt[0]['id_j']);
    }

    function issnl_find($issn) {
        if (strlen($issn) == 8) {
            $issn = substr($issn, 0, 4) . '-' . substr($issn, 4, 4);
        }
        $sql = "select * from qualis.issn_l where issn= '$issn' or issn_l ='$issn'";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $issn = $rlt[0]['issn_l'];
        }
        return ($issn);
    }

    function issnl($issn, $issnl) {
        $sql = "insert into qualis.issn_l (issn,issn_l) values ('$issn','$issnl')";
        $rlt = $this -> db -> query($sql);
        return (1);
    }

    function issnl_inport() {
        $file = 'Z:/Artigo/2019/QUALISxSJR/ISSNL/ISSN-to-ISSN-L.txt';
        $file_handle = fopen($file, "r");
        $ln = 0;
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            if ($ln > 0) {
                $i1 = substr($line, 0, 9);
                $i2 = substr($line, 10, 9);
                if ($i1 != $i2) {
                    $this -> issnl($i1, $i2);
                }
            }
            $ln++;

        }
        fclose($file_handle);
        echo "FIM " . date("d/m/Y H:i:s");
    }

    function area($n) {
        $n = troca($n, '.XLS', '');
        $n = troca($n, ' ', '_');
        $sql = "select * from qualis.area where area_nome = '$n'";
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) == 0) {
            $sqli = "insert into qualis.area (area_nome) values ('$n')";
            $rlta = $this -> db -> query($sqli);

            $rlt = $this -> db -> query($sql);
            $rlt = $rlt -> result_array();
        }
        if (count($rlt) == 0) {
            echo "OPS " . $n;
            exit ;
        }
        return ($rlt[0]['id_area']);
    }

    function files() {
        $path = "Z:/Artigo/2019/QUALISxSJR/";
        $diretorio = dir($path);
        $fl = array();
        echo "Lista de Arquivos do diretório '<strong>" . $path . "</strong>':<br />";
        while ($arquivo = $diretorio -> read()) {
            $arquivo = trim((string)$arquivo);
            if (strlen($arquivo) > 2) {
                if (!is_dir($path . $arquivo)) {
                    array_push($fl, $path . $arquivo);
                }
            }
        }
        $diretorio -> close();
        return ($fl);
    }

}
?>