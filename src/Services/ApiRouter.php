<?php 

namespace App\Services;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router as BaseRouter;

class ApiRouter extends BaseRouter {

    public function __construct(Dispatcher $events)
    {
        parent::__construct($events);
    }
 
    /**
     * Route an API resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function apiResource($name, $controller, array $options = [])
    {
        $only = ['index', 'show', 'store', 'update', 'destroy', 'count', 'search'];

        if (isset($options['except'])) {
            $only = array_diff($only, (array) $options['except']);
        }

        return $this->resource($name, $controller, array_merge([
            'only' => $only,
        ], $options));
    }
}