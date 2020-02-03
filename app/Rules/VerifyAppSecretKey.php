<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\App;

class VerifyAppSecretKey implements Rule
{
    protected $appKey;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($appKey)
    {
        $this->appKey = $appKey;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = App::whereAppKey($this->appKey)->whereSecretKey($value)->first();

        return ($result);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please provide valid :attribute';
    }
}
