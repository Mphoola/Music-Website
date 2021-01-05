<?php

namespace App\Repositories\Admin\Interfaces;

interface PostInterface {

    public function all();

    public function get($id);

    public function store(array $data);

    public function update($id, array $data);
    
    public function delete($id);

    public function restore($id);

    public function trashed();
}