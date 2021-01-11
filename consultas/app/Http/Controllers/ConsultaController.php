<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\Ticket;

class ConsultaController extends Controller
{

  public function busquedaPorTicket($email, $ticket){
  $usuarioSeleccionado = Usuario::where('email',$email)->get();
  if ($usuarioSeleccionado === null) {
    $resultado = "No se encuentra usuario con dicho email";
  }
  $usuarioSeleccionadoScope = Usuario::Search($usuarioSeleccionado->id)->first();
  $usuarioSeleccionadoTickets = $usuarioSeleccionadoScope->tickets()->get();
  if ($usuarioSeleccionadoTickets === null) {
    $resultado = "El usuario no posee tickets";
  }
  foreach ($usuarioSeleccionadoTickets as $ticketUsuario) {
    if ($ticketUsuario->codigo == $ticket && $ticketUsuario->estado == "vigente" ) {
      $resultado = "El ticket del usuario esta vigente";
    }else {
      $resultado = "El ticket no pertenece al usuario o no esta vigente";
    }
  }
  return view('home')->with('resultado', $resultado);
}


public function ticketsPorUsuario($email){
  $usuarioSeleccionado = Usuario::where('email',$email)->get();
  if ($usuarioSeleccionado === null) {
    $resultado2 = "No se encuentra usuario con dicho email";
  }
  $usuarioSeleccionadoScope = Usuario::Search($usuarioSeleccionado->id)->first();
  $usuarioSeleccionadoTickets = $usuarioSeleccionadoScope->tickets()->get();
  if ($usuarioSeleccionadoTickets === null) {
    $resultado2 = "El usuario no posee tickets";
  }
  $vigente = 'vigente';
  $resultado2 = $usuarioSeleccionadoTickets::where('estado',$vigente)->get();
  if ($resultado2 === null) {
    $resultado2 = "El usuario no posee tickets vigentes";
  }
  return view('home')->with('resultado', $resultado2);
}


}
