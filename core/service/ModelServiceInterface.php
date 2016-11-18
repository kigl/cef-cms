<?php

namespace app\core\service;

interface ModelServiceInterface
{
    public function load();

    public function validate();

    public function save();

    public function delete();

    public function setRequestData(array $request);

    public function setViewData(array $data);

    public function getModel();

    public function getViewData();
}