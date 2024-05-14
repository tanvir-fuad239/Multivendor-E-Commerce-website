<?php

namespace App\Http\Requests\Cupon;

use Illuminate\Foundation\Http\FormRequest;

class CuponStoreRequest extends FormRequest
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
            'cupon_code'                        =>          'required|string|max:255|unique:cupons,code',
            'cupon_amount'                      =>          'required|numeric|min:0',
            'cupon_type'                        =>          'required|in:fixed,percent',
            'min_amount'                        =>          'required|numeric|min:0',
            'usage_limit'                       =>          'nullable|integer|min:1',
            'used_limit'                        =>          'nullable|integer|min:1',
            'valid_from'                        =>          'required|date|before_or_equal:expire_at',
            'expire_at'                         =>          'required|date|after_or_equal:valid_from',   
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
            'cupon_code.required'               =>          'The coupon code is required.',
            'cupon_code.unique'                 =>          'This coupon code is already in use.',
            'cupon_amount.required'             =>          'The coupon amount is required.',
            'cupon_amount.numeric'              =>          'The coupon amount must be a number.',
            'cupon_type.required'               =>          'You must select a type for the coupon.',
            'cupon_type.in'                     =>          'The coupon type must be either "fixed" or "percent".',
            'min_amount.required'               =>          'A minimum amount is required.',
            'min_amount.numeric'                =>          'The minimum amount must be a number.',
            'usage_limit.integer'               =>          'The coupon usage limit must be an integer.',
            'usage_limit.min'                   =>          'The coupon usage limit must be at least 1.',
            'used_limit.integer'                =>          'The user usage limit must be an integer.',
            'used_limit.min'                    =>          'The user usage limit must be at least 1.',
            'valid_from.required'               =>          'The start date of the coupon validity is required.',
            'valid_from.date'                   =>          'The start date must be a valid date.',
            'valid_from.before_or_equal'        =>          'The start date must be before or on the expiry date.',
            'expire_at.required'                =>          'The expiry date of the coupon is required.',
            'expire_at.date'                    =>          'The expiry date must be a valid date.',
            'expire_at.after_or_equal'          =>          'The expiry date must be on or after the start date.'
        ];

    }
}
