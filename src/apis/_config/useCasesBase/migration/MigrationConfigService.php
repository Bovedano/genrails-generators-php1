<?php

namespace App\apis\_config\useCasesBase\migration;

use Exception;

class MigrationConfigService
{
    private string $migrationsPath;

    public function __construct(string $migrationsPath)
    {
        $this->migrationsPath = $migrationsPath;
    }

    /**
     * Ejecuta las migraciones y devuelve el reporte de resultados.
     */
    public function execute(): array
    {
        $results = [];
        $files = glob($this->migrationsPath . '/*.php');

        foreach ($files as $file) {
            $name = basename($file, '.php');
            try {
                require_once $file;
                $results[] = ['migration' => $name, 'status' => 'ok'];
            } catch (Exception $e) {
                $results[] = [
                    'migration' => $name,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

        return $results;
    }
}
