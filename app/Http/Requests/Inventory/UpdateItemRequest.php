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
 * @property int $id
 */
class UpdateItemRequest extends FormRequest
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
            'id' => ['required','string'],
            'name' => ['required','string'],
            'image' => ['required'],
            'price' => ['required','numeric'],
            'description' => ['required','string'],
            'category' => ['required','integer','exists:categories,id'],
        ];
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'price' => $this->getPrice(),
            'description' => $this->getDescription(),
            'category_id' => $this->getCategoryId(),
        ];
    }
    public function getId():int
    {
        return $this->id;
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
