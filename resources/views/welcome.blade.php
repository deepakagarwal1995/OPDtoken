
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DR. VIJAYANT GOVINDA GUPTA </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ config('app.url') }}/assets/images/contact-us-page-12-e1713074250371.webp" type="image/x-icon">
    <link rel="icon" href="{{ config('app.url') }}/assets/images/contact-us-page-12-e1713074250371.webp" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ config('app.url') }}/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .youn{
        display: none
    }
    .refresh{
        text-align: center;
            position: fixed;
    z-index: 1000;
    top: 50%;
    background: #000;
    border: 0;
    border-radius: 0;
    box-shadow: 1px 1px 6px #403d3d;
    }
  </style>
</head>
<body>

<div class="p-2 bg-primary text-white text-start d-none d-lg-block top-bar">
  <div class="container">
  <img decoding="async"
    src="{{ config('app.url') }}/assets/images/contact-us-page-12-e1713074250371.webp"
    class="logo" alt="">
</div>
</div>

<section style="    min-height: calc(100vh - 187px);
    display: flex;
    margin: auto;
    padding: 10px;">
<div class="container m-auto ">
  <div class="row">
    <div class="col-md-6 d-inline-flex align-items-center justify-content-center text-center">
      <div>

      <img decoding="async" src="{{ config('app.url') }}/assets/images/Dr.-Vineet-Govinda-Gupta-1024x1013.png" class="img-fluid drimage" alt="" style="    max-height: 200px;    margin: auto;
    display: block;">
      <h4 class="drName">DR. VIJAYANT GOVINDA GUPTA</h4>
      <p class="heading-title">Senior Consultant Urologist and Andrologist</p>
      <ul class="nav nav-pills d-flex justify-content-center social-links mb-5">
        <li class="facebook">
          <a  href="https://www.facebook.com/drvijayantgovinda" target="_blank"><i class="fab fa-facebook-f"></i></a>
        </li>
        <li class="instagram">
          <a href="https://www.instagram.com/drvggupta/" target="_blank"><i class="fab fa-instagram"></i></a>
        </li>
        <li class="twitter">
          <a href="https://twitter.com/drvggupta" target="_blank"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="linkedin">
          <a href="https://in.linkedin.com/in/drvijayantgovinda" target="_blank"><i class="fab fa-linkedin"></i></a>
        </li>
        <li class="youtube">
          <a href="https://www.youtube.com/@Drvijayantgovinda" target="_blank"><i class="fab fa-youtube"></i></a>
        </li>
      </ul>
      </div>
    </div>
    <div class="col-md-6">




      {{-- STEP1 END --}}
      <div id="image"> <img decoding="async" src="{{ config('app.url') }}/assets/images/loading.webp" class="img-fluid " alt="" style="    max-height: 200px;    margin: auto;
    display: block;"></div>

      <div class="dynamic_content">


      </div>


      {{-- STEP2 --}}

<div class="youn">
    <div class="d-flex justify-content-center py-2 px-4 bg-primary mt-3">

        <div class="cTime">
          <h3 class="title">
      YOUR NUMBER WILL COME AFTER
          </h3>
        </div>


      </div>

      <div class="d-flex justify-content-evenly my-3 come-after ">

        <div class=" bg-primary p-3 text-center">
          <h3 class="title">
          <span class="myHr">0</span><br>
          HOURS
          </h3>
        </div>
        <div class=" bg-primary p-3 text-center">
          <h3 class="title">
            <span class="myMin">0</span><br>
            MINUTES
          </h3>



        </div>

      </div>
</div>
    </div>
  </div>
</div>
</section>

<div class="mt-1 p-4 bg-primary text-white text-start">
  <div class="container">
   <div class="row">
    <div class="col-md-6"><p class="mb-0 ftext">Copyright © 2024 | Govinda Medicenter | All Rights Reserved </p></div>
    <div class="col-md-6"><p class="mb-0 ftext text-sm-end">Design & Develop By <a href="https://www.papercodetech.com/" target="_blank" style="    color: #fff;
    text-decoration: none;">Paper Code Technologies</a>
</p></div>
    </div>

</div></div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

     update_data();
    $(document).on('click','#checkMyTime',function() {

  var token = $( "#MyToken" ).val();
  if(token == ''){
    alert('Please Enter Your Token Number');
    return false;
  }
  $.ajax({
         type:'POST',
         url:'{{route('check_my_time')}}',
         data: {"token": token},
         headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                        },



         success:function(data){
            var data = $.parseJSON(data);
            if(data.status == 1){
               $(".youn").show();
                $(".myHr").html(data.hours);
                $(".myMin").html(data.minutes);
            }else{
                alert(data.messg);
            }
         }
      });

});

function update_data(){
     $(".dynamic_content").html('');
    $.ajax({
         type:'POST',
         url:'{{route('update_data')}}',
         headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                        },
                        beforeSend: function(){
        $('#image').show();
    },
    complete: function(){
        $('#image').hide();
    },
         success:function(data){
           $(".dynamic_content").html(data);
         }
      });
setTimeout(update_data, 20000);
}


</script>
</body>
</html>
