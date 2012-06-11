<?php
/** Log class
 *
 *
 */
require_once 'application.class.php';

class Log extends Application
{
  protected $methodMap = array('about'   => IO_ANY,
                               'read'    => IO_ANY,
                               'comment' => IO_POST);

  /**
   */
  public function __default()
  {
    echo '__default(' . print_r(func_get_args(), true) . ');';
  }

  /**
   */
  public function __error($call, $emsg, $args)
  {
    trigger_error($emsg . ' <b>call:</b> ' . $call . '() <b>arguments:</b> ' . print_r($args, true), E_USER_ERROR);
  }

  /**
   */
  public function about()
  {
    echo 'about();';
  }

  /**
   */
  public function read($id)
  {
    echo 'read('.$id.');';
  }

  /**
   */
  public function comment($id, $name, $email, $site)
  {
    echo 'comment('.$id.','.$name.','.$email.','.$site.');';
  }
}
?>
