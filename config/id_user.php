
<?php


?>
<script type="text/javascript">
	
	var id_user = localStorage.getItem("id_user");


        if (id_user == null) {

        	var date = new Date();
			var id_user_insert = date.getDay() + "_" + date.getHours() + "_" + date.getMinutes() + "_" + date.getSeconds()+ "_" + date.getMilliseconds();

            localStorage.setItem("id_user", id_user_insert);
            // alert('cest enregistrer maintenant');
        }else{
            // alert(id_user);
        }

</script>