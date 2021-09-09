<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Person;

class UniqueUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        
        $firstname     = strtoupper(request('firstname'));
        $middlename    = strtoupper(request('middlename'));
        $lastname      = strtoupper(request('lastname'));
        $date_of_birth = request('date_of_birth');

        $hasRegistered = Person::where([
            'firstname'     => $firstname,
            'middlename'    => is_null($middlename) ?? '',
            'lastname'      => $lastname,
            'date_of_birth' => $date_of_birth,
        ])->first();

        return is_null($hasRegistered);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The account is already registered';
    }
}
