<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  public $table = 'tickets';
  public $primaryKey = 'id';
  public $timestamp = false;
  public $guarded = [];

    public function scopeSearch($query, $id){
      return $query->where('id', '=', $id);
    }

    public function usuario(){
      return $this->belongsTo(Usuario::class,'id_usuario');
    }

}
