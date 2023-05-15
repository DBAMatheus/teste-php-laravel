<?php

namespace App\Jobs;

use App\Modules\Documentos\Services\DocumentoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessarArquivosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $dados_arquivo;
    public function __construct($dados)
    {
        //
        $this->dados_arquivo = $dados;
    }

    /**
     * Execute the job.
     */
    public function handle(DocumentoService $documentos_service): void
    {
        //
        $dados = $documentos_service->montarDadosArquivoInsercao($this->dados_arquivo);
        $documentos_service->inserirEmLote($dados);
    }
}
