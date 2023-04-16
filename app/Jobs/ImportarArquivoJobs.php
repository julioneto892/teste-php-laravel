<?php

namespace App\Jobs;

use App\Models\Categories;
use App\Models\Documents;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportarArquivoJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function handle(): void
    {
        $arquivo = $this->file;

        foreach ($arquivo['documentos'] as $document) {
            $categoria_id = Categories::where('name', $document['categoria'])->first()->id;
            $documento = [
                'category_id' => $categoria_id,
                'title' => $document['titulo'],
                'contents' => $document['conteúdo'],
                'exercise' => $arquivo['exercicio']
            ];

            Documents::create($documento);
        }
    }
}
