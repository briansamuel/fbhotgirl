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
