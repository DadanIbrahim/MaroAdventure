<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [

            // ── GUNUNG ──────────────────────────────────────────────────────
            [
                'title' => '10 Tips Penting Sebelum Mendaki Gunung Semeru',
                'category' => 'Tips',
                'excerpt' => 'Semeru adalah salah satu gunung tertinggi di Jawa. Persiapan yang matang adalah kunci keselamatan dan kenyamanan perjalananmu.',
                'content' => $this->contentTipsSemeru(),
                'author_name' => 'Tim Maro Adventure',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Mengenal Jalur Pendakian Gunung Rinjani yang Wajib Kamu Tahu',
                'category' => 'Gunung',
                'excerpt' => 'Gunung Rinjani di Lombok menawarkan pemandangan luar biasa dengan danau Segara Anak di puncaknya. Kenali jalurnya sebelum berangkat.',
                'content' => $this->contentRinjani(),
                'author_name' => 'Dani Maro',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Sunrise di Puncak Gunung Prau: Permadani Awan yang Menakjubkan',
                'category' => 'Destinasi',
                'excerpt' => 'Gunung Prau di Wonosobo terkenal dengan panorama sunrise-nya yang spektakuler. Perjalanan relatif singkat dengan hasil yang luar biasa.',
                'content' => $this->contentPrau(),
                'author_name' => 'Reza Maro',
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Open Trip Maro: Pendakian Gunung Lawu via Cemoro Sewu',
                'category' => 'Berita',
                'excerpt' => 'Maro Adventure membuka pendaftaran Open Trip Gunung Lawu via Cemoro Sewu untuk bulan November. Kuota terbatas, segera daftar!',
                'content' => $this->contentLawu(),
                'author_name' => 'Tim Maro Adventure',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Mengenal Kearifan Lokal Masyarakat Sekitar Gunung Merapi',
                'category' => 'Budaya',
                'excerpt' => 'Di balik gagahnya Merapi, tersimpan tradisi dan kepercayaan lokal yang kaya. Belajar menghormati alam dan budaya setempat sebelum mendaki.',
                'content' => $this->contentBudayaMerapi(),
                'author_name' => 'Sari Maro',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Panduan Lengkap Camping di Alam Terbuka untuk Pemula',
                'category' => 'Tips',
                'excerpt' => 'Belum pernah camping? Tidak perlu khawatir. Panduan ini akan membantu kamu mempersiapkan diri untuk pengalaman camping pertama yang menyenangkan.',
                'content' => $this->contentCamping(),
                'author_name' => 'Tim Maro Adventure',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Keindahan Tersembunyi Kawah Ijen: Fenomena Blue Fire yang Memukau',
                'category' => 'Destinasi',
                'excerpt' => 'Kawah Ijen di Banyuwangi terkenal dengan fenomena api biru (blue fire) yang hanya bisa dilihat pada dini hari. Ini panduan lengkap kunjungannya.',
                'content' => $this->contentKawahIjen(),
                'author_name' => 'Dani Maro',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Maro Adventure Raih Kepercayaan 500+ Peserta di Tahun 2025',
                'category' => 'Berita',
                'excerpt' => 'Menutup tahun 2025, Maro Adventure berhasil melayani lebih dari 500 peserta dalam berbagai program perjalanan. Terima kasih atas kepercayaannya!',
                'content' => $this->contentBerita500(),
                'author_name' => 'Tim Maro Adventure',
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'category' => $data['category'],
                'thumbnail' => null, // akan diisi dengan gambar nyata nanti
                'author_name' => $data['author_name'],
                'author_avatar' => null,
                'views' => rand(50, 850),
                'is_published' => true,
                'published_at' => $data['published_at'],
            ]);
        }
    }

    // ── Content helpers ──────────────────────────────────────────────────

    private function contentTipsSemeru(): string
    {
        return '<p>Gunung Semeru (3.676 mdpl) adalah gunung tertinggi di Pulau Jawa dan salah satu tujuan pendakian paling populer di Indonesia. Sebelum kamu berangkat, ada beberapa hal penting yang wajib dipersiapkan.</p>

<h3>1. Persiapkan Fisik 2-3 Bulan Sebelumnya</h3>
<p>Pendakian Semeru membutuhkan stamina yang baik. Lakukan latihan jogging, bersepeda, atau mendaki bukit kecil secara rutin setidaknya 2-3 bulan sebelum hari H. Fisik yang prima adalah kunci keselamatan di gunung.</p>

<h3>2. Urus Izin Pendakian</h3>
<p>Sejak pengelolaan oleh Taman Nasional Bromo Tengger Semeru (TNBTS), semua pendaki wajib mendaftar dan memesan tiket online melalui sistem resmi. Pastikan kamu mendaftar jauh hari karena kuota terbatas.</p>

<h3>3. Perlengkapan Wajib yang Tidak Boleh Ketinggalan</h3>
<ul>
<li>Sleeping bag yang sesuai untuk suhu -5°C hingga 10°C</li>
<li>Jaket gunung yang windproof dan waterproof</li>
<li>Trekking pole untuk mengurangi beban lutut</li>
<li>Headlamp dengan baterai cadangan</li>
<li>P3K lengkap termasuk obat altitude sickness</li>
<li>Raincoat atau ponco</li>
</ul>

<h3>4. Perhatikan Kondisi Cuaca</h3>
<p>Selalu cek prakiraan cuaca 3-7 hari sebelum pendakian. Musim terbaik mendaki Semeru adalah April hingga Oktober (musim kemarau). Hindari mendaki di puncak musim hujan (Desember-Maret).</p>

<h3>5. Bawa Air dan Makanan yang Cukup</h3>
<p>Sumber air di Semeru terbatas. Isi air di Ranu Kumbolo sebelum melanjutkan ke Kalimati. Bawa minimal 3 liter air per orang dan makanan berkalori tinggi seperti coklat, kacang, dan roti.</p>

<h3>6. Kenali Tandamu Sendiri</h3>
<p>Altitude sickness bisa menyerang siapa saja. Kenali gejala seperti sakit kepala parah, mual, dan kehilangan keseimbangan. Jika gejala muncul, segera turun dan jangan dipaksakan.</p>

<h3>7. Jaga Kebersihan dan Jangan Tinggalkan Sampah</h3>
<p>Prinsip Leave No Trace wajib diterapkan. Bawa kantong plastik untuk sampahmu dan bawa kembali turun. Alam Semeru adalah warisan kita bersama.</p>

<h3>8. Tidak Diperbolehkan ke Puncak Mahameru Sendirian</h3>
<p>Pendakian ke Puncak Mahameru wajib didampingi pemandu atau pergi bersama minimal 3 orang. Jalur Summit Attack sangat terjal dan berbahaya jika dilakukan sendiri.</p>

<h3>9. Patuhi Aturan dan Jalur Resmi</h3>
<p>Ikuti jalur yang sudah ditentukan dan patuhi semua rambu yang ada. Jangan mendekat ke kawah aktif Jonggring Saloko yang masih aktif.</p>

<h3>10. Daftarkan Diri di Pos Pendakian</h3>
<p>Selalu laporkan diri dan tim di pos pendakian saat berangkat maupun saat kembali. Ini sangat penting untuk keselamatan dan prosedur SAR jika diperlukan.</p>

<p><strong>Siap mendaki Semeru bersama Maro Adventure?</strong> Tim kami siap memandu perjalananmu dengan aman dan berkesan. Hubungi kami untuk informasi lebih lanjut tentang Open Trip Semeru.</p>';
    }

    private function contentRinjani(): string
    {
        return '<p>Gunung Rinjani (3.726 mdpl) di Pulau Lombok, Nusa Tenggara Barat, adalah gunung berapi aktif kedua tertinggi di Indonesia. Dengan keindahan Danau Segara Anak di kalderanya, Rinjani adalah salah satu destinasi pendakian paling ikonik di Indonesia.</p>

<h3>Jalur Utama Pendakian Rinjani</h3>

<h4>1. Jalur Senaru (Lombok Utara)</h4>
<p>Ini adalah jalur paling populer dan menjadi pilihan banyak pendaki. Jalur ini lebih panjang namun pemandangannya sangat memukau. Dari Senaru, pendaki bisa turun ke kaldera dan mencapai Danau Segara Anak.</p>

<h4>2. Jalur Sembalun (Lombok Timur)</h4>
<p>Jalur Sembalun lebih terbuka dengan padang savana yang luas. Cocok untuk pendaki yang ingin menikmati pemandangan berbeda. Jalur ini juga merupakan jalur paling cepat untuk summit attack ke Puncak Rinjani.</p>

<h4>3. Jalur Torean</h4>
<p>Jalur alternatif yang lebih menantang dan belum terlalu ramai. Melewati sumber air panas alami dan hutan yang lebih lebat. Sangat direkomendasikan bagi pendaki berpengalaman.</p>

<h3>Yang Harus Kamu Siapkan</h3>
<ul>
<li>Izin pendakian dari Taman Nasional Gunung Rinjani</li>
<li>Perlengkapan camping lengkap (tenda, sleeping bag -10°C)</li>
<li>Porter atau guide lokal sangat dianjurkan</li>
<li>Persiapan fisik minimal 3 bulan sebelumnya</li>
<li>Asuransi perjalanan aktif</li>
</ul>

<h3>Waktu Terbaik Mendaki</h3>
<p>April hingga November adalah waktu terbaik untuk mendaki Rinjani. Rinjani ditutup untuk pendakian setiap Desember hingga Maret karena cuaca ekstrem di musim hujan.</p>

<p>Maro Adventure menyediakan layanan Guiding & Portering untuk pendakian Rinjani. Tim kami berpengalaman dan memahami jalur dengan baik. Hubungi kami untuk informasi lebih lanjut.</p>';
    }

    private function contentPrau(): string
    {
        return '<p>Gunung Prau (2.565 mdpl) di Kawasan Dataran Tinggi Dieng, Wonosobo, Jawa Tengah, adalah surga bagi pecinta sunrise. Meski tidak setinggi gunung-gunung lainnya, pemandangan dari puncak Prau termasuk yang paling indah di Indonesia.</p>

<h3>Mengapa Prau Sangat Istimewa?</h3>
<p>Dari puncak Prau, kamu bisa menyaksikan hamparan awan putih bak permadani dengan latar belakang jajaran gunung-gunung Jawa: Sindoro, Sumbing, Merapi, Merbabu, Ungaran, bahkan Lawu di hari yang cerah. Inilah yang membuat Prau selalu ramai dikunjungi.</p>

<h3>Jalur Pendakian</h3>
<p>Ada beberapa jalur menuju puncak Prau:</p>
<ul>
<li><strong>Jalur Patak Banteng</strong> — Paling populer dan relatif mudah. Waktu tempuh sekitar 3-4 jam.</li>
<li><strong>Jalur Dieng</strong> — Lebih panjang namun pemandangannya berbeda, melewati perkebunan warga.</li>
<li><strong>Jalur Wates</strong> — Alternatif yang lebih sepi, cocok untuk yang suka ketenangan.</li>
</ul>

<h3>Tips Menikmati Sunrise di Prau</h3>
<ul>
<li>Naik sore hari dan bermalam di tenda untuk menikmati sunrise terbaik</li>
<li>Bangun pukul 04.00 dan bersiap di puncak sebelum 05.30</li>
<li>Bawa jaket tebal karena suhu puncak bisa mencapai 5-10°C di malam hari</li>
<li>Bawa kamera atau tripod untuk mengabadikan momen golden hour</li>
</ul>

<p>Prau adalah pilihan tepat untuk pendaki pemula maupun yang ingin menikmati alam tanpa jalur yang terlalu ekstrem. Maro Adventure sering mengadakan Open Trip ke Prau, khususnya untuk menikmati sunrise spektakuler ini.</p>';
    }

    private function contentLawu(): string
    {
        return '<p>Kabar gembira untuk para pecinta pendakian! Maro Adventure kembali membuka pendaftaran Open Trip Gunung Lawu via Cemoro Sewu untuk bulan November 2026.</p>

<h3>Detail Trip</h3>
<ul>
<li><strong>Jadwal:</strong> 8-10 November 2026</li>
<li><strong>Kuota:</strong> 15 peserta (terbatas)</li>
<li><strong>Harga:</strong> Rp 550.000/orang (all-in dari Karanganyar)</li>
<li><strong>Estimasi Waktu:</strong> 3 hari 2 malam</li>
</ul>

<h3>Apa yang Sudah Termasuk?</h3>
<ul>
<li>Transportasi Karanganyar PP</li>
<li>Izin pendakian</li>
<li>Guide berpengalaman</li>
<li>Porter (1 porter per 3 orang)</li>
<li>Tenda dan matras</li>
<li>Makan selama perjalanan (3x makan besar, 3x snack)</li>
<li>P3K dan emergency kit</li>
<li>Dokumentasi trip</li>
</ul>

<h3>Itinerary Singkat</h3>
<p><strong>Hari 1:</strong> Briefing, registrasi, dan mulai pendakian dari Cemoro Sewu. Camp di Pos 5 (Cemoro Kandang).</p>
<p><strong>Hari 2:</strong> Summit attack ke Puncak Hargo Dumilah (3.265 mdpl). Turun dan camp di Pos 3.</p>
<p><strong>Hari 3:</strong> Turun gunung, kembali ke Karanganyar.</p>

<h3>Cara Daftar</h3>
<p>Hubungi Maro Adventure melalui WhatsApp di nomor +62 858 9453 5172 atau DM Instagram @maroadventureindonesia. Sertakan nama lengkap, nomor HP, dan pengalaman mendaki sebelumnya.</p>

<p><em>Kuota terbatas! Segera daftarkan dirimu sebelum penuh.</em></p>';
    }

    private function contentBudayaMerapi(): string
    {
        return '<p>Gunung Merapi bukan hanya gunung berapi aktif yang megah secara geologis — ia juga merupakan pusat dari kepercayaan dan tradisi budaya yang telah berlangsung selama berabad-abad di kalangan masyarakat Jawa.</p>

<h3>Mbah Marijan dan Juru Kunci Merapi</h3>
<p>Nama Mbah Marijan mungkin sudah tidak asing. Ia adalah juru kunci terakhir yang paling dikenal dari Merapi, yang gugur saat erupsi 2010. Tradisi juru kunci ini merupakan bagian dari sistem kepercayaan masyarakat Jawa yang percaya bahwa Merapi memiliki "penunggu" atau penguasa spiritual.</p>

<h3>Labuhan: Ritual Persembahan</h3>
<p>Setiap tahun, Keraton Yogyakarta mengadakan upacara Labuhan di lereng Merapi sebagai bentuk penghormatan dan permohonan keselamatan. Ini adalah tradisi yang sudah berlangsung ratusan tahun dan masih dilestarikan hingga kini.</p>

<h3>Kepercayaan Masyarakat Lokal</h3>
<p>Masyarakat sekitar Merapi memiliki berbagai kepercayaan yang perlu dihormati oleh para pendaki:</p>
<ul>
<li>Tidak boleh mengenakan pakaian berwarna hijau (warna yang dipercaya sebagai warna penguasa alam gaib)</li>
<li>Tidak boleh berbicara sembarangan atau berkata-kata kasar</li>
<li>Selalu minta izin secara batin sebelum memasuki kawasan gunung</li>
<li>Jangan mengambil apapun dari gunung selain foto dan kenangan</li>
</ul>

<h3>Belajar dari Kearifan Lokal</h3>
<p>Sebagai pendaki, menghormati kepercayaan dan adat setempat bukan berarti kita harus ikut mempercayainya — namun menunjukkan rasa hormat kita terhadap budaya dan masyarakat yang telah hidup berdampingan dengan alam ini jauh sebelum kita datang.</p>

<p>Maro Adventure selalu mengajak pesertanya untuk mengenal dan menghormati kearifan lokal di setiap destinasi yang dikunjungi. Karena perjalanan yang baik bukan hanya tentang mencapai puncak, tapi juga tentang memahami cerita di baliknya.</p>';
    }

    private function contentCamping(): string
    {
        return '<p>Camping di alam terbuka adalah salah satu cara terbaik untuk melepas penat dan mendekatkan diri dengan alam. Tapi bagi pemula, persiapan yang tepat sangat penting agar pengalaman pertamamu menyenangkan dan aman.</p>

<h3>Perlengkapan Camping Dasar</h3>
<ul>
<li><strong>Tenda</strong> — Pilih tenda dome untuk pemula karena mudah dipasang. Pastikan waterproof.</li>
<li><strong>Sleeping bag</strong> — Sesuaikan dengan suhu lokasi camping. Untuk dataran tinggi, pilih yang tahan -5°C.</li>
<li><strong>Matras</strong> — Penting untuk insulasi dari tanah dingin.</li>
<li><strong>Kompor portable dan bahan bakar</strong> — Untuk memasak di camp.</li>
<li><strong>Headlamp</strong> — Wajib! Bawa baterai cadangan.</li>
<li><strong>P3K dasar</strong> — Plester, antiseptik, obat nyeri, dan obat diare.</li>
</ul>

<h3>Memilih Lokasi Camping</h3>
<p>Sebagai pemula, pilih lokasi camping yang:</p>
<ul>
<li>Legal dan resmi (ada izin dari pengelola)</li>
<li>Tidak terlalu jauh dari fasilitas (toilet, sumber air)</li>
<li>Sudah dikenal dan banyak dikunjungi (lebih aman)</li>
<li>Tidak di bawah pohon besar atau di pinggir sungai (bahaya)</li>
</ul>

<h3>Tips Memasak di Alam</h3>
<p>Makanan camping yang praktis dan lezat: nasi, mie instan, oatmeal, sarden, coklat, dan berbagai camilan berkalori tinggi. Masak air minum dari sumber alami menggunakan kompor atau water purifier.</p>

<h3>Leave No Trace</h3>
<p>Ini adalah prinsip paling penting dalam camping: tinggalkan alam seperti sebelum kamu datang. Tidak membuang sampah sembarangan, tidak merusak tumbuhan, dan tidak meninggalkan bekas api.</p>

<p>Maro Adventure sering mengadakan camping trip untuk berbagai kalangan, termasuk pemula. Bergabunglah dengan kami untuk pengalaman camping yang aman, seru, dan berkesan!</p>';
    }

    private function contentKawahIjen(): string
    {
        return '<p>Kawah Ijen di Banyuwangi, Jawa Timur, adalah salah satu keajaiban alam paling unik di dunia. Di sini terdapat fenomena "blue fire" atau api biru — satu-satunya fenomena api biru yang dapat dilihat oleh mata manusia di muka bumi.</p>

<h3>Apa itu Blue Fire?</h3>
<p>Blue fire bukan api dari magma yang berwarna biru, melainkan gas belerang yang keluar dari celah-celah kawah dengan tekanan dan suhu sangat tinggi (di atas 600°C), kemudian terbakar saat bersentuhan dengan udara dan menghasilkan nyala api berwarna biru yang sangat indah.</p>

<h3>Kapan Bisa Melihat Blue Fire?</h3>
<p>Blue fire hanya terlihat pada kondisi gelap gulita, yaitu antara pukul 02.00 dini hari hingga menjelang fajar sekitar pukul 05.00. Setelah matahari terbit, nyala api biru tidak akan terlihat karena cahaya matahari yang lebih dominan.</p>

<h3>Panduan Berkunjung</h3>
<ul>
<li><strong>Jam masuk:</strong> Parkiran Paltuding buka pukul 01.00 dini hari untuk pengunjung yang ingin melihat blue fire</li>
<li><strong>Durasi trekking:</strong> Sekitar 1,5-2 jam dari Paltuding ke bibir kawah</li>
<li><strong>Wajib pakai masker gas</strong> karena gas belerang sangat berbahaya untuk pernapasan</li>
<li><strong>Bawa senter/headlamp</strong> karena jalur dalam kondisi gelap</li>
<li><strong>Gunakan jaket tebal</strong> karena suhu pagi hari di kawasan ini sangat dingin</li>
</ul>

<h3>Danau Kawah Ijen</h3>
<p>Selain blue fire, Kawah Ijen juga memiliki danau kawah berwarna hijau toska yang sangat cantik. Ini adalah danau asam vulkanik terbesar di dunia dengan pH yang sangat rendah (hampir nol). Jangan pernah mencoba menyentuh airnya!</p>

<h3>Penambang Belerang Ijen</h3>
<p>Pengalaman mengunjungi Ijen tidak lengkap tanpa mengenal para penambang belerang yang setiap harinya memanggul beban belerang 70-100 kg dari dalam kawah. Mereka adalah bagian dari cerita Ijen yang sesungguhnya.</p>

<p>Maro Adventure menyediakan paket kunjungan ke Kawah Ijen yang terorganisir dan aman. Hubungi kami untuk informasi lebih lanjut.</p>';
    }

    private function contentBerita500(): string
    {
        return '<p>Tahun 2025 menjadi tahun yang penuh pencapaian bagi Maro Adventure Indonesia. Dengan penuh rasa syukur, kami mengumumkan bahwa total peserta yang telah bergabung dalam berbagai program perjalanan Maro sepanjang tahun 2025 telah melampaui angka 500 orang.</p>

<h3>Perjalanan Panjang Maro Adventure</h3>
<p>Sejak pertama kali beroperasi, Maro Adventure selalu berkomitmen untuk menghadirkan pengalaman perjalanan yang aman, berkesan, dan bermakna. Pencapaian 500+ peserta ini adalah bukti kepercayaan yang telah diberikan oleh banyak pihak kepada kami.</p>

<h3>Program yang Paling Diminati</h3>
<ul>
<li><strong>Open Trip Pendakian</strong> — Program paling populer, dengan destinasi favorit Semeru, Lawu, dan Prau</li>
<li><strong>Team Building Corporate</strong> — Semakin banyak perusahaan dan organisasi yang mempercayakan kegiatan outdoor mereka kepada Maro</li>
<li><strong>Private Trip Keluarga</strong> — Program yang terus berkembang dengan permintaan yang meningkat</li>
<li><strong>Guiding & Portering</strong> — Layanan pendampingan profesional yang semakin diminati</li>
</ul>

<h3>Ucapan Terima Kasih</h3>
<p>Pencapaian ini tidak mungkin terwujud tanpa kepercayaan dari setiap peserta yang telah memilih Maro Adventure sebagai teman perjalanan mereka. Terima kasih telah mempercayai kami untuk menemanimu menjelajahi alam Indonesia yang luar biasa.</p>

<h3>Yang Akan Datang di 2026</h3>
<p>Di tahun 2026, Maro Adventure berencana untuk menghadirkan lebih banyak program baru, memperluas jangkauan destinasi, dan terus meningkatkan kualitas pelayanan. Nantikan pengumuman program-program menarik dari kami!</p>

<p>Tetap ikuti perkembangan Maro Adventure di Instagram <strong>@maroadventureindonesia</strong> dan hubungi kami langsung di WhatsApp +62 858 9453 5172 untuk informasi lebih lanjut.</p>';
    }
}
