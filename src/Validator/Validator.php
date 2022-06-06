<?php

namespace Tringuyen\CarForRent\Validator;

class Validator
{
    /**
     * @var array $patterns
     */
    public $patterns = array(
        'uri' => '[A-Za-z0-9-\/_?&=]+',
        'url' => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha' => '[\p{L}]+',
        'words' => '[\p{L}\s]+',
        'alphanum' => '[\p{L}0-9]+',
        'int' => '[0-9]+',
        'float' => '[0-9\.,]+',
        'tel' => '[0-9+\s()-]+',
        'text' => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address' => '[\p{L}0-9\s.,()°-]+',
        'date_dmy' => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd' => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email' => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
    );

    /**
     * @var array $errors
     */
    public $errors = array();

    /**
     * Nome del campo
     *
     * @param string $name
     * @return this
     */
    public function name($name)
    {

        $this->name = $name;
        return $this;
    }

    /**
     * Valore del campo
     *
     * @param mixed $value
     * @return this
     */
    public function value($value)
    {

        $this->value = $value;
        return $this;
    }

    /**
     * Campo obbligatorio
     *
     * @return this
     */
    public function required()
    {

        if ((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)) {
            $this->errors[$this->name] = $this->name . ' field required.';
        }
        return $this;
    }
    public function equal($value){

        if($this->value != $value){
            $this->errors[$this->name] = $this->name.' doesn\'t match';
        }
        return $this;

    }
    /**
     * Lunghezza minima
     * del valore del campo
     *
     * @param int $min
     * @return this
     */
    public function min($length)
    {

        if (is_string($this->value)) {
            if (strlen($this->value) < $length) {
                $this->errors[$this->name] = $this->name . ' field is less than minimum value';
            }
        } else {
            if ($this->value < $length) {
                $this->errors[$this->name] = $this->name . ' field is less than minimum value';
            }
        }
        return $this;
    }

    /**
     * Lunghezza massima
     * del valore del campo
     *
     * @param int $max
     * @return this
     */
    public function max($length)
    {

        if (is_string($this->value)) {
            if (strlen($this->value) > $length) {
                $this->errors[$this->name] = $this->name . ' field is more than maximum value';
            }
        } else {
            if ($this->value > $length) {
                $this->errors[$this->name] = $this->name . ' field is more than maximum value';
            }
        }
        return $this;
    }

    public function is_numeric()
    {
        if (!is_numeric($this->value)) {
            $this->errors[$this->name] = $this->name . ' doesn\'t match type';
        }
        return $this;
    }


    /**
     * Campi validati
     *
     * @return boolean
     */
    public function isSuccess()
    {
        if (empty($this->errors)) {
            return true;
        }
    }

    /**
     * Errori della validazione
     *
     * @return array $this->errors
     */
    public function getErrors()
    {
        if (!$this->isSuccess()) {
            return $this->errors;
        }
    }

}
