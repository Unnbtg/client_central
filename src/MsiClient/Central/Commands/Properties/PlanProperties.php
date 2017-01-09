<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/03/16
 * Time: 11:48
 */

namespace MsiClient\Central\Commands\Properties;

/**
 * Class PlanProperties
 * @package MsiClient\Central\Commands\Properties
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $sl_plan_id;
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property \DateTime $deleted_at
 * @property ProductProperties[] $products
 *
 */
class PlanProperties extends PropertiesAbstract
{
    private $defaultValues = [];

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        if (!isset($elements->products)) {
            return $this;
        }


        unset($this->products);
        $this->products = [];

        if (isset($elements->products_plans)) {
            foreach ($elements->products_plans as $products_plan) {
                $this->defaultValues[$products_plan->product_id] = $products_plan->default_values;
            }
        }


        foreach ($elements->products as $product) {
            $pProduct = new ProductProperties();
            $this->products[] = $pProduct->fromStdClass($product);
        }

        foreach ($this->products as $product) {
            if (!isset($this->defaultValues[$product->id])) {
                continue;
            }

            foreach ($product->configurations as $config) {
                $config->value = $this->getDefaultValues($product->id, $config->id);
            }
        }
        return $this;
    }

    private function getDefaultValues($productId, $configurationId)
    {
        $array = $this->defaultValues[$productId];

        $config = array_filter($array, function ($item) use ($configurationId) {
            if ($item->products_configurations_id == $configurationId) {
                return $item->value;
            }
        });

        if (!empty($config)) {
            return current($config)->value;
        }

        return null;

    }

}