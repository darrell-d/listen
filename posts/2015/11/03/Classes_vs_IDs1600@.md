Nov 03 2015
#HTML: ID vs Classes

Recently I've been helping teach intro HTML and programming classes through the [Philly GDI chapter](https://www.girldevelopit.com/chapters/philadelphia "GDI Philadelphia"). One of the big things that seems to stump beginners for a while is the difference between whether to use a ID tag or a class. When learning they seem to both do the same thing, however there are some key difference between them.

To start off a HTML class or ID  can both be thought of as hooks that allow you to select an HTML element and do something with it. Formally these hooks are called [selectors](http://www.w3.org/TR/CSS21/selector.html%23id-selectors "W3 formal definition of selectors").You can use selectors in CSS to style a certain tag or to add some dynamic behavior to your site in JavaScript. In addition to tags and IDs you can use tag names as hooks to select an object. Which one do you choose?

The main thing to keep in mind is that IDs are meant to be unique and will only exist on one tag in your code. Common IDs are 'header', 'footer' and 'navigation'.Your site should only have one header, footer and navigation menu and because of that they are unique. Classes on the other hand are meant to be shared and re-used between different tags.

Here is a basic HTML layout of a bit of text in a poem:

<iframe width="40%" height="475" src="http://jsfiddle.net/ddefreitas/uq08xehj/6/embedded/result,html,css,js" allowfullscreen="allowfullscreen" frameborder="0"></iframe>


Now I want this snippet of poetry to stand out some more so I want only the first line to be in bold.

One way of doing this is to apply an ID to the first tag:

`<p id = "firstLine">I think continually of those who were truly great.</p>`

In the CSS I can use a selector to apply the bold font face to just that paragraph with an ID of "firstLine":

`#firstLine { font-weight : bold; } `

You specify something is an ID by using the `#` symbol. Someone decided this a long time ago and that's just the way it is now.

There are 3 lines I think are really cool so this is a great opportunity to use a class since I plan to highlight more than one section.

First I'll put a span around all of the parts I want to highlight:

`<span class = "highlight">from the womb, remembered the soul’s history</span>`

`<span class = "highlight">where the hours are suns,</span>`

`<span class = "highlight">Was that their lips, still touched with fire,</span>`

Next I just need to add in my class selector in CSS and let it know what color I would like my highlight to be in:

`.highlight { background-color : yellow; } `

Unlike IDs, classes are selected using a period (`.`). Once again this is simply the symbol that was chosen to represent them.

One big difference to keep in mind between classes and IDs is that you can only apply one ID to a tag, however you can have as many classes as you want! If I created an underline class to apply an red underline to the text within it, I can simply add that class on:

`<span class = "highlight underline">from the womb, remembered the soul’s history</span>`
`.underline{ text-decoration : underline; } ` 

A tag can also have an ID and one or more classes associated with it as can be seen used in the final output:

<iframe width="40%" height="475" src="https://jsfiddle.net/ddefreitas/zr5mnwdk/7/embedded/result,html,css,js" allowfullscreen="allowfullscreen" frameborder="0"></iframe>

If you look carefully in the example above you'll see that I also selected all headers and paragraph tags and changed their font using the element name as a selector. 

A few bonus bits about IDs:

- IDs can be used to jump a page directly to where that ID is. Ever been to a page where you can jump to the bottom of the page? Normally you just give an element an ID of "footer" and then link to it using something like this:

    `<a href="#footer">Go to footer</a>`

- Javascript automatically creates a reference variable to the element of any page with an ID on it. That means that the this div element: `<div id="foo"></div>` can be accessed in JavaScript simply by using the variable `foo`. 