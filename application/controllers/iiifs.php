<?php
class iiifs extends CI_controller {
    function __construct() {
        parent::__construct();
        $this -> lang -> load("login", "portuguese");
        //$this -> lang -> load("skos", "portuguese");
        //$this -> load -> library('form_validation');
        $this -> load -> database();
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> library('zip');
        $this -> load -> helper('xml');
        $this -> load -> library('curl');

        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //		$this -> security();
    }

    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD - IIIFS ::';
        $this -> load -> view('dspace/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('dspace/header/navbar', null);
        }
    }

    public function foot() {
        $this -> load -> view('header/footer');
    }

    public function image($img = '', $pos_y = 0, $pos_x = 0, $zoom = 1) {
        $this -> cab();
        $img = '018.tif';

        /* parametros */
        $scr_size = 800;

        $img_max_x = 5001;
        $img_max_y = 6490;

        $block = round($img_max_x / $scr_size);
        $size = round($img_max_x / $block);
        $zoom_r = round($size / $zoom);
        

        $pos_y_max = ($img_max_y);

        echo 'block = ' . $block . '<br>';
        echo 'size = ' . $size . '<br>';
        echo 'res_x = ' . $size . '<br>';
        echo 'x = ' . $pos_x . '<br>';
        echo 'y = ' . $pos_y . '<br>';

        $sx = '==size==>' . $zoom . 'x' . $size . '<br>';
        //{server}{/prefix}/{identifier}/x1,y1,x2,y2{region}/{size}/{rotation}/{quality}.{format}
        $yi = $pos_y;
        $xi = $pos_x;
        $y = $yi;
        $pixel = 100;
        
        for ($row_y = 0; $row_y < 5; $row_y++) {
            $x = $xi;
            for ($col_x = 0; $col_x < 7; $col_x++) {                
                $sx .= '<a href="' . base_url('index.php/iiifs/image/' . $img . '/' . ($x-$size) . '/' . ($y-$size) . '/' . ($zoom + 1)) . '" border=0>';
                //$sx .= $y.'x'.$x.'x'.$size.'x'.$res.'<br>';
                $sx .= '<img src="http://143.54.114.150:8182/iiif/2/018.tif/' . $x . ',' . $y . ',' . $size . ',' . $size . '/' . $pixel . ',/0/color.jpg">';
                $sx .= '</a>';
                $x = $x + $zoom_r;
            }
            $y = $y + $size;
            $sx .= '<br>';
        }
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
    }

    public function index() {
        $this -> cab();
        redirect(base_url('index.php/iiifs/image'));
        $this -> load -> view('content', $data);

    }

}
?>
