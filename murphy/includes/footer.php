        </main>
        <footer class="site-footer">
            <div class="container footer-grid">
                <div>
                    <p class="eyebrow">Murphy Express</p>
                    <h3>Relaxation, massage therapy, and expert wellness care in one refined destination.</h3>
                </div>
                <div>
                    <p><strong>Call</strong><br><?= htmlspecialchars($site['phone_primary'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><strong>Email</strong><br><?= htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div>
                    <p><strong>Hours</strong><br><?= htmlspecialchars($site['hours'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </div>
            <div class="container footer-bottom">
                <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8') ?>. All rights reserved.</p>
            </div>
        </footer>
        <a class="chat-float" href="https://wa.me/<?= htmlspecialchars($site['whatsapp'], ENT_QUOTES, 'UTF-8') ?>?text=Hello%20Murphy%20Express%20Spa%20%26%20Salon%2C%20I%20want%20to%20book%20a%20massage." target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
            <span>Chat Now</span>
            <strong>WhatsApp</strong>
        </a>
    </div>
    <script src="assets/js/site.js"></script>
</body>
</html>
