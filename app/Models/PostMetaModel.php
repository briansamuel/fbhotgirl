<?php
namespace App\Models;

use DB;

class PostMetaModel
{
    protected static $table = 'post_meta';

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

    public static function update($id, $params)
    {
        $update = DB::table(self::$table)->where('id', $id)->update($params);
        return $update;
    }

    public static function delete($id)
    {
        $delete = DB::table(self::$table)->where('id', $id)->delete();
        return $delete;
    }

}
