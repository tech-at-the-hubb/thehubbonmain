<?php
/**
 * The Hubb Theme — functions.php
 *
 * - Enqueues fonts and CSS
 * - Registers the `program` custom post type
 * - Registers nav menus
 * - Registers ACF Options page (global CTA + footer fields)
 * - Defines all ACF field groups via PHP so they are version-controlled
 */

/* ============================================================
   Theme setup
   ============================================================ */
function thehubb_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'thehubb-theme' ),
    ] );
}
add_action( 'after_setup_theme', 'thehubb_setup' );

/* ============================================================
   Enqueue styles and fonts
   ============================================================ */
function thehubb_enqueue_assets() {
    // Google Fonts — Rubik + Merriweather
    wp_enqueue_style(
        'thehubb-google-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&family=Rubik:wght@300;400;700&display=swap',
        [],
        null
    );

    // Design system CSS
    wp_enqueue_style( 'thehubb-colors',     get_template_directory_uri() . '/assets/css/colors.css',     [ 'thehubb-google-fonts' ], '1.0.0' );
    wp_enqueue_style( 'thehubb-typography', get_template_directory_uri() . '/assets/css/typography.css', [ 'thehubb-colors' ],       '1.0.0' );
    wp_enqueue_style( 'thehubb-grid',       get_template_directory_uri() . '/assets/css/grid.css',       [ 'thehubb-typography' ],   '1.0.0' );
    wp_enqueue_style( 'thehubb-theme',      get_template_directory_uri() . '/assets/css/theme.css',      [ 'thehubb-grid' ],         '1.0.0' );

    // Minimal JS (enqueue only if the file exists — it's a placeholder)
    if ( file_exists( get_template_directory() . '/assets/js/theme.js' ) ) {
        wp_enqueue_script( 'thehubb-theme-js', get_template_directory_uri() . '/assets/js/theme.js', [], '1.0.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'thehubb_enqueue_assets' );

/* ============================================================
   Register `program` Custom Post Type
   ============================================================ */
function thehubb_register_program_cpt() {
    $labels = [
        'name'               => __( 'Programs',          'thehubb-theme' ),
        'singular_name'      => __( 'Program',           'thehubb-theme' ),
        'add_new_item'       => __( 'Add New Program',   'thehubb-theme' ),
        'edit_item'          => __( 'Edit Program',      'thehubb-theme' ),
        'new_item'           => __( 'New Program',       'thehubb-theme' ),
        'view_item'          => __( 'View Program',      'thehubb-theme' ),
        'search_items'       => __( 'Search Programs',   'thehubb-theme' ),
        'not_found'          => __( 'No programs found', 'thehubb-theme' ),
        'menu_name'          => __( 'Programs',          'thehubb-theme' ),
    ];

    register_post_type( 'program', [
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => [ 'title' ],
        'has_archive'         => false,
        'rewrite'             => false,
        'exclude_from_search' => true,
    ] );
}
add_action( 'init', 'thehubb_register_program_cpt' );

/* ============================================================
   Site Options — native WordPress settings page
   (replaces ACF Pro options page; works with free ACF)
   ============================================================ */
function thehubb_add_options_page() {
    add_menu_page(
        'Site Options',
        'Site Options',
        'edit_posts',
        'thehubb-options',
        'thehubb_options_page_html',
        'dashicons-admin-settings',
        60
    );
}
add_action( 'admin_menu', 'thehubb_add_options_page' );

function thehubb_register_settings() {
    register_setting( 'thehubb_options_group', 'thehubb_cta',          'wp_kses_post' );
    register_setting( 'thehubb_options_group', 'thehubb_footer_left',  'wp_kses_post' );
    register_setting( 'thehubb_options_group', 'thehubb_footer_right', 'wp_kses_post' );
}
add_action( 'admin_init', 'thehubb_register_settings' );

function thehubb_options_page_html() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1>Site Options</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'thehubb_options_group' ); ?>

            <h2>CTA Text</h2>
            <p class="description">Short call-to-action shown in the sticky banner next to the Donate button. Appears on every page.</p>
            <?php wp_editor( get_option( 'thehubb_cta', '' ), 'thehubb_cta', [
                'textarea_name' => 'thehubb_cta',
                'media_buttons' => false,
                'textarea_rows' => 3,
                'teeny'         => true,
            ] ); ?>

            <h2 style="margin-top: 24px;">Footer — Left Column</h2>
            <p class="description">Content for the left column of the footer (address, hours, etc.).</p>
            <?php wp_editor( get_option( 'thehubb_footer_left', '' ), 'thehubb_footer_left', [
                'textarea_name' => 'thehubb_footer_left',
                'media_buttons' => false,
                'textarea_rows' => 6,
                'teeny'         => true,
            ] ); ?>

            <h2 style="margin-top: 24px;">Footer — Right Column</h2>
            <p class="description">Content for the right column of the footer.</p>
            <?php wp_editor( get_option( 'thehubb_footer_right', '' ), 'thehubb_footer_right', [
                'textarea_name' => 'thehubb_footer_right',
                'media_buttons' => false,
                'textarea_rows' => 6,
                'teeny'         => true,
            ] ); ?>

            <?php submit_button( 'Save Options' ); ?>
        </form>
    </div>
    <?php
}

/* ============================================================
   ACF: Field group definitions (version-controlled via PHP)
   ============================================================ */
function thehubb_register_acf_field_groups() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    /* ----------------------------------------------------------
       1. Home Page fields (attached to the page set as front page)
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_home',
        'title'  => 'Home Page Content',
        'fields' => [
            [
                'key'          => 'field_hero_header',
                'label'        => 'Hero Header',
                'name'         => 'hero_header',
                'type'         => 'wysiwyg',
                'instructions' => 'Large hero text at the top of the home page.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_hero_quote',
                'label'        => 'Hero Quote',
                'name'         => 'hero_quote',
                'type'         => 'wysiwyg',
                'instructions' => 'Pull-quote displayed below the hero header (shown with a left border accent).',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_funding_note',
                'label'        => 'Funding Note',
                'name'         => 'funding_note',
                'type'         => 'wysiwyg',
                'instructions' => 'Short note about funding/grants, displayed below the tiles section.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_non_profit_note',
                'label'        => 'Non-Profit Note',
                'name'         => 'non_profit_note',
                'type'         => 'wysiwyg',
                'instructions' => 'Statement about The Hubb\'s non-profit status, displayed near the bottom of the home page.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    /* ----------------------------------------------------------
       2b. Post attribution field
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_post',
        'title'  => 'Post Details',
        'fields' => [
            [
                'key'          => 'field_post_attribution',
                'label'        => 'Attribution',
                'name'         => 'attribution',
                'type'         => 'text',
                'instructions' => 'Optional — name or organisation to credit (e.g. "Jane Smith" or "Community Partners"). Leave blank to show no attribution.',
                'required'     => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'side',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    /* ----------------------------------------------------------
       3. Program CPT fields
       ---------------------------------------------------------- */
    acf_add_local_field_group( [
        'key'    => 'group_thehubb_program',
        'title'  => 'Program Details',
        'fields' => [
            [
                'key'          => 'field_program_agency',
                'label'        => 'Agency',
                'name'         => 'agency',
                'type'         => 'text',
                'instructions' => 'Name of the agency or organization running this program.',
                'required'     => 1,
            ],
            [
                'key'          => 'field_program_visible_date',
                'label'        => 'Date / Schedule',
                'name'         => 'visible_date',
                'type'         => 'text',
                'instructions' => 'Human-readable date or schedule (e.g. "Every Tuesday, 10am–12pm" or "March 2024").',
            ],
            [
                'key'          => 'field_program_representative',
                'label'        => 'Representative',
                'name'         => 'representative',
                'type'         => 'text',
                'instructions' => 'Name of the contact person or representative for this program.',
            ],
            [
                'key'          => 'field_program_description',
                'label'        => 'Description',
                'name'         => 'description',
                'type'         => 'wysiwyg',
                'instructions' => 'Brief description of what the program offers.',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_program_contact',
                'label'        => 'Contact',
                'name'         => 'contact',
                'type'         => 'text',
                'instructions' => 'Phone number, email, or website for attendees to reach the program.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'program',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );
}
add_action( 'acf/init', 'thehubb_register_acf_field_groups' );

/* ============================================================
   Helper: get ACF option field (with graceful fallback)
   ============================================================ */
function thehubb_get_option( string $field_name ): string {
    return (string) get_option( 'thehubb_' . $field_name, '' );
}
