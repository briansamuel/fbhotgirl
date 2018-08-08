<?php
namespace App\Models;

use DB;

class PostModel
{
    protected static $table = 'post';

    /**
     *
     */
    public static function getMany($limit, $offset, $filter)
    {
        $query = DB::table(self::$table)->skip($offset)->take($limit);
        if(isset($filter['keyword']) && $filter['keyword'] != ""){
            $query->where('post_keyword', 'like', "%$filter[keyword]%");
        }
        if(isset($filter['author']) && $filter['author'] != ""){
            $query->where('post_author', '=', $filter['author']);
        }
        return $query->get();
    }

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
