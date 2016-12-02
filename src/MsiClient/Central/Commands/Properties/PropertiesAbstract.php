<?php
    /**
     * Created by PhpStorm.
     * User: Marco
     * Date: 26/02/2016
     * Time: 10:20
     */

    namespace MsiClient\Central\Commands\Properties;

    abstract class PropertiesAbstract implements Sendable
    {
        public function toArray()
        {
            $retorno = [];
            foreach ($this as $key => $property) {
                $retorno[$key] = $property;
            }

            return $retorno;
        }

        public function fromStdClass($std)
        {
            return $this->fromJsonElement($std);
        }

        protected function fromJsonElement($elements)
        {

            if (is_null($elements)) {
                return $elements;
            }

            foreach ($elements as $name => $value) {
                if (in_array($name, ['created_at', 'updated_at', 'deleted_at']) && is_string($value)) {
                    $this->$name = new \DateTime($value);
                    continue;
                }
                $this->$name = $value;
            }

            return $this;
        }

        public function __get($name)
        {
            if ( ! isset($this->$name)) {
                return null;
            }

            return $this->$name;
        }

        public function getContainer()
        {
            return "";
        }


        public function massAssignment($array)
        {
            foreach ($array as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }