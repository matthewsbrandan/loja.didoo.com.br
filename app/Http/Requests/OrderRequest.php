<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        return [
            'nameID' => ['required'],
            'documentID' => ['required_if:deliveryType,online'],
            'emailID' => ['required_if:deliveryType,online'],
            'phoneID' => ['required_if:deliveryType,online'],
            'payChange' => ['required_if:paymentMethod,Cash'],

            'creditCard.*' => Rule::requiredIf(function () {
                return ($this->paymentMethod == 'Credit Card' || $this->paymentMethod == 'Debit Card') && $this->paymentOnlineDelivery == 'online' ? true : false;
            }),

            'zipcodeID' => ['required_if:deliveryType,delivery'],
            'cityID' => ['required_if:deliveryType,delivery'],
            'neighborhoodID' => ['required_if:deliveryType,delivery'],
            'addressID' => ['required_if:deliveryType,delivery'],
            'addressNumberID' => ['required_if:deliveryType,delivery'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nameID.required' => 'É necessário informar seu nome',
            'documentID.required' => 'É necessário informar um documento',
            'payChange.required_if' => 'É necessário informar o valor para troco',

            'creditCard.number.*' => 'É necessário informar o número do cartão',
            'creditCard.expirationDate.*' => 'É necessário informar a data de validade do cartão',
            'creditCard.name.*' => 'É necessário informar o nome do portador do cartão',
            'creditCard.cvc.*' => 'É necessário informar o CVC do cartão',

            'zipcodeID.required_if' => 'É necessário informar o CEP',
            'cityID.required_if' => 'É necessário informar a cidade',
            'neighborhoodID.required_if' => 'É necessário informar o bairro',
            'addressID.required_if' => 'É necessário informar o endereço',
            'addressNumberID.required_if' => 'É necessário informar o número',
        ];
    }
}
