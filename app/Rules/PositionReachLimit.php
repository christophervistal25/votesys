<?php
namespace App\Rules;

use App\Repositories\PositionRepository;
use Illuminate\Contracts\Validation\Rule;

class PositionReachLimit implements Rule
{


    public function __construct(PositionRepository $position)
    {
        $this->positionRepository = $position;
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
        return !$this->positionRepository->isPositionReachLimit($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Reach the maximum candidate for this position.';
    }
}
