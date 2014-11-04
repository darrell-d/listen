JUN 05 2014
#DEBUGING TIPS

Guide of things common basic debugging traps that I've fallen into over the years and I've seen others fall into. On any given day these questions run through my mind as I encounter strange behavior or when something isn't working right. They may seem obvious but I wanted to get them down and onto paper so I can have something to reference when it's 4AM and the deadline is at 8AM. Also this should hopefully be helpful to newcomers

An updated copy of this is kept on <a href = 'https://github.com/darrell-d/debugging/blob/master/debugging.md' target='_blank'>github</a>
###General

* Don't panic!
* What do you expect to happen?
* What is actually happening?
* Look at the output, what does it tell you? Read it carefully and slowly.
* Which source file does the issue occur in?
	* Which function?
	* Which line?
  	* What specific statement?
	* Start answering the first question and go deeper.
* What values do you think your variables have? Print these values to screen to verify what they are.
* Be very liberal with your debug print statements. Put them before and after where you suspect the problem is happening.
* Are you loading the right file?
* Are you *sure* you're loading the right file?
* Is there some caching going on anywhere on the OS/Server/Compiler/Browser/Proxy level?
	* Always logout and then login after clearing your cache
* Are all of your variables correctly spelled?
* Are your variable and function names spelled correctly?
* Do you have semi-colons in the right place?
* Did you check for semi-colons at the end of `if`, `for` and `while` structures or anywhere else where they are not supposed to be?
* Do you have whitespace in the right place?
* Do you fully understand how a function / feature is supposed to work? Either speak up and ask or spend some time with the documentation.
* If you are working on anything non-trivial put it under source control. That way you can compare previous known working versions of the code to the current failing version.
* If something works on one computer but not another verify that all libraries and dependancies are the same.
	* Also ensure that everything else is the same:OS runtime library, dependencies etc. A small version number difference can break things.


###C/ C++
* Is your compiler setup properly?
* Do you have all of the required header files?
* Segfault? Ctrl + z.
 * If you have a segfault it means you probably did something funky with a pointer, so start your search with pointers. Wikipedia has a decent [write up on segfaults](http://en.wikipedia.org/wiki/Segmentation_fault)
     * Learn to use pointers properly. It will save your life

###PHP

* Are your files set to the right permissions?
* Is there a break in network connectivity? (CDN down, remote server unavailable etc).
* Do a cache clear and force reload.
* Make sure the error log is turned on
* Check the error log for an extra clues that may not have been displayed on screen (usually in the Apache error log)
* Are your `ini` file settings in order?
* Did you get the `needle` `haystack` order right? Double check on PHP.net, or your IDE's code hinting.


###Javascript

* Are you sure the feature you are trying to use is available on the browser you are testing on? See what happens on other browsers.
* If you get an error `TypeError: Cannot call method 'yourMethodName' of null` or something similar to it, chances are that you are attempting to access a DOM element before it is loaded. Place your code in side a `$(document).ready(function(){/*Code Here*/});` call. No JQuery? Use `document.addEventListener("DOMContentLoaded", function() {/*Code Here*/}, false);` instead.

#### Jquery

* Are you running the script in a `$(document).ready(function(){/*Code here*/ });`?
* Are you sure you have the format `$(document).ready(function(){/*Code here*/ });` and not `$(document).ready(){/*Code here*/ }`?
* Are you creating race conditions with the network? Think about `async` and if you may need to wait.
