<?php

namespace app\core\service;

interface ModelServiceInterface
{
    public function load();

    public function validate();

    public function save();

    public function delete();

    public function setData(array $data);

    public function setRequestData(array $data);

    public function getModel();

    public function getData();

    public function getRequestData($name, $data);
}