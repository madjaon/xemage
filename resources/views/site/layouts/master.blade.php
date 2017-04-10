@include('site.common.head')
<body>

@if(isset($isPost) && $isPost == true && isset($configfbappid) && $configfbappid != '')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{{ $configfbappid }}',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
@endif

<div class="container">

@include('site.common.top')

<div class="main">

  @include('site.common.ad', ['posPc' => 1, 'posMobile' => 2])

	<div class="content">
		@yield('content')
	</div>

  @include('site.common.lib')

  @include('site.common.ad', ['posPc' => 3, 'posMobile' => 4])

</div>

@include('site.common.bottom')

</div>

</body>
</html>
