function menuPropagation(){
    $(document).on("click",".authorLoginbtn,.logoutbtn,.createAccountbtn",function(){
          var action=$(this).data("action")
         if (action=="signup"){
          window.location.href="../author/authorSignup.php"
         }else if(action=='login'){
          window.location.href="../author/authorLogin.php"
         }else if(action=="logout"){
          window.location.href="../author/logout.php"
         }
        })
  }


// Existing lazy loading code
var lazyImageObserver = new IntersectionObserver(function(entries, observer) {
  entries.forEach(function(entry) {
    if (entry.isIntersecting) {
      var lazyImage = $(entry.target);
      lazyImage.attr("src", lazyImage.data("src"));
      lazyImage.removeClass("lazy");
      lazyImageObserver.unobserve(entry.target);
    }
  });
});

function observeLazyImages() {
  var lazyImages = $(".lazy");
  lazyImages.each(function() {
    lazyImageObserver.observe(this);
  });
}

// Initially observe images on page load
observeLazyImages();
// handling the search functionality

$('.searchinput').keypress(function(event) {
  var basepath = $(".basepathdiv").data("basepath");
  var inp = $(this);
  var keycode = (event.keyCode ? event.keyCode : event.which);
// enter key is pressed
  if (keycode === 13) {
    var predicate = inp.val().trim();
      // Check the length of the predicate
      if (predicate.length >= 4) {
        // Redirect to a new page
        $('#myModal').modal('hide');
        var dest = basepath + 'searches/search_results.php?predicate=' + encodeURIComponent(predicate);
        window.location.href = dest;
      }
    
  }
});

$('.searchinput').on("keydown paste keyup", function() {
  var predicate = $(this).val().trim();
  if(predicate.length <= 3){
    $(this).addClass('border border-danger');
    return;
  }else{
    $(this).removeClass('border border-danger');
  }
})


  // display search modal on small devices
  $('.searchinitiator').click(function() {
    $('#myModal').modal('show');
  });
  
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}


// handling mailing list
$(".mailingListForm").submit(function(e) {
  e.preventDefault();
  var email = $(".emaillistinput").val().trim(); 
  if (!isValidEmail(email)) {
     $.notify('Please Provide a Valid Email Address.' , {
         position: 'top left',
        autoHideDelay: 5000, 
        className: 'error' 
        });
    return;
  }
  var dataToSend = {
    email: email
  };
  var pathprefix = $(this).data("pathprefix");
  var path = pathprefix + "mailing/mailingListInserter.php";
  $.ajax({
    type: "POST",
    url: path,
    data: dataToSend,
    beforeSend:function(){
         $.notify('Submitting Email Address.' , {
         position: 'top left',
        autoHideDelay: 5000, 
        className: 'info' 
        });
    },
    success: function(response) {
        if(response==1){
            $.notify('Thank you for subscribing to our newsletter', {
         position: 'top left',
        autoHideDelay: 5000, 
        className: 'success' 
        });
        $(".emaillistinput").val("")
        }else{
             $.notify(' An error occured. Please check the provided Email.' , {
         position: 'top left',
        autoHideDelay: 5000, 
        className: 'error' 
        });
        }
    },
    error: function() {
          $.notify('A network Occured. Please Check Connection' , {
         position: 'top left',
        autoHideDelay: 5000, 
        className: 'error' 
        });
    }
  });
});

// handling category dropdown
$(".categorybutton").click(function(){
    $("#multiColumnModal").modal("show");
    
})

