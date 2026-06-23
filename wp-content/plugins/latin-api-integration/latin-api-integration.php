<?php
/**
 * Plugin Name: LATIN API Integration
 * Description: Mengambil data kegiatan dari CMS Headless API (Laravel) dan menampilkannya melalui shortcode [latin_activities].
 * Version: 1.0
 * Author: LATIN Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function latin_activities_shortcode( $atts ) {
    // API Endpoint URL (Telah disesuaikan dengan CMS Live Anda)
    $api_url = 'http://workspaceilham.web.id/panel/api/activities';

    // Ambil data menggunakan WordPress HTTP API
    $response = wp_remote_get( $api_url, array( 'timeout' => 15 ) );

    if ( is_wp_error( $response ) ) {
        return '<p class="latin-error">Gagal mengambil data kegiatan: ' . esc_html( $response->get_error_message() ) . '</p>';
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );

    if ( empty( $data['data'] ) || $data['status'] !== 'success' ) {
        return '<p class="latin-empty">Belum ada data kegiatan saat ini.</p>';
    }

    $activities = $data['data'];

    ob_start();
    ?>
    <style>
        .latin-activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
            font-family: inherit;
        }
        .latin-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
        }
        .latin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .latin-media {
            width: 100%;
            height: 200px;
            background: #f3f4f6;
            position: relative;
            overflow: hidden;
        }
        .latin-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .latin-media iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .latin-media-fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #9ca3af;
            background: #f3f4f6;
            font-size: 0.875rem;
        }
        .latin-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .latin-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            align-self: flex-start;
        }
        .latin-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.5rem 0;
            line-height: 1.4;
        }
        .latin-date {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .latin-date svg {
            vertical-align: text-bottom;
        }
        .latin-desc {
            font-size: 0.95rem;
            color: #4b5563;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <div class="latin-activities-grid">
        <?php foreach ( $activities as $activity ) : ?>
            <div class="latin-card">
                <div class="latin-media">
                    <?php if ( ! empty( $activity['youtube_link'] ) ) : 
                        // Ekstrak ID YouTube dari URL (mendukung format watch?v=, youtu.be, embed/)
                        preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $activity['youtube_link'], $matches );
                        $youtube_id = isset( $matches[1] ) ? $matches[1] : '';
                        
                        if ( $youtube_id ) : ?>
                            <iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" allowfullscreen></iframe>
                        <?php else : ?>
                            <div class="latin-media-fallback">Tautan Video Tidak Valid</div>
                        <?php endif; ?>
                    <?php elseif ( ! empty( $activity['media_url'] ) ) : ?>
                        <img src="<?php echo esc_url( $activity['media_url'] ); ?>" alt="<?php echo esc_attr( $activity['title'] ); ?>" loading="lazy">
                    <?php else : ?>
                        <div class="latin-media-fallback">Tidak ada media</div>
                    <?php endif; ?>
                </div>
                
                <div class="latin-content">
                    <span class="latin-category"><?php echo esc_html( $activity['category'] ); ?></span>
                    <h3 class="latin-title"><?php echo esc_html( $activity['title'] ); ?></h3>
                    <div class="latin-date">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php echo esc_html( date_i18n( 'd F Y', strtotime( $activity['activity_date'] ) ) ); ?>
                    </div>
                    <p class="latin-desc"><?php echo esc_html( $activity['description'] ); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'latin_activities', 'latin_activities_shortcode' );

// Register Latin Hero Slider Shortcode
function latin_hero_slider_shortcode() {
    ob_start();
    ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .latin-hero-slider {
            width: 100%;
            height: 80vh;
            min-height: 500px;
        }
        .latin-hero-slider .swiper-slide {
            position: relative;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .latin-hero-slider .slide-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.4);
        }
        .latin-hero-slider .slide-content {
            position: relative;
            z-index: 10;
            color: #fff;
            max-width: 800px;
            padding: 0 20px;
        }
        .latin-hero-slider .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            color: #fff;
        }
        .latin-hero-slider .slide-content p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
            color: #f1f1f1;
        }
        .latin-hero-slider .slide-btn {
            display: inline-block;
            background: #2e6c5c;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .latin-hero-slider .slide-btn:hover {
            background: #1e4a3f;
            color: #fff;
        }
        .swiper-button-next, .swiper-button-prev { color: #fff; }
        .swiper-pagination-bullet { background: #fff; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #2e6c5c; opacity: 1; }
    </style>

    <div class="swiper latin-hero-slider">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Perhutanan Sosial</h1>
                    <p>Mendampingi masyarakat dalam mengelola hutan secara lestari dan berkelanjutan untuk kesejahteraan bersama dan masa depan alam Indonesia.</p>
                    <a href="http://localhost/wp-latin/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Konservasi Alam</h1>
                    <p>Menjaga keanekaragaman hayati dan keseimbangan ekosistem hutan tropis Indonesia dari ancaman deforestasi dan perubahan iklim.</p>
                    <a href="http://localhost/wp-latin/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Pemberdayaan Masyarakat</h1>
                    <p>Membangun kapasitas ekonomi dan kemandirian masyarakat desa hutan melalui produk-produk non-kayu yang bernilai tinggi.</p>
                    <a href="http://localhost/wp-latin/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".latin-hero-slider", {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode("latin_hero_slider", "latin_hero_slider_shortcode");





// Safe Javascript Injection
function modify_latin_homepage_js() {
    if (is_front_page() || get_the_ID() == 1318) {
        echo "<script>
        document.addEventListener(\"DOMContentLoaded\", function() {
            setTimeout(function() {
                // 1. Hide original hero section
                var heroSection = document.querySelector(\".elementor-section, .e-con\");
                if (heroSection) heroSection.style.display = \"none\";
                
                // 2. Hide Jane Miller Quote section
                var pElements = document.querySelectorAll(\"p\");
                pElements.forEach(function(p) {
                    if (p.textContent.includes(\"Jane Miller\") || p.textContent.includes(\"Original and with an innate\")) {
                        var container = p.closest(\".elementor-section, .e-con\");
                        if (container) container.style.display = \"none\";
                    }
                    if (p.textContent.includes(\"curious about features\")) {
                        p.innerHTML = \"Jl. Sutera No. 1, RT 02/05, Situgede, Bogor Barat, Kota Bogor, Jawa Barat, 16115, Indonesia<br>WhatsApp: +62 813-1116-2045\";
                    }
                });

                // 3. Update QUESTIONS to Hubungi Kami
                var h1Elements = document.querySelectorAll(\"h1, h2, h3, h4\");
                h1Elements.forEach(function(h) {
                    if (h.textContent.includes(\"QUESTIONS\")) {
                        h.textContent = \"Hubungi Kami\";
                    }
                });

                // 4. Update Button Let's Talk Now
                var spanElements = document.querySelectorAll(\".elementor-button-text\");
                spanElements.forEach(function(span) {
                    if (span.textContent.includes(\"Let\'s Talk Now\") || span.textContent.includes(\"Let\u0027s Talk Now\")) {
                        span.textContent = \"Chat WhatsApp\";
                        var a = span.closest(\"a\");
                        if (a) {
                            a.href = \"https://wa.me/6281311162045\";
                            a.target = \"_blank\";
                        }
                    }
                });
            }, 100);
        });
        </script>";
    }
}
add_action("wp_footer", "modify_latin_homepage_js", 99);



// Inject Slider HTML safely via footer
function inject_latin_slider_html() {
    if (is_front_page() || get_the_ID() == 1318) {
        $slider_html = do_shortcode("[latin_hero_slider]");
        echo "<div id=\"latin-slider-container\" style=\"display:none;\">$slider_html</div>";
        echo "<script>
        document.addEventListener(\"DOMContentLoaded\", function() {
            setTimeout(function() {
                var slider = document.getElementById(\"latin-slider-container\");
                var heroSection = document.querySelector(\".elementor-section, .e-con\");
                if (heroSection && slider) {
                    slider.style.display = \"block\";
                    heroSection.parentNode.insertBefore(slider, heroSection);
                }
            }, 50);
        });
        </script>";
    }
}
add_action("wp_footer", "inject_latin_slider_html", 98);



