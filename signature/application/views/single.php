<script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/signature-pad.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
<body>


  <section>
    <div class="container">
      <div class="boxarea">
        <h1>Signature</h1>
        <div class="signature-pad" id="signature-pad">
          <div class="m-signature-pad">
            <div class="m-signature-pad-body">
              <canvas width="625" height="318"></canvas>
            </div>
          </div>
          <div class="m-signature-pad-footer">
            <button type="button"  id="save2" data-action="save" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
            <button type="button" data-action="clear"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</button>
           
          </div>
        </div>
      </div>
    </div>
  </section>

 <div class="img"></div>
<style type="text/css">
  .img
  {
        right: 0;
    position: absolute;
  }
</style>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning!</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          Sign before you submit!
        </div>
      </div>
    </div>
  </div>
</div>

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
    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
      signaturePad.clear();
    });
    saveButton.addEventListener("click", function (event) {
      
      if (signaturePad.isEmpty()) {
        $('#myModal').modal('show');
      }

      else {
       
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>welcome/get_sign",
          data: {'image': signaturePad.toDataURL()},
          success: function(datas1)
          {            
            signaturePad.clear();
            $('.img').html(datas1);
          }
        });
      }
    }); 

  </script>
</body>
</html>