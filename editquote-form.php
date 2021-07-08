<input type="text" class="text-field form-control" id="qwritername"

    placeholder="Name" required />
<textarea type="text" class="text-field form-control" id="descquote"

    placeholder="Name" required /> 

<script>
 $(document).ready(function () {
     var wname = localStorage.getItem('wname');
	 var qname = localStorage.getItem('qname');

    $('#qwritername').val(wname);
	$('#descquote').val(qname);

   
 });
 </script>