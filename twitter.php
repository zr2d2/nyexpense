<?php
  $query = $_GET['query'];
  if (!empty($query)) {
    $geocode=file_get_contents('http://search.twitter.com/search.json?q=' . $query);
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
