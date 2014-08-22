-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: 2014 年 8 月 22 日 09:41
-- サーバのバージョン： 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ci_calendar`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar`
--

CREATE TABLE `calendar` (
  `date` date NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `calendar`
--

INSERT INTO `calendar` (`date`, `data`) VALUES
('0000-00-00', '15'),
('2008-09-11', 'dsavafv'),
('2008-09-12', 'dcsvsavsa'),
('2014-08-01', 'fdsvfas'),
('2014-08-05', 'dsaklvfnvla'),
('2014-08-06', 'fdsafvas'),
('2014-08-07', 'vsvさあ'),
('2014-08-08', 'fdsfゔぁsfゔぁs'),
('2014-08-09', 'fsafsafa'),
('2014-08-10', 'fsdafsa'),
('2014-08-12', ''),
('2014-08-14', ''),
('2014-08-15', 'dさvさゔぁ'),
('2014-08-19', '情報が入っている!'),
('2014-08-21', 'dsvmanjk'),
('2014-08-22', 'fdsafsa'),
('2014-08-23', 'fsfas'),
('2014-08-28', 'k.mslka'),
('2014-08-30', 'dkjaiw'),
('2014-09-12', 'dさあsv');
