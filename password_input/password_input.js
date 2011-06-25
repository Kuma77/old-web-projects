<script type='text/javascript'>

var password='';

function key_press(){
	var field= document.getElementById('pass_field');
	field.readonly= true;
	
	if (field.value.charCodeAt(field.value.length-1) >31 && field.value.charCodeAt(field.value.length-1) <127){ //if the character entered by the user is a printable character
		password+= field.value.charAt(field.value.length-1); //we add the newly inserted character to the password
		field.value= field.value.substring(0, field.value.length-1) //we then delete that newly inserted character from the field
		field.value+='*'; //we add a star instead
	}
	
	field.readonly= false;
		
	}

function form_submit(){
	var field= document.getElementById('pass_field');
	field.value= password;
	
	var form= document.getElementById('form');
	form.submit();
}
</script>
