<?php
$pageTitle = 'About | Murphy Express Spa & Salon';
$currentPage = 'about';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
    <div class="container page-hero-grid">
        <div>
            <p class="eyebrow">About Murphy Express</p>
            <h1>Wellness with heritage, hospitality, and a distinctly luxurious point of view.</h1>
            <p class="lead">Established in 2005, Murphy Express Spa & Salon has grown into a recognizable wellness name in Pune with a focus on premium treatment rooms, trained massage therapists, and deeply calming body rituals.</p>
        </div>
        <img src="<?= htmlspecialchars($site['about_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Guest relaxing in a premium spa setting">
    </div>
</section>

<section class="section">
    <div class="container split-layout reverse">
        <div class="content-block">
            <p class="eyebrow">Who We Are</p>
            <h2>A massage-led spa experience built around memorable relaxation.</h2>
            <p>Inspired by the reference website content, Murphy Express is presented as a place where Eastern wellness traditions meet modern massage therapies. The experience is designed for guests seeking relief from stress, body fatigue, and the demands of fast-paced city life.</p>
            <p>Long-term staff training, carefully selected products, and thoughtful service rituals create a setting where guests feel genuinely looked after from arrival to departure.</p>
        </div>
        <div class="surface-card stats-panel">
            <article>
                <strong>800+</strong>
                <span>Therapies delivered with care</span>
            </article>
            <article>
                <strong>550+</strong>
                <span>Wellness procedures and massage sessions</span>
            </article>
            <article>
                <strong>900+</strong>
                <span>Happy clients and returning guests</span>
            </article>
            <article>
                <strong>120+</strong>
                <span>Skin treatment programs completed</span>
            </article>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">The Murphy Standard</p>
            <h2>What makes the experience feel elevated.</h2>
        </div>
        <div class="grid cards-3">
            <article class="info-card">
                <h3>Atmosphere First</h3>
                <p>Soft lighting, warm textures, and tranquil styling shape the mood before the treatment even begins.</p>
            </article>
            <article class="info-card">
                <h3>Tailored Treatments</h3>
                <p>Every massage session is guided by guest comfort, body needs, and desired outcomes.</p>
            </article>
            <article class="info-card">
                <h3>Trusted Wellness Care</h3>
                <p>Guests choose Murphy Express for both indulgent relaxation and support during demanding physical routines.</p>
            </article>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
