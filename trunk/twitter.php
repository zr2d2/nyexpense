<?php
  $query = $_GET['query'];
  $senator_names = array("JOHN DEFRANCISCO" => "JohnDeFrancisco","PEDRO ESPADA, JR" => "SenEspada","MARTIN J. GOLDEN" => "senmartygolden","CRAIG M. JOHNSON" => "HonCraigJohnson", "KENNETH P. LAVALLE"=>"senatorlavalle" , "GEORGE D. MAZIARZ"=> "senatormaziarz","GEORGE ONORATO" => "SenOnorato","JOSE PERALTA" => "SenatorPeralta", "JOSE M. SERRANO"=> "senatorserrano", "MALCOLM A. SMITH"=> "malcolmasmith", "WILLIAM T. STACHOWSKI" => "senstachowski", "DAVID J. VALESKY"=> "SenDavidValesky") ;
  if($senator_names[$query] != null && !empty($query))
     {
     $userinfo = file_get_contents('http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $senator_names[$query]);
     $output= json_decode($userinfo);
    for ( $counter = 0; $counter <= 5; $counter += 1) {
      $created_at = $output[$counter]->created_at;
      $length = strlen($created_at) - 6;
      $created_at = substr($created_at, 0, $length);
      echo '<b><a href="http://twitter.com/' . $output[$counter]->from_user . '/status/' . $output[$counter]->id_str . '" target="_blank">Tweet</a> by <a href="http://twitter.com/' 
. $output[$counter]->from_user . '" target="_blank">' . $output[$counter]->from_user . '</a> on ' . $output[$counter]->created_at . '<br>';
      echo $output[$counter]->text . '<br><br>';
    }

     
     }
  else {
    $geocode=file_get_contents('http://search.twitter.com/search.json?q=' . '@NYSenate');
    $output= json_decode($geocode);
    for ( $counter = 0; $counter <= 5; $counter += 1) {
      $created_at = $output->results[$counter]->created_at;
      $length = strlen($created_at) - 6;
      $created_at = substr($created_at, 0, $length);
      echo '<b><a href="http://twitter.com/' . $output->results[$counter]->from_user . '/status/' . $output->results[$counter]->id_str . '" target="_blank">Tweet</a> by <a href="http://twitter.com/' 
. $output->results[$counter]->from_user . '" target="_blank">' . $output->results[$counter]->from_user . '</a> on ' . $output->results[$counter]->created_at . '<br>';
      echo $output->results[$counter]->text . '<br><br>';
    }
  }
?>
