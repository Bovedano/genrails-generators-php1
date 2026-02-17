<?php

namespace App\apis\_commons\services\templates;

class TemplateService
{
    private string $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    /**
     * @param array<string, string> $variables
     */
    public function render(string $templateName, array $variables = []): string
    {
        $filePath = "{$this->templatesPath}/{$templateName}.html";

        if (!file_exists($filePath)) {
            throw new \RuntimeException("Template not found: {$templateName}");
        }

        $content = file_get_contents($filePath);

        foreach ($variables as $key => $value) {
            $content = str_replace("{{" . $key . "}}", htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), $content);
        }

        return $content;
    }
}
