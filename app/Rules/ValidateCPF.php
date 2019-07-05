<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateCPF implements Rule
{
    public function passes($attribute, $value)
    {
        return $this->cpfIsValid($value);
    }

    /**
     * Code from package [validator-docs], where the Owner is geekcom
     * url: https://github.com/geekcom/validator-docs
     */
    protected function cpfIsValid($value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) ;

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--) ;

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return __('CPF inválido');
    }
}
