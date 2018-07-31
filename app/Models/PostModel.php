<?php
namespace App\Models;

use DB;

class PostModel
{
    protected static $table = 'post';

    /**
     *
     */
    public static function findByKey($key, $value, $columns = ['*'], $with = [])
    {
        $data = DB::table(self::$table)->select($columns)->where($key, $value)->first();
        return $data ? $data : [];
    }


    public static function insert($params)
    {
        $insert = DB::table(self::$table)->insertGetId($params);
        return $insert;
    }

}
