JUN 25 2013
#QUCK GIT COMMAND LINE ACCESS VIA XCODE

I've recently started using Xcode again and was attempting to use git via the command line since I'm more at home there. After some Googling I found out that it was tied into Xcode .app folder. I looked for a way to make it easy to get at the already built in git. I hated the idea of installing another version and bloating my system with multiple versions when there is a perfectly suitable version already installed. Here is the easiest way I found to work around this:

* Open the terminal
* Type in sudo vi .profile
* Edit the file to include the following line:

<blockquote>alias git="xcrun git"</blockquote>

Restart the terminal and you will now have access to just run git everytime.
