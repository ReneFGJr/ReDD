-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2017 at 03:31 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `redd`
--

-- --------------------------------------------------------

--
-- Table structure for table `artigo_publicado`
--

CREATE TABLE IF NOT EXISTS `artigo_publicado` (
`id_ap` bigint(20) unsigned NOT NULL,
  `ap_journal_id` int(11) NOT NULL,
  `ap_ano` char(4) NOT NULL,
  `ap_titulo` text NOT NULL,
  `ap_idioma` char(5) NOT NULL,
  `ap_vol` char(10) NOT NULL,
  `ap_serie` char(10) NOT NULL,
  `ap_autores` text NOT NULL,
  `ap_autor` char(16) NOT NULL,
  `ap_keywords` text NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=327 ;

--
-- Dumping data for table `artigo_publicado`
--

INSERT INTO `artigo_publicado` (`id_ap`, `ap_journal_id`, `ap_ano`, `ap_titulo`, `ap_idioma`, `ap_vol`, `ap_serie`, `ap_autores`, `ap_autor`, `ap_keywords`) VALUES
(1, 1, '2016', 'Usabilidade do Lume &amp;#45; RepositÃ³rio Digital da UFRGS: uma avaliaÃ§Ã£o por meio das heurÃ­sticas e de testes com usuÃ¡rios', 'pt_BR', '7', '1', 'SANTOS, D. B.; PAVÃO, C. M. G.; MOURA, A. M. M.', '1734997653639992', ''),
(2, 2, '2016', 'Scientific collaboration between Brazil and Spain: journals and citations', 'pt_BR', '21', '47', 'VANZ, S. A. A. S.; FILIPPO, D.; CAREGNATO, S. E.; GARCIA-ZORITA, C.; MOURA, A. M. M.; SÁNCHEZ, M. A. L. L.; SANZ-CASADO, E.', '1734997653639992', ''),
(3, 3, '2015', 'Desenvolvimento de habilidades informacionais: um estudo das atividades de educação de usuários aplicadas na Biblioteca do Colégio Israelita', 'pt_BR', '20', '1', 'PELISSARO, R. D.; MOURA, A. M. M.', '1734997653639992', 'Educação de usuário; Habilidades informacionais.'),
(4, 4, '2015', 'Panorama da produção conjunta entre Brasil e Espanha indexada na WoS entre 2006-2012: indicadores de Atividade, Especialização e Colaboração. Informação &amp; Sociedade (UFPB. Online)', 'pt_BR', '25', '', 'MOURA, A. M. M.; FILIPPO, D.; SÁNCHEZ, M. A. L. L.; VANZ, S. A. S.; CAREGNATO, S. E.', '1734997653639992', 'colaboração internacional; Produção Científica; Brasil; Espanha.'),
(5, 5, '2015', 'Ciência da Informação: história, conceitos e características', 'pt_BR', '21', '3', 'QUEIROZ, D. G. C.; MOURA, A. M. M.', '1734997653639992', 'ciência da informação.'),
(6, 6, '2015', 'Produção científica brasileira em células-tronco nos anos 2000 a 2013: características e colaboração internacional', 'pt_BR', '9', '2', 'SANTIN, D.; NUNEZ, Z. A.; MOURA, A. M. M.', '1734997653639992', 'Produção Científica; celulas tronco; colaboração internacional.'),
(7, 7, '2014', 'A Produção Tecnológica da Universidade Federal do Rio Grande do Sul no Período de 1990 a 2013', 'pt_BR', '9', '1', 'SCARTASSINI, V. B.; MOURA, A. M. M.', '1734997653639992', 'Bibliometria; Patentes; UFRGS.'),
(8, 8, '2014', 'A CIÊNCIA NO RIO GRANDE DO SUL: INDICADORES DE PRODUÇÃO E  COLABORAÇÃO NOS ANOS 2000 A 2010', 'pt_BR', '7', '1', 'CAREGNATO, S. E.; VANZ, S. A. S.; MOURA, A. M. M.; STUMPF, I. R. C.', '1734997653639992', ''),
(9, 9, '2013', 'Análise de Citações na área de Comunicação e Informação: o caso de um programa de pós-graduação', 'pt_BR', '11', '2', 'MOURA, A. M. M.; NUNEZ, Z. A.', '1734997653639992', 'Cientometria; Análise de citação.'),
(10, 10, '2012', 'Science in South Brazil: production overview between 2000 and 2010.', 'en', '3', '', 'STUMPF, I. R. C.; CAREGNATO, S. E.; MOURA, A. M. M.; VANZ, S. A. S.; A., R. V.', '1734997653639992', ''),
(11, 5, '2012', 'Motivação para a pesquisa, determinação de parcerias e divisão da coautoria e coinvenção: principais critérios utilizados pelos pesquisadores da área da Biotecnologia', 'pt_BR', '18', '', 'MOURA, A. M. M.', '1734997653639992', 'Bibliometria; Biotecnologia; Cientometria; coautoria.'),
(12, 11, '2011', 'Co- autoria em artigos e patentes: um estudo da interação entre a produção científica e tecnológica.', 'pt_BR', 'vol.16', 'n. 2', 'CAREGNATO, S. E.; MOURA, A. M. M.', '1734997653639992', 'ciência da informação; Comunicação Cientifica; Produção Científica; PRODUÇÃO INTELECTUAL.'),
(13, 2, '2010', 'Produção Científica dos Pesquisadores brasileiros que Depositaram Patentes na área da Biotecnologia, no período de 2001 a 2005: colaboração interinstitucional e interpessoal', 'pt_BR', '15', '29', 'MOURA, A. M. M.; CAREGNATO, S. E.', '1734997653639992', 'Bibliometria; Cientometria; Comunicação Cientifica; Produção Científica; Produção Tecnológica.'),
(14, 12, '2010', 'Co-classificação entre artigos e patentes: um estudo da interação entre C&amp;T na biotecnologia brasileira', 'pt_BR', '20', 'n.2', 'MOURA, A. M. M.; CAREGNATO, S. E.', '1734997653639992', 'Cientometria; Comunicação Cientifica; ciência da informação.'),
(15, 12, '2006', 'Inclusão Digital: Laços entre Bibliotecas e Telecentros', 'pt_BR', '16', '2', 'LAIPELT, R. C. F.; CAREGNATO, S. E.; MOURA, A. M. M.', '1734997653639992', ''),
(16, 2, '2006', 'Interações entre Ciência e Tecnologia: análise da produção intelectual dos pesquisadores-inventores da primeira carta-patente da UFRGS', 'pt_BR', '22', '', 'MOURA, A. M. M.; ROZADOS, H. B. F.; CAREGNATO, S. E.', '1734997653639992', ''),
(17, 13, '2004', 'Community telecentres in Brazil, the Porto Alegre experience : toward digital and social inclusion', 'pt_BR', '30', '', 'MOURA, A. M. M.; CAREGNATO, S.', '1734997653639992', 'Inclusão Digital; Telecentros Comunitários; Tecnologias da Informação e Comunicação.'),
(18, 5, '2003', 'Características do Processo de Busca de Informação dos Pesquisadores da Área de Psicologia da UNISINOS', 'pt_BR', '9', '', 'MOURA, A. M. M.', '1734997653639992', 'Busca de Informação; Tecnologias da Informação e Comunicação; ciência da informação; Fontes de Informação.'),
(19, 5, '2003', 'Análise das características e percepção de alunos de educação à distância : um estudo longitudinal no Curso de Biblioteconomia da UFRGS', 'pt_BR', '9', '', 'MOURA, A. M. M.; CAREGNATO, S.', '1734997653639992', 'educação a distância; ciência da informação; Tecnologias da Informação e Comunicação; ensino de Biblioteconomia; internet.'),
(20, 14, '2016', 'A biblioteca escolar e as crianças pequenas', 'pt_BR', '46', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(21, 15, '2014', 'Acessibilidade Arquitetônica em Diferentes Tipologias de Bibliotecas', 'pt_BR', '10', 'Especial', 'MORO, E. L. S.; GIACUMUZZI, G.', '7005124544331261', ''),
(22, 15, '2014', 'Projeto de Leitura Vivendo Histórias: vivendo a inclusão por meio da leitura numa casa geriátrica', 'pt_BR', '10', 'Especial', 'MORO, E. L. S.; TIMM, C.; TRESSINO, C. S.; GIACUMUZZI, G.', '7005124544331261', ''),
(23, 16, '2012', 'A Educação Aberta e a Distância e a Formação de Mediadores de Leitura através das Tecnologias de Informação e de Comunicação', 'pt_BR', '10', '3', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Educação Aberta e a Distância - EAD; mediadores de leitura.'),
(24, 3, '2011', 'Especialização em Bibliotecas Escolares e Acessibilidade: discutindo a gestão da biblioteca na modalidade EAD', 'pt_BR', '16', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'biblioteca escolar; EAD; acessibilidade; gestão de biblioteca.'),
(25, 17, '2011', 'Neue Tendenzen der Schulbibliotheken in Brasilien. Forum für die Verbesserung der Schulbibliotheken in Rio Grande do Sul, das Mobiliserungsprojekt und die Verabschiedung des Gesetzes über die Schulbibliotheken', 'dk', '35', '', 'SERAFINI, L. T.; ESTABEL, L. B.; MORO, E. L. S.; KAUP, U.', '7005124544331261', 'biblioteca.'),
(26, 18, '2011', 'A mediação da leitura na família, na escola e na biblioteca através das tecnologias de informação e de comunicação e a inclusão social das pessoas com necessidades especiais', 'pt_BR', '4', '', 'ESTABEL, L.; MORO, E. L. S.', '7005124544331261', 'Leitura; mediadores de leitura; informação.'),
(27, 3, '2010', 'Uma Proposta de Atendimento às Necessidades de Informação dos Usuários da Biblioteca Escolar por meio do Benchmarking e do Sensemaking', 'pt_BR', '15', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(28, 16, '2010', 'Internet na Biblioteca Escolar: Blog Biblioteca ETS: criação e evolução desta ferramenta na WEB 2.0. RENOTE. Revista Novas Tecnologias na Educação', 'pt_BR', '8', '', 'COUTINHO, K. T.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'tecnologias de informação e de comunicação; biblioteca escolar.'),
(29, 19, '2009', 'A Formação de Professores e a Capacitação de Bibliotecários com limitação Visual através da EAD em Ambiente Virtual de Aprendizagem', 'pt_BR', '21', '', 'ESTABEL, L.; MORO, E. L. S.', '7005124544331261', ''),
(30, 20, '2008', 'Gestão da biblioteca escolar: metodologias, enfoques e aplicação de ferramentas de gestão e serviços de biblioteca', 'pt_BR', '37', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Gestão; biblioteca escolar; biblioteconomia.'),
(31, 20, '2008', 'Gestão da biblioteca escolar: metodologias, enfoques e aplicação de ferramentas de gestão e serviços de biblioteca', 'pt_BR', '37', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(32, 21, '2007', 'Proyecto Cor@je: Narrativas, TICs e Inclusión en el Hospital', 'pt_BR', '198', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'adolescente; Ambientes Virtuais de Aprendizagem; tecnologias de informação e de comunicação.'),
(33, 12, '2007', 'Formação Profissional e a Educação a Distância mediada por Computador: uma experiência no Curso de Biblioteconomia do DCI/FABICO/UFRGS', 'pt_BR', '17', '', 'ESTABEL, L. B.; MORO, E. L. S.', '7005124544331261', 'biblioteconomia; educação a distância- EAD.'),
(34, 18, '2007', 'Projeto Cor@gem: o acesso e o uso das TICs entre pacientes hospitalizados e a interação em ambientes virtuais de aprendizagem', 'pt_BR', '2', '2', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.; SILVA, F. A. A. E.', '7005124544331261', 'tecnologias de informação e de comunicação; pessoas com necessidades educacionais especiais; Fibrose Cística.'),
(35, 22, '2006', 'O Gênero nos Contos de Fadas Tradicionais e Modernos: a outra história de (Rapunzel) e Sapatinhos Vermelhos', 'pt_BR', '7', '', 'DUPONT, F.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(36, 22, '2006', 'Era Uma Vez . . . O Encantamento da Leitura e a Magia da Biblioteca: um estudo de caso sobre as narrativas e as diferenças de gênero', 'pt_BR', '7', '', 'MORO, E. L. S.; NEVES, I. C. O. B.; ESTABEL, L. B.', '7005124544331261', ''),
(37, 20, '2006', 'A Inclusão Social e Digital das Pessoas com Limitação Visual e o Uso das TICs na Produção de Páginas para a Internet.', 'pt_BR', '35', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(38, 16, '2006', 'Ambientes Virtuais de Aprendizagem e a Formação em EAD das PNEES com Limitação Visual: um estudo de caso utilizando ferramentas de interação', 'pt_BR', '4', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(39, 16, '2006', 'O Processo de Interação em Ambientes Virtuais de Aprendizagem Através de Narrativas, Produção Textual e Escrita Colaborativa de Crianças e Adolescentes com Fibrose Cística, em Isolamento Hospitalar.', 'pt_BR', '4', '', 'MORO, E. L. S.; ESTABEL, L. B.; SILVA, F. A. A. E.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(40, 20, '2006', 'Capacitação de Bibliotecários com Limitação Visual pela Educação a Distância em Ambientes Virtuais de Aprendizagem', 'pt_BR', '35', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'EAD; Ambientes Virtuais de Aprendizagem; internet.'),
(41, 12, '2006', 'BIBLIOTEC II: o bibliotecário como mediador propiciando a inclusão informacional, social, educacional e digital através da EAD', 'pt_BR', '16', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', 'biblioteconomia; Educação a Distância; Ambientes Virtuais de Aprendizagem.'),
(42, 23, '2006', 'superação das limitações na criação da página pessoal para internet: um estudo de caso', 'pt_BR', '9', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', 'tecnologias de informação e de comunicação; pessoas com necessidades educacionais especiais; educação a distância- EAD.'),
(43, 16, '2005', 'A Interação através da Iinformática na Educação com Crianças com Fibrose Cística e a Inclusão Social e Digital através do Uso da Leitura', 'pt_BR', '3', '1', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.; SILVA, F. A. A. E.', '7005124544331261', ''),
(44, 23, '2005', 'A Interação entre os Alunos, Educadores, Bibliotecários e a Pesquisa Escolar', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(45, 24, '2005', 'A Utilização das Tecnologias de Informação e de Comunicação e a Pesquisa Escolar: um estudo de caso com PNEEs com Limitação Visual', 'pt_BR', '10', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Pessoas com Necessidades Educativas Especiais; pesquisa escolar; tecnologias de informação e de comunicação.'),
(46, 16, '2005', 'O Acesso às Tecnologias de Informação e de Comunicação e a Superação das Limitações dos PNEEs com Limitação Visual Incluindo-os em um Ambiente de Aprendizagem Mediado por Computador', 'pt_BR', '3', '1', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(47, 25, '2004', 'Biblioterapia Através da Contação de Histórias para Crianças com Fibrose Cística no HCPA-RS', 'pt_BR', '9', '2', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(48, 24, '2004', 'A Utilização das Tecnologias de Informação e de Comunicação e a Pesquisa Escolar: um estudo de caso com os PNEEs com Limitação Visual.', 'pt_BR', '10', '1', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(49, 23, '2004', 'A Interação entre os Alunos, Educadores, Bibliotecários e a Pesquisa Escolar', 'pt_BR', '7', '2', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(50, 16, '2004', 'A Pesquisa Escolar Propiciando a Integração dos Atores - Alunos, Educadores e Bibliotecários - Irradiando o Benefício Coletivo e a Cidadania em um Ambiente de Aprendizagem Mediado por Computador', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(51, 16, '2004', 'O Uso das Tecnologias de Informação e de Comunicação na Pesquisa Escolar: Um Estudo de Caso com os PNEEs com Limitação Visual', 'pt_BR', '2', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'pesquisa escolar; pessoas com necessidades educacionais especiais.'),
(52, 23, '2003', 'Abordagens de Cooperação e Colaboração na Utilização de Ambiente de Aprendizagem Mediado por Computador pelos Portadores de Necessidades Educacionais Especiais com Limitação Visual', 'pt_BR', '6', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'informática na educação; educação; educação especial; inclusão social.'),
(53, 26, '2003', 'O Professor e os Alunos como Protagonistas na Educação Aberta e a Distância Mediada por Computador', 'pt_BR', '21', '', 'MORO, E. L. S.; ESTABEL, L. B.; TAROUCO, L. M. R.', '7005124544331261', 'Educação a Distância; informática na educação.'),
(54, 26, '2003', 'O Professor e os Alunos como Protagonistas na Educação Aberta e a Distância Mediada por Computador', 'pt_BR', '21', '', 'TAROUCO, L. M. R.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(55, 26, '2003', 'O Encantamento da Leitura e a Magia da Biblioteca Escolar', 'pt_BR', 'VII', '40', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(56, 24, '2003', 'Bibliotec: experiência do Curso de Extensão em EAD mediado por computador.', 'pt_BR', '9', '', 'MORO, E. L. S.; ESTABEL, L. B.; TAZIMA, I.; VARGAS, L. M.; DAMO, A. V.; SOARES, D. B.', '7005124544331261', ''),
(57, 27, '2002', 'As Novas Tecnologias da Informação e Comunicação e a Pesquisa Escolar', 'pt_BR', '5', '', 'MORO, E. L. S.; DIAS, J. W.; ESTABEL, L.; CARNEIRO, M. R. L. F.', '7005124544331261', 'tecnologia; pesquisa escolar; internet.'),
(58, 26, '2001', 'Learning and Interacting with Videoconferencing: In Search of a New Pedagogy.', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.; COSTA, J. S.; DIAS, J. W.; HUGHES, M.; CARNEIRO, M. R. L. F.', '7005124544331261', ''),
(59, 28, '2000', 'Educação a Distância, Novas Ferramentas e a Biblioteconomia', 'pt_BR', '9', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(60, 9, '2016', 'Uma investigação sobre a autoria de dados científicos: teias de uma rede em construção', 'pt_BR', '14', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(61, 5, '2015', 'Uma abordagem conceitual sobre garantias de representação no gerenciamento da organização de estoques de informação como proposição ético-informacional', 'pt_BR', '21', '3', 'MEDEIROS, J. S.', '4182663628298542', ''),
(62, 19, '2013', 'Considerações sobre a esfera pública: redes sociais na internet e participação política', 'pt_BR', '25', '1', 'MEDEIROS, J. S.', '4182663628298542', ''),
(63, 15, '2012', 'Considerações sobre a informação na terceira ordem da ordem: um olhar a partir dos paradigmas da Ciência da Informação', 'pt_BR', '8', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(64, 29, '2012', 'Compartilhamento de dados e e-Science: explorando um novo conceito para a comunicação científica', 'pt_BR', '8', '2', 'MEDEIROS, J. S.; CAREGNATO, S. N. E.', '4182663628298542', ''),
(65, 30, '2011', 'Considerações sobre o e-book: do hipertexto à preservação digital', 'pt_BR', '24', '2', 'DZIEKANIAK, G. V.; MORAES, R. P. T.; MEDEIROS, J. S.; RAMOS, C. R. R.', '4182663628298542', ''),
(66, 3, '2011', 'A representação de domínios de conhecimento e uma teoria de representação: a ontologia de fundamentação', 'pt_BR', '16', '3', 'CAMPOS, M. L. A.; CAMPOS, L. M.; MEDEIROS, J. S.', '4182663628298542', ''),
(67, 31, '2010', 'A construção do conceito: aproximações complementares entre a análise de Michel Foucault e Ingetraut Dahlberg', 'pt_BR', '15', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(68, 2, '2008', 'Uso do padrão MARC em bibliotecas universitárias da região sul do Brasil', 'pt_BR', '13', '', 'DZIEKANIAK, G. V.; MEDEIROS, J. S.; SILVEIRA, J. O. B.; FORTES, M. F.; BORGES, V. N.', '4182663628298542', 'Metadados; Representação da informação; Bibliotecas universitárias.'),
(69, 112, '2012', 'Theoretical Approximations Between Brazilian and Spanish Authors? Production in the Field of Knowledge Organization in the Production of Journals on Information Science in Brazil', 'pt_BR', '39', '3', 'FREITAS, J. L.; GABRIEL JUNIOR, R. F.; BUFREM, L. S.', '5900345665779424', 'Ciência da Informação; bibliometria; Production of Journals.'),
(70, 113, '2011', 'Redes sociais na pesquisa científica da área de ciência da informação', 'pt_BR', '12', '3', 'BUFREM, L. S.; GABRIEL JUNIOR, R. F.; SORRIBA, T. V.', '5900345665779424', 'Redes sociais; bibliometria; Colaboração científica.'),
(71, 3, '2011', 'A Apropriação do Conceito como Objeto na Literatura Periódica Científica em Ciência da Informação', 'pt_BR', '16', 'Esp;', 'BUFREM, L. S.; GABRIEL JUNIOR, R. F.', '5900345665779424', 'Conceito; Teoria do Conceito; Terminologia; Modelo Conceitual.'),
(72, 114, '2010', 'DEZ ANOS DE REVISTA DIÁLOGO EDUCACIONAL(2000-2009): histórico e evolução', 'en', '10', '228', 'BUFREM, L. S.; GABRIEL JUNIOR, R. F.; GONÇALVES, V.', '5900345665779424', 'Periódico científico; Comunicação Científica; Educação; Biografia institucional.'),
(73, 11, '2010', 'Modelizando práticas para a socialização de informações: a construção de saberes no ensino superior', 'en', '15', '2', 'BUFREM, L. S.; COSTA, F. D. O.; GABRIEL JUNIOR, R. F.; PINTO, J. S. P.', '5900345665779424', 'Brapci; Bases de dados; Compartilhamento da informação; Arquitetura da informação.'),
(74, 3, '2010', 'Práticas de co-autoria no processo de comunicação científica na pós-graduação em Ciência da Informação no Brasil', 'pt_BR', '15', 'Esp.', 'BUFREM, L. S.; GABRIEL JUNIOR, R. F.; GONÇALVES, V.', '5900345665779424', 'Ciência da Informação; Comunicação da ciência; Comunicação Científica; Coautoria..'),
(75, 32, '2010', 'Proposta de metodologia para a recuperação da produção científica em ciência da informação na base Brapci', 'pt_BR', '4', '3', 'FREITAS, J. L.; BUFREM, L. S.; GABRIEL JUNIOR, R. F.', '5900345665779424', 'Ciência da Informação; Recuperação da informação; Método de Recuperação de Informação; Epistemologia da ciência da informação.'),
(76, 7, '2016', 'Memórias Virtuais da Cidade nas Redes Sociais: as ruas de Porto Alegre no Facebook', 'pt_BR', '11', '1', 'MORIGI, V. J.; MASSONI, L. F. H.; SENA, J. R.', '6542370154854198', ''),
(77, 3, '2016', 'Apropriações e Usos das Histórias em Quadrinhos na Literatura de Ciência da Informação', 'pt_BR', '21', '1', 'MORIGI, V. J.; MASSONI, L. F. H.; LOUREIRO, T. R.', '6542370154854198', ''),
(78, 4, '2016', 'Tecnologias criativas em bibliotecas: concepções transversais', 'pt_BR', '26', '2', 'SILVA, R. L.; BIASUZ, M. C.; MORIGI, V. J.', '6542370154854198', 'Tecnologias Criativas; Biblioteca; Produção de Subjetividade.'),
(79, 67, '2015', 'Fluxo transmidiático: entre as possibilidades de discutir a recepção no ambiente de mídias', 'pt_BR', '3', '1', 'SILVA, N. L. S.; MORIGI, V. J.', '6542370154854198', 'Ambiente midiático; Fluxo; Recepção.'),
(80, 68, '2015', '?INCLUSÃO? DIGITAL, RELAÇÕES COMUNITÁRIAS E VIGILÂNCIA', 'pt_BR', '2', '1', 'PEREIRA, P. C. M. S.; MORIGI, V. J.', '6542370154854198', 'inclusão digital; Comunidade; Vigilancia.'),
(81, 69, '2015', '?Alô, vó, tô estourado?: apropriações da cultura popular em um videoclipe de forró eletrônico', 'pt_BR', '13', '2', 'MORIGI, V. J.; BRAGA, R. S.', '6542370154854198', 'culturas híbridas; representações sociais; forró eletronico.'),
(82, 5, '2015', 'O processo de circulação de informações sobre forró eletrônico e seu fluxo comunicacional em Fortaleza', 'pt_BR', '21', '3', 'BRAGA, R. S.; MORIGI, V. J.', '6542370154854198', 'fluxo de informações; CIRCULAÇÃO DE INFORMAÇÃO; midiatização.'),
(83, 70, '2015', 'Transparência no Acesso à Informação e as Memória Virtuais da Ditadura Militar no Site Brasil: Nunca Mais Digit@l', 'pt_BR', '11', '1', 'MASSONI, L. F. H.; MORIGI, V. J.; ENGELMANN, S. I. S.; VIANA, A. W.', '6542370154854198', 'Memória Virtual; Transparência; Ditadura Militar; Acesso à Informação.'),
(84, 67, '2015', 'Segurança pública em Porto Alegre: uma análise dos eixos-temáticos e das fontes mais recorrentes na cobertura dos jornais impressos Zero Hora e Correio do Povo', 'pt_BR', '3', '', 'DIAS, A. S. T.; MORIGI, V. J.', '6542370154854198', 'jornalismo; Segurança Pública.'),
(85, 29, '2015', 'Memórias em rede: as fotografias em ambientes virtuais', 'pt_BR', '11', '2', 'MORIGI, V. J.; MASSONI, L. F. H.', '6542370154854198', 'Memória; Memória Virtual; Rede; Cidade.'),
(86, 8, '2015', 'Mídia e as Informações sobre o Patrimônio Cultural e a Cidade', 'pt_BR', '8', '2', 'MORIGI, V. J.; MASSONI, L. F. H.', '6542370154854198', ''),
(87, 71, '2014', 'La construction des savoirs sur les genres : appropriations de la culture populaire dans les clubs de forró électronique de Fortaleza (Brésil)', 'fr', '42', '2014', 'MORIGI, V. J.; BRAGA, R. S.', '6542370154854198', 'appropriation; savoirs de genre; fête.'),
(88, 72, '2014', 'Memória, identidade cultural e biblioteca comunitária: um estudo de caso em Linha Andréas, em Venâncio Aires ? RS', 'pt_BR', '15', '29', 'MORIGI, V. J.; SEHN, A. P.', '6542370154854198', 'Bibliotecas Comunitárias; Memória Social; identidade cultural.'),
(89, 73, '2014', 'MÃ­dias Escolares: a cidadania na prÃ¡tica da educomunicaÃ§Ã£o / School Media: The Citizenship in the Educommunication Practice', 'pt_BR', '19', '2', 'MORIGI, V. J.; CORRÊA, F. Z.; GUINDANI, J. F.', '6542370154854198', 'cidadania e comunicação; Cidadania comunicativa; Midias Escolares.'),
(90, 74, '2014', 'Mediações da informação e da comunicação: Porto Alegre nas narrativas do jornal Zero Hora', 'pt_BR', '43', '2', 'MORIGI, V. J.; SEHN, A. P.; MASSONI, L. F. H.', '6542370154854198', ''),
(91, 75, '2013', 'O olhar do outro: a gestão de museus e a sustentabilidade na museologia', 'pt_BR', '2', '3', 'FRANCISCO, J. L. C. S. B.; MORIGI, V. J.', '6542370154854198', 'cidadania; Museologia; sustentabilidade.'),
(92, 76, '2013', 'MEMÓRIA CULTURAL NA CONSTRUÇÃO DAS IDENTIDADES E MAPAS IMAGINÁRIOS DE PRÁTICAS CULTURAIS ÉTNICAS', 'pt_BR', '1', '10', 'MORIGI, V. J.; LAROQUE, L. F.; MAGALHAES, N. E.; GOMES, C. R.; BARDEN, J. L. E.', '6542370154854198', 'MEMÓRIA CULTURAL; PRÁTICAS CULTURAIS ÉTNICAS; Mapas Imaginários.'),
(93, 77, '2013', 'A ESCOLA NA CONSTRUÇÃO DA CULTURA ECOLÓGICA: UM ESTUDO A PARTIR DAS PRÁTICAS PEDAGÓGICAS NO ENSINO FUNDAMENTAL EM ENCANTADO-RS', 'pt_BR', '3', '1', 'KLIMA, M. C.; MORIGI, V. J.', '6542370154854198', 'Questões Socioambientais; Paradigma da Complexidade,; Cultura Ecológica.'),
(94, 63, '2013', 'Tensões nas Representações sobre o Gaúcho: uma análise de ?Eu Reconheço Que Sou Um Grosso?', 'pt_BR', '29', '2013', 'MORIGI, V. J.; BONOTTO, M. E. K.', '6542370154854198', 'Narrativa Musical; identidade regional.'),
(95, 78, '2013', 'Reflexões acerca do pensamento complexo e sua relação com o conhecimento da arquivologia', 'pt_BR', '6', '2013', 'MORIGI, V. J.; NERY, C. H. A.', '6542370154854198', 'Conhecimento Arquivístico; Complexidade; Arquivologia.'),
(96, 8, '2013', 'ESTUDOS DE USUÁRIOS E DE RECEPÇÃO: UMA ABORDAGEM A PARTIR DA MEDIAÇÃO DOS CONCEITOS DE INFORMAÇÃO E COMUNICAÇÃO', 'pt_BR', '6', '2', 'PEREIRA, P. C. M. S.; MORIGI, V. J.', '6542370154854198', 'Estudos de Usuários; Estudos de recepção; ciência da informação.'),
(97, 63, '2013', 'Tensões nas Representações sobre o Gaúcho: uma análise de ?Eu Reconheço Que Sou Um Grosso?', 'pt_BR', '17', '1', 'BONOTTO, M. E. K. K.; MORIGI, V. J.', '6542370154854198', ''),
(98, 8, '2013', 'ESTUDOS DE USUÁRIOS E DE RECEPÇÃO: UMA ABORDAGEM A PARTIR DA MEDIAÇÃO DOS CONCEITOS DE INFORMAÇÃO E COMUNICAÇÃO', 'pt_BR', '6', '2', 'MORIGI, V. J.', '6542370154854198', 'Estudos de Usuários; Estudos de recepção; ciência da informação.'),
(99, 79, '2012', 'MEMÓRIA, REPRESENTAÇÕES SOCIAIS E CULTURA IMATERIAL', 'pt_BR', '9', '14', 'MORIGI, V. J.; ROCHA, C. P. V.; SEMENSATTO, S.', '6542370154854198', 'Memória Social; representações e memória social; Represeantações Sociais.'),
(100, 80, '2012', 'SEXUAL DIVERSITY IN BRAZILIAN JOURNALISM: A STUDY OF THE REPRESENTATIONS OF LGBT PEOPLE IN THE NEWSPAPERS FOLHA DE S. PAULO AND O ESTADO DE S. PAULO', 'en', '8', '1', 'DARDE, V. W.; MORIGI, V. J.', '6542370154854198', 'Journalism; Discourse Analysis; Sexual Diversity.'),
(101, 81, '2012', 'Tecendo o encontro entre diferentes saberes: a comunicação no contexto de uma usina de triagem de lixo1', 'pt_BR', '11', '21', 'KAUFMANN, C.; MORIGI, V. J.', '6542370154854198', 'comunicação.'),
(102, 4, '2012', 'REDES DE MOBILIZAÇÃO SOCIAL:as práticas informacionais do Greenpeace', 'pt_BR', '22', '3', 'MORIGI, V. J.; KREBS, L. M.', '6542370154854198', 'práticas informacionais; Redes Sociais; meio ambiente; Greenpeace.'),
(103, 82, '2011', 'SUSTENTABILIDADE E RESPONSABILIDADE SOCIOAMBIENTAL: UM ESTUDO NA EMPRESA FLORESTAL DE ALIMENTOS S.A. EM LAJEADO-RS', 'pt_BR', '3', '1', 'SCHOSSLER, G. B.; MORIGI, V. J.', '6542370154854198', 'sustentabilidade; Modo de Vida Sustentável; Reponsabilidade Socioambiental.'),
(104, 82, '2011', 'EVOLUÇÃO DO PAPEL DO ESTADO NA PROMOÇÃO DOS DIREITOS SOCIAIS', 'pt_BR', '3', '2', 'ANGNES, C. U.; BUFFON, M.; MORIGI, V. J.', '6542370154854198', 'Direitos sociais; cidadania; Neoliberalismo.'),
(105, 83, '2011', 'A rádio comunitária como prática de cidadania comunicativa', 'pt_BR', '18', '3', 'ALMEIDA, C. O. D.; GUINDANI, J. F.; MORIGI, V. J.', '6542370154854198', 'cidadania; Cidadania comunicativa; rádios comunitárias.'),
(106, 84, '2011', 'Daily practices, consumption and citizenship', 'pt_BR', '83', '4', 'MAZZARINO, J. M.; MORIGI, V. J.; KAUFMANN, C.; M.B., A.; FERNANDES, D. A.', '6542370154854198', 'cidadania; Práticas Ambientais; cidadania e consumo.'),
(107, 85, '2010', 'Blogosfera cubana: um novo espaço público para a construção de uma sociedade plural e cidadã', 'pt_BR', '17', '2', 'LUZ, L.; MORIGI, V. J.', '6542370154854198', 'ciberespaço; cidadania e ciberespaço; Blogs Cubanos.'),
(108, 24, '2010', 'Mediação das cartas dos leitores na mídia: mapas imaginários sobre Porto Alegre', 'pt_BR', '16', 'espec', 'JOSE, M. V.; ROCHA, C. P. V.; CASTRO, M.; MORIGI, V. J.', '6542370154854198', 'Porto Alegre Imaginada; cidade e imaginário; Imaginário urbano.'),
(109, 24, '2010', 'Mapas imaginários sobre Porto Alegre : a cidade midiática.', 'pt_BR', '16', '', 'JACKS, N.; CASTRO, M.; MUNIZ, E.; MORIGI, V. J.; ROSSINI, M.; GIRARDI, I. M. T.; GOLIN, C.; BALDISSERA,; GONÇALVES,; LIEDKE,; DEISE, C. O.', '6542370154854198', 'Mapas Imaginários; Porto Alegre Imaginada; Cidade Midiática.'),
(110, 86, '2010', 'A cidadania comunicativa na prática radiofônica do Movimento Sem Terra', 'pt_BR', '1', '1', 'GUINDANI, J. F.; MORIGI, V. J.', '6542370154854198', 'Cidadania comunicativa; Rádio; Movimento Sem Terra.'),
(111, 87, '2010', 'AMBIENTE E MODO DE VIDA SUSTENTÁVEL: REFLEXÕES SOBRE AS PRÁTICAS DE ARTESÃS DA REGIÃO DO VALE DO TAQUARI-RS', 'pt_BR', '17', '2', 'CERUTTI, B. B.; MORIGI, V. J.', '6542370154854198', 'Modo de Vida Sustentável; meio ambiente; práticas do trabalho artesanal feminino.'),
(112, 88, '2010', 'A mediação dos professores na construção do saber ambiental: práticas pedagógicas e representações', 'pt_BR', '32', 'IX', 'MORIGI, V. J.; COSTA, V. T.; KAUFMANN, C.', '6542370154854198', 'Educação Ambiental; representações sociais; Práticas Ambientais.'),
(113, 24, '2010', 'A Mediação das cartas dos leitores na mídia: mapas imaginários sobre Porto Alegre', 'pt_BR', '16', '', 'MORIGI, V. J.; ROCHA, C. P. V.; CASTRO, M.', '6542370154854198', ''),
(114, 89, '2009', 'Representações sociais e práticas pedagógicas: a mediação dos professores na construção do saber ambiental, um estudo em Estrela RS', 'pt_BR', '6', '1', 'MORIGI, V. J.; COSTA, V. T.; KAUFMANN, C.', '6542370154854198', 'Informação e educação ambiental; Educação Ambiental; Representações Sociais e Meio Ambiente.'),
(115, 90, '2008', 'A mediação da narrativa visual na celebração do espírito comum nas festas comunitárias', 'pt_BR', '12', '1', 'MORIGI, V. J.; ROCHA, C. P. V.; SEMENSATTO, S.', '6542370154854198', 'festas comunitárias; práticas culturais; práticas informacionais; espirito comum.'),
(116, 12, '2008', 'NARRATIVA VISUAL, INFORMAÇÃO E MEDIAÇÃO DO ESPÍRITO COMUM NAS FESTAS COMUNITÁRIAS', 'pt_BR', '18', '3', 'MORIGI, V. J.; ROCHA, C. P. V.; SEMENSATTO, S.', '6542370154854198', 'festas comunitárias; informação e práticas culturais; práticas informacionais; Cultura popular.'),
(117, 91, '2007', 'REFLEXÕES SOBRE OS VALORES DO MOVIMENTO SOFTWARE LIVRE NA CRIAÇÃO DE NOVOSMOVIMENTOS INFORMACIONAIS', 'pt_BR', '12', '1', 'MORIGI, V. J.; SANTIN, D. M.', '6542370154854198', 'Movimento Software Livre;; Cultura Livre;; cidadania; práticas informacionais.'),
(118, 12, '2007', 'Esfera Pública Informacional: os arquivos na construção da cidadania', 'pt_BR', '17', '', 'MORIGI, V. J.; VEIGA, A.', '6542370154854198', 'arquivo e cidadania; esfera pública informacional; práticas informacionais; cidadania.'),
(119, 85, '2006', 'Circuitos Comunicativos e a Construção da cidadania no ciberespaço: tramas do sentido em redes de weblogs', 'pt_BR', '30', '', 'MORIGI, V. J.; FLORIANI, A. W.', '6542370154854198', 'circuitos comunicativos; cidadania e ciberespaço; cidadania e weblogs; comunicação e cidadania; mídia digital.'),
(120, 12, '2006', 'Ciclo e fluxo informacional nas festas comunitárias', 'pt_BR', '16', '', 'MORIGI, V. J.; SEMENSATTO, S.; BINOTTO, S. F. T.', '6542370154854198', 'festas comunitárias; ciclo informacional; fluxo de informações; trama de informações.'),
(121, 90, '2006', 'Cidadania e Comunicação: estratégias comunicacionais na veiculação de informações públicas em embalagens de cigarro', 'pt_BR', '10', '', 'MORIGI, V. J.; RHODEN, A. M.', '6542370154854198', 'cidadania e consumo; informação pública; práticas informacionais; cidadania.'),
(122, 92, '2006', 'Memória Social, identidade cultural e o significado das festas comunitárias', 'pt_BR', '27', '2', 'MORIGI, V. J.; SEMENSATTO, S.', '6542370154854198', 'Memória Social; identidade cultural; festas comunitárias.'),
(123, 85, '2006', 'Circuitos comunicativos e construção da cidadania no ciberespaço: tramas do sentido em redes de weblogs', 'pt_BR', '30', '1', 'FLORIANI, A. W.; MORIGI, V. J.', '6542370154854198', 'mídias digitais e cidadania; circuitos comunicativos; comunicação e informação; Internet.'),
(124, 63, '2006', 'Tramas do sentido em redes de weblogs', 'pt_BR', '1', '14', 'FLORIANI, A. W.; MORIGI, V. J.', '6542370154854198', 'mídias digitais e cidadania; Redes Sociais; blogs; circuitos comunicativos.'),
(125, 12, '2005', 'Paradigma Tecnológico e Representações Sociais dos Bibliotecários sobre seu Perfil e suas Práticas no Contexto da Sociedade da Informação', 'pt_BR', '15', '', 'MORIGI, V. J.; SILVA, M. L.', '6542370154854198', 'Auto-imagem do bibliotecário; sociedade da informação; Práticas profissionais do bibliotecário; Representações sociais dos bibliotecários; Tecnologias de Informação e Comunicação.'),
(126, 90, '2005', 'Cidadão Digital, Cidadania Planetária', 'pt_BR', '9', '', 'MORIGI, V. J.; MOSELE, E. M.', '6542370154854198', 'Cidadania Planetária; Cidadão digital; Internet e tecnologia; Exclusão Digital.'),
(127, 63, '2005', 'Mídia, Identidade Cultural Nordestina: festa junina como expressão', 'pt_BR', '12', '', 'MORIGI, V. J.', '6542370154854198', 'identidade cultural; Mídia e Identidade; Festa Junina; Identidade Cultural Nordestina.'),
(128, 93, '2005', 'La visibilidad de la infancia y la violencia en los medios brasilenos', 'es', '11', '', 'MORIGI, V. J.; JACKS, N.; ROSA, R.; MEURER, F.', '6542370154854198', 'violencia e infancia; infancia e os meios; visibilidade e infancia.'),
(129, 31, '2005', 'Entre o passado e o presente: as visões de biblioteca no mundo contemprãneo', 'pt_BR', '10', '', 'MORIGI, V. J.; SOUTO, L. R.', '6542370154854198', 'Biblioteca Universitária; Tecnologia de Informação e Comunicação.'),
(130, 94, '2005', 'A música regional: narrativa, memória afetiva e fonte de informação', 'pt_BR', '29', '', 'MORIGI, V. J.; BONOTTO, M. E. K.', '6542370154854198', 'musica regional; narrativa e memória; memória e fonte de informação; práticas informacionais.'),
(131, 92, '2005', 'O Livro, a construção e a preservação da memória social na era da Informação', 'pt_BR', '26', '', 'MORIGI, V. J.; BRETANO, E.', '6542370154854198', 'informação e memória; Memória Social; memória coletiva; livro; tecnologias digitais.'),
(132, 20, '2004', 'Tecnologias de Informação e Comunicação: Novas Sociabilidades nas Bibliotecas Universitárias', 'pt_BR', '33', '', 'MORIGI, V. J.; PAVAN, C.', '6542370154854198', 'Bibliotecas Universitárias; sociabilidade; Práticas profissionais; Tecnologias de Informação e Comunicação.'),
(133, 31, '2004', 'Entre o tradicional e o virtual: os usos das tecnologias de informação e comunicação nas bibliotecas universitárias', 'pt_BR', '8/9', '', 'MORIGI, V. J.; PAVAN, C.', '6542370154854198', 'Tecnologias de informaçãoe comunicação; Bibliotecas Universitárias; novas sociabilidades; Práticas profissionais.'),
(134, 95, '2004', 'A veiculação de Informações sobre saúde como instrumento na construção da cidadania: um estudo em jornais de Porto Alegre -RS', 'pt_BR', '1', '', 'MORIGI, V. J.; FERRARETTO, E. K.', '6542370154854198', 'cidadania; imprensa; jornalismo; saúde.'),
(135, 28, '2004', 'A Narrativa Musical, Memória e Fonte de Informação Afetiva', 'pt_BR', '10', '', 'MORIGI, V. J.; BONOTTO, M. E. K.', '6542370154854198', 'Fontes de Informação; informação e memória; Informação afetiva; Narrativa Musical; Gildo de Freitas.'),
(136, 96, '2004', 'Teoria Social e Comunicação: Representações Sociais, Produção de Sentidos e Construção dos Imaginários Midiáticos', 'pt_BR', '1', '', 'MORIGI, V. J.', '6542370154854198', 'Teoria Social e Comunicação; representações sociais.'),
(137, 97, '2004', 'Cidadania Midiatizada, Cidadão Planetário', 'pt_BR', '7', '', 'MORIGI, V. J.; ROSA, R.', '6542370154854198', 'cidadania; Cidadania Planetária; midiatização; cidadania midiatizada; midia.'),
(138, 28, '2004', 'Trama de Informações e as Formas de Comunicação nas festas comunitárias: um estudo em Estrela-RS', 'pt_BR', '10', '', 'MORIGI, V. J.; SEMENSATTO, S.; BINOTTO, S. F. T.', '6542370154854198', 'trama de informações; festas comunitárias; ciclo informacional; Memória Social; identidade regional.'),
(139, 92, '2003', 'Vem pra fazer mais, vem traz a paixão: processos discursivos e estratégias de captura do cidadão no Horário de PropagandaeEleitoral Gratuíta', 'pt_BR', '24', '', 'MORIGI, V. J.; VANZ, S. A. S.; COELHO, M. P.; GALDINO, K.', '6542370154854198', 'cidadania; propaganda partidária; processos discursivos.'),
(140, 98, '2003', 'Cidadania, novos tempos, novas aprendizagens', 'pt_BR', '9', '', 'MORIGI, V. J.; VANZ, S. A. S.; GALDINO, K.', '6542370154854198', 'perfil profissional; Informação; cidadania; Cidadania Planetária; comunicação.'),
(141, 99, '2003', 'A Festa de São João Sob o Olhar Midiático', 'pt_BR', '6', '', 'MORIGI, V. J.', '6542370154854198', 'Festa Junina; São João; Cultura Nordestina; Cultura popular; Festa Junina e Mídia.'),
(142, 100, '2002', 'Festa Junina e Hibridismo Cultural', 'pt_BR', '18', '', 'MORIGI, V. J.', '6542370154854198', 'Cultura popular; Festas populares; Festa Junina; Hibridismo Cultural.'),
(143, 92, '2002', 'Festa Junina e Publicização de Sentido', 'pt_BR', '23', '', 'MORIGI, V. J.', '6542370154854198', 'Cultura popular; Festa Junina; narrativa publicitária.'),
(144, 31, '2002', 'O Bibliotecário e suas práticas na construção da cidadania', 'pt_BR', '7', '', 'MORIGI, V. J.; VANZ, S. A. S.; GALDINO, K.', '6542370154854198', 'cidadania; perfil profissional.'),
(145, 28, '2000', 'Laços de família, entre outros laços: cavalos e éguas, festas e jantares, comunicação e informação', 'pt_BR', '8', '', 'MORIGI, V. J.', '6542370154854198', 'sociabilidade; Telenovela.'),
(146, 92, '1999', 'Tecnologia da Informação: novas linguagens novos saberes?', 'pt_BR', '20', '1999', 'MORIGI, V. J.', '6542370154854198', 'Novas tecnologias; Informação; Tecnologias da Informação.'),
(147, 12, '1999', 'Algumas relações entrea Sociologia e Biblioteconomia: um caso de amor?', 'pt_BR', '9', '', 'MORIGI, V. J.', '6542370154854198', 'Sociologia-Biblioteconomia; estágio curricular.'),
(148, 92, '1998', 'A arte como representação da vida social: uma análise de dois filmes italianos', 'pt_BR', '19', '', 'MORIGI, V. J.', '6542370154854198', 'arte e sociedade; arte e imaginário; literatura e sociedade.'),
(149, 101, '1996', 'Imaginário Coletivo e Representações Sociais: um estudo sobre o nome das barracas de São João em Campina Grande -PB', 'pt_BR', '', '', 'MORIGI, V. J.', '6542370154854198', 'Imaginário Coletivo; Festa Junina; São João; representações sociais.'),
(150, 59, '2016', 'Internationality of Publications, Co-Authorship, References and Citations in Brazilian Evolutionary Biology', 'en', '4', '1', 'SANTIN, D.; VANZ, S. S.; CAREGNATO, S. E.', '5627209208288722', 'colaboração científica; análise de citações; produção científica; comunicação científica.'),
(151, 2, '2016', 'Scientific collaboration between Brazil and Spain: journals and citations', 'pt_BR', '21', '47', 'VANZ, S. A. A. S.; FILIPPO, D.; CAREGNATO, S. E.; GARCIA-ZORITA, C.; MOURA, A. M. M.; SÁNCHEZ, M. A. L. L.; SANZ-CASADO, E.', '5627209208288722', 'colaboração científica; estudos de citação; periódicos científicos.'),
(152, 8, '2016', 'O SISTEMA DE NAVEGAÇÃO EM REVISTAS CIENTÍFICAS ELETRÔNICAS', 'pt_BR', '9', '1', 'PASSOS, P. C. S. J.; CAREGNATO, S. E.', '5627209208288722', 'periódicos científicos; comunicação científica; arquitetura de informação.'),
(153, 9, '2016', 'ImplementaÃ§Ã£o da preservaÃ§Ã£o digital em repositÃ³rios: conhecimento e prÃ¡ticas', 'pt_BR', '14', '3', 'PAVÃO, C. G.; CAREGNATO, S. E.; ROCHA, R. P.', '5627209208288722', 'repositórios; preservação digital.'),
(154, 4, '2015', 'Panorama da produção conjunta entre Brasil e Espanha indexada na WoS entre 2006-2012: indicadores de atividade, especialização e colaboração', 'pt_BR', '25', '1', 'MOURA, A. M. M.; FILIPPO, D.; SANCHEZ, M. L. L.; VANZ, S. A. A. S.; CAREGNATO, S. E.', '5627209208288722', 'produção científica; colaboração científica.'),
(155, 19, '2015', 'Scientific events, power relationships and practices of researchers', 'en', '27', '3', 'SILVEIRA, M. A. A. J.; BUFREM, L. S.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica.'),
(156, 5, '2015', 'Serviços de descoberta em rede: a experiência do modelo Google para os usuários de bibliotecas universitárias', 'pt_BR', '21', '3', 'PAVÃO, C. M. G.; CAREGNATO, S. E.', '5627209208288722', 'busca e uso de informações; serviços de descoberta; bibliotecas universitárias.'),
(157, 24, '2015', 'Crescimento, diversidade e sobrevivÃªncia: o conceito de vitalidade aplicado em um estudo cientomÃ©trico', 'pt_BR', '21', '3', 'MAIA, M. F. S.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; cientometria.'),
(158, 19, '2014', 'Visibilidade de revistas científicas: um estudo no Portal de Periódicos Científicos da Universidade Federal do Rio Grande do Sul', 'en', '26', '2', 'FERREIRA, A. G. C.; CAREGNATO, S. E.', '5627209208288722', 'portal de periódicos.'),
(159, 8, '2014', 'A CIÊNCIA NO RIO GRANDE DO SUL: INDICADORES DE PRODUÇÃO E COLABORAÇÃO NOS ANOS 2000 A 201', 'pt_BR', '7', '1', 'CAREGNATO, S. E.; VANZ, S. A. A. S.; MOURA, A. M. M.; STUMPF, I. R. C.', '5627209208288722', 'produção científica; colaboração científica; cientometria.'),
(160, 3, '2014', 'Práticas de citação e memória coletiva: aproximações possíveis na Ciência da Informação?', 'pt_BR', '19', '3', 'SILVEIRA, M. A. A. J.; CAREGNATO, S. E.; BUFREM, L. S.', '5627209208288722', 'estudos de citação; memória.'),
(161, 8, '2014', 'ESTUDO DAS RAZÕES DAS CITAÇÕES NA CIÊNCIA DA INFORMAÇÃO: PROPOSTA DE CLASSIFICAÇÃO', 'pt_BR', '7', '2', 'SILVEIRA, M. A. A. J.; CAREGNATO, S. E.; BUFREM, L. S.', '5627209208288722', 'análise de citações; estudos de citação.'),
(162, 60, '2012', 'CONTRIBUCIÓN DEL ACCESO ABIERTO A LA VISIBILIDAD DE LA LITERATURA CIENTÍFICA EN UNA INSTITUCIÓN DE EDUCACIÓN SUPERIOR', 'pt_BR', '2', '3', 'PAVÃO, C. M. G.; COSTA, J. S. B.; HOROWITZ, Z.; KLANOVICZ, M.; CAREGNATO, S. E.', '5627209208288722', 'repositórios; acesso aberto.'),
(163, 10, '2012', 'Science in South Brazil: Production overview between 2000 and 2010', 'pt_BR', '6', '1', 'STUMPF, I. R. C.; CAREGNATO, S. E.; MOURA, A. M. M.; VANZ, S. A. A. S.', '5627209208288722', 'produção científica; comunicação científica; cientometria.'),
(164, 29, '2012', 'Compartilhamento de dados e e-Science: explorando um novo conceito para a comunicação científica', 'pt_BR', '8', '2', 'MEDEIROS, J. S.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; colaboração científica; e-science; compartilhamento de dados.'),
(165, 29, '2012', 'A comunicação científica nos blogs de pesquisadores brasileiros: interpretações segundo categorias obtidas da análise de links', 'pt_BR', '8', '2', 'SOUSA, R. S. C.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; blogs.'),
(166, 11, '2011', 'Co-autoria em artigos e patentes: um estudo da interação entre a produção científica e tecnológica', 'pt_BR', '16', '2', 'MOURA, A. M. M.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; cientometria; informação em ciência e tecnologia.'),
(167, 32, '2011', 'Google Acadêmico como Ferramenta para os Estudos de Citações: Avaliação da Precisão das Buscas por Autor', 'pt_BR', '5', '3', 'CAREGNATO, S. E.', '5627209208288722', 'cientometria; busca de informação; comunicação científica; Google Acadêmico.'),
(168, 61, '2011', 'Colaboração científica e análise das redes sociais', 'pt_BR', '25', '2', 'MAIA, M. F. T. S.; ZANOTTO, S. N. R.; CAREGNATO, S. E.', '5627209208288722', 'colaboração científica; comunicação científica.'),
(169, 2, '2010', 'Produção científica dos pesquisadores brasileiros que depositaram patentes na área da biotecnologia, no período de 2001 a 2005: colaboração interinstitucional e interpessoal', 'pt_BR', '15', '29', 'MOURA, A. M. M.; CAREGNATO, S. E.', '5627209208288722', 'cientometria; colaboração científica; comunicação científica.'),
(170, 4, '2010', 'CO-CLASSIFICAÇÃO ENTRE ARTIGOS E PATENTES: um estudo da interação entre C&amp;T na Biotecnologia Brasileira', 'pt_BR', '20', '2', 'MOURA, A. M. M.; CAREGNATO, S. E.', '5627209208288722', 'cientometria; informação em ciência e tecnologia.'),
(171, 3, '2010', 'Blogs científicos.br? : um estudo exploratório', 'pt_BR', '15', '', 'SOUSA, R. S. C.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; blogs.'),
(172, 19, '2008', 'A editoração eletrônica de revistas científicas brasileiras: o uso do SEER/OJS', 'pt_BR', '20', '2', 'FERREIRA, A. G. C.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; periódicos científicos; SEER/OJS.'),
(173, 11, '2008', 'Co-autoria como indicador de redes de colaboração científica', 'pt_BR', '13', '2', 'MAIA, M. F. T. S.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; co-autoria; colaboração científica; redes sociais.'),
(174, 62, '2008', 'Portal de Periódicos da CAPES: um misto de solução financeira e inovação', 'pt_BR', '7', '1', 'CORRÊA, C. H. W.; CRESPO, I. M.; STUMPF, I. R. C.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; periódicos científicos; portal de periódicos.'),
(175, 12, '2007', 'Estudo sobre a Terminologia da Literatura Infantil e Juvenil: uma possibilidade para o controle de vocabulário', 'pt_BR', '17', '1', 'FERREIRA, G. R. I. S.; BONOTTO, M. E. K. K.; LAAN, R. H. V. D.; CAREGNATO, S. E.', '5627209208288722', 'literatura Infantil; sistemas de recuperação da informação.'),
(176, 9, '2007', 'Connotea: site para a comunicação científica e compartilhamento de informações na Internet', 'pt_BR', '5', '1', 'PAVAN, C.; DANTAS, G. R. G. C.; STUMPF, I. R. C.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; tecnologias da informação e comunicação.'),
(177, 63, '2007', 'A constituição do campo da Comunicação no sul do Brasil a partir da prática de comunicação científica discente', 'pt_BR', '16', '1', 'VANZ, S. A. A. S.; CAREGNATO, S. E.', '5627209208288722', 'comunicação; bibliometria; análise de citações.'),
(178, 64, '2007', 'Interfaces entre os campos da Comunicação e da Informação', 'pt_BR', '10', '2', 'BRAMBILLA, S. N. D. S.; LAIPELT, R. C. F.; CAREGNATO, S. E.; STUMPF, I. R. C.', '5627209208288722', 'comunicação; Ciência da Informação.'),
(179, 11, '2006', 'Elaboração e aplicação de instrumentos para avaliação da base de dados Scopus', 'pt_BR', '11', '', 'MESQUITA, R. M. A.; BRAMBILLA, S. N. D. S.; LAIPELT, R. C. F.; MAIA, M. F. T. S.; VANZ, S. A. A. S.; CAREGNATO, S. E.', '5627209208288722', 'bases de dados; sistemas de recuperação da informação.'),
(180, 12, '2006', 'Inclusão Digital: Laços entre Bibliotecas e Telecentros', 'pt_BR', '16', '1', 'LAIPELT, R. C. F.; MOURA, A. M. M.; CAREGNATO, S. E.', '5627209208288722', 'inclusão digital; telecentros comunitários; bibliotecas.'),
(181, 2, '2006', 'Interações entre Ciência e Tecnologia: análise da produção intelectual dos pesquisadores-inventores da primeira carta-patente da UFRGS', 'pt_BR', '22', '', 'MOURA, A. M. M.; ROZADOS, H. B. F.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; produção científica; produção tecnológica.'),
(182, 20, '2006', 'Padrões de comportamento de busca e uso de informação por pesquisadores de biologia molecular e biotecnologia', 'pt_BR', '35', '3', 'CRESPO, I. M.; CAREGNATO, S. E.', '5627209208288722', 'comunicação científica; busca e uso de informações.'),
(183, 24, '2005', 'O futuro dos livros do passado: a biblioteca digital contribuindo na preservação e acesso às obras raras', 'pt_BR', '11', '', 'NARDINO, A. T.; CAREGNATO, S. E.', '5627209208288722', 'bibliotecas digitais; digitalização; obras raras.'),
(184, 13, '2004', 'Community Telecentres in Brazil The Porto alegre Experience: towards digital and social inclusion', 'en', '30', '', 'CAREGNATO, S. E.; MOURA, A. M. M.', '5627209208288722', 'inclusão digital; telecentros comunitários.'),
(185, 24, '2003', 'Análise das Carcterísticas e Percepções de Alunos de Educação a Distância no Curso de Biblioteconomia da UFRGS', 'pt_BR', '9', '', 'CAREGNATO, S. E.; MOURA, A. M. M.', '5627209208288722', 'educação a distância; tecnologias da informação e comunicação.'),
(186, 24, '2003', 'Comportamento de busca de informação: uma comparação entre dois modelos', 'pt_BR', '9', '', 'CRESPO, I. M.; CAREGNATO, S. E.', '5627209208288722', 'busca de informação.'),
(187, 24, '2003', 'Estudos de citação: uma ferramenta para entender a comunicação científica', 'pt_BR', '9', '', 'VANZ, S. A. A. S.; CAREGNATO, S. E.', '5627209208288722', 'estudos de citação.'),
(188, 28, '2000', 'O Desenvolvimento de Habilidades Informacionais: o papel das bibliotecas universitárias no contexto da informação digital em rede', 'pt_BR', '8', '', 'CAREGNATO, S. E.', '5627209208288722', 'educação de usuários; competencia informacional; bibliotecas universitárias.'),
(189, 28, '2000', 'Projetos de Leitura vão às Escolas', 'pt_BR', '8', '', 'SILVA, C. E. C.; ROCHA, M. L.; CAREGNATO, S. E.', '5627209208288722', 'literatura Infantil.'),
(190, 65, '1995', 'Sistemas especialistas em bibliotecas: desenvolvimento de um protótipo para catalogação', 'pt_BR', '24', '', 'CAREGNATO, S. E.; FORD, N.', '5627209208288722', 'sistemas baseados em conhecimento.');
INSERT INTO `artigo_publicado` (`id_ap`, `ap_journal_id`, `ap_ano`, `ap_titulo`, `ap_idioma`, `ap_vol`, `ap_serie`, `ap_autores`, `ap_autor`, `ap_keywords`) VALUES
(191, 66, '1994', 'Expert systems support for subject librarians or subject specialists in academic libraries', 'en', '4', '', 'CAREGNATO, S. E.; FORD, N.; LOUGHRIDGE, B.', '5627209208288722', 'sistemas baseados em conhecimento.'),
(192, 59, '2016', 'Internationality of Publications, Co-Authorship, References and Citations in Brazilian Evolutionary Biology', 'en', '4', '1', 'SANTIN, D.; VANZ, S. A. A. S.; CAREGNATO, S.', '5243732207004083', 'Cientometria; Análise de citação; Colaboracao cientifica; Biologia evolutiva.'),
(193, 102, '2016', 'Neurosciences in Brazil: a bibliometric study of main characteristics, collaboration and citations', 'en', 'online', '0', 'HOPPEN, N. H. F.; VANZ, S. A. A. S.', '5243732207004083', 'Bibliometria; Neurociências; Análise de citação; Colaboracao cientifica.'),
(194, 54, '2016', 'Internacionalização da produção científica brasileira: políticas, estratégias e medidas de avaliação', 'pt_BR', '13', '3', 'SANTIN, D. M.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Indicadores Científicos; Internacionalização; Ciência Brasileira.'),
(195, 2, '2016', 'Scientific collaboration between Brazil and Spain: journals and citations', 'pt_BR', '21', '47', 'VANZ, S. A. A. S.; FILIPPO, D.; CAREGNATO, S. N. E.; ZORITA, C. G.; MOURA, A. M. M.; SÁNCHEZ, M. L. L.; CASADO, E. S.', '5243732207004083', 'Bibliometria; Análise de citação; Colaboracao cientifica; Espanha; Periódico científico.'),
(196, 103, '2016', 'Evasão e retenção no curso de Biblioteconomia da UFRGS', 'en', '21', '2', 'VANZ, S. A. A. S.; PEREIRA, P. C. M. S.; FERREIRA, G. R. I. S.; MACHADO, G. R.', '5243732207004083', 'Biblioteconomia; Evasão; Retenção universitária.'),
(197, 4, '2016', 'Brazilian Neuroscience research areas: a bibliometric analysis from 2006 to 2013', 'en', '26', '3', 'HOPPEN, N. H. F.; SOUZA, C. D.; FILIPPO, D.; VANZ, S. A. A. S.; CASADO, E. S.', '5243732207004083', 'Bibliometria; Cientometria; Neurociências.'),
(198, 104, '2016', 'Collaboration Networks in the Brazilian Scientific Output in Evolutionary Biology: 2000-2012', 'en', '88', '1', 'SANTIN, D. M.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Colaboracao cientifica; Biologia evolutiva; Ciências Biológicas.'),
(199, 19, '2015', 'Internacionalização da produção científica em Ciências Biológicas da UFRGS: 2000-2011', 'pt_BR', '27', '', 'SANTIN, D. M.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Indicadores Científicos; Internacionalização; Ciências Biológicas; Colaboracao cientifica.'),
(200, 5, '2015', 'Revista Em Questão: uma análise da sua trajetória a partir dos critérios Qualis (2003-2012)', 'pt_BR', '21', '1', 'OLIVEIRA, C.; SANTIN, D. M.; VANZ, S. A. A. S.', '5243732207004083', 'Periódico científico; Qualis.'),
(201, 4, '2015', 'Panorama da produção conjunta entre Brasil e Espanha indexada na WoS entre 2006-2012: indicadores de Atividade, Especialização e Colaboração', 'pt_BR', '25', '1', 'MOURA, A. M. M.; FILIPPO, D.; SÁNCHEZ, M. L. L.; VANZ, S. A. A. S.; CAREGNATO, S. N. E.', '5243732207004083', 'Bibliometria; Cientometria; Colaboracao cientifica; Espanha.'),
(202, 105, '2015', 'Produção científica em Ciências Biológicas da UFRGS: tendências temáticas no período 2000-2011', 'en', '20', '3', 'SANTIN, D. M.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Ciências Biológicas.'),
(203, 5, '2015', 'Brazilian Agricultural Research in the Web of Science: Bibliometric Study of Scientific Output and Collaboration (2000-2011)', 'pt_BR', '21', '3', 'VARGAS, R. A.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Colaboracao cientifica; Ciências agrárias.'),
(204, 106, '2014', 'A produção científica do Rio Grande do Sul em Ciências Agrárias representada na base Web of Science', 'en', '44', '5', 'VARGAS, R. A.; VANZ, S. A. A. S.', '5243732207004083', 'Cientometria; Bibliometria; Ciências agrárias.'),
(205, 107, '2014', 'The role of National journals on the rise in Brazilian Agricultural Science Publications in Web of Science', 'en', '3', '1', 'VARGAS, R. A.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Ciências agrárias; Periódico científico.'),
(206, 8, '2014', 'A ciência no Rio Grande do Sul: indicadores de produção e colaboração nos anos 2000 a 2010', 'pt_BR', '7', '1', 'CAREGNATO, S. N. E.; VANZ, S. A. A. S.; MOURA, A. M. M.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Rio Grande do Sul; Indicadores Científicos.'),
(207, 5, '2014', 'Projeto de identidade visual para a revista Em Questão', 'pt_BR', '20', '2', 'PASSOS, J. E.; PASSOS, P. C. S. J.; VANZ, S. A. A. S.', '5243732207004083', 'Comunicação Científica; Periódico científico; Projeto gráfico; Design.'),
(208, 29, '2013', 'Redes Colaborativas nos Estudos Métricos de Ciência e Tecnologia - Collaborative Networks in Metric Studies of Science and Technology', 'pt_BR', '9', '1', 'VANZ, S. A. A. S.', '5243732207004083', 'Cientometria; Bibliometria; Colaboracao cientifica; Redes de colaboração científica.'),
(209, 2, '2012', 'Indicadores da produção científica e co-autoria: análise do departamento de ciências da informação da UFRGS', 'pt_BR', '17', '', 'COSTA, J. G. A.; VANZ, S. A. A. S.', '5243732207004083', 'Bibliometria; Cientometria; Colaboracao cientifica; Indicadores Científicos.'),
(210, 10, '2012', 'Scientific Output Indicators and Scientific Collaboration Network Mapping in Brazil', 'en', '6', '2', 'VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria; Ciência Brasileira.'),
(211, 108, '2012', 'A pesquisa em administração estratégica nos primeiros anos do milênio: um estudo bibliométricos no Strategic Management Journal entre 2001 e 2007', 'pt_BR', '5', '2', 'SERRA, F.; FERREIRA, M.; ALMEIDA, M.; VANZ, S. A. A. S.', '5243732207004083', 'Bibliometria; Cientometria; Análise de citação; Análise de co-citação.'),
(212, 10, '2012', 'Science in South Brazil: Production overview between 2000 and 2010', 'en', '6', '1', 'STUMPF, I. R. C.; CAREGNATO, S. E.; MOURA, A. M. M.; VANZ, S. A. A. S.', '5243732207004083', 'produção científica; Comunicação Científica; Cientometria.'),
(213, 32, '2011', 'Arquivologia, Biblioteconomia e Museologia integradas na Ciência da Informação: as experiências da UFMG, UnB e UFRGS', 'pt_BR', '5', '1', 'ARAUJO, C. A. V.; MARQUES, A. L. A. C.; VANZ, S. A. A. S.', '5243732207004083', 'Ciência da Informação; Biblioteconomia; Arquivologia; Museologia.'),
(214, 109, '2011', 'Neotropical Ichthyology: trajectory and bibliometric index (2003-2010)', 'en', '1', '', 'STUMPF, I. R. C.; VANZ, S. A. A. S.; OLIVEIRA, N. G.; VARGAS, R. A.; BENTANCOURT, S. P.', '5243732207004083', 'Bibliometria; Análise de citação; Cientometria.'),
(215, 11, '2010', 'Colaboração científica: revisão teórico-conceitual', 'en', '15', '2', 'VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Colaboracao cientifica; Comunicação Científica; Cientometria; Bibliometria.'),
(216, 24, '2010', 'A produção intelectual em Ciência da Informação: análise de citações do DCI/UFRGS de 2000 a 2008', 'pt_BR', '16', '', 'COSTA, J. G. A.; VANZ, S. A. A. S.', '5243732207004083', 'Ciência da Informação; Comunicação Científica; Cientometria; Bibliometria; Análise de citação; Biblioteconomia.'),
(217, 4, '2010', 'Procedimentos e ferramentas aplicados aos estudos bibliométricos', 'pt_BR', '20', '2', 'VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Bibliometria; Cientometria.'),
(218, 85, '2007', 'Mapeamento das teses e dissertações em Comunicação no Brasil', 'pt_BR', '33', '', 'VANZ, S. A. A. S.; BRAMBILLA, S. N. D. S.; RIBEIRO, A. F.; STUMPF, I. R. C.', '5243732207004083', 'Comunicação; Indicadores Científicos; Analise Tematica; dissertação.'),
(219, 63, '2007', 'A constituição do campo da Comunicação no sul do Brasil a partir da prática de Comunicação Científica discente', 'pt_BR', '16', '', 'VANZ, S. A. A. S.; CAREGNATO, S. N. E.', '5243732207004083', 'Comunicação Científica; Análise de citação; Comunicação.'),
(220, 30, '2007', 'Re-Arquitetura e informação 24 horas no IPA Metodista', 'pt_BR', '20', '', 'VANZ, S. A. A. S.; FRAGA, C. A. S.; WEBER, M. M.', '5243732207004083', 'Biblioteca; conforto ambiental; Mobiliário; Sinalização de Bibliotecas; ergonomia.'),
(221, 2, '2006', 'Mapeamento de um artigo produzido na UFRGS: razões das citações recebidas', 'pt_BR', 'n.esp.', '', 'BRAMBILLA, S. N. D. S.; VANZ, S. A. A. S.; STUMPF, I. R. C.', '5243732207004083', 'Análise de citação; Cientometria; Comunicação Científica.'),
(222, 11, '2006', 'Elaboração e aplicação de instrumentos para avaliação da base de dados Scopus', 'pt_BR', '11', '2', 'MESQUITA, R.; BRAMBILLA, S. N.; LAIPELT, R. C.; MAIA, M. F. T.; VANZ, S. A. A. S.; CAREGNATO, S. E.', '5243732207004083', ''),
(223, 92, '2003', 'Vem pra fazer mais, vem traz a paixão: processos discursivos e estratégias de captura do cidadão no Horário de Propaganda Eleitoral Gratuita', 'pt_BR', '24', '', 'MORIGI, V. J.; COELHO, M. P.; VANZ, S. A. A. S.; GALDINO, K.', '5243732207004083', 'Comunicação Política; Processos discurssivos.'),
(224, 24, '2003', 'Estudos de citação: uma ferramenta para entender a comunicação científica', 'pt_BR', '9', '', 'VANZ, S. A. A. S.; CAREGNATO, S. N. E.', '5243732207004083', 'Ciência da Informação; Análise de citação; Bibliometria; Indicadores Científicos.'),
(225, 110, '2002', 'O Bibliotecário e suas Práticas na Construção da Cidadania', 'pt_BR', '7', '', 'MORIGI, V. J.; VANZ, S. A. A. S.; GALDINO, K.', '5243732207004083', 'Bibliotecário; Práticas profissionais.'),
(226, 5, '2002', 'Cidadania, Novos Tempos, Novas Aprendizagens: novos profissionais?', 'pt_BR', '', '', 'MORIGI, V. J.; VANZ, S. A. A. S.; GALDINO, K.', '5243732207004083', 'Bibliotecário; Práticas profissionais.'),
(227, 5, '2015', 'Olhares complementares sobre letramento científico e o papel dos pesquisadorres em comunidades virtuais', 'pt_BR', '21', '3', 'SOUSA, R. S. C.; SANTIAGO, B. L.; NASCIMENTO, B. S.', '0569672544113959', 'Comunicação Científica; Blogs; Letramento Científico; Webometria.'),
(228, 29, '2012', 'A comunicação científica nos blogs de pesquisadores brasileiros : interpretações segundo categorias obtidas da análise de links', 'pt_BR', '8', '2', 'SOUSA, R. S. C.; ELISA, C. S. N.', '0569672544113959', 'Comunicação Científica; Análise de links; Blogs.'),
(229, 3, '2010', 'Blogs científicos.br? um estudo exploratório', 'pt_BR', '15', 'esp', 'ELISA, C. S. N.; SOUSA, R. S. C.', '0569672544113959', 'Comunicação Científica; Blogs.'),
(230, 31, '2010', 'Competências Informacionais: uma análise focada no currículo e na produção docente dos cursos de biblioteconomia e gestão da informação', 'pt_BR', '15', '2', 'SOUSA, R. S. C.; NASCIMENTO, B. S.', '0569672544113959', 'Competência Informacional; Biblioteconomia; Currículo.'),
(231, 24, '2008', 'Das tecnologias da informação à comunicação científica: críticas à nova cultura da educação', 'pt_BR', '14', '2', 'SOUSA, R. S. C.', '0569672544113959', 'Comunicação Científica; teoria crítica da educação; educação.'),
(232, 24, '2005', 'Biblioteca e educação: conjecturas sobre a cultura da virtualidade', 'pt_BR', '11', '', 'SOUSA, R. S. C.; RODRIGUES, E. N. S.', '0569672544113959', 'Biblioteconomia; teoria crítica da educação; educação.'),
(233, 111, '1999', 'Avaliação da coleção de livros de comércio exterior da Biblioteca Elizabeth Papp Romak da Instituição Educacional São Judas Tadeu : propostas de Melhoria e Qualificação do Acervo', 'pt_BR', '3', '', 'SOUSA, R. S. C.', '0569672544113959', 'Desenvolvimento de Coleções; Biblioteca Universitária.'),
(234, 5, '2012', 'FABRICO/CIÊNCIA: Um Ambiente Linked Data para o Mapeamento da Ciência', 'pt_BR', '18', '3', 'ROCHA, R. P.', '5118387541734094', 'Web Semântica; comunicação científica; mapeamento da ciência.'),
(235, 2, '2012', 'Metadados de qualidade e visibilidade na comunicação científica', 'pt_BR', '17', '2', 'BENTANCOURT, S. M. P.; ROCHA, R. P.', '5118387541734094', 'comunicação científica; Metadados; OAIS.'),
(236, 56, '2011', 'Memória da Casa de Cultura Otto Stahlmigraçao de suporte de documentos audiovisuais', 'pt_BR', '61', '2', 'OLIVEIRA, L. D.; ROCHA, R. P.; VICTORINO, Y.; GIOVANAZ, M.; ZILLES, P. N.', '5118387541734094', 'Web Semântica; web 2.0; Ontologias.'),
(237, 28, '2004', 'Metadados, Web Semantica,Categorização Automática: Metadados, Web Semantica,Categorização Automática: combinado esforços humanos e computacionais para a descoberta e o uso dos recursos da web', 'pt_BR', '10', '', 'ROCHA, R. P.', '5118387541734094', 'Metadados; Web Semântica.'),
(238, 28, '2004', 'Avaliação de Descritores Relativos às Ciências da Informação:relato de pesquisa', 'pt_BR', '10', '', 'XAVIER, A. G. A.; RIBEIRO, A. F.; SANTOS, L. S. R.; ROCHA, R. P.; LAAN, R. H. V. D.', '5118387541734094', 'Base de Dados; Terminologia; Indexação Alfabética.'),
(239, 57, '2003', 'Uma Arquitetura de Metadados para Comunidades Virtuais de Pesquisa Científica', 'pt_BR', '27', '', 'PECCINI, G.; COPETTI, L. R.; MARCUZZO, M.; D´ORNELLAS, M. C.; ROCHA, R. P.', '5118387541734094', 'Comunidades Virtuais; Pesquisa Científica; Metadados; RDF.'),
(240, 58, '1998', 'Global Db Views In A Federation Of Autonomous Dbs - Supporting Ad-Hoc Queries In A Distributed Information System For Health Care', 'pt_BR', '2', '', 'ROCHA, R. P.', '5118387541734094', ''),
(241, 32, '2015', 'Evidência da Informação no contexto dos arquivos digitais', 'pt_BR', '9', '2', 'ROCKEMBACH, M. S.', '1304688580274983', 'evidência; informação; arquivos digitais; paradigmas da informação.'),
(242, 24, '2015', 'Conceitos, modelos e novas perspectivas de avaliação em Arquivologia e Ciência da informação', 'pt_BR', '21', '3', 'ROCKEMBACH, M. S.', '1304688580274983', ''),
(243, 33, '2015', 'Difusão em Arquivos: uma função arquivística, informacional e comunicacional', 'pt_BR', '4', '1', 'ROCKEMBACH, M. S.', '1304688580274983', ''),
(244, 33, '2013', 'Evidência da Informação em plataformas digitais: da reflexão teórica à construção de um modelo', 'pt_BR', '2', '1', 'ROCKEMBACH, M. S.', '1304688580274983', 'modelos de evidência; Ciência da Informação; plataformas digitais.'),
(245, 34, '2013', 'Información Evidencial en Entornos Digitales', 'pt_BR', '1', '32', 'ROCKEMBACH, M. S.', '1304688580274983', ''),
(246, 35, '2011', 'Informação: uma breve introdução', 'pt_BR', '16', '', 'ROCKEMBACH, M. S.', '1304688580274983', 'informação; dado; conceito; teoria.'),
(247, 35, '2010', 'Memória e Prova em Plataformas Digitais', 'pt_BR', '13', '', 'ROCKEMBACH, M. S.', '1304688580274983', 'memória; plataformas digitais; informação; prova.'),
(248, 50, '2015', 'As redes de conhecimento dos professores de ciências: um mapeamento da prática de ensino a partir da análise de redes sociais', 'pt_BR', '17', '', 'PEREIRA, J. C.; TEIXEIRA, M. R. F.', '6975295280564336', 'Análise de Redes Sociais; Educação Básica; Educação em Ciências.'),
(249, 51, '2015', 'O ensino de ciências nos anos iniciais da escolarização formal', 'pt_BR', 'XXX', '', 'PEREIRA, J. C.; TEIXEIRA, M. R. F.', '6975295280564336', ''),
(250, 51, '2015', 'O Desafio do Estudo de Ciências nas Escolas Indígenas do Rio Grande do Sul', 'pt_BR', 'XX', '', 'MIZETTI, M. C. F.; TEIXEIRA, M. R. F.', '6975295280564336', 'Educação em Ciências; Escolas Indígenas.'),
(251, 52, '2014', 'A disciplina de Gestão do Conhecimento no currículo do Curso de Biblioteconomia: a experiência da Universidade Federal do Rio Grande do Sul', 'pt_BR', '1', '1', 'TEIXEIRA, M. R. F.', '6975295280564336', 'Biblioteconomia; Gestão do conhecimento; Currículos.'),
(252, 53, '2014', 'O Uso das Fontes Informacionais no Ensino de Ciências e as Tecnologias de Informação e Comunicação', 'pt_BR', '4', '', 'PEREIRA, J. C.; TEIXEIRA, M. R. F.', '6975295280564336', 'Fontes de Informação; Educação em Ciências; TICs.'),
(253, 54, '2014', 'Redes de coautoria identificadas na produção científica em programa de pós-graduação da Universidade Federal do Rio Grande do Sul', 'pt_BR', '11', '', 'PEREIRA, J. C.; CALABRO, L.; TEIXEIRA, M. R. F.; SOUZA, D. O. G.', '6975295280564336', ''),
(254, 55, '2011', 'Redes de Conhecimento em Ciências e suas relações de Compartilhamento do Conhecimento', 'pt_BR', '8', '2011', 'TEIXEIRA, M. R. F.; SOUZA, D. O.', '6975295280564336', 'Compartilhamento do Conhecimento; Redes de Conhecimento; Redes Sociais; Informação; Educação em Ciências.'),
(255, 28, '2000', 'Bases de conhecimento como instrumentos de gestão do conhecimento', 'pt_BR', '8', '', 'TEIXEIRA, M. R. F.', '6975295280564336', 'Bases de Dados; Gestão do conhecimento; Memória Organizacional; Bases de conhecimento.'),
(256, 20, '1997', 'A Informação Estratégica para a Empresa: a metodologia de Vigília Técnológica', 'pt_BR', '26', '', 'TEIXEIRA, M. R. F.', '6975295280564336', 'Informação; Inovação Tecnológica; Planejamento estratégico; Patentes; Vigília tecnológica.'),
(257, 36, '2016', 'O domínio de organização do conhecimento na base brapci: uma análise estatística', 'pt_BR', '70', '', 'AMORIM NETO, M. R.; LIMA, M. H. T. F.', '6563330119993372', 'ORGANIZAÇÃO DO CONHECIMENTO; BRAPCI; COMUNICAÇÃO CIENTÍFICA; BIBLIOMETRIA; PRODUÇÃO CIENTÍFICA.'),
(258, 37, '2016', 'Efeitos da Lei de Acesso à Informação: empregabilidade de arquivistas no setor público federal entre 2006 e 2014', 'pt_BR', '29', '1', 'COSTA, U. C.; LIMA, M. H. T. F.', '6563330119993372', 'ARQUIVOLOGIA; LEI DE ACESSO À INFORMAÇÃO; SERVIÇO PÚBLICO FEDERAL; EMPREGABILIDADE.'),
(259, 38, '2016', 'ENTRE SILÊNCIOS E SUSSURROS: A QUESTÃO DO ACESSO À INFORMAÇÃO SOBRE O ?LOUCO?, UMA ANÁLISE DOS PRONTUÁRIOS DO HOSPITAL PSIQUIÁTRICO DE JURUJUBA', 'pt_BR', '3', '1', 'SANCHES NETO, A. P.; LIMA, M. H. T. F.', '6563330119993372', 'ACESSO À INFORMAÇÃO; DOCUMENTO MÉDICO; PRONTUÁRIO MÉDICO; INFORMAÇÃO ARQUIVÍSTICA; HOSPITAL PSIQUIÁTRICO DE JURUJUBA, Niterói, RJ.'),
(260, 39, '2015', 'El derecho a la información mediante el estatuto teórico epistemológico en la era contemporánea', 'pt_BR', '38', '2', 'LIMA, M. H. T. F.', '6563330119993372', 'DIREITO DE INFORMAÇÃO; DIREITOS HUMANOS; ANÁLISE EPISTEMOLÓGICA.'),
(261, 40, '2015', 'CONDIÇÕES DE ACESSO À INFORMAÇÃO PARA O USUÁRIO SURDO', 'pt_BR', '2', '4', 'LIMA, M. H. T. F.; GOMES, C. A. S.', '6563330119993372', 'ACESSO À INFORMAÇÃO; DEFICIENTES AUDITIVOS; SURDOS; TECNOLOGIAS DE INFORMAÇÃO E COMUNICAÇÃO.'),
(262, 8, '2014', 'O ESTATUTO TEÓRICO EPISTEMOLÓGICO DO DIREITO À INFORMAÇÃO NO CONTEMPORÂNEO: DAS DIMENSÕES AOS LIMITES', 'pt_BR', '7', '1', 'LIMA, M. H. T. F.', '6563330119993372', 'DIREITO DE INFORMAÇÃO; ANÁLISE EPISTEMOLÓGICA; DIREITOS HUMANOS.'),
(263, 41, '2014', 'EFEITOS DA LEI DE ACESSO À INFORMAÇÃO: empregabilidade de arquivistas no setor público federal', 'pt_BR', '2', '2', 'LIMA, M. H. T. F.; COSTA, U. C.', '6563330119993372', 'ARQUIVISTAS; LEI DE ACESSO À INFORMAÇÃO; SERVIÇO PÚBLICO FEDERAL.'),
(264, 42, '2014', 'USABILIDADE E ACESSIBILIDADE NOS ESPAÇOS DAS BIBLIOTECAS UNIVERSITÁRIAS FEDERAIS BRASILEIRAS PARA USUÁRIOS SURDOS', 'pt_BR', '42', '', 'GOMES, C. A. S.; LIMA, M. H. T. F.', '6563330119993372', 'BIBLIOTECAS UNIVERSITÁRIAS; ACESSIBILIDADE; DIREITO DE INFORMAÇÃO; USUÁRIOS ESPECIAIS; SURDOS; USABILIDADE.'),
(265, 43, '2014', 'VIDA MÉDIA DA LITERATURA PERIÓDICA CITADA NA REVISTA ARQUIVO &amp; ADMINISTRAÇÃO ENTRE OS ANOS 1970 E 1990', 'pt_BR', '13', '1/2', 'COSTA, U. C.; LIMA, M. H. T. F.', '6563330119993372', 'ASSOCIAÇÕES PROFISSIONAIS; ARQUIVISTAS; ANÁLISE DE CITAÇÕES; VIDA MÉDIA.'),
(266, 44, '2009', 'Direito à informação sobre Direito: conexões entre pesquisa, extensão e normalização.', 'pt_BR', 'EdEsp', '', 'LIMA, M. H. T. F.; SILVA, R. P. M.', '6563330119993372', 'DIREITO DE INFORMAÇÃO; ENSINO SUPERIOR; DIREITO; NORMALIZAÇÃO; EXTENSÃO UNIVERSITÁRIA.'),
(267, 45, '2005', 'ANÁLISE TENDENCIAL DO DISCURSO DE UMA ONG', 'pt_BR', '8', '2', 'LIMA, M. H. T. F.', '6563330119993372', 'ONGS; IBASE; REVISTA POLÍTICAS GOVERNAMENTAIS; BIBLIOMETRIA.'),
(268, 46, '2004', 'A vontade dos direitos - o papel da educação', 'pt_BR', '9', '', 'LIMA, M. H. T. F.', '6563330119993372', 'DISCURSO; DIREITOS HUMANOS; FOUCAULT; HABERMAS; DISCURSO PEDAGÓGICO.'),
(269, 12, '2004', 'Marcas discursivas na formação de profissionais de memória', 'pt_BR', '14', '', 'LIMA, M. H. T. F.', '6563330119993372', 'ANÁLISE DO DISCURSO; CÊNCIA DA INFORRMAÇÃO; BIBLIOTECÁRIOS; DISCURSO PEDAGÓGICO; FORMAÇÃO PROFISSIONAL; PROFISSÕES DE MEMÓRIA.'),
(270, 47, '1999', 'Um mundo de discursos raros e memórias frágeis: uma leitura sobre (de)(in)formações profissionais inspirada em Foucault, Colombo e Pêcheux', 'pt_BR', '5', '', 'LIMA, M. H. T. F.', '6563330119993372', 'DISCURSO; MEMÓRIA; INFORMAÇÃO; FORMAÇÃO PROFISSIONAL; ENSINO SUPERIOR.'),
(271, 11, '1998', 'A NORMALIZAÇÃO DA INFORMAÇÃO E SUA INTERFACE COM A COMUNICAÇÃO CIENTÍFICA', 'pt_BR', '3', '', 'LIMA, M. H. T. F.; RODRIGUES, M. E. F.; GARCIA, M. J. O.', '6563330119993372', 'COMUNICAÇÃO CIENTÍFICA; FORMAÇÃO PROFISSIONAL; INFORMAÇÃO; NORMALIZAÇÃO.'),
(272, 48, '1984', 'Sistema CALCO aplicado à compilação de bibliografias', 'pt_BR', '2', '', 'LIMA, M. H. T. F.', '6563330119993372', ''),
(273, 49, '1980', 'Rede de Registro Bibliograficos.', 'pt_BR', '9', '', 'LIMA, M. H. T. F.; LINDEMAYER, E. E.', '6563330119993372', 'BASES DE DADOS; PESQUISA BIBLIOGRÁFICA.'),
(274, 9, '2016', 'Uma investigação sobre a autoria de dados científicos: teias de uma rede em construção', 'pt_BR', '14', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(275, 5, '2015', 'Uma abordagem conceitual sobre garantias de representação no gerenciamento da organização de estoques de informação como proposição ético-informacional', 'pt_BR', '21', '3', 'MEDEIROS, J. S.', '4182663628298542', ''),
(276, 19, '2013', 'Considerações sobre a esfera pública: redes sociais na internet e participação política', 'pt_BR', '25', '1', 'MEDEIROS, J. S.', '4182663628298542', ''),
(277, 15, '2012', 'Considerações sobre a informação na terceira ordem da ordem: um olhar a partir dos paradigmas da Ciência da Informação', 'pt_BR', '8', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(278, 29, '2012', 'Compartilhamento de dados e e-Science: explorando um novo conceito para a comunicação científica', 'pt_BR', '8', '2', 'MEDEIROS, J. S.; CAREGNATO, S. N. E.', '4182663628298542', ''),
(279, 30, '2011', 'Considerações sobre o e-book: do hipertexto à preservação digital', 'pt_BR', '24', '2', 'DZIEKANIAK, G. V.; MORAES, R. P. T.; MEDEIROS, J. S.; RAMOS, C. R. R.', '4182663628298542', ''),
(280, 3, '2011', 'A representação de domínios de conhecimento e uma teoria de representação: a ontologia de fundamentação', 'pt_BR', '16', '3', 'CAMPOS, M. L. A.; CAMPOS, L. M.; MEDEIROS, J. S.', '4182663628298542', ''),
(281, 31, '2010', 'A construção do conceito: aproximações complementares entre a análise de Michel Foucault e Ingetraut Dahlberg', 'pt_BR', '15', '2', 'MEDEIROS, J. S.', '4182663628298542', ''),
(282, 2, '2008', 'Uso do padrão MARC em bibliotecas universitárias da região sul do Brasil', 'pt_BR', '13', '', 'DZIEKANIAK, G. V.; MEDEIROS, J. S.; SILVEIRA, J. O. B.; FORTES, M. F.; BORGES, V. N.', '4182663628298542', 'Metadados; Representação da informação; Bibliotecas universitárias.'),
(283, 14, '2016', 'A biblioteca escolar e as crianças pequenas', 'pt_BR', '46', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(284, 15, '2014', 'Acessibilidade Arquitetônica em Diferentes Tipologias de Bibliotecas', 'pt_BR', '10', 'Especial', 'MORO, E. L. S.; GIACUMUZZI, G.', '7005124544331261', ''),
(285, 15, '2014', 'Projeto de Leitura Vivendo Histórias: vivendo a inclusão por meio da leitura numa casa geriátrica', 'pt_BR', '10', 'Especial', 'MORO, E. L. S.; TIMM, C.; TRESSINO, C. S.; GIACUMUZZI, G.', '7005124544331261', ''),
(286, 16, '2012', 'A Educação Aberta e a Distância e a Formação de Mediadores de Leitura através das Tecnologias de Informação e de Comunicação', 'pt_BR', '10', '3', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Educação Aberta e a Distância - EAD; mediadores de leitura.'),
(287, 3, '2011', 'Especialização em Bibliotecas Escolares e Acessibilidade: discutindo a gestão da biblioteca na modalidade EAD', 'pt_BR', '16', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'biblioteca escolar; EAD; acessibilidade; gestão de biblioteca.'),
(288, 17, '2011', 'Neue Tendenzen der Schulbibliotheken in Brasilien. Forum für die Verbesserung der Schulbibliotheken in Rio Grande do Sul, das Mobiliserungsprojekt und die Verabschiedung des Gesetzes über die Schulbibliotheken', 'dk', '35', '', 'SERAFINI, L. T.; ESTABEL, L. B.; MORO, E. L. S.; KAUP, U.', '7005124544331261', 'biblioteca.'),
(289, 18, '2011', 'A mediação da leitura na família, na escola e na biblioteca através das tecnologias de informação e de comunicação e a inclusão social das pessoas com necessidades especiais', 'pt_BR', '4', '', 'ESTABEL, L.; MORO, E. L. S.', '7005124544331261', 'Leitura; mediadores de leitura; informação.'),
(290, 3, '2010', 'Uma Proposta de Atendimento às Necessidades de Informação dos Usuários da Biblioteca Escolar por meio do Benchmarking e do Sensemaking', 'pt_BR', '15', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(291, 16, '2010', 'Internet na Biblioteca Escolar: Blog Biblioteca ETS: criação e evolução desta ferramenta na WEB 2.0. RENOTE. Revista Novas Tecnologias na Educação', 'pt_BR', '8', '', 'COUTINHO, K. T.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'tecnologias de informação e de comunicação; biblioteca escolar.'),
(292, 19, '2009', 'A Formação de Professores e a Capacitação de Bibliotecários com limitação Visual através da EAD em Ambiente Virtual de Aprendizagem', 'pt_BR', '21', '', 'ESTABEL, L.; MORO, E. L. S.', '7005124544331261', ''),
(293, 20, '2008', 'Gestão da biblioteca escolar: metodologias, enfoques e aplicação de ferramentas de gestão e serviços de biblioteca', 'pt_BR', '37', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Gestão; biblioteca escolar; biblioteconomia.'),
(294, 20, '2008', 'Gestão da biblioteca escolar: metodologias, enfoques e aplicação de ferramentas de gestão e serviços de biblioteca', 'pt_BR', '37', '', 'BEHR, A.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(295, 21, '2007', 'Proyecto Cor@je: Narrativas, TICs e Inclusión en el Hospital', 'pt_BR', '198', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'adolescente; Ambientes Virtuais de Aprendizagem; tecnologias de informação e de comunicação.'),
(296, 12, '2007', 'Formação Profissional e a Educação a Distância mediada por Computador: uma experiência no Curso de Biblioteconomia do DCI/FABICO/UFRGS', 'pt_BR', '17', '', 'ESTABEL, L. B.; MORO, E. L. S.', '7005124544331261', 'biblioteconomia; educação a distância- EAD.'),
(297, 18, '2007', 'Projeto Cor@gem: o acesso e o uso das TICs entre pacientes hospitalizados e a interação em ambientes virtuais de aprendizagem', 'pt_BR', '2', '2', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.; SILVA, F. A. A. E.', '7005124544331261', 'tecnologias de informação e de comunicação; pessoas com necessidades educacionais especiais; Fibrose Cística.'),
(298, 22, '2006', 'O Gênero nos Contos de Fadas Tradicionais e Modernos: a outra história de (Rapunzel) e Sapatinhos Vermelhos', 'pt_BR', '7', '', 'DUPONT, F.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(299, 22, '2006', 'Era Uma Vez . . . O Encantamento da Leitura e a Magia da Biblioteca: um estudo de caso sobre as narrativas e as diferenças de gênero', 'pt_BR', '7', '', 'MORO, E. L. S.; NEVES, I. C. O. B.; ESTABEL, L. B.', '7005124544331261', ''),
(300, 20, '2006', 'A Inclusão Social e Digital das Pessoas com Limitação Visual e o Uso das TICs na Produção de Páginas para a Internet.', 'pt_BR', '35', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(301, 16, '2006', 'Ambientes Virtuais de Aprendizagem e a Formação em EAD das PNEES com Limitação Visual: um estudo de caso utilizando ferramentas de interação', 'pt_BR', '4', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(302, 16, '2006', 'O Processo de Interação em Ambientes Virtuais de Aprendizagem Através de Narrativas, Produção Textual e Escrita Colaborativa de Crianças e Adolescentes com Fibrose Cística, em Isolamento Hospitalar.', 'pt_BR', '4', '', 'MORO, E. L. S.; ESTABEL, L. B.; SILVA, F. A. A. E.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(303, 20, '2006', 'Capacitação de Bibliotecários com Limitação Visual pela Educação a Distância em Ambientes Virtuais de Aprendizagem', 'pt_BR', '35', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'EAD; Ambientes Virtuais de Aprendizagem; internet.'),
(304, 12, '2006', 'BIBLIOTEC II: o bibliotecário como mediador propiciando a inclusão informacional, social, educacional e digital através da EAD', 'pt_BR', '16', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', 'biblioteconomia; Educação a Distância; Ambientes Virtuais de Aprendizagem.'),
(305, 23, '2006', 'superação das limitações na criação da página pessoal para internet: um estudo de caso', 'pt_BR', '9', '', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', 'tecnologias de informação e de comunicação; pessoas com necessidades educacionais especiais; educação a distância- EAD.'),
(306, 16, '2005', 'A Interação através da Iinformática na Educação com Crianças com Fibrose Cística e a Inclusão Social e Digital através do Uso da Leitura', 'pt_BR', '3', '1', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.; SILVA, F. A. A. E.', '7005124544331261', ''),
(307, 23, '2005', 'A Interação entre os Alunos, Educadores, Bibliotecários e a Pesquisa Escolar', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(308, 24, '2005', 'A Utilização das Tecnologias de Informação e de Comunicação e a Pesquisa Escolar: um estudo de caso com PNEEs com Limitação Visual', 'pt_BR', '10', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', 'Pessoas com Necessidades Educativas Especiais; pesquisa escolar; tecnologias de informação e de comunicação.'),
(309, 16, '2005', 'O Acesso às Tecnologias de Informação e de Comunicação e a Superação das Limitações dos PNEEs com Limitação Visual Incluindo-os em um Ambiente de Aprendizagem Mediado por Computador', 'pt_BR', '3', '1', 'ESTABEL, L. B.; MORO, E. L. S.; SANTAROSA, L. M. C.', '7005124544331261', ''),
(310, 25, '2004', 'Biblioterapia Através da Contação de Histórias para Crianças com Fibrose Cística no HCPA-RS', 'pt_BR', '9', '2', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(311, 24, '2004', 'A Utilização das Tecnologias de Informação e de Comunicação e a Pesquisa Escolar: um estudo de caso com os PNEEs com Limitação Visual.', 'pt_BR', '10', '1', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(312, 23, '2004', 'A Interação entre os Alunos, Educadores, Bibliotecários e a Pesquisa Escolar', 'pt_BR', '7', '2', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(313, 16, '2004', 'A Pesquisa Escolar Propiciando a Integração dos Atores - Alunos, Educadores e Bibliotecários - Irradiando o Benefício Coletivo e a Cidadania em um Ambiente de Aprendizagem Mediado por Computador', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(314, 16, '2004', 'O Uso das Tecnologias de Informação e de Comunicação na Pesquisa Escolar: Um Estudo de Caso com os PNEEs com Limitação Visual', 'pt_BR', '2', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'pesquisa escolar; pessoas com necessidades educacionais especiais.'),
(315, 23, '2003', 'Abordagens de Cooperação e Colaboração na Utilização de Ambiente de Aprendizagem Mediado por Computador pelos Portadores de Necessidades Educacionais Especiais com Limitação Visual', 'pt_BR', '6', '', 'MORO, E. L. S.; ESTABEL, L. B.; SANTAROSA, L. M. C.', '7005124544331261', 'informática na educação; educação; educação especial; inclusão social.'),
(316, 26, '2003', 'O Professor e os Alunos como Protagonistas na Educação Aberta e a Distância Mediada por Computador', 'pt_BR', '21', '', 'MORO, E. L. S.; ESTABEL, L. B.; TAROUCO, L. M. R.', '7005124544331261', 'Educação a Distância; informática na educação.'),
(317, 26, '2003', 'O Professor e os Alunos como Protagonistas na Educação Aberta e a Distância Mediada por Computador', 'pt_BR', '21', '', 'TAROUCO, L. M. R.; MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(318, 26, '2003', 'O Encantamento da Leitura e a Magia da Biblioteca Escolar', 'pt_BR', 'VII', '40', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(319, 24, '2003', 'Bibliotec: experiência do Curso de Extensão em EAD mediado por computador.', 'pt_BR', '9', '', 'MORO, E. L. S.; ESTABEL, L. B.; TAZIMA, I.; VARGAS, L. M.; DAMO, A. V.; SOARES, D. B.', '7005124544331261', ''),
(320, 27, '2002', 'As Novas Tecnologias da Informação e Comunicação e a Pesquisa Escolar', 'pt_BR', '5', '', 'MORO, E. L. S.; DIAS, J. W.; ESTABEL, L.; CARNEIRO, M. R. L. F.', '7005124544331261', 'tecnologia; pesquisa escolar; internet.'),
(321, 26, '2001', 'Learning and Interacting with Videoconferencing: In Search of a New Pedagogy.', 'pt_BR', '1', '', 'MORO, E. L. S.; ESTABEL, L. B.; COSTA, J. S.; DIAS, J. W.; HUGHES, M.; CARNEIRO, M. R. L. F.', '7005124544331261', ''),
(322, 28, '2000', 'Educação a Distância, Novas Ferramentas e a Biblioteconomia', 'pt_BR', '9', '', 'MORO, E. L. S.; ESTABEL, L. B.', '7005124544331261', ''),
(323, 24, '2015', 'A análise de logs como estratégia para a realização da garantia do usuário', 'pt_BR', '21', '3', 'LAIPELT, R. C. F.', '5900345665779424', 'Representação do conhecimento; Recuperação da Informação; Garantia do usuário; Análise de logs.'),
(324, 64, '2007', 'Interfaces entre os campos da Comunicação e da Informação', 'pt_BR', '10', 'n. 2', 'BRAMBILLA, S. N. D. S.; LAIPELT, R. C. F.; CAREGNATO, S. N. E.; STUMPF, I. R. C.', '5900345665779424', 'Campo da Ciência da Informação; Campo da Comunicação; Ciência da Informação; Comunicação; Informação.'),
(325, 11, '2006', '. Elaboração e aplicação de instrumentos para avaliação da base de dados Scopus', 'pt_BR', '11', '2', 'MESQUITA, R.; BRAMBILLA, S.; LAIPELT, R. C. F.; MAIA, F.; VANZ, S.; CAREGNATO, S.', '5900345665779424', 'Bases de Dados; Scopus; Performance; Bases de Dados - avaliação.'),
(326, 12, '2006', 'Inclusão Digital: laços entre bibliotecas e telecentros', 'pt_BR', '16', '1', 'LAIPELT, R. C. F.; MOURA, A. M. M.; CAREGNATO, S. N. E.', '5900345665779424', 'Inclusão Digital; Inclusão Social; Telecentro; Telecentros Comunitários; Cidadania.');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE IF NOT EXISTS `journals` (
`id_j` bigint(20) unsigned NOT NULL,
  `j_issn` char(9) NOT NULL,
  `j_issn_ol` char(9) NOT NULL,
  `j_issn_l` char(9) NOT NULL,
  `j_name` char(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id_j`, `j_issn`, `j_issn_ol`, `j_issn_l`, `j_name`) VALUES
(1, '2178-2075', '', '2178-2075', 'InCID: Revista de Ciência da Informação e Documentação'),
(2, '1518-2924', '', '1518-2924', 'Encontros Bibli'),
(3, '1981-8920', '', '1981-8920', 'Informação &amp; Informação (UEL. Online)'),
(4, '1809-4783', '', '1809-4783', 'Informação &amp; Sociedade (UFPB. Online)'),
(5, '1808-5245', '', '1808-5245', 'Em Questão'),
(6, '1981-6278', '', '1981-6278', 'RECIIS. Revista Eletrônica de Comunicação, Informação &amp; Inovação em Saúde (Edição em Português. Online)'),
(7, '1981-0695', '', '1981-0695', 'Pesquisa Brasileira em Ciência da Informação e Biblioteconomia'),
(8, '1983-5116', '', '1983-5116', 'Tendências da Pesquisa Brasileira em Ciência da Informação'),
(9, '1678-765X', '', '1678-765X', 'Revista Digital de Biblioteconomia e Ciência da Informação'),
(10, '0973-7766', '', '0973-7766', 'Collnet Journal of Scientometrics and Information Management'),
(11, '1413-9936', '', '1413-9936', 'Perspectivas em Ciência da Informação (Impresso)'),
(12, '0104-0146', '', '0104-0146', 'Informação &amp; Sociedade (UFPB. Impresso)'),
(13, '', '', '', 'Bulletin of the American Society for Information Science and Technology'),
(14, '1677-3721', '', '1677-3721', 'Pátio (Porto Alegre. 2002)'),
(15, '1980-6949', '', '1980-6949', 'RBBD. Revista Brasileira de Biblioteconomia e Documentação (Online)'),
(16, '1679-1916', '', '1679-1916', 'RENOTE. Revista Novas Tecnologias na Educação'),
(17, '0341-4183', '', '0341-4183', 'BIBLIOTHEK Forschung und Praxis'),
(18, '1808-8678', '', '1808-8678', 'Inclusão Social (Online)'),
(19, '0103-3786', '', '0103-3786', 'Transinformação'),
(20, '0100-1965', '', '0100-1965', 'Ciência da Informação (Impresso)'),
(21, '0328-3534', '', '0328-3534', 'Novedades Educativas'),
(22, '0103-7307', '', '0103-7307', 'Pro-Posições (Unicamp)'),
(23, '1516-084X', '', '1516-084X', 'Informática na Educação'),
(24, '1807-8893', '', '1807-8893', 'Em Questão (UFRGS)'),
(25, '1414-4190', '', '1414-4190', 'Expressa Extensão (UFPel)'),
(26, '0104-4060', '', '0104-4060', 'Educar em Revista'),
(27, '', '', '', 'Anais do XXII Congresso da Sociedade Brasileira de Computação'),
(28, '0103-0361', '', '0103-0361', 'Revista de Biblioteconomia e Comunicação'),
(29, '1808-3536', '', '1808-3536', 'Liinc em Revista'),
(30, '0102-4388', '', '0102-4388', 'Biblos (Rio Grande)'),
(31, '1414-0594', '', '1414-0594', 'Revista ACB (Florianópolis)'),
(32, '1981-6766', '', '1981-6766', 'PontodeAcesso (UFBA)'),
(33, '2316-7300', '', '2316-7300', 'Informação Arquivística'),
(34, '1988-5032', '', '1988-5032', 'Revista de Documentación (Plasencia)'),
(35, '1646-3153', '', '1646-3153', 'Prisma.com'),
(36, '0187-358X', '', '0187-358X', 'Investigación Bibliotecológica'),
(37, '0102-700X', '', '0102-700X', 'Acervo (Rio de Janeiro)'),
(38, '2358-7806', '', '2358-7806', 'Logeion: Filosofia da Informação'),
(39, '0120-0976', '', '0120-0976', 'Revista Interamericana de Bibliotecologia'),
(40, '0719-4706', '', '0719-4706', 'REVISTA INCLUSIONES: Revista de Humanidades y Ciencias Sociales'),
(41, '2318-6186', '', '2318-6186', 'Archeion Online'),
(42, '0103-7668', '', '0103-7668', 'Espaço (Rio de Janeiro. 1990)'),
(43, '0100-2244', '', '0100-2244', 'Arquivo e Administração'),
(44, '1981-1020', '', '1981-1020', 'Revista de Direito das Novas Tecnologias'),
(45, '2317-675X', '', '2317-675X', 'Comunicação e Informação'),
(46, '1413-7321', '', '1413-7321', 'La Salle (Canoas)'),
(47, '0104-9461', '', '0104-9461', 'Informare - Universidade Federal do Rio de Janeiro, Escola de Comunicação'),
(48, '', '', '', 'BIBLIOTECA'),
(49, '', '', '', 'BOLETIM da ASSOCIAÇÃO RIOGRANDESE DE BIBLIOTECÁRIOS'),
(50, '1517-4492', '', '1517-4492', 'Acta Scientiae (ULBRA)'),
(51, '1984-2686', '', '1984-2686', 'Atas do X ENPEC'),
(52, '2358-3193', '', '2358-3193', 'REBECIN Revista Brasileira de Educação em Ciência da Informação'),
(53, '2178-3131', '', '2178-3131', 'SINECT - Simpósio Nacional de Ensino de Ciência e Tecnologia'),
(54, '1806-8405', '', '1806-8405', 'RBPG. Revista Brasileira de Pós-Graduação'),
(55, '1809-5100', '', '1809-5100', 'Atas do ... ENPEC'),
(56, '0210-4164', '', '0210-4164', 'Boletín de la ANABAD'),
(57, '0103-1155', '', '0103-1155', 'Hífen (Uruguaiana)'),
(58, '0104-6500', '', '0104-6500', 'Journal of the Brazilian Computer Society'),
(59, '2304-6775', '', '2304-6775', 'Publications'),
(60, '2027-7415', '', '2027-7415', 'e-Colabora: Revista de ciencia, educación, innovación y cultura apoyadas por redes de tecnología avanzada'),
(61, '2236-7594', '', '2236-7594', 'BIBLOS - Revista do Instituto de Ciências Humanas e da Informação'),
(62, '1677-2504', '', '1677-2504', 'Revista Brasileira de Inovação'),
(63, '1807-8583', '', '1807-8583', 'InTexto'),
(64, '1415-5842', '', '1415-5842', 'Comunicação &amp; Informação (UFG)'),
(65, '0100-0829', '', '0100-0829', 'Revista da Escola de Biblioteconomia da UFMG'),
(66, '1368-1613', '', '1368-1613', 'Information Research'),
(67, '2318-406X', '', '2318-406X', 'Rizoma - Revista do Departamento de Comunicação Social da Universidade de Santa Cruz do Sul.'),
(68, '2358-7814', '', '2358-7814', 'P2P &amp; INOVAÇÃO'),
(69, '1809-9386', '', '1809-9386', 'Contemporanea (UFBA. Online)'),
(70, '1809-4775', '', '1809-4775', 'Biblionline (João Pessoa)'),
(71, '2101-0366', '', '2101-0366', 'Etudes de Communication - langages, information, médiations'),
(72, '1984-7246', '', '1984-7246', 'Percursos (Florianópolis. Online)'),
(73, '0104-6829', '', '0104-6829', 'Comunicacao e Educacao (USP)'),
(74, '1518-8353', '', '1518-8353', 'Ciência da Informação (Online)'),
(75, '2238-5436', '', '2238-5436', 'Museologia e Interdisciplinaridade'),
(76, '1984-7785', '', '1984-7785', 'Cadernos de Estudos Culturais'),
(77, '2237-079X', '', '2237-079X', 'Revista Terceiro Incluído'),
(78, '1983-5213', '', '1983-5213', 'Revista Ibero-Americana de Ciência da Informação'),
(79, '1676-2924', '', '1676-2924', 'Morpheus (UNIRIO. Online)'),
(80, '1981-9854', '', '1981-9854', 'Brazilian Journalism Research (Online)'),
(81, '2178-2687', '', '2178-2687', 'Conexão - Comunicação e Cultura-UCS'),
(82, '2176-3070', '', '2176-3070', 'Destaques Acadêmicos'),
(83, '1980-3729', '', '1980-3729', 'Revista FAMECOS (Online)'),
(84, '0001-3765', '', '0001-3765', 'Anais da Academia Brasileira de Ciências (Impresso)'),
(85, '1415-0549', '', '1415-0549', 'Revista FAMECOS'),
(86, '2179-6033', '', '2179-6033', 'Rádio-Leituras'),
(87, '0104-7132', '', '0104-7132', 'Estudo &amp; Debate (UNIVATES. Impresso)'),
(88, '1678-0701', '', '1678-0701', 'Educação Ambiental em Ação'),
(89, '1983-0882', '', '1983-0882', 'Caderno Pedagógico (Lajeado. Online)'),
(90, '1518-188X', '', '1518-188X', 'Ecos Revista'),
(91, '1414-2139', '', '1414-2139', 'Informação &amp; Informação'),
(92, '1413-0416', '', '1413-0416', 'Signos (Lajeado)'),
(93, '1668-5431', '', '1668-5431', 'Oficios Terrestres'),
(94, '0104-3064', '', '0104-3064', 'Vivência (Natal)'),
(95, '', '', '', 'Comunicação e Saúde Revista Digital'),
(96, '1808-2599', '', '1808-2599', 'E-Compós (Brasília)'),
(97, '1518-6946', '', '1518-6946', 'Comunicação e Espaço Público (UnB)'),
(98, '1003-0361', '', '1003-0361', 'Em Questão: Revista da Faculdade de Biblioteconomia e Comunicação'),
(99, '1517-5081', '', '1517-5081', 'Especiaria (UESC)'),
(100, '0102-4248', '', '0102-4248', 'Cadernos de Estudos Sociais (FUNDAJ)'),
(101, '0104-8015', '', '0104-8015', 'Política &amp; Trabalho'),
(102, '0138-9130', '', '0138-9130', 'Scientometrics (Print)'),
(103, '1982-5765', '', '1982-5765', 'Avaliacao (Campinas)'),
(104, '1678-2690', '', '1678-2690', 'Anais da Academia Brasileira de Ciências (Online)'),
(105, '1981-5344', '', '1981-5344', 'Perspectivas em Ciência da Informação (Online)'),
(106, '0103-8478', '', '0103-8478', 'Ciência Rural (UFSM. Impresso)'),
(107, '2320-0057', '', '2320-0057', 'Journal of Scientometric Research'),
(108, '1984-3372', '', '1984-3372', 'Revista Eletrônica de Estratégia &amp; Negócios'),
(109, '1679-6225', '', '1679-6225', 'Neotropical Ichthyology (Impresso)'),
(110, '', '', '', 'Revista ACB: Biblioteconomia em Santa Catarina'),
(111, '', '', '', 'Práxis Biblioteconômica'),
(112, '0943-7444', '', '0943-7444', 'Knowledge Organization'),
(113, '1517-3801', '', '1517-3801', 'Datagramazero (Rio de Janeiro)'),
(114, '1518-3483', '', '1518-3483', 'Revista Diálogo Educacional (PUCPR. Impresso)');

-- --------------------------------------------------------

--
-- Table structure for table `lt_autores`
--

CREATE TABLE IF NOT EXISTS `lt_autores` (
`id_a` bigint(20) unsigned NOT NULL,
  `a_nome_completo` char(255) NOT NULL,
  `a_nome_citacao` char(255) NOT NULL,
  `a_nr_id` char(20) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=219 ;

--
-- Dumping data for table `lt_autores`
--

INSERT INTO `lt_autores` (`id_a`, `a_nome_completo`, `a_nome_citacao`, `a_nr_id`) VALUES
(1, 'Valdir Jose Morigi', 'MORIGI, V. J.;MORIGI, VALDIR JOSÉ', '6542370154854198'),
(2, 'Luis Fernando Herbert Massoni', 'MASSONI, L. F. H.', '1991208472616105'),
(3, 'Jocelaine Rodrigues de Sena', 'SENA, J. R.', ''),
(4, 'Thainá Ribeiro Loureiro', 'LOUREIRO, T. R.', ''),
(5, 'Roosewelt Lins Silva', 'SILVA, R. L.', ''),
(6, 'Maria Cristina Biasuz', 'BIASUZ, M. C.', ''),
(7, 'Nathália dos Santos Silva', 'SILVA, N. S.', '9546057606832009'),
(8, 'Robson da Silva Braga', 'BRAGA, R. S.', '3198424405274807'),
(9, 'Solange Inês Engelmann', 'ENGELMANN, S. I.', ''),
(10, 'Arthur Walber Viana', 'VIANA, Arthur Walber', ''),
(11, 'Anelise Schütz Dias', 'DIAS, A. S.', ''),
(12, 'Ana Paula Sehn', 'SEHN, A. P.', '0654542649318351'),
(13, 'CORRÊA, FRANCIELE ZARPELON', 'CORRÊA, FRANCIELE ZARPELON', '7204130693942431'),
(14, 'GUINDANI, JOEL FELIPE', 'GUINDANI, JOEL FELIPE', ''),
(15, 'Júlio César Bittencourt Francisco', 'FRANCISCO, J. C B.', '9039745264416666'),
(16, 'Luis Fernando Laroque', 'LAROQUE, L. F.', '6550642682865922'),
(17, 'Nara Emanuelli MAGALHAES', 'MAGALHAES, N. E.', ''),
(18, 'Carla Renata Gomes', 'GOMES, C. R.', ''),
(19, 'Júlia Elisabete Barden', 'BARDEN, J. E.', ''),
(20, 'Marlou Cristina KLIMA', 'KLIMA, M. C.', ''),
(21, 'Martha E K Bonotto', 'BONOTTO, Martha e K', '8344861243282618'),
(22, 'Carlos Henrique Armani Nery', 'NERY, C. H. A.', ''),
(23, 'Martha Eddy Krummenauer Kling Bonotto', 'BONOTTO, Martha E. K. Kling', ''),
(24, 'Carla Pires Vieira da Rocha', 'ROCHA, C. P. V.', '7383400134315824'),
(25, 'Simone Semensatto', 'SEMENSATTO, Simone', '8843378944024325'),
(26, 'Vicente W Darde', 'DARDE, V. W.', '8804240430040779'),
(27, 'Cristine Kaufmann', 'KAUFMANN, C.', ''),
(28, 'Luciana Monteiro Krebs', 'KREBS, L. M.', '8151372917111773'),
(29, 'Schossler, Giovana Beatriz', 'Schossler, Giovana Beatriz', ''),
(30, 'Cláudia Angnes', 'Angnes, Cláudia', ''),
(31, 'Marciano Buffon', 'BUFFON, Marciano', ''),
(32, 'Cristovão Domingos de Almeida', 'ALMEIDA, Cristovão Domingos de', '2395230202223375'),
(33, 'Joel Felipe Guindani', 'GUINDANI, J. F.', '2519320965882266'),
(34, 'Jane Marcia Mazzarino', 'MAZZARINO, J. M.', '4570485590802043'),
(35, 'kaufmann, Cristine', 'KAUFMANN, Cristine', ''),
(36, 'ALESSANDRA M.B.', 'FARIAS, Alessandra M.B', ''),
(37, 'DIEFERSOM A. FERNANDES', 'FERNANDES, DIEFERSOM A.', ''),
(38, 'Lia Luz', 'LUZ, Lia', '0410126717474538'),
(39, 'MORIGI. Valdir Jose', 'MORIGI. Valdir Jose', ''),
(40, 'CASTRO, Marcia', 'CATRO, Marcia', ''),
(41, 'Nilda Jacks', 'JACKS, Nilda', '7001106299339932'),
(42, 'Eloa Muniz', 'MUNIZ, E.', ''),
(43, 'Miriam Rossini', 'ROSSINI, Miriam', '0811758911094691'),
(44, 'Ilza Maria Tourinho Girardi', 'GIRARDI, Ilza Maria Tourinho', '2958087259315385'),
(45, 'Golin, Cida', 'GOLIN, Cida', ''),
(46, 'Baldissera', 'BALDISSERA, Rudimar', '5204014695557380'),
(47, 'Gonçalves', 'GONÇALVES, Sandra Maria Lucia P.', ''),
(48, 'liedke', 'LIEDKE, Enoí', ''),
(49, 'Conceição Deise', 'CONCEIÇÃO, Deise', ''),
(50, 'BERNARDETE BREGOLIN CERUTTI', 'CERUTTI, Bernardete B.', '5277368410203790'),
(51, 'Vera Tereza Costa', 'COSTA, V. T.', ''),
(52, 'marcia castro', 'CASTRO, M.', ''),
(53, 'Dirce Maria Santin', 'SANTIN, Dirce Maria', ''),
(54, 'Alexandre Veiga', 'VEIGA, Alexandre', '2270433677641480'),
(55, 'Adriano Warken Floriani', 'FLORIANI, Adriano Warken', '3294111780383578'),
(56, 'Sibila F T Binotto', 'BINOTTO, Sibila F T', ''),
(57, 'Alvanir Maria Rhoden', 'RHODEN, Alvanir Maria', '1513693107181534'),
(58, 'Magali Lippert da Silva', 'SILVA, Magali Lippert da', '4261006495281136'),
(59, 'Elisabeth Maria Mosele', 'MOSELE, Elisabeth Maria', '5892534537233467'),
(60, 'Rosane Rosa', 'ROSA, Rosane', '5511703487828247'),
(61, 'Flavio Meurer', 'MEURER, Flavio', ''),
(62, 'Luzane Ruscher Souto', 'SOUTO, Luzane Ruscher', ''),
(63, 'Elisabath Bretano', 'BRETANO, Elisabath', ''),
(64, 'Cleusa Pavan', 'PAVAN, Cleusa', '7488378115131845'),
(65, 'Elisa Kopplin Ferraretto', 'FERRARETTO, Elisa Kopplin', '8564887430487569'),
(66, 'Samile Andrea de Souza Vanz', 'VANZ, S. A. S.', '5243732207004083'),
(67, 'Marja Pfeifer Coelho', 'COELHO, M. P.', '3614921772781769'),
(68, 'Karina Galdino', 'GALDINO, K.', ''),
(69, 'Juliana Lazzarotto Freitas', 'FREITAS, J. L.', ''),
(70, 'Rene Faustino Gabriel Junior', 'GABRIEL JUNIOR, R. F.', ''),
(71, 'Leilah Santiago Bufrem', 'BUFREM, Leilah Santiago', '1526528881898399'),
(72, 'SORRIBA, Tidra Viana', 'SORRIBA, Tidra Viana', ''),
(73, 'GONÇALVES, Viviane', 'GONÇALVES, V.', ''),
(74, 'Francisco Daniel de Oliveira Costa', 'COSTA, F. D. O.', ''),
(75, 'Jose Simao de Paula Pinto', 'Pinto, José Simão de Paula', ''),
(76, 'Viviane Gonçalves', 'GONÇALVEZ, Viviane', ''),
(77, 'MIGUEL ROMEU AMORIM NETO', 'AMORIM NETO, M. R.', ''),
(78, 'Marcia Heloisa Tavares de Figueredo Lima', 'LIMA, Marcia H. T. de Figueredo', ''),
(79, 'UBIRAJARA CARVALHEIRA COSTA', 'COSTA, U. C.', '9419427817757533'),
(80, 'ASY PEPE SANCHES NETO', 'SANCHES NETO, A. P.', ''),
(81, 'CLAUDIANA ALMEIDA DE SOUZA GOMES', 'GOMES, C. A. S.', '7012501621700279'),
(82, 'Ricardo Perlingeiro Mendes da silva', 'SILVA, R. P. M.', ''),
(83, 'MARA ELIANE FONSECA RODRIGUES', 'RODRIGUES, M. E. F.', '9839629065096253'),
(84, 'MARCIA JAPOR DE OLIVEIRA GARCIA', 'GARCIA, M. J. O.', ''),
(85, 'Esther E. Lindemayer', 'LINDEMAYER, E. E.', ''),
(86, 'Moisés Rockembach', 'ROCKEMBACH, M.;ROCKEMBACH, MOISÉS', '1304688580274983'),
(87, 'Eliane Lourdes da Silva Moro', 'MORO, E. L. S.', '7005124544331261'),
(88, 'Lizandra Brasil Estabel', 'ESTABEL, L. B.', '0733767235814444'),
(89, 'Gabriela Giacumuzzi', 'GIACUMUZZI, G.', ''),
(90, 'Camila Timm', 'TIMM, C.', ''),
(91, 'Camila Schoffen Tressino', 'TRESSINO, C. S.', ''),
(92, 'BEHR, Ariel', 'BEHR, A.', '6735490077837110'),
(93, 'SERAFINI, Loiva Teresinha', 'SERAFINI', ''),
(94, 'KAUP, Uli', 'KAUP, U', ''),
(95, 'Kátia Coutinho', 'COUTINHO, K.', ''),
(96, 'Lucila Maria Costi Santarosa', 'SANTAROSA, L. M. C.', '0796125660056539'),
(97, 'ABREU e SILVA, Fernando Antonio de', 'ABREU E SILVA, F.A. de', ''),
(98, 'Fabiana Dupont', 'Dupont, F.', ''),
(99, 'Iara Conceição Bitencourt Neves', 'NEVES, I. C. B.', ''),
(100, 'Fernando Antonio de Abreu e Silva', 'SILVA, F. A. A. E.', '5110683689695074'),
(101, 'Liane M. R. Tarouco', 'TAROUCO, L. M. R.', '0878410768350416'),
(102, 'Ivete Tazima', 'TAZIMA, I.', ''),
(103, 'Lilia Maria Vargas', 'VARGAS, L. M.', ''),
(104, 'Andrey Vicente Damo', 'DAMO, A. V.', ''),
(105, 'Débora Soares', 'SOARES, D.', ''),
(106, 'Jaqueline W Dias', 'DIAS, J. W.', ''),
(107, 'Mára Lucia F Carneiro', 'CARNEIRO, M. L. F.', ''),
(108, 'Janete Sander Costa', 'COSTA, J. S.', ''),
(109, 'Malcon Hughes', 'HUGHES, Malcon', ''),
(110, 'Juliana Carvalho Pereira', 'PEREIRA, J. C.', ''),
(111, 'Maria do Rocio Fontoura Teixeira', 'TEIXEIRA, M. R. F.', '6975295280564336'),
(112, 'Maria do Carmo Ferreira Mizetti', 'MIZETTI, M. C. F.', ''),
(113, 'Luciana Calabro', 'CALABRO, L.', ''),
(114, 'Diogo Onofre Gomes de Souza', 'SOUZA, D. O.', '9534019126486839'),
(115, 'Rodrigo Silva Caxias de Sousa', 'SOUSA, Rodrigo S. Caxias', '0569672544113959'),
(116, 'BUFREM. Leilah Santiago', 'SANTIAGO, B. L.', ''),
(117, 'NASCIMENTO, Bruna Silva do', 'NASCIMENTO, Bruna S. do', ''),
(118, 'CAREGNATO. Sônia Elisa', 'CAREGNATO. Sônia Elisa', ''),
(119, 'Elisângela da Silva Rodrigues', 'RODRIGUES, E. S.', ''),
(120, 'SANTOS, DAIANE BARRILI DOS', 'SANTOS, DAIANE BARRILI DOS', ''),
(121, 'PAVÃO, CATERINA MARTA GROPOSO', 'PAVÃO, CATERINA MARTA GROPOSO', ''),
(122, 'Ana Maria Mielniczuk de Moura', 'MOURA, ANA MARIA MIELNICZUK DE', ''),
(123, 'Daniela De Filippo', 'FILIPPO, D.', ''),
(124, 'Sonia Elisa Caregnato', 'CAREGNATO, Sonia Elisa', '5627209208288722'),
(125, 'Carlos Garcia-Zorita', 'GARCIA-ZORITA, C.', ''),
(126, 'María Luisa Lascurain Sánchez', 'SANCHEZ, M. L. L.', ''),
(127, 'Elias Sanz-Casado', 'SANZ-CASADO, E.', ''),
(128, 'Regina Dioga Pelissaro', 'PELISSARO, R. D.', ''),
(129, 'Daniela Gralha de Caneda Queiroz', 'QUEIROZ, D. G. C.', ''),
(130, 'Dirce Santin', 'SANTIN, D.', ''),
(131, 'Zizil Arledi Nunez', 'NUNEZ, Z. A.', ''),
(132, 'Veronica Barbosa Scartassini', 'SCARTASSINI, V. B.', ''),
(133, 'Ida Regina Chittó Stumpf', 'STUMPF, I. R. C.', '1358896775044919'),
(134, 'VANZ, Samile Andrea de Souza', 'VANZ, S. A. S.', ''),
(135, 'Rosely Vargas A.', 'VARGAS, R. A.', ''),
(136, 'LAIPELT, Rita Do Carmo Ferreira', 'LAIPELT, R. C. F', ''),
(137, 'Helen Beatriz Frota Rozados', 'ROZADOS, H. B. F.', ''),
(138, 'Jackson da Silva Medeiros', 'MEDEIROS, J. S.', ''),
(139, 'Gisele Vasconcelos Dziekaniak', 'DZIEKANIAK, Gisele Vasconcelos', ''),
(140, 'Rosana Portugal Tavares de Moraes', 'MORAES, Rosana Portugal Tavares de', ''),
(141, 'Clériston Ribeiro Ramos', 'RAMOS, Clériston Ribeiro', ''),
(142, 'Maria Luiza de Almeida Campos', 'CAMPOS, Maria Luiza de Almeida', '9545682339961651'),
(143, 'Linair Maria Campos', 'CAMPOS, Linair Maria', ''),
(144, 'João Borges da Silveira', 'SILVEIRA, João Borges da', ''),
(145, 'Maria Fermina Fortes', 'FORTES, Maria Fermina', ''),
(146, 'Virgínia Borges', 'BORGES, Virgínia', ''),
(147, 'Rafael Port da Rocha', 'ROCHA, R. P.', '5118387541734094'),
(148, 'Silvia Maria Puentes Bentancourt', 'BENTANCOURT, S. M. P.', ''),
(149, 'Lizete Dias de Oliveira', 'OLIVEIRA, L. D.', '0703614684367481'),
(150, 'Yuri Victorino', 'VICTORINO, Y.', ''),
(151, 'Marlise Giovanaz', 'GIOVANAZ, M', ''),
(152, 'Patricia do Nascimento Zilles', 'ZILLES, P. N.', ''),
(153, 'Adriana Gonçalves Xavier', 'XAVIER, Adriana Gonçalves', ''),
(154, 'Ananda Felix Ribeiro', 'RIBEIRO, Ananda Felix', ''),
(155, 'Laís Rosa dos Santos', 'SANTOS, Laís Rosa dos', ''),
(156, 'Regina Helena van der Laan', 'LAAN, Regina Helena Van Der', ''),
(157, 'Grasiela Peccini', 'PECCINI, Grasiela', ''),
(158, 'Luiz Rodrigo Copetti', 'COPETTI, L. R.', ''),
(159, 'Monica Marcuzzo', 'MARCUZZO, Monica', ''),
(160, 'Marcos Cordeiro D´Ornellas', 'D´ORNELLAS, M. C.', ''),
(161, 'SANTIN, DIRCE', 'SANTIN, DIRCE', ''),
(162, 'DE SOUZA VANZ, SAMILE', 'DE SOUZA VANZ, SAMILE', ''),
(163, 'Paula Caroline Schifino Jardim Passos', 'PASSOS, P. C. S. J.', '1766582596876949'),
(164, 'PAVÃO, CATERINA GROPOSO', 'PAVÃO, CATERINA GROPOSO', ''),
(165, 'ROCHA, RAFAEL PORT DA', 'ROCHA, RAFAEL PORT DA', ''),
(166, 'SILVEIRA, MURILO ARTUR ARAÚJO DA', 'SILVEIRA, MURILO ARTUR ARAÚJO DA', ''),
(167, 'BUFREM, LEILAH SANTIAGO', 'BUFREM, LEILAH SANTIAGO', ''),
(168, 'MAIA, MARIA DE FATIMA SANTOS', 'MAIA, MARIA DE FATIMA SANTOS', ''),
(169, 'Ana Gabriela Clipes Ferreira', 'FERREIRA, A. G. C.', '3324667562059112'),
(170, 'Murilo Artur Araújo da Silveira', 'SILVEIRA, M. A. A.', '2565474279842382'),
(171, 'Caterina Marta Groposo Pavão', 'PAVÃO, C. M. G.', '4834791532698069'),
(172, 'Janise Silva Borges da Costa', 'COSTA, J. S. B.', ''),
(173, 'Zaida Horowitz', 'HOROWITZ, Z.', ''),
(174, 'Manuela Klanovicz', 'KLANOVICZ, M.', ''),
(175, 'Maria de Fátima Santos Maia', 'MAIA, M. F. S.', '4428620525281564'),
(176, 'Sônia Regina Zanotto', 'ZANOTTO, S. R.', '2506373356188795'),
(177, 'Cynthia Harumy W Corrêa', 'CORRÊA, C. H. W', '1346087751399245'),
(178, 'Isabel Merlo Crespo', 'CRESPO, I. M.', '4474988728814118'),
(179, 'Martha E. K. Kling Bonotto', 'BONOTTO, M. E. K. K.', ''),
(180, 'Geórgia Geogletti Cordeiro Dantas', 'DANTAS, G. G. C.', '1775635614816378'),
(181, 'Sônia Domingues Santos Brambilla', 'BRAMBILLA, S. D. S.', '3773174158250232'),
(182, 'Rita do Carmo Ferreira Laipelt', 'LAIPELT, R. C. F.', '3995942647359410'),
(183, 'Rosa Maria Apel Mesquita', 'MESQUITA, R. M. A.', '3665724070365235'),
(184, 'Anelise Tolotti Nardino', 'NARDINO, A. T.', ''),
(185, 'Carla Elisabete Cassel Silva', 'SILVA, C. E. C.', '1778441810560949'),
(186, 'Milene Linden da Rocha', 'ROCHA, M. L.', ''),
(187, 'Nigel Ford', 'FORD, N.', ''),
(188, 'Brendan Loughridge', 'LOUGHRIDGE, B.', ''),
(189, 'CAREGNATO, SONIA', 'CAREGNATO, SONIA', ''),
(190, 'Natascha Helena Franz Hoppen', 'HOPPEN, N. H. F.', '1751914917275885'),
(191, 'Carlos Garcia Zorita', 'ZORITA, C. G.', ''),
(192, 'Elias Sans Casado', 'CASADO, E. S.', ''),
(193, 'PEREIRA, PATRÍCIA MALLMANN SOUTO', 'PEREIRA, PATRÍCIA MALLMANN SOUTO', ''),
(194, 'FERREIRA, GLÓRIA ISABEL SATTAMINI', 'FERREIRA, GLÓRIA ISABEL SATTAMINI', ''),
(195, 'MACHADO, GERALDO RIBAS', 'MACHADO, GERALDO RIBAS', ''),
(196, 'Claudia Daniele de Souza', 'SOUZA, C. D.', ''),
(197, 'Caroline Oliveira', 'OLIVEIRA, C.', ''),
(198, 'Stumpf, Ida Regina Chittó', 'Stumpf, Ida Regina Chittó', ''),
(199, 'VARGAS, ROSELY ANDRADE', 'VARGAS, ROSELY ANDRADE', ''),
(200, 'Rosely de Andrade Vargas', 'VARGAS, R. A.', '4068274007946469'),
(201, 'Jaire Ederson Passos', 'PASSOS, J. E.', '0969897025884821'),
(202, 'Costa, Josiane Gonçalves da', 'Costa, Josiane Gonçalves da', '5087123468052825'),
(203, 'Fernando Serra', 'SERRA, F.', '4170407039210695'),
(204, 'Manuel Ferreira', 'FERREIRA, M.', '7033780505958439'),
(205, 'Martinho Almeida', 'ALMEIDA, M.', ''),
(206, 'Carlos Alberto Ávila Araujo', 'ARAUJO, C. A. A.', '4009452150201421'),
(207, 'Angélica Alves da Cunha Marques', 'MARQUES, A. A. C.', '2413567691663920'),
(208, 'Oliveira, Natalia Gastaud de', 'Oliveira, N.G.', ''),
(209, 'Bentancourt, Silvia Puentes', 'Bentancourt, S.P.', ''),
(210, 'Ananda Feix Ribeiro', 'RIBEIRO, A. F.', '2970954484729497'),
(211, 'FRAGA, Carlos André Soares', 'FRAGA, Carlos André Soares', ''),
(212, 'Marialva Machado Weber', 'WEBER, M. M.', ''),
(213, 'Mesquita, Rosa', 'Mesquita, Rosa', ''),
(214, 'Laipelt, Rita do Carmo', 'Laipelt, Rita do Carmo', ''),
(215, 'Caregnato, Sonia Elisa', 'Caregnato, Sonia Elisa', ''),
(216, 'BRAMBILLA, S', 'BRAMBILLA, S', ''),
(217, 'MAIA, F', 'MAIA, F', ''),
(218, 'VANZ, S', 'VANZ, S', '');

-- --------------------------------------------------------

--
-- Table structure for table `programa_pos`
--

CREATE TABLE IF NOT EXISTS `programa_pos` (
`id_ppg` bigint(20) unsigned NOT NULL,
  `ppg_codigo` char(15) NOT NULL,
  `ppg_programa` varchar(80) NOT NULL,
  `ppg_sigla` char(10) NOT NULL,
  `ppg_instituicao` varchar(30) NOT NULL,
  `ppg_area` varchar(30) NOT NULL,
  `ppg_area_avaliacao` int(11) NOT NULL,
  `ppg_tipo` int(11) NOT NULL,
  `ppg_nota_d` int(11) NOT NULL,
  `ppg_nota_m` int(11) NOT NULL,
  `ppg_nota_p` int(11) NOT NULL,
  `ppg_link_sucupira` char(255) NOT NULL,
  `ppg_link` char(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `programa_pos`
--

INSERT INTO `programa_pos` (`id_ppg`, `ppg_codigo`, `ppg_programa`, `ppg_sigla`, `ppg_instituicao`, `ppg_area`, `ppg_area_avaliacao`, `ppg_tipo`, `ppg_nota_d`, `ppg_nota_m`, `ppg_nota_p`, `ppg_link_sucupira`, `ppg_link`) VALUES
(1, '33002010195P5', 'CIÊNCIA DA INFORMAÇÃO', '', 'thesa:1007', 'thesa:1023', 0, 0, 5, 5, 0, '', 'http://www3.eca.usp.br/pos/ppgci'),
(2, '33004110043P4', 'CIÊNCIA DA INFORMAÇÃO', '', 'thesa:1009', 'thesa:1023', 0, 0, 6, 6, 0, '', 'http://www.marilia.unesp.br/#!/pos-graduacao/mestrado-e-doutorado/ciencia-da-informacao');

-- --------------------------------------------------------

--
-- Table structure for table `rdf`
--

CREATE TABLE IF NOT EXISTS `rdf` (
`id_rdf` bigint(20) unsigned NOT NULL,
  `rdf_resource` text NOT NULL,
  `rdf_value` text NOT NULL,
  `rdf_class` char(30) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rdf`
--

INSERT INTO `rdf` (`id_rdf`, `rdf_resource`, `rdf_value`, `rdf_class`) VALUES
(1, 'thesa:1023', 'Ciência da Informação', 'area'),
(2, 'thesa:1030', 'Comunicação', 'area'),
(3, 'thesa:1033', 'Administração', 'area'),
(4, 'thesa:1007', 'Universidade de São Paulo', 'instituicao'),
(5, 'thesa:1009', 'Universidade Estadual Paulista Júlio de Mesquita Filho', 'instituicao');

-- --------------------------------------------------------

--
-- Table structure for table `rdf_prefix`
--

CREATE TABLE IF NOT EXISTS `rdf_prefix` (
`id_prefix` bigint(20) unsigned NOT NULL,
  `prefix_ref` char(30) NOT NULL,
  `prefix_url` char(250) NOT NULL,
  `prefix_ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `rdf_prefix`
--

INSERT INTO `rdf_prefix` (`id_prefix`, `prefix_ref`, `prefix_url`, `prefix_ativo`) VALUES
(1, 'dc', 'http://purl.org/dc/elements/1.1/', 1),
(2, 'brapci', 'http://basessibi.c3sl.ufpr.br/brapci/index.php/rdf/', 1),
(3, 'rdfs', 'http://www.w3.org/2000/01/rdf-schema', 1),
(4, 'skos', 'http://www.w3.org/2004/02/skos/core', 1),
(5, 'dcterm', 'http://purl.org/dc/terms/', 1),
(6, 'fb', 'http://rdf.freebases.com/ns', 1),
(7, 'gn', 'http://www.geonames.org/ontology#', 1),
(8, 'geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#', 1),
(9, 'lotico', 'http://www.lotico.com/ontology/', 1),
(10, 'bibo', 'http://purl.org/ontology/bibo/', 1),
(11, 'ebucore', 'http://www.ebu.ch/metadata/ontologies/ebucore/ebucore#', 1),
(12, 'rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#', 1),
(13, 'ex', 'ex??', 1),
(14, 'skosxl', '', 1),
(15, 'thesa', 'https://www.ufrgs.br/tesauros/index.php/c/', 1),
(16, 'vivoxl', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rdf_resource`
--

CREATE TABLE IF NOT EXISTS `rdf_resource` (
`id_rs` bigint(20) unsigned NOT NULL,
  `rs_prefix` int(11) NOT NULL,
  `rs_propriety` char(100) NOT NULL,
  `rs_propriety_inverse` char(100) NOT NULL,
  `rs_type` text NOT NULL,
  `rs_mandatory` int(11) NOT NULL DEFAULT '0',
  `rs_marc` varchar(30) NOT NULL,
  `rs_group` varchar(10) NOT NULL,
  `rs_public` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `rdf_resource`
--

INSERT INTO `rdf_resource` (`id_rs`, `rs_prefix`, `rs_propriety`, `rs_propriety_inverse`, `rs_type`, `rs_mandatory`, `rs_marc`, `rs_group`, `rs_public`) VALUES
(1, 1, 'title', '', '', 0, '', '', 0),
(2, 1, 'creator', '', '', 0, '', '', 0),
(3, 1, 'subject', '', '', 0, '', '', 0),
(4, 1, 'description', '', '', 0, '', '', 0),
(5, 1, 'publisher', '', '', 0, '', '', 0),
(6, 1, 'contributor', '', '', 0, '', '', 0),
(7, 1, 'date', '', '', 0, '', '', 0),
(8, 1, 'type', '', '', 0, '', '', 0),
(9, 1, 'format', '', '', 0, '', '', 0),
(10, 1, 'identifier', '', '', 0, '', '', 0),
(11, 1, 'source', '', '', 0, '', '', 0),
(12, 1, 'language', '', '', 0, '', '', 0),
(13, 1, 'relation', '', '', 0, '', '', 0),
(14, 1, 'coverage', '', '', 0, '', '', 0),
(15, 1, 'rights', '', '', 0, '', '', 0),
(16, 11, 'filename', '', '', 1, '', '', 0),
(17, 11, 'fileSize', '', '', 1, '', '', 0),
(18, 11, 'dateCreated', '', '', 1, '', '', 0),
(19, 11, 'md5', '', '', 1, '', '', 0),
(20, 11, 'hasMimeType', '', '', 1, '', '', 0),
(21, 11, 'dateModified', '', '', 1, '', '', 0),
(45, 16, 'areaConcentracao', '', '$S80', 0, '', 'AREACONCEN', 0),
(46, 16, 'areaConcentracaoNota', '', '$T80:5', 0, '', 'AREACONCEN', 0),
(47, 16, 'linhaPesquisa1', '', '$S80', 0, '', 'LINHAPESQ1', 0),
(48, 16, 'linhaPesquisa1Nota', '', '$T80:5', 0, '', 'LINHAPESQ1', 0),
(49, 16, 'linhaPesquisa2', '', '$S80', 0, '', 'LINHAPESQ2', 0),
(50, 16, 'linhaPesquisa2Nota', '', '$T80:5', 0, '', 'LINHAPESQ2', 0),
(51, 16, 'linhaPesquisa3', '', '$S80', 0, '', 'LINHAPESQ3', 0),
(52, 16, 'linhaPesquisa3Nota', '', '$T80:5', 0, '', 'LINHAPESQ3', 0),
(53, 16, 'disciplinaPOS', '', '$S80', 0, '', 'DISCIPLINA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rdf_value`
--

CREATE TABLE IF NOT EXISTS `rdf_value` (
`id_rv` bigint(20) unsigned NOT NULL,
  `rv_resource` char(20) NOT NULL,
  `rv_propriety` int(11) NOT NULL,
  `rv_value` text NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `rdf_value`
--

INSERT INTO `rdf_value` (`id_rv`, `rv_resource`, `rv_propriety`, `rv_value`) VALUES
(1, 'ppg:1', 45, 'Cultura e Informação'),
(2, 'ppg:1', 46, 'Trata das relações que caracterizam os processos de construção e/ou re-construção do sentido e/ou do produto cultural quando a informação é transformada em conhecimento e o produto cultural, em bem cultural propondo a observação das ações necessárias, no contexto dos equipamentos culturais, para que a informação possa ser preservada e circular socialmente (coleta, seleção, organização, acesso) e a análise dos contextos culturais dentro dos quais estes processos se realizam e adquirem seu sentido social. A inserção dos estudos de informação no contexto social-cultural pretende fornecer uma leitura particular da introdução da Ciência da Informação no escopo das Ciências Sociais Aplicadas.'),
(3, 'ppg:1', 47, 'Apropriação Social da Informação'),
(4, 'ppg:1', 48, 'Estudo dos processos de apropriação social da informação, considerados em seus aspectos educacionais e culturais e definidos como um dos objetos específicos da Ciência da Informação, a partir de sua compreensão como área de conhecimento transdisciplinar.\r\n\r\nCompreende estudos de base histórico-culturais centrados nas políticas, nas dinâmicas, nos dispositivos e práticas culturais, bem como estudos das relações entre Informação e Educação, sob perspectivas sincrônicas e diacrônicas. Tais trabalhos mobilizam conceitos como apropriação simbólica, ação cultural, saberes informacionais, infoeducação, mediação cultural, protagonismo cultural, dentre outros.\r\n\r\nAs pesquisas que integram a linha distribuem-se em duas frentes complementares, a saber:\r\na) Ação cultural, política cultural, dispositivos culturais, tecnologias de informação e cultura;\r\n\r\nb) infoeducação, abordagem das conexões entre Educação e Informação, tendo em vista a apropriação de saberes informacionais indispensáveis à construção de conhecimentos e à participação afirmativa na cultura da contemporaneidade.'),
(5, 'ppg:1', 49, 'Gestão de Dispositivos de Informação'),
(6, 'ppg:1', 50, 'Estudos teóricos e metodológicos relativos a planejamento, gerenciamento e avaliação de serviços, redes e sistemas de informação. Compreende a análise das variáveis que interferem na gestão dos fluxos que vão da seleção ao uso de recursos informacionais, de modo a garantir a adequação de produtos e serviços às necessidades do usuário em contextos específicos. Compreende também análises e reflexões, do ponto de vista gerencial, das políticas de informação e de comunicação científica e tecnológica, bem como seus principais canais de difusão.\r\n\r\nAs pesquisas que a integram distribuem-se nos seguintes eixos complementares:\r\n\r\na) estudos de modelos de mediações gerenciais em Serviços de Informação, respaldados em teorias e métodos da Administração e da Comunicação, particularmente os estudos de mediação;\r\n\r\nb) estudos de produção e avaliação da comunicação científica e técnica, respaldados em teorias e métodos bibliométricos, cientométricos e infométricos;\r\n\r\nc) estudos de ambientes virtuais de produção, circulação e acesso à informação, com ênfase na compreensão dos processos mediados pelas tecnologias de informação e comunicação;\r\n\r\nd) reflexões histórico-conceituais sobre estudos de usuários, colégios invisíveis, comunidades virtuais e comunidades de prática, incluindo a compreensão dos métodos e procedimentos de análise;\r\n\r\nA contextualização dos estudos permite melhor compreensão das variáveis ambientais, organizacionais, sócio-culturais que interferem nas necessidades de informação do usuário (individual ou coletivo) e na avaliação dos seus critérios de relevância em relação a recursos informacionais e ao apoio à pesquisa e recuperação das informações disponibilizadas. Deste modo, os estudos consideram diferentes dispositivos de informação, virtuais ou presenciais, públicos ou privados, gerais ou especializados e da natureza das informações disponibilizadas para acesso.'),
(7, 'ppg:1', 51, 'Organização da Informação e do Conhecimento'),
(8, 'ppg:1', 52, 'Estudos teóricos e metodológicos relativos à organização do conhecimento e da informação e de sua circulação para fins de acesso, recuperação e uso. Compreende a análise dos objetivos, processos e instrumentos que caracterizam as distintas possibilidades de organização da informação, considerando - se ainda a sua inserção histórica e sócio-cultural e as condições de interação face à diversidade da produção e dos públicos da informação. Compreende, também, abordagens históricas e epistemológicas da organização do conhecimento e da informação.\r\n\r\nAs pesquisas que a integram distribuem-se nos seguintes eixos complementares:\r\n\r\na) teorias e métodos de construção e organização da informação documentária para distintos receptores. Observam-se os aspectos textuais/discursivos dos objetos informacionais e os diferentes modelos de leitura, análise, condensação e representação, incluídos os modelos computacionais.\r\n\r\nb) a construção de linguagens documentárias e outras ferramentas de organização da informação para o acesso, recuperação e uso, observando–se características linguísticas, semióticas, terminológicas e comunicacionais, dos conteúdos documentários e dos grupos receptores, bem como de insumos tecnológicos;\r\n\r\nc) estudos históricos e epistemológicos relativos à organização social do conhecimento e sua relação com as propostas de organização da informação;\r\n\r\nd) análise e proposição de políticas de organização da informação no escopo da sua distribuição e recepção;'),
(9, 'ppg:2', 47, 'Informação e Tecnologia'),
(10, 'ppg:2', 48, 'Realiza pesquisas e estudos teóricos, epistemológicos e práticos relacionados à produção, ao processamento, à representação, ao acesso, à recuperação, à transferência, à visualização, ao design, à arquitetura, à utilização, à gestão e à preservação de dados, informação e de documentos em ambientes digitais, armazenados em espaços ou sistemas informacionais tecnológicos, organizacionais e da sociedade em geral, associados à metodologias, aos instrumentos e ao uso estratégico das Tecnologias de Informação e Comunicação (TIC). Desenvolve metodologias informacionais de interface humano e tecnologias, em diversificados contextos de tipo, forma e natureza da informação. Reflete sobre as questões apresentadas pelos ambientes informacionais digitais para a construção do conhecimento e da experimentação em torno de novas formas de acesso; de organização; de representação, de recuperação; de políticas; e de processamento de dados e de informação para a otimização e a personalização de processos e de sistemas informacionais em distintas ambiências no campo de conhecimento da Ciência da Informação.'),
(11, 'ppg:2', 49, 'Produção e Organização da Informação'),
(12, 'ppg:2', 50, 'Considerando a informação registrada e institucionalizada como insumo básico para a construção do conhecimento no contexto da Ciência da Informação, destaca-se o desenvolvimento de referenciais teóricos e aplicados, de natureza interdisciplinar, acerca da produção e da organização da informação. A produção da informação é abordada sob os eixos da produção científica (avaliação do comportamento da ciência) e da produção documental (Diplomática contemporânea) e a organização da informação é abordada a partir dos processos de análise, síntese, condensação, representação, e recuperação do conteúdo informacional, bem como das competências e comportamentos informacionais do usuário inerentes a tais processos. A dimensão teórica que fundamenta a produção e a organização da informação encontra subsídios na organização do conhecimento (notadamente em suas relações interdisciplinares com a Lógica, a Linguística, a Terminologia, a Semiótica e a Análise de Domínio) e na teoria da ciência, enquanto a dimensão aplicada se efetiva a partir dos estudos métricos (Informetria, Cienciometria, Bibliometria e Webometria), de tipologia documental, dos instrumentos e produtos de organização da informação, e das questões de formação e atuação profissional na área.'),
(13, 'ppg:2', 51, 'Gestão, Mediação e Uso da Informação'),
(14, 'ppg:2', 52, 'A informação e o conhecimento são elementos produzidos socialmente por sujeitos cognoscentes, cujas construções são derivadas do binômio individual-coletivo e podem ser institucionalmente organizados (quando registrados) e potencialmente mediados e apropriados (quando fluem sem o recurso do registro na interação entre os sujeitos). Esses elementos são considerados fenômenos complexos que se manifestam nas relações humanas e em situações cotidianas. Sendo assim, o exame dos processos de gestão, mediação, uso e apropriação da informação e do conhecimento, em vários ambientes, ressalta o papel das pessoas enquanto produtoras ativas de informação e conhecimento. Entende-se também que as culturas, as práticas sociais, as políticas, as instituições, as estruturas organizacionais, os modelos de gestão, os programas de aprendizagem, os suportes e a linguagem influenciam, sobremaneira, as condições do processo de circulação, apropriação da informação e criação de conhecimento. Considera-se como princípio que não há gestão, mediação, uso e apropriação da informação e do conhecimento sem o reconhecimento do papel criativo dos sujeitos (agentes profissionais e usuários). A investigação destes processos exige a capacidade de transcender os limites epistêmicos da Ciência da Informação para compreender as ações de acesso e uso inteligente da informação e de construção do conhecimento na sociedade, recorrendo ao diálogo com outras disciplinas e saberes. Para tanto, a relação intrínseca das pessoas com a informação e o conhecimento deve ser examinada nas vertentes psicológicas, sociológicas, antropológicas, filosóficas, administrativas, culturais, comunicacionais e educacionais. As práticas de informação (criação, busca, socialização, uso e apropriação) requerem escolhas metodológicas inovadoras que sublinhem os aspectos atitudinais dos sujeitos e os pensamentos de uma coletividade expressos em depoimentos, registros e/ou comportamentos. A linha enfoca, sobretudo, os estudos teóricos, metodológicos e aplicados sobre as temáticas: gestão da informação, gestão do conhecimento, aprendizagem organizacional; inteligência empresarial, prospecção e monitoramento informacional; fluxos, processos, usos e usuários da informação; cultura, comportamento e competência em informação; processos de comunicação, mediação, uso e apropriação da informação; práticas de informação e leitura nos diversos espaços informacionais.'),
(15, 'ppg:2', 45, 'Informação, Tecnologia e Conhecimento'),
(16, 'ppg:2', 46, 'A área de concentração "Informação, Tecnologia e Conhecimento" está alicerçada nas questões de organização, gestão,mediação e uso da informação e do papel da tecnologia nos processos informativos e, permite a UNESP, contribuir significativamente para o fortalecimento da pesquisa e da capacitação docente em Ciência da Informação no país, propiciando um trabalho de cooperação e de intercâmbio de informações com os demais cursos de pós-graduação e, principalmente, com a Associação Nacional de Pesquisa e Pós-Graduação em Ciência da Informação (ANCIB) e com a Associação Brasileira de Educação em Ciência da Informação (ABECIN).'),
(17, 'ppg:2', 53, 'Questões Bibliométricas em Produção e Organização da Informação'),
(18, 'ppg:2', 53, 'Questões Métricas em Organização da Informação'),
(19, 'ppg:2', 53, 'Seminários em Ciencia da Informação'),
(20, 'ppg:2', 53, 'Sistema de indización automática para artículos de revista'),
(21, 'ppg:2', 53, 'Sistemas Normalizados nos Arquivos'),
(22, 'ppg:2', 53, 'Tecnologia da Informática Aplicadas a Ciência da Informação'),
(23, 'ppg:2', 53, 'Tecnologias da Informação para a área da saúde'),
(24, 'ppg:2', 53, 'Teorias críticas em organização da informação'),
(25, 'ppg:2', 53, 'Transparência Pública e as Novas Tecnologias da Informação e Comunicação'),
(26, 'ppg:2', 53, 'Web Semântica: conceitos e tecnologias'),
(27, 'ppg:2', 53, 'WEB: trajetória e perspectivas para a Ciência da Informação'),
(28, 'ppg:2', 53, 'Preservação da informação digital'),
(29, 'ppg:2', 53, 'Políticas públicas de informação e tecnologia'),
(30, 'ppg:2', 53, 'Políticas de preservaçao da memória e conhecimento organizacional: interfaces com a gestão do conhecimento'),
(31, 'ppg:2', 53, 'Políticas Públicas de Leitura e Biblioteca Escolar'),
(32, 'ppg:2', 53, 'Política de tratamento da informação documentária em unidades de informação: o contexto sociocognitivo do leitor profissional'),
(33, 'ppg:2', 53, 'Política de indexação da informação'),
(34, 'ppg:2', 53, 'Perspectivas metodológicas para a pesquisa em produção e organização da informação: análise de conteúdo, metateoria e análise de domínio'),
(35, 'ppg:2', 53, 'Os textos literários no tempo e no espaço: perspectivas metodológicas na Análise Documental de Conteúdo'),
(36, 'ppg:2', 53, 'Organização e Representação do Conhecimento: as interfaces entre a linguística documental e a linguagem documental'),
(37, 'ppg:2', 53, 'O comportamento informacional e a sua contribuição para organização do conhecimento'),
(38, 'ppg:2', 53, 'Métodos de Pesquisa Aplicados à Gestão, Mediação e Uso da Informação'),
(39, 'ppg:2', 53, 'Modelos computacionais de recuperação de informação'),
(40, 'ppg:2', 53, 'Metateoria e análise de domínio em organização do conhecimento'),
(41, 'ppg:2', 53, 'Metadados no Domínio Bibliográfico'),
(42, 'ppg:2', 53, 'Metadados e Interoperabilidade'),
(43, 'ppg:2', 53, 'Mediação da informação: usuários, tecnologia e sociedade'),
(44, 'ppg:2', 53, 'Memória e Patrimonio em Unidades de Informação'),
(45, 'ppg:2', 53, 'Linguística documental, terminologia e ontologias: relações dialógicas'),
(46, 'ppg:2', 53, 'Linguagem e discurso em face a organização do conhecimento'),
(47, 'ppg:2', 53, 'Leitura Profissional em Análise Documentária: Observação e Análise de Aspectos Sociocognitivos e Lingüísticos'),
(48, 'ppg:2', 53, 'Informação, conhecimento e inteligência organizacional: tecnologias de informação e comunicação aplicadas nesse contexto'),
(49, 'ppg:2', 53, 'A Ciência da Informação e o Ciclo de Vida dos Dados: Fronteiras de Pesquisa');

-- --------------------------------------------------------

--
-- Table structure for table `researcher`
--

CREATE TABLE IF NOT EXISTS `researcher` (
`id_r` bigint(20) unsigned NOT NULL,
  `r_name` char(250) NOT NULL,
  `r_xml` char(250) NOT NULL,
  `r_lastupdate` date NOT NULL,
  `r_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `r_lattes` char(250) NOT NULL,
  `r_status` int(11) NOT NULL DEFAULT '1',
  `r_harvesting` date NOT NULL,
  `r_lattes_id` char(25) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `researcher`
--

INSERT INTO `researcher` (`id_r`, `r_name`, `r_xml`, `r_lastupdate`, `r_created`, `r_lattes`, `r_status`, `r_harvesting`, `r_lattes_id`) VALUES
(1, 'Rene Faustino Gabriel Junior', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4518324E6', '2016-09-06', '2016-12-27 14:14:37', 'http://lattes.cnpq.br/5900345665779424', 1, '2017-02-02', '3995942647359410'),
(7, 'Valdir José Morigi', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4785542J2', '2017-01-05', '2017-01-17 01:18:32', 'http://lattes.cnpq.br/6542370154854198', 1, '2017-01-19', '6542370154854198'),
(8, 'Rafael Port da Rocha', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4782513D4', '2016-09-15', '2017-01-17 01:21:00', 'http://lattes.cnpq.br/5118387541734094', 1, '2017-01-19', '5118387541734094'),
(4, 'Samile Andréa de Souza Vanz', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4702339P2', '2017-01-11', '2016-12-27 15:40:49', 'http://lattes.cnpq.br/5243732207004083', 1, '2017-01-19', '5243732207004083'),
(5, 'Sonia Elisa Caregnato', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4793334D8', '2017-01-04', '2016-12-27 15:42:14', 'http://lattes.cnpq.br/5627209208288722', 1, '2017-01-19', '5627209208288722'),
(9, 'Ana Maria Mielniczuk de Moura', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4721430J0', '2016-09-22', '2017-01-17 01:22:12', 'http://lattes.cnpq.br/1734997653639992', 1, '2017-01-19', '1734997653639992'),
(10, 'Eliane Lourdes da Silva Moro', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4705611U3', '2016-12-13', '2017-01-17 01:23:12', 'http://lattes.cnpq.br/7005124544331261', 1, '2017-01-19', '7005124544331261'),
(11, 'Jackson da Silva Medeiros', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4233965D6', '2016-12-23', '2017-01-17 01:24:03', 'http://lattes.cnpq.br/4182663628298542', 1, '2017-01-19', '4182663628298542'),
(12, 'Rita do Carmo Ferreira Laipelt', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4137882J9', '2016-09-06', '2017-01-17 01:25:03', 'http://lattes.cnpq.br/3995942647359410', 1, '2017-01-19', '3995942647359410'),
(13, 'Rodrigo Silva Caxias de Sousa', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4774549E5', '2016-12-19', '2017-01-17 01:25:59', 'http://lattes.cnpq.br/0569672544113959', 1, '2017-01-19', '0569672544113959'),
(14, 'Marcia Heloisa Tavares de Figueredo Lima', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4787589U6', '2017-01-13', '2017-01-17 02:29:16', ' http://lattes.cnpq.br/6563330119993372', 1, '2017-01-19', '6563330119993372'),
(15, 'Moisés Rockembach', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4537799H9', '2017-01-14', '2017-01-17 17:09:03', 'http://lattes.cnpq.br/1304688580274983', 1, '2017-01-19', '1304688580274983'),
(16, 'Maria do Rocio Fontoura Teixeira', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4778868D1', '2017-01-09', '2017-01-17 17:12:33', 'http://lattes.cnpq.br/6975295280564336', 1, '2017-01-19', '6975295280564336');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artigo_publicado`
--
ALTER TABLE `artigo_publicado`
 ADD UNIQUE KEY `id_ap` (`id_ap`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
 ADD UNIQUE KEY `id_j` (`id_j`);

--
-- Indexes for table `lt_autores`
--
ALTER TABLE `lt_autores`
 ADD UNIQUE KEY `id_a` (`id_a`);

--
-- Indexes for table `programa_pos`
--
ALTER TABLE `programa_pos`
 ADD UNIQUE KEY `id_ppg` (`id_ppg`);

--
-- Indexes for table `rdf`
--
ALTER TABLE `rdf`
 ADD UNIQUE KEY `id_rdf` (`id_rdf`);

--
-- Indexes for table `rdf_prefix`
--
ALTER TABLE `rdf_prefix`
 ADD UNIQUE KEY `id_prefix` (`id_prefix`);

--
-- Indexes for table `rdf_resource`
--
ALTER TABLE `rdf_resource`
 ADD UNIQUE KEY `id_rs` (`id_rs`);

--
-- Indexes for table `rdf_value`
--
ALTER TABLE `rdf_value`
 ADD UNIQUE KEY `id_rv` (`id_rv`);

--
-- Indexes for table `researcher`
--
ALTER TABLE `researcher`
 ADD UNIQUE KEY `id_r` (`id_r`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artigo_publicado`
--
ALTER TABLE `artigo_publicado`
MODIFY `id_ap` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=327;
--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
MODIFY `id_j` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `lt_autores`
--
ALTER TABLE `lt_autores`
MODIFY `id_a` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=219;
--
-- AUTO_INCREMENT for table `programa_pos`
--
ALTER TABLE `programa_pos`
MODIFY `id_ppg` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rdf`
--
ALTER TABLE `rdf`
MODIFY `id_rdf` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rdf_prefix`
--
ALTER TABLE `rdf_prefix`
MODIFY `id_prefix` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `rdf_resource`
--
ALTER TABLE `rdf_resource`
MODIFY `id_rs` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `rdf_value`
--
ALTER TABLE `rdf_value`
MODIFY `id_rv` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `researcher`
--
ALTER TABLE `researcher`
MODIFY `id_r` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
