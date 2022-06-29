<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class ExistsByArrayOfIds implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $array, $fail)
    {
        foreach ($array as $value) {
            $recordsCount = DB::table($attribute)->where(['id' => $value['id']])->count();
            if ($recordsCount === 0) {
                $fail('Запись в :attribute со значением id=' . $value['id'] . ' отсутствует');
            }
        }
    }
}
