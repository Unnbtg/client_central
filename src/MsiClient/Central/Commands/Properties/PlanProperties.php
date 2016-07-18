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
 */
class PlanProperties extends PropertiesAbstract
{
    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        if (!isset($elements->products)) {
            return $this;
        }


        unset($this->products);
        $this->products = [];
        foreach ($elements->products as $product) {
            $pProduct = new ProductProperties();
            $this->products[] = $pProduct->fromStdClass($product);
        }

        return $this;
    }

}