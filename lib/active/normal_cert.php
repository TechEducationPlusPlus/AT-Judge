<html>
	<head>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="qrcode.min.js"></script>
		<style>
		html
		{
			height: 100%;
			font: Monospace 20;
		}

		body 
		{
			color: #009688;
			height: 100%;
		}
		#my-node
		{
			background-image: url("./background.png");
			background-color: white;
			color: #009688;
			width: 1280px; 
			height: 960px;
			text-align: center; 
			border: 10px solid #787878;
		}
		#cert
		{
			position: absolute;
			left: 334px;
			top: 175px;
			width: 913px;
			text-align: left;
		}

		.date
		{
			position: absolute; 
			top: 680px; 
			left: 47px; 
			text-align: left;
			float: left;
		}

		#certificate
		{
			font-size: 100pt;
			text-align: left;
		}

		#content
		{
			border-top: 40px solid rgba(0,0,0,0);
			text-align: center;
		}

		table, tbody, tr, td, th
		{
			color: #009688;
		}
		table
		{
			width: 903px;
			text-align: center;
		}

		th
		{
			text-align: right;
			border-left: 15px solid rgba(0,0,0,0);
		}

		#qrcode
		{
			width:300px; 
			height:300px; 
			margin-top:15px;
			left: 713px;
			top: 600px;
			position: absolute;
			float: right;
		}

		.company
		{
			margin-top:15px;
			left: 380px;
			top: 600px;
			position: absolute;
			float: right;
		}

		</style>
	</head>
	<body>
		<div id="my-node">
			<br><br>
			<div id="cert">
				<span id="certificate">Certificate</span>
				<br><br>
				<div id="content">
					<table><tbody>
							<tr>
								<td><span style="font-size:30px"><i>This is to certify that  </i></span></td>
								<th><span style="font-size:50px">{{name}}</span></th>
							</tr>
							<tr>
								<td><span style="font-size:30px"><i>has completed the course  </i></span></td>
								<th><span style="font-size:50px"> {{course}}</span></th>
							</tr>
							<tr>
								<td><span style="font-size:30px">with score of  </span></td>
								<th><span style="font-size:50px">{{score}}</span></th>
							</tr>
						</tbody></table>
						<br><br>
				</div>
				<br><br>
				<div class="date">
					<span style="font-size:30px"><i>dated</i></span><br>
					<span style="font-size:35px">{{date}}</span>
				</div>
				<div class="company">
					<img src="logo.png" width="150px">
				</div>
				<div id="qrcode">
				</div>
				<br>
			</div>
		</div>
		</div> 

		<script type="text/javascript">
			var qrcode = new QRCode(document.getElementById("qrcode"), {
				width : 150,
				height : 150
			});

			qrcode.makeCode ("https://infocourse.techedu.cf/verify/cert/{{id}}");
		</script>
		<script src="bower_components/dom-to-image/dist/dom-to-image.min.js"> </script>
		<script type="text/javascript"> 
			var node = document.getElementById('my-node');

			domtoimage.toPng(document.getElementById('my-node'))
			.then(function (dataUrl) {
				var img = new Image();
				img.src = dataUrl;
				document.body = img;
			})
			.catch(function (error) {
				console.error('oops, something went wrong!', error);
			});
		</script>
	</body>

</html>
