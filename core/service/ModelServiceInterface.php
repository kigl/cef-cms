<?php

namespace app\core\service;

interface ModelServiceInterface
{
    public function load(array $post);

    public function validate();

    public function save();

    public function delete();

    public function getModel();

    public function getData();
}