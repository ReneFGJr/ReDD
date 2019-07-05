<?php
class watsons extends CI_model {
    var $apikey_synthesize = 'NThtwQsdBiFwfFYRWPcfWSn6bTnCzxiYh7EWmRy1oQKQ';
    var $apikey_natural = 'tcxV1thp6QK-1hSXM-x2fOxNWZSyFgtB5Zq2lLeiN4ZW';
    var $apikey_translate = 'THwuqYUriwnikgiHTZhJR5R0lv8xyemZbUkhzpOSQQ2K';

    //print_r($response);
    //exit;
    
    function Translator($txt='')
        {
         // \"text\": [\"Hello, world! \", \"How are you?\"], 
         //\"model_id\":\"en-es\"}" "{url}/v3/translate?version=2018-05-01"

        $url = 'https://gateway.watsonplatform.net/language-translator/api/v3/translate?version=2018-05-01';
        $txt = 'The Sun is big and light';
        $headers = array('Accept: application/json', 'Content-Type: application/json', );
        $data = array();
        $data['model_id'] = 'pt_BR-en';
        $data['text'] = $txt;
        $data['features'] = array(
                    'keywords'=>array('sentiments'=>true, 'emotion'=>true,'limit'=>30),
                    'entities'=>array('sentiments'=>true, 'emotion'=>true,'limit'=>100),
                    'concepts'=>array('limit'=>30),
        
        );
        $data['version'] = date("Y-m-d");
        echo '<pre>';
        print_r(json_encode($data));
        echo '</pre>';
        //exit;
        $method = "PUT";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey:' . $this->apikey_translate);
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo '<pre>';
        print_r($response);
        echo '</pre>';
            
                    }
    
    function NLP($txt='') {
        $url = 'https://gateway-wdc.watsonplatform.net/natural-language-understanding/api/v1/analyze';
        $headers = array('Accept: application/json', 'Content-Type: application/json', );
        $data = array();
        //$data['text'] = "Ola Mundo";
        //
        //$data['features'] = array('keywords'=> array('limit'=>3));
        //
        //$data['url'] = 'www.brapci.inf.br/index.php/res/indice/subject/A';
        $data['text'] = $txt;
        $data['features'] = array(
                    'keywords'=>array('sentiments'=>true, 'emotion'=>true,'limit'=>30),
                    'entities'=>array('sentiments'=>true, 'emotion'=>true,'limit'=>100),
                    'concepts'=>array('limit'=>30),
        
        );
        $data['version'] = date("Y-m-d");
        $method = "PUT";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey:' . $this->apikey_natural);
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $rst = json_decode($response, true);
        return($rst);
    }    

    function synthesize() {
        $url = 'https://stream.watsonplatform.net/text-to-speech/api/v1/synthesize';
        $url .= '?voice=pt-BR_IsabelaV3Voice&text=Ola%20Mundo';
        
        $headers = array('Accept: audio/wav', 'Content-Type: application/json', );
        $data = array();
        $data['text'] = "Bem vindo a disciplina de curadoria digital do curso de Biblioteconomia da Universidade Federal do Rio Grande do Sul";
        $data['text'] = "Apresenta análise transversal de folksonomias para estudo da linguagem dos usuários de informação na área de Pediatria. Tem como pressuposto de pesquisa que as tags podem ser fonte de coleta de candidatos a termos para atualização de vocabulários controlados.";
        $method = "PUT";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey:' . $this->apikey_synthesize);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $rlt = fopen("d:\lixo\a.wav","w+");
        fwrite($rlt,$response);
        fclose($rlt);
    }

    /*
     *
     curl -X GET -u "apikey:{apikey}" \
     --output hola_mundo.wav \
     "{url}/v1/synthesize?accept=audio%2Fwav&text=hola%20mundo&voice=es-ES_EnriqueVoice"
     /v1/synthesize
     *
     */

    /*
     * Vozes
     *
     * es-US_SofiaVoice
     * pt-BR_IsabelaVoice
     * pt-BR_IsabelaV3Voice (ótima)
     */
}
?>