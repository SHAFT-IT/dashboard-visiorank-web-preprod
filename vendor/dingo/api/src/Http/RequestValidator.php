<?php

namespace Dingo\Api\Http;

use Illuminate\Container\Container;
use Illuminate\Http\Request as IlluminateRequest;
use Dingo\Api\Contract\Http\Validation\Validator as ValidatorInterface;

class RequestValidator
{
    /**
     * Container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * Array of request validators.
     *
     * @var array
     */
    protected $validators = [
        'Dingo\Api\Http\Validation\Domain',
        'Dingo\Api\Http\Validation\Prefix',
    ];

    /**
     * Create a new request validator instance.
     *
     * @param \Illuminate\Container\Container $container
     *
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Replace the validators.
     *
     * @param array $validators
     *
     * @return void
     */
    public function replace(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Merge an array of validators.
     *
     * @param array $validators
     *
     * @return void
     */
    public function merge(array $validators)
    {
        $this->validators = array_merge($this->validators, $validators);
    }

    /**
     * Extend the validators.
     *
     * @param string|\Dingo\Api\Http\Validator
     *
     * @return void
     */
    public function extend($validator)
    {
        $this->validators[] = $validator;
    }

    /**
     * Validate a request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function validateRequest(IlluminateRequest $request)
    {
        $passed = false;

        foreach ($this->validators as $validator) {
            $validator = $this->container->make($validator);

            if ($validator instanceof ValidatorInterface && $validator->validate($request)) {
                $passed = true;
            }
        }

        // The accept validator will always be run once any of the previous validators have
        // been run. This ensures that we only run the accept validator once we know we
        // have a request that is targetting the API.
        if ($passed) {
            $this->container->make('Dingo\Api\Http\Validation\Accept')->validate($request);
        }

        return $passed;
    }
}
