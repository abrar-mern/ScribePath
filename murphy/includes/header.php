<?php
require_once __DIR__ . '/site.php';
$pageTitle = $pageTitle ?? $site['name'];
$currentPage = $currentPage ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="Discover luxury massage therapies, couple rituals, and premium wellness experiences at Murphy Express Spa & Salon in Pune.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="site-shell">
        <header class="site-header">
            <div class="container nav-wrap">
                <a class="brand" href="index.php">
                    <span class="brand-mark">M</span>
                    <span>
                        <strong><?= htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                        <small>Luxury massage & wellness</small>
                    </span>
                </a>
                <button class="nav-toggle" type="button" aria-expanded="false" aria-label="Toggle menu" data-nav-toggle>
                    <span></span>
                    <span></span>
                </button>
                <nav class="site-nav" data-nav>
                    <a class="<?= is_active_page('home', $currentPage) ?>" href="index.php">Home</a>
                    <a class="<?= is_active_page('about', $currentPage) ?>" href="about.php">About</a>
                    <a class="<?= is_active_page('services', $currentPage) ?>" href="services.php">Services</a>
                    <a class="<?= is_active_page('contact', $currentPage) ?>" href="contact.php">Contact</a>
                    <a class="nav-cta" href="contact.php">Book Appointment</a>
                </nav>
            </div>
        </header>
        <main>
