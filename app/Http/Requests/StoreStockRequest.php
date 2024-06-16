<?php

namespace App\Http\Requests;

use App\Helpers\ItemsHelper;
use App\Helpers\StockRequestsHelper;
use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'item_id' => 'required|exists:items,id',
            'quantity' => ['required', 'not_in:0', $this->quantityValidation()],
            'requestType' => 'required',
            'start_date' => 'required_if:requestType,sell|date',
            'end_date' => 'required_if:requestType,sell|date|after_or_equal:start_date',
        ];
    }

    protected function quantityValidation()
    {
        return function ($attribute, $value, $fail) {
            if ($this->requestType == 'sell' && (!$this->has('start_date') || !$this->has('end_date'))) {
                $fail('The start date and end date are required for sell requests.');
            }

            if ($this->requestType == 'sell') {
                // Assuming $this->item is automatically resolved using route model binding
                $allDates = app(StockRequestsHelper::class)->getDates($this->start_date, $this->end_date);
                foreach ($allDates as $date) {
                    if (!app(ItemsHelper::class)->canBeRequestedOnDate($this->item, $value, $date)) {
                        $fail('Not enough orderable stock for the requested quantity on ' . $date->format('Y-m-d'));
                    }
                }
            }
        };
    }
}
