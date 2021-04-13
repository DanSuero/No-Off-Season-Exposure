<?php
/*
  Plugin Name: No Off Season
  Description: Modifications to the site.
  Version: 0.1
*/

defined( 'ABSPATH' ) || exit;

//Auto Class Loader
include_once "autoloader.php";

if(!function_exists( 'start_sparrow_auto' )){
  require_once "assets/admin/admin.php";

  add_shortcode("PaidTeams",array("shortcode","paid_teams"));
  add_shortcode("Paid_Players",array("shortcode","paid_player"));
  add_shortcode("addscript",array("hooks","script"));
  add_shortcode("PlayerPeforme", array("shortcode", "players_performance"));
  add_action( 'gform_after_submission_1', array("hooks", "add_paid_teams"), 10, 2);
  add_action( 'gform_after_submission_2', array("hooks", "tie_player"), 10, 2);
  add_action( 'gform_after_submission_3', array("hooks", "showcase_player"), 10, 2);
  add_action('transition_post_status', array("hooks", "send_player_email"), 10, 3);

  add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
  function title_like_posts_where( $where, $wp_query ) {
      global $wpdb;
      if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
          $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
      }
      return $where;
  }
}
