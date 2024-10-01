<?php

namespace Modules\Sale\Http\Requests;

use App\Http\Requests\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'product_price'   => (isset($this->product_price) && is_string($this->product_price)) ? str_replace(',', '', $this->product_price) : $this->product_price,
            'sales_price'     => (isset($this->sales_price) && is_string($this->sales_price)) ? str_replace(',', '', $this->sales_price) : $this->sales_price,
            'number_of_sales' => is_string($this->number_of_sales) ? str_replace(',', '', $this->number_of_sales) : $this->number_of_sales,
            'take'            => is_string($this->take) ? str_replace(',', '', $this->take) : $this->take,
            // 'operating_income' => is_string($this->operating_income) ? str_replace(',', '', $this->operating_income) : $this->operating_income,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if (request()->ajax()) {
            return [];
        }

        return [
            'product_sale_day'    => 'sometimes|required',
            // 'product_name'          => 'sometimes|required',
            'product_id'          => ['required', 'exists:products,id'],
            'company_id'          => 'required',
            'product_code'        => 'sometimes|required',
            'fee_type'            => 'sometimes|required',
            'product_price'       => 'sometimes|required|between:0,9999999.99',
            'remark'              => 'nullable',
            'seller_id'           => ['required', 'exists:users,id'],
            // 'sales_type'            => 'required',
            'sales_price'         => 'nullable|between:0,9999999.99',
            // 'sales_place'           =>'sometimes|required',
            'number_of_sales'     => 'required',
            'take'                => 'required',
            'sales_information'   => 'required',
            // 'operating_income'      => 'required',
            //'sales_status'          => 'required',
            'product_sale_status' => 'required',
            'user_id'             => 'required',
        ];
    }
}
