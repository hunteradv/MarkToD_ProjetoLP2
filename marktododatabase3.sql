-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Abr-2023 às 02:22
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marktodo2`
--

CREATE DATABASE marktodo2;
USE marktodo2;

-- --------------------------------------------------------

--
-- Estrutura da tabela `environments`
--

CREATE TABLE `environments` (
  `environmentId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `head` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `environments`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `taskcategories`
--

CREATE TABLE `taskcategories` (
  `taskCategoryId` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `taskcategories`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tasks`
--

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `dateAdd` datetime DEFAULT current_timestamp(),
  `dueDate` date DEFAULT NULL,
  `finishedDate` datetime DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `teamId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tasks`
--

--
-- Estrutura da tabela `teams`
--

CREATE TABLE `teams` (
  `teamId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `teamHead` int(11) DEFAULT NULL,
  `idEnvironment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `teams`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_in_environments`
--

CREATE TABLE `users_in_environments` (
  `uEnvId` int(11) NOT NULL,
  `environmentId` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users_in_environments`
--
--

--
-- Índices para tabela `environments`
--
ALTER TABLE `environments`
  ADD PRIMARY KEY (`environmentId`),
  ADD KEY `head` (`head`);

--
-- Índices para tabela `taskcategories`
--
ALTER TABLE `taskcategories`
  ADD PRIMARY KEY (`taskCategoryId`);

--
-- Índices para tabela `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `category` (`category`);

--
-- Índices para tabela `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamId`),
  ADD KEY `teamHead` (`teamHead`),
  ADD KEY `idEnvironment` (`idEnvironment`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Índices para tabela `users_in_environments`
--
ALTER TABLE `users_in_environments`
  ADD PRIMARY KEY (`uEnvId`),
  ADD KEY `environmentId` (`environmentId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `environments`
--
ALTER TABLE `environments`
  MODIFY `environmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `taskcategories`
--
ALTER TABLE `taskcategories`
  MODIFY `taskCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `teams`
--
ALTER TABLE `teams`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users_in_environments`
--
ALTER TABLE `users_in_environments`
  MODIFY `uEnvId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `environments`
--
ALTER TABLE `environments`
  ADD CONSTRAINT `environments_ibfk_1` FOREIGN KEY (`head`) REFERENCES `users` (`userId`);

--
-- Limitadores para a tabela `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`category`) REFERENCES `taskcategories` (`taskCategoryId`);

--
-- Limitadores para a tabela `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`teamHead`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`idEnvironment`) REFERENCES `environments` (`environmentId`);

--
-- Limitadores para a tabela `users_in_environments`
--
ALTER TABLE `users_in_environments`
  ADD CONSTRAINT `users_in_environments_ibfk_1` FOREIGN KEY (`environmentId`) REFERENCES `environments` (`environmentId`),
  ADD CONSTRAINT `users_in_environments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
