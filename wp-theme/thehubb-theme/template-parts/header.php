<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<section class="section">
    <div class="grid grid__fullplus">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php bloginfo( 'name' ); ?> — Home">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="The Hubb logo" width="100" height="100">
        </a>

        <header class="grid grid__full--subgrid">
            <div class="grid grid__half title-wrapper">
                <h1 class="site-title">Helping Us Be Better</h1>
                <p class="site-subtitle">Community Resource Satellite Office</p>
            </div>

            <nav class="links-wrapper" aria-label="Primary navigation">
                <a class="typography__beta typography--link color--black" href="<?php echo esc_url( home_url( '/calendar' ) ); ?>">
                    <b>Calendar</b>
                </a>
                <a class="typography__beta typography--link color--black" href="<?php echo esc_url( home_url( '/programming' ) ); ?>">
                    <b>Programming</b>
                </a>
                <a class="typography__beta typography--link color--black" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">
                    <b>Blog</b>
                </a>
            </nav>
        </header>

    </div>
</section>
