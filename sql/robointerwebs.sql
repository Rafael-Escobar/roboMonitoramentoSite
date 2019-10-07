-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Out-2019 às 03:56
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `robo_interwebs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_site`
--

CREATE TABLE `user_site` (
  `code` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `http_code` varchar(3) NOT NULL DEFAULT '0',
  `message` varchar(100) NOT NULL,
  `result` text NOT NULL,
  `register` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_site`
--

INSERT INTO `user_site` (`code`, `reference`, `user_code`, `url`, `http_code`, `message`, `result`, `register`, `updated`, `notified`) VALUES
(1, 0, 1, 'http://globo.com', '0', '', '', '2019-10-06 22:04:57', '2019-10-06 22:04:57', 0),
(2, 0, 1, 'http://globo.com', '0', '', '', '2019-10-06 22:06:16', '2019-10-06 22:06:16', 0),
(3, 1, 1, 'http://globo.com', '0', '', '', '2019-10-06 22:07:28', '2019-10-06 22:07:28', 0),
(4, 19, 8, 'http://teste2.com', '0', '', '', '2019-10-06 22:27:29', '2019-10-06 22:27:29', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `user_site`
--
ALTER TABLE `user_site`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user_site`
--
ALTER TABLE `user_site`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
