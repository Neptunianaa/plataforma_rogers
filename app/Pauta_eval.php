<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pauta_eval extends Model
{
    protected $table = "pauta_eval";
    protected $fillable = ['id_usuario','sint_ansiosa','sint_depresiva','idea_int_suicida','trans_alimen','prob_identidad','prob_academicos','prob_familiares','prob_pareja','prob_interper','duelo','abuso_sex','otro','motivo_consulta','indicaciones','sugerencia','observaciones'];
             	public $timestamps = false;


 public function usuario(){
    	return $this->belongsTo('App\User');
    }

 public function paciente(){
        return $this->belongsTo('App\Paciente');
    }

}
