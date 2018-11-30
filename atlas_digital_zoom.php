<head>
    <title>Visualizador de Imagem</title>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }
    
    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body onload="loaded()">
<div id="loading">
    <center>
        <div class="loader" id="loader"></div>
    </center>
</div>

<?php
$img = $_GET['img'];
echo '
<link rel="stylesheet" 
                type="text/css"
                media="screen"
                href="css/atlas_osd.css"/>    
                <script src="http://www.ufrgs.br/fabrico/atlas/openseadragon/openseadragon.min.js"></script>                
                <div id="demoarea" class="demoarea" style="display: none;">
                <div id="example-inline-configuration-for-image"
                     class="openseadragon">
                    <script type="text/javascript">
                        OpenSeadragon({
                            id:            "example-inline-configuration-for-image",
                            prefixUrl:     "http://www.ufrgs.br/fabrico/atlas/openseadragon/images/",
                            tileSources:   {
                                type: "image",
                                url:  "https://cedap.ufrgs.br/xmlui/bitstream/handle/2050011959/1180/'.$img.'"
                            }
                        });
                    </script>
                </div>
                </div>        
                </div>
';
?> 
<script>
    function loaded()
        {
            document.getElementById("demoarea").style.display = "block";
            document.getElementById("loading").style.display = "none";
        }
</script>               