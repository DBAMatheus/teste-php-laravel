<?php

namespace App\Modules\Categorias\Repositories;

use App\Modules\Categorias\Models\Categoria;

class CategoriaRepository {
    public function lerDadosCategoria () {
        $dados = Categoria::where(function ($query) {
            if (request()->name) {
                $query->where('name', request()->name);
            }
        });
        return $dados;
    }
}