<?php
class Validator {
    private $data;
    private $rules;
    private $errors = [];
    private $messages = [];

    public function __construct($data, $rules, $messages = []) {
        $this->data = $data;
        $this->rules = $rules;
        $this->messages = $messages;
    }

    public function passes() {
        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                $params = [];
                if (strpos($rule, ':') !== false) {
                    list($rule, $param) = explode(':', $rule);
                    $params = explode(',', $param);
                }
                
                $method = 'validate' . ucfirst($rule);
                if (method_exists($this, $method)) {
                    if (!$this->$method($field, $params)) {
                        $this->addError($field, $rule, $params);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    private function addError($field, $rule, $params = []) {
        $message = $this->messages[$field . '.' . $rule] ?? $this->getDefaultMessage($field, $rule, $params);
        $this->errors[$field][] = $message;
    }

    private function getDefaultMessage($field, $rule, $params) {
        $messages = [
            'required' => 'Le champ :field est requis',
            'email' => 'Le champ :field doit être une adresse email valide',
            'min' => 'Le champ :field doit contenir au moins :param caractères',
            'max' => 'Le champ :field ne doit pas dépasser :param caractères',
            'numeric' => 'Le champ :field doit être un nombre',
            'url' => 'Le champ :field doit être une URL valide',
            'date' => 'Le champ :field doit être une date valide',
            'confirmed' => 'La confirmation du champ :field ne correspond pas',
            'unique' => 'La valeur du champ :field existe déjà',
            'exists' => 'La valeur du champ :field n\'existe pas'
        ];

        $message = $messages[$rule] ?? 'Le champ :field est invalide';
        return str_replace([':field', ':param'], [$field, $params[0] ?? ''], $message);
    }

    private function validateRequired($field) {
        $value = $this->data[$field] ?? null;
        return $value !== null && $value !== '';
    }

    private function validateEmail($field) {
        $value = $this->data[$field] ?? '';
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validateMin($field, $params) {
        $value = $this->data[$field] ?? '';
        return strlen($value) >= $params[0];
    }

    private function validateMax($field, $params) {
        $value = $this->data[$field] ?? '';
        return strlen($value) <= $params[0];
    }

    private function validateNumeric($field) {
        $value = $this->data[$field] ?? '';
        return is_numeric($value);
    }

    private function validateUrl($field) {
        $value = $this->data[$field] ?? '';
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    private function validateDate($field) {
        $value = $this->data[$field] ?? '';
        return strtotime($value) !== false;
    }

    private function validateConfirmed($field) {
        $value = $this->data[$field] ?? '';
        $confirmation = $this->data[$field . '_confirmation'] ?? '';
        return $value === $confirmation;
    }

    private function validateUnique($field, $params) {
        $value = $this->data[$field] ?? '';
        $table = $params[0];
        $column = $params[1] ?? $field;
        $except = $params[2] ?? null;

        $query = "SELECT COUNT(*) as count FROM $table WHERE $column = ?";
        $bindings = [$value];

        if ($except) {
            $query .= " AND id != ?";
            $bindings[] = $except;
        }

        $result = Database::query($query, $bindings)->fetch();
        return $result['count'] === 0;
    }

    private function validateExists($field, $params) {
        $value = $this->data[$field] ?? '';
        $table = $params[0];
        $column = $params[1] ?? $field;

        $query = "SELECT COUNT(*) as count FROM $table WHERE $column = ?";
        $result = Database::query($query, [$value])->fetch();
        return $result['count'] > 0;
    }
} 