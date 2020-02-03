<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\App;

class VerifyAppCodeId implements Rule
{
    protected $appKey;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($appKey, $secretKey)
    {
        $this->appKey = $appKey;
        $this->secretKey = $secretKey;
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
        $result['app'] = App::whereAppKey($this->appKey)
            ->whereSecretKey($this->secretKey)
            ->whereHas('codes',function($q) use ($value){
                return $q->whereId($value);
            })
            ->first();

        if(!$result['app']){
            return false;
        }

        return true;

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
