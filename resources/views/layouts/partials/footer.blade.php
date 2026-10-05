<footer>

    <div class="container">

        <div class="row g-5">


            <!-- Brand -->
            <div class="col-lg-4 col-md-6">

                <div class="footer-brand">

                    <h5>

                        <div
                            class="footer-logo"
                            style="
                                width:32px;
                                height:32px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:#ffffff;
                                border-radius:6px;
                                overflow:hidden;
                            "
                        >

                            <img
                                src="{{ asset('assets/images/brand_maro.png') }}"
                                alt="Logo Maro Adventure"
                                style="
                                    width:32px;
                                    height:32px;
                                    object-fit:contain;
                                "
                            />

                        </div>

                        Maro Adventure Indonesia

                    </h5>


                    <p>
                        Adventure & Outdoor Event Organizer yang membawa
                        perjalanan lebih dekat dengan alam, budaya,
                        dan pengalaman.
                    </p>


                    <div class="footer-social mt-3">


                        <!-- WhatsApp -->
                        <a
                            href="https://wa.me/6285894535172"
                            class="footer-social-btn"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="WhatsApp Maro Adventure"
                            id="footer-wa"
                        >
                            <i class="bi bi-whatsapp"></i>
                        </a>


                        <!-- Instagram -->
                        <a
                            href="https://www.instagram.com/maroadventureindonesia"
                            class="footer-social-btn"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="Instagram Maro Adventure"
                            id="footer-ig"
                        >
                            <i class="bi bi-instagram"></i>
                        </a>


                        <!-- Email -->
                        <a
                            href="mailto:maroadventureindonesia@gmail.com"
                            class="footer-social-btn"
                            title="Email Maro Adventure"
                            id="footer-email"
                        >
                            <i class="bi bi-envelope-fill"></i>
                        </a>

                    </div>

                </div>

            </div>


            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 col-sm-6">

                <h6 class="footer-heading">
                    Explore
                </h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{ url('/') }}#hero">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}#tentang">
                            Tentang Maro
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}#layanan">
                            Layanan
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}#paket">
                            Perjalanan
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('artikel.index') }}">
                            Artikel & Berita
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}#galeri">
                            Galeri
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}#kontak">
                            Kontak
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Services -->
            <div class="col-lg-2 col-md-6 col-sm-6">

                <h6 class="footer-heading">
                    Layanan
                </h6>

                <ul class="footer-links">

                    <li>
                        <a href="#layanan">
                            Open Trip
                        </a>
                    </li>

                    <li>
                        <a href="#layanan">
                            Private Trip
                        </a>
                    </li>

                    <li>
                        <a href="#layanan">
                            Guiding
                        </a>
                    </li>

                    <li>
                        <a href="#layanan">
                            Camping
                        </a>
                    </li>

                    <li>
                        <a href="#layanan">
                            Team Experience
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Contact -->
            <div class="col-lg-4 col-md-6">

                <h6 class="footer-heading">
                    Mari Terhubung
                </h6>


                <div class="footer-contact-item">

                    <i class="bi bi-whatsapp"></i>

                    <span>
                        +62 858 9453 5172
                    </span>

                </div>


                <div class="footer-contact-item">

                    <i class="bi bi-envelope-fill"></i>

                    <span>
                        maroadventureindonesia@gmail.com
                    </span>

                </div>


                <div class="footer-contact-item">

                    <i class="bi bi-instagram"></i>

                    <span>
                        @maroadventureindonesia
                    </span>

                </div>


                <div class="mt-3">

                    <a
                        href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20ingin%20konsultasi%20tentang%20perjalanan."
                        class="btn-primary-custom btn-wa"
                        style="
                            font-size:0.85rem;
                            padding:10px 20px;
                        "
                        target="_blank"
                        rel="noopener noreferrer"
                        id="footer-booking-btn"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Hubungi Maro
                    </a>

                </div>

            </div>

        </div>


        <hr class="footer-divider" />


        <div class="footer-bottom">

            <p class="mb-0">

                © 2026

                <strong style="color:rgba(255,255,255,0.75);">
                    Maro Adventure Indonesia
                </strong>

                . All Rights Reserved.

                <span class="mx-2">
                    ·
                </span>

                GO BEYOND THE TRIP.

            </p>

        </div>

    </div>

</footer>
