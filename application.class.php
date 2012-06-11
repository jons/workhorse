<?php
/** Application class
 *
 *
 */

require_once 'constants.php';
require_once 'command.class.php';

abstract class Application
{
  private $cmd = null;

  /**
   */
  public function __construct($__post = null, $__server = null)
  {
    $this->cmd = new Command($this, $__post, $__server);
    $rClass = new ReflectionClass(get_class($this));

    if (!$rClass->hasMethod($this->cmd->getFunction()))
    {
      $this->cmd->setDefault();
      return;
    }

    if (!$this->allowCommand())
    {
      $this->cmd->setError('Call from inappropriate source.');
      return;
    }

    $mClass = new ReflectionMethod(get_class($this), $this->cmd->getFunction());

    if ($mClass->getNumberOfRequiredParameters() > $this->cmd->numArguments())
    {
      $this->cmd->setError('Not enough parameters provided.');
      return;
    }
  }


  /**
   */
  private function allowCommand()
  {
    if ($this->cmd->getFunction() == __FUNC_DEFAULT) return true;

    $mask = $this->methodMap[$this->cmd->getFunction()] & $this->cmd->getSource();
    return $mask != 0;
  }

  /**
   */
  public function run()
  {
    if ($this->cmd === null)
    {
      trigger_error(get_class($this) . '::run() called without Command object', E_USER_ERROR);
      return;
    }
    $this->cmd->execute();
  }

  abstract public function __default();

  public function __error($call, $emsg, $args)
  {
    trigger_error('error in application: '.$emsg, E_USER_ERROR);
  }
}

?>
