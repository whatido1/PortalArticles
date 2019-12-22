<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->title = Str::title($this->title);
        $this->slug = Str::slug($this->slug);
        $method = $this->method();
        
        return [
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('\App\Models\Article', 'slug')->ignore($this->slug, 'slug')
            ],
            'banner' => [
                Rule::requiredIf(function() use ($method) {
                    $noRequiredMethod = \collect(["PATCH", "PUT"]);
                    return !$noRequiredMethod->contains($method);
                }),
                "image",
                "mimes:jpeg,png,jpg"
            ],
            'required_if:banner,image|image|mimes:jpeg,png,jpg',
            'category' => 'required|numeric',
            'content' => 'required',
        ];
    }
}
