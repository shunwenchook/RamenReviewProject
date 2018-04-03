<?php
namespace App\Repository;
use App\Entity\Ramen;
class RamenRepository
{
    private $ramens = [];

    public function __construct()
    {

//        $ramen = new Ramen(1, 'test', 'test', 'test', 'test', 'test');

        $id = 1;
        $s1 = new Ramen($id, 'test', 'test', 'test', 'test', 'test');
        $this->ramens[$id] = $s1;
        $id = 2;
        $s2 = new Ramen($id,'test', 'test', 'test', 'test', 'test');
        $this->ramens[$id] = $s2;
        $id = 3;
        $s3 = new Ramen($id, 'test', 'test', 'test', 'test', 'test');
        $this->ramens[$id] = $s3;
    }

    public function findAll()
    {
        return $this->ramens;
    }

    public function find($id)
    {
        if(array_key_exists($id, $this->ramens)){
            return $this->ramens[$id];
        } else {
            return null;
        }
    }
}