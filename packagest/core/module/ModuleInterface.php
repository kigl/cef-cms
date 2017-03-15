<?php

namespace kigl\cef\core\module;

interface ModuleInterface
{
    public function getName();

    public function getDescription();

    public function getPublicPath();

    public function getPublicPathUrl();
}