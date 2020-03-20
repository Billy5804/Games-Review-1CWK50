$(document).ready(function() {
  var comments = new Vue ({
    el: '#comments',
    data:{
        comments:[],
        path:window.location.href.split('/'),
        id:0
    },
    created(){
      // get the current review ID
      this.id = parseInt(this.path[this.path.length-1]);
      // load comments when page loads
      this.getComments();
    },
    methods:{
        getComments:function(){
          // retrieve all comments
            $.get(getBaseUrl() + "getComments/" + this.id, function(data){
              // clear previously stored comments
              comments.comments = [];

              data.forEach(element => {
                // store each comment to the array and handle null users
                if (element.username === null) element.username = '<small><del>DELETED USER</del></small>';
                element.timeSince = elapsedTime(element.commentTimestamp);
                comments.comments.unshift(element);
              });
            });
        },
        postComment:function(username) {
          // Check if there is a comment to post
          if ($('#userComment').val() == '') {
            return;
          }
          //Generate a list entry based on the parameter values we receive.
          const postComment = {'username':username,'comment':$('#userComment').val(),"commentTimestamp":new Date(),"timeSince":'Just now'};
          // Send the post jQuery, the first parameter is the URL and the second is the data we wish to send
          $.post(getBaseUrl() + "postComment/" + this.id, postComment)
            .done(function(data) {
              console.log(postComment);
              // Add the data to the end of your list.
              comments.comments.unshift(postComment);
              // Update Comment Times
              for (let index = 0; index < comments.comments.length; index++) {
                comments.comments[index].timeSince = elapsedTime(comments.comments[index].commentTimestamp);
              }
              // Clear the comment field
              $('#userComment').val('')
              //When the data sends successfully, inform the user
              alert("Comment Posted");
            })
            .fail(function(jqXHR) {
              // debug message to help during development:
              // console.log('request returned failure, HTTP status code ' + jqXHR.status);
              // console.log(jqXHR.responseText);
          });
        }
    }
  });
});