-- MySQL dump 10.13  Distrib 8.4.5, for Win64 (x86_64)
--
-- Host: localhost    Database: maro_adventure
-- ------------------------------------------------------
-- Server version	8.4.5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` text COLLATE utf8mb4_unicode_ci,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tim Maro Adventure',
  `author_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'10 Tips Penting Sebelum Mendaki Gunung Semeru','10-tips-penting-sebelum-mendaki-gunung-semeru','Semeru adalah salah satu gunung tertinggi di Jawa. Persiapan yang matang adalah kunci keselamatan dan kenyamanan perjalananmu.','<p>Gunung Semeru (3.676 mdpl) adalah gunung tertinggi di Pulau Jawa dan salah satu tujuan pendakian paling populer di Indonesia. Sebelum kamu berangkat, ada beberapa hal penting yang wajib dipersiapkan.</p>\n\n<h3>1. Persiapkan Fisik 2-3 Bulan Sebelumnya</h3>\n<p>Pendakian Semeru membutuhkan stamina yang baik. Lakukan latihan jogging, bersepeda, atau mendaki bukit kecil secara rutin setidaknya 2-3 bulan sebelum hari H. Fisik yang prima adalah kunci keselamatan di gunung.</p>\n\n<h3>2. Urus Izin Pendakian</h3>\n<p>Sejak pengelolaan oleh Taman Nasional Bromo Tengger Semeru (TNBTS), semua pendaki wajib mendaftar dan memesan tiket online melalui sistem resmi. Pastikan kamu mendaftar jauh hari karena kuota terbatas.</p>\n\n<h3>3. Perlengkapan Wajib yang Tidak Boleh Ketinggalan</h3>\n<ul>\n<li>Sleeping bag yang sesuai untuk suhu -5°C hingga 10°C</li>\n<li>Jaket gunung yang windproof dan waterproof</li>\n<li>Trekking pole untuk mengurangi beban lutut</li>\n<li>Headlamp dengan baterai cadangan</li>\n<li>P3K lengkap termasuk obat altitude sickness</li>\n<li>Raincoat atau ponco</li>\n</ul>\n\n<h3>4. Perhatikan Kondisi Cuaca</h3>\n<p>Selalu cek prakiraan cuaca 3-7 hari sebelum pendakian. Musim terbaik mendaki Semeru adalah April hingga Oktober (musim kemarau). Hindari mendaki di puncak musim hujan (Desember-Maret).</p>\n\n<h3>5. Bawa Air dan Makanan yang Cukup</h3>\n<p>Sumber air di Semeru terbatas. Isi air di Ranu Kumbolo sebelum melanjutkan ke Kalimati. Bawa minimal 3 liter air per orang dan makanan berkalori tinggi seperti coklat, kacang, dan roti.</p>\n\n<h3>6. Kenali Tandamu Sendiri</h3>\n<p>Altitude sickness bisa menyerang siapa saja. Kenali gejala seperti sakit kepala parah, mual, dan kehilangan keseimbangan. Jika gejala muncul, segera turun dan jangan dipaksakan.</p>\n\n<h3>7. Jaga Kebersihan dan Jangan Tinggalkan Sampah</h3>\n<p>Prinsip Leave No Trace wajib diterapkan. Bawa kantong plastik untuk sampahmu dan bawa kembali turun. Alam Semeru adalah warisan kita bersama.</p>\n\n<h3>8. Tidak Diperbolehkan ke Puncak Mahameru Sendirian</h3>\n<p>Pendakian ke Puncak Mahameru wajib didampingi pemandu atau pergi bersama minimal 3 orang. Jalur Summit Attack sangat terjal dan berbahaya jika dilakukan sendiri.</p>\n\n<h3>9. Patuhi Aturan dan Jalur Resmi</h3>\n<p>Ikuti jalur yang sudah ditentukan dan patuhi semua rambu yang ada. Jangan mendekat ke kawah aktif Jonggring Saloko yang masih aktif.</p>\n\n<h3>10. Daftarkan Diri di Pos Pendakian</h3>\n<p>Selalu laporkan diri dan tim di pos pendakian saat berangkat maupun saat kembali. Ini sangat penting untuk keselamatan dan prosedur SAR jika diperlukan.</p>\n\n<p><strong>Siap mendaki Semeru bersama Maro Adventure?</strong> Tim kami siap memandu perjalananmu dengan aman dan berkesan. Hubungi kami untuk informasi lebih lanjut tentang Open Trip Semeru.</p>','Tips',NULL,NULL,'Tim Maro Adventure',NULL,713,1,'2026-09-29 06:45:25','2026-10-01 06:45:25','2026-10-01 06:45:25'),(2,'Mengenal Jalur Pendakian Gunung Rinjani yang Wajib Kamu Tahu','mengenal-jalur-pendakian-gunung-rinjani-yang-wajib-kamu-tahu','Gunung Rinjani di Lombok menawarkan pemandangan luar biasa dengan danau Segara Anak di puncaknya. Kenali jalurnya sebelum berangkat.','<p>Gunung Rinjani (3.726 mdpl) di Pulau Lombok, Nusa Tenggara Barat, adalah gunung berapi aktif kedua tertinggi di Indonesia. Dengan keindahan Danau Segara Anak di kalderanya, Rinjani adalah salah satu destinasi pendakian paling ikonik di Indonesia.</p>\n\n<h3>Jalur Utama Pendakian Rinjani</h3>\n\n<h4>1. Jalur Senaru (Lombok Utara)</h4>\n<p>Ini adalah jalur paling populer dan menjadi pilihan banyak pendaki. Jalur ini lebih panjang namun pemandangannya sangat memukau. Dari Senaru, pendaki bisa turun ke kaldera dan mencapai Danau Segara Anak.</p>\n\n<h4>2. Jalur Sembalun (Lombok Timur)</h4>\n<p>Jalur Sembalun lebih terbuka dengan padang savana yang luas. Cocok untuk pendaki yang ingin menikmati pemandangan berbeda. Jalur ini juga merupakan jalur paling cepat untuk summit attack ke Puncak Rinjani.</p>\n\n<h4>3. Jalur Torean</h4>\n<p>Jalur alternatif yang lebih menantang dan belum terlalu ramai. Melewati sumber air panas alami dan hutan yang lebih lebat. Sangat direkomendasikan bagi pendaki berpengalaman.</p>\n\n<h3>Yang Harus Kamu Siapkan</h3>\n<ul>\n<li>Izin pendakian dari Taman Nasional Gunung Rinjani</li>\n<li>Perlengkapan camping lengkap (tenda, sleeping bag -10°C)</li>\n<li>Porter atau guide lokal sangat dianjurkan</li>\n<li>Persiapan fisik minimal 3 bulan sebelumnya</li>\n<li>Asuransi perjalanan aktif</li>\n</ul>\n\n<h3>Waktu Terbaik Mendaki</h3>\n<p>April hingga November adalah waktu terbaik untuk mendaki Rinjani. Rinjani ditutup untuk pendakian setiap Desember hingga Maret karena cuaca ekstrem di musim hujan.</p>\n\n<p>Maro Adventure menyediakan layanan Guiding & Portering untuk pendakian Rinjani. Tim kami berpengalaman dan memahami jalur dengan baik. Hubungi kami untuk informasi lebih lanjut.</p>','Gunung',NULL,NULL,'Dani Maro',NULL,276,1,'2026-09-26 06:45:25','2026-10-01 06:45:25','2026-10-08 07:06:08'),(3,'Sunrise di Puncak Gunung Prau: Permadani Awan yang Menakjubkan','sunrise-di-puncak-gunung-prau-permadani-awan-yang-menakjubkan','Gunung Prau di Wonosobo terkenal dengan panorama sunrise-nya yang spektakuler. Perjalanan relatif singkat dengan hasil yang luar biasa.','<p>Gunung Prau (2.565 mdpl) di Kawasan Dataran Tinggi Dieng, Wonosobo, Jawa Tengah, adalah surga bagi pecinta sunrise. Meski tidak setinggi gunung-gunung lainnya, pemandangan dari puncak Prau termasuk yang paling indah di Indonesia.</p>\n\n<h3>Mengapa Prau Sangat Istimewa?</h3>\n<p>Dari puncak Prau, kamu bisa menyaksikan hamparan awan putih bak permadani dengan latar belakang jajaran gunung-gunung Jawa: Sindoro, Sumbing, Merapi, Merbabu, Ungaran, bahkan Lawu di hari yang cerah. Inilah yang membuat Prau selalu ramai dikunjungi.</p>\n\n<h3>Jalur Pendakian</h3>\n<p>Ada beberapa jalur menuju puncak Prau:</p>\n<ul>\n<li><strong>Jalur Patak Banteng</strong> — Paling populer dan relatif mudah. Waktu tempuh sekitar 3-4 jam.</li>\n<li><strong>Jalur Dieng</strong> — Lebih panjang namun pemandangannya berbeda, melewati perkebunan warga.</li>\n<li><strong>Jalur Wates</strong> — Alternatif yang lebih sepi, cocok untuk yang suka ketenangan.</li>\n</ul>\n\n<h3>Tips Menikmati Sunrise di Prau</h3>\n<ul>\n<li>Naik sore hari dan bermalam di tenda untuk menikmati sunrise terbaik</li>\n<li>Bangun pukul 04.00 dan bersiap di puncak sebelum 05.30</li>\n<li>Bawa jaket tebal karena suhu puncak bisa mencapai 5-10°C di malam hari</li>\n<li>Bawa kamera atau tripod untuk mengabadikan momen golden hour</li>\n</ul>\n\n<p>Prau adalah pilihan tepat untuk pendaki pemula maupun yang ingin menikmati alam tanpa jalur yang terlalu ekstrem. Maro Adventure sering mengadakan Open Trip ke Prau, khususnya untuk menikmati sunrise spektakuler ini.</p>','Destinasi',NULL,NULL,'Reza Maro',NULL,366,1,'2026-09-23 06:45:25','2026-10-01 06:45:25','2026-10-08 07:06:03'),(4,'Open Trip Maro: Pendakian Gunung Lawu via Cemoro Sewu','open-trip-maro-pendakian-gunung-lawu-via-cemoro-sewu','Maro Adventure membuka pendaftaran Open Trip Gunung Lawu via Cemoro Sewu untuk bulan November. Kuota terbatas, segera daftar!','<p>Kabar gembira untuk para pecinta pendakian! Maro Adventure kembali membuka pendaftaran Open Trip Gunung Lawu via Cemoro Sewu untuk bulan November 2026.</p>\n\n<h3>Detail Trip</h3>\n<ul>\n<li><strong>Jadwal:</strong> 8-10 November 2026</li>\n<li><strong>Kuota:</strong> 15 peserta (terbatas)</li>\n<li><strong>Harga:</strong> Rp 550.000/orang (all-in dari Karanganyar)</li>\n<li><strong>Estimasi Waktu:</strong> 3 hari 2 malam</li>\n</ul>\n\n<h3>Apa yang Sudah Termasuk?</h3>\n<ul>\n<li>Transportasi Karanganyar PP</li>\n<li>Izin pendakian</li>\n<li>Guide berpengalaman</li>\n<li>Porter (1 porter per 3 orang)</li>\n<li>Tenda dan matras</li>\n<li>Makan selama perjalanan (3x makan besar, 3x snack)</li>\n<li>P3K dan emergency kit</li>\n<li>Dokumentasi trip</li>\n</ul>\n\n<h3>Itinerary Singkat</h3>\n<p><strong>Hari 1:</strong> Briefing, registrasi, dan mulai pendakian dari Cemoro Sewu. Camp di Pos 5 (Cemoro Kandang).</p>\n<p><strong>Hari 2:</strong> Summit attack ke Puncak Hargo Dumilah (3.265 mdpl). Turun dan camp di Pos 3.</p>\n<p><strong>Hari 3:</strong> Turun gunung, kembali ke Karanganyar.</p>\n\n<h3>Cara Daftar</h3>\n<p>Hubungi Maro Adventure melalui WhatsApp di nomor +62 858 9453 5172 atau DM Instagram @maroadventureindonesia. Sertakan nama lengkap, nomor HP, dan pengalaman mendaki sebelumnya.</p>\n\n<p><em>Kuota terbatas! Segera daftarkan dirimu sebelum penuh.</em></p>','Berita',NULL,NULL,'Tim Maro Adventure',NULL,230,1,'2026-09-30 06:45:25','2026-10-01 06:45:25','2026-10-01 06:45:25'),(5,'Mengenal Kearifan Lokal Masyarakat Sekitar Gunung Merapi','mengenal-kearifan-lokal-masyarakat-sekitar-gunung-merapi','Di balik gagahnya Merapi, tersimpan tradisi dan kepercayaan lokal yang kaya. Belajar menghormati alam dan budaya setempat sebelum mendaki.','<p>Gunung Merapi bukan hanya gunung berapi aktif yang megah secara geologis — ia juga merupakan pusat dari kepercayaan dan tradisi budaya yang telah berlangsung selama berabad-abad di kalangan masyarakat Jawa.</p>\n\n<h3>Mbah Marijan dan Juru Kunci Merapi</h3>\n<p>Nama Mbah Marijan mungkin sudah tidak asing. Ia adalah juru kunci terakhir yang paling dikenal dari Merapi, yang gugur saat erupsi 2010. Tradisi juru kunci ini merupakan bagian dari sistem kepercayaan masyarakat Jawa yang percaya bahwa Merapi memiliki \"penunggu\" atau penguasa spiritual.</p>\n\n<h3>Labuhan: Ritual Persembahan</h3>\n<p>Setiap tahun, Keraton Yogyakarta mengadakan upacara Labuhan di lereng Merapi sebagai bentuk penghormatan dan permohonan keselamatan. Ini adalah tradisi yang sudah berlangsung ratusan tahun dan masih dilestarikan hingga kini.</p>\n\n<h3>Kepercayaan Masyarakat Lokal</h3>\n<p>Masyarakat sekitar Merapi memiliki berbagai kepercayaan yang perlu dihormati oleh para pendaki:</p>\n<ul>\n<li>Tidak boleh mengenakan pakaian berwarna hijau (warna yang dipercaya sebagai warna penguasa alam gaib)</li>\n<li>Tidak boleh berbicara sembarangan atau berkata-kata kasar</li>\n<li>Selalu minta izin secara batin sebelum memasuki kawasan gunung</li>\n<li>Jangan mengambil apapun dari gunung selain foto dan kenangan</li>\n</ul>\n\n<h3>Belajar dari Kearifan Lokal</h3>\n<p>Sebagai pendaki, menghormati kepercayaan dan adat setempat bukan berarti kita harus ikut mempercayainya — namun menunjukkan rasa hormat kita terhadap budaya dan masyarakat yang telah hidup berdampingan dengan alam ini jauh sebelum kita datang.</p>\n\n<p>Maro Adventure selalu mengajak pesertanya untuk mengenal dan menghormati kearifan lokal di setiap destinasi yang dikunjungi. Karena perjalanan yang baik bukan hanya tentang mencapai puncak, tapi juga tentang memahami cerita di baliknya.</p>','Budaya',NULL,NULL,'Sari Maro',NULL,193,1,'2026-09-19 06:45:25','2026-10-01 06:45:25','2026-10-08 07:05:36'),(6,'Panduan Lengkap Camping di Alam Terbuka untuk Pemula','panduan-lengkap-camping-di-alam-terbuka-untuk-pemula','Belum pernah camping? Tidak perlu khawatir. Panduan ini akan membantu kamu mempersiapkan diri untuk pengalaman camping pertama yang menyenangkan.','<p>Camping di alam terbuka adalah salah satu cara terbaik untuk melepas penat dan mendekatkan diri dengan alam. Tapi bagi pemula, persiapan yang tepat sangat penting agar pengalaman pertamamu menyenangkan dan aman.</p>\n\n<h3>Perlengkapan Camping Dasar</h3>\n<ul>\n<li><strong>Tenda</strong> — Pilih tenda dome untuk pemula karena mudah dipasang. Pastikan waterproof.</li>\n<li><strong>Sleeping bag</strong> — Sesuaikan dengan suhu lokasi camping. Untuk dataran tinggi, pilih yang tahan -5°C.</li>\n<li><strong>Matras</strong> — Penting untuk insulasi dari tanah dingin.</li>\n<li><strong>Kompor portable dan bahan bakar</strong> — Untuk memasak di camp.</li>\n<li><strong>Headlamp</strong> — Wajib! Bawa baterai cadangan.</li>\n<li><strong>P3K dasar</strong> — Plester, antiseptik, obat nyeri, dan obat diare.</li>\n</ul>\n\n<h3>Memilih Lokasi Camping</h3>\n<p>Sebagai pemula, pilih lokasi camping yang:</p>\n<ul>\n<li>Legal dan resmi (ada izin dari pengelola)</li>\n<li>Tidak terlalu jauh dari fasilitas (toilet, sumber air)</li>\n<li>Sudah dikenal dan banyak dikunjungi (lebih aman)</li>\n<li>Tidak di bawah pohon besar atau di pinggir sungai (bahaya)</li>\n</ul>\n\n<h3>Tips Memasak di Alam</h3>\n<p>Makanan camping yang praktis dan lezat: nasi, mie instan, oatmeal, sarden, coklat, dan berbagai camilan berkalori tinggi. Masak air minum dari sumber alami menggunakan kompor atau water purifier.</p>\n\n<h3>Leave No Trace</h3>\n<p>Ini adalah prinsip paling penting dalam camping: tinggalkan alam seperti sebelum kamu datang. Tidak membuang sampah sembarangan, tidak merusak tumbuhan, dan tidak meninggalkan bekas api.</p>\n\n<p>Maro Adventure sering mengadakan camping trip untuk berbagai kalangan, termasuk pemula. Bergabunglah dengan kami untuk pengalaman camping yang aman, seru, dan berkesan!</p>','Tips',NULL,NULL,'Tim Maro Adventure',NULL,173,1,'2026-09-16 06:45:25','2026-10-01 06:45:25','2026-10-08 07:48:17'),(7,'Keindahan Tersembunyi Kawah Ijen: Fenomena Blue Fire yang Memukau','keindahan-tersembunyi-kawah-ijen-fenomena-blue-fire-yang-memukau','Kawah Ijen di Banyuwangi terkenal dengan fenomena api biru (blue fire) yang hanya bisa dilihat pada dini hari. Ini panduan lengkap kunjungannya.','<p>Kawah Ijen di Banyuwangi, Jawa Timur, adalah salah satu keajaiban alam paling unik di dunia. Di sini terdapat fenomena \"blue fire\" atau api biru — satu-satunya fenomena api biru yang dapat dilihat oleh mata manusia di muka bumi.</p>\n\n<h3>Apa itu Blue Fire?</h3>\n<p>Blue fire bukan api dari magma yang berwarna biru, melainkan gas belerang yang keluar dari celah-celah kawah dengan tekanan dan suhu sangat tinggi (di atas 600°C), kemudian terbakar saat bersentuhan dengan udara dan menghasilkan nyala api berwarna biru yang sangat indah.</p>\n\n<h3>Kapan Bisa Melihat Blue Fire?</h3>\n<p>Blue fire hanya terlihat pada kondisi gelap gulita, yaitu antara pukul 02.00 dini hari hingga menjelang fajar sekitar pukul 05.00. Setelah matahari terbit, nyala api biru tidak akan terlihat karena cahaya matahari yang lebih dominan.</p>\n\n<h3>Panduan Berkunjung</h3>\n<ul>\n<li><strong>Jam masuk:</strong> Parkiran Paltuding buka pukul 01.00 dini hari untuk pengunjung yang ingin melihat blue fire</li>\n<li><strong>Durasi trekking:</strong> Sekitar 1,5-2 jam dari Paltuding ke bibir kawah</li>\n<li><strong>Wajib pakai masker gas</strong> karena gas belerang sangat berbahaya untuk pernapasan</li>\n<li><strong>Bawa senter/headlamp</strong> karena jalur dalam kondisi gelap</li>\n<li><strong>Gunakan jaket tebal</strong> karena suhu pagi hari di kawasan ini sangat dingin</li>\n</ul>\n\n<h3>Danau Kawah Ijen</h3>\n<p>Selain blue fire, Kawah Ijen juga memiliki danau kawah berwarna hijau toska yang sangat cantik. Ini adalah danau asam vulkanik terbesar di dunia dengan pH yang sangat rendah (hampir nol). Jangan pernah mencoba menyentuh airnya!</p>\n\n<h3>Penambang Belerang Ijen</h3>\n<p>Pengalaman mengunjungi Ijen tidak lengkap tanpa mengenal para penambang belerang yang setiap harinya memanggul beban belerang 70-100 kg dari dalam kawah. Mereka adalah bagian dari cerita Ijen yang sesungguhnya.</p>\n\n<p>Maro Adventure menyediakan paket kunjungan ke Kawah Ijen yang terorganisir dan aman. Hubungi kami untuk informasi lebih lanjut.</p>','Destinasi',NULL,NULL,'Dani Maro',NULL,664,1,'2026-09-11 06:45:25','2026-10-01 06:45:25','2026-10-08 07:04:59'),(8,'Maro Adventure Raih Kepercayaan 500+ Peserta di Tahun 2025','maro-adventure-raih-kepercayaan-500-peserta-di-tahun-2025','Menutup tahun 2025, Maro Adventure berhasil melayani lebih dari 500 peserta dalam berbagai program perjalanan. Terima kasih atas kepercayaannya!','<p>Tahun 2025 menjadi tahun yang penuh pencapaian bagi Maro Adventure Indonesia. Dengan penuh rasa syukur, kami mengumumkan bahwa total peserta yang telah bergabung dalam berbagai program perjalanan Maro sepanjang tahun 2025 telah melampaui angka 500 orang.</p>\n\n<h3>Perjalanan Panjang Maro Adventure</h3>\n<p>Sejak pertama kali beroperasi, Maro Adventure selalu berkomitmen untuk menghadirkan pengalaman perjalanan yang aman, berkesan, dan bermakna. Pencapaian 500+ peserta ini adalah bukti kepercayaan yang telah diberikan oleh banyak pihak kepada kami.</p>\n\n<h3>Program yang Paling Diminati</h3>\n<ul>\n<li><strong>Open Trip Pendakian</strong> — Program paling populer, dengan destinasi favorit Semeru, Lawu, dan Prau</li>\n<li><strong>Team Building Corporate</strong> — Semakin banyak perusahaan dan organisasi yang mempercayakan kegiatan outdoor mereka kepada Maro</li>\n<li><strong>Private Trip Keluarga</strong> — Program yang terus berkembang dengan permintaan yang meningkat</li>\n<li><strong>Guiding & Portering</strong> — Layanan pendampingan profesional yang semakin diminati</li>\n</ul>\n\n<h3>Ucapan Terima Kasih</h3>\n<p>Pencapaian ini tidak mungkin terwujud tanpa kepercayaan dari setiap peserta yang telah memilih Maro Adventure sebagai teman perjalanan mereka. Terima kasih telah mempercayai kami untuk menemanimu menjelajahi alam Indonesia yang luar biasa.</p>\n\n<h3>Yang Akan Datang di 2026</h3>\n<p>Di tahun 2026, Maro Adventure berencana untuk menghadirkan lebih banyak program baru, memperluas jangkauan destinasi, dan terus meningkatkan kualitas pelayanan. Nantikan pengumuman program-program menarik dari kami!</p>\n\n<p>Tetap ikuti perkembangan Maro Adventure di Instagram <strong>@maroadventureindonesia</strong> dan hubungi kami langsung di WhatsApp +62 858 9453 5172 untuk informasi lebih lanjut.</p>','Berita',NULL,NULL,'Tim Maro Adventure',NULL,628,1,'2026-09-06 06:45:25','2026-10-01 06:45:25','2026-10-01 06:45:25');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `trip_id` bigint unsigned NOT NULL,
  `booking_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_date` date NOT NULL,
  `participants` int NOT NULL DEFAULT '1',
  `total_price` bigint NOT NULL DEFAULT '0',
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_booking_code_unique` (`booking_code`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_trip_id_foreign` (`trip_id`),
  CONSTRAINT `bookings_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_posts`
