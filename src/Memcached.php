<?php
namespace Nezumi;

class Memcached extends ACache
{
	
	private $config = array(); // cache configuration

	public function open($config)
	{
        if(empty($config)){
        	$this->error = 'No Config';
        	return FALSE;
        }
        $this->config = $config;
        if( $this->config['autoconnect'] ){
            return $this->connect();
        }

	}

	public function connect()
	{
		if(!class_exists('Memcached')){
			$this->error = 'No Memcached';
			return false;
		}
		if( !$this->link ){
			$this->link = new \Memcached();
			$this->link->addServer($this->config['cache_host'], $this->config['cache_port']);
		}	
		return $this->link;
	}

	public function set($key, $value, $expiration = 0)
	{
		if( $expiration === NULL ){
			$expiration = $this->config['cache_time'];
		}
		return $this->link->set($key, $value, $expiration);	
	}

	public function get($key)
	{
		return $this->link->get($key);	
	}

	public function delete($key)
	{
		return $this->link->delete($key);	
	}

    /**
     * @return boolean
     */
    public function getError()
    {
        return $this->link->getResultMessage();
    }
}