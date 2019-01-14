<?php namespace LukeTowers\EEImport\Traits;

trait DecodesEEData
{
    /**
     * @var array List of attribute names which store data encoded by ExpressionEngine
     *
     * protected $eeEncodedAttributes = [];
     */

    /**
     * Boot this trait for a model.
     * @return void
     */
    public static function bootDecodesEEData()
    {
        if (!property_exists(get_called_class(), 'eeEncodedAttributes')) {
            throw new Exception(sprintf(
                'You must define a $eeEncodedAttributes property in %s to use the DecodesEEData trait.', get_called_class()
            ));
        }

        /*
         * Decode ExpressionEngine encoded data
         */
        static::extend(function($model) {
            $encoded = $model->getEEEncodedAttributes();
            $model->bindEvent('model.beforeGetAttribute', function($key) use ($model, $encoded) {
                if (in_array($key, $encoded)) {
                    return $model->getDecodedValue($key);
                }
            });
        });
    }

    /**
     * Decodes ExpressionEngine's absurd way of storing complex data in the DB,
     * i.e serializing the data and then base64 encoding it
     *
     * @param string $key
     * @return mixed|null
     */
    public function getDecodedValue($key)
    {
        $value = $this->attributes[$key];
        $return = null;
        if (!empty($value)) {
            try {
                $serialized = base64_decode($value, true);

                if (!empty($serialized)) {
                    $return = unserialize($serialized, true);
                }
            } catch (\Exception $ex) {}
        }

        return $return;
    }

    /**
     * Returns a collection of fields that are stored with ExpressionEngine's data encoding method
     * @return array
     */
    public function getEEEncodedAttributes()
    {
        return $this->eeEncodedAttributes;
    }

    /**
     * Adds an attribute to the eeEncodedAttributes attributes list
     * @param  array|string|null  $attributes
     * @return $this
     */
    public function addEEEncodedAttributes($attributes = null)
    {
        $attributes = is_array($attributes) ? $attributes : func_get_args();

        $this->eeEncodedAttributes = array_merge($this->eeEncodedAttributes, $attributes);

        return $this;
    }
}