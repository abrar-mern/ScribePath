<?php
$pageTitle = 'Murphy Express Spa & Salon | Luxury Massage Spa in Pune';
$currentPage = 'home';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero" style="--hero-image: url('<?= htmlspecialchars($site['hero_image'], ENT_QUOTES, 'UTF-8') ?>');">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow">Premium Massage Destination</p>
            <h1>Immersive massage rituals shaped for deep relaxation and premium comfort.</h1>
            <p class="lead">Murphy Express Spa & Salon is positioned as a refined massage-focused destination where warm interiors, expert touch, and globally inspired therapies come together for a more luxurious escape.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="services.php">Explore Massage Services</a>
                <a class="button button-secondary" href="contact.php">Book Appointment</a>
            </div>
            <div class="hero-stats">
                <article><strong>8</strong><span>Massage experiences curated for every mood and body need</span></article>
                <article><strong>4</strong><span>Convenient Pune locations for easy bookings</span></article>
                <article><strong>11 AM - 9 PM</strong><span>Open every day for daytime or evening sessions</span></article>
            </div>
        </div>
        <div class="hero-card surface-card">
            <p class="eyebrow">Featured Rituals</p>
            <h2>Body therapies from around the world.</h2>
            <ul class="check-list">
                <li>Hot Stone Massage</li>
                <li>Swedish Massage</li>
                <li>Deep Tissue Massage</li>
                <li>Thai & Balinese Rituals</li>
                <li>Couple Massage Suites</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Signature Menu</p>
            <h2>A premium massage collection designed to restore, release, and rebalance.</h2>
        </div>
        <div class="grid cards-4">
            <?php foreach ($site['services'] as $service): ?>
                <article class="info-card">
                    <h3><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container split-layout">
        <div class="image-stack">
            <img src="<?= htmlspecialchars($site['interior_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Luxury massage spa interior">
            <img class="floating-image" src="<?= htmlspecialchars($site['stone_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Massage setting with warm stones">
        </div>
        <div class="content-block">
            <p class="eyebrow">A Premium Escape</p>
            <h2>Warm light, calming aromas, and treatments that slow the pace of the day.</h2>
            <p>The reference brand already carries a strong message of comfort and calm. This redesigned experience takes that core idea and presents it with richer structure, stronger visual hierarchy, and a more premium digital feel.</p>
            <p>Every visit is framed around massage-led wellness, from stress relief and muscular reset to couple relaxation and deeply restorative body rituals.</p>
            <a class="button button-primary" href="about.php">Discover Our Story</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Why Choose Murphy</p>
            <h2>Luxury is felt in the details before, during, and after the massage.</h2>
        </div>
        <div class="grid cards-2">
            <?php foreach ($site['highlights'] as $highlight): ?>
                <article class="info-card feature-card">
                    <span class="feature-orb"></span>
                    <p><?= htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">The Experience</p>
            <h2>Your visit follows a calm, intentional wellness journey.</h2>
        </div>
        <div class="journey-grid">
            <?php foreach ($site['journey'] as $step): ?>
                <article class="journey-card">
                    <span class="journey-count"></span>
                    <h3><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($step['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container offer-banner">
        <div>
            <p class="eyebrow">Special Offer</p>
            <h2>Book a massage session and enjoy up to 25% off selected wellness packages.</h2>
        </div>
        <a class="button button-secondary" href="contact.php">Claim Your Offer</a>
    </div>
</section>

<section class="section section-dark">
    <div class="container">
        <div class="section-heading narrow">
            <p class="eyebrow">Guest Love</p>
            <h2>Clients remember how the experience feels.</h2>
        </div>
        <div class="grid cards-3">
            <?php foreach ($site['testimonials'] as $testimonial): ?>
                <article class="testimonial-card">
                    <p>“<?= htmlspecialchars($testimonial['quote'], ENT_QUOTES, 'UTF-8') ?>”</p>
                    <strong><?= htmlspecialchars($testimonial['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container faq-shell">
        <div class="section-heading">
            <p class="eyebrow">FAQ</p>
            <h2>Questions guests usually ask before booking.</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($site['faqs'] as $faq): ?>
                <details class="faq-item">
                    <summary><?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></summary>
                    <p><?= htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8') ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container inquiry-banner">
        <div>
            <p class="eyebrow">Quick Inquiry</p>
            <h2>Need pricing, availability, or a couple massage slot?</h2>
            <p>Use the form on the contact page or chat instantly on WhatsApp for a faster response.</p>
        </div>
        <div class="hero-actions">
            <a class="button button-primary" href="contact.php#inquiry-form">Open Inquiry Form</a>
            <a class="button button-secondary" href="https://wa.me/<?= htmlspecialchars($site['whatsapp'], ENT_QUOTES, 'UTF-8') ?>?text=Hello%20I%20want%20to%20know%20about%20massage%20booking." target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
