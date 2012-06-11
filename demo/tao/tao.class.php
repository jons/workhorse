<?php
/** Tao class
 *
 *
 */
require_once 'application.class.php';
require_once 'cache.class.php';
require_once 'tpl_parse.php';
require_once 'Numbers/Words.php';

class Tao extends Application
{
  protected $methodMap = array();
  private $cache;
  private $sel = array(16,20,22,47,50,56,77,80);

  /**
   */
  public function __construct($__post = null, $__server = null)
  {
    $this->cache = new Cache('tao:', '/var/www/htdocs/taodata/');
    parent::__construct($__post, $__server);
  }


  /**
   */
  public function __default($id = 0)
  {
    $link = $this->cache->get('link.txt');
    $nw = new Numbers_Words();
    $select = null;


    if (($id > 0) and ($id < 82))
    {
      $tao = $this->cache->get($id.'.txt');
    }
    else
    {
      $tao = $this->cache->get('table');

      if ($tao === false)
      {
        $tao = null;

        for($x = 1; $x < 10; $x++)
        {
          for($y = 1; $y < 10; $y++)
          {
            $z = $x * $y;
            $tao .= ($z < 10 ? '&nbsp;&nbsp;' : '&nbsp;') .
                    tpl_parse($link, array('N' => $z, 'W' => $z));
          }
          $tao .= '<br><br>';
        }

        $this->cache->set('table', $tao);
      }

    }

    foreach($this->sel as $s) $select .= tpl_parse($link, array('N' => $s, 'W' => $s));

    $left =  ($id > 1)  ? tpl_parse($link, array('N' => ($id-1), 'W' => '&lt;&lt;')) : null;
    $right = ($id < 81) ? tpl_parse($link, array('N' => ($id+1), 'W' => '&gt;&gt;')) : null;

    $vars = array('TAO'    => $tao,
                  'W'      => $id ? $nw->toWords($id) : null,
                  'LEFT'   => $left,
                  'RIGHT'  => $right,
                  'SELECT' => $select);

    echo tpl_parse($this->cache->get('index.txt'), $vars);
  }
}
?>
