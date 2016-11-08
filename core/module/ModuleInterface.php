<?php

namespace app\core\module;

interface ModuleInterface
{
    public function getName();

    public function getDescription();

    public function getPublicPath();

    public function getPublicPathUrl();
}