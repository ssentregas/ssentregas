/*
Navicat MySQL Data Transfer

Source Server         : AWS - 01
Source Server Version : 50627
Source Host           : jjcs1db0.cvpeqnywkfxy.sa-east-1.rds.amazonaws.com:3306
Source Database       : ssentregas

Target Server Type    : MYSQL
Target Server Version : 50627
File Encoding         : 65001

Date: 2018-06-22 11:36:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `banco`
-- ----------------------------
DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `id_banco` int(8) NOT NULL AUTO_INCREMENT,
  `nu_banco` varchar(3) NOT NULL,
  `nu_agencia` varchar(4) NOT NULL,
  `nu_conta` varchar(10) NOT NULL,
  `nm_banco` varchar(40) NOT NULL,
  `nm_fantasia` varchar(20) NOT NULL,
  `pc_juros` decimal(5,2) NOT NULL DEFAULT '0.00',
  `pc_mora` decimal(5,2) NOT NULL DEFAULT '0.00',
  `qt_dias_protestar` int(2) NOT NULL DEFAULT '0',
  `nu_seq_banco` int(15) NOT NULL DEFAULT '0',
  `id_usuario` int(8) DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_banco`),
  UNIQUE KEY `banco_uk_banco_agencia_conta` (`nu_banco`,`nu_agencia`,`nu_conta`),
  UNIQUE KEY `banco_uk_fantasia` (`nm_fantasia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banco
-- ----------------------------
INSERT INTO `banco` VALUES ('1', '000', '0000', '0000000000', 'CARTEIRA', 'CARTEIRA', '0.00', '0.00', '0', '107', '0', '2013-08-12 10:57:09');
INSERT INTO `banco` VALUES ('2', '341', '1185', '44901-8', 'BANCO ITAU S.A.', 'ITAU', '3.00', '1.00', '7', '196', '0', '2014-03-10 11:51:46');
INSERT INTO `banco` VALUES ('3', '000', '0000', '9999999999', 'MERCADO PAGO', 'MERCADO PAGO', '0.00', '0.00', '0', '10', '0', null);

-- ----------------------------
-- Table structure for `carteira`
-- ----------------------------
DROP TABLE IF EXISTS `carteira`;
CREATE TABLE `carteira` (
  `id_carteira` int(8) NOT NULL AUTO_INCREMENT,
  `ds_carteira` varchar(12) NOT NULL,
  PRIMARY KEY (`id_carteira`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carteira
-- ----------------------------
INSERT INTO `carteira` VALUES ('1', 'CARTEIRA');
INSERT INTO `carteira` VALUES ('2', 'DESCONTO');
INSERT INTO `carteira` VALUES ('3', 'SIMPLES');
INSERT INTO `carteira` VALUES ('4', 'VINCULADA');

-- ----------------------------
-- Table structure for `centro_custo`
-- ----------------------------
DROP TABLE IF EXISTS `centro_custo`;
CREATE TABLE `centro_custo` (
  `id_centro_custo` int(8) NOT NULL AUTO_INCREMENT,
  `ds_centro_custo` varchar(30) DEFAULT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  PRIMARY KEY (`id_centro_custo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of centro_custo
-- ----------------------------
INSERT INTO `centro_custo` VALUES ('1', 'NA', null);
INSERT INTO `centro_custo` VALUES ('2', 'VENDAS - ADP', '1');
INSERT INTO `centro_custo` VALUES ('3', 'MKT - ADP', '1');
INSERT INTO `centro_custo` VALUES ('4', 'MKT - ALFA', '3');

-- ----------------------------
-- Table structure for `cliente`
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(8) NOT NULL AUTO_INCREMENT,
  `nm_cliente` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `rg_ie` varchar(30) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero` varchar(8) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `localidade` varchar(40) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `telefone` varchar(60) DEFAULT NULL,
  `celular` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `id_forma_pagto` int(8) DEFAULT NULL,
  `id_tarifa` int(8) DEFAULT NULL,
  `id_representante` int(8) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT '0.00',
  `observacao` longtext,
  `st_ativo` int(1) DEFAULT '1',
  `dt_inclusao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `nm_usuario` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `FK` (`id_tarifa`)
) ENGINE=MyISAM AUTO_INCREMENT=6807 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES ('4278', 'HOELL DE ASSIS', null, '605.214.907-82', null, null, 'R CRISPIM LARANJEIRA,', null, '100 / 101', 'RECREIO DOS BANDE', 'RIO DE JANEIRO', 'SP', '22790-290', '21-2490-3370', '__-____-____', 'hafdp@hotmail.com', null, null, null, '0.00', 'CRISPIM LARANJEIRA 100 / 101  RECREIO DOS BANDEIRANTES\r\nHOELL\r\n\r\n', '1', null, null);
INSERT INTO `cliente` VALUES ('4279', 'FLAVIO LOPES COELHO', null, '074.977.857-10', null, null, 'AV ALFREDO BALTAZAR DA SILVEIRA', null, '580 LJ LA TABAQUERIA', 'RECREIO', 'RIO DE JANEIRO', 'RJ', null, '21-8333-1992', '__-____-____', 'flcoelho@ig.com.br', null, null, null, '0.00', 'ALFREDO BALTAZAR DA SILVEIRA 580 LOJA LA TABAQUERIA  SETOR ITALIA', '1', null, null);
INSERT INTO `cliente` VALUES ('4280', 'BRUNO HADDAD', null, '063.061.336-23', null, null, 'ALVARO CHAVES ', null, '41', 'LARANJEIRAS', 'RIO DE JANEIRO', 'RJ', null, '21-7983-1756', '__-____-____', 'brunohaddad.foco@gmail.com', null, null, null, '0.00', 'ALVARO CHAVES 41 LARANJEIRAS CLUBE DO FLUMINENSE. BRUNO', '1', null, null);
INSERT INTO `cliente` VALUES ('4281', 'MOBILIARE MOVEIS CORPORATIVOS', null, '10.250.102/0001-19', null, null, 'AV ERASMO BRAGA ', null, '227 / 1012', 'CENTRO', 'RIO DE JANEIRO', 'RJ', null, '21-2215-8550', '11-2534-0522', 'gustavo@movelcorporativo.com.br', null, null, null, '0.00', 'AV ERASMO BRAGA 227 / 1012 - CENTRO\r\n', '1', null, null);
INSERT INTO `cliente` VALUES ('4282', 'CARLO ZARRO', null, '092.240.597-24', null, null, 'VISCONDE DE PIRAJA ', null, '72', 'IPANEMA', 'RIO DE JANEIRO ', 'RJ', null, '21-2247-6660', '__-____-____', 'carlozarro@gmail.com', null, null, null, '0.00', 'VISCONDE DE PIRAJA 72 IPANEMA\r\nCARLO', '1', null, null);
INSERT INTO `cliente` VALUES ('4283', 'CRISTIANE GOULART', null, '029.456.867-08', null, null, 'TUIUTI ', null, '95', 'SAO CRISTOVAO', 'RIO DE JANEIRO', 'RJ', null, '21-2580-5369', '21-3895-9336', 'contato@altasideias.com.br', null, null, null, '0.00', 'TUIUTI 95 SAO CRISTOVAO. CRISTIANE', '1', null, null);
INSERT INTO `cliente` VALUES ('4284', 'SAUDAVEL COMERCIO E DISTRIBUIÇAO DE ALIMENTOS', null, '11.312.880/0001-58', null, null, 'R ASSIS BUENO,', null, '46 / LOJA A ', 'BOTAFOGO', 'RIO DE JANEIRO', 'RJ', '22280-080', '21-3176-1796', '__-____-____', 'thais@saudavelonline.com.br', null, null, null, '0.00', 'ASSIS BUENO 46 LOJA. BOTAFOGO', '1', null, null);

-- ----------------------------
-- Table structure for `credito`
-- ----------------------------
DROP TABLE IF EXISTS `credito`;
CREATE TABLE `credito` (
  `id_credito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `vlr_credito` decimal(8,2) NOT NULL,
  `st_credito` varchar(20) NOT NULL,
  `dt_inclusao` datetime NOT NULL,
  PRIMARY KEY (`id_credito`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of credito
-- ----------------------------
INSERT INTO `credito` VALUES ('2', '6683', '100.00', 'Aguardando', '2016-05-23 20:43:14');
INSERT INTO `credito` VALUES ('3', '6683', '100.00', 'Aguardando', '2016-05-23 20:44:09');
INSERT INTO `credito` VALUES ('4', '6683', '100.00', 'Aguardando', '2016-05-23 20:46:28');
INSERT INTO `credito` VALUES ('5', '6683', '100.00', 'Aguardando', '2016-05-23 20:48:07');
INSERT INTO `credito` VALUES ('6', '6683', '100.00', 'Aguardando', '2016-05-23 22:44:40');
INSERT INTO `credito` VALUES ('7', '6683', '100.00', 'Aguardando', '2016-05-23 22:46:00');
INSERT INTO `credito` VALUES ('8', '6683', '100.00', 'Aguardando', '2016-05-23 22:46:02');
INSERT INTO `credito` VALUES ('9', '6683', '100.00', 'Aguardando', '2016-05-23 22:46:50');
INSERT INTO `credito` VALUES ('10', '6683', '100.00', 'Aguardando', '2016-05-23 22:46:57');
INSERT INTO `credito` VALUES ('11', '6683', '100.00', 'Aguardando', '2016-05-23 22:47:36');
INSERT INTO `credito` VALUES ('12', '6683', '100.00', 'Aguardando', '2016-05-23 22:48:08');
INSERT INTO `credito` VALUES ('13', '6683', '0.00', 'Aguardando', '2016-05-23 22:49:10');
INSERT INTO `credito` VALUES ('14', '6683', '100.00', 'Aguardando', '2016-05-24 20:38:45');
INSERT INTO `credito` VALUES ('15', '6683', '100.00', 'Aguardando', '2016-05-24 20:39:41');
INSERT INTO `credito` VALUES ('16', '6683', '100.00', 'Aguardando', '2016-05-24 20:40:24');
INSERT INTO `credito` VALUES ('17', '6683', '100.00', 'Aguardando', '2016-05-24 20:43:00');
INSERT INTO `credito` VALUES ('18', '6683', '100.00', 'Aguardando', '2016-05-24 20:46:10');
INSERT INTO `credito` VALUES ('19', '6683', '100.00', 'Aguardando', '2016-05-24 20:47:12');
INSERT INTO `credito` VALUES ('20', '6683', '100.00', 'Aguardando', '2016-05-24 20:47:49');
INSERT INTO `credito` VALUES ('21', '6683', '100.00', 'Aguardando', '2016-05-24 20:48:36');
INSERT INTO `credito` VALUES ('22', '6683', '100.00', 'Aguardando', '2016-05-24 20:49:14');
INSERT INTO `credito` VALUES ('23', '6683', '100.00', 'Aguardando', '2016-05-24 20:49:42');
INSERT INTO `credito` VALUES ('24', '6683', '100.00', 'Aguardando', '2016-05-24 20:50:12');
INSERT INTO `credito` VALUES ('25', '6683', '100.00', 'Aguardando', '2016-05-24 20:50:28');
INSERT INTO `credito` VALUES ('26', '6683', '10.00', 'Aguardando', '2016-05-24 20:59:05');
INSERT INTO `credito` VALUES ('27', '6683', '10.00', 'Aguardando', '2016-05-24 20:59:20');
INSERT INTO `credito` VALUES ('28', '6683', '10.00', 'Aguardando', '2016-05-24 21:00:00');
INSERT INTO `credito` VALUES ('29', '6683', '10.00', 'Aguardando', '2016-05-24 21:00:45');
INSERT INTO `credito` VALUES ('30', '6683', '106.00', 'Aguardando', '2016-05-24 21:01:13');
INSERT INTO `credito` VALUES ('31', '6683', '10.00', 'Aguardando', '2016-05-24 21:03:41');
INSERT INTO `credito` VALUES ('32', '6683', '10.00', 'Aguardando', '2016-05-24 21:12:35');
INSERT INTO `credito` VALUES ('33', '6684', '100.00', 'Aguardando', '2016-05-30 10:14:08');
INSERT INTO `credito` VALUES ('34', '6684', '100.00', 'Aguardando', '2016-05-30 10:24:42');
INSERT INTO `credito` VALUES ('35', '6684', '100.00', 'Aguardando', '2016-05-30 10:25:27');
INSERT INTO `credito` VALUES ('36', '6684', '100.00', 'Aguardando', '2016-05-30 17:35:45');
INSERT INTO `credito` VALUES ('37', '6684', '33.00', 'Aguardando', '2016-06-09 14:50:20');
INSERT INTO `credito` VALUES ('38', '6684', '100.00', 'Aguardando', '2016-08-24 10:40:44');
INSERT INTO `credito` VALUES ('39', '6684', '100.00', 'Aguardando', '2016-08-24 10:40:50');
INSERT INTO `credito` VALUES ('40', '6684', '100.00', 'Aguardando', '2016-09-20 15:13:35');
INSERT INTO `credito` VALUES ('41', '6804', '200.00', 'Aguardando', '2017-05-24 17:16:26');
INSERT INTO `credito` VALUES ('42', '6804', '200.00', 'Aguardando', '2017-05-24 17:16:30');
INSERT INTO `credito` VALUES ('43', '6804', '200.00', 'Aguardando', '2017-05-24 17:16:33');
INSERT INTO `credito` VALUES ('44', '6804', '200.00', 'Aguardando', '2017-05-24 17:16:36');
INSERT INTO `credito` VALUES ('45', '6804', '200.00', 'Aguardando', '2017-05-24 17:16:39');

-- ----------------------------
-- Table structure for `destino`
-- ----------------------------
DROP TABLE IF EXISTS `destino`;
CREATE TABLE `destino` (
  `id_destino` int(8) NOT NULL AUTO_INCREMENT,
  `id_chave_monitoria` varchar(30) DEFAULT NULL,
  `ds_destino` varchar(20) NOT NULL,
  `st_ativo` char(1) NOT NULL DEFAULT '0',
  `nu_intervalo_ciclo` decimal(6,1) DEFAULT '10.0',
  `dt_ultimo_ok` datetime DEFAULT NULL,
  `nu_repeticoes_ok` int(8) DEFAULT NULL,
  `dt_ultimo_parado` datetime DEFAULT NULL,
  `nu_repeticoes_parado` int(8) DEFAULT NULL,
  `dt_ultimo_ciclo` datetime DEFAULT NULL,
  `qt_processos` int(4) DEFAULT NULL,
  `nu_total_ok` int(12) NOT NULL,
  `nu_total_parado` int(12) NOT NULL,
  PRIMARY KEY (`id_destino`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of destino
-- ----------------------------
INSERT INTO `destino` VALUES ('1', 'sincroniza_bot', 'Sincroniza ROBOT', '1', '10.0', null, null, null, null, '2017-05-04 03:59:47', '3', '0', '0');
INSERT INTO `destino` VALUES ('2', 'propaga_msg', 'Trata mensagens ', '0', '1.0', null, null, null, null, '2016-08-29 16:11:15', '0', '0', '0');
INSERT INTO `destino` VALUES ('3', 'tarefas_msg', 'Envia msg dos roteir', '0', '1.0', null, null, null, null, '2016-08-29 16:11:16', '0', '0', '0');
INSERT INTO `destino` VALUES ('4', 'calcula_tempo_retorno', 'Calcula os tempos do', '1', '1.0', null, null, null, null, '2017-01-19 03:59:59', '0', '0', '0');
INSERT INTO `destino` VALUES ('5', 'alertas', 'Alertas', '1', '300.0', null, null, null, null, '2017-05-04 03:58:42', '3', '0', '0');

-- ----------------------------
-- Table structure for `entregador`
-- ----------------------------
DROP TABLE IF EXISTS `entregador`;
CREATE TABLE `entregador` (
  `id_entregador` int(8) NOT NULL AUTO_INCREMENT,
  `nm_entregador` varchar(100) DEFAULT NULL,
  `nm_fantasia` varchar(30) NOT NULL,
  `nu_placa` varchar(15) DEFAULT NULL,
  `ds_veiculo` longtext,
  `nu_cpf_cnpj` varchar(18) NOT NULL,
  `tp_cadastro` varchar(8) DEFAULT NULL,
  `nm_logradouro` varchar(100) NOT NULL,
  `nu_logradouro` varchar(20) NOT NULL,
  `nu_complemento` varchar(30) DEFAULT NULL,
  `nm_bairro` varchar(80) NOT NULL,
  `nu_cep` varchar(10) NOT NULL,
  `nm_cidade` varchar(80) NOT NULL,
  `cd_uf` char(2) NOT NULL,
  `nu_telefone` varchar(14) NOT NULL,
  `nm_email` varchar(100) NOT NULL,
  `nu_celular` varchar(14) DEFAULT NULL,
  `nu_fax` varchar(14) DEFAULT NULL,
  `nm_contato` varchar(50) DEFAULT NULL,
  `nu_inscricao` varchar(25) DEFAULT NULL,
  `nu_identidade` varchar(20) DEFAULT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  `st_servico_msg` varchar(1) DEFAULT 'I',
  `tx_servico_msg` varchar(30) DEFAULT NULL,
  `st_entregador` varchar(20) DEFAULT NULL,
  `qt_os_iniciada` int(4) DEFAULT '0',
  `qt_os_pausada` int(4) DEFAULT '0',
  `qt_os_finalizada` int(4) DEFAULT '0',
  `qt_trajeto_mala_iniciado` int(4) DEFAULT '0',
  `qt_trajeto_mala_finalizado` int(4) DEFAULT '0',
  `previsao_retorno` datetime DEFAULT NULL,
  `id_trajeto_atual` int(8) DEFAULT NULL,
  `qt_trajeto_aguardando` int(4) DEFAULT '0',
  `previsao_trajeto` datetime DEFAULT NULL,
  `distancia_trajeto` decimal(8,1) DEFAULT NULL,
  `distancia_total` decimal(8,1) DEFAULT NULL,
  `hr_inicio_almoco` datetime DEFAULT NULL,
  `hr_fim_almoco` datetime DEFAULT NULL,
  `hr_inicio_expediente` datetime DEFAULT NULL,
  `hr_fim_expediente` datetime DEFAULT NULL,
  `hr_expediente` datetime DEFAULT NULL,
  `cp_controle` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id_entregador`),
  UNIQUE KEY `FANTASIA` (`nm_fantasia`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entregador
-- ----------------------------
INSERT INTO `entregador` VALUES ('1', 'LEANDRO', 'LEANDRO', null, null, '', null, '', '', null, '', '', '', '', '', '', null, null, null, null, null, null, null, 'A', 'SEM NR.CELULAR', 'BASE', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0', null, null, null, null, '2016-11-29 08:00:00', null);
INSERT INTO `entregador` VALUES ('7', 'CLAUDIO', 'CLAUDIO', null, null, '', null, '', '', null, '', '', '', '', '', '', null, null, null, null, null, 'Admin', null, 'A', 'SEM NR.CELULAR', 'FALTOU', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0', null, null, null, null, '2016-11-29 08:00:00', null);
INSERT INTO `entregador` VALUES ('12', 'JEMERSON MARQUES ', 'JEMERSON', null, null, '', null, '', '', null, '', '', '', '', '', '', null, null, null, null, null, 'Admin', null, 'A', 'SEM NR.CELULAR', 'BASE', '0', '0', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0', null, null, null, null, '2016-11-29 08:00:00', null);

-- ----------------------------
-- Table structure for `entregador_msg`
-- ----------------------------
DROP TABLE IF EXISTS `entregador_msg`;
CREATE TABLE `entregador_msg` (
  `id_entregador_msg` int(8) NOT NULL AUTO_INCREMENT,
  `id_entregador` int(8) DEFAULT NULL,
  `id_roteiro` int(8) DEFAULT NULL,
  `id_origem` int(8) DEFAULT NULL,
  `id_destino` int(8) DEFAULT NULL,
  `cd_origem` varchar(1) DEFAULT NULL,
  `ds_mensagem` longtext,
  `dt_inclusao` datetime DEFAULT NULL,
  `st_processado` varchar(20) DEFAULT 'Não processado',
  `tx_processado` longtext,
  `nm_origem` varchar(30) DEFAULT NULL,
  `nm_destino` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_entregador_msg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of entregador_msg
-- ----------------------------

-- ----------------------------
-- Table structure for `entregador_tmp`
-- ----------------------------
DROP TABLE IF EXISTS `entregador_tmp`;
CREATE TABLE `entregador_tmp` (
  `id_entregador` int(8) NOT NULL,
  `qt_os_iniciada` int(4) NOT NULL DEFAULT '0',
  `qt_os_pausada` int(4) NOT NULL DEFAULT '0',
  `qt_os_finalizada` int(4) NOT NULL DEFAULT '0',
  `previsao_retorno` datetime NOT NULL,
  `id_trajeto_atual` int(8) NOT NULL,
  `qt_trajeto_aguardando` int(4) NOT NULL DEFAULT '0',
  `qt_trajeto_mala_iniciado` int(4) NOT NULL DEFAULT '0',
  `qt_trajeto_mala_finalizado` int(4) NOT NULL DEFAULT '0',
  `previsao_trajeto` datetime NOT NULL,
  `distancia_trajeto` decimal(8,1) NOT NULL DEFAULT '0.0',
  `distancia_total` decimal(8,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`id_entregador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entregador_tmp
-- ----------------------------
INSERT INTO `entregador_tmp` VALUES ('1', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0');
INSERT INTO `entregador_tmp` VALUES ('7', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0');
INSERT INTO `entregador_tmp` VALUES ('12', '0', '0', '0', '0000-00-00 00:00:00', '0', '0', '0', '0', '0000-00-00 00:00:00', '0.0', '0.0');

-- ----------------------------
-- Table structure for `forma_pagto`
-- ----------------------------
DROP TABLE IF EXISTS `forma_pagto`;
CREATE TABLE `forma_pagto` (
  `id_forma_pagto` int(8) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_forma_pagto`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forma_pagto
-- ----------------------------
INSERT INTO `forma_pagto` VALUES ('1', 'FATURADO');
INSERT INTO `forma_pagto` VALUES ('2', 'PRE-PAGO');
INSERT INTO `forma_pagto` VALUES ('3', 'A VISTA');
INSERT INTO `forma_pagto` VALUES ('6', 'DEPÓSITO');

-- ----------------------------
-- Table structure for `funcao`
-- ----------------------------
DROP TABLE IF EXISTS `funcao`;
CREATE TABLE `funcao` (
  `id_funcao` int(8) NOT NULL AUTO_INCREMENT,
  `ds_funcao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_funcao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of funcao
-- ----------------------------
INSERT INTO `funcao` VALUES ('1', 'GERENTE GERAL');
INSERT INTO `funcao` VALUES ('2', 'AUXILIAR DE VENDA');
INSERT INTO `funcao` VALUES ('3', 'AUXILAR DE RH');
INSERT INTO `funcao` VALUES ('4', 'AUXILIAR ADM');
INSERT INTO `funcao` VALUES ('5', 'OUTROS');

-- ----------------------------
-- Table structure for `local_cliente`
-- ----------------------------
DROP TABLE IF EXISTS `local_cliente`;
CREATE TABLE `local_cliente` (
  `id_local_cliente` int(8) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(8) DEFAULT NULL,
  `cep_local_cliente` varchar(10) DEFAULT NULL,
  `endereco_local_cliente` varchar(200) DEFAULT NULL,
  `numero_local_cliente` int(6) DEFAULT NULL,
  `complemento_local_cliente` varchar(100) DEFAULT NULL,
  `bairro_local_cliente` varchar(30) DEFAULT NULL,
  `cidade_local_cliente` varchar(60) DEFAULT NULL,
  `uf_local_cliente` varchar(2) DEFAULT NULL,
  `latitude_local_cliente` decimal(20,16) DEFAULT NULL,
  `longitude_local_cliente` decimal(20,16) DEFAULT NULL,
  `cp_completo` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_local_cliente`),
  KEY `completo` (`cp_completo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of local_cliente
-- ----------------------------
INSERT INTO `local_cliente` VALUES ('1', '4230', '20930450', 'Rua do Bonfim', '363', '301', 'São Cristóvão', 'Rio de Janeiro', 'RJ', null, null, 'Rua do Bonfim, 363, 301 - São Cristóvão - Rio de Janeiro - RJ - 20930450 - Brasil ');
INSERT INTO `local_cliente` VALUES ('2', '4230', '22640320', 'Ilha dos Pescadores', '10', '', 'Barra da Tijuca', 'Rio de Janeiro', 'RJ', null, null, 'Ilha dos Pescadores, 10,  - Barra da Tijuca - Rio de Janeiro - RJ - 22640320 - Brasil ');
INSERT INTO `local_cliente` VALUES ('3', '4230', '22630220', 'Rua São Regulo', '30', '', 'Barra da Tijuca', 'Rio de Janeiro', 'RJ', null, null, 'Rua São Regulo, 30,  - Barra da Tijuca - Rio de Janeiro - RJ - 22630220 - Brasil ');

-- ----------------------------
-- Table structure for `local_padrao`
-- ----------------------------
DROP TABLE IF EXISTS `local_padrao`;
CREATE TABLE `local_padrao` (
  `id_local_padrao` int(8) NOT NULL AUTO_INCREMENT,
  `ds_local_padrao` varchar(60) DEFAULT NULL,
  `ds_endereco_completo` varchar(100) DEFAULT NULL,
  `latitude_local_padrao` decimal(20,16) DEFAULT NULL,
  `longitude_local_padrao` decimal(20,16) DEFAULT NULL,
  PRIMARY KEY (`id_local_padrao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of local_padrao
-- ----------------------------
INSERT INTO `local_padrao` VALUES ('1', 'SÃO CRISTOVÃO', 'R. do Bonfim, 363 - São Cristóvão, Rio de Janeiro - RJ, 20930-450, Brasil', null, null);
INSERT INTO `local_padrao` VALUES ('2', 'FILIAL BARA', null, null, null);
INSERT INTO `local_padrao` VALUES ('4', 'EM TRANSITO', null, null, null);
INSERT INTO `local_padrao` VALUES ('5', 'CASA', null, null, null);

-- ----------------------------
-- Table structure for `notificacao`
-- ----------------------------
DROP TABLE IF EXISTS `notificacao`;
CREATE TABLE `notificacao` (
  `id_notificacao` int(11) NOT NULL AUTO_INCREMENT,
  `ds_titulo` varchar(45) NOT NULL,
  `tx_descricao` longtext NOT NULL,
  `ds_link` varchar(100) DEFAULT NULL,
  `id_ordem_serv` int(8) DEFAULT NULL,
  `id_entregador` int(8) DEFAULT NULL,
  `dt_visualizado` datetime DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notificacao`)
) ENGINE=InnoDB AUTO_INCREMENT=54570 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notificacao
-- ----------------------------
INSERT INTO `notificacao` VALUES ('14613', 'ALERTA DE ATRASO EXPEDIENTE', 'Entregador: LEANDRO.', 'entregador.php', null, '1', '2017-01-17 12:02:33', '2017-01-17 11:55:19');
INSERT INTO `notificacao` VALUES ('14614', 'ALERTA DE ATRASO EXPEDIENTE', 'Entregador: FRANKLIN.', 'entregador.php', null, '2', '2017-01-17 12:02:33', '2017-01-17 11:55:19');
INSERT INTO `notificacao` VALUES ('14615', 'ALERTA DE ATRASO EXPEDIENTE', 'Entregador: CLAUDIO.', 'entregador.php', null, '7', '2017-01-17 12:02:33', '2017-01-17 11:55:19');
INSERT INTO `notificacao` VALUES ('14616', 'ALERTA DE ATRASO EXPEDIENTE', 'Entregador: JEMERSON MARQUES .', 'entregador.php', null, '12', '2017-01-17 12:02:33', '2017-01-17 11:55:19');

-- ----------------------------
-- Table structure for `ordem_serv`
-- ----------------------------
DROP TABLE IF EXISTS `ordem_serv`;
CREATE TABLE `ordem_serv` (
  `id_ordem_serv` int(8) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(8) DEFAULT NULL,
  `nu_ordem_serv` varchar(13) DEFAULT NULL,
  `nm_solicitante` varchar(45) DEFAULT NULL,
  `id_tarifa` int(8) DEFAULT NULL,
  `id_pagador` int(8) DEFAULT NULL,
  `id_forma_pagto` int(8) DEFAULT NULL,
  `ds_forma_pagto` varchar(250) DEFAULT '',
  `id_centro_custo` int(8) DEFAULT NULL,
  `observacao` longtext,
  `id_partida_padrao` int(8) DEFAULT NULL,
  `id_retorno_padrao` int(8) DEFAULT NULL,
  `dt_inicio` datetime DEFAULT NULL,
  `dt_inicio_retorno` datetime DEFAULT NULL,
  `dt_termino` datetime DEFAULT NULL,
  `id_entregador` int(8) DEFAULT NULL,
  `dt_agendado` date DEFAULT NULL,
  `hr_agendado` time DEFAULT NULL,
  `nu_distancia_total` int(8) NOT NULL DEFAULT '0',
  `nu_duracao_total` int(8) NOT NULL DEFAULT '0',
  `vlr_os_previsto` int(8) DEFAULT '0',
  `vlr_os_final` decimal(8,2) DEFAULT NULL,
  `vlr_adiant_entregador` decimal(8,2) DEFAULT '0.00',
  `vlr_despesas` decimal(8,2) DEFAULT '0.00',
  `vlr_recebido_entregador` decimal(8,2) DEFAULT '0.00',
  `dt_inclusao` datetime DEFAULT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `st_os` varchar(20) DEFAULT 'AGUARDANDO',
  `st_pagamento` varchar(20) DEFAULT 'AGUARDANDO',
  `dt_ult_mov` datetime DEFAULT NULL,
  `nu_duracao` int(8) NOT NULL DEFAULT '0',
  `nu_distancia` decimal(8,1) NOT NULL DEFAULT '0.0',
  `id_tipo_pagto` int(8) DEFAULT NULL,
  `vl_troco` decimal(8,2) DEFAULT NULL,
  `pos_ord` int(2) DEFAULT '2',
  `nu_total_min_espera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ordem_serv`)
) ENGINE=InnoDB AUTO_INCREMENT=615 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordem_serv
-- ----------------------------
INSERT INTO `ordem_serv` VALUES ('600', '5361', '170117-021458', 'a propria', '3', null, '3', '', '0', '', null, null, '2017-01-17 12:20:22', '2017-01-17 12:37:54', '2017-01-17 12:40:46', '12', '2017-01-17', '00:00:00', '0', '0', '59', '59.00', '0.00', '0.00', '0.00', '2017-01-17 12:20:21', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 12:40:46', '1886', '13.6', '1', '0.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('601', '4997', '170117-022129', 'israel', '3', null, '1', '', '0', 'coletar com israel ', null, null, '2017-01-17 12:23:58', '2017-01-17 14:03:50', '2017-01-17 14:04:55', '1', '2017-01-17', '00:00:00', '0', '0', '74', '74.00', '0.00', '0.00', '0.00', '2017-01-17 12:23:57', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 14:04:55', '1359', '11.6', null, null, '8', '43');
INSERT INTO `ordem_serv` VALUES ('602', '4520', '170117-022715', 'A PROPRIA', '3', null, '3', '', '0', '', null, null, '2017-01-17 12:30:32', '2017-01-17 13:24:28', '2017-01-17 13:29:26', '12', '2017-01-17', '00:00:00', '0', '0', '46', '50.00', '0.00', '0.00', '0.00', '2017-01-17 12:30:31', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 13:29:26', '1973', '8.4', '1', '0.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('603', '6746', '170117-025543', 'MARCIA', '3', null, '3', '', null, null, null, null, '2017-01-17 13:29:44', '2017-01-17 14:47:10', '2017-01-17 14:48:03', '12', '2017-01-17', '00:00:00', '0', '0', '45', '45.00', '0.00', '0.00', '0.00', '2017-01-17 12:59:15', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 14:48:03', '1665', '12.0', '1', '5.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('604', '5923', '170117-040531', 'fabio', '3', null, '1', '', '0', 'coletar na portaria', null, null, '2017-01-17 14:09:22', '2017-01-17 15:32:22', '2017-01-17 15:43:28', '1', '2017-01-17', '00:00:00', '0', '0', '37', '37.00', '0.00', '0.00', '0.00', '2017-01-17 14:09:21', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 15:43:28', '1259', '8.3', null, null, '8', '0');
INSERT INTO `ordem_serv` VALUES ('605', '4997', '170117-051005', 'feliciano', '3', null, '1', '', '0', 'nota 3554', null, null, '2017-01-17 15:17:55', '2017-01-17 16:47:33', '2017-01-17 16:47:46', '12', '2017-01-17', '00:00:00', '0', '0', '87', '87.00', '0.00', '0.00', '0.00', '2017-01-17 15:17:54', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 16:47:46', '3566', '42.7', null, null, '8', '0');
INSERT INTO `ordem_serv` VALUES ('606', '6773', '170117-053521', 'MAYARA', '3', null, '3', '', null, null, null, null, '2017-01-17 15:40:34', '2017-01-17 17:17:47', '2017-01-17 17:18:22', '1', '2017-01-17', '00:00:00', '0', '0', '80', '45.00', '0.00', '0.00', '0.00', '2017-01-17 15:40:32', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-17 17:18:22', '2301', '24.5', '1', '0.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('607', '5780', '170117-060706', 'CARLOS', '3', null, '1', '', '0', '', null, null, null, null, '2017-01-17 16:51:44', '12', '2017-01-17', '00:00:00', '0', '0', '55', '55.00', '0.00', '0.00', '0.00', '2017-01-17 16:09:30', 'Admin', 'CANCELADO', 'AGUARDANDO', '2017-01-17 16:51:44', '1490', '7.9', null, null, '9', '0');
INSERT INTO `ordem_serv` VALUES ('608', '6802', '170117-064449', 'O PROPRIO', '3', null, '3', '', '0', '', null, null, '2017-01-17 16:48:17', '2017-01-17 18:49:37', '2017-01-18 08:19:20', '12', '2017-01-17', '00:00:00', '0', '0', '45', '45.00', '0.00', '0.00', '0.00', '2017-01-17 16:46:58', 'Admin', 'FINALIZADO', 'RECEBIDO', '2017-01-18 08:32:36', '2535', '25.4', '1', '0.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('609', '5034', '170118-101220', 'vanessa', '3', null, '1', '', '0', '', null, null, '2017-01-18 09:31:52', '2017-01-18 13:13:02', '2017-01-18 13:23:23', '12', '2017-01-18', '09:25:00', '0', '0', '134', '134.00', '0.00', '0.00', '0.00', '2017-01-18 08:17:55', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-18 13:23:23', '1718', '12.3', null, null, '8', '30');
INSERT INTO `ordem_serv` VALUES ('610', '5002', '170118-121533', 'FABIOLA', '3', null, '1', '', '0', '3083-7112', null, null, '2017-01-18 10:19:43', '2017-01-18 11:36:05', '2017-01-18 11:36:44', '1', '2017-01-18', '00:00:00', '0', '0', '74', '74.00', '0.00', '0.00', '0.00', '2017-01-18 10:19:41', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-18 11:36:44', '807', '5.2', null, null, '8', '0');
INSERT INTO `ordem_serv` VALUES ('611', '6258', '170118-125614', 'CRISTIANE', '3', null, '3', '', null, '97017-5033', null, null, '2017-01-18 11:37:09', '2017-01-18 13:23:54', '2017-01-18 13:24:14', '1', '2017-01-18', '00:00:00', '0', '0', '60', '65.00', '0.00', '0.00', '0.00', '2017-01-18 11:05:17', 'Admin', 'FINALIZADO', 'AGUARDANDO', '2017-01-18 13:24:14', '2622', '18.5', '1', '5.00', '8', '0');
INSERT INTO `ordem_serv` VALUES ('612', '5923', '170118-011917', 'FABIO', '3', null, '1', '', null, 'NA VILHENA DE MORASI ENTREGAR AO MARCELO MAIA BL 1 APTO 105\r\n\r\nNO CENTRO FALAR QUE FOI PEGAR O DOCUMENTO DO M ARCELO MAIA', null, null, null, null, '2017-01-18 13:25:40', '1', '2017-01-18', '00:00:00', '0', '0', '50', '50.00', '0.00', '0.00', '0.00', '2017-01-18 11:25:05', 'Admin', 'CANCELADO', 'AGUARDANDO', '2017-01-18 13:25:40', '2730', '27.7', null, null, '9', '0');
INSERT INTO `ordem_serv` VALUES ('613', '6696', '170118-015207', 'RAQUEL', '3', null, '1', '', '0', '2230-6549', null, null, null, null, '2017-01-18 13:25:23', '1', '2017-01-18', '00:00:00', '0', '0', '30', '128.00', '0.00', '0.00', '0.00', '2017-01-18 12:02:33', 'Admin', 'CANCELADO', 'AGUARDANDO', '2017-01-18 13:25:23', '1196', '9.0', null, null, '9', '0');
INSERT INTO `ordem_serv` VALUES ('614', '6773', '170118-022122', 'MAYARA', '3', null, '3', '', '0', '', null, null, null, null, '2017-01-18 13:25:01', '12', '2017-01-18', '00:00:00', '0', '0', '45', '45.00', '0.00', '0.00', '0.00', '2017-01-18 12:24:53', 'Admin', 'CANCELADO', 'AGUARDANDO', '2017-01-18 13:25:01', '2301', '24.5', '1', '0.00', '9', '0');

-- ----------------------------
-- Table structure for `phpgen_users`
-- ----------------------------
DROP TABLE IF EXISTS `phpgen_users`;
CREATE TABLE `phpgen_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(500) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phpgen_users
-- ----------------------------
INSERT INTO `phpgen_users` VALUES ('0', 'jjc', 'master10');

-- ----------------------------
-- Table structure for `promocao`
-- ----------------------------
DROP TABLE IF EXISTS `promocao`;
CREATE TABLE `promocao` (
  `id_promocao` int(8) NOT NULL AUTO_INCREMENT,
  `ds_origem` varchar(60) NOT NULL,
  `ds_destino` varchar(60) NOT NULL,
  `vl_promocao` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_promocao`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promocao
-- ----------------------------
INSERT INTO `promocao` VALUES ('1', 'Barra da Tijuca, Rio de Janeiro', 'Recreio dos Bandeirantes, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('2', 'Barra da Tijuca, Rio de Janeiro', 'Jacarepagua, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('3', 'Barra da Tijuca, Rio de Janeiro', 'Gávea, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('4', 'Barra da Tijuca, Rio de Janeiro', 'Leblon, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('5', 'Barra da Tijuca, Rio de Janeiro', 'São Conrado, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('6', 'Barra da Tijuca, Rio de Janeiro', 'Rocinha, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('7', 'Barra da Tijuca, Rio de Janeiro', 'Ipanema, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('8', 'Barra da Tijuca, Rio de Janeiro', 'Copacabana, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('9', 'Barra da Tijuca, Rio de Janeiro', 'Jardim Botânico, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('10', 'Barra da Tijuca, Rio de Janeiro', 'Humaitá, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('11', 'Barra da Tijuca, Rio de Janeiro', 'Botafogo, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('12', 'Barra da Tijuca, Rio de Janeiro', 'Catete, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('13', 'Barra da Tijuca, Rio de Janeiro', 'Laranjeiras, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('14', 'Barra da Tijuca, Rio de Janeiro', 'Urca, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('15', 'Barra da Tijuca, Rio de Janeiro', 'Flamengo, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('16', 'Barra da Tijuca, Rio de Janeiro', 'Cosme Velho, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('17', 'Barra da Tijuca, Rio de Janeiro', 'Leme, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('18', 'Barra da Tijuca, Rio de Janeiro', 'Vidigal, Rio de Janeiro', '40.00');
INSERT INTO `promocao` VALUES ('19', 'Barra da Tijuca, Rio de Janeiro', 'Lagoa, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('20', 'Barra da Tijuca, Rio de Janeiro', 'Centro, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('21', 'Barra da Tijuca, Rio de Janeiro', 'Glória, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('22', 'Barra da Tijuca, Rio de Janeiro', 'Santa Teresa, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('23', 'Barra da Tijuca, Rio de Janeiro', 'Lapa, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('24', 'Barra da Tijuca, Rio de Janeiro', 'São Cristóvão, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('25', 'Barra da Tijuca, Rio de Janeiro', 'Rio Comprido, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('26', 'Barra da Tijuca, Rio de Janeiro', 'Alto da Boa Vista, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('27', 'Barra da Tijuca, Rio de Janeiro', 'Benfica, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('28', 'Barra da Tijuca, Rio de Janeiro', 'Catumbi, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('29', 'Barra da Tijuca, Rio de Janeiro', 'Gambôa, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('30', 'Barra da Tijuca, Rio de Janeiro', 'Santo Cristo, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('31', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Centro, Rio de Janeiro', '59.00');
INSERT INTO `promocao` VALUES ('32', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Jacarepagua, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('33', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Gávea, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('34', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Leblon, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('35', 'Recreio dos Bandeirantes, Rio de Janeiro', 'São Conrado, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('36', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Rocinha, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('37', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Ipanema, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('38', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Copacabana, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('39', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Jardim Botânico, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('40', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Humaitá, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('41', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Botafogo, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('42', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Catete, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('43', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Laranjeiras, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('44', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Urca, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('45', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Flamengo, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('46', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Cosme Velho, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('47', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Leme, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('48', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Vidigal, Rio de Janeiro', '45.00');
INSERT INTO `promocao` VALUES ('50', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Glória, Rio de Janeiro', '55.00');
INSERT INTO `promocao` VALUES ('51', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Santa Teresa, Rio de Janeiro', '59.00');
INSERT INTO `promocao` VALUES ('52', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Lapa, Rio de Janeiro', '55.00');
INSERT INTO `promocao` VALUES ('53', 'Recreio dos Bandeirantes, Rio de Janeiro', 'São Cristóvão, Rio de Janeiro', '60.00');
INSERT INTO `promocao` VALUES ('54', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Rio Comprido, Rio de Janeiro', '60.00');
INSERT INTO `promocao` VALUES ('55', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Tijuca, Rio de Janeiro', '60.00');
INSERT INTO `promocao` VALUES ('56', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Alto da Boa Vista, Rio de Janeiro', '50.00');
INSERT INTO `promocao` VALUES ('57', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Benfica, Rio de Janeiro', '60.00');
INSERT INTO `promocao` VALUES ('58', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Catumbi, Rio de Janeiro', '55.00');
INSERT INTO `promocao` VALUES ('59', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Gambôa, Rio de Janeiro', '59.00');
INSERT INTO `promocao` VALUES ('60', 'Recreio dos Bandeirantes, Rio de Janeiro', 'Santo Cristo, Rio de Janeiro', '59.00');

-- ----------------------------
-- Table structure for `recebimento`
-- ----------------------------
DROP TABLE IF EXISTS `recebimento`;
CREATE TABLE `recebimento` (
  `id_recebimento` int(8) NOT NULL AUTO_INCREMENT,
  `id_ordem_serv` int(8) DEFAULT NULL,
  `dt_emissao` date DEFAULT NULL,
  `nu_recebimento` varchar(30) DEFAULT NULL,
  `id_cliente` int(8) DEFAULT NULL,
  `id_representante` int(8) DEFAULT NULL,
  `id_carteira` int(8) DEFAULT NULL,
  `id_banco` int(8) DEFAULT NULL,
  `nu_seq_banco` varchar(15) DEFAULT NULL,
  `dt_vencimento` date DEFAULT NULL,
  `vl_receber` decimal(10,2) DEFAULT NULL,
  `vl_avulsos` decimal(10,2) DEFAULT NULL,
  `st_situacao` char(1) DEFAULT 'A',
  `dt_pagamento` date DEFAULT NULL,
  `vl_recebido` decimal(10,2) DEFAULT NULL,
  `vl_desconto` decimal(10,2) DEFAULT NULL,
  `vl_juros` decimal(10,2) DEFAULT NULL,
  `nu_nota_fiscal` varchar(8) DEFAULT NULL,
  `dt_envio_nfe` datetime DEFAULT NULL,
  `tx_observacao` longtext,
  `dt_inclusao` datetime DEFAULT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_recebimento`),
  KEY `recebimento_fk_cliente` (`id_cliente`),
  KEY `recebimento_fk_representante` (`id_representante`),
  KEY `recebimento_fk_carteira` (`id_carteira`),
  KEY `recebimento_fk_banco` (`id_banco`),
  KEY `recebimento_ix_01` (`dt_emissao`,`id_cliente`) USING BTREE,
  KEY `recebimento_ix_02` (`dt_vencimento`,`id_cliente`) USING BTREE,
  KEY `recebimento_ix_03` (`dt_pagamento`,`id_cliente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recebimento
-- ----------------------------

-- ----------------------------
-- Table structure for `representante`
-- ----------------------------
DROP TABLE IF EXISTS `representante`;
CREATE TABLE `representante` (
  `id_representante` int(8) NOT NULL AUTO_INCREMENT,
  `nu_cpf_cnpj` varchar(18) NOT NULL,
  `nm_representante` varchar(150) NOT NULL,
  `nm_fantasia` varchar(30) NOT NULL,
  `tp_cadastro` varchar(8) NOT NULL,
  `nm_logradouro` varchar(100) NOT NULL,
  `nu_logradouro` varchar(20) NOT NULL,
  `nu_complemento` varchar(30) DEFAULT NULL,
  `nm_bairro` varchar(80) NOT NULL,
  `nu_cep` varchar(10) NOT NULL,
  `nm_cidade` varchar(80) NOT NULL,
  `cd_uf` char(2) NOT NULL,
  `nu_telefone` varchar(14) NOT NULL,
  `nm_email` varchar(100) NOT NULL,
  `nu_celular` varchar(14) DEFAULT NULL,
  `nu_fax` varchar(14) DEFAULT NULL,
  `nm_contato` varchar(50) DEFAULT NULL,
  `nu_inscricao` varchar(25) DEFAULT NULL,
  `nu_identidade` varchar(20) DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_representante`),
  UNIQUE KEY `representante_uk_nm_representante` (`nm_representante`) USING BTREE,
  UNIQUE KEY `representante_uk_nu_cpf_cnpj` (`nu_cpf_cnpj`) USING BTREE,
  UNIQUE KEY `representante_uk_nm_fantasia` (`nm_fantasia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of representante
-- ----------------------------
INSERT INTO `representante` VALUES ('1', '18084537000142', 'SS entregas', 'Principal', 'JURÍDICA', 'Av Luis Carlos Prestes', '350', 'Sala 315', 'Barra da Tijuca', '22640102', 'Rio de Janeiro', 'RJ', '2120252515', 'administrativo@consultabem.com.br', '2131774177', '', 'Raphael', '0578069-1', '', '2015-05-28 14:30:39', null);
INSERT INTO `representante` VALUES ('2', '12610589760', 'Eduardo Teixeira', 'Eduardo', 'FÍSICA', 'Rua República do Peru', '211', '301', 'Copacabana', '22021040', 'Rio de Janeiro', 'RJ', '21985913045', 'eduardo.teixeira@consultabem.com.br', '21985913045', '', '', '', '', '2014-02-14 12:47:13', null);

-- ----------------------------
-- Table structure for `roteiro`
-- ----------------------------
DROP TABLE IF EXISTS `roteiro`;
CREATE TABLE `roteiro` (
  `id_roteiro` int(8) NOT NULL AUTO_INCREMENT,
  `id_ordem_serv` int(8) DEFAULT NULL,
  `id_origem_cliente` int(8) DEFAULT NULL,
  `id_tipo_acao_origem` int(8) DEFAULT NULL,
  `nm_contato_origem` varchar(30) DEFAULT NULL,
  `nu_documento_origem` varchar(20) DEFAULT NULL,
  `ds_tarefa_origem` longtext NOT NULL,
  `nu_tempo_origem` int(4) DEFAULT NULL,
  `dt_agendado` date DEFAULT NULL,
  `hr_agendado` time DEFAULT NULL,
  `id_destino_cliente` int(8) DEFAULT NULL,
  `id_tipo_acao_destino` int(8) DEFAULT NULL,
  `nm_contato_destino` varchar(30) DEFAULT NULL,
  `nu_documento_destino` varchar(20) DEFAULT NULL,
  `ds_tarefa_destino` longtext,
  `nu_tempo_destino` int(4) DEFAULT NULL,
  `id_entregador` int(8) DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  `st_ordem_serv_item` varchar(30) DEFAULT 'AGUARDANDO',
  `cp_ordem` int(4) DEFAULT '0',
  `nu_distancia` decimal(8,1) DEFAULT '0.0',
  `nu_duracao` int(8) DEFAULT '0',
  `observacao` varchar(200) DEFAULT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `id_completo_origem` int(8) DEFAULT NULL,
  `id_completo_destino` int(8) DEFAULT NULL,
  `dt_ult_mov` datetime DEFAULT NULL,
  PRIMARY KEY (`id_roteiro`),
  KEY `id_ordem_serv` (`id_ordem_serv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roteiro
-- ----------------------------
INSERT INTO `roteiro` VALUES ('1', '1', '1', '3', null, 'teste', 'teste', null, '2016-06-17', null, '3', '2', null, 'teste', 'teste', null, '1', null, 'AVISO CONFIRMADO', '0', '29.6', '34', '<2016-06-17 13:34:00> MENSAGEM ENVIADA <br><2016-06-17 13:35:49> ENTREGADOR CONFIRMOU TAREFA <br>', 'Admin', null, null, '2016-06-17 13:35:49');
INSERT INTO `roteiro` VALUES ('2', '1', '3', '6', null, 'teste', 'teste', null, '2016-06-17', null, '1', '7', null, 'test', 'teste', null, null, null, 'AGUARDANDO', '0', '27.6', '29', null, 'Admin', '3', '1', null);

-- ----------------------------
-- Table structure for `status_tarefa`
-- ----------------------------
DROP TABLE IF EXISTS `status_tarefa`;
CREATE TABLE `status_tarefa` (
  `id_status_tarefa` int(8) NOT NULL AUTO_INCREMENT,
  `ds_status_tarefa` varchar(30) DEFAULT NULL,
  `visivel` varchar(1) DEFAULT 'S',
  PRIMARY KEY (`id_status_tarefa`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status_tarefa
-- ----------------------------
INSERT INTO `status_tarefa` VALUES ('1', 'AGUARDANDO', 'S');
INSERT INTO `status_tarefa` VALUES ('2', 'ENVIAR AVISO', 'S');
INSERT INTO `status_tarefa` VALUES ('3', 'AVISO ENVIADO', 'S');
INSERT INTO `status_tarefa` VALUES ('4', 'AVISO CONFIRMADO', 'S');
INSERT INTO `status_tarefa` VALUES ('5', 'AVISO PENDENTE', 'S');
INSERT INTO `status_tarefa` VALUES ('6', 'INDO ORIGEM', 'S');
INSERT INTO `status_tarefa` VALUES ('7', 'TERMINO ORIGEM', 'S');
INSERT INTO `status_tarefa` VALUES ('8', 'INDO DESTINO', 'S');
INSERT INTO `status_tarefa` VALUES ('9', 'TERMINO DESTINO', 'S');
INSERT INTO `status_tarefa` VALUES ('10', 'CANCELAR', 'S');
INSERT INTO `status_tarefa` VALUES ('11', 'CANCELADO', 'S');
INSERT INTO `status_tarefa` VALUES ('12', 'CANC.CONFIRMADO', 'S');
INSERT INTO `status_tarefa` VALUES ('13', 'RETORNANDO', 'S');
INSERT INTO `status_tarefa` VALUES ('14', 'FINALIZAR', 'S');
INSERT INTO `status_tarefa` VALUES ('15', 'INICIAR O SERVIÇO', 'S');

-- ----------------------------
-- Table structure for `tarifa`
-- ----------------------------
DROP TABLE IF EXISTS `tarifa`;
CREATE TABLE `tarifa` (
  `id_tarifa` int(8) NOT NULL AUTO_INCREMENT,
  `nm_tarifa` varchar(40) DEFAULT NULL,
  `ds_tarifa` longtext,
  `dt_inclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tarifa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tarifa
-- ----------------------------
INSERT INTO `tarifa` VALUES ('1', 'POR HORA', 'Contrato por hora,  mínimo de 3 horas.\r\nValor máximo de uma DIÁRIA (R$ 320,00).\r\nAcima de 50Km - R$ 2,80 por Km.', '2016-03-08 00:00:00');
INSERT INTO `tarifa` VALUES ('2', 'DIARIA', 'Contratação por dia, máximo de 100Km.\r\nAcima de 100Km será cobrado R$ 3,00 por KM ', '2016-03-08 00:00:00');
INSERT INTO `tarifa` VALUES ('3', 'PONTO A PONTO', 'Valor cobrado por Km rodado.', '2016-03-08 00:00:00');
INSERT INTO `tarifa` VALUES ('4', 'MALA DIRETA', 'Por entrega realizada.\r\nSerá cobrado adicional de Km para total acima de 60Km.', '2016-03-08 00:00:00');
INSERT INTO `tarifa` VALUES ('5', 'ESPECIAL', 'Cobrado caso a caso.', '2016-03-08 00:00:00');

-- ----------------------------
-- Table structure for `tarifa_item`
-- ----------------------------
DROP TABLE IF EXISTS `tarifa_item`;
CREATE TABLE `tarifa_item` (
  `id_tarifa_item` int(8) NOT NULL AUTO_INCREMENT,
  `id_tarifa` int(8) DEFAULT NULL,
  `id_tipo_tarifa` int(8) DEFAULT NULL,
  `qtd_faixa_tarifa_min` decimal(8,1) DEFAULT '0.0',
  `qtd_faixa_tarifa_max` decimal(8,1) DEFAULT '9999999.9',
  `vlr_tipo_tarifa` decimal(10,2) DEFAULT '0.00',
  `vlr_tarifa_min` decimal(10,2) DEFAULT '0.00',
  `vlr_tarifa_max` decimal(10,2) DEFAULT '99999999.99',
  `apartir_trajeto` int(3) DEFAULT '0',
  PRIMARY KEY (`id_tarifa_item`),
  KEY `id_tarifa` (`id_tarifa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tarifa_item
-- ----------------------------
INSERT INTO `tarifa_item` VALUES ('1', '1', '3', '180.0', '9999999.9', '2.00', '0.00', '320.00', '0');
INSERT INTO `tarifa_item` VALUES ('2', '1', '1', '50.0', '9999999.9', '2.80', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('3', '2', '2', '0.0', '9999999.9', '550.00', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('4', '2', '1', '100.0', '9999999.9', '3.00', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('5', '3', '1', '12.0', '9999999.9', '0.85', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('6', '4', '4', '2.0', '9999999.9', '30.00', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('7', '4', '1', '60.0', '9999999.9', '4.00', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('8', '5', '5', '0.0', '9999999.9', '1.00', '0.00', '99999999.99', '0');
INSERT INTO `tarifa_item` VALUES ('10', '3', '1', '24.0', '9999999.9', '0.85', '0.00', '99999999.99', '2');

-- ----------------------------
-- Table structure for `tarifa_tipo`
-- ----------------------------
DROP TABLE IF EXISTS `tarifa_tipo`;
CREATE TABLE `tarifa_tipo` (
  `id_tipo_tarifa` int(8) NOT NULL AUTO_INCREMENT,
  `ds_tipo_tarifa` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_tarifa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tarifa_tipo
-- ----------------------------
INSERT INTO `tarifa_tipo` VALUES ('1', 'KM');
INSERT INTO `tarifa_tipo` VALUES ('2', 'DIA');
INSERT INTO `tarifa_tipo` VALUES ('3', 'HORA');
INSERT INTO `tarifa_tipo` VALUES ('4', 'ENTREGA');
INSERT INTO `tarifa_tipo` VALUES ('5', 'VALOR');

-- ----------------------------
-- Table structure for `tipo_acao`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_acao`;
CREATE TABLE `tipo_acao` (
  `id_tipo_acao` int(8) NOT NULL AUTO_INCREMENT,
  `ds_acao` varchar(30) DEFAULT NULL,
  `cd_sentido` varchar(1) DEFAULT NULL,
  `cd_documento` int(1) DEFAULT '0',
  PRIMARY KEY (`id_tipo_acao`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_acao
-- ----------------------------
INSERT INTO `tipo_acao` VALUES ('1', 'PEGAR DOCUMENTO', 'O', '1');
INSERT INTO `tipo_acao` VALUES ('2', 'ENTREGAR DOCUMENTO', 'D', '1');
INSERT INTO `tipo_acao` VALUES ('3', 'COLHER ASSINATURA', 'O', '0');
INSERT INTO `tipo_acao` VALUES ('4', 'COLHER ASSINATURA', 'D', '0');
INSERT INTO `tipo_acao` VALUES ('5', 'REALIZAR PAGAMENTO', 'D', '0');
INSERT INTO `tipo_acao` VALUES ('6', 'PEGAR CONVITE', 'O', '0');
INSERT INTO `tipo_acao` VALUES ('7', 'ENTREGAR CONVITE', 'D', '0');

-- ----------------------------
-- Table structure for `tipo_pagto`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_pagto`;
CREATE TABLE `tipo_pagto` (
  `id_tipo_pagto` int(8) NOT NULL,
  `ds_tipo_pagto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_pagto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_pagto
-- ----------------------------
INSERT INTO `tipo_pagto` VALUES ('1', 'DINHEIRO');
INSERT INTO `tipo_pagto` VALUES ('2', 'CHEQUE');
INSERT INTO `tipo_pagto` VALUES ('3', 'CARTÃO DÉBITO');
INSERT INTO `tipo_pagto` VALUES ('4', 'CARTÃO CRÉDITO');

-- ----------------------------
-- Table structure for `trajeto`
-- ----------------------------
DROP TABLE IF EXISTS `trajeto`;
CREATE TABLE `trajeto` (
  `id_trajeto` int(8) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(8) DEFAULT NULL,
  `id_ordem_serv` int(8) DEFAULT NULL,
  `id_entregador` int(8) DEFAULT NULL,
  `cp_ordem` int(4) DEFAULT '0',
  `ds_endereco` varchar(150) DEFAULT NULL,
  `ds_complemento` varchar(45) DEFAULT NULL,
  `ds_pagamento` varchar(3) DEFAULT NULL,
  `nm_contato` varchar(30) DEFAULT NULL,
  `nu_documento` varchar(20) DEFAULT NULL,
  `ds_observacao` longtext,
  `dt_agendado` date DEFAULT NULL,
  `hr_agendado` time DEFAULT NULL,
  `nu_distancia` decimal(8,1) DEFAULT '0.0',
  `nu_duracao` int(6) DEFAULT '0',
  `dt_entrega_prevista` datetime DEFAULT NULL,
  `st_ordem_serv_item` varchar(30) DEFAULT 'AGUARDANDO',
  `nm_usuario` varchar(30) DEFAULT NULL,
  `dt_entrega` datetime DEFAULT NULL,
  `dt_ult_mov` datetime DEFAULT NULL,
  `dt_inclusao` datetime DEFAULT NULL,
  `dt_inicio` datetime DEFAULT NULL,
  `prev_pausa` int(4) NOT NULL DEFAULT '0',
  `tp_trajeto` varchar(30) DEFAULT NULL,
  `dt_inicio_pausa` datetime DEFAULT NULL,
  `dt_fim_pausa` datetime DEFAULT NULL,
  `dif_duracao` int(4) NOT NULL DEFAULT '0',
  `st_msg_bot` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_trajeto`)
) ENGINE=InnoDB AUTO_INCREMENT=1341 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trajeto
-- ----------------------------
INSERT INTO `trajeto` VALUES ('1305', '5361', '600', '12', '0', 'Avenida Bartolomeu Mitre - Leblon, Rio de Janeiro - RJ, Brasil', '182 apto 102', 'Sim', '', '', '', null, null, '13.3', '1908', '2017-01-17 12:52:11', 'FINALIZADO', 'Admin', '2017-01-17 12:36:25', null, null, '2017-01-17 12:20:23', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1306', '5361', '600', '12', '1', 'Novo Leblon - Avenida das Américas - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '6200', 'Não', '', '', '', null, null, '19.2', '2282', '2017-01-17 13:14:27', 'FINALIZADO', 'Admin', '2017-01-17 12:36:58', null, null, '2017-01-17 12:36:25', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1307', '5361', '600', '12', '2', 'Avenida Bartolomeu Mitre - Leblon, Rio de Janeiro - RJ, Brasil', '189', 'Não', '', '', '', null, null, '18.7', '2202', '2017-01-17 13:13:40', 'FINALIZADO', 'Admin', '2017-01-17 12:37:54', null, null, '2017-01-17 12:36:58', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1308', '4997', '601', '1', '0', 'Estrada Do Pedregoso próximo ao 1359 - Campo Grande, Rio de Janeiro - RJ, Brasil', '', '', '', '', '', null, null, '42.6', '3636', '2017-01-17 14:25:11', 'FINALIZADO', 'Admin', '2017-01-17 13:06:30', '2017-01-17 13:05:56', null, '2017-01-17 12:23:59', '0', 'COLETA', '2017-01-17 12:22:00', '2017-01-17 13:05:56', '3636', null);
INSERT INTO `trajeto` VALUES ('1309', '4997', '601', '1', '1', 'Rua Cascais - Penha Circular, Rio de Janeiro - RJ, Brasil', '', '', 'marcos', '', '', null, null, '32.5', '2631', '2017-01-17 13:50:21', 'FINALIZADO', 'Admin', '2017-01-17 14:03:49', null, null, '2017-01-17 13:06:30', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1310', '4520', '602', '12', '0', 'Praça Professor José Bernardino - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '116 APTO 102', 'Sim', '', '', '', null, null, '24.1', '2907', '2017-01-17 13:19:00', 'FINALIZADO', 'Admin', '2017-01-17 12:41:24', null, null, '2017-01-17 12:30:33', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1311', '4520', '602', '12', '1', 'Rua José Higino, 380, Rio de Janeiro - RJ, Brasil', 'APTO 803', 'Não', 'VALDIR', '', '', null, null, '18.0', '3210', '2017-01-17 13:34:54', 'FINALIZADO', 'Admin', '2017-01-17 13:24:28', null, null, '2017-01-17 12:41:24', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1312', '6746', '603', null, '0', 'Avenida Olegário Maciel - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '518 COB 105', 'Sim', '', '', '', null, null, '24.5', '2919', '2017-01-17 14:18:24', 'FINALIZADO', 'Admin', '2017-01-17 14:11:47', null, null, '2017-01-17 13:29:45', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1313', '6746', '603', null, '1', 'Rua Voluntários da Pátria - Botafogo, Rio de Janeiro - RJ, Brasil', '445 SL 1009', 'Não', 'solange', '', '', null, null, '15.1', '2202', '2017-01-17 14:48:30', 'FINALIZADO', 'Admin', '2017-01-17 14:47:10', null, null, '2017-01-17 14:11:48', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1314', '5923', '604', '1', '0', 'Rua Voluntários da Pátria, 360 - Botafogo, Rio de Janeiro - RJ, Brasil', 'portaria', '', '', '', '', null, null, '11.0', '1458', '2017-01-17 14:33:41', 'FINALIZADO', 'Admin', '2017-01-17 14:46:07', null, null, '2017-01-17 14:09:23', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1315', '5923', '604', '1', '1', 'Estrada Adhemar Bebiano - Inhauma, Rio de Janeiro - RJ, Brasil', '1380', '', 'JOAO CALDEIRA', '', '', null, null, '20.7', '2235', '2017-01-17 15:23:23', 'FINALIZADO', 'Admin', '2017-01-17 15:32:22', null, null, '2017-01-17 14:46:08', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1316', '4997', '605', '12', '0', 'Rua Hadock Lobo, 146 - Rio Comprido, Rio de Janeiro - RJ, Brasil', 'lj a ', '', '', '', '', null, null, '4.8', '1056', '2017-01-17 15:35:32', 'FINALIZADO', 'Admin', '2017-01-17 15:19:56', null, null, '2017-01-17 15:17:56', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1317', '4997', '605', '12', '1', 'Av. Brasil, 7200 - Maré, Rio de Janeiro - RJ, Brasil', 'sotreq', '', '', '', '', null, null, '10.6', '1253', '2017-01-17 15:40:49', 'FINALIZADO', 'Admin', '2017-01-17 15:44:01', null, null, '2017-01-17 15:19:56', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1318', '4997', '605', '12', '2', 'Estrada Do Pedregoso próximo ao 1359 - Campo Grande, Rio de Janeiro - RJ, Brasil', '', '', 'FELICIANO', '', '', null, null, '36.2', '2865', '2017-01-17 16:31:46', 'FINALIZADO', 'Admin', '2017-01-17 16:47:33', null, null, '2017-01-17 15:44:01', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1319', '6773', '606', '1', '0', 'AVENIDA JOAO CABRAL DE MELO NETO, BARRA DA TIJUCA', '850 ALA 723 BL 3 AO LADO PENINSULA', 'Sim', '', '', '', null, null, '25.1', '2408', '2017-01-17 16:20:42', 'FINALIZADO', 'Admin', '2017-01-17 16:27:30', null, null, '2017-01-17 15:40:34', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1320', '6773', '606', '1', '1', 'Av. Epitácio Pessoa - Lagoa, Rio de Janeiro - RJ, Brasil', '1844 APTO 901', 'Não', 'carlos felicio', '', ' porteiro', null, null, '20.5', '2655', '2017-01-17 17:11:46', 'FINALIZADO', 'Admin', '2017-01-17 17:16:16', null, null, '2017-01-17 16:27:31', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1321', '6773', '606', '1', '2', 'AV JOAO CABRAL DE MELO NETO, BARRA DA TIJUCA, RJ', '', 'Não', '', '', 'serviço de retorno cancelado', null, null, '21.1', '2745', '2017-01-17 18:02:02', 'FINALIZADO', 'Admin', '2017-01-17 17:17:47', null, null, '2017-01-17 17:16:17', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1322', '5780', '607', '12', '0', 'Rua Carlos Palut - Taquara, Rio de Janeiro - RJ, Brasil', '230', '', '', '', 'COLETAR MATERIAL DO CIRCO VOADOR', null, null, '24.9', '2946', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1323', '5780', '607', '12', '1', 'ARCOS DA LAPA, CENTRO, RIO DE JANEIRO', '', '', '', '', 'ENTREGAR MATERIAL', null, null, '28.3', '3935', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1324', '6802', '608', '12', '0', 'Rua Ipiranga, 134 - Laranjeiras, Rio de Janeiro - RJ, Brasil', 'LOJA POLO AR PROCURAR JESSICA', 'Não', '', '', '', null, null, '9.3', '1470', '2017-01-17 17:12:48', 'FINALIZADO', 'Admin', '2017-01-17 18:40:37', null, null, '2017-01-17 16:48:18', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1325', '6802', '608', '12', '1', 'Rua dos Jacarandás - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '880 BL 1 APTO 302', 'Não', 'Sr Ivens', '', '', null, null, '35.8', '3635', '2017-01-17 19:41:12', 'FINALIZADO', 'Admin', '2017-01-17 18:49:37', null, null, '2017-01-17 18:40:37', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1326', '5034', '609', '12', '0', 'Avenida Nilo Peçanha, 11 - Centro, Rio de Janeiro - RJ, Brasil', 'COLETAR MALOTE', '', '', '', '', null, null, '7.6', '1610', '2017-01-18 09:58:43', 'FINALIZADO', 'Admin', '2017-01-18 10:15:21', null, null, '2017-01-18 09:31:53', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1327', '5034', '609', '12', '1', 'Avenida João XXIII - Santa Cruz, Rio de Janeiro - RJ, Brasil', 'BAR PAO COM OVO', '', '', '', '', null, null, '68.0', '6024', '2017-01-18 12:29:14', 'FINALIZADO', 'Admin', '2017-01-18 11:50:43', '2017-01-18 11:50:23', null, '2017-01-18 10:15:22', '60', 'COLETA', '2017-01-18 11:20:00', '2017-01-18 11:50:23', '2008', null);
INSERT INTO `trajeto` VALUES ('1328', '5034', '609', '12', '2', 'Avenida Nilo Peçanha - Centro, Rio de Janeiro - RJ, Brasil', '', '', 'Luiz', '', '', null, null, '66.0', '6207', '2017-01-18 13:34:10', 'FINALIZADO', 'Admin', '2017-01-18 13:13:02', null, null, '2017-01-18 11:50:43', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1329', '5002', '610', '1', '0', 'Avenida Londres, 191 - Bonsucesso, Rio de Janeiro - RJ, Brasil', 'MUDE', '', '', '', '', null, null, '5.6', '963', '2017-01-18 10:35:47', 'FINALIZADO', 'Admin', '2017-01-18 10:34:20', null, null, '2017-01-18 10:19:44', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1330', '5002', '610', '1', '1', 'Estrada do Galeão, 271 - Jardim Guanabara, Rio de Janeiro - RJ, Brasil', 'ENFRENTE AO RADAR DE 40KM', '', 'BRUNO', '', '', null, null, '15.2', '1977', '2017-01-18 11:07:18', 'FINALIZADO', 'Admin', '2017-01-18 11:06:20', null, null, '2017-01-18 10:34:21', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1331', '5002', '610', '1', '2', 'Estrada do Galeão - Portuguesa, Rio de Janeiro - RJ, Brasil', 'RAULINO CONTADOR', '', '', '', '', null, null, '3.2', '734', '2017-01-18 11:18:35', 'FINALIZADO', 'Admin', '2017-01-18 11:35:36', null, null, '2017-01-18 11:06:21', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1332', '5002', '610', '1', '3', 'Av. Londres - Bonsucesso, Rio de Janeiro - RJ, Brasil', '', '', 'FLAVIA', '', '', null, null, '9.3', '1046', '2017-01-18 11:53:02', 'FINALIZADO', 'Admin', '2017-01-18 11:36:05', null, null, '2017-01-18 11:35:36', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1333', '6258', '611', '1', '0', 'Avenida Baronesa de Mesquita, 162, Mesquita - RJ, Brasil', 'DO LADO QUE FICA O CEMITERIO DA SAUDADE', 'Não', '', '', '', null, null, '34.3', '3368', '2017-01-18 12:33:18', 'FINALIZADO', 'Admin', '2017-01-18 12:44:17', null, null, '2017-01-18 11:37:10', '0', 'COLETA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1334', '6258', '611', '1', '1', 'Rua Jabaira, 342 - Oswaldo Cruz, Rio de Janeiro - RJ, Brasil', 'CRISTIANE', 'Não', 'cristiane', '', '', null, null, '17.8', '2861', '2017-01-18 13:31:58', 'FINALIZADO', 'Admin', '2017-01-18 13:23:54', null, null, '2017-01-18 12:44:17', '0', 'ENTREGA', null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1335', '5923', '612', '1', '0', 'Largo São Francisco de Paula, 26 - Centro, Rio de Janeiro - RJ, Brasil', 'SALA 905 PREDIO PATRIARCA', '', '', '', 'PEGAR DOCUMENTO COM FLAVIA SANTOS', null, null, '7.1', '1428', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1336', '5923', '612', '1', '1', 'Rua Vilhena de Morais, 240 - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '', '', '', '', 'AOS CUIDADOS DE MARCELO MAIA', null, null, '33.4', '3341', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1337', '6696', '613', '1', '0', 'Av. Carlos Chagas Filho - Cidade Universitária, Rio de Janeiro - RJ, Brasil', 'PHARMA', '', '', '', 'FAZER COLETAS', null, null, '10.9', '1389', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1338', '6696', '613', '1', '1', 'Avenida Carlos Chagas Filho - Cidade Universitária, Rio de Janeiro - RJ, Brasil', '', '', '', '', 'ENTREGAS DIVERSAS', null, null, '0.0', '0', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1339', '6773', '614', '12', '0', 'Avenida Epitácio Pessoa, 1844 - Lagoa, Rio de Janeiro - RJ, Brasil', 'APT 901', 'Não', '', '', 'COLETAR COM LORENÇO', null, null, '13.4', '1557', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);
INSERT INTO `trajeto` VALUES ('1340', '6773', '614', '12', '1', 'Av. João de Cabral de Mello Neto - Barra da Tijuca, Rio de Janeiro - RJ, Brasil', '850,BL 3 SL 723', 'Sim', '', '', '', null, null, '20.1', '2624', null, 'CANCELADO', 'Admin', null, null, null, null, '0', null, null, null, '0', null);

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(8) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nm_usuario` varchar(80) DEFAULT NULL,
  `nu_celular` varchar(60) DEFAULT NULL,
  `ds_email` varchar(60) DEFAULT NULL,
  `id_funcao` int(8) DEFAULT NULL,
  `observacao` longtext,
  `dt_inclusao` datetime DEFAULT NULL,
  `st_servico_msg` varchar(1) DEFAULT 'I',
  `tx_servico_msg` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', '21 99195-8789', null, '5', null, '2016-01-01 00:00:00', 'A', 'PRONTO');
INSERT INTO `usuario` VALUES ('2', 'mayara', null, '1234', null, null, '4', null, null, 'I', 'MSG - INATIVA');
INSERT INTO `usuario` VALUES ('3', 'franklin', null, 'gabi25802453', null, null, '1', null, null, 'I', 'MSG - INATIVA');
DROP TRIGGER IF EXISTS `cp_completo_insert`;
DELIMITER ;;
CREATE TRIGGER `cp_completo_insert` BEFORE INSERT ON `local_cliente` FOR EACH ROW BEGIN

  SET NEW.cp_completo = CONCAT(

   if(isnull(NEW.endereco_local_cliente),'',CONCAT(NEW.endereco_local_cliente,', ')) ,
   if(isnull(NEW.numero_local_cliente),'',CONCAT(NEW.numero_local_cliente,', ')),
   if(isnull(NEW.complemento_local_cliente),'',CONCAT(NEW.complemento_local_cliente,' - ')),
   if(isnull(NEW.bairro_local_cliente),'',CONCAT(NEW.bairro_local_cliente,' - ')),
   if(isnull(NEW.cidade_local_cliente),'',CONCAT(NEW.cidade_local_cliente,' - ')),
   if(isnull(NEW.uf_local_cliente),'',CONCAT(NEW.uf_local_cliente,' - ')),
   if(isnull(NEW.cep_local_cliente),'',CONCAT(NEW.cep_local_cliente,' - ')),
   'Brasil ');

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `cp_complet_update`;
DELIMITER ;;
CREATE TRIGGER `cp_complet_update` BEFORE UPDATE ON `local_cliente` FOR EACH ROW BEGIN

  SET NEW.cp_completo = CONCAT(

   if(isnull(NEW.endereco_local_cliente),'',CONCAT(NEW.endereco_local_cliente,', ')) ,
   if(isnull(NEW.numero_local_cliente),'',CONCAT(NEW.numero_local_cliente,', ')),
   if(isnull(NEW.complemento_local_cliente),'',CONCAT(NEW.complemento_local_cliente,' - ')),
   if(isnull(NEW.bairro_local_cliente),'',CONCAT(NEW.bairro_local_cliente,' - ')),
   if(isnull(NEW.cidade_local_cliente),'',CONCAT(NEW.cidade_local_cliente,' - ')),
   if(isnull(NEW.uf_local_cliente),'',CONCAT(NEW.uf_local_cliente,' - ')),
   if(isnull(NEW.cep_local_cliente),'',CONCAT(NEW.cep_local_cliente,' - ')),
   'Brasil ');

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `update_pos_ord`;
DELIMITER ;;
CREATE TRIGGER `update_pos_ord` BEFORE UPDATE ON `ordem_serv` FOR EACH ROW BEGIN

  SET NEW.pos_ord = 

   if(NEW.st_os='INICIADO',4,if(NEW.st_os='FINALIZADO',8,if(NEW.st_os='CANCELADO',9,2))) ;

END
;;
DELIMITER ;
