<?php

namespace App\Http\Controllers;

use App\Models\Todo;

class TodoController extends ApiController
{
    protected $errors = [
        'create' => [
            'description' => 'required',
            'status' => 'required'
        ],
        'update' => [
            'id' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]
    ];

    public function __construct(Todo $model){
        $this->model = $model;
    }

}
