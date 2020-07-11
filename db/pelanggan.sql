SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `kab` varchar(255) NOT NULL,
  `kec` varchar(225) NOT NULL,
  `desa` varchar(255) NOT NULL,
  `prov_id` int NOT NULL,
  `kab_id` int NOT NULL,
  `kec_id` int NOT NULL,
  `desa_id` int NOT NULL,
  `koordinat` text NOT NULL,
  `alamat` text NOT NULL,
  `alat_biaya` int NOT NULL,
  `nik` varchar(255) NOT NULL,
  `kk` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `kordinat` varchar(255) NOT NULL,
  `foto_pelanggan` varchar(255) NOT NULL,
  `foto_rumah` varchar(255) NOT NULL,
  `no_pelanggan` varchar(255) NOT NULL,
  `active` tinyint NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
