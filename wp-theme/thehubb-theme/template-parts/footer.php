<section class="section section--footer">
    <div class="grid grid__fullplus">
        <div class="grid grid__full--subgrid">

            <!-- Left column -->
            <div class="grid grid__half">
                <div class="typography__echo">
                    <?php echo thehubb_get_option( 'footer_left' ); ?>
                </div>

                <p class="typography__echo">
                    To contact The Hubb directly please email
                    <a href="mailto:info@thehubbonmain.org">info@thehubbonmain.org</a>
                </p>

                <a class="typography__echo"
                   href="https://mailchi.mp/9e695de79495/hubb-newsletter-signup-form"
                   target="_blank"
                   rel="noreferrer noopener">
                    Subscribe to email updates
                </a>

                <div class="social-icons">
                    <a href="https://www.facebook.com/profile.php?id=61550649696448"
                       target="_blank"
                       rel="noreferrer noopener"
                       aria-label="The Hubb on Facebook">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/fb.svg' ); ?>" alt="Facebook logo">
                    </a>
                    <a href="https://www.instagram.com/thehubbonmain/"
                       target="_blank"
                       rel="noreferrer noopener"
                       aria-label="The Hubb on Instagram">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/insta.svg' ); ?>" alt="Instagram logo">
                    </a>
                </div>
            </div>

            <!-- Right column -->
            <div class="grid grid__half">
                <div class="typography__echo">
                    <?php echo thehubb_get_option( 'footer_right' ); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php wp_footer(); ?>
</body>
</html>
