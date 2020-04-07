<?php
/**
 * Featured Content options
 *
 * @package Chique
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chique_featured_content_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    chique_register_option( $wp_customize, array(
            'name'              => 'chique_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Chique_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Chique Theme, go %1$shere%2$s', 'chique' ),
                '<a href="javascript:wp.customize.section( \'chique_featured_content\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'chique_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'chique' ),
			'panel' => 'chique_theme_options',
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	// Add note to ECT Featured Content Section
    chique_register_option( $wp_customize, array(
            'name'              => 'chique_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Chique_Note_Control',
            'active_callback'   => 'chique_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'chique' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'chique_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	chique_register_option( $wp_customize, array(
			'name'              => 'chique_featured_content_option',
			'default'           => 'disabled',
			'active_callback'   => 'chique_is_ect_featured_content_active',
			'sanitize_callback' => 'chique_sanitize_select',
			'choices'           => chique_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'chique' ),
			'section'           => 'chique_featured_content',
			'type'              => 'select',
		)
	);

    chique_register_option( $wp_customize, array(
            'name'              => 'chique_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Chique_Note_Control',
            'active_callback'   => 'chique_is_featured_content_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'chique' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'chique_featured_content',
            'type'              => 'description',
        )
    );

	chique_register_option( $wp_customize, array(
			'name'              => 'chique_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'chique_sanitize_number_range',
			'active_callback'   => 'chique_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'chique' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'chique' ),
			'section'           => 'chique_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'chique_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		chique_register_option( $wp_customize, array(
				'name'              => 'chique_featured_content_cpt_' . $i,
				'sanitize_callback' => 'chique_sanitize_post',
				'active_callback'   => 'chique_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'chique' ) . ' ' . $i ,
				'section'           => 'chique_featured_content',
				'type'              => 'select',
                'choices'           => chique_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'chique_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'chique_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Chique 0.1
	*/
	function chique_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'chique_featured_content_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( chique_is_ect_featured_content_active( $control ) &&  chique_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'chique_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Chique 1.0
    */
    function chique_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'chique_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Chique 1.0
    */
    function chique_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
