<header>
	<center><a href="{{ url('/') }}" class="logo"><img src="/img/logo.png" alt="logo" /></a></center>
	<div class="topmenu">{!! $topmenu !!}</div>
</header>
<div class="search">
	<form action="{{ route('site.search') }}" method="GET" class="search-form">
		<input name="name" type="text" value="" placeholder="Tìm kiếm">
		<input name="search-button" type="submit" value="Tìm kiếm">
    </form>
</div>
