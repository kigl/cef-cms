<?php

Class Form extends CFormModel
{
    public $email;

    public $phone;

    public function rules()
    {
        return array(
            array(array('phone', 'email'), 'required'),
            array('phone', 'length', 'max' => 50),
            array('email', 'email', 'message' => 'Email не является действительным адресом'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'phone' => 'Телефон',
        );
    }
}