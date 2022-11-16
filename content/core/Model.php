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
    /**
     * ALGUNAS REGLAS DE VALIDACION
     */
    public const RULE_NULL = "null";
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_CEDULA_MIN = "cedula_min";
    public const RULE_CEDULA_MAX = "cedula_max";
    public const RULE_TELEFONO_MIN = "telefono_min";
    public const RULE_TELEFONO_MAX = "telefono_max";
    public const RULE_MACTH = "match";

    /**
     * STATUS DE ACTIVADO ODESACTIVADO
     */
    public const ACTIVE = 1;
    public const INACTIVE = 0;

    /**
     * STATUS PARA EL SEXO
    */
    public const MASCULINO = 1;
    public const FEMENINO = 0;

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
                if ($ruleName === self::RULE_CEDULA_MIN && strlen($value) < $rule['cedula_min']){
                    $this->addErrorForRule($attribute,self::RULE_CEDULA_MIN, $rule);
                }
                if ($ruleName === self::RULE_CEDULA_MAX && strlen($value) > $rule['cedula_max']){
                    $this->addErrorForRule($attribute,self::RULE_CEDULA_MAX, $rule);
                }
                if ($ruleName === self::RULE_TELEFONO_MIN && !$value && strlen($value) < $rule['telefono_min']){
                    $this->addErrorForRule($attribute,self::RULE_TELEFONO_MIN, $rule);
                }
                if ($ruleName === self::RULE_TELEFONO_MAX && !$value && strlen($value) > $rule['telefono_max']){
                    $this->addErrorForRule($attribute,self::RULE_TELEFONO_MAX, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * Add error for rule
     * @param string $attribute
     * @param string $rule
     * @param array $params
     * @return void
     */
    private function addErrorForRule(string $attribute, string $rule, array $params = [])
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
             self::RULE_CEDULA_MIN => 'La longitud mínima cedula debe ser {cedula_min}',
             self::RULE_CEDULA_MAX => 'La longitud maxima cedula debe ser {cedula_max}',
             self::RULE_TELEFONO_MIN => 'La longitud mínima telefono debe ser {telefono_min}',
             self::RULE_TELEFONO_MAX => 'La longitud maxima telefono debe ser {telefono_max}',
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