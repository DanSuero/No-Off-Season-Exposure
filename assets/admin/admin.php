<?php

defined( 'ABSPATH' ) || exit;

function off_season_menu(){
  add_menu_page( __( 'nooffseason', 'NoOffSeason' ),__( 'Off Season Import', 'NoOffSeason' ), 'manage_options', 'offseason-import', "import_render_page", 'dashicons-groups', 6);
}
add_action( 'admin_menu', 'off_season_menu');

function import_render_page(){
?>
<section class="container">
    <div class="row">
      <div class="col image">
         <?php the_custom_logo(); ?>
      </div>
    </div>
    <div class="row importer">
      <div class="col-header">
          <h3>No Off Season Import System</h3>
      </div>
      <div class="col-body">
        <form id="uploadForm" name="uploadForm" method="post">
          <div class="inputGroup">
            <label for="uploadType">Uploading CSV for:</label>
            <select name="uploadType" id="uploadType" required>
                <option value="" selected>Please Choose</option>
                <option value="player">Player/s</option>
                <option value="team">Team/s</option>
            </select>
          </div>
          <div class="inputGroup">
            <label for="uploadFile">Choose CSV:</label>
            <input id="uploadFile" type="file" name="uploadFile" required />
          </div>
          <div class="inputGroup">
            <button class="uploadBtn">
              Import
            </button>
          </div>
        </form>
      </div>
      <div class="col-results hide">
        Done!
      </div>
    </div>
    <div class="row">
      <div class="col sample">
        <p>
          Sample CSV for import:
        </p>
        <ul>
          <li><a href="<?php echo plugins_url('../dl/sample_player.csv', __FILE__); ?>" download>Player Sample</a></li>
          <li><a href="<?php echo plugins_url('../dl/sample_team.csv', __FILE__); ?>" download>Team Sample</a></li>
        </ul>
      </div>
    </div>
</section>
<?php
}

function off_season_style($hook) {
	if( $hook != 'toplevel_page_offseason-import' ) {
		 return;
	}
	wp_enqueue_style( 'no_off_season_css', plugins_url('../css/admin.css', __FILE__) );
  wp_enqueue_style( 'Google Montserat', "https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap");
  wp_enqueue_script('no_off_season_script', plugins_url('../js/admin-script.js', __FILE__));
}
add_action( 'admin_enqueue_scripts', 'off_season_style' );
