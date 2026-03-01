<?php
/**
 * Single blog post template
 */

get_template_part( 'template-parts/header' );
get_template_part( 'template-parts/cta' );
?>

<section class="section">
    <div class="grid grid__fullplus">

        <a class="back-to-blog" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">
            &larr; Back to Blog
        </a>

        <?php while ( have_posts() ) : the_post(); ?>

            <article>
                <header class="single-post-header">
                    <p class="single-post-meta">
                        <?php echo esc_html( get_the_date() ); ?>
                        <?php if ( get_the_author() ) : ?>
                            &middot; <?php the_author(); ?>
                        <?php endif; ?>
                    </p>
                    <h2 class="single-post-title"><?php the_title(); ?></h2>
                </header>

                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; ?>

        <!-- Post navigation -->
        <nav class="blog-pagination typography__echo" style="margin-top: 48px; display: flex; gap: 24px; justify-content: space-between;" aria-label="Post navigation">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ( $prev ) : ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">&larr; <?php echo esc_html( $prev->post_title ); ?></a>
            <?php endif;
            if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>"><?php echo esc_html( $next->post_title ); ?> &rarr;</a>
            <?php endif; ?>
        </nav>

    </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
