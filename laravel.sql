-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for laravel
DROP DATABASE IF EXISTS `laravel`;
CREATE DATABASE IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravel`;

-- Dumping structure for table laravel.customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.customers: ~1 rows (approximately)
DELETE FROM `customers`;
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 'Bagas', 'Bagas@gmail.com', '0895890206', 'Jalan Kopo No 20', 'customers/AgU9lYu4VGdhilNUwbOZ2SP0ULhxS1ZXgqMoHFyN.jpg', '2024-12-05 08:57:59', '2024-12-05 11:27:15'),
	(2, 'Andi Wijaya', 'andi.wijaya@example.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', 'customers/AbBO6oxklzJVsqJOkV9oPvATVBjg1ThIfWGNXCM1.jpg', '2024-12-05 18:10:54', '2024-12-05 18:10:54'),
	(3, 'Budi Santoso', 'budi.santoso@example.com', '081234567891', 'Jl. Sudirman No. 20, Bandung', 'customers/oGA5cXZpRXOeSB2qhLMNHrbh9PjPwazU8Yxjw3NZ.jpg', '2024-12-05 18:11:22', '2024-12-05 18:11:22'),
	(4, 'Citra Dewi', 'citra.dewi@example.com', '081234567892', 'Jl. Diponegoro No. 15, Surabaya', 'customers/iIVqTAjCVGUUn4glNx3kmbaVyepF3ukth0WmvbcB.jpg', '2024-12-05 18:11:49', '2024-12-05 18:11:49'),
	(5, 'Dedi Pratama', 'dedi.pratama@example.com', '081234567893', 'Jl. Gatot Subroto No. 5, Medan', 'customers/T7cQLvf7X74ZsCD5LewTXK42tVl5yYD0VLlMDDLT.jpg', '2024-12-05 18:12:16', '2024-12-05 18:12:16'),
	(6, 'Evi Lestari', 'evi.lestari@example.com', '081234567894', 'Jl. Ahmad Yani No. 25, Yogyakarta', 'customers/qigmOWZSUiy33uejPURxdhkZgxtSMmvTIV2Xz5WJ.jpg', '2024-12-05 18:16:41', '2024-12-05 18:16:41'),
	(7, 'Fajar Nugroho', 'fajar.nugroho@example.com', '081234567895', 'Jl. Pahlawan No. 30, Semaran', 'customers/PwUAjWFZILJWDXlPa6exph5Y0Pn1ckSUATuPDKSn.jpg', '2024-12-05 18:17:18', '2024-12-05 18:17:18'),
	(8, 'Hadi Saputra', 'hadi.saputra@example.com', '081234567897', 'Jl. Sisingamangaraja No. 8, Makassar', 'customers/BbYRcuEkJhruKDbY7heZ6VGc0UhxwykIBNdy40fG.jpg', '2024-12-05 18:17:42', '2024-12-05 18:17:42'),
	(9, 'Joko Susilo', 'joko.susilo@example.com', '081234567897', 'Jl. Sisingamangaraja No. 8, Makassar', 'customers/eyNaYA5VrbmqtX5JwVVXewJBfyZCwjSF9pWb84WS.jpg', '2024-12-05 18:18:00', '2024-12-05 18:18:10'),
	(10, 'Kurniawan Putra', 'kurniawan.putra@example.com', '081234567800', 'Jl. Merpati No. 10, Jakarta', 'customers/n2GHCSeQEtKVQUoCVPdg5KzaMw1TmwUs8UYdGlgQ.jpg', '2024-12-05 18:22:17', '2024-12-05 18:24:00'),
	(11, 'Mulyadi Pratama', 'mulyadi.pratama@example.com', '081234567802', 'Jl. Anggrek No. 15, Surabaya', 'customers/JX7zynh9gqBolNxAetUswKFqNfl35jLuaQxv6QML.jpg', '2024-12-05 18:26:28', '2024-12-05 18:26:28'),
	(12, 'Harambe', 'harambe@example.com', '081234567803', 'Jl. Melati No. 5, Medan', 'customers/O8x535RnkBhqnvtPMZ9P9jZ2PE4BWzx0sDNpHiSL.jpg', '2024-12-05 18:27:42', '2024-12-05 18:27:42'),
	(13, 'Waduh', 'waduh@example.com', '081234567805', 'Jl. Dahlia No. 12, Malang', 'customers/8i0ZN6NXmW1PisY4WOP0NyFSS5UuOqnFphMI4BHH.jpg', '2024-12-05 18:31:04', '2024-12-05 18:31:04'),
	(14, 'Batubara', 'batubara@example.com', '081234567808', 'Jl. Cempaka No. 18, Denpasar', 'customers/LptANAqoUGEjPvlJKDsUPrzoDpZHzKSt1UC6zbvQ.jpg', '2024-12-05 18:32:16', '2024-12-05 18:32:16'),
	(15, 'Kucing Barusadar', 'kucing@example.com', '081234567809', 'Jl. Bougenville No. 22, Palembang', 'customers/DJVNIJjLpBzEqXmyMde8PWDAAqMP5oHz29VR3gNa.jpg', '2024-12-05 18:34:03', '2024-12-05 18:34:03');

-- Dumping structure for table laravel.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table laravel.films
DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_year` int NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rental_price` decimal(10,2) NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `films_genre_id_foreign` (`genre_id`),
  CONSTRAINT `films_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.films: ~11 rows (approximately)
