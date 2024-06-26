<?php

class ApiTokenAuthenticator
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function authenticate(Request $request): ?array
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        
        if (empty($apiToken)) {
            throw new Exception('No API token provided');
        }

        // Requête pour récupérer l'utilisateur par son token API
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE api_token = :api_token');
        $stmt->execute(['api_token' => $apiToken]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('Invalid API token');
        }

        // Retourner les informations de l'utilisateur
        return [
            'user_id' => $user['id'],
            'username' => $user['username'],
            // Vous pouvez ajouter d'autres informations d'utilisateur nécessaires ici
        ];
    }
}
