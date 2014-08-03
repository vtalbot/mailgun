<?php

namespace VTalbot\Mailgun;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Support\Contracts\RenderableInterface as Renderable;

class Mailgunner
{
    protected $data;

    protected $method;

    protected $path;

    protected $cmd;

    protected $container;

    public function __construct($cmd, $method = 'GET', $default = array(), Closure $setter = null)
    {
        $this->cmd = $cmd;
        $this->method = $method;
        $this->default = $default;

        $this->data = array();

        if ( ! is_null($setter) and is_callable($setter)) {
            call_user_func_array($setter, array($this));
        }
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    protected function build_url()
    {
        $app = $this->container;

        $url = $app['config']['vtalbot/mailgun::url'];
        $url .= $app['config']['vtalbot/mailgun::domain'].'/';
        $url .= $this->cmd;

        if (isset($this->path)) {
            $url .= '/'.$this->path;
        }

        return $url;
    }

    protected function build_query()
    {
        $query = array();
        foreach ($this->data as $key => $value) {
            $key = str_replace('_', '-', $key);
            if (is_array($value)) {
                foreach ($value as $val) {
                    if ($val instanceof Renderable) {
                        $val = $val->render();
                    }

                    $query[] = urlencode($key).'='.urlencode($val);
                }
            } else {
                if ($value instanceof Renderable) {
                    $value = $value->render();
                }

                $query[] = urlencode($key).'='.urlencode($value);
            }
        }

        return join('&', $query);
    }

    public function deliver(Closure $callback = null)
    {
        $ch = curl_init();

        $app = $this->container;

        $url = $this->build_url();

        $query = $this->build_query();

        $auth = 'api:'.$app['config']['vtalbot/mailgun::key'];

        if ($this->method === 'GET' and count($q) > 0) {
            $url .= '?'.$query;
        }

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_URL => $url,
            CURLOPT_USERPWD => $auth,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        if ($this->method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $query;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);

        if ( ! is_null($callback) and is_callable($callback)) {
            return call_user_func_array($callback, array($response));
        }

        return $response;
    }

    public function param($key, $value)
    {
        if ( ! isset($this->data[$key])) {
            $this->data[$key] = $value;
        } else {
            if ( ! is_array($this->data[$key])) {
                $this->data[$key] = array($this->data[$key]);
            }

            $this->data[$key][] = $value;
        }

        return $this;
    }

    public function path($path)
    {
        $this->path = $path;

        return $this;
    }

    public function delete()
    {
        $this->method = 'DELETE';

        return $this;
    }

    public function put()
    {
        $this->method = 'PUT';

        return $this;
    }

    public function post()
    {
        $this->method = 'POST';

        return $this;
    }

    public function get()
    {
        $this->method = 'GET';

        return $this;
    }

    public function __get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return null;
    }

    public function __set($key, $value)
    {
        $this->param($key, $value);
    }

    public function __call($key, $values)
    {
        if (count($values) === 1) {
            $this->data[$key] = $values[0];
        } elseif (count($values) > 1) {
            $this->data[$key] = $values;
        }

        return $this;
    }

}
