-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Nov-2014 às 18:44
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
`alunoId` int(11) NOT NULL,
  `alunoNome` varchar(200) NOT NULL,
  `alunoCurso` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`alunoId`, `alunoNome`, `alunoCurso`) VALUES
(2, 'aluno 2 ', 'português'),
(3, 'aluno 1', 'matematica'),
(4, 'Thalles Vinicius', 'Analise e Desenvolvimento De sistemas'),
(5, 'Tester 4', 'Ciência da Computação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE IF NOT EXISTS `emprestimo` (
`emprestimoId` int(11) NOT NULL,
  `emprestimoAlunoId` int(11) NOT NULL,
  `emprestimoLivroId` int(11) NOT NULL,
  `emprestimoStatus` varchar(50) NOT NULL,
  `emprestimoDevolucao` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`emprestimoId`, `emprestimoAlunoId`, `emprestimoLivroId`, `emprestimoStatus`, `emprestimoDevolucao`) VALUES
(2, 2, 1, 'devolvido', '27/11/2014'),
(4, 5, 6, 'emprestado', '10/12/2014');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
`livroId` int(11) NOT NULL,
  `livroTitulo` varchar(200) NOT NULL,
  `livroAssunto` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`livroId`, `livroTitulo`, `livroAssunto`) VALUES
(1, 'php', 'dominando php com zend'),
(4, 'harry potter', 'aventura'),
(6, 'dominando java', 'linguagem de programação java');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`usuarioId` int(11) NOT NULL,
  `usuarioNome` varchar(200) NOT NULL,
  `usuarioLogin` varchar(200) NOT NULL,
  `usuarioSenha` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `usuarioNome`, `usuarioLogin`, `usuarioSenha`) VALUES
(11, 'tester1', 'tester1', '72a3dcef165d9122a45decf13ae20631'),
(12, 'tester2', 'tester2', 'tester2'),
(13, 'tester3', 'tester3', 'tester3'),
(14, 'tester4', 'tester4', 'tester4'),
(16, 'Thalles Vinicius', 'thalles', 'vinicius');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
 ADD PRIMARY KEY (`alunoId`);

--
-- Indexes for table `emprestimo`
--
ALTER TABLE `emprestimo`
 ADD PRIMARY KEY (`emprestimoId`), ADD KEY `fkEmprestimoAluno` (`emprestimoAlunoId`), ADD KEY `fkEmprestimoLivro` (`emprestimoLivroId`);

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
 ADD PRIMARY KEY (`livroId`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`usuarioId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
MODIFY `alunoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emprestimo`
--
ALTER TABLE `emprestimo`
MODIFY `emprestimoId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
MODIFY `livroId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
ADD CONSTRAINT `fkEmprestimoAluno` FOREIGN KEY (`emprestimoAlunoId`) REFERENCES `aluno` (`alunoId`),
ADD CONSTRAINT `fkEmprestimoLivro` FOREIGN KEY (`emprestimoLivroId`) REFERENCES `livro` (`livroId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
