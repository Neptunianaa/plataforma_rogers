<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Carrera_paciente;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Access\Response;

use Illuminate\Routing\Redirector;
use App\Paciente;
use App\Testoq;
class PacienteController extends Controller
{
    public function viewCrearPaciente(){
        return view('creacion.crearPaciente');
    }
    public function guardarPaciente(Request $request){
        $carrera_paciente = new Carrera_paciente;
        $paciente = new Paciente;
        try {
            $carrera_paciente -> nombre_carrera = $request->input('carrera');
            $carrera_paciente -> facultad = $request->input('facultad');
            $carrera_paciente -> ano_ingreso = $request->input('ano_ingreso');
            $carrera_paciente -> nivel_carrera = $request->input('nivel_carrera');
            $carrera_paciente -> jornada = $request->input('jornada');

            $matricula = $request->input('matricula_al_dia');
            if($matricula == "T")
                $carrera_paciente -> matricula_al_dia = true;
            else
                $carrera_paciente -> matricula_al_dia = false;
            $carrera_paciente->push();


            $paciente ->email = "paciente@usach.cl";
            $paciente -> nombre = $request->input('nombre');
            $paciente -> rut = $request ->input('rut');
            $fecha_nac = ($request ->input('fecha_nac'));
            $fecha_nac = str_replace('/', '-', $fecha_nac);
            $fecha_nac = date('Y-m-d', strtotime($fecha_nac));
            $paciente -> fecha_nac = $fecha_nac;
            $paciente -> sexo = $request -> input('sexo');
            $paciente -> fono_casa = $request->input('fono_casa','00000000');
            $paciente -> celular = $request->input('celular', '00000000');
            $paciente -> nombre_padre_tutor = $request->input('nombre_padre_tutor', 'SIN PADRE/MADRE O TUTOR');
            $paciente -> fono_padre_tutor = $request->input('fono_padre_tutor', '00000000');
            $paciente -> sistema_previsional = $request->input('sistema_previsional');
             $hoy = date('Y-m-d', strtotime(date('Y-m-d')));
             $paciente -> fecha_ingreso = $hoy;

            if($paciente->sistema_previsional == "ISAPRE") 
                $paciente->sistema_previsional = $paciente->sistema_previsional . ": " . strtoupper($request->input('isapre_cual'));
            $paciente ->region = $request->input('region');
            $paciente ->comuna = $request->input('comuna');

            $dispo_horaria = "";
            $dias = ['L', 'M', 'W', 'J', 'V'];
            foreach ($dias as $dia){
                for($i = 1; $i<=6; $i++) {
                    $checkbox = $dia . $i;
                    if ($request->has($checkbox)) {
                        $dispo_horaria = $dispo_horaria . $request->input($checkbox) . " ";
                    }
                }
            }
            $paciente->preferencia_horaria = $dispo_horaria;

            $paciente -> id_carrera = $carrera_paciente -> id;
            $paciente ->push();
            dd("Paciente creado exitosamente");

        }
        catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }


 public function buscarPaciente(Request $request2){
    $arrayDatos ;
    $paciente = new Paciente;
      try {
             $rutOnombre  = $request2->input('q');
            }
            catch(Exception $e){
                echo 'Excepción capturada: ',$e->getMessage(), "\n";
            }
            $consulta_mysql="select *
                                from paciente
                                    where rut ="+q+" or nombre LIKE '%"+@rutOnombre+"%' " ;
            $resultado_consulta_mysql=mysql_query($consulta_mysql,$conexion);

            while($arrayResultados=mysql_fetch_array($resultado_consulta_mysql)){
             echo $arrayResultados['nombre']." ";
             $arrayDatos.add($arrayResultados['nombre']);
            }

            return response()->view("vista_pacientes.resultadoBusquedaPaciente", $arrayDatos, 200);
}








}
