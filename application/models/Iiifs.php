<?php
class iiifs extends CI_model {
    var $url = 'http://143.54.114.150:8182/iiif/2/';
    function reciver_info_image($image) {
        $url = $this -> url . $image;
        $headers = array('Accept: application/json', 'Content-Type: application/json', );
        echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        print_r($response);
        return json_decode($response, true);
    }

    function show($img) {
        $sx = '
            <link rel="stylesheet" 
                type="text/css"
                media="screen"
                href="'.base_url('css/atlas_osd.css').'"/>    
                <script src="http://www.ufrgs.br/fabrico/atlas/openseadragon/openseadragon.min.js"></script>
                <div id="container">
                <div class="demoarea">
                <div id="example-inline-configuration-for-image"
                     class="openseadragon">
                    <script type="text/javascript">
                        OpenSeadragon({
                            id:            "example-inline-configuration-for-image",
                            prefixUrl:     "http://www.ufrgs.br/fabrico/atlas/openseadragon/images/",
                            tileSources:   {
                                type: "image",
                                url:  "http://143.54.114.150:8182/iiif/2/'.$img.'/full/4096,/0/default.jpg"
                            }
                        });
                    </script>
                </div>
                </div>        
                </div>';
        return($sx);
    }

}
?>
