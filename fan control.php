<?php 
        //Assign the risk value to 0 or the value defined in the $_POST variable.
        $risk = 0;
        if(isset($_POST['range'])) //Use the name of your control
          $risk = $_POST['range'];
        ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
  <label for="flying">風扇控制</label>
  <div><input name="flevel" id="flying" type="range" min="0" max="100" value="0"> </div>
  <div>
  <output for="flying" name="level">0</output>/100
  </div>
</form>
	

<br><br>
強制關閉
<label class="switch">
  <input type="checkbox" id="myCheck" onclick="myFunction()">
  <span class="slider round"></span>
</label>
<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var range=document.getElementById("flying");
  if (checkBox.checked == true){
    range.value = 0;
	range.level=0;
  } 
}
var range=document.getElementById("flying");
console.log(range);

</script>
</body>
</html> 

