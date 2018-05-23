<?php
namespace cache;

class Memcache
{
	private $link;   //	
	private $config = array(); // cache configuration
	protected $error = NULL;


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
			$this->link = new \Memcache();
			$this->link->addServer($this->config['cache_host'], $this->config['cache_port']);
		}	
		return $this->link;
	}

	public function set($key, $value, $expiration = NULL)
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

	public function s($key, $value = '', $expiration = NULL)
	{
		$number = func_num_args();
		if( $number == 1 ){
			return $this->get($key);
		} else {
			if( $value === NULL  ){
				return $this->delete($key);
			} else {
				return $this->set($key, $value, $expiration);
			}				
		}
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
            	return $this->link->getResultMessage();
            }
        }
        return false;
    }
}