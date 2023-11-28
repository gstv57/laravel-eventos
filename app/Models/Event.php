<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    // informar que items vai ser um array, caso não faça isso, ele ira retornar um erro no banco de dados no momento do insert, porque vai ser salvo no formato string.
    // dessa forma podemos salvar um json no banco de dados para resgatar o mesmo após.
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
