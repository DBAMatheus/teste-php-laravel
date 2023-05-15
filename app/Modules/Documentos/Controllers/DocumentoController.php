<?php

namespace App\Modules\Documentos\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentos\Services\DocumentoService;

class DocumentoController extends Controller
{
    //
    private $documento_service;
    public function __construct(DocumentoService $documento_service)
    {
        $this->documento_service = $documento_service;
    }

    public function processarDocumentoView () {
        return view('ProcessarDocumento');
    }

    public function adicionarArquivoFila (Request $request) {
        try {
            $ler_arquivo = $this->documento_service->lerArquivo();
            return response()->json($ler_arquivo, 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensagem' => 'Erro ao ler o arquivo',
                'mensagem_tecnica' => $e->getMessage()
            ], 422);
        }
    }

    public function processarFila () {
        try {
            $processar_fila = $this->documento_service->processarFila();
            return response()->json($processar_fila);
        } catch (\Exception $e) {
            return response()->json([
                'mensagem' => 'Erro ao processar a fila',
                'mensagem_tecnica' => $e->getMessage()
            ], 422);
        }
    }

}
