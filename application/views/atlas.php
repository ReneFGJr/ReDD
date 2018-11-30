<script>
	function newxy(url, xx, yy) {
		NewWindow = window.open(url, 'newwin', 'scrollbars=no,resizable=no,width=' + xx + ',height=' + yy + ',top=10,left=10');
		NewWindow.focus();
        NewWindow.moveTo(0, 0);
        NewWindow.resizeTo(screen.width, screen.height);		
		void (0);
	}
</script>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atlas Ambiental de Porto Alegre</title>
        <meta name="description" content="Fullscreen Pageflip Layout with BookBlock" />
        <meta name="keywords" content="fullscreen pageflip, booklet, layout, bookblock, jquery plugin, flipboard layout, sidebar menu" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.jscrollpane.custom.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bookblock.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/flip_custom.css');?>" />
        <script src="<?php echo base_url('js/modernizr.custom.79639.js');?>"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');?>"></script>

        <style>
            #codrops-ad-wrapper {
                top: 10px !important;
                right: 10px !important;
            }
        </style>
    </head>
    <!DOCTYPE html>
    <body>
        <div id="container" class="container">
            <?php
            $lb = array();
            $lbt = array();
            $lb[1] = 'Capa';
            $lb[2] = 'Pré-textuais';
            $lb[6] = 'Folha de rosto';
            $lb[8] = 'Apresentação';
            $lb[9] = 'Sumário';
            
            $lb[11] = 'I. O Sistema Natural';
            $lb[14] = '1 Porto Alegre antes do Homem';
            $lb[16] = '1.2 O Continente gigante de Gondwana';
            $lb[18] = '1.3 As grandes flutuações do nível do mar no Quartenário';
            $lb[21] = '2 As formas da superfície';
            $lb[22] = '2.1 Porto Alegre: modelo de constrastes';
            $lb[26] = '3 Lagos, rios e arroios';
            $lb[30] = '4 Solos: a fina camada';
            $lb[32] = '5 As formações vegetais';
            $lb[38] = '6 Biotopos naturais';
            $lb[45] = '7 Elementos do clima';
            $lb[48] = '8 Unidade de conservação ambiental';
            $lb[56] = 'II. O Sistema Construído';
            $lb[62] = '10 A organização urbana';
            $lb[68] = '11 Evolução das áreas verdes: dos largos às praças e parques arbonizados';
            $lb[75] = '12 Cidade das árvores';
            $lb[82] = '13 Clima urbano';
            $lb[84] = '14 Atividades impactantes do sistema urbano';
            $lb[96] = '15 Serviços de saneamento';
            $lb[103] = 'III. A Gestão Ambiental';
            $lb[105] = '16 A busca do desenvolvimento sustentável em ambientes urbanos';
            $lb[108] = '17 A gestão ambiental pública';
            $lb[110] = '18 Porto Alegre em Dados (1998)';
            $lb[111] = '* Indicadores ambientais, área verde e saneamento';
            $lb[112] = '* Bibliografias sobre sistemas natural e construído';
            $lb[116] = '* Créditos da versão impressa';
            $lb[117] = '* Sumário da versão impressa';
            $lb[118] = '* Índice da versão impressa';
            $lb[123] = 'Contra capa';
            
            
            $it = 1;
            ?>
            <div class="menu-panel">
                <h3>Tabela de conteúdo</h3>
                <ul id="menu-toc" class="menu-toc">
                     <?php
                     /* Textual */ 
                     for ($r=1;$r < 190;$r++) {
                         $vs = 'display: none;';
                         $label = $r;
                        if (isset($lb[$r]))
                            {
                                $vs = '';
                                $label = $lb[$r]; 
                            }
                            echo '<li class="menu-toc-current" style="'.$vs.'">';
                            echo '<a href="#item'.$it.'">'.$label.'</a>';
                            echo '</li>'.cr();   
                            $it++;
                     }                      
                ?>
                </ul>

            </div>
            <?php $it = 1; ?>
            <div class="bb-custom-wrapper">
                <div id="bb-bookblock" class="bb-bookblock">
                    <!----------- CAPA -------------->
                    <div class="bb-item" id="item_capa">
                        <div class="content">
                            <div class="scroller">
                                <nobr>
                                    <!---
                                    <img src="http://www.ufrgs.br/atlas/digital/image/0001.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img=0001.jpg');?>',620,800);">
                                    <img src="http://www.ufrgs.br/atlas/digital/image/0002.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img=0002.jpg');?>',620,800);">
                                    --->
                                    <img src="http://www.ufrgs.br/atlas/digital/image/0001.jpg" width="50%" >
                                    <img src="http://www.ufrgs.br/atlas/digital/image/0002.jpg" width="50%" >
                                    <br>
                                    Autor: Direitos reservados &copy; 2018 - Atlas - CEDAP - UFRGS<nobr></nobr>
                            </div>
                        </div>
                    </div>                    

                    <?php for ($r=1;$r <= 7;$r++) {
                        $img = (($r-1)*2);
                        if ($img <= 1) { $img = 0; }
                    ?>
                    <div class="bb-item" id="item<?php echo $it++;?>">
                        <div class="content">
                            <div class="scroller">
                                <nobr>
                                    <img src="http://www.ufrgs.br/atlas/digital/image/_A<?php echo strzero($img,3).'.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img=A'.strzero($img,3).'.tif.jpg');?>',620,800);">
                                    <img src="http://www.ufrgs.br/atlas/digital/image/_A<?php echo strzero($img+1,3).'.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img=A'.strzero($img+1,3).'.tif.jpg');?>',800,600);">
                                    <br>
                                    Autor: Direitos reservados &copy; 2018 - Atlas - CEDAP - UFRGS<nobr></nobr>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                    

                    <?php for ($r=1;$r < 120;$r++) {
                        $img = (($r)*2)-1;
                    ?>
                    <div class="bb-item" id="item<?php echo $it++;?>">
                        <div class="content">
                            <div class="scroller">
                                <nobr>
                                    <img src="http://www.ufrgs.br/atlas/digital/image/<?php echo strzero($img,3).'.tif.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img='.strzero($img,3).'.tif.jpg');?>',620,800);">
                                    <img src="http://www.ufrgs.br/atlas/digital/image/<?php echo strzero($img+1,3).'.tif.jpg';?>" width="50%" onclick="newxy('<?php echo base_url('atlas_digital_zoom.php?img='.strzero($img+1,3).'.tif.jpg');?>',800,600);">
                                    <br>
                                    Autor: Direitos reservados &copy; 2018 - Atlas - CEDAP - UFRGS<nobr></nobr>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <nav>
                    <span id="bb-nav-prev" style="position: fixed; top: 10px; left: 60px; z-index: 100;">&larr;</span>
                    <span id="bb-nav-next" style="position: fixed; top: 10px; left: 100px; z-index: 100;">&rarr;</span>
                </nav>

                <span id="tblcontents" class="menu-button"  style="position: fixed; top: 10px; left: 20px; z-index: 100;">Índice</span>

            </div>

        </div><!-- /container -->

        <script src="<?php echo base_url('js/jquery.mousewheel.js');?>"></script>
        <script src="<?php echo base_url('js/jquery.jscrollpane.min.js');?>"></script>
        <script src="<?php echo base_url('js/jquerypp.custom.js');?>"></script>
        <script src="<?php echo base_url('js/jquery.bookblock.js');?>"></script>
        <script src="<?php echo base_url('js/page.js');?>"></script>
        <script>
			$(function() {

				Page.init();

			});
        </script>
    </body>
</html>