DELETE FROM `films`;
INSERT INTO `films` (`id`, `title`, `director`, `release_year`, `rating`, `description`, `stock`, `price`, `rental_price`, `poster`, `created_at`, `updated_at`, `genre_id`) VALUES
	(1, 'Moana', 'Ron Clements, John Musker', 2016, 7.6, 'Moana adalah film animasi musikal yang dirilis oleh Disney pada tahun 2016. Film ini menceritakan tentang seorang gadis muda bernama Moana Waialiki, yang berlayar melintasi lautan untuk menyelamatkan pulau dan rakyatnya. Dalam perjalanannya, ia bertemu dengan Maui, seorang setengah dewa yang membantu Moana dalam misinya.', 16, 120000.00, 40000.00, 'posters/Xty4B1gpX6DAjW5X7j9G7aCdzhsILBSmGNPFdwfX.jpg', '2024-12-05 08:41:33', '2024-12-05 18:55:23', 2),
	(2, 'Batman Begins', 'Christopher Nolan', 2005, 8.2, 'Batman Begins adalah film superhero tahun 2005 yang disutradarai oleh Christopher Nolan. Film ini menceritakan asal-usul Bruce Wayne menjadi Batman dan perjuangannya melawan kejahatan di Gotham City.', 11, 150000.00, 50000.00, 'posters/75fuYZn3AvuZcB0iT3ZUnlQq5p3zDCb2NopwT3lT.jpg', '2024-12-05 10:43:25', '2024-12-05 18:54:47', 1),
	(3, 'Transformers: Rise of the Beasts', 'Steven Caple Jr.', 2023, 6.0, 'Transformers: Rise of the Beasts adalah film fiksi ilmiah aksi yang dirilis pada tahun 2023. Film ini mengikuti petualangan Autobots dan Maximals dalam melindungi artefak yang dikenal sebagai Transwarp Key dari Terrorcons yang jahat. Film ini berlatar tahun 1994 dan menampilkan karakter-karakter baru serta kembalinya beberapa karakter lama dari seri Transformers.', 20, 180000.00, 60000.00, 'posters/big5RQm867zw9GGJoPNvmCiS7aKFgmZAywA5854L.jpg', '2024-12-05 10:46:08', '2024-12-05 10:46:08', 1),
	(4, 'We\'re the Millers', 'Rawson Marshall Thurber', 2013, 7.0, 'We\'re the Millers adalah film komedi yang dirilis pada tahun 2013. Film ini menceritakan tentang seorang pengedar narkoba kecil-kecilan yang merekrut tetangganya untuk berpura-pura menjadi keluarganya agar dapat menyelundupkan sejumlah besar ganja dari Meksiko ke Amerika Serikat. Dalam perjalanan mereka, berbagai kejadian lucu dan tak terduga terjadi.', 12, 100000.00, 35000.00, 'posters/BD1LhQzJ7SNgzluM2j2lR8Ye3vl2oce8STEU8a6J.jpg', '2024-12-05 10:48:39', '2024-12-05 10:48:39', 2),
	(5, 'Interstellar', 'Christopher Nolan', 2014, 8.6, 'Interstellar adalah film fiksi ilmiah yang dirilis pada tahun 2014. Film ini menceritakan tentang sekelompok penjelajah luar angkasa yang melakukan perjalanan melalui lubang cacing untuk mencari planet baru yang dapat dihuni oleh manusia, karena Bumi sedang mengalami krisis lingkungan yang parah. Film ini menampilkan visual yang menakjubkan dan cerita yang mendalam tentang cinta, pengorbanan, dan eksplorasi.', 9, 200000.00, 70000.00, 'posters/8eR97AMQQaXkfdS10Hxzwyv4cCvyBQuKAjVzNNwA.jpg', '2024-12-05 10:52:15', '2024-12-05 18:54:48', 5),
	(6, 'Us', 'Jordan Peele', 2019, 6.8, 'Us adalah film horor psikologis yang dirilis pada tahun 2019. Film ini menceritakan tentang keluarga Wilson yang pergi berlibur ke Santa Cruz, California. Pada malam hari, empat orang asing masuk ke rumah masa kecil Adelaide, dan keluarga tersebut terkejut mengetahui bahwa para penyusup tersebut terlihat seperti mereka, hanya dengan penampilan yang mengerikan.', 10, 130000.00, 45000.00, 'posters/LrC8hFHrUXAP4h60EawRp45Y3FCi0aUyqfhZgup5.jpg', '2024-12-05 10:54:57', '2024-12-05 10:54:57', 4),
	(7, 'Josee, the Tiger and the Fish', 'Kotaro Tamura', 2020, 7.6, 'Josee, the Tiger and the Fish adalah film animasi drama romantis yang dirilis pada tahun 2020. Film ini menceritakan tentang Tsuneo Suzukawa, seorang mahasiswa yang bekerja paruh waktu di sebuah toko menyelam. Suatu malam, ia menyelamatkan seorang wanita paraplegik bernama Kumiko Yamamura, yang lebih suka dipanggil Josee. Tsuneo kemudian menjadi pengurus Josee dan membantu mewujudkan mimpinya untuk menjelajahi dunia luar.', 11, 140000.00, 45000.00, 'posters/AS52kL16TXK9nv3xDvz18mj0QAfFiU8HpJUaaYAM.jpg', '2024-12-05 10:57:10', '2024-12-05 18:43:14', 3),
	(8, 'Spider-Man: Into the Spider-Verse', 'Bob Persichetti, Peter Ramsey, Rodney Rothman', 2018, 8.4, 'Spider-Man: Into the Spider-Verse adalah film animasi superhero yang dirilis pada tahun 2018. Film ini mengikuti kisah Miles Morales, seorang remaja yang menjadi Spider-Man di dunianya dan harus bergabung dengan lima individu bertenaga laba-laba dari dimensi lain untuk menghentikan ancaman bagi semua realitas.', 15, 160000.00, 55000.00, 'posters/FKK9o4oNnlnNHXulxrdUFgOp4l3vh65NrAs9NJfv.jpg', '2024-12-05 11:00:54', '2024-12-05 11:00:54', 1),
	(9, 'Everything Everywhere All at Once', 'Daniel Kwan, Daniel Scheinert', 2022, 7.8, 'Everything Everywhere All at Once adalah film komedi-drama absurd yang dirilis pada tahun 2022. Film ini menceritakan tentang Evelyn Quan Wang, seorang imigran Tionghoa-Amerika yang menemukan bahwa dia harus terhubung dengan versi dirinya dari alam semesta paralel untuk mencegah makhluk kuat menghancurkan multiverse. Film ini menggabungkan elemen dari berbagai genre dan media film, termasuk komedi surealis, fiksi ilmiah, fantasi, film seni bela diri, narasi imigran, dan animasi.', 11, 150000.00, 50000.00, 'posters/YswkG10WNf3IG66Uj7C47gzkml5CpnEmISpiAGZu.jpg', '2024-12-05 11:03:08', '2024-12-05 18:54:45', 3),
	(10, 'Amélie', 'Jean-Pierre Jeunet', 2001, 8.3, 'Amélie adalah film komedi romantis yang dirilis pada tahun 2001. Film ini menceritakan tentang seorang wanita muda bernama Amélie Poulain yang tinggal di Paris. Dia memutuskan untuk mengabdikan hidupnya untuk membuat orang-orang di sekitarnya bahagia, sambil mencari cinta dan kebahagiaan untuk dirinya sendiri. Film ini terkenal karena visualnya yang unik dan cerita yang menyentuh hati.', 11, 120000.00, 40000.00, 'posters/QDjvImWTiwD9A14oMg2hloU3rSZL4I9WLFFlesLJ.jpg', '2024-12-05 11:04:37', '2024-12-05 18:54:49', 2),
	(11, 'The Terminator', 'James Cameron', 1984, 8.1, 'The Terminator adalah film fiksi ilmiah aksi yang dirilis pada tahun 1984. Film ini menceritakan tentang seorang cyborg pembunuh yang dikirim dari masa depan ke tahun 1984 untuk membunuh Sarah Connor, yang anaknya akan menjadi penyelamat umat manusia dalam perang melawan mesin di masa depan. Seorang prajurit dari masa depan juga dikirim untuk melindungi Sarah dari ancaman tersebut.', 10, 150000.00, 50000.00, 'posters/EVvOTFsV71ZKjv8NNX5QHWqZ3IiuzKpi5RYuUVbm.jpg', '2024-12-05 11:06:45', '2024-12-05 11:06:45', 5);

