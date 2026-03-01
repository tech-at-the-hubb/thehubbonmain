<?php
/**
 * Generic page template — used for any WordPress page that doesn't
 * have a more specific template (front-page.php, page-{slug}.php, etc.)
 */

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<section class="section">
    <div class="grid grid__fullplus">

        <?php while ( have_posts() ) : the_post(); ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
            <div class="typography__alpha color--neutral8" style="margin-top: 24px;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>

    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
