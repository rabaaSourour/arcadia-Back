<?php

namespace App\Controllers;

class ArcadiaController {

    public function index(){
        echo 'Je suis la homepage';
    }

    public function show(int $id){
        echo 'Je suis l\'animal ' . $id;
    }

    public function list() {
        echo 'Voici la liste des animaux de zoo';
    }

    public function create(int $id) {
        echo 'Créer un nouvel'. $id. 'de zoo';
    }


    public function edit(int $id) {
        // Logic to show the edit form
        echo 'description pour l\'animal ' . $id;
    }

    public function update(int $id) {
        // Logic to update a post
        echo 'L\'animal ' . $id . ' a été mis à jour';
    }

    public function destroy(int $id) {
        // Logic to delete a post
        echo 'L\'animal ' . $id . ' a été supprimé';
    }
}