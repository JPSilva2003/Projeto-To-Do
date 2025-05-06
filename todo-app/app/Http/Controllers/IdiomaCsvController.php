<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Idioma;

class IdiomaCsvController extends Controller
{



    public function export($locale)
    {
        $path = resource_path("lang/{$locale}/messages.php");

        if (!File::exists($path)) {
            abort(404, "Idioma não encontrado");
        }

        $translations = include $path;

        $response = new StreamedResponse(function () use ($translations) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['key', 'value']); // Header

            foreach ($translations as $key => $value) {
                fputcsv($handle, [$key, $value]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename={$locale}_translations.csv");

        return $response;
    }

    public function import(Request $request)
    {
        $request->validate([
            'locale' => 'required|string',
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $locale = $request->input('locale');
        $file = $request->file('file');

        // Criar pasta se não existir
        $langPath = resource_path("lang/{$locale}");
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true);
        }

        // Processar CSV
        $csv = array_map('str_getcsv', file($file->getRealPath()));
        $translations = [];

        foreach ($csv as $index => $row) {
            if ($index === 0) continue; // Cabeçalho
            if (count($row) !== 2) continue;
            $translations[$row[0]] = $row[1];
        }

        // Criar conteúdo do messages.php
        $exportContent = "<?php\n\nreturn [\n";
        foreach ($translations as $key => $value) {
            $exportContent .= "    '{$key}' => '" . addslashes($value) . "',\n";
        }
        $exportContent .= "];\n";


        Idioma::updateOrCreate(
            ['codigo' => $locale],
            ['nome' => $request->input('name'), 'ativo' => true]
        );

        file_put_contents("{$langPath}/messages.php", $exportContent);

        // Criar idioma na base de dados se não existir
        \App\Models\Idioma::firstOrCreate(
            ['codigo' => $locale],
            ['nome' => ucfirst($locale), 'ativo' => true]
        );

        return back()->with('success', "Idioma '{$locale}' importado com sucesso!");
    }



}
