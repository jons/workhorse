<?php
/** Command class
 *
 *
 */
require_once 'constants.php';

class Command
{
  private $owner = null;
  private $source = IO_NONE;
  private $function = __FUNC_DEFAULT;
  private $args = array();

  /**
   */
  public function __construct(&$obj, $__post = null, $__server = null)
  {
    $this->owner = $obj;
    //if ($__post === null) $__post = $_POST;
    //if ($__server === null) $__server = $_SERVER;

    if (is_array($__post))
      if (array_key_exists(IO_COMMAND, $__post))
      {
        $this->source = IO_POST;
        $this->function = $__post[IO_COMMAND];
        $this->args = $__post;
        return;
      }

    if (is_array($__server))
      if (array_key_exists('PATH_INFO', $__server))
      {
        $this->args = (strlen($__server['PATH_INFO']) > 1) ? explode('/', substr($__server['PATH_INFO'], 1)) : array();

        if (0 < preg_match('#^/[a-z][a-z0-9\._]*#i', $__server['PATH_INFO']))
        {
          $this->source = IO_PATH;
          $this->function = array_shift($this->args);
          return;
        }
      }
  }


  /**
   */
  public function setDefault()
  {
    array_unshift($this->args, $this->function);
    $this->source = IO_NONE;
    $this->function = __FUNC_DEFAULT;
  }

  /**
   */
  public function setError($msg = null)
  {
    $this->args = array($this->function, $msg, $this->args);
    $this->source = IO_NONE;
    $this->function = __FUNC_ERROR;
  }


  /**
   */
  public function execute()
  {
    if ($this->function === null)
    {
      trigger_error('Command::execute() called with no function.');
      return;
    }
    call_user_func_array(array($this->owner, $this->function), $this->args);
  }


  /**
   */
  public function getFunction()
  {
    return $this->function;
  }


  /**
   */
  public function numArguments()
  {
    static $c = null;
    if ($c === null) $c = count($this->args);
    return $c;
  }


  /**
   */
  public function getSource()
  {
    return $this->source;
  }

}

?>
