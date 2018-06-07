<?php
namespace Nezumi;

class File extends ACache
{
    public $cache_dir;      		 // the cache dir
    public $file_extension = '.php'; 
    
    /**
     * init
     *
     * @param  array $this->config
     *
     */
    public function __construct($config)
    {
        if (empty($config)) {
            $this->error = 'No Config';
            return false;
        }
        $this->config = $config;
        $this->cache_dir = $this->config['cache_dir'];
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir);
        }
    }

    /**
     * Sets cache
     *
     * @param string $key
     * @param array  $value
     *
     */
    public function set($key, $value, $expiration = 0)
    {
        $file = $this->cache_dir.$key.$this->file_extension;      	
        $value = serialize($value);
        return file_put_contents($file, $value);
    }

    /**
     * get cache
     *
     */
    public function get($key)
    {
        $file = $this->cache_dir.$key.$this->file_extension;
        if (file_exists($file)) {
        	//whether expiration
        	if( time()-filemtime($file)>$this->config['cache_time'] ){
        		unlink($file);
        		return false;
        	}
            return unserialize(file_get_contents($file));
        } else {
            $this->error = 'no cache';
        }
        return false;
    }

    /**
     *
     * deletes key
     *
     */
    public function delete($key)
    {
        $file = $this->cache_dir.$key.$this->file_extension;
        if (!file_exists($file)) {
            $this->error = 'no cache';
        } else {
            return unlink($file);
        }
    }

    /**
     * clear all of cache
     *
     */
    public function clear_all()
    {
        $files = scandir($this->cache_dir);
        foreach ($files as $key => $value) {
            if (file_exists($this->cache_dir.$value) &&  $value!='.'  && $value!='..') {
                unlink($this->cache_dir.$value);
            }
        }
    }

    public function getError()
    {
        
    }
}
