@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

    <h1>DESKTOP VIEW</h1>

    <!-- Redirect to mobile login -->
    <script type='text/javascript'>
        location.href='https://repotestplatform5937.yooty.io/profile';
    </script>

@endsection

@elsedesktop

<!-- Mobile view -->
@extends('yootymob')

@section('content')
    <h1>MOBILE VIEW</h1>

<!-- Redirect to mobile login -->
    <script type='text/javascript'>
        location.href='https://repotestplatform5937.yooty.io/profile';
    </script>
@endsection
@enddesktop
