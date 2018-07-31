<?php
namespace App\Services;

use Validator;

class ValidationService
{

    /*
    * function make validation
    */
    public function make($params, $type)
    {
        $validator = Validator::make(
            $params,
            $this->getRules($type),
            $this->getCustomMessages()
        );
        return $validator;
    }

    /*
    * function get rule config
    */
    public function getRules($type)
    {
        $rules = [
           'insert_post_fields' => [
                'post_title' => self::getRule('require_field'),
                'post_description' => self::getRule('require_field'),
                'post_content' => self::getRule('require_field'),
                'post_keyword' => self::getRule('require_field'),
                'post_thumbnail' => self::getRule('require_field'),
                'post_author' => self::getRule('require_field'),
                'post_status' => self::getRule('require_field'),
                'post_type' => self::getRule('require_field')
            ],
            'update_post_fields' => [
                'post_title' => self::getRule('require_field'),
                'post_description' => self::getRule('require_field'),
                'post_content' => self::getRule('require_field'),
                'post_keyword' => self::getRule('require_field'),
                'post_thumbnail' => self::getRule('require_field'),
                'post_author' => self::getRule('require_field'),
                'post_status' => self::getRule('require_field'),
                'post_type' => self::getRule('require_field')
            ],
            'insert_taxonomy_fields' => [
                'taxonomy_name' => self::getRule('require_field'),
                'taxonomy_parent' => self::getRule('require_field'),
                'taxonomy_type' => self::getRule('require_field'),
            ],
            'update_taxonomy_fields' => [
                'taxonomy_name' => self::getRule('require_field'),
                'taxonomy_parent' => self::getRule('require_field'),
                'taxonomy_type' => self::getRule('require_field')
            ],
            'insert_taxonomy_relation_fields' => [
                'term_id' => self::getRule('mid'),
                'post_id' => self::getRule('mid')
            ],
            'update_taxonomy_relation_fields' => [
                'term_id' => self::getRule('mid'),
                'post_id' => self::getRule('mid')
            ],
            'insert_post_meta_fields' => [
                'post_id' => self::getRule('mid'),
                'meta_key' => self::getRule('require_field'),
                'meta_value' => self::getRule('require_field')
            ],
            'update_post_meta_fields' => [
                'post_id' => self::getRule('mid'),
                'meta_key' => self::getRule('require_field'),
                'meta_value' => self::getRule('require_field')
            ],
            'insert_options_fields' => [
                'id_option' => self::getRule('mid'),
                'meta_key' => self::getRule('require_field'),
                'meta_value' => self::getRule('require_field')
            ],
            'update_options_fields' => [
                'id_option' => self::getRule('mid'),
                'meta_key' => self::getRule('require_field'),
                'meta_value' => self::getRule('require_field')
            ],
        ];

        return isset($rules[$type]) ? $rules[$type] : array();
    }


    /*
    * function get rule
    */
    public function getRule($rule)
    {
        $rules = [
            'cid' => 'numeric',
            'mid' => 'numeric|required',
            'limit' => 'numeric',
            'offset' => 'numeric',
            'require_field' => 'required',
        ];

        return $rules[$rule];
    }

    /**
     * function get custom messages
     */
    public function getCustomMessages()
    {
        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        return $messages;
    }
}
