<script type="text/javascript">
	var form = document.getElementById("form");
	
	function checkInput(){
		var good = document.getElementById("good");
		var wrong = document.getElementById("wrong");
		var submit = document.getElementById("submit");
		

		if (form.value == <?php echo "\"".htmlentities($_SESSION['captcha']->string)."\""; ?>){
			good.style.cssText="";
			submit.style.cssText="";
			wrong.style.cssText="display:none";
		} else {
			wrong.style.cssText="";
			good.style.cssText="display:none";
			submit.style.cssText="display:none";
		}
	}

	
</script>