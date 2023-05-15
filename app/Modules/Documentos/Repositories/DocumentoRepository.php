<?php

namespace App\Modules\Documentos\Repositories;
use App\Modules\Documentos\Models\Documento;
class DocumentoRepository {
    public function inserirEmLote ($dados) {
        Documento::insert($dados);
        return true;
    } 
}