<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Вы должны принять :attribute.',
    'accepted_if' => ':attribute должен быть принят, когда :other равно :value.',
    'active_url' => 'Поле :attribute недействительный URL.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после :date или равным ей.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры и дефис.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'before' => 'Поле :attribute должно быть датой перед :date.',
    'before_or_equal' => ':attribute должен быть датой, предшествующей :date или равной ей.',
    'between' => [
        'array' => 'Поле :attribute должно содержать :min - :max элементов',
        'file' => 'Размер :attribute должен быть от :min до :max Килобайт.',
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'string' => 'Длина :attribute должна быть от :min до :max символов.',
    ],
    'boolean' => 'Поле :attribute должно быть истинным или ложным.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'current_password' => 'Пароль неправильный.',
    'date' => 'Поле :attribute не является датой.',
    'date_equals' => ':attribute должен быть датой, равной :date.',
    'date_format' => 'Поле :attribute не соответствует формату :format.',
    'declined' => 'Атрибут : должен быть отклонен.',
    'declined_if' => ':attribute должен быть отклонен, если :other равно :value.',
    'different' => 'Поля :attribute и :other должны различаться.',
    'digits' => 'Длина цифрового поля :attribute должна быть :digits.',
    'digits_between' => 'Длина цифрового поля :attribute должна быть между :min и :max.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute имеет повторяющееся значение.',
    'doesnt_end_with' => ':attribute не может заканчиваться одним из следующих: :values.',
    'doesnt_start_with' => ':attribute не может начинаться с одного из следующих: :values.',
    'email' => 'Поле :attribute имеет ошибочный формат.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих: :values.',
    'enum' => 'Выбранный :attribute недействителен.',
    'exists' => 'Выбранное значение для :attribute не существует.',
    'file' => ':attribute должен быть файлом.',
    'filled' => 'Поле :attribute должно иметь значение.',
    'gt' => [
        'array' => ':attribute должен иметь более :value элементов.',
        'file' => ':attribute должен быть больше :value килобайт.',
        'numeric' => ':attribute должен быть больше :value.',
        'string' => ':attribute должен быть больше символов :value.',
    ],
    'gte' => [
        'array' => ':attribute должен иметь элементы :value или более.',
        'file' => ':attribute должен быть больше или равен :value килобайтам.',
        'numeric' => ':attribute должен быть больше или равен :value.',
        'string' => ':attribute должен быть больше или равен :value символов.',
    ],
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение для :attribute ошибочно.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4' => ':attribute должен быть действительным адресом IPv4.',
    'ipv6' => ':attribute должен быть действительным адресом IPv6.',
    'json' => ':attribute должен быть допустимой строкой JSON.',
    'lt' => [
        'array' => 'Элемент :attribute должен содержать меньше элементов :value.',
        'file' => 'Размер :attribute должен быть меньше :value килобайт.',
        'numeric' => ':attribute должен быть меньше :value.',
        'string' => ':attribute должен быть меньше символов :value.',
    ],
    'lte' => [
        'array' => ':attribute не должен содержать более :value элементов.',
        'file' => ':attribute должен быть меньше или равен :value килобайтам.',
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'string' => ':attribute должен быть меньше или равен :value символов.',
    ],
    'mac_address' => ':attribute должен быть действительным MAC-адресом.',
    'max' => [
        'array' => 'Поле :attribute должно содержать не более :max элементов.',
        'file' => 'Поле :attribute должно быть не больше :max Килобайт.',
        'numeric' => 'Поле :attribute должно быть не больше :max.',
        'string' => 'Поле :attribute должно быть не длиннее :max символов.',
    ],
    'max_digits' => ':attribute не должен содержать более :max цифр.',
    'mimes' => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'extensions' => 'Поле :attribute должно иметь одно из расширений: :values.',
    'min' => [
        'array' => 'Поле :attribute должно содержать не менее :min элементов.',
        'file' => 'Поле :attribute должно быть не менее :min Килобайт.',
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'string' => 'Поле :attribute должно быть не короче :min символов.',
    ],
    'min_digits' => ':attribute должен содержать не менее :min цифр.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'Выбранное значение для :attribute ошибочно.',
    'not_regex' => 'Поле :attribute имеет ошибочный формат.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => [
        'letters' => ':attribute должен содержать хотябы одну букву.',
        'mixed' => ':attribute должен содержать как минимум одну прописную и одну строчную букву.',
        'numbers' => ':attribute должен содержать хотя бы одно число.',
        'symbols' => ':attribute должен содержать хотя бы один символ.',
        'uncompromised' => 'Данный :attribute появился в утечке данных. Пожалуйста, выберите другой :attribute.',
    ],
    'present' => 'Поле :attribute должно присутствовать.',
    'prohibited' => 'Поле :attribute запрещено.',
    'prohibited_if' => 'Поле :attribute запрещено, когда :other равно :value.',
    'prohibited_unless' => 'Поле :attribute запрещено, если только :other не находится в :values.',
    'prohibits' => 'Поле :attribute запрещает присутствие :other.',
    'regex' => 'Поле :attribute имеет ошибочный формат.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys' => 'Поле :attribute должно содержать записи для: :values.',
    'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_if_accepted' => 'Поле :attribute обязательно, когда принимается :other.',
    'required_unless' => 'Поле :attribute является обязательным, если только :other не находится в :values.',
    'required_with' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле :attribute обязательно, когда присутствуют :values.',
    'required_without' => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute является обязательным, если ни одно из значений :value не присутствует.',
    'same' => 'Значение :attribute должно совпадать с :other.',
    'size' => [
        'array' => 'Количество элементов в поле :attribute должно быть :size.',
        'file' => 'Поле :attribute должно быть :size Килобайт.',
        'numeric' => 'Поле :attribute должно быть :size.',
        'string' => 'Поле :attribute должно быть длиной :size символов.',
    ],
    'starts_with' => 'Поле :attribute должно начинаться одним из: :values.',
    'string' => 'Поле :attribute должен быть строкой.',
    'timezone' => 'Поле :attribute должен соответстовать часавому поясу.',
    'unique' => 'Такое значение поля :attribute уже существует.',
    'uploaded' => 'Поле :attribute не удалось загрузить.',
    'url' => 'Поле :attribute имеет ошибочный формат.',
    'uuid' => 'Поле :attribute должен соответствовать UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title.*' => 'заголовок',
        'slug' => 'машинное имя',
        'sale' => 'скидка',
        'short_description.*' => 'краткое описание',
        'description.*' => 'описание',
        'image' => 'изображение',
        'name.*' => 'наименование',
        'name' => 'имя',
        'specifications' => 'характеристки',
        'properties' => 'свойства',
        'question' => 'вопрос',
        'answer' => 'ответ',
        'count' => 'количество',
        'currency_name.*' => 'название валюты',
        'currency_symbol' => 'символ валюты',
        'price' => 'цена',
        'product_id' => 'товар',
        'artikul' => 'артикул',
        'address_id' => 'адрес доставки',
        'delivery_type' => 'тип доставки',
        'phone' => 'телефон',
        'password' => 'пароль'
    ],
];
