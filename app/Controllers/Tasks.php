<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Tasks extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format    = 'json';

    // GET /tasks
    public function index() { return $this->respond($this->model->findAll()); }

    // GET /tasks/1
    public function show($id = null)
    {
        $task = $this->model->find($id);
        if ($task === null) { return $this->failNotFound('No se encontró la tarea con id ' . $id); }
        return $this->respond($task);
    }

    // POST /tasks
    public function create()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[120]',
            'description' => 'permit_empty|min_length[10]',
            'status' => 'permit_empty|in_list[pending,completed,in_progress]'
        ];
        if (!$this->validate($rules)) { return $this->fail($this->validator->getErrors()); }

        $data = [
            'title'       => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status'      => $this->request->getVar('status') ?? 'pending'
        ];
        $id = $this->model->insert($data);
        return $this->respondCreated($this->model->find($id));
    }

    // PUT /tasks/1
    public function update($id = null)
    {
        $rules = [
            'title' => 'permit_empty|min_length[3]|max_length[120]',
            'description' => 'permit_empty|min_length[10]',
            'status' => 'permit_empty|in_list[pending,completed,in_progress]'
        ];
        if (!$this->validate($rules)) { return $this->fail($this->validator->getErrors()); }

        $task = $this->model->find($id);
        if ($task === null) { return $this->failNotFound('No se encontró la tarea con id ' . $id); }

        $data = [
            'title' => $this->request->getVar('title') ?? $task['title'],
            'description' => $this->request->getVar('description') ?? $task['description'],
            'status' => $this->request->getVar('status') ?? $task['status'],
        ];
        $this->model->update($id, $data);
        return $this->respond($this->model->find($id));
    }

    // DELETE /tasks/1
    public function delete($id = null)
    {
        $task = $this->model->find($id);
        if ($task === null) { return $this->failNotFound('No se encontró la tarea con id ' . $id); }
        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id, 'message' => 'Tarea eliminada correctamente']);
    }
}
