<?php
define("PATH","index.php/main/");
define("LIBRARY_NAME","ReDD-Service");
class Main extends CI_controller {
    var $logo = 'img/redd/background_service_place.png';
    function __construct() {
        parent::__construct();
        $LANG = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (strpos(' '.$LANG,'pt-BR') > 0)
        {
            $this -> lang -> load("main", "pt_br");
            $this -> lang -> load("hellper_socials", "pt_br");
        } else {
            $this -> lang -> load("main", "en");
            $this -> lang -> load("socials", "en");
        }
        $this -> load -> database("redd");
        $this -> load -> helper('form');
        $this -> load -> helper('form_sisdoc');
        $this -> load -> helper('email');
        $this -> load -> helper('url');        
        $this -> load -> library('session');
        $this -> load -> library('zip');
        $this -> load -> helper('xml');
        
        $this -> load -> library('curl');
        $this -> load -> helper('rdf');
        $this -> load -> model('serviceplace');
        $this -> load -> helper('socials');
        date_default_timezone_set('America/Sao_Paulo');
        /* Security */
        //      $this -> security();
    }

     public function x()
        {
$t = '
ZHANG F;  ZETSCHE B;  GOOTENBERG J;  ABUDAYYEH O;  SLAYMAKER I;  ABUDAYYEH O O;  GOOTENBERG J S;  JONATHAN S G;  OMAR O A;  GOOTENBERG Y S;  SCRIMGEOUR I
LIU J;  YI P;  CHEN S;  NI Y
BROGDON J;  GILL S;  GLASS D;  KENDERIAN S;  LOEW A;  MANNICK J;  MILONE M;  MURPHY L;  PORTER D L;  RUELLA M;  WANG Y;  WU Q;  ZHANG J;  MILONE M C;  PORTER D;  LOH A;  MENNIK J;  MILLEN M;  POTTER D L;  BROGDON Y;  MANNICK Y;  ZHANG Y;  GLASS D J;  GRASS D;  JENNIFER B;  ANDREAS L
FAN X;  WANG L;  WANG P;  ZHOU Z;  ZHUANG Q;  CHOU C;  HAO J;  YANG L;  HE X;  ZHAO D;  CHOU C C;  ZHOU C
BROGDON J;  EBERSBACH H;  GILL S;  GLASS D;  HUBER T;  JASCUR J;  KENDERIAN S;  MANNICK J;  MILONE M C;  MURPHY L;  RICHARDSON C;  SINGH R;  SONG H;  WU Q;  ZHANG J;  EBERSBACH H E;  MENNIK J;  BROGDON Y;  JASCUR YU;  MANNICK Y;  ZHANG Y;  GRASS D
ZHANG F;  GAO L;  ZETSCHE B;  SLAYMAKER I
ZHANG F;  HSU P;  GOOTENBERG J;  SMARGON A;  GOOTENBERG J S
AFEYAN N B;  BERRY D;  GORDON N;  KAPLAN J;  RAHMAN S;  AFEYAN N;  RAMAN S;  CAPLAN J
FRENDEWEY D;  LAI K V;  AUERBACH W;  LEE J D;  MUJICA A O;  DROGUETT G;  TRZASKA S;  HUNT C;  GAGLIARDI A;  VALENZUELA D M;  VORONINA V;  MACDONALD L;  MURPHY A J;  YANCOPOULOS G D;  LAI K M V;  VORONINA L V;  FRENDEVEY D;  AUERBACH V;  MCDONALD L;  YANKOPULOS G D;  MURPHY A;  LAI K;  VALENZUELA D;  YANCOPOULOS G
CHATTERJEE S;  SMITH L;  WONG K;  SMITH L J;  CHAETEOJI S;  SEUMISEU R
JUNE C H;  POWELL D J
JOUNG J K;  KLEINSTIVER B
BRENT JENS R J;  SMITH E L;  LIU C;  BRENTJENS R J;  BRENT J R J;  BRENT JENS R;  SMITH E;  RENIER J B J;  ERIC L S;  BRENTYENS R J;  LIU CH
BITTER H;  BORDEAUX J M;  BRANNETTI B;  BROGDON J;  DAKAPPAGARI N K;  GILL S;  HIGHFILL S;  HUANG L;  JUNE C H;  KIM J Y;  LEI M;  LI N;  LOWE A;  ORLANDO E;  RUELLA M;  TRAN T;  ZHANG J;  ZHOU L;  LOEW A;  KIM J;  BORDEAUX J;  DAKAPPAGARI N;  JUNE C;  BIT H;  LEE N;  LOH A;  BORDEAUX Y M;  BROGDON Y;  KIM YU Y;  LOVE A;  ZHANG Y
COX D B T;  DAHLMAN J E;  ZHANG F
FOTIN-MLECZEK M;  HOERR I
COTTA-RAMUSINO C
VALAMEHR B;  ABUJAROUR R;  LEE T T;  LAN W;  CLARKE R;  BJORDAHL R;  LI T T;  RYAN W;  CLARK R;  LEE T;  RAEDUN C
PORTEUS M H;  HENDEL A;  CLARK J;  BAK R O;  RYAN D E;  DELLINGER D J;  KAISER R;  MYERSON J;  HENDL A;  CLARKE J
QIAN Y;  DONG H;  WANG J;  BERLIN M;  SIU K;  CREW A P;  CREWS C M;  CREW A;  CREWS C
GORI J L;  GORI J
MUSUNURU K;  COWAN C A;  ROSSI D J
MOTZ G;  BUSHMAN F D;  FRAIETTA J A;  JUNE C H;  MELENHORST J J;  NOBLES C L;  YOUNG R M;  FRAIETTA Y A;  MELENHORST YA J;  NOBLES CH L
ZHANG F;  YAN W;  NUREKI O;  ZHENG K;  CONG L;  NISHIMASU H;  RAN F;  LI Y
WANG P;  HAN X;  BRYSON P
QI L S;  DING S;  YU C;  QI L
LI L
VAN DER OOST J
GUO T;  FENG Y;  XIE A
KUNO J;  AUERBACH W;  VALENZUELA D M;  KUNO YU;  AUERBACH V;  VALENZUELA D
KESTI M;  ZENOBI-WONG M;  MULLER M;  MueLLER M;  MUELLER M
WAGERS A J;  TABEBORDBAR M;  CHEW W L;  CHURCH G M
DOUDNA J A;  LIN S;  STAAHL B T
KORNETE M;  JEKER L;  JACK L
MEISSNER T B;  FERREIRA L M R;  STROMINGER J L;  COWAN C A;  MEISSNER T;  FERREIRA L;  STROMINGER J;  COWAN C
KUTNER R H;  GORMAN W;  PIERCIEY F J;  PIERCIEY J F J
CONWAY A;  COST G J;  HOLMES M C;  URNOV F
KEVLAHAN S H;  BALL A;  QIN G;  WELLS S B;  BAUER A
ZHANG F;  ZETSCHE B;  RAN F;  DAHLMAN J E
VAN DEN BRINK M;  JENQ R;  PAMER E G;  TAUR Y;  SHONO Y;  VAN D B M
CHO Y W;  CHOI J S;  YANG S H;  LEE K;  KIM E J;  YOON H I;  KIM J S;  LEE K S;  ZHAO R;  CHOI J;  YANG S;  KIM E;  YOON H;  KIM J;  CHO Y V;  CHOI Y S;  KIM E Y;  KIM YU S;  CUI Z;  LIANG C;  LI G;  JIN Y;  YIN H;  JIN J
MUSUNURU K;  COWAN C A;  ROSSI D J
ZHANG F;  ZETSCHE B;  HEIDENREICH M;  CHOUDHURY S
DRANOFF G
BOITANO A E;  COOKE M;  KLICKSTEIN L B;  LESCARBEAU R;  MICKANIN C S;  MULUMBA K;  POLICE S R;  SNEAD J;  STEVENSON S C;  STEWART M;  YANG Y;  COOK M;  SNEAD Y;  STEVART M;  YAN I
BOT A;  WIEZOREK J S;  GO W;  JAIN R;  KOCHENDERFER J N;  ROSENBERG S A;  WIEZOREK J;  KOCHENDERFER J;  ROSENBERG S;  GE W
WILSON J M;  WANG L;  YANG Y;  WILSON J
WELSTEAD G G;  GORI J L;  HEATH J M;  BUMCROT D A
PORTEUS M H;  CRADICK T J;  BAO G;  LEE C M;  PORTEUS M;  CRADICK T;  LEE C
OLSON E N;  LONG C;  MCANALLY J R;  SHELTON J M;  BASSEL-DUBY R;  BASSEL D R
LOEW A;  VASH B E;  LOWE A
DELGUIDICE T;  GUAY D;  LEPETIT-STOFFAES J;  LEPETIT S J P;  DEL APOS G T;  DAVID G;  JP L;  DEL APOS GUIDICE T
COTTA-RAMUSINO C;  GORI J L;  GORI J
MARSON A;  DOUDNA J;  BLUESTONE J;  SCHUMANN K;  LIN S
KIM J S;  HWANG D Y;  KIM J;  HWANG D;  JIN J
CONWAY A;  COST G J;  GREGORY P D
LOBB R;  RENNERT P
LEE G K;  RILEY B E;  ST MARTIN S J;  WECHSLER T;  ST M S J
GORI J L;  WANG T;  JAYARAM H;  ODONNELL P;  GORI J
FINER M H;  GREENBERG K P;  COHEN J B;  GLORIOSO J C;  GLORIOSO I J C
LEWIS J A;  HOMAN K A;  KOLESKY D B;  TRUBY R L;  SKYLAR-SCOTT M A
SKARNES W C;  KOUSTSOURAKIS M
LIM W A;  MORSUT L;  ROYBAL K T;  FARLOW J T;  TODA S
DOUCEY M;  XENARIOS I;  GUEX N;  CRESPO I
DIMAIO J M;  FAN W;  LI W;  MO W;  THATCHER J E;  DIMAIO J;  THATCHER J
SHEN Y;  CHEN Y
CREW A;  CREWS C;  DONG H;  KO E;  WANG J
JIN H;  LI L;  QIAN Q;  WANG Y;  WU H;  WU M;  YE Z;  ZHANG H
SEWING S;  MOISAN A;  BOESS F;  ROTH A B;  BERTINETTI-LAPATKI C
MURTHY N;  LEE K;  CONBOY I M;  CONBOY M J
FOTIN-MLECZEK M;  KOWALCZYK A;  HEIDENREICH R;  BAUMHOF P;  PROBST J;  KALLEN K;  FOTIN M M;  KALLEN K J;  KOVALCZYK A;  PROBST Y;  KALLEN K Y
BROWN R;  CHOO B H A;  LUK T S L
CHEN J;  HUANG Q;  LIAO W
DENG Y;  REN Y;  WANG R;  JIN B;  HE J
REGEV A;  PARNAS O;  JOVANOVIC M;  HACOHEN N;  EISENHAURE T
COST G J;  MILLER J C;  ZHANG L
STRUM J C;  BISI J E;  ROBERTS P J;  SORRENTINO J A;  STORRIE-WHITE H;  WHITE H S;  BISI J
CHAUDHARY P M
LEE G K;  PASCHON D;  ZHANG L
NG H H;  CHAN Y S;  TNG W J;  NG H;  CHAN Y
LEWIS J A;  SKYLAR-SCOTT M A;  KOLESKY D B;  HOMAN K A;  NG A H M;  CHURCH G M;  LEWIS J;  SKYLAR-SCOTT M;  KOLESKY D;  HOMAN K;  NG A;  CHURCH G
PORTEUS M H;  PORTEUS M
GUILAK F;  BRUNGER J M;  GERSBACH C A
CLUBE J R;  CLUBE J
PETRI W A;  BUONOMO E
WHITE B H;  ALARGOVA R G;  BAZINET P R;  DUNBAR C A;  LIM SOO P;  SHINDE R R;  BILODEAU M T;  KADIYALA S;  WOOSTER R;  BARDER T;  WHALEN K;  GIFFORD J;  LIM S P
SALTZMAN W M;  GLAZER P;  BAHAL R;  MCNEER N A;  LY D H;  QUIJANO E
YIN H;  ANDERSON D G;  LANGER R S
VALAMEHR B;  CLARKE R;  BJORDAHL R;  CLARK R;  RAEDUN C
CROOKS G M;  HAGEN A C M;  SEET C S;  MONTEL-HAGEN A;  MONTEL H A;  SEET C
DEVER D P;  BAK R O;  HENDEL A;  SRIFA W;  PORTEUS M H
DUSSEAUX M
FANG F;  LI Y;  WANG J;  QIU L;  YU G;  ZHAO J;  HE W
PORTEUS M H;  PORTEUS M;  P;  M;  H;  CRADICK T J;  BAO G;  LEE C M
GATENHOLM P
BHATTACHARJEE S;  CHATTERJEE S;  GHOSH M;  HALAN V;  HAZARIKA J;  HORA A;  KURUP A;  MAITY S;  MALIWALAVE A;  NAIR K;  PATHAK P K;  PENDSE R;  PRASAD B;  RAO S B;  RODRIGUES K I;  SHENOY B R;  SRINIVASAN S;  THANIGAIVEL A;  UNNIKRISHNAN D;  M P;  D P K;  K V;  B M Y M;  N B;  PAVITHRA M;  PRAVIN KUMAR D;  SATHYABALAN M;  VEERASHA K;  YOGENDRA MANJUNATH B M;  BAIRAVABALAKUMAR N;  KUMAR P D;  VEERESHA K;  MANJUNATH Y B M;  SHENOY B;  M S;  B. M. Y M;  D PRAVIN K
COWAN C A;  FERREIRA L M R;  MEISSNER T B;  STROMINGER J L;  COWAN C;  FERREIRA L;  MEISSNER T;  STROMINGER J
WANG T
BACHMANN M;  EHNINGER A
GUNTHER C;  THEOHARIS S;  HERMANN F;  HUSS R;  GACENTHER C;  HAAS R;  GUENTHER C;  GAOENTHER C
QIN L;  HAN X;  LIU Z;  MA Y;  ZHANG K
KIM S;  LEE W J;  CHOI E W;  SEO M K;  WOO E Y;  PARK E J
CHURCH G M;  YANG L;  GUELL M;  GOLL M
CHOUDHRY M;  MCIVOR R S;  MORIARITY B;  WEBBER B;  LARGAESPADA D;  ROSENBERG S A;  PALMER D C;  RESTIFO N P
JIN S;  COLLANTES J
RUBIN L;  DAVIDOW L;  ROSSI D J;  EBINA W;  STEWART M;  GUTIERREZ-MARTINEZ P;  RUBIN L L
PETIT R;  PERRY K;  PRINCIOTTA M F;  OCONNOR D J;  O CONNOR D J
BAUER D E;  ORKIN S H;  SANJANA N;  SHALEM O;  ZHANG F
LI Y;  SHEN Z;  SHAO L
CHANG L
FREISSMUTH M;  ZEBEDIN-BRANDL E;  KAZEMI Z;  OSTERREICHER C;  LEMBERGER U;  THEMANNS M;  ZEBEDIN B E M;  OESTERREICHER C;  F;  M;  Z;  E;  K;  O;  C;  L;  U;  T;  A-STERREICHER C;  OeSTERREICHER C;  ZEBEDIN-BRANDL E M;  STERREICHER C
KANG L;  ZHANG X;  HARRIS J;  JANKOVIC V
ELLING U;  HOPFGARTNER B;  PENNINGER J;  ZUBER J
GOODMAN B;  SANDY P;  PAPKOFF J;  PONICHTERA H;  SIZOVA M;  BODMER M
BUSSER B;  DUCHATEAU P;  JUILLERAT A;  POIROT L;  VALTON J;  VALTON YU
ZHANG F;  SCOTT D A;  YAN W X;  CHOUDHURY S;  HEIDENREICH M;  CHOWDHURY S
HARTIGAN A;  MORROW D;  NIXON A;  WILLIAMS A
SADELAIN M W J;  EYQUEM J G A;  MANSILLA-SOTO J;  EYQUEM J G A F;  MANSILLA S J
DE SILVA S;  FROMM G;  SCHILLING N;  SCHREIBER T;  VROOM G;  SILVA S D;  DE S S
HAN R;  XIAO J;  ZHU J
TER-OVANESYAN D;  KOWAL E J K;  CHURCH G M;  REGEV A
CHEN Z
FANG S;  DAI H;  LIU H;  YANG C;  WANG Y;  XING X;  XUE C;  ZHANG Y;  BI H;  YAN B
LI W
ZHANG W;  LI W;  ZHANG X;  CHAN J;  SHAN J;  ZHANG Q
LUNDBERG A S;  KULKARNI S;  KLEIN L;  PADMANABHAN H K
PARK A;  LEE B;  WATKINSON R
ZHANG D;  YANG Y;  FENG P;  ZHANG H;  DU B;  WANG H
LUO T
COWAN C A;  KABADI A M;  LUNDBERG A S
LEE G K;  PASCHON D;  ZHANG L
KIM J;  HUR J H;  KIM D;  KIM J E;  KIM K;  KIM H;  KOO T;  KIM J S;  KIM K M;  KIM H R
DEISSEROTH K A;  GOODMAN L
KABADI A M;  COWAN C A;  LUNDBERG A S
SFEIR A;  MATEOS-GOMEZ P
BROGUIERE N;  ZENOBI-WONG M
HIRAIDE R;  KELLY B;  SHIMODA H;  SUTO K;  TANABE K;  TANABE T;  SUDO K
';
    $ln = explode(chr(13),$t);
    $aus = array();
    for ($r=0;$r < count($ln);$r++)
        {        
            $l = splitx(';',$ln[$r]);
            for ($n=0;$n < count($l);$n++)
                {
                    for ($q=0;$q < count($l);$q++)
                    {
                        $x = $l[$q];
                        $aus[$x] = 1;
                    }                
                }
        }
        foreach ($aus as $nome=>$a)
            {
                echo '(AU="'.$nome.'") OR ';
            }
    }   
    
