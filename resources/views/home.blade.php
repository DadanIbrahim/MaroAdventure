<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MARO Adventure</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    x-data="{
        scrolled: false,
        mobileMenu: false,
        lightbox: false,
        lightboxImage: '',
        showTop: false
    }"
    @scroll.window="
        scrolled = window.scrollY > 50;
        showTop = window.scrollY > 500;
    "
>

    <!-- =========================
         NAVBAR
    ========================== -->
    <header
        class="maro-navbar"
        :class="{ 'scrolled': scrolled }"
    >
        <div class="maro-container">
            <div class="flex h-20 items-center justify-between">

                <a href="#home" class="nav-logo">
                    MARO
                </a>

                <!-- Desktop -->
                <nav class="hidden items-center gap-8 md:flex">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#tentang" class="nav-link">Tentang</a>
                    <a href="#layanan" class="nav-link">Layanan</a>
                    <a href="#perjalanan" class="nav-link">Perjalanan</a>
                    <a href="#galeri" class="nav-link">Galeri</a>
                    <a href="#kontak" class="nav-link">Kontak</a>
                </nav>

                <!-- Mobile Button -->
                <button
                    type="button"
                    class="md:hidden"
                    @click="mobileMenu = !mobileMenu"
                    aria-label="Toggle menu"
                >
                    <svg
                        x-show="!mobileMenu"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        x-show="mobileMenu"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div
                x-show="mobileMenu"
                x-cloak
                x-transition
                class="border-t border-white/10 py-5 md:hidden"
                :class="scrolled ? 'bg-white' : 'bg-black/20'"
            >
                <div class="flex flex-col gap-5">
                    <a href="#home" @click="mobileMenu = false" class="nav-link">
                        Home
                    </a>

                    <a href="#tentang" @click="mobileMenu = false" class="nav-link">
                        Tentang
                    </a>

                    <a href="#layanan" @click="mobileMenu = false" class="nav-link">
                        Layanan
                    </a>

                    <a href="#perjalanan" @click="mobileMenu = false" class="nav-link">
                        Perjalanan
                    </a>

                    <a href="#galeri" @click="mobileMenu = false" class="nav-link">
                        Galeri
                    </a>

                    <a href="#kontak" @click="mobileMenu = false" class="nav-link">
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </header>


    <!-- =========================
         HERO
    ========================== -->
    <section id="home" class="maro-hero">
        <div class="maro-container">
            <div class="maro-hero-content fade-up">

                <div class="maro-hero-eyebrow">
                    <span>●</span>
                    Adventure • Nature • Experience
                </div>

                <h1 class="maro-hero-title">
                    Jelajahi Alam.<br>
                    <span>Ciptakan Cerita.</span>
                </h1>

                <p class="maro-hero-description">
                    Bersama MARO Adventure, nikmati perjalanan outdoor
                    yang seru, aman, dan penuh pengalaman berkesan.
                </p>

                <div class="maro-hero-actions">
                    <a href="#perjalanan" class="maro-btn maro-btn-primary">
                        Jelajahi Perjalanan
                    </a>

                    <a href="#tentang" class="maro-btn maro-btn-outline">
                        Tentang MARO
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         ABOUT
    ========================== -->
    <section id="tentang" class="maro-section">
        <div class="maro-container">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                <div>
                    <img
                        src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=85"
                        alt="Aktivitas outdoor MARO"
                        class="maro-about-image"
                    >
                </div>

                <div class="maro-about-content">

                    <span class="maro-section-label">
                        Tentang MARO
                    </span>

                    <h2>
                        Lebih dari sekadar perjalanan.
                    </h2>

                    <p>
                        MARO Adventure hadir untuk menghadirkan pengalaman
                        menjelajah alam yang menyenangkan, aman, dan berkesan.
                    </p>

                    <p>
                        Kami percaya bahwa setiap perjalanan memiliki cerita.
                        Karena itu, setiap aktivitas dirancang agar peserta
                        dapat menikmati alam sekaligus membangun pengalaman
                        bersama.
                    </p>

                    <div class="maro-feature-list">

                        <div class="maro-feature">
                            <div class="maro-feature-icon">✓</div>

                            <div>
                                <h3>Berpengalaman</h3>
                                <p>
                                    Tim dengan pengalaman dalam aktivitas outdoor.
                                </p>
                            </div>
                        </div>

                        <div class="maro-feature">
                            <div class="maro-feature-icon">◆</div>

                            <div>
                                <h3>Aman & Terencana</h3>
                                <p>
                                    Setiap perjalanan dipersiapkan dengan matang.
                                </p>
                            </div>
                        </div>

                        <div class="maro-feature">
                            <div class="maro-feature-icon">♥</div>

                            <div>
                                <h3>Berorientasi Pengalaman</h3>
                                <p>
                                    Membuat perjalanan menjadi cerita yang berkesan.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- =========================
         SERVICES
    ========================== -->
    <section id="layanan" class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Layanan
                </span>

                <h2 class="maro-section-title">
                    Temukan aktivitas outdoor favoritmu
                </h2>

                <p class="maro-section-description">
                    Berbagai pilihan aktivitas untuk menikmati alam,
                    membangun kebersamaan, dan menciptakan pengalaman baru.
                </p>
            </div>


            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Camping -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=900&q=80"
                        alt="Camping"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Camping</h3>

                        <p>
                            Nikmati malam di alam dengan suasana yang
                            tenang dan menyenangkan.
                        </p>
                    </div>
                </article>


                <!-- Hiking -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80"
                        alt="Hiking"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Hiking</h3>

                        <p>
                            Jelajahi jalur pegunungan dan nikmati
                            keindahan alam dari ketinggian.
                        </p>
                    </div>
                </article>


                <!-- Outbound -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                        alt="Outbound"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Outbound</h3>

                        <p>
                            Aktivitas seru untuk membangun komunikasi,
                            kerja sama, dan kekompakan.
                        </p>
                    </div>
                </article>


                <!-- Team Building -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80"
                        alt="Team Building"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Team Building</h3>

                        <p>
                            Bangun chemistry dan kolaborasi melalui
                            pengalaman outdoor bersama.
                        </p>
                    </div>
                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         PACKAGES
    ========================== -->
    <section id="perjalanan" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Perjalanan
                </span>

                <h2 class="maro-section-title">
                    Pilih perjalananmu
                </h2>

                <p class="maro-section-description">
                    Beberapa contoh paket perjalanan yang dapat
                    disesuaikan dengan kebutuhanmu.
                </p>
            </div>


            <div class="grid gap-7 md:grid-cols-3">

                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1464278533981-50106e6176b1?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Explore"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Explore Nature</h3>

                        <p>
                            Perjalanan singkat untuk menikmati alam.
                        </p>

                        <div class="maro-package-price">
                            Mulai Rp250K
                        </div>

                        <ul class="maro-package-list">
                            <li>Guide perjalanan</li>
                            <li>Dokumentasi</li>
                            <li>Safety equipment</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Tanya Paket
                        </a>
                    </div>

                </article>


                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1521336575822-6da63fb45455?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Adventure"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Adventure Trip</h3>

                        <p>
                            Pengalaman lebih menantang bersama tim.
                        </p>

                        <div class="maro-package-price">
                            Mulai Rp450K
                        </div>

                        <ul class="maro-package-list">
                            <li>Guide profesional</li>
                            <li>Dokumentasi</li>
                            <li>Equipment</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Tanya Paket
                        </a>
                    </div>

                </article>


                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Group"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Group Adventure</h3>

                        <p>
                            Cocok untuk komunitas, kantor, dan organisasi.
                        </p>

                        <div class="maro-package-price">
                            Custom
                        </div>

                        <ul class="maro-package-list">
                            <li>Konsep custom</li>
                            <li>Team building</li>
                            <li>Dokumentasi</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Konsultasi
                        </a>
                    </div>

                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         WHY MARO
    ========================== -->
    <section class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Why MARO
                </span>

                <h2 class="maro-section-title">
                    Kenapa memilih MARO?
                </h2>

                <p class="maro-section-description">
                    Kami mengutamakan pengalaman, keamanan,
                    dan kebersamaan dalam setiap perjalanan.
                </p>
            </div>


            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

                <div class="maro-why-item">
                    <div class="maro-why-icon">★</div>

                    <h3>Pengalaman</h3>

                    <p>
                        Aktivitas dirancang berdasarkan pengalaman
                        dan kebutuhan peserta.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">✓</div>

                    <h3>Keamanan</h3>

                    <p>
                        Perjalanan dipersiapkan dengan memperhatikan
                        aspek keselamatan.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">◆</div>

                    <h3>Profesional</h3>

                    <p>
                        Didukung tim yang siap membantu selama
                        aktivitas berlangsung.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">♥</div>

                    <h3>Memorable</h3>

                    <p>
                        Membawa pulang pengalaman dan cerita
                        yang bisa dikenang.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         GALLERY
    ========================== -->
    <section id="galeri" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Galeri
                </span>

                <h2 class="maro-section-title">
                    Cerita dari perjalanan
                </h2>

                <p class="maro-section-description">
                    Beberapa momen yang menggambarkan pengalaman
                    outdoor bersama MARO.
                </p>
            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80"
                        alt="Mountain"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Mountain Adventure
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80"
                        alt="Nature"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Explore Nature
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=900&q=80"
                        alt="Camping"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Camping
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80"
                        alt="Hiking"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Hiking
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                        alt="Team"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Team Adventure
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80"
                        alt="Group"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Group Experience
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         LIGHTBOX
    ========================== -->
    <div
        x-show="lightbox"
        x-cloak
        x-transition.opacity
        class="maro-lightbox"
        @click.self="lightbox = false"
        @keydown.escape.window="lightbox = false"
    >
        <button
            type="button"
            class="maro-lightbox-close"
            @click="lightbox = false"
            aria-label="Close"
        >
            ×
        </button>

        <img
            :src="lightboxImage"
            alt="Gallery preview"
        >
    </div>


    <!-- =========================
         TESTIMONIAL
    ========================== -->
    <section class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Testimoni
                </span>

                <h2 class="maro-section-title">
                    Cerita dari mereka
                </h2>

                <p class="maro-section-description">
                    Pengalaman peserta setelah menikmati perjalanan bersama.
                </p>
            </div>


            <div class="grid gap-6 md:grid-cols-3">

                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Perjalanannya seru dan semuanya terasa
                        terorganisir dengan baik."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=12"
                            alt="Andi"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Andi</strong>
                            <span>Adventure Participant</span>
                        </div>
                    </div>
                </article>


                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Cocok untuk kegiatan bersama teman.
                        Banyak momen yang akhirnya jadi kenangan."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=32"
                            alt="Rina"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Rina</strong>
                            <span>Trip Participant</span>
                        </div>
                    </div>
                </article>


                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Timnya komunikatif dan kegiatan outbound
                        benar-benar membuat tim lebih kompak."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=53"
                            alt="Budi"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Budi</strong>
                            <span>Corporate Participant</span>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         CTA
    ========================== -->
    <section class="maro-cta text-center">
        <div class="maro-container">

            <h2>
                Siap memulai petualangan?
            </h2>

            <p>
                Tentukan perjalananmu dan nikmati pengalaman outdoor
                yang berbeda bersama MARO Adventure.
            </p>

            <a href="#kontak" class="maro-btn maro-btn-primary">
                Hubungi MARO
            </a>

        </div>
    </section>


    <!-- =========================
         CONTACT
    ========================== -->
    <section id="kontak" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Kontak
                </span>

                <h2 class="maro-section-title">
                    Mari rencanakan perjalananmu
                </h2>

                <p class="maro-section-description">
                    Hubungi kami untuk konsultasi paket dan kebutuhan
                    kegiatan outdoor.
                </p>
            </div>


            <div class="grid gap-8 lg:grid-cols-2">

                <div class="maro-contact-card">

                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ✉
                        </div>

                        <div>
                            <h3>Email</h3>
                            <p>hello@maroadventure.com</p>
                        </div>
                    </div>


                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ☎
                        </div>

                        <div>
                            <h3>Telepon</h3>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>


                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ◎
                        </div>

                        <div>
                            <h3>Lokasi</h3>
                            <p>Jawa Barat, Indonesia</p>
                        </div>
                    </div>

                </div>


                <div class="maro-contact-card">

                    <h3 class="mb-6 text-2xl font-bold">
                        Konsultasi
                    </h3>

                    <form
                        @submit.prevent="
                            alert('Form demo berhasil dikirim.')
                        "
                        class="space-y-5"
                    >

                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Nama
                            </label>

                            <input
                                id="name"
                                type="text"
                                placeholder="Nama kamu"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            >
                        </div>


                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                placeholder="email@example.com"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            >
                        </div>


                        <div>
                            <label
                                for="message"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Pesan
                            </label>

                            <textarea
                                id="message"
                                rows="4"
                                placeholder="Ceritakan kebutuhan perjalananmu..."
                                class="w-full resize-none rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            ></textarea>
                        </div>


                        <button
                            type="submit"
                            class="maro-btn maro-btn-green w-full"
                        >
                            Kirim Pesan
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         FOOTER
    ========================== -->
    <footer class="maro-footer">

        <div class="maro-container">

            <div class="grid gap-10 md:grid-cols-3">

                <div>
                    <h3 class="mb-4 text-2xl font-extrabold">
                        MARO
                    </h3>

                    <p>
                        Adventure, nature, and unforgettable experiences.
                    </p>
                </div>


                <div>
                    <h4 class="mb-4 font-bold">
                        Navigasi
                    </h4>

                    <div class="flex flex-col gap-2">
                        <a href="#home" class="maro-footer-link">Home</a>
                        <a href="#tentang" class="maro-footer-link">Tentang</a>
                        <a href="#layanan" class="maro-footer-link">Layanan</a>
                        <a href="#perjalanan" class="maro-footer-link">Perjalanan</a>
                    </div>
                </div>


                <div>
                    <h4 class="mb-4 font-bold">
                        Sosial
                    </h4>

                    <div class="flex flex-col gap-2">
                        <a href="#" class="maro-footer-link">Instagram</a>
                        <a href="#" class="maro-footer-link">Facebook</a>
                        <a href="#" class="maro-footer-link">WhatsApp</a>
                    </div>
                </div>

            </div>


            <div class="maro-footer-bottom">
                © {{ date('Y') }} MARO Adventure. All rights reserved.
            </div>

        </div>

    </footer>


    <!-- =========================
         BACK TO TOP
    ========================== -->
    <button
        type="button"
        x-show="showTop"
        x-cloak
        x-transition
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="maro-back-top"
        aria-label="Back to top"
    >
        ↑
    </button>

