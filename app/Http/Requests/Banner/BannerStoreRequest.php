<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class BannerStoreRequest extends FormRequest
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
        return [
            'banner_name'           =>  'required|max:255|unique:banners,title',
            'banner_image'          =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048
                                            |dimensions:min_width=100,min_height=60,max_width=2500,max_height=1080',
            'banner_url'            => 'required' 
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
             'banner_name.required'      => 'A title is required',
             'banner_name.max'           => 'The banner title must not be greater than 255 characters.', 
             'banner_name.unique'        => 'This title already taken',
             'banner_image.required'     => 'An image for the banner is required.',
             'banner_image.image'        => 'The file must be an image.',
             'banner_image.mimes'        => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
             'banner_image.max'          => 'The image may not be larger than 2048 kilobytes.',
             'banner_image.dimensions'   => 'The image has invalid dimensions. Minimum dimensions are 100x60 and the maximum are 2500x1080.',
             'banner_url.required'    => 'An url for the banner is required.'
         ];
     }
}
