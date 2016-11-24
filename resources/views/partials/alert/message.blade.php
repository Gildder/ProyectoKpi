@if(Session::has('update'))
    <div class='alert alert-success' role="alert">
       <strong>{{Session::get('update')}}</strong>
    </div>
@endif

@if(Session::has('save'))
    <div class='alert alert-success' role="alert">
       <strong>{{Session::get('save')}}</strong>
    </div>
@endif

