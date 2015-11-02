# HTML IDs vs Classes #

Recently I've been helping teach intro HTML and programming classes through the Philly GDI chapter. One of the big things that seems to stump beginners for a while is the difference between whether to use a ID tag or a class.

To start off a HTML class or ID  can both be thought of as hooks that allow you to select an HTML element and do something with it. Formally these hooks are called selectors.You can use selectors in CSS to style a certain tag or to add some dynamic behavior to your site in JavaScript. In addition to tags and IDs you can use tag names as hooks to select an object. Which one do you choose?

The main thing to keep in mind is that IDs are meant to be unique and will only exist on one tag in your code. Common IDs 'header', 'footer' and 'navigation' since your site should really only have one of these. Classes on the other hand are meant to be shared and re-used between different tags.

In the JSFiddle below if you look at the CSS tab you'll see that I've made all header and paragraph text a sans-serif font.

<iframe width="40%" height="475" src="http://jsfiddle.net/ddefreitas/uq08xehj/4/embedded/result,html,css,js" allowfullscreen="allowfullscreen" frameborder="0"></iframe>

(Note: I selected multiple tags by separating them with a comma)

Now I want this snippet of poetry to stand out some more so I want only the first line to be in bold.

One way of doing this is to apply an ID to the first tag:

`<p id ="firstLine">The desires falling across their bodies like blossoms.</p>`

Now in CSS I can use a selector to apply the bold font face to just that paragraph with an ID of "firstLine":

`#firstLine { font-weight : bold; } `

Note that you specify something is an ID by using the # symbol. Someone decided this a long time ago and that's just the way it is now.

Now if I want to highlight my favorite parts of it. There are 3 lines I think are really cool so this is a great opportunity to use a class since I play to highlight more than one place.

First I'll put a span around the parts I want to highlight with a class name of highlight:

`<span class = "highlight">from the womb, remembered the soul’s history</span>`

now I just need to add in my class selector in CSS and let it know what color I would like my highlight to be in:

`.highlight { background-color : yellow; } `

Note that unlike IDs, classes are selected using a period.

One big difference to keep in mind between classes and IDs is that you can only apply one ID to a tag, however you can have as many classes as you want! If I created an underline class to apply an red underline to the text within it, I can simply add that class on:

`<span class = "highlight underline">from the womb, remembered the soul’s history</span>`
`.underline{ text-decoration : underline; } ` 

A tag can also have an ID and one or more classes associated with it. See the example below:

<iframe width="40%" height="475" src="https://jsfiddle.net/ddefreitas/zr5mnwdk/7/embedded/result,html,css,js" allowfullscreen="allowfullscreen" frameborder="0"></iframe>


One last bonus to keep in mind about IDs is that they can be used to jump a page directly to where that ID is. Ever been to a page where you can jump to the bottom of the page? Normally you just give an element an ID of "footer" and then link to it using something like this:

<a href="#footer">Go to footer</a>
