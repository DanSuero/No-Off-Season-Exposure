<?php

defined( 'ABSPATH' ) || exit;

class hooks{
  //find player pages
  private static function get_user_page($email){
    $user = new WP_Query(array(
        'post_type' => 'sp_player',
        'meta_key' => array(
          array(
            'key' => 'player_email',
            'value' => $email
          )
        )
    ));

    return $user->posts[0];
  }

  //find user id via email.
  private static function get_user_account($email){
    $user = new WP_User_Query(array(
        'search' => $email,
        'search_columns' => 'user_email'
    ));

    return $user->results[0]->data->ID;
  }

  //add user
  private static function add_user($email,$name){
    $arg = array(
      'user_login' => $email,
      'user_email' => $email,
      'first_name' => $name['first_name'],
      'last_name' => $name['last_name'],
      'role' => 'coach'
    );

    return wp_insert_user($arg);
  }

  //find the team(s) tied to the user account.
  private static function find_tied_teams($id){
    $args = array(
      "post_type"   => "sp_team",
      "author" => $id,
      "posts_per_page" => -1
    );

    $results = new WP_Query($args);

    return $results->posts;
  }

  //Search Team by title
  private static function find_single_team($team, $coach_id){
    if(is_numeric($team) == false){
      $cleanTeam = ucwords(preg_replace('/^[tThH]+[eE]\b\W/', "", $team));//Removes the word 'The' in front of teams name.
    }

    $args = array(
      'post_type' => "sp_team",
    );

    if(is_numeric($team)){
        $args['p'] = $team;
    }else{
        $args['post_title_like'] = $cleanTeam;
        $args['author'] = $coach_id;
    }

    $results =  new WP_Query($args);

    return $results->posts;
  }

  //adding teams tied to single or multi.
  private static function add_team($team, $coach){
    $cleanTeam = ucwords(preg_replace('/^[tThH]+[eE]\b\W/', "", $team));//Removes The in front of teams name.

    $args = array(
      "post_type" => "sp_team",
      "post_author" => $coach,
      "post_title" => $cleanTeam,
      "post_status" => 'publish'
    );

    return wp_insert_post($args);
  }

  //adds or updates tourn
  private static function add_team_tourn($team, $post){
    $team_meta = get_post_meta($team, "paid", true);
    $already_paid = preg_match('/\b'.$post.'\b/', $team_meta);

    if($team_meta != ""){
      if(!$already_paid){
        $team_meta .= ', '.$post;
      }
    }else{
      $team_meta = $post;
    }

    return update_post_meta($team, "paid", $team_meta);
  }

  //adding custom script for particular post.
  public static function script(){
    global $post;
    ?>
    <input type="hidden" name="grab_id" value="<?php echo $post->ID; ?>" />
    <script type="text/javascript">
      window.onload = function(){

        function getTeams(getTeams){
          return getTeams.split(/\W?[\,.]\W/g);
        }

        var grabVal = document.querySelector("input[name='grab_id']").value;
        document.querySelector("input.gform_hidden[value='change_me']").value = grabVal;

        /*var qty = document.querySelector(".ginput_quantity"),
        teams = document.querySelector("#input_1_17"),
        numTeams;
        qty.setAttribute("type", "number");
        qty.stepUp();

        teams.addEventListener('focusout',function(){
          numTeams = getTeams(teams.value);
          if(numTeams.length > 0){
            if(qty.value < numTeams.length){
              for(var i = 0; i < numTeams.length; i++){
                qty.stepUp();
                if(qty.value == numTeams.length){
                  break;
                }
              }
            }else{
              for(var i = 0; i < numTeams.length; i++){
                qty.stepDown();
                if(qty.value == numTeams.length){
                  break;
                }
              }
            }
          }

        });*/
      };
    </script>
    <?php
  }

  //Adding a single team *old code*
  public static function single_team($post, $user, $team, $name){
    $user_id = self::get_user_account($user);

    if($user_id == ""){
      self::add_user($user, $name);
      $user_id = self::get_user_account($user);
    }

    $curTeamInfo = self::find_single_team($team, $user_id);

    if (count($curTeamInfo) == ""){
      self::add_team($team, $user_id);

      $curTeamInfo = self::find_single_team($team, $user_id);
      self::add_team_tourn($curTeamInfo[0]->ID, $post);
    }else{
      self::add_team_tourn($curTeamInfo[0]->ID, $post);
    }
  }

  //Adding Multiple teams new code better optimized
  public static function multi_team($post, $user, $team, $name){
    $teams = preg_split('/\W?[,.]\W?\n?/', $team);
    $user_id = self::get_user_account($user);

    if($user_id == ""){
      self::add_user($user, $name);
      $user_id = self::get_user_account($user);
    }

    foreach($teams as $curTeam){
      $curTeamInfo = self::find_single_team($curTeam, $user_id);

      if (count($curTeamInfo) == ""){
        self::add_team($curTeam, $user_id);

        $curTeamInfo = self::find_single_team($curTeam, $user_id);
        self::add_team_tourn($curTeamInfo[0]->ID, $post);
      }else{
        self::add_team_tourn($curTeamInfo[0]->ID, $post);
      }
    }
  }

