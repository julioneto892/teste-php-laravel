<?php

namespace App\Http\Controllers;

use App\Jobs\ImportarArquivoJobs;
use App\Models\Categories;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    public function importar()
    {
        $documentos = Documents::with('categories')->get();
        $jobs = Queue::size('default');
        return view('importar', ['documentos' => $documentos, 'jobs' => $jobs]);
    }

    public function ImportarAqquivo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Nenhum arquivo informado.');
        }
        // Verifica se o arquivo enviado é do tipo JSON
        if ($request->file('file')->getClientOriginalExtension() !== 'json') {
            return redirect()->back()->with('error', 'O arquivo enviado não é um JSON.');
        }

        $documento = json_decode($request->file('file')->getContent(), true);
        dispatch(new ImportarArquivoJobs($documento));

        return redirect()->back()->with('success', 'O arquivo foi adicionado à fila de importação.');
    }

    public function ProcessarFila()
    {
        $jobs = Queue::size('default');

        if ($jobs > 0) {
            Artisan::call('queue:work', ['--once' => true]);
            return redirect()->back()->with('success', 'A fila de importação foi processada.');
        }

        return redirect()->back()->with('warning', 'Não há documentos pendentes na fila de importação.');
    }

}
