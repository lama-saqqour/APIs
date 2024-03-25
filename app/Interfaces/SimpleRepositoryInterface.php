<?php

namespace App\Interfaces;

interface SimpleRepositoryInterface 
{
    public function all();
    public function get($data);
    public function find($id);
    public function delete($orderId);
    public function create(array $orderDetails);
    public function update($orderId, array $newDetails);
}