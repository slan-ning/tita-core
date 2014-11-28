<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-3-2
 * Time: 上午2:52
 */

namespace core\helper\db;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function getConnection()
    {
        return DB::connection($this->connection);
    }
}
