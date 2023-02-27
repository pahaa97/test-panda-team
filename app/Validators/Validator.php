<?php

namespace App\Validators;

class Validator
{
    private $errors;
    private $data;

    public function validate($data, $rules) {
        $this->data = $data;
        $i = 0;
        foreach ($rules as $field => $rule) {
            $rulesList = explode("|", $rule);
            foreach ($rulesList as $ruleItem) {
                $params = explode(":", $ruleItem);
                $ruleName = $params[0];
                $method = "validate" . ucfirst($ruleName);
                if (method_exists($this, $method)) {
                    $result = $this->$method($field, $data[$field] ?? $data[$i] ?? null, $params[1] ?? null) ?? null;
                    if (!$result) {
                        $this->errors[$field][] = "Field $field is invalid by rule $ruleName";
                    }
                }
            }
            $i++;
        }
    }

    public function validateConfirmation($field, $confirmPassword)
    {
        if (isset($this->data['password']) && $this->data['password'] !== $confirmPassword) {
            return false;
        }
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function clearErrors() {
        return $this->errors = null;
    }

    private function validateRequired($field, $value) {
        return !empty($value) || $value == "0";
    }

    private function validateMin($field, $value, $min) {
        return isset($value) && strlen($value) >= $min;
    }

    private function validateInteger($field, $value) {
        return isset($value) && is_numeric($value);
    }

    private function validateEmail($field, $value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}

