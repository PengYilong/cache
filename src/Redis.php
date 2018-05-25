<?php
namespace cache;

class Redis extends ACache
{

	public function open($config)
	{
        if(empty($config)){
        	$this->error = 'No Config';
        	return false;
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
			$this->link = new \Redis();
			$this->link->connect($this->config['cache_host'], $this->config['cache_port']);
		}	
		return $this->link;
	}

	public function set($key, $value, $expiration = NULL)
	{
		if( $expiration === NULL ){
			$expiration = $this->config['cache_time'];
		}
		$encode_value = json_encode($value);
		return $this->link->set($key, $encode_value, $expiration);	
	}

	public function get($key)
	{

		$decode_value = json_decode($this->link->get($key));
		return $decode_value;	
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
        if( $this->config['debug'] ){
            if( $this->error ){
            	return $this->error;
            } else {
            	return $this->link->getLastError();
            }
        }
        return false;
    }
}