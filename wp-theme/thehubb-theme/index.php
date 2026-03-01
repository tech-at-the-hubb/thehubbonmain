<?php
/**
 * Fallback template — WordPress requires this file to exist.
 * In practice, more specific templates (front-page.php, page.php, etc.) take priority.
 */
get_template_part('template-parts/header');
?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="section">
            <div class="grid grid__fullplus">
                <h2 class="typography__beta color--blue8"><?php the_title(); ?></h2>
                <div class="typography__alpha color--neutral8">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    <?php endwhile; endif; ?>
</main>

<?php get_template_part('template-parts/footer'); ?>
