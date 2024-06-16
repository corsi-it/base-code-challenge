<?php

namespace App\Http\Requests;

use App\Helpers\ItemsHelper;
use App\Helpers\StockRequestsHelper;
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
            'item_id'     => 'required|exists:items,id',
            'quantity'    => ['required', 'not_in:0', $this->quantityValidation()],
            'requestType' => 'required',
            'start_date'  => [
                'required_if:requestType,sell',
                $this->startDateValidation(),
            ],
            'end_date'    => [
                'required_if:requestType,sell',
                $this->endDateValidation(),
            ],
        ];
    }

    protected function startDateValidation()
    {
        return function ($attribute, $value, $fail) {
            if ($this->requestType == 'sell' && empty($value)) {
                $fail('The start date is required for sell requests.');
            }
        };
    }

    protected function endDateValidation()
    {
        return function ($attribute, $value, $fail) {
            if ($this->requestType == 'sell' && empty($value)) {
                $fail('The end date is required for sell requests.');
            } elseif ($this->requestType == 'sell' && !empty($this->start_date) && $value < $this->start_date) {
                $fail('The end date must be after or equal to the start date.');
            }
        };
    }

    protected function quantityValidation()
    {
        return function ($attribute, $value, $fail) {
            if ($this->requestType == 'sell' && (!$this->has('start_date') || !$this->has('end_date'))) {
                $fail('The start date and end date are required for sell requests.');
            }

            if ($this->requestType == 'sell') {
                // Assuming $this->item is automatically resolved using route model binding

                // try converting string to \DateTime
                $startDate = new \DateTime($this->start_date);
                $endDate = new \DateTime($this->end_date);

                $itemId = $this->item_id;
                $item = \App\Models\Item::find($itemId);
                if (!$item) {
                    $fail('Item not found.');
                }
                $allDates = app(StockRequestsHelper::class)->getDates($startDate, $endDate);
                foreach ($allDates as $date) {
                    if (!app(ItemsHelper::class)->canBeRequestedOnDate($item, $value, $date)) {
                        $fail('Not enough orderable stock for the requested quantity on ' . $date->format('Y-m-d'));
                    }
                }
            }
        };
    }
}
