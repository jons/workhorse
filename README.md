workhorse
=========

<p>an MVC framework for web applications based on URI-to-method translation.</p>

<p>developed in eight minutes almost a decade ago (2003?), codenamed
"workhorse," and then abandoned (codeigniter eventually came along and
superceded it).</p>

<p>each controller is an extension of the <code>Application</code> class, which
contains all of the input and output systems needed to invoke one controller
feature per URI and produce a view.</p>

<p>there is a <code>Command</code> class which is created from user input with a
small pattern matching system and then executed according to the methods of a
subclass of <code>Application</code>.</p>

<p>view pages thus need only a couple lines of code, to create an application
object and then run it immediately, however, any amount of processing could have
been done first -- even with other application objects.</p>

<p>controllers work by simply naming the methods with the string the client
is expected to request to invoke the method. e.g. the source code viewer demo
page, source.php, supports the method "view", making the request URI
<code>domain.com/path/to/source.php/view</code>, with whatever arguments as may
be relevant following thereafter. mod_rewrite can be used to prettify the path
to just <code>source/view</code>. to support this method, source.php creates
a <code>Source</code> object, which extends <code>Application</code> but also
has a method declared: <code>public function view($filename)</code>. arguments
are fed to the function from PATHINFO in the order they appear in the URI.</p>

<p>the tao demo shows an alternative use for the <code>__default</code> handler,
which will be invoked when the segment of PATHINFO in the URL that is interpreted
as the method name does not actually name a function that exists in the class (or
is just not present in the URL).</p>
