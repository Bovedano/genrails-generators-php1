<?php
namespace App\apis\_config\useCasesBase\migration;

use App\core\request\Request;

class MigrationConfigController
{
    private MigrationConfigService $service;

    public function __construct(MigrationConfigService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): void
    {
        header('Content-Type: application/json');

        try {
            $results = $this->service->execute();

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
