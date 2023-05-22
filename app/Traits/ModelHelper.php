<?php

namespace App\Traits;

use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;

trait ModelHelper
{
    protected static function findByIdOrFail($modelClass, $object, $modelId, $type = 'male')
    {
        $model = $modelClass::find($modelId);

        if (!$model) {
            $objectType = '';
            if ($type == 'female') {
                $objectType = 'messages.objectNotFoundF';
            } else {
                $objectType = 'messages.objectNotFound';
            }
            throw new NotFound(404);
        }
        return $model;
    }
}