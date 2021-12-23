<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class MahasiswaRepository {

    public function __construct() {
        $this->model = new Mahasiswa;
    }

    public function all() {
        $datas = $this->model->get();
        return $datas;
    }

    
    public function store(array $data) {
        $datas = $this->model->insert($data);
        return $datas;
    }

    public function update(array $where, array $data) {
        $datas = $this->model->where($where)
                ->update($data);
        return $datas;
    }

    public function delete(array $where) {
        $datas = $this->model->where($where)->delete();
        return $datas;
    }
    public function findBy(array $where) {
        $datas = $this->model->where($where)->first();
        return $datas;
    }
/*

    public function allBy(array $where) {
        $datas = $this->model->where($where)->get();
        return $datas;
    }

    public function allOrder($orders) {
        $datas = $this->model->orderByRaw($orders)->get();
        return $datas;
    }

    public function allByOrder(array $where, $orders) {
        $datas = $this->model->where($where)->orderByRaw($orders)->get();
        return $datas;
    }

    public function find(array $where) {
        $datas = $this->model->where($where)->get();
        return $datas;
    }

    public function findOrder(array $where, $orders) {
        $datas = $this->model->where($where)->orderByRaw($orders)->get();
        return $datas;
    }

    public function findBy(array $where) {
        $datas = $this->model->where($where)->first();
        return $datas;
    }

    public function findByOrder($where, $orders) {
        $datas = $this->model->where($where)->orderByRaw($orders)->first();
        return $datas;
    }

    public function findByBetween($field, array $where) {
        $datas = $this->model->whereBetween($field, $where)->get();
        return $datas;
    }

    public function findByBetweenBy($field, array $where) {
        $datas = $this->model->whereBetween($field, $where)->first();
        return $datas;
    }


    public function delete($id) {
        $datas = $this->model->where('id', $id)->delete();
        return $datas;
    }

    public function deleteBy(array $data) {
        $datas = $this->model->where($data)->delete();
        return $datas;
    }
*/
    
}