<?php

function createGenreDropDown() {
//alasveto genrevalikko
require_once('db.php');
$db = createDbConnection();
$sql = "SELECT DISTINCT genre FROM title_genres;";
$prepare = $db->prepare($sql);  
$prepare->execute();
$rows = $prepare->fetchAll();

$html = '<select name="genre">';

foreach ($rows as $row) {
    $html .= '<option>' . $row['genre'] . '</option>';
}
$html .= '</select>';

return $html;

}
