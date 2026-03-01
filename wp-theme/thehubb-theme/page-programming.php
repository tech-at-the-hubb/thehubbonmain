<?php
/**
 * Template Name: Programming Page
 *
 * Lists all published `program` CPT entries.
 * Create a page with slug "programming" and WordPress will use this
 * template automatically via the page-{slug}.php hierarchy.
 */

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<section class="section">
    <div class="grid grid__fullplus">
        <h2 class="page-title">Programming</h2>

        <div class="programs-wrapper">
            <?php
            $programs_query = new WP_Query( [
                'post_type'      => 'program',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ] );

            if ( $programs_query->have_posts() ) :
                while ( $programs_query->have_posts() ) :
                    $programs_query->the_post();
                    get_template_part( 'template-parts/program-card' );
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p class="typography__alpha color--neutral8">No programs listed at this time. Please check back soon.</p>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