    public function cab($navbar = 1) {
        $data['title'] = ':: ReDD :: Services ::';
        $this -> load -> view('redd/header/header', $data);
        if ($navbar == 1) {
            $this -> load -> view('header/navbar_main', null);
        }
    }
    
    public function footer() {
        $this -> load -> view('header/footer');        
    }
    
    function main($act='',$d1='',$d2='',$d3='') {
        redirect(base_url(PATH));
    }
    
    function index($act='',$d1='',$d2='',$d3='') {
        $tela = '';
        $this -> cab();
        $sx = '';
        if (strlen($act) == 0)
        {
            $this->load->view("welcome_service_place");
        }
        $sx .= $this->serviceplace->main($act,$d1,$d2,$d3);
        $data['content'] = $sx;
        $this -> load -> view('content', $data);
        $this -> footer();
    }

    function social($act = '',$id='',$chk='') {
        $this -> cab();
        $socials = new socials;        
        $socials->social($act,$id,$chk);
        return('');
    }  
    
    function about($act = '',$id='',$chk='') {
        $this -> cab();
        return('');
    }    

    function contact($act = '',$id='',$chk='') {
        $this -> cab();
        return('');
    }    

    function services($act = '',$id='',$chk='') {
        $this -> cab();
        $tela = $this->serviceplace->services();
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }    

    function edit($id,$chk='') 
    {
        $tela = '';
        $this -> cab();
        $tela = $this -> trans -> edit($id,$chk);
        $data['content'] = $tela;
        $this -> load -> view('content', $data);
        $this -> footer();
    }       
}
?>
