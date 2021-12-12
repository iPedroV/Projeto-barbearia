-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Dez-2021 às 16:41
-- Versão do servidor: 8.0.23
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbbarbearia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `idAgendamento` int NOT NULL,
  `horario` time NOT NULL,
  `data` date NOT NULL,
  `forma_de_pagamento` varchar(45) NOT NULL,
  `status_agendamento` varchar(64) NOT NULL,
  `data_regs_agendamento` datetime NOT NULL,
  `data_do_pagamento` date NOT NULL,
  `confir_envio` varchar(45) NOT NULL,
  `valortotal` decimal(18,2) NOT NULL,
  `usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`idAgendamento`, `horario`, `data`, `forma_de_pagamento`, `status_agendamento`, `data_regs_agendamento`, `data_do_pagamento`, `confir_envio`, `valortotal`, `usuario_id`) VALUES
(22, '15:30:00', '2021-12-10', 'Dinheiro', 'concluido', '2021-12-09 11:30:04', '2021-12-09', 'confirmado', '34.99', 90),
(24, '17:00:00', '2021-12-11', 'Dinheiro', 'concluido', '2021-12-10 08:06:45', '2021-12-10', 'confirmado', '19.99', 97),
(26, '16:15:00', '2021-12-13', 'Dinheiro', 'concluido', '2021-12-10 09:43:28', '2021-12-10', 'confirmado', '19.99', 90),
(27, '14:00:00', '2021-12-14', 'Dinheiro', 'agendado', '2021-12-10 10:06:33', '2021-12-14', 'confirmado', '34.99', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos_dos_servicos`
--

