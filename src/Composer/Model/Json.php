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

    public function toString()
    {
        $array = $this->jsonSerialize();

        $string = "{\n";

        foreach ($array as $key => $item) {
            if (!empty($item)) {

                if (is_array($item)) {
                    $string .= "\t{$key}: {\n";
                    foreach ($item as $key2 => $value) {
                        $string .= "\t\t{$key2}: \"{$value}\"\n";
                    }
                    $string .= "\t}\n";
                } else if (is_string($item)) {
                    $string .= "\t{$key}: \"{$item}\"\n";
                }
            }
        }

        return $string;
    }

}