<?php
/** Source class
 *
 *
 */
require_once 'application.class.php';

class Source extends Application
{
  protected $methodMap = array('about'   => IO_ANY,
                               'view'    => IO_ANY);

  protected $files = array('constants.php',
                           'application.class.php',
                           'command.class.php',
                           'cache.class.php',
                           'log.class.php',
                           'log.php',
                           'source.class.php',
                           'source.php',
                           'tao.class.php',
                           'tao.php',
                           'tpl_parse.php',
                          );

  /**
   */
  public function __default()
  {
    echo '<html><pre><a href="source.php/about">about</a>.<ul>';
    foreach($this->files as $f) echo '<li><a href="source.php/view/' . $f . '">' . $f . "</a>\n";
    echo '</ul></pre></html>';
  }

  /**
   */
  public function about()
  {
    readfile('source-about.html');
  }

  /**
   */
  public function view($filename)
  {
    if (!in_array($filename, $this->files))
    {
      __default();
      exit;
    }
    show_source(dirname(__FILE__) . '/' . $filename);
  }
}
?>
