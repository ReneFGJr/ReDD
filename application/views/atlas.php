<script>
	function newxy(url, xx, yy) {
		NewWindow = window.open(url, 'newwin', 'scrollbars=no,resizable=no,width=' + xx + ',height=' + yy + ',top=10,left=10');
		NewWindow.focus();
		void (0);
	}
</script>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fullscreen Pageflip Layout with BookBlock</title>
        <meta name="description" content="Fullscreen Pageflip Layout with BookBlock" />
        <meta name="keywords" content="fullscreen pageflip, booklet, layout, bookblock, jquery plugin, flipboard layout, sidebar menu" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="http://[::1]/projeto/Biblioteca_Facil/css/jquery.jscrollpane.custom.css" />
        <link rel="stylesheet" type="text/css" href="http://[::1]/projeto/Biblioteca_Facil/css/bookblock.css" />
        <link rel="stylesheet" type="text/css" href="http://[::1]/projeto/Biblioteca_Facil/css/flip_custom.css" />
        <script src="http://[::1]/projeto/Biblioteca_Facil/js/modernizr.custom.79639.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <style>
            #codrops-ad-wrapper {
                top: 10px !important;
                right: 40px !important;
            }
        </style>
    </head>
    <!DOCTYPE html>
    <body>
        <div id="container" class="container" style="border: 1px solid #000000;">

            <div class="menu-panel">
                <h3>Table of Contents</h3>
                <ul id="menu-toc" class="menu-toc">
                    <li class="menu-toc-current">
                        <a href="#item1">[1]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[2]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[3]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[4]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[5]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[6]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[7]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[8]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[9]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[10]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[11]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[12]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[13]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[14]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[15]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[16]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[17]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[18]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[19]</a>
                    </li>
                    <li class="menu-toc-current">
                        <a href="#item1">[20]</a>
                    </li>
                </ul>

            </div>

            <div class="bb-custom-wrapper">
                <div id="bb-bookblock" class="bb-bookblock">

                    <?php for ($r=1;$r < 90;$r++) {
                        $img = (($r-1)*2)-1;
                    ?>
                    <div class="bb-item" id="item<?php echo $r;?>">
                        <div class="content">
                            <div class="scroller">
                                <nobr>
                                    <img src="http://143.54.114.150:8182/iiif/2/<?php echo strzero($img,3).'.tif';?>/full/800,/0/default.jpg" width="50%" onclick="newxy('<?php echo base_url('index.php/atlas/zoom/'.strzero($img,3).'.tif');?>',620,800);">
                                    <img src="http://143.54.114.150:8182/iiif/2/<?php echo strzero($img+1,3).'.tif';?>/full/800,/0/default.jpg" width="50%" onclick="newxy('<?php echo base_url('index.php/atlas/zoom/'.strzero($img+1,3).'.tif');?>',800,600);">
                                    <br>
                                    Autor: Direitos reservados &copy; 2018 - Atlas - CEDAP - UFRGS<nobr></nobr>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <nav>
                    <span id="bb-nav-prev">&larr;</span>
                    <span id="bb-nav-next">&rarr;</span>
                </nav>

                <span id="tblcontents" class="menu-button">�ndice</span>

            </div>

        </div><!-- /container -->

        <script src="http://[::1]/projeto/Biblioteca_Facil/js/jquery.mousewheel.js"></script>
        <script src="http://[::1]/projeto/Biblioteca_Facil/js/jquery.jscrollpane.min.js"></script>
        <script src="http://[::1]/projeto/Biblioteca_Facil/js/jquerypp.custom.js"></script>
        <script src="http://[::1]/projeto/Biblioteca_Facil/js/jquery.bookblock.js"></script>
        <script src="http://[::1]/projeto/Biblioteca_Facil/js/page.js"></script>
        <script>
			$(function() {

				Page.init();

			});
        </script>
    </body>
</html>
