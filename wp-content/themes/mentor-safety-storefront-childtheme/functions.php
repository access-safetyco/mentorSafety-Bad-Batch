<?php
/**
 * Storefront child theme functions
 *
 */
// Enque Google fonts
function google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,400;0,700;0,900;1,400;1,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'google_fonts' );
// End enque Google fonts
// 
// Set the $ symbol to CDN $ symbol
add_filter('woocommerce_currency_symbol', 'cdn_currency_symbol', 30, 2);
	function cdn_currency_symbol( $currency_symbol, $currency ) {
		$currency_symbol = 'CDN $';
		return $currency_symbol;
	}

// Add custom logo to theme
add_action( 'init', 'storefront_custom_logo' );
function storefront_custom_logo() {
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mentor-safety-logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" />
	</a>
<?php
}

// Hide store front search
add_action( 'init', 'jk_remove_storefront_header_search' );
function jk_remove_storefront_header_search() {
remove_action( 'storefront_header', 'storefront_product_search', 40 ); 
}
// Alter title on "The Event Calendar" plugin
/*
 * Alters event's archive titles
 */
function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {
	// Modify the titles here
	// Some of these include %1$s and %2$s, these will be replaced with relevant dates
	$title_upcoming =   'Upcoming Courses'; // List View: Upcoming events
	$title_past =       'Past Courses'; // List view: Past events
	$title_range =      'Courses for %1$s - %2$s'; // List view: range of dates being viewed
	$title_month =      'Courses for %1$s'; // Month View, %1$s = the name of the month
	$title_day =        'Courses for %1$s'; // Day View, %1$s = the day
	$title_all =        'All Courses for %s'; // showing all recurrences of an event, %s = event title
	$title_week =       'Courses for week of %s'; // Week view
	// Don't modify anything below this unless you know what it does
	global $wp_query;
	$tribe_ecp = Tribe__Events__Main::instance();
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );
	// Default Title
	$title = $title_upcoming;
	// If there's a date selected in the tribe bar, show the date range of the currently showing events
	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {
		if ( $wp_query->get( 'paged' ) > 1 ) {
			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
		} else {
			//otherwise show the start date of the first event in the results
			$first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
		}
		$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
		$title = sprintf( $title_range, $first_event_date, $last_event_date );
	} elseif ( tribe_is_past() ) {
		$title = $title_past;
	}
	// Month view title
	if ( tribe_is_month() ) {
		$title = sprintf(
			$title_month,
			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
		);
	}
	// Day view title
	if ( tribe_is_day() ) {
		$title = sprintf(
			$title_day,
			date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
		);
	}
	// All recurrences of an event
	if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
		$title = sprintf( $title_all, get_the_title() );
	}
	// Week view title
	if ( function_exists('tribe_is_week') && tribe_is_week() ) {
		$title = sprintf(
			$title_week,
			date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
		);
	}
	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
		$cat = get_queried_object();
		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
		$title .= ' &#8250; ' . $cat->name;
	}
	return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );	
// End of "The Event Calendar" changes
// 
// Footer content
function storefront_credit() {
	?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . date( 'Y ' )  .  get_bloginfo( 'name' ) ) ); ?><?php echo ' | <a href="mailto:contact@mentorsafety.com">contact@mentorsafety.com</a> | <a href="/privacy-policy">Privacy Policy</a> | Website Design by <a href="https://renaissancemonkey.ca" target="_new">Renaissance Monkey Design</a>'; ?>
		</div><!-- .site-info -->
	<?php
	}
// End of Footer content

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
	return 'https://mentorsafety.com/training-courses/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );
// end of Return to Shopping button redirect
// Add Dashicons to website
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
wp_enqueue_style( 'dashicons' );
}
// Load Font Awesome
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

}
// Change 'Out of Stock' message in The Event Calendar
/*
 * EXAMPLE OF CHANGING ANY TEXT (STRING) IN THE EVENTS CALENDAR
 * See the codex to learn more about WP text domains:
 * http://codex.wordpress.org/Translating_WordPress#Localization_Technology
 * Example Tribe domains: 'tribe-events-calendar', 'tribe-events-calendar-pro'...
 */
function tribe_custom_theme_text ( $translation, $text, $domain ) {
 
	// Put your custom text here in a key => value pair
	// Example: 'Text you want to change' => 'This is what it will be changed to'
	// The text you want to change is the key, and it is case-sensitive
	// The text you want to change it to is the value
	// You can freely add or remove key => values, but make sure to separate them with a comma
	// This example changes the label "Venue" to "Location", and "Related Events" to "Similar Events"
	$custom_text = array(
		'Out of stock!' => 'Sold Out!',
		'Venue' => 'Location',
	);
 
	// If this text domain starts with "tribe-", "the-events-", or "event-" and we have replacement text
    	if( (strpos($domain, 'tribe-') === 0 || strpos($domain, 'the-events-') === 0 || strpos($domain, 'event-') === 0) && array_key_exists($translation, $custom_text) ) {
		$translation = $custom_text[$translation];
	}
    return $translation;
}
add_filter('gettext', 'tribe_custom_theme_text', 20, 3);
// END OF SCRIPT - Change 'Out of Stock' message in The Event Calendar -

/* Disable tickets emails for WooCommerce / Event Tickets Plus */
add_filter( 'tribe_tickets_plus_email_enabled', '__return_false' );

/* Remove the message 'You'll receive your tickets in another email' from the Woo Order email */
add_filter( 'wootickets_email_message', '__return_empty_string' );


// ----------- Fix tab <title> -------------

function filter_events_title( $title ) {
  if( tribe_context()->get( 'view_request' ) === 'default' ) {
    $title = 'Training Courses | Mentor Safety Consultants';
  } elseif( tribe_context()->get( 'view_request' ) === 'list' ) {
    $title = 'Training Courses - list view | Mentor Safety Consultants';
  } elseif( tribe_context()->get( 'view_request' ) === 'month') {
    $title = 'Training Courses - month view | Mentor Safety Consultants';
  } elseif( tribe_context()->get( 'view_request' ) === 'day' ) {
    $title = 'Day event page';
  } // elseif( tribe_context()->get( 'view_request' ) === 'summary' ) {
  //  $title = 'Summary event page';
  //} elseif( tribe_context()->get( 'view_request' ) === 'photo' ) {
  //  $title = 'Photo event page';
  //} elseif( tribe_context()->get( 'view_request' ) === 'map' ) {
  //  $title = 'Map event page';
  //}
  return $title;
}
add_filter( 'tribe_events_title_tag', 'filter_events_title' );

/**
 * Reusable Blocks accessible in backend
 * @link https://www.billerickson.net/reusable-blocks-accessible-in-wordpress-admin-area
 *
 */
function be_reusable_blocks_admin_menu() {
    add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );