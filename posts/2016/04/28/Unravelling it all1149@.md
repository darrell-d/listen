Apr 28 2016
#Unraveling it all

It used to be in the good old days when programming for the web that you could just include a JS file and call it a day. The included file probably had all of the instructions you needed to understand what was going on.Probably.

It wasn't great, but it was easy to unravel what was going on. If you had a bug somewhere you could track it down fairly easily. Just look at where the error was coming from and track down the offending line of code that wasn't allowing snow to fall all across your page (or whatever other horrible script you were forcing on your users)

The web has evolved in a lot of great ways, but it's getting harder to debug. Here are some hoops I recently jumped through to debug a simple NodeJS undefined error:

- Get this lovely error:

> TypeError: Cannot read property 'name' of undefined
>    at C:\Users\ddefreitas\Documents\web\nodejs\express.js:23:31
>    at Layer.handle [as handle_request] (C:\Users\ddefreitas\node_modules\express\lib\router\layer.js:95:5)
>    at next (C:\Users\ddefreitas\node_modules\express\lib\router\route.js:131:13)
>    at Route.dispatch (C:\Users\ddefreitas\node_modules\express\lib\router\route.js:112:3)
>    at Layer.handle [as handle_request] (C:\Users\ddefreitas\node_modules\express\lib\router\layer.js:95:5)
>    at C:\Users\ddefreitas\node_modules\express\lib\router\index.js:277:22
>    at Function.process_params (C:\Users\ddefreitas\node_modules\express\lib\router\index.js:330:12)
>    at next (C:\Users\ddefreitas\node_modules\express\lib\router\index.js:271:10)
>    at Immediate.<anonymous(C:\Users\ddefreitas\node_modules\multer\lib\make-middleware.js:52:37)
>    at Immediate.immediate._onImmediate (timers.js:590:18)

- Ignore the 6 files that the error chained through (due to NPM magic I've never seen these files in my life)
- Realize the error starts on line 23 on the file I was working on.
- Get curious about offending line: `console.log(req.files.file.name);`
- Print out the base object, realize there is no `file` property.
- Go to documentation for [NodeJS](https://nodejs.org/dist/latest-v6.x/docs/api/). Realize it I'm looking at the wrong documentation after searching and swearing for 20 minutes. My fault.
- Look up the properties for the [express api](http://expressjs.com/en/4x/api.html). Realize that none of the properties listed are named files.
- Ctrl + f type in *files*
- Find a note stating that I need to use the [multer middleware](https://www.npmjs.com/package/multer) (that thing I included and decided I would figure it out later)
- Look up the description for it, find out it's written on top of [busyboy](https://github.com/mscdex/busboy) (something else I will have to understand at some future point)
- Eventually find the properties I was looking for so I can get by with getting a small proof of concept working.

I love the modern tools we have available, and the speed at which they allow us to build, but I can't help the feeling that I have too many black boxes built on top of each other just waiting to collapse.