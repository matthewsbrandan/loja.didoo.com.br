<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O following language lines contain O default error messages used by
    | O validator class. Some of Ose rules have multiple versions such
    | as O size rules. Feel free to tweak each of Ose messages here.
    |
    */

    'aceite' => 'O :attribute dever ser aceite.',
    'active_url' => 'O :attribute não é um URL válido.',
    'after' => 'O :attribute dever ser uma data depois de :date.',
    'after_or_equal' => 'O :attribute dever ser uma data depois ou igual a  :date.',
    'alpha' => 'O :attribute deve conter apenas letras.',
    'alpha_dash' => 'O :attribute deve conter apenas letras, números e traços',
    'alpha_num' => 'O :attribute deve conter apenas letras e números.',
    'array' => 'O :attribute dever ser um array.',
    'before' => 'O :attribute dever ser uma data antes de :date.',
    'before_or_equal' => 'O :attribute dever ser uma data antes ou igual a :date.',
    'entre' => [
        'numeric' => 'O :attribute dever ser entre :min e :max.',
        'file' => 'O :attribute dever ser entre :min e :max kilobytes.',
        'string' => 'O :attribute dever ser entre :min e :max caracteres.',
        'array' => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O :attribute campo dever ser verdadeiro ou falso.',
    'confirmed' => 'O :attribute a confirmação não corresponde.',
    'date' => 'O :attribute não é uma data válida.',
    'date_equals' => 'O :attribute dever ser uma data igual a :date.',
    'date_format' => 'O :attribute não corresponde ao formato :format.',
    'different' => 'O :attribute e :other dever ser diferente.',
    'dígitos' => 'O :attribute dever ter :dígitos digítos.',
    'dígitos_entre' => 'O :attribute dever ter entre :min e :max dígitos.',
    'dimensions' => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct' => 'O :attribute campo tem um valor duplicado.',
    'email' => 'O :attribute dever ser um e-mail válido.',
    'ends_with' => 'O :attribute deve terminar com um dos seguintes: :values.',
    'exists' => 'O selecionado :attribute é inválido.',
    'file' => 'O :attribute dever ser um arquivo.',
    'filled' => 'O :attribute campo deve ter um valor.',
    'gt' => [
        'numeric' => 'O :attribute dever ser maior que :value.',
        'file' => 'O :attribute dever ser maior que :value kilobytes.',
        'string' => 'O :attribute dever ser maior que :value caracteres.',
        'array' => 'O :attribute deve ter mais que :value itens.',
    ],
    'gte' => [
        'numeric' => 'O :attribute dever ser maior ou igual a :value.',
        'file' => 'O :attribute dever ser maior ou igual a :value kilobytes.',
        'string' => 'O :attribute dever ser maior ou igual a :value caracteres.',
        'array' => 'O :attribute deve ter :value itens or more.',
    ],
    'image' => 'O :attribute dever ser uma imagem.',
    'in' => 'O selecionado :attribute não é válido.',
    'in_array' => 'O :attribute campo não existe em :other.',
    'integer' => 'O :attribute dever ser um inteiro.',
    'ip' => 'O :attribute dever ser um endereço IP válido.',
    'ipv4' => 'O :attribute dever ser um endereço IPV4 válido.',
    'ipv6' => 'O :attribute dever ser um endereço IPV6 válido',
    'json' => 'O :attribute dever ser um STRING json válido.',
    'lt' => [
        'numeric' => 'O :attribute dever ser menor que :value.',
        'file' => 'O :attribute dever ser menor que :value kilobytes.',
        'string' => 'O :attribute dever ser menor que :value caracteres.',
        'array' => 'O :attribute deve ter menor que :value itens.',
    ],
    'lte' => [
        'numeric' => 'O :attribute dever ser menor ou igual a :value.',
        'file' => 'O :attribute dever ser menor ou igual a :value kilobytes.',
        'string' => 'O :attribute dever ser menor ou igual a :value caracteres.',
        'array' => 'O :attribute não deve ter mais que :value itens.',
    ],
    'max' => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file' => 'O :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O :attribute não pode ser maior que :max caracteres.',
        'array' => 'O :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O :attribute dever ser um arquivo : :values.',
    'mimetypes' => 'O :attribute dever ser um arquivo : :values.',
    'min' => [
        'numeric' => 'O :attribute dever ser pelo menos :min.',
        'file' => 'O :attribute dever ser pelo menos :min kilobytes.',
        'string' => 'O :attribute dever ser pelo menos :min caracteres.',
        'array' => 'O :attribute deve ter pelo menos :min itens.',
    ],
    'multiple_of' => 'O :attribute dever ser um múltiplo de :value',
    'not_in' => 'O selecionado :attribute não é válido.',
    'not_regex' => 'O :attribute não é um formato válido.',
    'numeric' => 'O :attribute dever ser um número.',
    'password' => 'A senha está errada!',
    'present' => 'O :attribute campo dever ser presente.',
    'regex' => 'O :attribute não é um formato válido.',
    'required' => 'O :attribute campo é obrigatório.',
    'required_if' => 'O :attribute campo é obrigatório quando :other é :value.',
    'required_unless' => 'O :attribute campo é obrigatório quando :other está em :values.',
    'required_with' => 'O :attribute campo é obrigatório quando :values está presente.',
    'required_with_all' => 'O :attribute campo é obrigatório quando :values está presente.',
    'required_without' => 'O :attribute campo é obrigatório quando :values não está presente.',
    'required_without_all' => 'O :attribute campo é obrigatório quando nenhum :values está presente.',
    'same' => 'O :attribute e :other deve combinar.',
    'size' => [
        'numeric' => 'O :attribute dever ser :size.',
        'file' => 'O :attribute dever ser :size kilobytes.',
        'string' => 'O :attribute dever ser :size caracteres.',
        'array' => 'O :attribute deve conter :size itens.',
    ],
    'starts_with' => 'O :attribute deve começar com um dos seguintes: :values.',
    'string' => 'O :attribute dever ser uma string.',
    'timezone' => 'O :attribute dever ser uma zona válida.',
    'unique' => 'O :attribute já foi tomada.',
    'uploaded' => 'O :attribute falha ao carregar.',
    'url' => 'O :attribute não é um formato válido.',
    'uuid' => 'O :attribute dever ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using O
    | convention "attribute.rule" to name O lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'order_price' => [
            'min' => 'O mínimo do pedido é :min. Por favor, adicione mais alguns itens no carrinho ',
        ],
        'address_id' => [
            'required' => 'Por favor selecione o seu endereço',
        ],
        'stripe_payment_error_action'=>[
            'required'=>'A tentativa de pagamento falhou porque uma ação adicional é necessária antes que possa ser concluída'
        ],
        'stripe_payment_failure'=>[
            'required'=>'A tentativa de pagamento falhou por vários outros motivos, como falta de fundos disponíveis. Por favor, verifique os dados fornecidos.'
        ],
        'paypal_payment_error_action'=>[
            'required'=>'A tentativa de pagamento falhou porque uma ação adicional é necessária antes que possa ser concluída'
        ],
        'paypal_payment_approval_missing'=>[
            'required'=>'Não foi possível obter o link de pagamento paypal.'
        ],
        'mollie_error_action'=>[
            'required'=>'Erro ao obter o link de pagamento.'
        ],
        'paystack_error_action'=>[
            'required'=>"Erro na comunicação com PayStack"
        ],
        'dinein_table_id'=>[
            'required'=>'Selecione sua mesa',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | O following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
