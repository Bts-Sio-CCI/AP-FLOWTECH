<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database; // Importation correcte

class TestDb extends Controller
{
    public function index()
    {
        try {
            // Obtenir la connexion à la base de données
            $db = Database::connect(); // Utilisation correcte

            // Vérifier si la connexion est établie
            if ($db->simpleQuery('SELECT 1')) {
                return "Connexion réussie à la base de données !";
            } else {
                return "Échec de la connexion à la base de données.";
            }
        } catch (\Exception $e) {
            // Afficher message d'erreur détaillé
            if ($e->getCode() === 1049) {
                return "Erreur : Base de données non trouvée. " . $e->getMessage();
            } elseif ($e->getCode() === 1045) {
                return "Erreur : Identifiant ou mot de passe invalides. " . $e->getMessage();
            } elseif ($e->getCode() === 2002) {
                return "Erreur : Problème de connexion au serveur MySQL. " . $e->getMessage();
            } else {
                return "Erreur inconnue : " . $e->getMessage();
            }
        }
    }
}
