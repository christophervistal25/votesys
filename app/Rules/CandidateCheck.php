<?php
namespace App\Rules;

use App\Repositories\CandidateRepository;
use Illuminate\Contracts\Validation\Rule;

class CandidateCheck implements Rule
{


    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
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
        return $this->candidateRepository
                            ->candidate
                            ->find($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry but the candidate that you choose is not registered!';
    }
}
