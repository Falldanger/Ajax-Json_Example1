<!DOCTYPE html>
<html lang="en">
<head>
<script src="jquery.min.js"></script>
</head>
<body>
<form method="post" action="#">
	<p>
		<input type="text" name="name" class="nameField" placeholder="Name">
	</p>
	<p>
		<input type="text" name="surname" class="surnameField" placeholder="Surname">
	</p>
	<p>
		<input type="text" name="Age" class="ageField" placeholder="Age">
	</p>
	<p>
		<input type="submit" value="Send" class="button">
	</p>
</form>

<table class="rows">

</table>

<script>
jQuery(document).ready(function() {
    jQuery(".button").bind("click", function() {

        var name = jQuery('.nameField').val();
		var surname = jQuery('.surnameField').val();
		var age = jQuery('.ageField').val();
        
		jQuery('.nameField').val('');
		jQuery('.surnameField').val('');
		jQuery('.ageField').val('');
		
        jQuery.ajax({
            url: "for_db.php",
            type: "POST",
            data: {name:name, surname:surname, age: age}, // Передаємо дані для запису
            dataType: "json",
            success: function(result) {
                if (result){ 
					jQuery('.rows tr').remove();
                    jQuery('.rows').append(function(){
						var res = '';
						for(var i = 0; i < result.users.name.length; i++){
							res += '<tr><td>' + result.users.id[i] + '</td><td>' + result.users.name[i] + '</td><td>' + result.users.surname[i] + '</td><td>' + result.users.age[i] + '</td></tr>';
						}
							return res;
					});
					console.log(result);
                }else{
                    alert(result.message);
                }
				return false;
            }
        });
	return false;
    });
});
</script>
</body>
</html>