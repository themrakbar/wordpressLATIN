<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LATIN - Lembaga Alam Tropika Indonesia</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Mewujudkan Wana Kanaya Sembada 2045 melalui perhutanan sosial, pemberdayaan masyarakat adat, dan pengelolaan sumber daya alam berkelanjutan.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/style.css">
<?php wp_head(); ?></head>
<body>
    <!-- Custom Cursor -->
    <div class="cursor-dot" id="cursor-dot"></div>
    <div class="cursor-outline" id="cursor-outline"></div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="logo" style="align-items: center; gap: 12px;">
                <img src="<?php echo get_template_directory_uri(); ?>/images/latin-logo.jpg" alt="Logo LATIN" style="height: 36px; width: auto; mix-blend-mode: multiply; border-radius: 4px;">
                <div style="display: flex; align-items: baseline;">
                    <span class="logo-text">LATIN.</span>
                    <span class="logo-dot"></span>
                </div>
            </a>
            
            <div class="nav-links" id="nav-links">
                <a href="#beranda" class="nav-item active">Beranda</a>
                <a href="https://latin.or.id/latin-team/" target="_blank" class="nav-item">Tentang</a>
                <a href="#kegiatan" class="nav-item">Kegiatan</a>
                <a href="#dampak" class="nav-item">Dampak</a>
                <a href="https://latin.or.id/produk-komunitas/" target="_blank" class="btn btn-primary nav-cta">Dukung Kami</a>
            </div>

            <div class="hamburger" id="hamburger">
                <i class="ri-menu-4-line"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="beranda">
        <!-- Abstract Background Shapes -->
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <div class="hero-container">
            <div class="hero-content" data-scroll="fade-up">
                <div style="display: inline-flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/latin-logo.jpg" alt="Logo LATIN" style="width: 72px; height: 72px; object-fit: cover; border-radius: 50%; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2); border: 3px solid white;">
                    <div class="badge" style="margin-bottom: 0;">
                        <span class="badge-dot"></span>
                        Menuju Wana Kanaya Sembada 2045
                    </div>
                </div>
                <h1 class="hero-title">
                    Harmoni Manusia <br>
                    <span class="text-gradient">& Hutan Tropis</span>
                </h1>
                <p class="hero-desc">
                    Kami mendorong keadilan ekologis melalui Perhutanan Sosial, memberdayakan masyarakat adat dan lokal untuk pengelolaan sumber daya alam yang berkelanjutan.
                </p>
                <div class="hero-actions">
                    <a href="#kegiatan" class="btn btn-primary btn-lg">
                        Lihat Aksi Kami <i class="ri-arrow-right-line"></i>
                    </a>
                    <a href="#tentang" class="btn btn-outline btn-lg">
                        <i class="ri-play-circle-line"></i> Pelajari LATIN
                    </a>
                </div>
            </div>
            
            <div class="hero-visual" data-scroll="fade-left">
                                <!-- Swiper Slider for Featured Activities -->
                <div class="swiper hero-slider glass-card main-card" style="padding: 0; overflow: hidden;">
                    <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Pameran Produk KUPS" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Pameran Produk KUPS</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Eksplorasi Karst &amp; Gua Solok Selatan" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Eksplorasi Karst &amp; Gua Solok Selatan</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Bincang Kopi Bersama Komunitas Hutan" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Bincang Kopi Bersama Komunitas Hutan</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Pemanfaatan Tanaman Obat Tradisional" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Pemanfaatan Tanaman Obat Tradisional</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Diskusi Konflik Agraria &amp; Hak Adat" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Diskusi Konflik Agraria &amp; Hak Adat</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                                <div class="swiper-slide">
                            <div class="card-img-wrapper" style="height: 100%; position: relative;">
                                                                                                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Konsolidasi Jaringan Perhutanan Sosial" style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                    
                                <div class="slider-caption glass-panel">
                                    <div class="badge-category">Lainnya</div>
                                    <h3 class="text-white font-bold text-lg leading-tight mt-2">Konsolidasi Jaringan Perhutanan Sosial</h3>
                                    <a href="#kegiatan" class="btn btn-sm btn-white mt-3" style="padding: 8px 16px; font-size: 0.85rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                                            </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                            </div>
        </div>

        <div class="scroll-indicator">
            <span class="mouse">
                <span class="wheel"></span>
            </span>
        </div>
    </header>

    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="container">
            <div class="section-header center" data-scroll="fade-up">
                <h2 class="section-title">Merajut Kehidupan,<br>Memulihkan <span class="text-gradient">Ekosistem</span></h2>
                <p class="section-desc">Lembaga Alam Tropika Indonesia (LATIN) telah berdedikasi sejak 1989 untuk memfasilitasi gerakan perhutanan sosial yang berkeadilan di Indonesia.</p>
            </div>

            <div class="features-grid">
                                <a href="https://latin.or.id/" target="_blank" class="feature-card glass-panel" data-scroll="fade-up" data-delay="100" style="display: flex; flex-direction: column; text-decoration: none; color: inherit; padding: 0; overflow: hidden;">
                    <div style="height: 200px; width: 100%; overflow: hidden; position: relative;">
                                                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Perhutanan Sosial" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="feature-img">
                                                <div style="position: absolute; bottom: -20px; left: 24px; background: var(--primary-light); color: var(--primary-color); width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; border-radius: 16px; font-size: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 3px solid white; z-index: 2;" class="feature-icon-new">
                            <i class="ri-plant-line"></i>
                        </div>
                    </div>
                    <div style="padding: 40px 24px 24px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                        <h3 style="font-size: 1.35rem; margin-bottom: 12px; font-weight: 800; color: #0f172a;">Perhutanan Sosial</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">Mendampingi kelompok masyarakat dalam mengamankan hak kelola hutan dan meningkatkan kapasitas kelembagaan.</p>
                        <div class="mt-4 pt-4 text-primary font-bold flex items-center justify-between" style="border-top: 1px dashed #e2e8f0; font-size: 0.9rem;">
                            <span>Pelajari lebih lanjut</span>
                            <i class="ri-arrow-right-line transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
                                <a href="https://latin.or.id/e-learning/" target="_blank" class="feature-card glass-panel" data-scroll="fade-up" data-delay="200" style="display: flex; flex-direction: column; text-decoration: none; color: inherit; padding: 0; overflow: hidden;">
                    <div style="height: 200px; width: 100%; overflow: hidden; position: relative;">
                                                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Edukasi &amp; SESORE" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="feature-img">
                                                <div style="position: absolute; bottom: -20px; left: 24px; background: var(--primary-light); color: var(--primary-color); width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; border-radius: 16px; font-size: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 3px solid white; z-index: 2;" class="feature-icon-new">
                            <i class="ri-book-open-line"></i>
                        </div>
                    </div>
                    <div style="padding: 40px 24px 24px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                        <h3 style="font-size: 1.35rem; margin-bottom: 12px; font-weight: 800; color: #0f172a;">Edukasi &amp; SESORE</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">Sekolah Sosial dan Resolusi Konflik (SESORE) untuk mencetak kader rimbawan muda yang kritis dan progresif.</p>
                        <div class="mt-4 pt-4 text-primary font-bold flex items-center justify-between" style="border-top: 1px dashed #e2e8f0; font-size: 0.9rem;">
                            <span>Pelajari lebih lanjut</span>
                            <i class="ri-arrow-right-line transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
                                <a href="https://latin.or.id/advokasi-kebijakan/" target="_blank" class="feature-card glass-panel" data-scroll="fade-up" data-delay="300" style="display: flex; flex-direction: column; text-decoration: none; color: inherit; padding: 0; overflow: hidden;">
                    <div style="height: 200px; width: 100%; overflow: hidden; position: relative;">
                                                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80" alt="Advokasi Kebijakan" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="feature-img">
                                                <div style="position: absolute; bottom: -20px; left: 24px; background: var(--primary-light); color: var(--primary-color); width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; border-radius: 16px; font-size: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 3px solid white; z-index: 2;" class="feature-icon-new">
                            <i class="ri-scales-3-line"></i>
                        </div>
                    </div>
                    <div style="padding: 40px 24px 24px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                        <h3 style="font-size: 1.35rem; margin-bottom: 12px; font-weight: 800; color: #0f172a;">Advokasi Kebijakan</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">Mendorong kebijakan pro-rakyat dan resolusi konflik tenurial antara negara, korporasi, dan masyarakat sipil.</p>
                        <div class="mt-4 pt-4 text-primary font-bold flex items-center justify-between" style="border-top: 1px dashed #e2e8f0; font-size: 0.9rem;">
                            <span>Pelajari lebih lanjut</span>
                            <i class="ri-arrow-right-line transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
                            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="events-section" id="events">
        <div class="container">
            <div class="section-header center" data-scroll="fade-up">
                <h2 class="section-title">Upcoming <span class="text-gradient">Events</span></h2>
                <p class="section-desc">All events about social forestry here.</p>
            </div>

            <div class="event-list" data-scroll="fade-up" data-delay="100">
                <div class="event-list-header">
                    Events
                </div>
                
                                                            <a href="<?php echo get_site_url(); ?>/panel/event/1" class="event-item" style="text-decoration: none; color: inherit; display: flex;">
                                                                                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&amp;fit=crop&amp;q=80&amp;w=800" alt="Halimun Eco Trek 2026" class="event-image">
                                                                                        
                            <div class="event-date-badge">
                                <div class="day">12</div>
                                <div class="month">Jul</div>
                            </div>
                            
                            <div class="event-details">
                                <h3>Halimun Eco Trek 2026</h3>
                                <div class="event-meta">
                                    <span>
                                        <i class="ri-time-line"></i> 2026-07-12
                                    </span>
                                    <span>
                                        <i class="ri-map-pin-line"></i> Desa Cipeuteuy, Sukabumi
                                    </span>
                                </div>
                            </div>
                        </a>
                                            <a href="<?php echo get_site_url(); ?>/panel/event/2" class="event-item" style="text-decoration: none; color: inherit; display: flex;">
                                                                                                <img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&amp;fit=crop&amp;q=80&amp;w=800" alt="Pelatihan Tanam, Tumbuh, Tuai (3T)" class="event-image">
                                                                                        
                            <div class="event-date-badge">
                                <div class="day">19</div>
                                <div class="month">Jul</div>
                            </div>
                            
                            <div class="event-details">
                                <h3>Pelatihan Tanam, Tumbuh, Tuai (3T)</h3>
                                <div class="event-meta">
                                    <span>
                                        <i class="ri-time-line"></i> 2026-07-19
                                    </span>
                                    <span>
                                        <i class="ri-map-pin-line"></i> Kampung Sukagalih
                                    </span>
                                </div>
                            </div>
                        </a>
                                            <a href="<?php echo get_site_url(); ?>/panel/event/3" class="event-item" style="text-decoration: none; color: inherit; display: flex;">
                                                                                                <img src="https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&amp;fit=crop&amp;q=80&amp;w=800" alt="PANDU-WISTA &amp; Melak Kopi" class="event-image">
                                                                                        
                            <div class="event-date-badge">
                                <div class="day">28</div>
                                <div class="month">Jul</div>
                            </div>
                            
                            <div class="event-details">
                                <h3>PANDU-WISTA &amp; Melak Kopi</h3>
                                <div class="event-meta">
                                    <span>
                                        <i class="ri-time-line"></i> 2026-07-28
                                    </span>
                                    <span>
                                        <i class="ri-map-pin-line"></i> Kawasan Hutan Sosial
                                    </span>
                                </div>
                            </div>
                        </a>
                                                </div>
        </div>
    </section>

    <!-- Activities/API Section -->
    <section class="activities" id="kegiatan">
        <div class="container">
            <div class="section-header flex-header" data-scroll="fade-up">
                <div>
                    <span class="section-subtitle">Live Update</span>
                    <h2 class="section-title">Aksi <span class="text-gradient">Nyata</span> LATIN</h2>
                </div>
                <div class="filter-container">
                    <button class="filter-btn active" data-filter="all">Semua Aksi</button>
                    <!-- Kategori akan di-load via JS -->
                </div>
            </div>

            <!-- Container for API Data -->
            <div class="activities-grid" id="activities-container">
                <!-- Skeleton Loading -->
                <div class="skeleton-card"></div>
                <div class="skeleton-card"></div>
                <div class="skeleton-card"></div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="btn btn-outline" id="load-more-btn">
                    Muat Lebih Banyak <i class="ri-loader-4-line"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Impact/CTA Section -->
    <section class="impact" id="dampak">
        <div class="impact-bg"></div>
        <div class="container">
            <div class="impact-content glass-panel" data-scroll="zoom-in">
                <h2>Siap Menjadi Bagian dari <br>Perubahan Ekologis?</h2>
                <p>Bersama-sama, kita wujudkan hutan yang lestari untuk masyarakat yang sejahtera di Wana Kanaya Sembada 2045.</p>
                <div class="impact-actions">
                    <a href="https://wa.me/6281311162045" target="_blank" class="btn btn-primary btn-lg">
                        <i class="ri-whatsapp-line" style="font-size: 1.25em;"></i> Kolaborasi Sekarang
                    </a>
                    <a href="https://latin.or.id/produk-komunitas/" target="_blank" class="btn btn-white btn-lg">Beli Produk Komunitas</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <span class="logo-text">LATIN.</span>
                        <span class="logo-dot"></span>
                    </a>
                    <p>Lembaga Alam Tropika Indonesia (LATIN) - Merajut asa di tepian rimba, mewujudkan keadilan ekologis berbasis masyarakat.</p>
                    <div class="social-links">
                        <a href="https://www.youtube.com/@LATIN2045" target="_blank" title="YouTube"><i class="ri-youtube-fill"></i></a>
                        <a href="https://www.instagram.com/latin_id/" target="_blank" title="Instagram"><i class="ri-instagram-line"></i></a>
                        <a href="https://x.com/latin_id?s=21" target="_blank" title="X / Twitter"><i class="ri-twitter-x-line"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100088551982641&locale=id_ID" target="_blank" title="Facebook"><i class="ri-facebook-circle-fill"></i></a>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h4>Jelajahi</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="https://latin.or.id/latin-team/" target="_blank">Tentang Kami</a></li>
                        <li><a href="#kegiatan">Kegiatan Terbaru</a></li>
                        <li><a href="https://latin.or.id/book/" target="_blank">Publikasi & Laporan</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4>Program</h4>
                    <ul>
                        <li><a href="#">Perhutanan Sosial</a></li>
                        <li><a href="https://latin.or.id/e-learning/" target="_blank">Sekolah SESORE</a></li>
                        <li><a href="https://latin.or.id/community-hub/" target="_blank">KUPS Hub</a></li>
                        <li><a href="https://latin.or.id/advokasi-kebijakan/" target="_blank">Advokasi Kebijakan</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>Hubungi Kami</h4>
                    <ul>
                        <li><i class="ri-map-pin-line"></i> Jl. Sutera No. 1, Bogor, Jawa Barat</li>
                        <li><i class="ri-mail-line"></i> info@latin.or.id</li>
                        <li><a href="https://wa.me/6281311162045" target="_blank" style="color: inherit; text-decoration: none;"><i class="ri-whatsapp-line"></i> +62 813-1116-2045</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2026 Lembaga Alam Tropika Indonesia. Hak Cipta Dilindungi.</p>
                <div class="footer-legal">
                    <a href="https://latin.or.id/" target="_blank">Kebijakan Privasi</a>
                    <a href="https://latin.or.id/" target="_blank">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal for Event Details -->
    <div class="modal-overlay" id="activity-modal">
        <div class="modal-content glass-panel">
            <button class="modal-close" id="modal-close"><i class="ri-close-line"></i></button>
            <div class="modal-body">
                <img id="modal-img" src="" alt="Activity Image" class="modal-img">
                <div class="modal-text">
                    <div class="card-meta">
                        <span class="card-category" id="modal-category"></span>
                        <span class="card-date" id="modal-date"></span>
                    </div>
                    <h2 id="modal-title" class="modal-title"></h2>
                    <div id="modal-details" class="modal-details"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(document.querySelector('.hero-slider')) {
                const heroSwiper = new Swiper('.hero-slider', {
                    loop: true,
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        });
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/app.js"></script>
    <?php wp_footer(); ?>
</body>
</html>
