<?php

namespace App\Modules\Documentos\Services;

use App\Jobs\ProcessarArquivosJob;
use App\Modules\Categorias\Services\CategoriaService;
use App\Modules\Documentos\Repositories\DocumentoRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class DocumentoService {
    private $documento_repository;
    private $categoria_service;
    public function __construct(DocumentoRepository $documento_repository, CategoriaService $categoria_service)
    {
        $this->documento_repository = $documento_repository;
        $this->categoria_service = $categoria_service;
    }
    public function lerArquivo () {
        $nome_arquivo = '2023-03-28.json';
        $storage_data = Storage::disk('data');
        if ($storage_data->exists($nome_arquivo)) {
            $dados_arquivo = $storage_data->get($nome_arquivo);
            $dados_arquivo = str_replace('"conteúdo":', '"conteudo":', $dados_arquivo);
            $dados_arquivo = json_decode($dados_arquivo);
            ProcessarArquivosJob::dispatch($dados_arquivo)->onQueue('documentos');
        }
        return true;
    }

    public function inserirEmLote($dados) {
        $inserir_em_lote = $this->documento_repository->inserirEmLote($dados);
        return $inserir_em_lote;
    }

    public function montarDadosArquivoInsercao ($dados_arquivo) {
        $monta_dados_insercao = array();
        foreach ($dados_arquivo as $key => $dados) {
            if ($key == 'documentos') {
                foreach ($dados as $key => $doc) {
                    $categoria = $this->categoria_service->capturarDadosCategoriaPorNome($doc->categoria);
                    $dados[$key]->categoria = $categoria->id;
                    $monta_dados_insercao[] = [
                        'category_id' => $categoria->id,
                        'title' => $doc->titulo,
                        'contents' => $doc->conteudo,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
            }
        }
        return $monta_dados_insercao;
    }

    public function processarFila () {
        Artisan::call('queue:work --queue=documentos --stop-when-empty');
        return ['msg' => 'Fila processada'];
    }
}