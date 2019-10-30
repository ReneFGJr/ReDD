<?php
class researchers extends CI_Model {
    var $table = 'researcher';
    var $table_ppg_line = 'researcher_ppg_line';

    function research($data)
    {
        /* Graficos */
        $id = $data['r_lattes_id'];
        if (strlen($id) == 0) {
            $id = 'SEM CODIGO';
        }
        $dt = array();
        $dt['series'] = array();
        $dt['data'] = array();

        /***/
        $biblio = $this -> lattes -> producao($id, 'ARTIG');
        array_push($dt['series'], 'Artigos');
        array_push($dt['data'], $this -> lattes -> dados);

        /* EVENT */
        $event = $this -> lattes -> producao($id, 'EVENT');
        array_push($dt['series'], 'Eventos');
        array_push($dt['data'], $this -> lattes -> dados);

        /* LIVRO */
        $event = $this -> lattes -> producao($id, 'LIVRO');
        array_push($dt['series'], 'Livros');
        array_push($dt['data'], $this -> lattes -> dados);

        $dt['serie'] = 'Produção em artigos';
        $dt['title'] = 'Produção em Artigos de Periódicos';
        $dt['subtitle'] = 'Entre os anos de ' . (date("Y") - $this -> lattes -> limit) . ' e ' . date("Y");

        $sx = $this -> highcharts -> column_simple($dt, 'prod01');

        $sx .= '<div style="border: 1px solid #000000; background-color: #ffffff;">';
        $sx .= '<table width="100%" border=1>';
        $sx .= '<tr>';
        $sx .= '<td width="50%" valign="top">';
        $sx .= $this -> lattes -> producao_qualis($id, 'ARTIG');
        $sx .= '</td><td width="50%" valign="top">';
        $sx .= $this -> lattes -> orientacao($id);
        $sx .= '</td>';
        $sx .= '</tr>';
        $sx .= '</table>';
        $sx .= '</div>';
        return($sx);
    }

