<?php

namespace Inquiloper\BaseRepository;

use Illuminate\Database\Eloquent\Model;
use Inquiloper\BaseRepository\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model, $queryBuilder;

    public function __construct(Model $model){
        $this->model = $model;
        $this->queryBuilder = $this->model->newQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->get();
    }

    public function findAllBy($fields){
    
        return $this->addWheres($fields)->get();
    }

    public function findOneBy($fields){
        
        return $this->addWheres($fields)->first();
    }

    private function addWheres($fields){

        if(count($fields)){
            foreach($fields as $field => $value){
                $this->queryBuilder->where($field, $value);
            }
        }
        
        return $this->queryBuilder;
    }

    public function create($data){
        return $this->model->create($data);
    }

    public function deleteBy($fields){

        return $this->findOneBy($fields)->delete();
    }

    public function updateBy($fields, $data){

        return $this->findOneBy($fields)->update($data);
    }

    public function with($relationships){

        if(count($relationships)){

            foreach($relationships as $relationship){

                $this->queryBuilder->with($relationship);
            }
        }
        return $this;
    }

    public function __call($name, $arguments){

        $opinionated = isset($arguments[1]) ? $arguments[1] : true;
        $matches = [];
        preg_match_all('/^findOneBy(\w+)$/', $name, $matches);

        if(!count($matches[1])){
            throw new \Exception("Incorrect method invocation.");
            
        }

        $columnName = $matches[1][0];
        if($opinionated){
            $columnName = snake_case($columnName);
        }

        return $this->findOneBy([
            $columnName => $arguments[0]
        ]);
        
        
    }
}