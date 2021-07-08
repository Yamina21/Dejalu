<input type="text" class="text-field form-control" id="username"

    placeholder="Name" required />
<textarea type="text" class="text-field form-control" id="descbook"

    placeholder="Name" required /> 

<script>
 $(document).ready(function () {
     var name = localStorage.getItem('name');
	 var descname = localStorage.getItem('descname');

    $('#username').val(name);
	$('#descbook').val(descname);

   
 });
 </script>