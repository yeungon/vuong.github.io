
<?php

//code 1
<script>

function debounce(func, wait) {
var timeout;
return function () {
var context = this, args = arguments;
var later = function () {
func.apply(context, args);
}
clearTimeout(timeout);
timeout = setTimeout(later, wait);
}
}
</script>

//function này giống cái trên nhé, param function này bạn truyền tên hàm này vào nhé

//code 2 //http://stackoverflow.com/questions/7849221/ajax-delay-for-search-on-typing-in-form-field
<script>
var delayTimer;
function doSearch(text) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        // Do the ajax stuff
    }, 1000); // Will do the ajax stuff after 1000 ms, or 1 s
}

</script>

// code 3: 

// below is the html form
<form action="" method="post" accept-charset="utf-8">
    <p><input type="text" name="q" id="q" value="" onkeyup="doDelayedSearch(this.value)" /></p>
</form>

// script to handle the above html form

<script>
var timeout = null;

function doDelayedSearch(val) {
  if (timeout) {  
    clearTimeout(timeout);
  }
  timeout = setTimeout(function() {
     doSearch(val); //this is your existing function
  }, 2000);
}
</script>

// code 4: http://remysharp.com/2010/07/21/throttling-function-calls/
?>
