<?php

//Leemos los datos recibidos en formato json
$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=dead&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

$juegos = json_decode($json, true);

$long_array = count($juegos['items']);

/*
for($i=0; $i<$long_array; $i++){
    echo '<pre>';
    print_r($juegos['items'][$i]);
    echo '</pre>';
}

echo "<pre>";
print_r($juegos['items']);
echo "</pre>";
/*
foreach ($games as $game) {
    
    echo '<pre>';
    print_r($game);
    echo '</pre>';
}
*/
/*
echo "<pre>";
print_r($json);
echo "</pre>";
*/

//echo $json;
?>
