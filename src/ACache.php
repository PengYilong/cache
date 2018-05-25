<?php
namespace cache;

abstract class ACache
{
	private $link;   //the instance of cache	
	protected $error = NULL; // the error	
	private $config = array(); // the cache configuration

	abstract public function set($key, $value, $expiration = 0);
	abstract public function get($key);
	abstract public function delete($key);
	abstract public function getError();
	
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
    public function throw_exception()
    {
        if( $this->config['debug'] ){
            if( $this->error ){
            	return $this->error;
            } else {
            	return $this->getError();
            }
        }
        return false;
    }
			
}