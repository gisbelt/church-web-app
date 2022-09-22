<?php

namespace content\core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 *  Class Model
 *
 */
abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = "email";
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MACTH = 'match';

    public const ACTIVE = 1;
    public const INACTIVE = 0;

    /**
     * Load data
     * @param $data
     * @return void
     *
     */
    public function loadData($data)
    {
        foreach ($data as $key => $item) {
            if (property_exists($this, $key)) {
                $this->{$key} = $item;
            }
        }
    }

    /**
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @var array
     */
    public $errors = [];

    /**
     *  Validate
     * @param $data
     * @return bool
     *
     */
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute,self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute,self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRule($attribute,self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                    $this->addErrorForRule($attribute,self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MACTH && $value !== $this->{$rule['match']}){
                    $this->addErrorForRule($attribute,self::RULE_MACTH, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * Add error for rule
     * @param string $attribute
     * @param string $rule
     * @param $params
     * @return void
     */
    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errosMessages()[$rule] ?? '';
        if(!empty($params)){
            foreach ($params as $key => $item) {
                $message = str_replace("{{$key}}", $item, $message);
            }
        } else {
            $message = str_replace('{attribute}', $attribute, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    /**
     * Add error
     * @param string $attribute
     * @param string $rule
     * @param $params
     * @return void
     */
    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    /**
     * Errors messages
     * @return string[]
     */
    public function errosMessages()
    {
         return [
             self::RULE_REQUIRED => 'El campo {attribute} es requerido',
             self::RULE_EMAIL => 'este campo debe ser una dirección de correo electrónico válida',
             self::RULE_MIN => 'La longitud mínima debe ser {min}',
             self::RULE_MAX => 'La longitud maxima debe ser {max}',
             self::RULE_MACTH => 'este campo debe ser el mismo que  {match}'
         ];
    }


    /**
     *  Has error
     * @param $attribute
     * @return mixed
     */
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     *  Has error
     * @param $attribute
     * @return mixed
     */
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

}