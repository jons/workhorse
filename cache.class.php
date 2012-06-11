<?php
/** Cache class
 *
 *
 */

class Cache
{
  private $mc = null;
  private $prefix = null;
  private $disk = null;

  /**
   */
  public function __construct($prefix = null, $disk = null)
  {
    $this->mc = new memcache;
    $this->mc->connect('localhost', 11235);
    $this->prefix = $prefix;
    $this->disk = $disk;
  }

  /**
   */
  public function __destruct()
  {
    $this->mc->close();
  }


  /**
   */
  public function get($idx)
  {
    $retr = $this->mc->get($this->prefix.$idx);

    if ($retr === false)
    {
      //trigger_error('cache retriving a lost resource: ' . $this->prefix . $idx, E_USER_NOTICE);
      $retr = $this->restore($idx);
    }

    return $retr;
  }


  /**
   */
  public function set($idx, $cdata)
  {
    $this->mc->set($this->prefix.$idx, $cdata);
  }


  /**
   */
  public function restore($idx)
  {
    $retr = @file_get_contents($this->disk . $idx);

    if ($retr === false)
      trigger_error('cache unable to restore resource: ' . $this->disk . $idx, E_USER_WARNING);
    else
    {
      if (get_magic_quotes_runtime()) $retr = stripslashes($retr);
      $this->set($idx, $retr);
    }

    return $retr;
  }

}
?>