-- Dumping structure for table laravel.genres
DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.genres: ~5 rows (approximately)
DELETE FROM `genres`;
INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Action', NULL, NULL),
	(2, 'Comedy', NULL, NULL),
	(3, 'Drama', NULL, NULL),
	(4, 'Horror', NULL, NULL),
	(5, 'Sci-Fi', NULL, NULL);

-- Dumping structure for table laravel.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_11_02_050756_create_genres_table', 1),
	(7, '2024_11_02_050803_create_films_table', 1),
	(8, '2024_11_02_050845_create_customers_table', 1),
	(9, '2024_11_02_050848_create_rentals_table', 1),
	(10, '2024_11_02_050852_create_sales_table', 1),
	(11, '2024_11_03_102420_add_rental_id_to_sales_table', 1),
	(12, '2024_11_03_112205_add_invoice_number_to_sales_table', 1),
	(13, '2024_12_05_101030_alter_films_table', 1),
	(14, '2024_12_06_112205_update_films_table_add_genre_relation', 1);

-- Dumping structure for table laravel.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table laravel.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table laravel.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table laravel.rentals
DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `film_id` bigint unsigned NOT NULL,
  `rental_date` date NOT NULL,
  `return_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `rental_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `late_fee` decimal(10,2) DEFAULT NULL,
  `status` enum('ongoing','returned','overdue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_customer_id_foreign` (`customer_id`),
  KEY `rentals_film_id_foreign` (`film_id`),
  CONSTRAINT `rentals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rentals_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.rentals: ~0 rows (approximately)
DELETE FROM `rentals`;
INSERT INTO `rentals` (`id`, `customer_id`, `film_id`, `rental_date`, `return_date`, `actual_return_date`, `rental_fee`, `late_fee`, `status`, `created_at`, `updated_at`) VALUES
	(1, 12, 7, '2024-12-06', '2024-12-13', '2024-12-06', 315000.00, 0.00, 'returned', '2024-12-05 18:39:43', '2024-12-05 18:43:13'),
	(2, 6, 1, '2024-12-06', '2024-12-13', '2024-12-06', 280000.00, 0.00, 'returned', '2024-12-05 18:43:23', '2024-12-05 18:54:50'),
	(3, 13, 10, '2024-12-06', '2024-12-13', '2024-12-06', 280000.00, 0.00, 'returned', '2024-12-05 18:43:30', '2024-12-05 18:54:49'),
	(4, 14, 5, '2024-12-06', '2024-12-13', '2024-12-06', 490000.00, 0.00, 'returned', '2024-12-05 18:43:40', '2024-12-05 18:54:48'),
	(5, 11, 2, '2024-12-06', '2024-12-13', '2024-12-06', 350000.00, 0.00, 'returned', '2024-12-05 18:48:08', '2024-12-05 18:54:47'),
	(6, 1, 9, '2024-12-06', '2024-12-13', '2024-12-06', 350000.00, 0.00, 'returned', '2024-12-05 18:48:18', '2024-12-05 18:54:45'),
	(7, 2, 1, '2024-12-06', '2024-12-13', '2024-12-06', 280000.00, 0.00, 'returned', '2024-12-05 18:55:04', '2024-12-05 18:55:23'),
	(8, 4, 1, '2024-12-06', '2024-12-13', '2024-12-06', 280000.00, 0.00, 'returned', '2024-12-05 18:55:12', '2024-12-05 18:55:14');

-- Dumping structure for table laravel.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `film_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rental_id` bigint unsigned DEFAULT NULL,
  `status` enum('ongoing','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  PRIMARY KEY (`id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_film_id_foreign` (`film_id`),
  KEY `sales_rental_id_foreign` (`rental_id`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sales_film_id_foreign` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sales_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.sales: ~0 rows (approximately)
DELETE FROM `sales`;
INSERT INTO `sales` (`id`, `invoice_number`, `customer_id`, `film_id`, `quantity`, `total_price`, `payment_status`, `created_at`, `updated_at`, `rental_id`, `status`) VALUES
	(1, NULL, 12, 7, 1, 315000.00, 'paid', '2024-12-05 18:39:43', '2024-12-05 18:43:14', 1, 'paid'),
	(2, NULL, 6, 1, 1, 280000.00, 'paid', '2024-12-05 18:43:23', '2024-12-05 18:54:50', 2, 'paid'),
	(3, NULL, 13, 10, 1, 280000.00, 'paid', '2024-12-05 18:43:30', '2024-12-05 18:54:49', 3, 'paid'),
	(4, NULL, 14, 5, 1, 490000.00, 'paid', '2024-12-05 18:43:40', '2024-12-05 18:54:48', 4, 'paid'),
	(5, NULL, 11, 2, 1, 350000.00, 'paid', '2024-12-05 18:48:08', '2024-12-05 18:54:47', 5, 'paid'),
	(6, NULL, 1, 9, 1, 350000.00, 'paid', '2024-12-05 18:48:18', '2024-12-05 18:54:45', 6, 'paid'),
	(7, NULL, 2, 1, 1, 280000.00, 'paid', '2024-12-05 18:55:04', '2024-12-05 18:55:23', 7, 'paid'),
	(8, NULL, 4, 1, 1, 280000.00, 'paid', '2024-12-05 18:55:12', '2024-12-05 18:55:14', 8, 'paid');

-- Dumping structure for table laravel.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Asep', 'asep@gmail.com', NULL, '$2y$12$iZLXpWG/Abkwphz1LjkyTeTJTCuGj.QAZaYF10J9/nUgOmvQbKBRy', NULL, '2024-12-05 09:58:02', '2024-12-05 09:58:02'),
	(2, 'asep', 'asep@gmai.com', NULL, '$2y$12$Iu8lzyiuUJE9uMYCTlDG1OquJRWQTt9P3phKDkbOb/eKZDz6G6GF.', NULL, '2024-12-05 18:07:01', '2024-12-05 18:07:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
