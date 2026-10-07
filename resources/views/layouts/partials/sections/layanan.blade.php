<section id="layanan">

    <div class="container">

        <div class="section-header fade-up">

            <div class="badge-tag">
                <i class="bi bi-grid me-1"></i>
                Apa yang Kami Lakukan
            </div>

            <h2 class="section-title">
                Layanan Maro
            </h2>

            <div class="divider-line mt-3 mb-3"></div>

            <p class="section-subtitle">
                Dari perjalanan personal hingga kegiatan bersama komunitas
                dan perusahaan. Kami membantu merancang pengalaman outdoor
                sesuai kebutuhan.
            </p>

        </div>


        <div class="row g-4 stagger-children">


            <!-- OPEN TRIP -->
            <div class="col-12 col-md-6 col-lg-3 fade-up">

                <div class="service-card">

                    <div class="service-card-img-wrapper">

                        <img
                            src="{{ asset('assets/images/IMG_5168.PNG') }}"
                            alt="Open Trip Maro Adventure"
                        />

                        <div class="service-icon-overlay">
                            <i class="bi bi-signpost-2-fill"></i>
                        </div>

                        <div class="service-card-category">Open Trip</div>

                    </div>

                    <div class="service-card-body">

                        <h5>Open Trip</h5>

                        <p>
                            Ikut perjalanan bersama peserta lain,
                            menjelajahi destinasi alam dan menciptakan
                            cerita baru sepanjang perjalanan.
                        </p>

                        <div class="service-card-tags">
                            <span class="service-tag"><i class="bi bi-check2"></i> Terjadwal</span>
                            <span class="service-tag"><i class="bi bi-check2"></i> Terpandu</span>
                        </div>

                        @guest
                            <a
                                href="{{ route('login', ['notice' => 'trip']) }}"
                                class="btn-service"
                                id="service-open-trip-btn"
                            >
                                Lihat Perjalanan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a
                                href="#paket"
                                class="btn-service"
                                id="service-open-trip-btn"
                            >
                                Lihat Perjalanan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endguest

                    </div>

                </div>

            </div>


            <!-- PRIVATE TRIP -->
            <div class="col-12 col-md-6 col-lg-3 fade-up">

                <div class="service-card">

                    <div class="service-card-img-wrapper">

                        <img
                            src="{{ asset('assets/images/IMG_5169.PNG') }}"
                            alt="Private dan Custom Trip Maro Adventure"
                        />

                        <div class="service-icon-overlay">
                            <i class="bi bi-map-fill"></i>
                        </div>

                        <div class="service-card-category">Private</div>

                    </div>

                    <div class="service-card-body">

                        <h5>Private &amp; Custom Trip</h5>

                        <p>
                            Tentukan destinasi, waktu, dan gaya perjalananmu.
                            Kami membantu menyusun perjalanan sesuai kebutuhan
                            kelompok.
                        </p>

                        <div class="service-card-tags">
                            <span class="service-tag"><i class="bi bi-check2"></i> Fleksibel</span>
                            <span class="service-tag"><i class="bi bi-check2"></i> Custom</span>
                        </div>

                        @guest
                            <a
                                href="{{ route('login', ['notice' => 'trip']) }}"
                                class="btn-service"
                                id="service-private-trip-btn"
                            >
                                Konsultasikan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a
                                href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20ingin%20konsultasi%20Private%20%26%20Custom%20Trip."
                                class="btn-service"
                                id="service-private-trip-btn"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Konsultasikan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endguest

                    </div>

                </div>

            </div>


            <!-- GUIDING -->
            <div class="col-12 col-md-6 col-lg-3 fade-up">

                <div class="service-card">

                    <div class="service-card-img-wrapper">

                        <img
                            src="{{ asset('assets/images/Guide.PNG') }}"
                            alt="Mountain Guide dan Guiding Maro Adventure"
                        />

                        <div class="service-icon-overlay">
                            <i class="bi bi-person-walking"></i>
                        </div>

                        <div class="service-card-category">Guiding</div>

                    </div>

                    <div class="service-card-body">

                        <h5>Guiding &amp; Portering</h5>

                        <p>
                            Pendampingan perjalanan gunung dan aktivitas
                            outdoor bersama tim yang memahami medan dan
                            kebutuhan perjalanan.
                        </p>

                        <div class="service-card-tags">
                            <span class="service-tag"><i class="bi bi-check2"></i> Profesional</span>
                            <span class="service-tag"><i class="bi bi-check2"></i> Berpengalaman</span>
                        </div>

                        @guest
                            <a
                                href="{{ route('login', ['notice' => 'trip']) }}"
                                class="btn-service"
                                id="service-guiding-btn"
                            >
                                Tanya Layanan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a
                                href="#kontak"
                                class="btn-service"
                                id="service-guiding-btn"
                            >
                                Tanya Layanan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endguest

                    </div>

                </div>

            </div>


            <!-- CORPORATE -->
            <div class="col-12 col-md-6 col-lg-3 fade-up">

                <div class="service-card">

                    <div class="service-card-img-wrapper">

                        <img
                            src="{{ asset('assets/images/Malam.jpeg') }}"
                            alt="Team Building dan Corporate Outdoor Maro Adventure"
                        />

                        <div class="service-icon-overlay">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div class="service-card-category">Corporate</div>

                    </div>

                    <div class="service-card-body">

                        <h5>Team Building &amp; Company Outing</h5>

                        <p>
                            Kegiatan outdoor untuk komunitas, organisasi,
                            kampus, maupun perusahaan yang ingin membangun
                            kebersamaan melalui pengalaman bersama.
                        </p>

                        <div class="service-card-tags">
                            <span class="service-tag"><i class="bi bi-check2"></i> Terprogram</span>
                            <span class="service-tag"><i class="bi bi-check2"></i> Kelompok</span>
                        </div>

                        @guest
                            <a
                                href="{{ route('login', ['notice' => 'trip']) }}"
                                class="btn-service"
                                id="service-team-btn"
                            >
                                Diskusikan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <a
                                href="#kontak"
                                class="btn-service"
                                id="service-team-btn"
                            >
                                Diskusikan
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endguest

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
