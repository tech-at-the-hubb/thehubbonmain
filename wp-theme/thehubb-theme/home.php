<?php
/**
 * Blog posts index (home.php)
 *
 * WordPress uses this template for the "Posts page" set in
 * Settings → Reading → "Posts page".
 * Create a page with slug "blog" and assign it as the Posts page.
 *
 * Note: archive.php handles date/category/tag/author archives.
 */

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<section class="section">
    <div class="grid grid__fullplus">
        <h2 class="page-title">Resources</h2>

        <?php if ( have_posts() ) : ?>
            <div class="blog-listing">
                <?php while ( have_posts() ) : the_post(); ?>
                    <a class="blog-post-card" href="<?php the_permalink(); ?>">
                        <p class="post-meta">
                            <?php echo esc_html( get_the_date() ); ?>
                            <?php
                            $attribution = function_exists( 'get_field' ) ? get_field( 'attribution' ) : '';
                            if ( $attribution ) : ?>
                                &middot; <?php echo esc_html( $attribution ); ?>
                            <?php endif; ?>
                        </p>
                        <h3 class="post-title"><?php the_title(); ?></h3>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <span class="read-more">Read more</span>
                    </a>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="blog-pagination typography__echo" style="margin-top: 32px;">
                <?php the_posts_pagination( [
                    'prev_text' => '&larr; Older posts',
                    'next_text' => 'Newer posts &rarr;',
                ] ); ?>
            </div>

        <?php else : ?>
            <p class="typography__alpha color--neutral8">
                No posts yet — check back soon!
            </p>
        <?php endif; ?>

    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
