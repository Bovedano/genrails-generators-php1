<?php

namespace App\apis\_config\migration\services;

use Exception;

class MigrationService 
{
    private string $migrationsPath;

    public function __construct(string $migrationsPath) 
    {
        $this->migrationsPath = $migrationsPath;
    }

    /**
     * Ejecuta las migraciones y devuelve el reporte de resultados.
     */
    public function runMigrations(): array 
    {
        $results = [];
        $files = glob($this->migrationsPath . '/*.php');

        foreach ($files as $file) {
            $name = basename($file, '.php');
            try {
                // Aquí podrías añadir lógica para no repetir migraciones ya hechas
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