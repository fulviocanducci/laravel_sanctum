<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;

abstract class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $errors = [];
    protected Model $model;

    protected function validate(Request $request, string $when){
        $request->validate($this->errors[$when]);
    }

    protected function validateCreate(Request $request){
        $this->validate($request, 'create');
    }

    protected function validateUpdate(Request $request){
        $this->validate($request, 'update');
    }

    protected function validateAndCreate(Request $request, Model $model){
        $this->validateCreate($request);
        return $model->create($request->all());
    }

    protected function validateAndUpdate(Request $request, Model $model, $id = 'id'){
        $this->validateUpdate($request);
        $entity = $model->where($id, $request->get($id))->first();
        if ($entity) {
            $entity->update($request->except([$id]));
            return $entity;
        }
        return false;
    }

    public function index() {
        return $this->model->get();
    }

    public function get($id) {
        return $this->model->find($id);
    }

    public function page() {
        return $this->model->paginate(3);
    }

    public function create(Request $request) {
        return $this->validateAndCreate($request, $this->model);
    }

    public function update(Request $request) {
        return $this->validateAndUpdate($request, $this->model, 'id');
    }

}
