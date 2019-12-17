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

        $string = "{";

        foreach ($array as $key => $item) {
            $string .= "\n";
            if (!empty($item)) {

                if (is_array($item)) {
                    $string .= "\t\"{$key}\": {\n";
                    $string .= $this->arrayChange($item);
                    $string .= "\n\t},";
                } else if (is_string($item)) {
                    $string .= "\t\"{$key}\": \"{$item}\",";
                }
            }
        }

        return trim($string, ",") . "\n}";
    }

    protected function arrayChange($array, $deep = 1)
    {
        $string = "";
        foreach ($array as $key => $value) {
            if (!empty($string)) {
                $string .= "\n";
            }
            if (is_array($value)) {
                $string .= "\t\t\"{$key}\": {\n";
                $string .= $this->arrayChange($value, $deep + 1);
                $string .= "\n\t\t},";
                continue;
            }
            $string .= "\t\t\"{$key}\": \"{$value}\",";
        }

        return trim($string, ",\n");
    }

}