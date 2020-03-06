var comments = new Vue ({
  el: '#comments',
  data:{
      comments:[]
  },
  created(){
      this.getComments(window.location.href.substring(window.location.href.lastIndexOf('/') + 1));
  },
  methods:{
      getComments:function(id){
          $.get("http://localhost/Games-Review-1CWK50/getComments/" + id, function(data){
            comments.comments = [];
            data.forEach(element => {
              if (element.username === null) element.username = '<small><del>DELETED USER</del></small>';
              comments.comments.push(element);
            });
          });
      },
      postComment:function(id, username) {
        //Generate a list entry based on the parameter values we receive.
        const postComment = {'username':username,'comment':$('#userComment').val(),"commentTimestamp":"Just now"};
        // Update comments on page to remove old 'Just now' comments
        this.getComments(id); 
        // Send the post jQuery, the first parameter is the URL and the second is the data we wish to send
        $.post("http://localhost/Games-Review-1CWK50/postComment/" + id, postComment)
          .done(function(data) {
            // Add the data to the end of your list.
            comments.comments.push(postComment);
            // Clear the comment field
            $('#userComment').val('')
            //When the data sends successfully, inform the user
            alert("Comment Posted");
          });
      }
  }
});