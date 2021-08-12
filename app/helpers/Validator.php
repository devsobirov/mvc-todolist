<?php

class Validator
{

    /**
     * @var array $errors
     */
    public $errors;

    /**
     * @var string|int|bool
     */
    public $validatedValue;

    /**
     * Название поля из формы
     *
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Значение поля
     *
     * @param mixed $value
     * @return $this
     */
    public function value($value)
    {
        $this->validatedValue = $value;
        $this->value = $value;
        return $this;

    }

    /**
     * Проверка на присуствия значения полье
     *
     * @return $this
     */
    public function required()
    {

        if ($this->value == '' || $this->value == null) {
            $this->errors[] = 'Полье ' . $this->name . ' не может быть пустым';
        }
        return $this;
    }

    /**
     * Проверка на минимальную длину строки
     *
     * @param int $length
     * @return $this
     */
    public function min($length)
    {
        if (mb_strlen($this->value) < $length) {
            $this->errors[] = 'Минимальное количество символов полья' . $this->name . ' составляет ' . $length;
        }

        return $this;

    }

    /**
     * Проверка на максимальную длину строки
     *
     * @param int $length
     * @return $this
     */
    public function max($length)
    {

        if(mb_strlen($this->value) > $length) {
            $this->errors[] = 'Максимальное количество символов полья' . $this->name . ' составляет ' . $length;
        }
        return $this;

    }

    /**
     * Проверка э-почту на валидность
     * @param $value
     */
    public function is_email()
    {
        $value = $this->value;
        $this->validatedValue = $value;
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Введите валидную э-почту';
        }
        return $this;
    }


    /**
     * Очитска вводимого текста от потенциальных XSS аттак
     *
     * @param string $string
     * @return string $string
     */
    public function purify($string)
    {
        //$this->validatedValue = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        $this->validatedValue = strip_tags($string);
        return $this;
    }

    /**
     * Проверка на суммарную валидность
     *
     * @return boolean
     */
    public function isSuccess()
    {
        if (empty($this->errors)) return true;
    }

    /**
     * Получаем суммарных ошибок
     *
     * @return array $this->errors
     */
    public function getErrors()
    {
        if (!$this->isSuccess()) return $this->errors;
    }

    /**
     * Возвращаем true в случаи успеха или всех ошибок
     * @param $messages
     * @return bool|array
     */
    public function result($messages)
    {

        if (!$this->isSuccess()) {

            foreach ($this->getErrors() as $error) {
                $messages[] = $error;
            }

        }
        return $messages;
    }
}