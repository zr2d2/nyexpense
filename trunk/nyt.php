<?php

$query = $_GET['query'];

if($query) {

echo 'Query: ' . $query . '<br>';

}

if (!empty($query)) {

$geocode=file_get_contents('http://api.nytimes.com/svc/search/v1/article?query=' . urlencode($query) . '&api-key=13a26276609744cc626e399a4ec39753:11:61727267');

$output= json_decode($geocode);

echo $output->results[0]->url;

if (!empty($output->results[0]->url)) {


$geocode=file_get_contents('http://api.nytimes.com/svc/search/v1/article?query=senate&api-key=13a26276609744cc626e399a4ec39753:11:61727267');

$output= json_decode($geocode);

}



for ( $counter = 0; $counter <= 5; $counter += 1) {

$article_count = $counter + 1;

echo '<b>Article ' . $article_count . ' ' . $output->results[$counter]->title . '</b> - <a href="' . $output->results[$counter]->url . '" target="_blank">view the article</a><br>';
echo $output->results[$counter]->body . '<br><br>';

}



$geocode=file_get_contents('http://search.twitter.com/search.json?q=' . $query);

$output= json_decode($geocode);

for ( $counter = 0; $counter <= 5; $counter += 1) {

$created_at = $output->results[$counter]->created_at;
$length = strlen($created_at) - 6;

$created_at = substr($created_at, 0, $length);


echo '<b>Tweet by ' . $output->results[$counter]->from_user . ' on ' . $created_at . '</b> - <a href="http://twitter.com/' . $output->results[$counter]->from_user . '/status/' . $output->results[$counter]->id_str . '" target="_blank">view the tweet</a><br>';
echo $output->results[$counter]->text . '<br><br>';

}


}



?>
