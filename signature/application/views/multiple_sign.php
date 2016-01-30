<title>Multiple Signature </title>
<body>
	<style type="text/css">
		#errors:empty{display: none;}
		input[type="checkbox"]:not(old), input[type="radio"]:not(old){ opacity:10;}
		img{    margin: 17px;}
	</style>
	<form method="post">
		<section>

			<div class="container">
				<div class="boxarea">
					<h1>Multi Signatures</h1>

					<div class="signatures-box">
						<div class="row">
							<div id="appendsignature">
								<ul>
									<li class="col-md-4">
										<input type="text" class="form-control" placeholder="Enter Name" id="name1">
									</li>
									<li class="col-md-2">
										<button class="btn signbtn" type="button" id="sbnt1">Sign 1</button>
									</li>
									<li class="col-md-3">
										<div id="previewsign1" class="previewsign"></div>
									</li>
									<li class="col-md-2">
										<input type="checkbox" id="signcomplete1">
										<input type="hidden" id="appendcount1" value="1">
									</li>
								</ul>
							</div>
							<div class="col-md-12">
								<button class="btn signappend-btn" type="button">Add More</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="positions-fix">
			<ul>
				<li class="pull-left">
					<input type="hidden" class="form-control" id="numbercount" value="1">
				</li>
				<li class="pull-right">
					<button type="submit" class="btn btn-success" id="submit" name="submit">Submit</button>
					<a href="<?php echo base_url();?>welcome" class="btn btn-primary">Go to Single Sign Demo</a>
				</li>
				<li></li>
			</ul>
		</div>


		<div class="modal fade" id="sign-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="signature-pad">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"><i class="fa fa-pencil"></i> Add Signature</h4>
					</div>
					<div class="modal-body">
						<canvas width="570" height="318"></canvas>

						<!--Signature Values--> 

						<input type="hidden" id="rowno" name="rowno" value="<?php echo rand();?>">

						<input type="hidden" id="signname" value="">
						
						<input type="hidden" id="scount" value="">
						<!----> 

					</div>
					<div class="modal-footer clearfix">
						<button type="button"  id="save2"  class="btn themecl1" data-action="save" ><i class="fa fa-check"></i> Save</button>
						<button type="button" data-action="clear" class="btn themecl2"><i class="fa fa-trash-o"></i> Clear</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button> 
					</div>
				</div>
				<!-- /.modal-content --> 
			</div>
			<!-- /.modal-dialog --> 
		</div>

		<!-- Error  displays here  -->
		<div class="positions-topfix">
			<div class="alert alert-danger" id="errors"></div>
		</div>


	</form>
	<script>
		$(document).ready(function() {

			$('ul li').each(function(i) {
				$(this).addClass('jag'+i+'');
				if(i % 2 == 0) {
					$(this).addClass("noRightMargin");
				}


			});


			$("#sbnt1").on("click", function () {

				if($("#name1").val()=="")
				{

					$('#errors').html('Enter The Name');
					$("#name1").css("border-color", "red");  
					$("#name1").focus();
					$("#name1").keyup(function() {

						$(this).css("border-color", "black");

					});
					return false;
				}
				else
				{


					$('#sign-modal').modal('show');

					var snames = $(this).closest("ul").find("input[id='name1']").val();
					var scount = $(this).closest("ul").find("input[id='appendcount1']").val();

					$("#signname").val(snames);
					$("#scount").val(scount);

				}
			});


			$(".signappend-btn").click(function(i){




				var numbercount=$('#numbercount').val();
				var numbercounttotal=Number(numbercount)+1;
				$('#numbercount').val(numbercounttotal);
				$("#appendsignature").append('<ul>'+
					' <li class="col-md-4">'+
					'<input type="text" class="form-control" placeholder="Enter Name" id="name'+i+'">'+
					' </li>'+
					'<li class="col-md-2">'+
					' <button class="btn signbtn" type="button" id="sbnt'+numbercounttotal+'">Sign '+numbercounttotal+'</button>'+
					'<button class="btn btn-danger remove" type="button">Remove</button>'+
					' </li>'+
					'<li class="col-md-3">'+
					'<div id="previewsign'+numbercounttotal+'" class="previewsign"></div>'+

					' </li>'+
					'<li class="col-md-2">'+
					' <input type="checkbox" id="signcomplete'+numbercounttotal+'">'+
					' <input type="hidden" id="appendcount'+numbercounttotal+'" value="'+numbercounttotal+'">'+

					' </li>'+
					' </ul>'

					);
				$("#sbnt"+numbercounttotal+"").on("click", function () {

					if($("#name"+numbercounttotal+"").val()=="")
					{

						$('#errors').html('Enter The Name');
						$("#name"+numbercounttotal+"").css("border-color", "red");  
						$("#name"+numbercounttotal+"").focus();
						$("#name"+numbercounttotal+"").keyup(function() {

							$(this).css("border-color", "black");

						});
						return false;
					}
					else
					{
						$('#sign-modal').modal('show');


						var snames = $(this).closest("ul").find("input[id='name"+numbercounttotal+"']").val();
						var scount = $(this).closest("ul").find("input[id='appendcount"+numbercounttotal+"']").val();
						$("#signname").val(snames);
						$("#scount").val(scount); 
					}
				});

				$(".remove").click(function(event) {
					event.preventDefault();
					$(this).parents('ul').remove();

				});	
			});
});
</script> 

