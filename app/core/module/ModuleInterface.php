<?php

namespace app\core\module;

interface ModuleInterface
{
    public function getVersion();

    public function getName();

    public function getDescription();
}