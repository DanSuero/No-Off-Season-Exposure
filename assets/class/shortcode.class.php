 <?php

defined( 'ABSPATH' ) || exit;

class shortcode{
  public static function paid_teams($atts){
    global $post;

    $get_teams = new WP_Query(array(
        'post_type' => 'sp_team',
        'posts_per_page' => -1,
        'meta_query' => array(array(
            'key' => 'paid',
            'value' => $post->ID,
            'compare' => 'LIKE'
        ))
    ));

?>
  <style type="text/css">
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item,
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item a {
          font-size: 20px;
          font-weight: 700;
      }
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child) {
          padding-bottom: calc(25px/2);
      }
      .elementor-widget.elementor-list-item-link-full_width a {
          width: 100%;
      }
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item,
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item a {
          font-size: 20px;
          font-weight: 700;
      }
      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-text {
        color: var( --e-global-color-primary );
      }

      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)::after {
          border-top-style: solid;
          border-top-width: 1px;
          content: "";
          width: 35%;
          border-color: #ddd;
          right: 0;
          left: 0;
          position: absolute;
          bottom: 0;
      }

      .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child) {
          margin-top: calc(25px/2);
      }
  </style>
  <div class="elementor-element elementor-element-1fb9c19 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="1fb9c19" data-element_type="widget" data-widget_type="icon-list.default">
    <div class="elementor-widget-container">
      <ul class="elementor-icon-list-items">
  <?php foreach($get_teams->posts as $teams){ ?>
        <li class="elementor-icon-list-item">
  				<a href="<?php echo $teams->guid; ?>">
            <span class="elementor-icon-list-text">The <?php echo str_replace("The ","", $teams->post_title); ?></span>
  				</a>
  			</li>
  <?php } ?>
  		</ul>
  	</div>
  </div>
<?php
}

  public static function paid_player($atts){
    global $post;

    $get_players = new WP_Query(array(
        'post_type' => 'sp_player',
        'posts_per_page' => -1,
        'meta_query' => array(array(
            'key' => 'paid',
            'value' => $post->ID,
            'compare' => 'LIKE'
        ))
    ));
  ?>
    <style type="text/css">
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item,
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item a {
      font-size: 20px;
      font-weight: 700;
    }
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child) {
      padding-bottom: calc(25px/2);
    }
    .elementor-widget.elementor-list-item-link-full_width a {
      width: 100%;
    }
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item,
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-item a {
      font-size: 20px;
      font-weight: 700;
    }
    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-text {
    color: var( --e-global-color-primary );
    }

    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)::after {
      border-top-style: solid;
      border-top-width: 1px;
      content: "";
      width: 35%;
      border-color: #ddd;
      right: 0;
      left: 0;
      position: absolute;
      bottom: 0;
    }

    .elementor-element.elementor-element-1fb9c19 .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child) {
      margin-top: calc(25px/2);
    }
  </style>
    <div class="elementor-element elementor-element-1fb9c19 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="1fb9c19" data-element_type="widget" data-widget_type="icon-list.default">
      <div class="elementor-widget-container">
        <ul class="elementor-icon-list-items">
      <?php foreach($get_players->posts as $teams){ ?>
          <li class="elementor-icon-list-item">
            <a href="<?php echo $teams->guid; ?>">
              <span class="elementor-icon-list-text"><?php echo $teams->post_title; ?></span>
            </a>
          </li>
      <?php } ?>
        </ul>
      </div>
    </div>
    <?php
  }

  public static function players_performance($atts){
    $dis_player_id = bp_displayed_user_id();
    $dis_player = get_user_by('id', $dis_player_id);

    $player_sp_page = new WP_Query(array(
      'post_type' => 'sp_player',
      'meta_query' => array(
        array(
          'key' => 'player_email',
          'value' => $dis_player->data->user_email
        )
      )
    ));

    $cur_player = $player_sp_page->posts[0];

    if($cur_player != null){
      include "template/performance.template.php";
    }
  }
}
 ?>
