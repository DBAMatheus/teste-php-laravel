<?php

namespace App\Modules\Categorias\Services;

use App\Modules\Categorias\Repositories\CategoriaRepository;

class CategoriaService {
    private $categoria_repository;
    public function __construct(CategoriaRepository $categoria_repository)
    {
        $this->categoria_repository = $categoria_repository;
    }
    public function capturarDadosCategoriaPorNome ($nome) {
        if ($nome) {
            request()->merge(['name' => $nome]);
            $dados_categoria = $this->categoria_repository->lerDadosCategoria()->first();
            return $dados_categoria;
        }
        return [];
    }
}