<?php

namespace MGTestimonials\cpts;

/**
 * Class Testimonials
 *
 * @author  Mauricio Gelves <mg@maugelves.com>
 * @since   1.0.1
 */
class Testimonials
{
	/**
	 * Personal constructor.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'create_cpt_testimonial' ), 10 );

		add_filter( 'enter_title_here', array( $this, 'change_title_placeholder' ) );

		add_filter( 'post_updated_messages', array($this, 'updated_messages_cb' ) );


		// Custom columns filters
		add_filter('manage_testimonial_posts_columns', array( $this, 'create_archive_columns' ) );
		add_action('manage_testimonial_posts_custom_column', array( $this, 'populate_archive_columns' ), 10, 2);

	}


	/**
	 *  Change the Post Title placeholder
	 *  @param $title
	 *
	 *  @return string
	 */
	public function change_title_placeholder( $title ) {
		$screen = get_current_screen();

		if  ( 'testimonial' == $screen->post_type )
			$title = __('Introduce el nombre completo', 'mgtestimonials' );


		return $title;
	}



	/**
	 * This function creates the CPT Testimonial
	 */
	public function create_cpt_testimonial() {

		$args = array(
			'label'                 => __( 'Testimonios', 'mgtestimonials' ),
			'labels'                => array (

				// Labels values
				'name'                  => __( 'Testimonios', 'mgtestimonials' ),
				'singular'              => __( 'Testimonio', 'mgtestimonials' ),
				'add_new'               => __( 'Agregar un testimonio', 'mgtestimonials' ),
				'add_new_item'          => __( 'Agregar un testimonio', 'mgtestimonials' ),
				'edit_item'             => __( 'Editar testimonio', 'mgtestimonials' ),
				'new_item'              => __( 'Nuevo testimonio', 'mgtestimonials' ),
				'view_item'             => __( 'Ver testimonio', 'mgtestimonials' ),
				'view_items'            => __( 'Ver testimonios', 'mgtestimonials' ),
				'search_items'          => __( 'Buscar testimonios', 'mgtestimonials' ),
				'not_found'             => __( 'No se encontraron testimonios', 'mgtestimonials' ),
				'not_found_in_trash'    => __( 'No hay registros eliminados', 'mgtestimonials' ),
				'all_items'             => __( 'Todos los testimonios', 'mgtestimonials' ),
				'archives'              => __( 'Testimonios', 'mgtestimonials' ),
				'featured_image'        => __( 'Imagen ', 'mgtestimonials' ),
				'set_featured_image'    => __( 'Establecer la imagen', 'mgtestimonials' ),
				'remove_featured_image' => __( 'Quitar la imagen', 'mgtestimonials' ),
				'use_featured_image'    => __( 'Usar esta imagen como principal', 'mgtestimonials' )
			),
			'public'                => true,
			'exclude_from_search'   => true,
			'show_ui'               => true,
			'menu_position'         => 19,
			'menu_icon'             => 'dashicons-megaphone',
			'supports'              => array( 'title', 'thumbnail' ),
			'has_archive'           => true
		);


		register_post_type( 'testimonial', $args );

	}


	/**
	 * Creates, remove or modify the columns array for the Admin Archive
	 *
	 * @param $defaults
	 *
	 * @return mixed
	 */
	public function create_archive_columns( $defaults ) {
		unset( $defaults['date'] );
		unset( $defaults['title'] );
		$defaults['featured'] = '';
		$defaults['title'] = __('Nombre', 'mgtestimonials');
		$defaults['testimonial'] = __('Testimonio', 'mgtestimonials');
		$defaults['date'] = 'Fecha';
		return $defaults;
	}


	/**
	 * Fill the columns for the Admin Archive
	 *
	 * @param $column_name
	 * @param $post_ID
	 */
	public function populate_archive_columns( $column_name, $post_ID ){

		$mauricio = 'hola';
		switch ( $column_name ):
			case 'featured':
				the_post_thumbnail();
				break;
			case 'testimonial':
				the_field('mgtestimonial_testimonio', $post_ID);
				break;
		endswitch;

	}



	/**
	 * Customized messages for Sponsor Custom Post Type
	 *
	 * @param   array $messages Default messages.
	 * @return  array 			Returns an array with the new messages
	 */
	public function updated_messages_cb( $messages ) {

		$messages['testimonial'] = array(
			0  => '', // Unused. Messages start at index 1.
			1 => __( 'Testimonio actualizado.', 'mgtestimonials' ),
			4 => __( 'Testimonio actualizado.', 'mgtestimonials' ),
			/* translators: %s: date and time of the revision */
			5 => isset( $_GET['revision']) ? sprintf( __( 'Testimonio recuperado de la revisión %s.', 'mgtestimonials' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Testimonio publicado.', 'mgtestimonials' ),
			7 => __( 'Testimonio guardado.', 'mgtestimonials' ),
			9 => __('Testimonio programador', 'mgtestimonials' ),
			10 => __( 'Borrador de testimonio actualizado.', 'mgtestimonials' ),
		);

		return $messages;
	}

}
$testimonio = new Testimonials();