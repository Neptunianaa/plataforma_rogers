<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use App\Paciente;

use App\Http\Requests;
use App\Pauta_eval;


class ControllerPautaEval extends Controller
{
    public function view()
    {
        return view('formulario.pautaEvaluacion');
    }

    /**
     * @param Request $request
     */
    public function agregarPauta(Request $request){

    $fillable = ['id_usuario','sint_ansiosa','sint_depresiva','idea_int_suicida','trans_alimen','prob_identidad','prob_academicos','prob_familiares','prob_pareja','prob_interper','duelo','abuso_sex','otro','motivo_consulta','indicaciones','sugerencia','observaciones'];

        $pauta_aux = new Pauta_eval;
  
            $pauta_aux->sint_ansiosa=$request->input('pre1');
            $pauta_aux->sint_depresiva=$request->input('pre2');
            $pauta_aux->idea_int_suicida=$request->input('pre3');
            $pauta_aux->trans_alimen=$request->input('pre4');
            $pauta_aux->prob_identidad=$request->input('pre5');
            $pauta_aux->prob_academicos=$request->input('pre6');
            $pauta_aux->prob_familiares=$request->input('pre7');
            $pauta_aux->prob_pareja=$request->input('pre8');
            $pauta_aux->prob_interper=$request->input('pre9');
            $pauta_aux->duelo=$request->input('pre10');
            $pauta_aux->abuso_sex=$request->input('pre11');
            $pauta_aux->otro=$request->input('pre12');
                        $pauta_aux->motivo_consulta=$request->input('motivo_consulta');
            $pauta_aux->indicaciones=$request->input('psicoterapia');
            $pauta_aux->sugerencia=$request->input('se_sugiere');
                        
                        $pauta_aux->observaciones=$request->input('observaciones');
                        $pauta_aux->comentarios=$request->input('comentarios');

           $pauta_aux->id_usuario=id_usuario;
         $pauta_aux->push();
          dd("Pauta Evaluacion creada exitosamente");
        
       
       
    }
}
