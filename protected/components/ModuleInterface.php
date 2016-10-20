<?php

namespace app\components;

interface ModuleInterface
{
    public function getName();

    public function getDescription();

    public function getPublicPath();

    public function getPublicPathUrl();
}