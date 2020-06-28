
<html>
   <head>
      <title></title>
        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
      <script>
        $(function() {
	
			jQuery.extend({
				getValues: function(data, url) {
					var result = null;
					$.ajax({
						url: url,
						type: 'post',
						data: data,
						async: false,
						success: function(datas) {
							result = datas;
						}
					});
					return result;
				}
			});

            
			$('#myButton').click(function(){
				
				var mySubject = $("#mySubject").val();
				var myTextArea = $("#myTextArea").val();
				
				var send = $.getSValues({
					"mySubject" : mySubject,
					"myTextArea" : myTextArea
					}, 'parse.php'); 
				
				alert(send);
			});

        });
        
      </script>
      <style>
        
      </style>
   </head>
   <style>
    

    </style>
    
   <body>
   	<div>
		Subject: <input id='mySubject' type='text' />
		<br /><br />
		Message: <textarea id='myTextArea'></textarea>
		<br /><br /><br />
		<input id='myButton' type='button' value='Send my Email'></input>
	</div>
   </body>
        
</html>

