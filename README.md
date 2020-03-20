# 1CWK50
The PHP Frameworks Assessment

# index/reviews page:
Displays reviews with the newest first
    When a review is clicked on you will be taken to the appropriate review page

# games page
Displays all games on the site that have been reviewed
    when a game is clicked on the reviews for that game will be diaplyed with the newest first
        when a review is clicked you will be taken to the appropriate review page

# individual review page
Display one card with the review image, game title, view author, 
the review and if you hover over the image you will see the games blurb and who that blurb came from.
under the review there is a section to post comments
    if comments are disabled an appropriate message is displayed
    if the comments are enabled any previous comments are displayed and
        if the user is logged in, they can post new comments using the displayed form
        if the user isnt logged in the form won’t be there and instead a message telling them to log in will be shown

# log in page
Displays a form to log in
when credentials are submitted, they will be checked
    if the credentials are correct the user will be taken to the page they were on before trying to log in
    otherwise the user will be shown an alert telling them their login failed

# user functions
when logged in there will be a new button in the navigation bar displaying your username 
when clicked a list of options for your account will be displayed
    light/dark mode swaps between the modes
    enable/disable admin toggles the admin status of your account
    log out logs you out then display an alert to confirm log out

# chat
the chat server is saved in the scripts folder as app.js be sure to start this with node in order to use the chat service
the chat button present on all webpages will be enabled when the chat server is up
the chat button will be disabled when the server is down
admins will have the prefix [ADMIN] on their name
sent messages appear slightly to the right in the chat window
received messages will appear slightly to the left
if the chat starts having issues try clearing the chatRoom cookie 

# global chat
Only available to logged in users
Allows all users to chat to each other

# support chat
normal and unregistered user can chat here but only to 1 member of staff (admin)
whenever a non admin types a message the will be shown a message informing them help is on the way
an admin who is online will be assigned to this now open support room where the user and admin can talk
once the chat has concluded either user can press the end chat button to end the chat
this allows the admin to join another support chat and the user to have the option of starting another chat of their own
if no support chats are available for an admin an appropriate message will be displayed and the chat system will check again in 10 seconds

# database
My database dump file is in the SQL folder
The database name is "gamereviews"