</body>
</html>
EOFcat > resources/views/home.blade.php <<'EOF'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MARO Adventure</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    x-data="{
        scrolled: false,
        mobileMenu: false,
        lightbox: false,
        lightboxImage: '',
        showTop: false
    }"
    @scroll.window="
        scrolled = window.scrollY > 50;
        showTop = window.scrollY > 500;
    "
>

    <!-- =========================
         NAVBAR
    ========================== -->
    <header
        class="maro-navbar"
        :class="{ 'scrolled': scrolled }"
    >
        <div class="maro-container">
            <div class="flex h-20 items-center justify-between">

                <a href="#home" class="nav-logo">
                    MARO
                </a>

                <!-- Desktop -->
                <nav class="hidden items-center gap-8 md:flex">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#tentang" class="nav-link">Tentang</a>
                    <a href="#layanan" class="nav-link">Layanan</a>
                    <a href="#perjalanan" class="nav-link">Perjalanan</a>
                    <a href="#galeri" class="nav-link">Galeri</a>
                    <a href="#kontak" class="nav-link">Kontak</a>
                </nav>

                <!-- Mobile Button -->
                <button
                    type="button"
                    class="md:hidden"
                    @click="mobileMenu = !mobileMenu"
                    aria-label="Toggle menu"
                >
                    <svg
                        x-show="!mobileMenu"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        x-show="mobileMenu"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div
                x-show="mobileMenu"
                x-cloak
                x-transition
                class="border-t border-white/10 py-5 md:hidden"
                :class="scrolled ? 'bg-white' : 'bg-black/20'"
            >
                <div class="flex flex-col gap-5">
                    <a href="#home" @click="mobileMenu = false" class="nav-link">
                        Home
                    </a>

                    <a href="#tentang" @click="mobileMenu = false" class="nav-link">
                        Tentang
                    </a>

                    <a href="#layanan" @click="mobileMenu = false" class="nav-link">
                        Layanan
                    </a>

                    <a href="#perjalanan" @click="mobileMenu = false" class="nav-link">
                        Perjalanan
                    </a>

                    <a href="#galeri" @click="mobileMenu = false" class="nav-link">
                        Galeri
                    </a>

                    <a href="#kontak" @click="mobileMenu = false" class="nav-link">
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </header>


    <!-- =========================
         HERO
    ========================== -->
    <section id="home" class="maro-hero">
        <div class="maro-container">
            <div class="maro-hero-content fade-up">

                <div class="maro-hero-eyebrow">
                    <span>●</span>
                    Adventure • Nature • Experience
                </div>

                <h1 class="maro-hero-title">
                    Jelajahi Alam.<br>
                    <span>Ciptakan Cerita.</span>
                </h1>

                <p class="maro-hero-description">
                    Bersama MARO Adventure, nikmati perjalanan outdoor
                    yang seru, aman, dan penuh pengalaman berkesan.
                </p>

                <div class="maro-hero-actions">
                    <a href="#perjalanan" class="maro-btn maro-btn-primary">
                        Jelajahi Perjalanan
                    </a>

                    <a href="#tentang" class="maro-btn maro-btn-outline">
                        Tentang MARO
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         ABOUT
    ========================== -->
    <section id="tentang" class="maro-section">
        <div class="maro-container">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                <div>
                    <img
                        src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=85"
                        alt="Aktivitas outdoor MARO"
                        class="maro-about-image"
                    >
                </div>

                <div class="maro-about-content">

                    <span class="maro-section-label">
                        Tentang MARO
                    </span>

                    <h2>
                        Lebih dari sekadar perjalanan.
                    </h2>

                    <p>
                        MARO Adventure hadir untuk menghadirkan pengalaman
                        menjelajah alam yang menyenangkan, aman, dan berkesan.
                    </p>

                    <p>
                        Kami percaya bahwa setiap perjalanan memiliki cerita.
                        Karena itu, setiap aktivitas dirancang agar peserta
                        dapat menikmati alam sekaligus membangun pengalaman
                        bersama.
                    </p>

                    <div class="maro-feature-list">

                        <div class="maro-feature">
                            <div class="maro-feature-icon">✓</div>

                            <div>
                                <h3>Berpengalaman</h3>
                                <p>
                                    Tim dengan pengalaman dalam aktivitas outdoor.
                                </p>
                            </div>
                        </div>

                        <div class="maro-feature">
                            <div class="maro-feature-icon">◆</div>

                            <div>
                                <h3>Aman & Terencana</h3>
                                <p>
                                    Setiap perjalanan dipersiapkan dengan matang.
                                </p>
                            </div>
                        </div>

                        <div class="maro-feature">
                            <div class="maro-feature-icon">♥</div>

                            <div>
                                <h3>Berorientasi Pengalaman</h3>
                                <p>
                                    Membuat perjalanan menjadi cerita yang berkesan.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- =========================
         SERVICES
    ========================== -->
    <section id="layanan" class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Layanan
                </span>

                <h2 class="maro-section-title">
                    Temukan aktivitas outdoor favoritmu
                </h2>

                <p class="maro-section-description">
                    Berbagai pilihan aktivitas untuk menikmati alam,
                    membangun kebersamaan, dan menciptakan pengalaman baru.
                </p>
            </div>


            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Camping -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=900&q=80"
                        alt="Camping"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Camping</h3>

                        <p>
                            Nikmati malam di alam dengan suasana yang
                            tenang dan menyenangkan.
                        </p>
                    </div>
                </article>


                <!-- Hiking -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80"
                        alt="Hiking"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Hiking</h3>

                        <p>
                            Jelajahi jalur pegunungan dan nikmati
                            keindahan alam dari ketinggian.
                        </p>
                    </div>
                </article>


                <!-- Outbound -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                        alt="Outbound"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Outbound</h3>

                        <p>
                            Aktivitas seru untuk membangun komunikasi,
                            kerja sama, dan kekompakan.
                        </p>
                    </div>
                </article>


                <!-- Team Building -->
                <article class="maro-card">
                    <img
                        src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80"
                        alt="Team Building"
                        class="maro-card-image"
                    >

                    <div class="maro-card-body">
                        <h3>Team Building</h3>

                        <p>
                            Bangun chemistry dan kolaborasi melalui
                            pengalaman outdoor bersama.
                        </p>
                    </div>
                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         PACKAGES
    ========================== -->
    <section id="perjalanan" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Perjalanan
                </span>

                <h2 class="maro-section-title">
                    Pilih perjalananmu
                </h2>

                <p class="maro-section-description">
                    Beberapa contoh paket perjalanan yang dapat
                    disesuaikan dengan kebutuhanmu.
                </p>
            </div>


            <div class="grid gap-7 md:grid-cols-3">

                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1464278533981-50106e6176b1?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Explore"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Explore Nature</h3>

                        <p>
                            Perjalanan singkat untuk menikmati alam.
                        </p>

                        <div class="maro-package-price">
                            Mulai Rp250K
                        </div>

                        <ul class="maro-package-list">
                            <li>Guide perjalanan</li>
                            <li>Dokumentasi</li>
                            <li>Safety equipment</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Tanya Paket
                        </a>
                    </div>

                </article>


                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1521336575822-6da63fb45455?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Adventure"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Adventure Trip</h3>

                        <p>
                            Pengalaman lebih menantang bersama tim.
                        </p>

                        <div class="maro-package-price">
                            Mulai Rp450K
                        </div>

                        <ul class="maro-package-list">
                            <li>Guide profesional</li>
                            <li>Dokumentasi</li>
                            <li>Equipment</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Tanya Paket
                        </a>
                    </div>

                </article>


                <article class="maro-package">

                    <img
                        src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?auto=format&fit=crop&w=900&q=80"
                        alt="Paket Group"
                        class="maro-package-image"
                    >

                    <div class="maro-package-body">
                        <h3>Group Adventure</h3>

                        <p>
                            Cocok untuk komunitas, kantor, dan organisasi.
                        </p>

                        <div class="maro-package-price">
                            Custom
                        </div>

                        <ul class="maro-package-list">
                            <li>Konsep custom</li>
                            <li>Team building</li>
                            <li>Dokumentasi</li>
                        </ul>

                        <a href="#kontak" class="maro-btn maro-btn-green w-full">
                            Konsultasi
                        </a>
                    </div>

                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         WHY MARO
    ========================== -->
    <section class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Why MARO
                </span>

                <h2 class="maro-section-title">
                    Kenapa memilih MARO?
                </h2>

                <p class="maro-section-description">
                    Kami mengutamakan pengalaman, keamanan,
                    dan kebersamaan dalam setiap perjalanan.
                </p>
            </div>


            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

                <div class="maro-why-item">
                    <div class="maro-why-icon">★</div>

                    <h3>Pengalaman</h3>

                    <p>
                        Aktivitas dirancang berdasarkan pengalaman
                        dan kebutuhan peserta.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">✓</div>

                    <h3>Keamanan</h3>

                    <p>
                        Perjalanan dipersiapkan dengan memperhatikan
                        aspek keselamatan.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">◆</div>

                    <h3>Profesional</h3>

                    <p>
                        Didukung tim yang siap membantu selama
                        aktivitas berlangsung.
                    </p>
                </div>

                <div class="maro-why-item">
                    <div class="maro-why-icon">♥</div>

                    <h3>Memorable</h3>

                    <p>
                        Membawa pulang pengalaman dan cerita
                        yang bisa dikenang.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         GALLERY
    ========================== -->
    <section id="galeri" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Galeri
                </span>

                <h2 class="maro-section-title">
                    Cerita dari perjalanan
                </h2>

                <p class="maro-section-description">
                    Beberapa momen yang menggambarkan pengalaman
                    outdoor bersama MARO.
                </p>
            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80"
                        alt="Mountain"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Mountain Adventure
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80"
                        alt="Nature"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Explore Nature
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=900&q=80"
                        alt="Camping"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Camping
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80"
                        alt="Hiking"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Hiking
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                        alt="Team"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Team Adventure
                        </span>
                    </div>
                </div>


                <div
                    class="maro-gallery-item"
                    @click="
                        lightboxImage = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1600&q=85';
                        lightbox = true
                    "
                >
                    <img
                        src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80"
                        alt="Group"
                    >

                    <div class="maro-gallery-overlay">
                        <span class="text-sm font-semibold text-white">
                            Group Experience
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         LIGHTBOX
    ========================== -->
    <div
        x-show="lightbox"
        x-cloak
        x-transition.opacity
        class="maro-lightbox"
        @click.self="lightbox = false"
        @keydown.escape.window="lightbox = false"
    >
        <button
            type="button"
            class="maro-lightbox-close"
            @click="lightbox = false"
            aria-label="Close"
        >
            ×
        </button>

        <img
            :src="lightboxImage"
            alt="Gallery preview"
        >
    </div>


    <!-- =========================
         TESTIMONIAL
    ========================== -->
    <section class="maro-section maro-section-light">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Testimoni
                </span>

                <h2 class="maro-section-title">
                    Cerita dari mereka
                </h2>

                <p class="maro-section-description">
                    Pengalaman peserta setelah menikmati perjalanan bersama.
                </p>
            </div>


            <div class="grid gap-6 md:grid-cols-3">

                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Perjalanannya seru dan semuanya terasa
                        terorganisir dengan baik."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=12"
                            alt="Andi"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Andi</strong>
                            <span>Adventure Participant</span>
                        </div>
                    </div>
                </article>


                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Cocok untuk kegiatan bersama teman.
                        Banyak momen yang akhirnya jadi kenangan."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=32"
                            alt="Rina"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Rina</strong>
                            <span>Trip Participant</span>
                        </div>
                    </div>
                </article>


                <article class="maro-testimonial">
                    <div class="maro-stars">
                        ★★★★★
                    </div>

                    <p>
                        "Timnya komunikatif dan kegiatan outbound
                        benar-benar membuat tim lebih kompak."
                    </p>

                    <div class="maro-testimonial-author">
                        <img
                            src="https://i.pravatar.cc/100?img=53"
                            alt="Budi"
                            class="maro-avatar"
                        >

                        <div>
                            <strong>Budi</strong>
                            <span>Corporate Participant</span>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>


    <!-- =========================
         CTA
    ========================== -->
    <section class="maro-cta text-center">
        <div class="maro-container">

            <h2>
                Siap memulai petualangan?
            </h2>

            <p>
                Tentukan perjalananmu dan nikmati pengalaman outdoor
                yang berbeda bersama MARO Adventure.
            </p>

            <a href="#kontak" class="maro-btn maro-btn-primary">
                Hubungi MARO
            </a>

        </div>
    </section>


    <!-- =========================
         CONTACT
    ========================== -->
    <section id="kontak" class="maro-section">
        <div class="maro-container">

            <div class="maro-section-heading">
                <span class="maro-section-label">
                    Kontak
                </span>

                <h2 class="maro-section-title">
                    Mari rencanakan perjalananmu
                </h2>

                <p class="maro-section-description">
                    Hubungi kami untuk konsultasi paket dan kebutuhan
                    kegiatan outdoor.
                </p>
            </div>


            <div class="grid gap-8 lg:grid-cols-2">

                <div class="maro-contact-card">

                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ✉
                        </div>

                        <div>
                            <h3>Email</h3>
                            <p>hello@maroadventure.com</p>
                        </div>
                    </div>


                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ☎
                        </div>

                        <div>
                            <h3>Telepon</h3>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>


                    <div class="maro-contact-item">
                        <div class="maro-contact-icon">
                            ◎
                        </div>

                        <div>
                            <h3>Lokasi</h3>
                            <p>Jawa Barat, Indonesia</p>
                        </div>
                    </div>

                </div>


                <div class="maro-contact-card">

                    <h3 class="mb-6 text-2xl font-bold">
                        Konsultasi
                    </h3>

                    <form
                        @submit.prevent="
                            alert('Form demo berhasil dikirim.')
                        "
                        class="space-y-5"
                    >

                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Nama
                            </label>

                            <input
                                id="name"
                                type="text"
                                placeholder="Nama kamu"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            >
                        </div>


                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                placeholder="email@example.com"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            >
                        </div>


                        <div>
                            <label
                                for="message"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Pesan
                            </label>

                            <textarea
                                id="message"
                                rows="4"
                                placeholder="Ceritakan kebutuhan perjalananmu..."
                                class="w-full resize-none rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-green-700"
                            ></textarea>
                        </div>


                        <button
                            type="submit"
                            class="maro-btn maro-btn-green w-full"
                        >
                            Kirim Pesan
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </section>


    <!-- =========================
         FOOTER
    ========================== -->
    <footer class="maro-footer">

        <div class="maro-container">

            <div class="grid gap-10 md:grid-cols-3">

                <div>
                    <h3 class="mb-4 text-2xl font-extrabold">
                        MARO
                    </h3>

                    <p>
                        Adventure, nature, and unforgettable experiences.
                    </p>
                </div>


                <div>
                    <h4 class="mb-4 font-bold">
                        Navigasi
                    </h4>

                    <div class="flex flex-col gap-2">
                        <a href="#home" class="maro-footer-link">Home</a>
                        <a href="#tentang" class="maro-footer-link">Tentang</a>
                        <a href="#layanan" class="maro-footer-link">Layanan</a>
                        <a href="#perjalanan" class="maro-footer-link">Perjalanan</a>
                    </div>
                </div>


                <div>
                    <h4 class="mb-4 font-bold">
                        Sosial
                    </h4>

                    <div class="flex flex-col gap-2">
                        <a href="#" class="maro-footer-link">Instagram</a>
                        <a href="#" class="maro-footer-link">Facebook</a>
                        <a href="#" class="maro-footer-link">WhatsApp</a>
                    </div>
                </div>

            </div>


            <div class="maro-footer-bottom">
                © {{ date('Y') }} MARO Adventure. All rights reserved.
            </div>

        </div>

    </footer>


    <!-- =========================
         BACK TO TOP
    ========================== -->
    <button
        type="button"
        x-show="showTop"
        x-cloak
        x-transition
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="maro-back-top"
        aria-label="Back to top"
    >
        ↑
    </button>

</body>
</html>
