-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2023 às 22:37
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanchonete`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` text NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `endereco`, `senha`, `email`) VALUES
(1, 'Adimin', '00000000000', 'xxxxxxxxxxxxx', '$2y$10$c95.CjqY4jN5R/YD8iSvqutQplFufGSdOMkGbi06mfYx9Gi8TieqG', 'adm@a'),
(21, 'Gustavo', '04432430001', 'Rua augusto Vicente', '$2y$10$oHqppSo0xhBq21k.oHnYWOtEEYh7Mr1frPOv/7ds.6AntsTQD0Q1W', 'a@a'),
(22, 'Arthur', '11111111111', 'Rua alguma coisa', '$2y$10$gXMrCKHW8eeWOWqbxrEQD.WnR6g93gjt3RFs9WVnO4Rj5Bo4BTzIy', 'mai@mail'),
(23, 'Arthur', '12222222222', 'Rua dasdas', '$2y$10$KwJgEt8/WZ1BlDXQNK1cOep19JjVEQ7kR.f.E7dCGH8bthO0k28lK', 'o@a');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nome`, `quantidade`) VALUES
(1, 'Coração de Boi', 491),
(2, 'Vinagre de Vinho Tinto', 491),
(3, 'Alho', 491),
(4, 'Cominho em Pó', 491),
(5, 'Páprica', 491),
(6, 'Sal', 491),
(7, 'Pimenta', 491),
(8, 'Azeite de Oliva', 491),
(9, 'Espetos de Metal ou Madeira', 491),
(10, 'Abóbora', 500),
(11, 'Batata-Doce', 500),
(12, 'Fermento Biológico', 500),
(13, 'Açúcar', 500),
(14, 'Sal', 500),
(15, 'Água Morna', 500),
(16, 'Óleo Vegetal', 500),
(17, 'Melado ou Calda de Açúcar', 500),
(18, 'Pimentas Rocoto', 500),
(19, 'Água', 499),
(20, 'Vinagre', 499),
(21, 'Sal', 499),
(22, 'Carne Moída', 500),
(23, 'Cebola', 500),
(24, 'Alho', 500),
(25, 'Cominho em Pó', 500),
(63, 'Frango Inteiro', 468),
(64, 'Alho', 468),
(65, 'Cominho em Pó', 468),
(66, 'Páprica', 468),
(67, 'Pimenta-do-Reino', 468),
(68, 'Orégano Seco', 468),
(69, 'Coentro', 468),
(70, 'Cerveja Escura', 468),
(71, 'Sal', 468),
(72, 'Óleo Vegetal', 468),
(73, 'Batatas', 468),
(74, 'Molho Ají', 468),
(75, 'Salada', 468);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lanche_ingredientes`
--

CREATE TABLE `lanche_ingredientes` (
  `id` int(11) NOT NULL,
  `id_lanche` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lanche_ingredientes`
--

INSERT INTO `lanche_ingredientes` (`id`, `id_lanche`, `id_ingrediente`) VALUES
(55, 15, 1),
(56, 15, 2),
(57, 15, 3),
(58, 15, 4),
(59, 15, 5),
(60, 15, 6),
(61, 15, 7),
(62, 15, 8),
(63, 15, 9),
(64, 16, 10),
(65, 16, 11),
(66, 16, 12),
(67, 16, 13),
(68, 16, 14),
(69, 16, 15),
(70, 16, 16),
(71, 16, 17),
(72, 16, 18),
(73, 17, 19),
(74, 17, 20),
(75, 17, 21),
(76, 14, 63),
(77, 14, 64),
(78, 14, 65),
(79, 14, 66),
(80, 14, 67),
(81, 14, 68),
(82, 14, 69),
(83, 14, 70),
(84, 14, 71),
(85, 14, 72),
(86, 14, 73),
(87, 14, 74),
(88, 14, 75);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` int(11) NOT NULL,
  `pagamento` enum('dinheiro','PIX') NOT NULL,
  `cliente_endereco` varchar(255) NOT NULL,
  `troco` decimal(10,2) DEFAULT NULL,
  `comprovante_pix` varchar(255) DEFAULT NULL,
  `id_produtos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `data_pedido`, `valor`, `pagamento`, `cliente_endereco`, `troco`, `comprovante_pix`, `id_produtos`) VALUES
(43, 23, '2023-09-07 18:28:46', 45, 'PIX', 'Rua dasdas', 0.00, 'comprovantes/64fa165e28d46_54324.png', 14),
(44, 23, '2023-09-07 18:28:46', 45, 'PIX', 'Rua dasdas', 0.00, 'comprovantes/64fa165e2a502_54324.png', 15),
(45, 23, '2023-09-09 19:33:07', 25, 'PIX', 'Rua dasdas', 0.00, 'comprovantes/64fcc87323403_imagem_2023-09-09_163304497.png', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` int(11) NOT NULL,
  `tipo` enum('lanche','bebida') NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `tipo`, `descricao`, `imagem`) VALUES