  public static function add_paid_teams($entry, $form){
    $current_post = rgar($entry, "13");
    $current_user = rgar($entry, "9");
    $current_team = (rgar($entry, "2") == "")? rgar($entry, "17"): rgar($entry, "2");
    $current_name = array(
                      'first_name' => rgar($entry, "8.3"),
                      'last_name' => rgar($entry, "8.6")
                    );


    $current_selection = rgar($entry, "18");

    if($current_selection == "single"){
      self::single_team($current_post, $current_user, $current_team, $current_name);
    }else{
      self::multi_team($current_post, $current_user, $current_team, $current_name);
    }
  }

  public static function send_player_email($new_status, $old_status, $post) {
    if('publish' === $new_status && 'publish' !== $old_status && $post->post_type === 'sp_player') {
        $to = ($_POST["acf"]["field_5fac804c57e36"])? $_POST["acf"]["field_5fac804c57e36"] : get_post_meta($post->ID, "player_email", true);
        $rawMSG = get_page_by_title("Player Email", OBJECT, "post");
        $msg = str_replace("{name}", $post->post_title, $rawMSG->post_content);
        $finalMSG = apply_filters("the_content", $msg);

        $headers = "Content-type: text/html; charset=iso-8859-1" . "\r\n" .'From: noreply@nooffseasonexposure.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

        $subject = "Your Coach/Team Manger signed your team up!";
        mail($to, $subject, $finalMSG, $headers);
    }
  }

  public static function tie_player($entry, $form){
    $player_email = rgar($entry, "2");

    $get_user = new WP_User_Query(array(
        'search' => $player_email,
        'search_columns' => 'user_email'
    ));

    $users_id = $get_user->results[0]->data->ID;

    $find_profile = new WP_Query(array(
      'post_type' => 'sp_player',
      'meta_query' => array(array(
          'key' => 'player_email',
          'value' => $player_email
      ))
    ));

    $page_id = $find_profile->posts[0]->ID;

    $args = array(
      "ID" => $page_id,
      "post_author" =>  $users_id
    );

    wp_update_post($args);
  }

  public static function showcase_player($entry, $form){
    $player_email = rgar($entry, "4");
    $current_post = rgar($entry, "7");

    $player_page_id = self::get_user_page($player_email)->ID;
    $player_user_id = self::get_user_account($player_email)->ID;

    if($player_page_id != null){

      if($player_user_id == null){
        wp_insert_user(array(
          "user_pass" => rgar($entry,"5.1"),
          "user_login" => $player_email,
          "user_email" => $player_email,
          "first_name" => rgar($entry,"2.3"),
          "last_name" => rgar($entry,"2.6"),
          "role" => "sp_player"($curTeamInfo[0]['post_author'])
        ));

        unset($player_user_id);
        $player_user_id = self::get_user_account($player_email)->ID;

        $args = array(
          "ID" => $player_page_id,
          "post_author" =>  $player_user_id
        );
        wp_update_post($args);
      }

      if(get_user_meta($player_user_id,"paid", true) == 0){
        add_user_meta($player_user_id, "paid", $current_post);
        add_post_meta($player_page_id, "paid", $current_post);
      }else{
        $grab_paid = get_user_meta($player_user_id,"paid", true);
        $grab_paid .= ','.$current_post;
        update_user_meta($player_user_id, "paid", $grab_paid);
        update_post_meta($player_page_id, "paid", $grab_paid);
      }

      $metrics = array(
          'satacts' => rgar($entry, "14"),
          'gpa'     => rgar($entry, "15"),
          'state'   => rgar($entry, "16.4"),
          'school'  => rgar($entry, "17"),
          'class'   => rgar($entry, "18"),
          //'rank'    => $player[12],
          'ht'      => rgar($entry, "19"),
          'wt'      => rgar($entry, "20")
      );

      update_post_meta("sp_metrics", $metrics, true);
    }else{
      wp_insert_user(array(
        "user_pass" => rgar($entry,"5.1"),
        "user_login" => $player_email,
        "user_email" => $player_email,
        "first_name" => rgar($entry,"2.3"),
        "last_name" => rgar($entry,"2.6"),
        "role" => "sp_player"
      ));

      unset($player_user_id);

      $player_user_id = self::get_user_account($player_email)->ID;

      $player_name = rgar($entry,"2.3")." ".rgar($entry,"2.6");

      wp_insert_post(array(
        'post_author' => $player_user_id,
        'post_title' => $player_name,
        'post_type' => 'sp_player',
        'meta_input' => array(
          "paid" => $current_post,
          "player_email" => $player_email,
          'sp_metrics'      => array(
              'satacts' => rgar($entry, "14"),
              'gpa'     => rgar($entry, "15"),
              'state'   => rgar($entry, "16.4"),
              'school'  => rgar($entry, "17"),
              'class'   => rgar($entry, "18"),
              //'rank'    => $player[12],
              'ht'      => rgar($entry, "19"),
              'wt'      => rgar($entry, "20")
          )
        ),
        'post_status' => 'publish'
      ));
    }
  }
}
