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
        $txt = 'A Escola de Biblioteconomia da UFMG foi fundada em 1950, tendo seu nome mudado para Escola de Ciência da Informação em 2000. Atualmente, possui três cursos de graduação: Biblioteconomia, Arquivologia e Museologia, estes últimos criados por ocasião do REUNI. O corpo docente é composto por 44 professores e 46 funcionários.
O Programa de Pós-Graduação na ECI iniciou-se em 1976, com o curso de mestrado em Biblioteconomia, com área de concentração em Administração de bibliotecas. Os avanços nos estudos sobre a informação, aliados às influências das novas tecnologias, conduziram a uma reestruturação do curso, que em 1991 passou a denominar-se Curso de Pós-Graduação em Ciência da Informação, nível de mestrado. O curso de doutorado foi implementado em 1997, levando a uma nova mudança do nome do programa, que passou a ser Programa de Pós-Graduação em Ciência da Informação - PPGCI/UFMG. Atualmente o Programa conta com 25 professores.
O objetivo do PPGCI/UFMG é propiciar o aprofundamento do conhecimento acadêmico em Ciência da Informação, bem como possibilitar o desenvolvimento de competências para a pesquisa e docência nessa área. Sua filosofia é a de refletir criticamente sobre a organização, disponibilização, gestão e uso da informação, a partir de uma perspectiva interdisciplinar. Além de promover a geração do conhecimento no seu domínio específico, o PPGCI se propõe a rever teorias e práticas tradicionais, com vistas à introdução de inovações no âmbito da pesquisa científica e no desenvolvimento profissional. Para isso, procura-se utilizar e criar novos recursos tecnológicos e novas metodologias de investigação.
O PPGCI/UFMG estrutura-se em torno de duas vertentes de disciplinas: (1) disciplinas do núcleo fixo, que constituem o campo específico de conhecimento em Ciência da Informação; e (2) disciplinas de domínio conexo, consideradas necessárias para complementar a formação do aluno. As atividades relacionadas ao mestrado têm a duração máxima de dois anos. As atividades relacionadas ao doutorado têm a duração máxima de quatro anos. Alguns mecanismos foram previstos para integração com a Graduação, bem como com outros níveis de pós-graduação: (1) oferta de disciplinas na graduação ministradas por docentes, mestrandos e doutorandos do Programa; (2) orientação de bolsistas de iniciação científica; (3) orientação do estágio curricular de alunos de graduação; (4) monitoria de pós-graduação.';
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
        $data['text'] = "This paper aims at bringing Mario Bunge´s theoretical contributions to the scientific enterprise into the realm of Information Science. The study is justified by the area´s interdisciplinary nature and its constant need for interaction with other knowledge areas. It is a theoretical essay based on the analysis of information science concepts and on Bunge´s systemism. We further extend the study with the application of fundamentals of systemism in two related studies, one descriptive, other explanatory, on institutional repositories, thus exemplifying research conduction under the fundamental epistemic operation in systemism: the reduction to the system.";
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