<?php

declare(strict_types=1);

namespace JumpTwentyFour\PhpCodingStandards\Support;

use ReflectionObject;
use Symplify\EasyCodingStandard\Config\ECSConfig;

class ConfigHelper
{
    public function __construct(private ECSConfig $config)
    {
    }

    public static function make(ECSConfig $config): self
    {
        return new self($config);
    }

    public function getParameter(string $name)
    {
        $reflectedConfig = new ReflectionObject($this->config);

        $containerProperty = $reflectedConfig->getParentClass()->getProperty('container');

        $containerProperty->setAccessible(true);

        return $containerProperty->getValue($this->config)->getParameter($name);
    }
}
