workhorse
=========

<p>an MVC framework for web applications based on URI-to-method translation.

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

<p>for a robust example, read the source code of the tao demo.</p>

