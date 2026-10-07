<section id="cta">

    <div class="cta-overlay"></div>

    <div class="container">

        <div class="cta-content fade-up">

            <div
                class="badge-tag"
                style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.25);"
            >
                <i class="bi bi-compass me-1"></i>
                Your Next Adventure
            </div>

            <h2>
                Jadi, Mau Melangkah ke Mana?
            </h2>

            <p>
                Punya destinasi yang ingin dituju atau masih mencari ide?
                Ceritakan kepada kami. Kita mulai dari sana.
            </p>

            <div class="cta-buttons">

                @guest
                    <a
                        href="{{ route('login', ['notice' => 'trip']) }}"
                        class="btn-white btn-wa"
                        id="cta-whatsapp-btn"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Ceritakan Rencanamu
                    </a>
                @else
                    <a
                        href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20ingin%20konsultasi%20tentang%20perjalanan."
                        class="btn-white btn-wa"
                        target="_blank"
                        rel="noopener noreferrer"
                        id="cta-whatsapp-btn"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Ceritakan Rencanamu
                    </a>
                @endguest

                <a
                    href="#paket"
                    class="btn-outline-white"
                    id="cta-trip-btn"
                >
                    <i class="bi bi-compass"></i>
                    Lihat Perjalanan
                </a>

            </div>

        </div>

    </div>

</section>