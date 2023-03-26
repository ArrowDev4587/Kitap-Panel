-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Mar 2023, 19:13:42
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kutuphane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap`
--

CREATE TABLE `kitap` (
  `id` int(11) NOT NULL,
  `kitap_adi` varchar(60) NOT NULL,
  `yazar` varchar(60) NOT NULL,
  `basim_yili` varchar(60) NOT NULL,
  `sayfa_sayisi` varchar(60) NOT NULL,
  `kitap_adet` int(11) NOT NULL,
  `eklenme_tarihi` varchar(60) NOT NULL,
  `guncelleme_tarihi` varchar(500) NOT NULL,
  `kapak_yolu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kitap`
--

INSERT INTO `kitap` (`id`, `kitap_adi`, `yazar`, `basim_yili`, `sayfa_sayisi`, `kitap_adet`, `eklenme_tarihi`, `guncelleme_tarihi`, `kapak_yolu`) VALUES
(1, 'Define Adası', 'Robert Louis Stevenson', '2007', '1912 KSK', 0, '2023/03/17', '2023/03/22', 'images/ksk447.jpg'),
(7, 'Robinson Crusoe', 'Daniel Defoe', '1719', '1912', 35, '2023/03/22', '2023/03/22', 'images/q7829.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kitap`
--
ALTER TABLE `kitap`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kitap`
--
ALTER TABLE `kitap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