--

DROP TABLE IF EXISTS `community_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','hidden') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `community_posts_user_id_foreign` (`user_id`),
  CONSTRAINT `community_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_posts`
--

LOCK TABLES `community_posts` WRITE;
/*!40000 ALTER TABLE `community_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `community_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_01_133515_create_articles_table',1),(5,'2026_10_01_140354_add_phone_and_role_to_users_table',2),(6,'2026_10_01_142519_add_google_id_to_users_table',3),(7,'2026_10_07_000000_create_mountains_table',4),(8,'2026_10_07_000001_create_trips_table',4),(9,'2026_10_07_000002_create_bookings_table',4),(10,'2026_10_07_000003_create_payments_table',4),(11,'2026_10_07_000004_create_articles_table',4),(12,'2026_10_07_000005_create_rewards_table',4),(13,'2026_10_07_000006_add_points_to_users_table',4),(14,'2026_10_07_000007_create_community_posts_table',4),(15,'2026_10_11_000008_add_gallery_to_articles_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mountains`
--

DROP TABLE IF EXISTS `mountains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mountains` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elevation` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mountains`
--

LOCK TABLES `mountains` WRITE;
/*!40000 ALTER TABLE `mountains` DISABLE KEYS */;
INSERT INTO `mountains` VALUES (1,'Gunung Burangrang','Bandung Barat, Jawa Barat',2050,'Gunung dengan ketinggian 2.050 MDPL di kawasan Bandung Barat yang menyajikan panorama alam dan Danau Situ Lembang.',NULL,1,'2026-10-16 05:26:22','2026-10-16 05:26:22');
/*!40000 ALTER TABLE `mountains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','verified','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_booking_id_foreign` (`booking_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rewards`
--

DROP TABLE IF EXISTS `rewards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rewards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `points_required` int NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rewards`
--

LOCK TABLES `rewards` WRITE;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mountain_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_mountain_id_foreign` (`mountain_id`),
  CONSTRAINT `trips_mountain_id_foreign` FOREIGN KEY (`mountain_id`) REFERENCES `mountains` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (1,1,'Burangrang Weekend Camp & Trekking','2 Hari 1 Malam',350000,1,'Pendakian santai dan camp di puncak Gunung Burangrang dengan pemandangan sunrise Danau Situ Lembang.',NULL,'2026-10-16 05:26:22','2026-10-16 05:26:22'),(2,1,'Burangrang One Day Sunrise Expedition','1 Hari (Sunrise)',220000,1,'Trekking malam mengejar golden sunrise spektakuler di puncak Burangrang 2.050 MDPL.',NULL,'2026-10-16 05:26:22','2026-10-16 05:26:22');
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `points` int NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','superadmin123@maroadventure.com',NULL,NULL,NULL,'$2y$12$qwgnkkfWcio3ZtTVm8AIU.ODvZpTgefGLA.wnmKgu0UI5LK1PVax6','superadmin',0,NULL,NULL,'2026-10-06 21:00:36','2026-10-16 05:31:01'),(2,'Administrator','admin123@maroadventure.com',NULL,NULL,NULL,'$2y$12$7GJuy3yhj2QJ/Ms3qTpB9OXGUrM3CO/datHilnsK9CUi7dUteU6/m','admin',0,NULL,NULL,'2026-10-06 21:04:49','2026-10-16 05:31:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-16 19:41:23
