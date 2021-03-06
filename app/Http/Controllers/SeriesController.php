<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\FormValidationRequest;
use App\Services\RemovedorDeSerie;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{

    public function exibir_series(Request $request)
    {
        $series = Series::query()->orderBy("nome_serie")->get(); #Outra forma: $series = Series::orderBy("nome_serie")->get();

        $mensagem = $request->session()->get("mensagem");

        return view('series', ["series" => $series, "mensagem" => $mensagem]);
    }

    public function exibir_adicionar_serie()
    {
        return view('adicionar_serie');
    }

    public function add_serie(FormValidationRequest $request)
    {

        $nome_da_serie = $request->get("nm_serie");

        DB::beginTransaction(); # INICIA UMA TRANSAÇÃO

        $serie = Series::create(["nome_serie" => $nome_da_serie]);

        # INSERINDO AS TEMPORADAS E SEUS EPISÓDIOS
        $qtd_temporadas = $request->get("num_temporada");
        for ($cont = 1; $cont <= $qtd_temporadas; $cont += 1){

            $temporada = $serie->temporadas()->create(["numero_temporada" => $cont]);

            $qtd_ep = $request->get("num_ep");
            for ($cont2 = 1; $cont2 <= $qtd_ep; $cont2 += 1){

                $temporada->episodios()->create(["numero_episodio" => $cont2]);
            }
        }

        DB::commit(); # FINALIZA A TRANSAÇÃO

        $request->session()->flash("mensagem", "A série $serie->cod_serie, cujo nome é $serie->nome_serie, foi adicionada com sucesso!");
        
        return redirect("/series");
        
    }

    public function del_serie(Request $request, RemovedorDeSerie $removedor_de_serie, int $id)
    {

        $serie = $removedor_de_serie->remover_serie($id);

        $request->session()->flash("mensagem", "A série $serie->nome_serie foi deletada com sucesso!");

        
        return redirect("/series");
        
    }
}