<?php
namespace App\Http\Interfaces;

use App\Http\Interfaces\BaseInterface\BaseInterface;

interface SettingsRepositoryInterface extends BaseInterface
{
    public function checkKey($key);
}

?>
