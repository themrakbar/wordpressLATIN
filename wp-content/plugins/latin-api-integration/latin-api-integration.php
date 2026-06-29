<?php
/**
 * Plugin Name: LATIN API Integration
 * Description: Mengambil data kegiatan dari CMS Headless API (Laravel) dan menampilkannya melalui shortcode [latin_activities].
 * Version: 1.1
 * Author: LATIN Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function latin_activities_shortcode( $atts ) {
    // API Endpoint URL
    $api_url = 'http://workspaceilham.web.id/panel/api/activities';

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
            pointer-events: none; /* Prevent iframe grabbing click on card */
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
        .latin-btn-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem 1rem;
            background: #f8fafc;
            color: #2e6c5c;
            border: 1px solid #2e6c5c;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-align: center;
        }
        .latin-btn-detail:hover {
            background: #2e6c5c;
            color: #ffffff;
        }
        
        /* Modal Styles */
        .latin-modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .latin-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .latin-modal-content {
            background: #fff;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            border-radius: 16px;
            overflow-y: auto;
            position: relative;
            transform: scale(0.95) translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .latin-modal-overlay.active .latin-modal-content {
            transform: scale(1) translateY(0);
        }
        .latin-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: none;
            width: 32px; height: 32px;
            border-radius: 50%;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background 0.2s;
        }
        .latin-modal-close:hover {
            background: #e11d48;
        }
        .latin-modal-media {
            width: 100%;
            height: 300px;
            background: #f3f4f6;
        }
        .latin-modal-media img, .latin-modal-media iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .latin-modal-body {
            padding: 2rem;
        }
        .latin-modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        .latin-modal-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        .latin-modal-text {
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 2rem;
            white-space: pre-wrap;
        }
        .latin-btn-instagram {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: #fff !important;
            border-radius: 12px;
            font-weight: bold;
            text-decoration: none !important;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(220, 39, 67, 0.4);
        }
        .latin-btn-instagram:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 39, 67, 0.6);
            color: #fff !important;
        }
    </style>

    <div class="latin-activities-grid">
        <?php foreach ( $activities as $activity ) : 
            
            $is_youtube = false;
            $youtube_embed = '';
            if ( ! empty( $activity['youtube_link'] ) ) {
                preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $activity['youtube_link'], $matches );
                if (isset($matches[1])) {
                    $is_youtube = true;
                    $youtube_embed = 'https://www.youtube.com/embed/' . $matches[1];
                }
            }

            // Siapkan data untuk JS Modal
            $modal_data = htmlspecialchars(json_encode([
                'title' => $activity['title'],
                'category' => $activity['category'],
                'date' => date_i18n( 'd F Y', strtotime( $activity['activity_date'] ) ),
                'description' => !empty($activity['event_details']) ? $activity['event_details'] : $activity['description'],
                'is_youtube' => $is_youtube,
                'media_url' => $is_youtube ? $youtube_embed : ($activity['media_url'] ?? ''),
                'instagram' => $activity['instagram_link'] ?? ''
            ]), ENT_QUOTES, 'UTF-8');
        ?>
            <div class="latin-card">
                <div class="latin-media">
                    <?php if ( $is_youtube ) : ?>
                        <iframe src="<?php echo esc_attr( $youtube_embed ); ?>" allowfullscreen></iframe>
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
                    
                    <div style="margin-top: auto; padding-top: 1rem;">
                        <button type="button" class="latin-btn-detail" onclick="openLatinModal(this)" data-event="<?php echo $modal_data; ?>">
                            Lihat Detail Event
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- The Modal -->
    <div id="latinEventModal" class="latin-modal-overlay" onclick="closeLatinModal(event)">
        <div class="latin-modal-content" onclick="event.stopPropagation()">
            <button class="latin-modal-close" onclick="closeLatinModal(event)">&times;</button>
            <div id="latinModalMedia" class="latin-modal-media">
                <!-- Media injected via JS -->
            </div>
            <div class="latin-modal-body">
                <span id="latinModalCategory" class="latin-category" style="margin-bottom: 10px;"></span>
                <h2 id="latinModalTitle" class="latin-modal-title"></h2>
                <div class="latin-modal-meta text-slate-500">
                    <div class="latin-date" style="margin:0;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 5px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span id="latinModalDate"></span>
                    </div>
                </div>
                <div id="latinModalText" class="latin-modal-text"></div>
                <div id="latinModalIgContainer" style="display: none; margin-top: 1rem;">
                    <a id="latinModalIgLink" href="#" target="_blank" class="latin-btn-instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        Lihat Postingan di Instagram
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openLatinModal(btn) {
            var data = JSON.parse(btn.getAttribute('data-event'));
            
            // Set Text
            document.getElementById('latinModalTitle').textContent = data.title;
            document.getElementById('latinModalCategory').textContent = data.category;
            document.getElementById('latinModalDate').textContent = data.date;
            document.getElementById('latinModalText').textContent = data.description;
            
            // Set Media
            var mediaContainer = document.getElementById('latinModalMedia');
            if (data.is_youtube) {
                mediaContainer.innerHTML = '<iframe src="' + data.media_url + '?autoplay=1" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
            } else if (data.media_url) {
                mediaContainer.innerHTML = '<img src="' + data.media_url + '" alt="Event Media">';
            } else {
                mediaContainer.innerHTML = '<div class="latin-media-fallback">Tidak ada media</div>';
            }
            
            // Set Instagram
            var igContainer = document.getElementById('latinModalIgContainer');
            var igLink = document.getElementById('latinModalIgLink');
            if (data.instagram) {
                igLink.href = data.instagram;
                igContainer.style.display = 'block';
            } else {
                igContainer.style.display = 'none';
            }
            
            // Show Modal
            var modal = document.getElementById('latinEventModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }

        function closeLatinModal(e) {
            if(e) e.preventDefault();
            var modal = document.getElementById('latinEventModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto'; // Restore scroll
            
            // Stop Video playback when closing
            var mediaContainer = document.getElementById('latinModalMedia');
            mediaContainer.innerHTML = ''; 
        }
    </script>
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
        .latin-hero-slider { width: 100%; height: 80vh; min-height: 500px; }
        .latin-hero-slider .swiper-slide { position: relative; background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; }
        .latin-hero-slider .slide-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); }
        .latin-hero-slider .slide-content { position: relative; z-index: 10; color: #fff; max-width: 800px; padding: 0 20px; }
        .latin-hero-slider .slide-content h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); color: #fff; }
        .latin-hero-slider .slide-content p { font-size: 1.2rem; line-height: 1.6; margin-bottom: 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); color: #f1f1f1; }
        .latin-hero-slider .slide-btn { display: inline-block; background: #2e6c5c; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s ease; }
        .latin-hero-slider .slide-btn:hover { background: #1e4a3f; color: #fff; }
        .swiper-button-next, .swiper-button-prev { color: #fff; }
        .swiper-pagination-bullet { background: #fff; opacity: 0.5; }
        .swiper-pagination-bullet-active { background: #2e6c5c; opacity: 1; }
    </style>

    <div class="swiper latin-hero-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Perhutanan Sosial</h1>
                    <p>Mendampingi masyarakat dalam mengelola hutan secara lestari dan berkelanjutan untuk kesejahteraan bersama dan masa depan alam Indonesia.</p>
                    <a href="/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Konservasi Alam</h1>
                    <p>Menjaga keanekaragaman hayati dan keseimbangan ekosistem hutan tropis Indonesia dari ancaman deforestasi dan perubahan iklim.</p>
                    <a href="/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&q=80&w=1920');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <h1>Pemberdayaan Masyarakat</h1>
                    <p>Membangun kapasitas ekonomi dan kemandirian masyarakat desa hutan melalui produk-produk non-kayu yang bernilai tinggi.</p>
                    <a href="/?pagename=kegiatan" class="slide-btn">Lihat Kegiatan</a>
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
            var swiper = new Swiper(".latin-hero-slider", { loop: true, autoplay: { delay: 5000, disableOnInteraction: false, }, pagination: { el: ".swiper-pagination", clickable: true, }, navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", }, });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode("latin_hero_slider", "latin_hero_slider_shortcode");


// Safe Javascript Injection
function modify_latin_homepage_js() {
    if (is_front_page() || get_the_ID() == 1318) {
        if (isset($_GET['elementor-preview']) || is_admin()) { return; }
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var heroSection = document.querySelector('.elementor-section, .e-con');
                if (heroSection) heroSection.style.display = 'none';
                
                var textElements = document.querySelectorAll('p, .elementor-text-editor, .elementor-widget-text-editor p, .hfe-infocard-text');
                textElements.forEach(function(element) {
                    if (element.textContent.includes('Jane Miller') || element.textContent.includes('Original and with an innate')) {
                        var container = element.closest('.elementor-section, .e-con');
                        if (container) container.style.display = 'none';
                    }
                    if (element.textContent.includes('curious about features')) {
                        element.innerHTML = 'Jl. Sutera No. 1, RT 02/05, Situgede, Bogor Barat, Kota Bogor, Jawa Barat, 16115, Indonesia<br>WhatsApp: +62 813-1116-2045';
                    }
                    if (element.textContent.includes('Because when a visitor first lands')) {
                        element.innerHTML = 'LATIN memiliki mandat memperkuat kelembagaan masyarakat di sekitar dan di dalam kawasan hutan untuk mencapai kelestarian sumber daya hutan dan kesejahteraan masyarakat. Kami aktif memelopori dan memperluas praktik Perhutanan Sosial di seluruh penjuru Nusantara untuk mewujudkan keadilan ekologis.';
                        element.style.animation = 'latinFadeInUp 1s ease-out forwards';
                        element.style.opacity = '0';
                    }
                });

                var spanElements = document.querySelectorAll('.elementor-button-text');
                spanElements.forEach(function(span) {
                    if (span.textContent.includes(\"Let's Talk Now\") || span.textContent.includes(\"Let\u0027s Talk Now\")) {
                        span.textContent = 'Chat WhatsApp';
                        var a = span.closest('a');
                        if (a) { a.href = 'https://wa.me/6281311162045'; a.target = '_blank'; }
                    }
                    if (span.textContent.includes('Find Out More') || span.textContent.includes('Pelajari Lebih Lanjut')) {
                        span.textContent = 'Pelajari Lebih Lanjut';
                        var a = span.closest('a');
                        if (a) a.href = '#about';
                    }
                });

                var hElements = document.querySelectorAll('h1, h2, h3, h4');
                hElements.forEach(function(h) {
                    if (h.textContent.includes('QUESTIONS') || h.textContent.includes('Hubungi Kami')) {
                        h.textContent = 'Hubungi Kami';
                        var contactSection = h.closest('.elementor-section, .e-con');
                        if (contactSection) {
                            contactSection.style.backgroundImage = \"url('/wp-content/uploads/2024/07/header-hero.jpg')\";
                            contactSection.style.backgroundSize = 'cover';
                            contactSection.style.backgroundPosition = 'center';
                            contactSection.style.position = 'relative';
                            contactSection.style.overflow = 'hidden';
                            contactSection.classList.add('latin-bg-animate');
                        }
                    }
                });

                var headerLeft = document.querySelector('.site-header-primary-section-left') || document.querySelector('.ast-main-header-bar-alignment');
                if (headerLeft && !document.querySelector('#injected-latin-logo')) {
                    var logoContainer = document.createElement('div');
                    logoContainer.id = 'injected-latin-logo';
                    logoContainer.style.display = 'flex';
                    logoContainer.style.alignItems = 'center';
                    logoContainer.style.marginRight = '20px';
                    logoContainer.style.zIndex = '999999';
                    logoContainer.innerHTML = '<a href=\"/\" style=\"display:block;\"><img src=\"/wp-content/uploads/latin-logo.jpg\" style=\"max-width: 160px; height: auto; border-radius: 8px; display: block !important; visibility: visible !important; opacity: 1 !important;\" alt=\"LATIN Logo\" /></a>';
                    
                    if (headerLeft.firstChild) { headerLeft.insertBefore(logoContainer, headerLeft.firstChild); } 
                    else { headerLeft.appendChild(logoContainer); }
                }
            }, 100);
        });

        var style = document.createElement('style');
        style.innerHTML = '@keyframes latinBgZoom { 0% { background-size: 100% auto; } 50% { background-size: 110% auto; } 100% { background-size: 100% auto; } }' +
            '@keyframes latinFadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }' +
            '.latin-bg-animate { animation: latinBgZoom 20s infinite alternate ease-in-out; }' +
            '@media (max-width: 768px) { .latin-bg-animate { animation: none !important; } }' +
            '.site-header, #ast-desktop-header { position: sticky !important; top: 0; z-index: 9999; background: rgba(20, 30, 20, 0.95) !important; backdrop-filter: blur(8px); box-shadow: 0 2px 15px rgba(0,0,0,0.5); }' +
            '@media (max-width: 768px) {' +
            '  .site-footer .ast-builder-html-element { display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 20px; }' +
            '  .site-footer .ast-builder-html-element p { margin-bottom: 0 !important; font-weight: 500; font-size: 14px; }' +
            '  .site-footer .ast-footer-html-2 img { max-width: 120px !important; height: auto !important; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }' +
            '}';
        document.head.appendChild(style);
        </script>";
    }
}
add_action("wp_footer", "modify_latin_homepage_js", 99);

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