(14, 'Pollo a la Brasa', 25, 'lanche', 'O prato mais consumido no Peru é o pollo a la brasa. É o famoso frango de televisão de cachorro e, sim, foi inventado no Peru. O pollo a la brasa é um prato simples, barato e suculento.', 'uploads/64efdbf4372a5_coisa.png.jpg'),
(15, 'anticuchos de corazón', 20, 'lanche', 'Uma das comidas típicas do Peru que você vai encontrar nas ruas peruanas é o anticuchos de corazón, um espetinho de coração de boi ou alpaca.', 'uploads/64efdee6ac5c5_coração.jpg'),
(16, 'Picarones ', 24, 'lanche', 'Picarones parecem donuts que são servidos com uma calda chamada chancaca, que é feita a partir da rapadura', 'uploads/64efdf0272b60_aaaa.jpg'),
(17, 'Rocoto relleno', 12, 'lanche', 'Esse prato da região de Arequipa tem uma simplicidade e uma combinação de sabores que agradam muito: pimenta rocoto recheada com carne e queijo.', 'uploads/64efdf2a4cb15_sdad.jpg'),
(18, 'Chicha Morada ', 7, 'bebida', 'Bebida tradicional do Peru, a Chicha Morada é um refresco feito com milho de cor roxa (maiz morado) fervido com especiarias e frutas. Essa bebida saudável é uma ótima alternativa para eliminar refrigerantes ou outras bebidas açucaradas do seu cardápio.', 'uploads/64efdf65b5e90_adsdsa.jpg'),
(19, 'Pisco sour', 9, 'bebida', 'Pisco sour é um coquetel típico da gastronomia sul-americana, especialmente do Peru e Chile, preparado à base de pisco, limão, xarope de açúcar, podendo ou não usar clara de ovo. O nome vem da união das palavras \"pisco\" e \"sour\".', 'uploads/64efdf94cee8c_dasd.jpg'),
(20, 'Chá de coca', 8, 'bebida', 'O chá de coca, ou mate de coca, é um chá feito a partir das folhas da coca.\r\n\r\nÉ uma bebida bem popular no Peru e consumida como chá digestivo e para tratar enjoos causados pela altitude.', 'uploads/64efdfb53b3c3_dsds.jpg'),
(21, 'Inca Kola', 34, 'bebida', 'Inca Kola! A Inca Kola é um refrigerante que tem como ingrediente a lúcia-lima (limonete, doce-lima, erva luísa, bela luísa), que é uma erva aromática nativa da América do Sul.', 'uploads/64efe002d6a00_asdasd.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_pedido`, `id_produto`, `quantidade`) VALUES
(1, 1, 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrinho_cliente` (`id_cliente`),
  ADD KEY `fk_carrinho_produto` (`id_produto`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lanche_ingredientes`
--
ALTER TABLE `lanche_ingredientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lanche` (`id_lanche`),
  ADD KEY `id_ingrediente` (`id_ingrediente`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_produtos` (`id_produtos`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `lanche_ingredientes`
--
ALTER TABLE `lanche_ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_carrinho_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_carrinho_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `lanche_ingredientes`
--
ALTER TABLE `lanche_ingredientes`
  ADD CONSTRAINT `lanche_ingredientes_ibfk_1` FOREIGN KEY (`id_lanche`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `lanche_ingredientes_ibfk_2` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_produtos`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
