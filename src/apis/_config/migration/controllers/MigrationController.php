<?php
namespace App\apis\_config\migration\controllers;

use App\apis\_config\migration\services\MigrationService;
use App\core\request\Request;

class MigrationController
{
    private MigrationService $migrationService;

    public function __construct(MigrationService $migrationService)
    {
        $this->migrationService = $migrationService;
    }

    public function migrate(Request $request): void
    {
        // Ouput format
        header('Content-Type: application/json');

        try {
            $results = $this->migrationService->runMigrations();
            
            echo json_encode([
                'status' => 'success',
                'data' => $results
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Fallo crítico en el sistema de migraciones.'
            ]);
        }
    }
}