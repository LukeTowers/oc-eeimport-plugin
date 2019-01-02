<?php namespace LukeTowers\EEImport\Traits;

use Carbon\Carbon;

trait DecodesEEDates
{
    /**
     * @var array List of attribute names that are used by EE to store date information
     *
     * protected $eeDates = [];
     */

    /**
     * Boot this trait for a model.
     * @return void
     */
    public static function bootDecodesEEDates()
    {
        if (!property_exists(get_called_class(), 'eeDates')) {
            throw new Exception(sprintf(
                'You must define a $eeDates property in %s to use the DecodesEEDates trait.', get_called_class()
            ));
        }

        /*
         * Decode ExpressionEngine dates
         */
        static::extend(function($model) {
            $dates = $model->getEEDates();
            $model->bindEvent('model.beforeGetAttribute', function($key) use ($model, $dates) {
                if (in_array($key, $dates)) {
                    return $model->getEEDateValue($key);
                }
            });
        });
    }

    /**
     * Decodes ExpressionEngine's absurd way of storing dates in the DB
     * i.e timestamps that are stored as integers and can be 0 or their custom YmdHis format
     *
     * @param string $key
     * @return mixed|null
     */
    public function getEEDateValue($key)
    {
        $value = (int) $this->attributes[$key];
        $return = null;
        if (!empty($value)) {
            $length = strlen((string) $value);

            // Either the EE absurd format of YmdHis or sometime after November 2286. Let's go with the former.
            if ($length === 14) {
                $return = Carbon::createFromFormat('YmdHis', $value);
            } else {
                $return = (new Carbon)->setTimestamp($value);
            }
        }

        return $return;
    }

    /**
     * Returns a collection of fields that store EE dates.
     * @return array
     */
    public function getEEDates()
    {
        return $this->eeDates;
    }
}