    function le($id = '') {
        $id = round($id);
        $sql = "select * from " . $this -> table . " where id_r = " . $id;
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $line = $rlt[0];
            return ($line);
        } else {
            return ( array());
        }
    }

    function le_linha($id = array()) {
        $id = round($id);
        $sql = "select * 
        from researcher_ppg_line 
        inner join researcher_ppg ON id_rp = rpl_ppg
        inner join researcher_institution ON id_ins = rp_instituicao
        where id_rpl = " . $id;
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        if (count($rlt) > 0) {
            $line = $rlt[0];
            return ($line);
        } else {
            return ( array());
        }
    }

    function ppg_line_list($id) {
        $sql = "select r_lattes_id, id_r
        from " . $this -> table_ppg_line . "
        inner join researcher_docente_line ON rdl_line = id_rpl
        inner join researcher ON id_r = rdl_docente
        where id_rpl = $id 
        group by id_r, r_lattes_id";

        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();

        /*** docentes **/
        $p = array();
        $pid = array();
        for ($r = 0; $r < count($rlt); $r++) {
            $line = $rlt[$r];
            array_push($p, $line['r_lattes_id']);
            array_push($pid, $line['id_r']);
        }
        /************************* MODULOS *****************/

        $this -> load -> model('lattes');
        $this -> load -> model('highcharts');
        $this -> load -> model('researchers');
        $this -> load -> view('highchart/header');

        /************************* MODULOS *****************/
        $data = $this -> researchers -> le_linha($id);
        $data['fluid'] = true;
        $data['bg'] = '#e8e8e8';
        $data['content'] = $this -> load -> view('redd/profile_line', $data, true);
        $this -> load -> view('content', $data);
        
        /************************* Docentes ****************/
        $data = array();
        $data['content'] = $this->researchLine($id);
        $data['title'] = '';
        $this->load->view("content",$data);

        /************************* Graficos ****************/
        $dt = array();
        $dt['series'] = array();
        $dt['data'] = array();

        /***/
        $biblio = $this -> lattes -> producao($p, 'ARTIG');
        array_push($dt['series'], 'Artigos');
        array_push($dt['data'], $this -> lattes -> dados);

        /* EVENT */
        $event = $this -> lattes -> producao($p, 'EVENT');
        array_push($dt['series'], 'Eventos');
        array_push($dt['data'], $this -> lattes -> dados);

        /* LIVRO */
        $event = $this -> lattes -> producao($p, 'LIVRO');
        array_push($dt['series'], 'Livros');
        array_push($dt['data'], $this -> lattes -> dados);

        $dt['serie'] = 'Produção em artigos';
        $dt['title'] = 'Produção em Artigos de Periódicos';
        $dt['subtitle'] = 'Entre os anos de ' . (date("Y") - $this -> lattes -> limit) . ' e ' . date("Y");

        $sx = $this -> highcharts -> column_simple($dt, 'prod01');

        $sx .= '<div style="border: 1px solid #000000; background-color: #ffffff;">';
        $sx .= '<table width="100%" border=1>';
        $sx .= '<tr>';
        $sx .= '<td width="50%" valign="top">';
        $sx .= $this -> lattes -> producao_qualis($p, 'ARTIG');
        $sx .= '</td><td width="50%" valign="top">';
        $sx .= $this -> lattes -> orientacao($p);
        $sx .= '</td>';
        $sx .= '</tr>';
        $sx .= '</table>';
        $sx .= '</div>';

        $data['fluid'] = false;
        $data['content'] = $sx;

        $data['content'] .= $this -> lattes -> lista_publicacoes($p, 'ARTIG');
        $data['content'] .= $this -> lattes -> lista_publicacoes($p, 'EVENT');
        $data['content'] .= $this -> lattes -> lista_publicacoes($p, 'LIVRO');
        $data['content'] .= $this -> lattes -> orientacao_list($p);

        /*****************************************************************/
        $data['fluid'] = false;
        $this -> load -> view('content', $data);

    }

    function cp($id = '') {
        $cp = array();
        array_push($cp, array('$H8', 'id_r', '', false, true));
        array_push($cp, array('$S80', 'r_name', msg('full_name'), false, true));
        array_push($cp, array('$S80', 'r_xml', msg('link_lattes_xml'), true, true));
        array_push($cp, array('$S80', 'r_lattes_id', msg('link_r_lattes_id'), false, true));
        array_push($cp, array('$S80', 'r_lattes', msg('link_lattes'), true, true));
        array_push($cp, array('$O 1:Ativo&0:Inativo', 'r_status', msg('status'), true, true));
        array_push($cp, array('$B8', '', msg('save'), false, true));
        return ($cp);
    }

    function row($obj) {
        $obj -> fd = array('id_r', 'r_name', 'r_lattes_id', 'r_lastupdate');
        $obj -> lb = array('ID', 'Nome', 'ID Lattes', 'Atualizado');
        $obj -> mk = array('', 'L', 'D', 'D', 'C');
        return ($obj);
    }

    function row_ppg_line($obj) {
        $obj -> fd = array('id_rpl', 'rpl_name', 'rp_programa');
        $obj -> lb = array('ID', 'Nome', 'Programa');
        $obj -> mk = array('', 'L', 'D', 'D', 'C');
        return ($obj);
    }

    function lattesReadXML($id) {
        $data = $this -> researchers -> le($id);
        $xml = trim($data['r_xml']);
        $idl = sonumero($data['r_lattes']);
        if (strlen($xml) > 0) {
            $data = $this -> lattes -> readXML($xml, $idl);

            $sql = "update " . $this -> table . " set ";
            $sql .= " r_name = '" . $data['nome_completo'] . "',";
            $sql .= " r_lastupdate = '" . $data['atualizado'] . "',";
            $sql .= " r_harvesting = '" . date("Ymd") . "',";
            $sql .= " r_lattes_id = '" . $data['numero_id'] . "'";
            $sql .= " where id_r = " . round($id);
            $rlt = $this -> db -> query($sql);
        }
    }

    function researchLine($id) {
        $id = round($id);
        $sql = "select * from researcher_docente_line
        INNER JOIN researcher ON rdl_docente = id_r
        where rdl_line = $id 
        order by r_name";                    
        $rlt = $this -> db -> query($sql);
        $rlt = $rlt -> result_array();
        $sx = '<h4>'.msg('docentes').'</h4>';
        $sx .= '<ol>';
        for ($r=0;$r < count($rlt);$r++)
        {
            $line = $rlt[$r];
            $sx .= '<li>';
            $sx .= '<a href="'.base_url('index.php/redd/id/'.$line['id_r']).'">';
            $sx .= $line['r_name'];
            $sx .= '</a>';
            $sx .= '</li>';
        }
        $sx .= '</ol>';
        return ($sx);
    }

}
?>
