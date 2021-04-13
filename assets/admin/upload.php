<?php
  require_once dirname(__FILE__).'/../../../../../wp-load.php';

  $num = 1;
  $dir = dirname(__FILE__)."/../temp/current-".$num.".csv";

  for($i = 1; $i > 0; $i++){
    if(!file_exists($dir)){
      break;
    }else{
      $num = $i;
      $dir = dirname(__FILE__)."/../temp/current-".$num.".csv";
    }
  }

  move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $dir);

  $csvData = file_get_contents($dir);
  $lines = explode(PHP_EOL, $csvData);
  $array = array();
  foreach ($lines as $line) {
      $array[] = str_getcsv($line);
  }

  function insert_player($player){
    $find = new WP_Query(array(
      'post_type' => 'sp_player',
      'meta_query' => array(
        array(
          'key' => 'player_email',
          'value' => $player[15],
        )
      )
    ));

    $grab_team = new WP_Query(array(
        'post_title_like' => $player[3],
        'post_type' => 'sp_team'
    ));

    if($grab_team->posts[0]->ID == null){
      $name['post_title'] = $player[3];
      insert_team($name);

      unset($grab_team);

      $grab_team = new WP_Query(array(
          'post_title_like' => $player[3],
          'post_type' => 'sp_team'
      ));
    }

    $leagues = explode("|", $player[4]);
    $args = array(
      'post_title' => $player[1],
      'post_type' => 'sp_player',
      'meta_input' => array(
        'sp_number'       => $player[0],
        'sp_current_team' => $grab_team->posts[0]->ID,
        'sp_team'         => $grab_team->posts[0]->ID,
        'sp_leagues'      => $leagues,
        'sp_nationality'  => $player[6],
        'sp_metrics'      => array(
            'satacts' => $player[7],
            'gpa'     => $player[8],
            'state'   => $player[9],
            'school'  => $player[10],
            'class'   => $player[11],
            'rank'    => $player[12],
            'ht'      => $player[13],
            'wt'      => $player[14]
        ),
        'player_email'    => $player[15]
      ),
      'tax_input' => array(
        'sp_position' => array($player[2]),
        'sp_season'   => array($player[5])
      ),
      'post_status' => 'publish'
    );

    if($find->posts[0]->ID == null){
      wp_insert_post($args);
    }
  }

  function insert_team($team){
    $team_name = ($team['post_title'])? $team['post_title'] : $team[0];

    $args = array(
      'post_title' => $team_name,
      'post_type' => 'sp_team',
      'post_status' => 'publish'
    );

    wp_insert_post($args);
  }

  foreach($array as $data) {
    if($_POST["uploadType"] == 'player'){
      if($data[0] != null && $data[0] != "Number") {
        insert_player($data);
      }
    }elseif($_POST["uploadType"] == 'team'){
      if($data[0] != null && $data[0] != "Team Name") {
        insert_team($data);
      }
    }
  }

  unlink($dir);

  echo "Done";
?>
