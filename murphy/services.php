<?php
$pageTitle = 'Services | Murphy Express Spa & Salon';
$currentPage = 'services';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
    <div class="container page-hero-grid">
        <div>
            <p class="eyebrow">Massage Services</p>
            <h1>A massage-only service menu presented with a richer and more premium experience.</h1>
            <p class="lead">This page now focuses fully on the therapies shown in the reference site and presents them in a more upscale booking-ready format.</p>
        </div>
        <img src="<?= htmlspecialchars($site['massage_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Premium massage spa room">
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Therapy Collection</p>
            <h2>Eight signature massage experiences for relaxation, recovery, and shared wellness.</h2>
        </div>
        <div class="grid cards-4">
            <?php foreach ($site['therapy_menu'] as $therapy): ?>
                <article class="info-card therapy-card">
                    <h3><?= htmlspecialchars($therapy['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($therapy['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container service-showcase">
        <article class="service-feature">
            <img src="<?= htmlspecialchars($site['stone_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Hot stone massage therapy">
            <div>
                <p class="eyebrow">Deep Relaxation</p>
                <h2>Hot stone, Swedish, and aroma rituals for a softer, calmer reset.</h2>
                <p>These sessions are ideal when your body needs a gentler release, a quieter mind, and the feeling of being fully taken care of in a warm, premium setting.</p>
            </div>
        </article>

        <article class="service-feature reverse">
            <img src="<?= htmlspecialchars($site['interior_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Massage spa interior">
            <div>
                <p class="eyebrow">Targeted Recovery</p>
                <h2>Deep tissue, Thai, and Balinese therapies for a stronger reset.</h2>
                <p>For guests dealing with body fatigue, stiffness, or accumulated strain, these treatments bring more structure, pressure, and full-body rebalancing.</p>
            </div>
        </article>

        <article class="service-feature">
            <img src="<?= htmlspecialchars($site['about_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Couple massage inspired premium setting">
            <div>
                <p class="eyebrow">Special Moments</p>
                <h2>Couple and prenatal-friendly sessions built around comfort and care.</h2>
                <p>Whether you are planning a shared spa visit or choosing supportive bodywork during pregnancy, the experience is kept calm, private, and thoughtfully paced.</p>
            </div>
        </article>
    </div>
</section>

<section class="section">
    <div class="container faq-shell">
        <div class="section-heading">
            <p class="eyebrow">FAQ</p>
            <h2>Helpful answers before you select your therapy.</h2>
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
<?php require_once __DIR__ . '/includes/footer.php'; ?>
