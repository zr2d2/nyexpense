<?php
  $query = $_GET['query'];
  if (!empty($query)) {
    $geocode=file_get_contents('http://api.nytimes.com/svc/search/v1/article?query=' . urlencode($query) . '&api-key=13a26276609744cc626e399a4ec39753:11:61727267');
    $output= json_decode($geocode);
    if (!empty($output->results[0]->url)) {
      $geocode=file_get_contents('http://api.nytimes.com/svc/search/v1/article?query=senate&api-key=13a26276609744cc626e399a4ec39753:11:61727267');
      $output= json_decode($geocode);
    }
    echo '<h2>Related Stories from the New York Times</h2>';
    for ( $counter = 0; $counter <= 5; $counter += 1) {
      echo '<b> <a href="' . $output->results[$counter]->url . '" target="_blank">' . $output->results[$counter]->title . '<a/> (' . date('F jS, Y', strtotime($output->results[$counter]->date)) . ')</b><br>';
      echo $output->results[$counter]->body . '... <a href="' . $output->results[$counter]->url . '" target="_blank">read more</a><br><br>';
    }
  }
?>
