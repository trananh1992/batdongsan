<?php /* D:\xampp\htdocs\batdongsan\resources\views/front/layouts/index.blade.php */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Đăng tin mua bán bất động sản</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?php echo e(asset('img/core-img/favicon.ico')); ?>">

    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/customstyle.css')); ?>">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="south-load"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area" style="display: none;">
            <div class="h-100 d-md-flex justify-content-between align-items-center">
                <div class="email-address">
                    <a href="mailto:contact@southtemplate.com">contact@southtemplate.com</a>
                </div>
                <div class="phone-number d-flex">
                    <div class="icon">
                        <img src="<?php echo e(URL::to('img/icons/phone-call.png')); ?>" alt="">
                    </div>
                    <div class="number">
                        <a href="tel:+45 677 8993000 223">+45 677 8993000 223</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header Area -->
        <div class="main-header-area" id="stickyHeader">
            <div class="classy-nav-container breakpoint-off">
                <!-- Classy Menu -->
                <?php echo $__env->make('front.layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <?php echo $__env->make('front.layouts.slides', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Advance Search Area Start ##### -->
    <?php echo $__env->make('front.layouts.main_search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ##### Advance Search Area End ##### -->

    <!-- #### Content #### Start-->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- #### Content #### End-->
    
    <!-- ##### Footer Area Start ##### -->
    <?php echo $__env->make('front.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?php echo e(asset('js/jquery/jquery-2.2.4.min.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <!-- Plugins js -->
    <script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('js/classy-nav.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <!-- Active js -->
    <script src="<?php echo e(asset('js/active.js')); ?>"></script>


    <script type="text/javascript">
     //Base url
    var base_url = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';


  //Ajax thêm tỉnh
  $('#formsearch').on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var post = $(this).attr('method');
    $.ajax({
      type : post,
      url : url,
      data : data,
      dataType : 'json',    
      success:function(data)
      {
        console.log(data);
        if($.isEmptyObject(data.error))
        {
          $( '#hienthitimkiem' ).html( data);
        }
        else
        {
         printErrorsearch(data.error);
       }
     }
   });

  }); 

  function printErrorsearch (responses)
  {
    var messageHtml = '<div class="alert alert-danger"><ul>';
    for (var key in responses) 
    {
      if (responses.hasOwnProperty(key)) 
      {
        var val = responses[key];
        messageHtml += '<li>' + val + '</li>'; 
      }
    }
    messageHtml += '</ul></div>';
    $( '#ketquathemtinh' ).html( messageHtml );
  }
    // --------------------------------------
 $("#sltinh").change(function(){
  tinh = $('#sltinh').val();
  var url = base_url+'getdshuyen/'+tinh;
  if(tinh != 0){
    $.ajax({
      type : 'get',
      url : url,
      // data : data,
      dataType : 'json',    
      success:function(data)
      {
        console.log(data);
        if($.isEmptyObject(data.error))
        {
          $('#slhuyen').empty();
          var huyen = document.getElementById("slhuyen");
          var option = document.createElement("option");
          option.text = "---Chọn quận, huyện---";
          option.value = '0';
          huyen.add(option);
          for (i = 0; i < data.length; i++) { 
            option = document.createElement("option");
            option.text = data[i]['ten'];
            option.value = data[i]['id'];
            huyen.add(option);
          }
        }
     }
   });
    
  }else{
    $('#slhuyen').empty(); 
    $('#slxa').empty();
}
});
 $("#slhuyen").change(function(){
  huyen = $("#slhuyen").val();
  var url = base_url+'getdsxa/'+tinh+'/'+huyen;
  if(huyen != 0){
    $.ajax({
      type : 'get',
      url : url,
      // data : data,
      dataType : 'json',    
      success:function(data)
      {
        console.log(data);
        if($.isEmptyObject(data.error))
        {
          $('#slxa').empty();
          var xa = document.getElementById("slxa");
          var option = document.createElement("option");
          option.text = "---Chọn phường, xã---";
          option.value = '0';
          xa.add(option);
          for (i = 0; i < data.length; i++) { 
            option = document.createElement("option");
            option.text = data[i]['ten'];
            option.value = data[i]['id'];
            xa.add(option);
          }
        }
     }
   });    
  }else{
            $('#slxa').empty();
    }
});
    </script>
</body>

</html>