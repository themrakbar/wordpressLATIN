document.addEventListener('DOMContentLoaded', () => {
    /* -----------------------------------------
       1. Custom Cursor Implementation
    ----------------------------------------- */
    const cursorDot = document.getElementById('cursor-dot');
    const cursorOutline = document.getElementById('cursor-outline');

    window.addEventListener('mousemove', (e) => {
        const posX = e.clientX;
        const posY = e.clientY;

        // Move dot instantly
        if (cursorDot) {
            cursorDot.style.left = `${posX}px`;
            cursorDot.style.top = `${posY}px`;
        }

        // Move outline with a slight delay using transform for smoothness
        if (cursorOutline) {
            cursorOutline.animate({
                left: `${posX}px`,
                top: `${posY}px`
            }, { duration: 500, fill: "forwards" });
        }
    });

    // Cursor hover effects on links and buttons
    const hoverElements = document.querySelectorAll('a, button, .feature-card, .activity-card');
    hoverElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            if (cursorOutline) {
                cursorOutline.style.width = '60px';
                cursorOutline.style.height = '60px';
                cursorOutline.style.backgroundColor = 'rgba(16, 185, 129, 0.1)';
            }
        });
        el.addEventListener('mouseleave', () => {
            if (cursorOutline) {
                cursorOutline.style.width = '40px';
                cursorOutline.style.height = '40px';
                cursorOutline.style.backgroundColor = 'transparent';
            }
        });
    });

    /* -----------------------------------------
       2. Scroll Animations (Intersection Observer)
    ----------------------------------------- */
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add class to trigger CSS animation
                entry.target.classList.add('is-visible');
                
                // Handle staggered delays if defined
                if (entry.target.dataset.delay) {
                    entry.target.style.transitionDelay = `${entry.target.dataset.delay}ms`;
                }
                
                // Stop observing once animated
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-scroll]').forEach(el => {
        observer.observe(el);
    });

    /* -----------------------------------------
       3. Navbar Scroll Effect
    ----------------------------------------- */
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    /* -----------------------------------------
       4. Mobile Menu Toggle
    ----------------------------------------- */
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links') || document.querySelector('.nav-links');
    const navItems = document.querySelectorAll('.nav-item');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = hamburger.querySelector('i');
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('ri-menu-4-line');
                    icon.classList.add('ri-close-line');
                } else {
                    icon.classList.remove('ri-close-line');
                    icon.classList.add('ri-menu-4-line');
                }
            }
        });
    }

    // Close menu when clicking a link
    if (navItems.length > 0 && navLinks && hamburger) {
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navLinks.classList.remove('active');
                const icon = hamburger.querySelector('i');
                if (icon) {
                    icon.classList.remove('ri-close-line');
                    icon.classList.add('ri-menu-4-line');
                }
            });
        });
    }

    /* -----------------------------------------
       5. Fetch API Data from CMS
    ----------------------------------------- */
    const activitiesContainer = document.getElementById('activities-container');
    const filterContainer = document.querySelector('.filter-container');
    const API_URL = '/panel/api/activities'; // Relative URL to Laravel API
    
    let allActivities = [];

    async function fetchActivities() {
        try {
            const response = await fetch(API_URL);
            if (!response.ok) throw new Error('Network response was not ok');
            const result = await response.json();
            allActivities = result.data;
            
            renderCategories(allActivities);
            renderActivities(allActivities);
        } catch (error) {
            console.log('Error fetching API:', error);
            // Fallback Dummy Data for demonstration
            allActivities = [
                {
                    title: "Membangun Kemandirian KUPS Kopi Hutan",
                    category: "Edukasi & SESORE",
                    activity_date: "2026-06-25",
                    description: "Pelatihan peningkatan kapasitas produksi untuk Kelompok Usaha Perhutanan Sosial (KUPS) Kopi Hutan di Jawa Barat.",
                    event_details: "<p>Kegiatan ini dihadiri oleh 50 petani kopi lokal yang tergabung dalam KUPS. Tujuan utama adalah...</p>",
                    media_url: "https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&q=80&w=600",
                    instagram_link: "#",
                    youtube_link: ""
                }
            ];
            renderCategories(allActivities);
            renderActivities(allActivities);
        }
    }

    function formatDate(dateString) {
        if (!dateString) return '';
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function renderCategories(activities) {
        if (!filterContainer) return;
        
        // Extract unique categories
        const categories = [...new Set(activities.map(a => a.category).filter(c => c))];
        
        // Reset container (keep 'Semua Aksi')
        filterContainer.innerHTML = '<button class="filter-btn active" data-filter="all">Semua Aksi</button>';
        
        categories.forEach(cat => {
            const btn = document.createElement('button');
            btn.className = 'filter-btn';
            btn.dataset.filter = cat;
            btn.textContent = cat;
            filterContainer.appendChild(btn);
        });

        // Add filter event listeners
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                
                const filter = e.target.dataset.filter;
                if (filter === 'all') {
                    renderActivities(allActivities);
                } else {
                    const filtered = allActivities.filter(a => a.category === filter);
                    renderActivities(filtered);
                }
            });
        });
    }

    function renderActivities(activities) {
        if (!activitiesContainer) return;
        activitiesContainer.innerHTML = ''; // Clear skeleton/previous
        
        activities.forEach((activity, index) => {
            const delay = (index % 3) * 150;
            const imageUrl = activity.media_url || 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=600';
            
            const card = document.createElement('div');
            card.className = 'activity-card';
            card.dataset.tilt = '';
            card.dataset.tiltMax = '5';
            card.dataset.tiltSpeed = '400';
            card.dataset.tiltGlare = 'true';
            card.dataset.tiltMaxGlare = '0.2';
            card.dataset.scroll = 'fade-up';
            card.style.transitionDelay = `${delay}ms`;

            card.innerHTML = `
                <img src="${imageUrl}" alt="${activity.title}" class="card-img">
                <div class="card-body">
                    <div class="card-meta">
                        <span class="card-category">${activity.category || 'Umum'}</span>
                        <span class="card-date"><i class="ri-calendar-line"></i> ${formatDate(activity.activity_date)}</span>
                    </div>
                    <h3 class="card-title">${activity.title}</h3>
                    <p class="card-text">${activity.description || ''}</p>
                    
                    <div class="card-footer">
                        <a href="javascript:void(0)" class="read-more open-modal-btn">Detail Kegiatan <i class="ri-arrow-right-line"></i></a>
                        <div class="social-links-small">
                            ${activity.instagram_link ? `<a href="${activity.instagram_link}" target="_blank"><i class="ri-instagram-line"></i></a>` : ''}
                            ${activity.youtube_link ? `<a href="${activity.youtube_link}" target="_blank"><i class="ri-youtube-line"></i></a>` : ''}
                        </div>
                    </div>
                </div>
            `;
            
            // Attach modal event
            const btnOpen = card.querySelector('.open-modal-btn');
            if (btnOpen) {
                btnOpen.addEventListener('click', () => openModal(activity));
            }

            activitiesContainer.appendChild(card);
        });

        // Initialize VanillaTilt for new cards
        if (typeof VanillaTilt !== 'undefined') {
            VanillaTilt.init(document.querySelectorAll(".activity-card"));
        }
        
        // Re-observe new elements for scroll animation
        document.querySelectorAll('.activity-card[data-scroll]').forEach(el => {
            observer.observe(el);
        });
    }

    /* -----------------------------------------
       6. Modal Logic for Event Details
    ----------------------------------------- */
    const modal = document.getElementById('activity-modal');
    const modalClose = document.getElementById('modal-close');
    
    function openModal(activity) {
        document.getElementById('modal-img').src = activity.media_url || 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&q=80&w=600';
        document.getElementById('modal-category').textContent = activity.category || 'Umum';
        document.getElementById('modal-date').innerHTML = `<i class="ri-calendar-line"></i> ${formatDate(activity.activity_date)}`;
        document.getElementById('modal-title').textContent = activity.title;
        
        // Handle event_details or fallback to description
        let detailsHtml = activity.event_details || activity.description || '<p>Tidak ada detail tambahan.</p>';
        document.getElementById('modal-details').innerHTML = detailsHtml;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    modalClose.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    // Close on overlay click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Initialize API fetch
    fetchActivities();
});
