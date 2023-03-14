<?php
namespace App\Container\Token;


use App\Classes\Core\ModuleCore;
use Illuminate\Support\Facades\DB;


class TokenContainer extends ModuleCore
{
    /**
     * @var integer Идентификатор "Laravel Password Grant Client"
     */
    const ID = 2;

    /**
     * @return string
     */
    protected function getPrefix(): string
    {
        return '';
    }


    public function getToken()
    {
        return $this->cache->get('root','client:token',function (){
            return DB::table('oauth_clients')
                ->where('id', '=', self::ID)
                ->select('secret')
                ->first()->secret;
        });
    }

    public function clearToken()
    {
        $this->cache->del('root','client:token');
    }
}