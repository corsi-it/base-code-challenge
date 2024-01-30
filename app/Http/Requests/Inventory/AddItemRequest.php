<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property file $image
 * @property double $price
 * @property string $description
 * @property int $category
 */
class AddItemRequest extends FormRequest
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
            'name' => ['required','string'],
            'image' => ['required','file'],
            'price' => ['required','numeric'],
            'description' => ['required','string'],
            'category' => ['required','integer','exists:categories,id'],
        ];
    }
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'price' => $this->getPrice(),
            'description' => $this->getDescription(),
            'category_id' => $this->getCategoryId(),
        ];
    }

    public function getName():string
    {
        return $this->name;
    }
    public function getImage():string
    {
        return $this->image;
    }
    public function getPrice():string
    {
        return $this->price;
    }
    public function getDescription():string
    {
        return $this->description;
    }
    public function getCategoryId():string
    {
        return $this->category;
    }
}
