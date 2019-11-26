<?php

namespace PBS\Logout\Drivers;

class BaseDriver
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new driver instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Logout the user.
     *
     * @param int $id
     *
     * @return void
     */
    public function logout($id)
    {
        $userToLogout = $this->model()::find($id);
        $this->facade()::setUser($userToLogout);
        $this->facade()::logout();
    }

    /**
     * Generate Socket IO Url.
     *
     * @return string
     */
    public function generateSocketIoUrl($driver)
    {
        return config('app.url') . ':3000' . '?driver=' . strtolower($driver) . '&&user_id=' . $this->facade()::getUser()->id;
    }
}
