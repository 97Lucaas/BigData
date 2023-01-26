<?php

error_reporting(E_ERROR | E_PARSE);

//$usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true);
$usagers =  [
    ['id_vehicule' => 100882, 'place' => 1, 'grav' => 2],
    ['id_vehicule' => 100882, 'place' => 2, 'grav' => 2],
    ['id_vehicule' => 100882, 'place' => 3, 'grav' => 1],
    ['id_vehicule' => 100883, 'place' => 1, 'grav' => 0],
    ['id_vehicule' => 100884, 'place' => 1, 'grav' => 2],
    ['id_vehicule' => 100884, 'place' => 2, 'grav' => 0],
    ['id_vehicule' => 100884, 'place' => 3, 'grav' => 2],
    ['id_vehicule' => 100884, 'place' => 4, 'grav' => 2],
    ['id_vehicule' => 100884, 'place' => 5, 'grav' => 1],
    ['id_vehicule' => 100885, 'place' => 1, 'grav' => 3],
    ['id_vehicule' => 100885, 'place' => 2, 'grav' => 4],
    ['id_vehicule' => 100886, 'place' => 1, 'grav' => 2],
    ['id_vehicule' => 100886, 'place' => 2, 'grav' => 4],
    ['id_vehicule' => 100886, 'place' => 4, 'grav' => 3],
    ['id_vehicule' => 100887, 'place' => 1, 'grav' => 1],
    ['id_vehicule' => 100887, 'place' => 2, 'grav' => 1],
    //...
];

//var_dump($usagers[56]);
$nb_pers = 1; //nombre de personnes dans la voiture (il y a forcément le conducteur)
$m_cond = 0;
$m_pass = 0;
$m_arr_cond = 0;
$m_arr_pass = 0;
$m_arr_mil = 0;
$nb_pers = [];

foreach ($usagers as $item) {
    // Vérifie si l'ID de véhicule existe déjà dans le tableau $nb_pers
    if (!isset($nb_pers[$item['id_vehicule']])) {
        // Ajoute l'ID de véhicule au tableau $nb_pers avec une valeur de 1 pour la première personne
        $nb_pers[$item['id_vehicule']] = 1;
    } else {
        // Incrémente la valeur de l'ID de véhicule existant de 1 pour chaque personne supplémentaire
        $nb_pers[$item['id_vehicule']]++;
    }
}

// Affiche le nombre de personnes pour chaque ID de véhicule unique
//print_r($nb_pers);

// Initialisation du tableau pour stocker les ID de véhicules avec $nb_pers = 2
$vehicules_2_pers = [];

// Boucle pour parcourir le tableau $nb_pers
foreach ($nb_pers as $id_vehicule => $nb_personnes) {
// Vérifie si le nombre de personnes pour cet ID de véhicule est égal à 2
if ($nb_personnes == 2) {
// Ajoute l'ID de véhicule au tableau $vehicules_2_pers
$vehicules_2_pers[] = $id_vehicule;
}
}

// Initialisation du tableau pour stocker les places avec 'grav' = 3
$places_grav_3 = [];

// Boucle pour parcourir les données
foreach ($usagers as $item) {
// Vérifie si l'ID de véhicule courant est dans le tableau $vehicules_2_pers et si 'grav' = 3
if (in_array($item['id_vehicule'], $vehicules_2_pers) && $item['grav'] == 2) {
// Ajoute la place au tableau $places_grav_3
$places_grav_3[] = $item['place'];
}
}

// Affiche les ID de véhicules avec $nb_pers = 2
//print_r($vehicules_2_pers);

// Affiche les places avec 'grav' = 3 pour les ID de véhicules avec $nb_pers = 2
print_r($places_grav_3);
?>