<script>



	var wrapper = document.getElementById("signature-pad"),
	clearButton = wrapper.querySelector("[data-action=clear]"),
	saveButton = wrapper.querySelector("[data-action=save]"),
	canvas = wrapper.querySelector("canvas"),
	signaturePad;


	function resizeCanvas() {
		var ratio =  window.devicePixelRatio || 1;
		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);
	}



	/*clear the signature pad */
	signaturePad = new SignaturePad(canvas);
	clearButton.addEventListener("click", function (event) {
		signaturePad.clear();
	});



	/*validate */
	saveButton.addEventListener("click", function (event) {
		if (signaturePad.isEmpty()) {

			$("#errors").addClass('shake');
			$("#errors").show();
			$("#errors").delay(4000).hide(200, function() {
				$("#errors").hide();
			});
			$('#errors').html('Please provide signature first');
		} else {

			$('#error').html('');

			$('#sign-modal').modal('hide');
			
			var rowno=$('#rowno').val();
			var signname=$('#signname').val();

			var appendcount=$('#scount').val();

			$( '#signcomplete'+appendcount+'' ).attr( 'checked', $( this ).is( ':checked' ) ? 'checked' : '' );
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>welcome/get_multiple",
				data: {image: signaturePad.toDataURL(),rowno: rowno,signname: signname,appendcount: appendcount,},
				success: function(datas1){
					signaturePad.clear();

					$('#previewsign'+appendcount+'').html(datas1);


				}
			});
		}
	}); 





	$('#submit').click(function(){

		$("#errors").addClass('shake');
		$("#errors").show();
		$("#errors").delay(4000).hide(200, function() {
			$("#errors").hide();
		});

		var hidden_count=$('#numbercount');
		var error=$('#errors');	

		for(var i=1;i<=hidden_count.val();i++)
		{
			
			var name=$('#name'+i);
			var signcomplete=$('#signcomplete'+i);
			
			if(name.val()=="")
			{

				$('#errors').html('Enter The Name');
				name.css("border-color", "red");  
				name.focus();
				name.keyup(function() {

					$(this).css("border-color", "black");

				});
				return false;
			}
			else
			{
				$('#errors').html('');

			}

			if(signcomplete.is(":checked"))
			{

				$('#errors').html('');
			}
			else
			{

				$('#errors').html('Please Sign');
				signcomplete.css("border-color", "red");  
				signcomplete.focus();
				signcomplete.keyup(function() {

					$(this).css("border-color", "black");

				});
				return false;
			}

		}

	});
	
</script>


<style type="text/css">
	.previewsign{
		height:83px;
	}

	img
	{
		margin: 0px;
	}
</style>

</body>
</html>