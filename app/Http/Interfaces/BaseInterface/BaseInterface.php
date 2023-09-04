<?php

namespace App\Http\Interfaces\BaseInterface;

interface BaseInterface
{
    public function get($id);
    public function all();
    public function save($data, $id);
    public function remove();
    public function destroy($id);
}

?>
