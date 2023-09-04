<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\SettingsRepositoryInterface;
use App\Http\Repositories\BaseRepository\Repository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use stdClass;

class SettingsRepository extends Repository implements SettingsRepositoryInterface
{
    public function __construct()
    {

    }

    public function get($id): stdClass
    {
        $setting = new stdClass();
        $setting->key = $id;
        if($id == 'null'){
            $setting->key = '';
        }
        $setting->value = '';
        if(array_key_exists($id, config('settings'))){
            $setting->key = $id;
            $setting->value = config('settings.'.$id);
        }
        return $setting;
    }

    public function all()
    {
        try{
            if (!Cache::has('settings')){
                Cache::put('settings', config('settings'), 1);
            }
            return Cache::get('settings');
        } catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function save($data, $id): bool
    {
        try{
            Config::set('settings.'.$data['key'], $data['value']);
            $settings = serialize(config('settings'));
            $file = base_path('config/settings.php');
            $data = "<?php return unserialize(base64_decode('".base64_encode($settings)."'));";
            file_put_contents($file, $data);
            Artisan::call('config:clear');
            Cache::forget('settings');
            return true;
        } catch (Exception $exception){
            return throw new Exception($exception->getMessage());
        }
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function destroy($id)
    {
        $key = $id;
        if($this->checkKey($key)) {
            $settings = config('settings');
            Arr::forget($settings, $key);
            $newSettings = $settings;
            $settings = serialize($settings);
            $file = base_path('config/settings.php');
            $data = "<?php return unserialize(base64_decode('".base64_encode($settings)."'));";
            file_put_contents($file, $data);
            Artisan::call('config:clear');
            Cache::forget('settings');
            Cache::put('settings', $newSettings, 1);
            return true;
        }
    }

    public function checkKey($key): bool
    {
        if(!array_key_exists($key, config('settings')))
        {
            return throw new Exception('This setting name does not exist.');
        }
        return true;
    }

}
