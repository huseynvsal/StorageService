<?php

namespace App\Traits;

use App\Exceptions\UnreportableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

trait HasRouteBinding
{
    /**
     * @throws UnreportableException
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $primaryKey = $this->primaryKey;

        $validationRules = ['required', $primaryKey === 'uuid' ? 'uuid' : ''];

        $this->validate($primaryKey, $value, $validationRules);

        try {
            return self::findOrFail($value);
        } catch (ModelNotFoundException $exception) {
            $this->handleModelNotFoundException($exception);
        }
    }

    /**
     * @throws UnreportableException
     */
    private function validate($attribute, $value, $rules): void
    {
        $validator = Validator::make([$attribute => $value], [$attribute => $rules]);

        if ($validator->fails()) {
            throw new UnreportableException($validator->getMessageBag()->first(), 422);
        }
    }

    /**
     * @throws UnreportableException
     */
    private function handleModelNotFoundException(ModelNotFoundException $exception)
    {
        $model = explode('\\', $exception->getModel());
        throw new UnreportableException(array_pop($model).' with id: '.$exception->getIds()[0].' does not exist', 404);
    }
}
