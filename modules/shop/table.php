Формы

Сама форма
form
    id-integer
    name-string
    captcha-integer
    email_curator-string
    send_email_curator-integer
    create_time-date_time

Поля формы
form_field
    id-integer
    form_id-integer
    name-string
    description-string
    required-integer

Заполненная форма
form_completed
    id
    user_id
    create_time

Заполненные поля формы
form_field_value
    id-integer
    form_completed_id-integer
    field_id-integer
    value-string





