<?php


namespace BlackFramework\Flex\Composer\Model;

use JsonSerializable;

class Json implements JsonSerializable
{
    public $type;
    public $license;
    public $require;
    public $requireDev;
    public $autoload;
    public $autoloadDev;

    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'license' => $this->license,
            'require' => $this->require,
            'require-dev' => $this->requireDev,
            'autoload' => $this->autoload,
            'autoload-dev' => $this->autoloadDev,
        ];
    }

}