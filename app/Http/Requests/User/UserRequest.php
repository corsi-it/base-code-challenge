<?php

namespace App\Http\Requests\User;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $user_id
 * @property int $inventory_id
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['required','date'],
            'end_date' => ['required','date','after:start_date'],
            'inventory_id' => ['required','numeric','exists:inventories,id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'inventory_id' => $this->getInventoryId(),
        ];
    }
    public function getStartDate() : Carbon
    {
        return Carbon::parse($this->start_date);
    }
    public function getEndDate() : Carbon
    {
        return Carbon::parse($this->end_date);
    }
    public function getInventoryId() : int
    {
        return $this->inventory_id;
    }

}
