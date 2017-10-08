<?php

namespace Payu\Entity;

abstract class Entity
{
    public function loadFromArray(array $data)
    {
        foreach ($data as $parameter => $value) {
            $parameter = $this->camelCase($value, 'set');

            $callable = [$this, $parameter];

            if (is_callable($callable)) {
                call_user_func($callable, $value);
            }
        }
    }

    public function getParameters()
    {
        // $methods = preg_grep('/^get/', get_class_methods($this));
        $parameters = get_object_vars($this);
        $output = [];

        foreach ($parameters as $parameter => $value) {
            $method = $this->camelCase($parameter, 'get');
            $value = call_user_func([$this, $method]);

            if ($value === null) {
                continue;
            }

            $var = $this->camelCase($parameter);

            $output[$var] = $value;
        }

        return $output;
    }

    public function getParametersJson()
    {
        return json_encode($this->getParameters());
    }

    private function camelCase($string, $prefix = null)
    {
        $output = preg_replace_callback(
            '/_[a-z]/i',
            function($match) {
                $piece = str_replace('_', '', $match[0]);
                $piece = strtoupper($piece);

                return $piece;
            },
            $string
        );

        if ($prefix) {
            $output = $prefix . ucwords($output);
        }

        return $output;
    }
}
