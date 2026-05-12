<?php
require_once __DIR__ . '/includes/site.php';

$formData = [
    'name' => '',
    'phone' => '',
    'service' => '',
    'message' => '',
];
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name'] = trim($_POST['name'] ?? '');
    $formData['phone'] = trim($_POST['phone'] ?? '');
    $formData['service'] = trim($_POST['service'] ?? '');
    $formData['message'] = trim($_POST['message'] ?? '');

    if ($formData['name'] === '') {
        $errors['name'] = 'Please enter your name.';
    }

    if ($formData['phone'] === '') {
        $errors['phone'] = 'Please enter your phone number.';
    }

    if ($formData['service'] === '') {
        $errors['service'] = 'Please select a massage service.';
    }

    if ($formData['message'] === '') {
        $errors['message'] = 'Please tell us what kind of appointment you need.';
    }

    if (!$errors) {
        $subject = 'Massage Inquiry - Murphy Express Spa & Salon';
        $body = "Name: {$formData['name']}\n"
            . "Phone: {$formData['phone']}\n"
            . "Service: {$formData['service']}\n\n"
            . "Message:\n{$formData['message']}\n";
        $headers = 'From: noreply@murphyexpressspasalon.com';

        if (function_exists('mail')) {
            @mail($site['email'], $subject, $body, $headers);
        }

        $successMessage = 'Your inquiry has been sent. Our team will contact you soon.';
        $formData = [
            'name' => '',
            'phone' => '',
            'service' => '',
            'message' => '',
        ];
    }
}

$pageTitle = 'Contact | Murphy Express Spa & Salon';
$currentPage = 'contact';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
    <div class="container page-hero-grid">
        <div>
            <p class="eyebrow">Contact & Booking</p>
            <h1>Book your next massage ritual or send an inquiry in seconds.</h1>
            <p class="lead">This page now includes the missing premium contact form, direct chat access, and clearer booking guidance for massage appointments.</p>
        </div>
        <img src="<?= htmlspecialchars($site['interior_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Luxury massage wellness interior">
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div class="surface-card contact-panel">
            <p class="eyebrow">Get In Touch</p>
            <h2>Appointments made simple.</h2>
            <p><strong>Primary Phone</strong><br><a href="tel:<?= preg_replace('/[^0-9+]/', '', $site['phone_primary']) ?>"><?= htmlspecialchars($site['phone_primary'], ENT_QUOTES, 'UTF-8') ?></a></p>
            <p><strong>Alternate Phone</strong><br><a href="tel:<?= preg_replace('/[^0-9+]/', '', $site['phone_secondary']) ?>"><?= htmlspecialchars($site['phone_secondary'], ENT_QUOTES, 'UTF-8') ?></a></p>
            <p><strong>Email</strong><br><a href="mailto:<?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></a></p>
            <p><strong>Opening Hours</strong><br><?= htmlspecialchars($site['hours'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="hero-actions">
                <a class="button button-primary" href="https://wa.me/<?= htmlspecialchars($site['whatsapp'], ENT_QUOTES, 'UTF-8') ?>?text=Hello%20I%20want%20to%20book%20a%20massage." target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
            </div>
        </div>
        <div class="surface-card contact-panel" id="inquiry-form">
            <p class="eyebrow">Inquiry Form</p>
            <h2>Tell us the massage experience you want.</h2>
            <?php if ($successMessage): ?>
                <p class="form-success"><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
            <form class="booking-form" method="post" action="contact.php#inquiry-form">
                <label>
                    <span>Your Name</span>
                    <input type="text" name="name" value="<?= htmlspecialchars($formData['name'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Enter your name">
                    <?php if (isset($errors['name'])): ?><small class="form-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
                </label>
                <label>
                    <span>Phone Number</span>
                    <input type="text" name="phone" value="<?= htmlspecialchars($formData['phone'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Enter your phone number">
                    <?php if (isset($errors['phone'])): ?><small class="form-error"><?= htmlspecialchars($errors['phone'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
                </label>
                <label>
                    <span>Select Service</span>
                    <select name="service">
                        <option value="">Choose a massage service</option>
                        <?php foreach ($site['therapy_menu'] as $therapy): ?>
                            <option value="<?= htmlspecialchars($therapy['title'], ENT_QUOTES, 'UTF-8') ?>" <?= $formData['service'] === $therapy['title'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($therapy['title'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['service'])): ?><small class="form-error"><?= htmlspecialchars($errors['service'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
                </label>
                <label>
                    <span>Message</span>
                    <textarea name="message" rows="5" placeholder="Tell us your preferred massage, date, time, or location"><?= htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
                    <?php if (isset($errors['message'])): ?><small class="form-error"><?= htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
                </label>
                <button class="button button-primary" type="submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Locations</p>
            <h2>Visit the branch that works best for you.</h2>
        </div>
        <div class="grid cards-2">
            <?php foreach ($site['locations'] as $location): ?>
                <article class="location-card">
                    <h3><?= htmlspecialchars($location['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($location['address'], ENT_QUOTES, 'UTF-8') ?></p>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $location['phone']) ?>"><?= htmlspecialchars($location['phone'], ENT_QUOTES, 'UTF-8') ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container faq-shell">
        <div class="section-heading">
            <p class="eyebrow">FAQ</p>
            <h2>Everything important before you arrive.</h2>
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
