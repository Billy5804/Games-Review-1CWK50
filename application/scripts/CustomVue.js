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
      setList:function(thisFirstName, thisSurname) {
          //Generate a list entry based on the parameter values we receive.
          var postData = {'Firstname' : thisFirstName, 'Surname' : thisSurname}
          // Log the data to the console during development.
          console.log(postData)
          // Send the post jQuery, the first parameter is the URL and the second is the data we wish to send
          $.post("http://localhost/Laboratory16/index.php/set-users", postData)
              .done(function(data){
                  //When the data sends successfully, log the data in the browser
                  console.log(data);
                  // Add the data to the end of your list.
                  body.users.push(postData);
              })
      }
  }
});