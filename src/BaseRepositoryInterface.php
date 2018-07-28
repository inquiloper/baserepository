<?php

namespace Inquiloper\BaseRepository;

interface BaseRepositoryInterface
{
    public function findAll();
    public function findAllBy($fields);
    public function findOneBy($fields);
    public function with($relationships);
    public function create($data);
    public function deleteBy($fields);
    public function updateBy($fields, $data);
}