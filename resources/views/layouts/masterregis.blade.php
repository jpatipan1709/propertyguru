<html>
<head>
    <title>PropertyGURU</title>
    @include('layouts/header')
   
</head>
<body class="bg-white">
    @include('layouts/navbar')
        <div id="section" class="mb-5 pb-5">
                @yield('content')
        </div>    
    @include('layouts/footer')
</body>
<script>
function goBack() {
  window.history.back()
}
</script>    
</html>    