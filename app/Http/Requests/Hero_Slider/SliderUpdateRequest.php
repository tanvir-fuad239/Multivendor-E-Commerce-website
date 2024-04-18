<?php

namespace App\Http\Requests\Hero_Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $sliderId = $this->route('hero_slider');

        return [
            'slider_name'               => [
                'max:255',
                Rule::unique('hero_sliders', 'title')->ignore($sliderId),
            ],
            'slider_image'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048
            |dimensions:min_width=100,min_height=60,max_width=2500,max_height=1080',
            'slider_description'        => 'max:1000'
        ];
    }

      /**
     * Get the validation error messages for the rules defined in the rules method.
     *
     * @return array
     */

     public function messages(): array
     {
         return [
            'slider_name.unique'        => 'The slider name has already been taken and must be unique. Please choose a different name.',
            'slider_name.max'           => 'The slider name must not be greater than 255 characters.', 
            'slider_image.image'        => 'The file must be an image.',
            'slider_image.mimes'        => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'slider_image.max'          => 'The image may not be larger than 2048 kilobytes.',
            'slider_image.dimensions'   => 'The image has invalid dimensions. Minimum dimensions are 100x60 and the maximum are 2500x1080.',
            'slider_description.max'    => 'The slider description must not be greater than 1000 characters.'
             
            
         ];
     }
}
