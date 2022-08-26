<?php

namespace App\Http\Controllers;

use App\Models\Todo;

class TestController extends Controller
{
    public function index() {
        $todos = Todo::query();
        $todos = $todos->where('id', 1);
        $todos = $todos->union(Todo::where('id', 11));
        return response()
            ->json([$todos->get(), $todos->toSql()], 200);
    }
}