CREATE TABLE `agendamentos_dos_servicos` (
  `agendamentos_id` int NOT NULL,
  `sf_funcionario` int NOT NULL,
  `sf_servicos` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `agendamentos_dos_servicos`
--

INSERT INTO `agendamentos_dos_servicos` (`agendamentos_id`, `sf_funcionario`, `sf_servicos`) VALUES
(22, 1, 11),
(24, 1, 5),
(24, 1, 10),
(26, 98, 6),
(26, 98, 8),
(27, 101, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_regs_despesa` date NOT NULL,
  `status` varchar(45) NOT NULL,
  `valor` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `tipo`, `data_regs_despesa`, `status`, `valor`) VALUES
(2, 'Luz', '2021-11-26', 'Sim', '0'),
(81, 'Agua', '2021-12-10', 'Sim', '100');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `autor` varchar(20) NOT NULL,
  `horario` datetime NOT NULL,
  `comment_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descricao`, `autor`, `horario`, `comment_status`) VALUES
(14, 'Não teremos serviços hoje', 'Estarei viajando.', 'ADM', '2021-12-10 10:01:49', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `idServicos` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `valor` double NOT NULL,
  `tempo_estimado` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`idServicos`, `nome`, `valor`, `tempo_estimado`) VALUES
(1, 'Só tesoura', 24.99, '00:30:00'),
(2, 'Maq: e tesoura', 19.99, '00:25:00'),
(3, 'Degradê navalhado', 24.99, '00:30:00'),
(4, 'Degradê só Maq:', 19.99, '00:30:00'),
(5, 'Barba', 19.99, '00:20:00'),
(6, 'Graxa', 19.99, '00:20:00'),
(7, 'Corte Feminino', 29.99, '00:35:00'),
(8, 'Pintura Masculino', 19.99, '00:20:00'),
(9, 'Pintura de Barba', 9.99, '00:20:00'),
(10, 'Corte + graxa', 34.99, '00:45:00'),
(11, 'Corte + barba', 34.99, '00:45:00'),
(12, 'Corte + pintura', 34.99, '00:50:00'),
(16, 'Corte+barba+graxa', 44.99, '01:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_do_funcionario`
--

CREATE TABLE `servicos_do_funcionario` (
  `funcionarios_id` int NOT NULL,
  `servicos_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos_do_funcionario`
--

INSERT INTO `servicos_do_funcionario` (`funcionarios_id`, `servicos_id`) VALUES
(1, 1),
(98, 1),
(99, 1),
(101, 1),
(1, 2),
(98, 2),
(99, 2),
(101, 2),
(1, 3),
(98, 3),
(99, 3),
(101, 3),
(1, 4),
(98, 4),
(99, 4),
(101, 4),
(1, 5),
(98, 5),
(99, 5),
(101, 5),
(1, 6),
(98, 6),
(99, 6),
(101, 6),
(1, 7),
(98, 7),
(99, 7),
(101, 7),
(1, 8),
(98, 8),
(99, 8),
(101, 8),
(1, 9),
(98, 9),
(99, 9),
(101, 9),
(1, 10),
(98, 10),
(99, 10),
(101, 10),
(1, 11),
(98, 11),
(99, 11),
(101, 11),
(1, 12),
(98, 12),
(99, 12),
(101, 12),
(98, 16),
(99, 16),
(101, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `verifica` varchar(1) NOT NULL,
  `token` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `perfil`, `telefone`, `email`, `senha`, `sexo`, `verifica`, `token`) VALUES
(1, 'Gildo Neves', 'Administrador', '61984941352', 'salaoebarbearianeves@gmail.com', '19aee40b699a2a83daa61bb945dff1fe', 'Masculino', 'A', '1234567890'),
(90, 'Hariston Nunes Macedo', 'Cliente', '(61) 98602-7801', 'haristonmacedo2001@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Masculino', 'C', 'Y'),
(93, 'Fabiana Juíza', 'Secretaria', '61985858585', 'secretaria@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Feminino', 'S', '1639059686 '),
(97, 'Pedro Vitor', 'Cliente', '(61) 98435-7895', 'pedro.vcosta405@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Masculino', 'C', 'Y'),
(98, 'Jonas Vitor', 'Funcionario', '61986455512', 'jaominaspestiado10@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Masculino', 'S', '1639134507 '),
(99, 'Pedrívisc', 'Funcionario', '61981656546', 'pedroca405_@outlook.com', '0f031ab24a070f1c4925d675cc02a6ca', 'Masculino', 'S', '1639136906 '),
(100, 'Andarson Matias', 'Cliente', '(61) 98602-7801', 'haristongladiador14@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Masculino', 'C', 'Y'),
(101, 'Ana Paula Leite', 'Funcionario', '61996375157', 'anapaulaxy@gmail.com', 'd95e57debdc458bae9a47e757e9ce9fc', 'Feminino', 'S', '1639140694 ');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`idAgendamento`),
  ADD KEY `fk_agendamentos_usuario1_idx` (`usuario_id`);

--
-- Índices para tabela `agendamentos_dos_servicos`
--
ALTER TABLE `agendamentos_dos_servicos`
  ADD PRIMARY KEY (`agendamentos_id`,`sf_funcionario`,`sf_servicos`),
  ADD KEY `fk_agendamentos_has_servicos_agendamentos1_idx` (`agendamentos_id`),
  ADD KEY `fk_agendamentos_dos_servicos_funcionarios_has_servicos1_idx` (`sf_funcionario`,`sf_servicos`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`idServicos`);

--
-- Índices para tabela `servicos_do_funcionario`
--
ALTER TABLE `servicos_do_funcionario`
  ADD PRIMARY KEY (`funcionarios_id`,`servicos_id`),
  ADD KEY `fk_funcionarios_has_servicos_servicos1_idx` (`servicos_id`),
  ADD KEY `fk_funcionarios_has_servicos_funcionarios1_idx` (`funcionarios_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `idAgendamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `idServicos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_agendamentos_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `agendamentos_dos_servicos`
--
ALTER TABLE `agendamentos_dos_servicos`
  ADD CONSTRAINT `fk_agendamentos_dos_servicos_funcionarios_has_servicos1` FOREIGN KEY (`sf_funcionario`,`sf_servicos`) REFERENCES `servicos_do_funcionario` (`funcionarios_id`, `servicos_id`),
  ADD CONSTRAINT `fk_agendamentos_has_servicos_agendamentos1` FOREIGN KEY (`agendamentos_id`) REFERENCES `agendamentos` (`idAgendamento`);

--
-- Limitadores para a tabela `servicos_do_funcionario`
--
ALTER TABLE `servicos_do_funcionario`
  ADD CONSTRAINT `fk_funcionarios_has_servicos_funcionarios1` FOREIGN KEY (`funcionarios_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_funcionarios_has_servicos_servicos1` FOREIGN KEY (`servicos_id`) REFERENCES `servicos` (`idServicos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
