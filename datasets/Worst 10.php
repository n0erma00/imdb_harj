<?php

require_once('../db.php');
$genre = $_GET['genre'];
$db = createDbConnection();

/*sql haku viewillä toteutettuna, hakee 10 huonoiten arvosteltua leffaa missä > 100000 arvostelua
CREATE VIEW huonoimmat AS
SELECT DISTINCT primary_title, start_year, average_rating, num_votes
FROM titles 
INNER JOIN title_genres ON titles.title_id = title_genres.title_id
INNER JOIN title_ratings ON titles.title_id = title_ratings.title_id
WHERE num_votes > 100000
ORDER BY average_rating ASC
LIMIT 10;*/
$sql = "SELECT * FROM huonoimmat";

/*muuten menee melko samalla kaavalla tuntiharkan*/
$prepare = $db->prepare($sql);  
$prepare->execute();
$rows = $prepare->fetchAll();

$html = '<h1>IMDB 10 huonointa</h1>';
$html .= '<ul>';

foreach ($rows as $row) {
    $html .= '<li>' . $row["primary_title"] . '</li>';
}
$html .= '</ul>';

echo $html;
