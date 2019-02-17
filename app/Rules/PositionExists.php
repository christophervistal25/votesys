<?php
namespace App\Rules;

use App\Repositories\PositionRepository;
use Illuminate\Contracts\Validation\Rule;

class PositionExists implements Rule
{


    public function __construct(PositionRepository $position)
    {
        $this->positionRepository = $position;
    }

    public function trimValue(string $value)
    {
        return str_replace(' ','',$value);
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
        return !$this->positionRepository->alreadyExists($this->trimValue($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Position is already exists.';
    }
}
