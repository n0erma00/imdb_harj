<?php

require_once('../db.php');
$genre = $_GET['genre'];
$db = createDbConnection();

/*sql haku, hakee top 50 elokuvaa genren mukaan. lajittelu on average ratingin perusteella ja 
lisäsääntönä titlet missä on arvioita vähintään 100000 kpl jotta saadaan kesiarvoa*/
$sql = "SELECT primary_title, start_year, genre, average_rating, num_votes
FROM titles 
INNER JOIN title_genres ON titles.title_id = title_genres.title_id
INNER JOIN title_ratings ON titles.title_id = title_ratings.title_id
WHERE genre LIKE'%" . $genre . "%'
AND num_votes > 100000
ORDER BY average_rating DESC
LIMIT 50;";

/*muuten menee melko samalla kaavalla tuntiharkan*/
$prepare = $db->prepare($sql);  
$prepare->execute();
$rows = $prepare->fetchAll();

$html = '<h1>' . $genre . '</h1>';
$html .= '<ul>';

foreach ($rows as $row) {
    $html .= '<li>' . $row["primary_title"] . '</li>';
}
$html .= '</ul>';

echo $html;
