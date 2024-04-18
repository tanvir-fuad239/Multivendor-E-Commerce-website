<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerUpdateRequest extends FormRequest
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
        $bannerId = $this->route('banner');

        return [
            'banner_name'               => [
                'max:255',
                Rule::unique('banners', 'title')->ignore($bannerId),
            ],
            'banner_image'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048
            |dimensions:min_width=100,min_height=60,max_width=2500,max_height=1080'
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
            'banner_name.unique'        => 'The banner title has already been taken.Please choose a different  title.',
            'banner_name.max'           => 'The banner title must not be greater than 255 characters.', 
            'banner_image.image'        => 'The input file must be an image.',
            'banner_image.mimes'        => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'banner_image.max'          => 'The image may not be larger than 2048 kilobytes.',
            'slider_image.dimensions'   => 'The image has invalid dimensions. Minimum dimensions are 100x60 and the maximum are 2500x1080.' 
         ];
     }
}
