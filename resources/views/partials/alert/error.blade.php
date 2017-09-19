@if($errors->has())
    @foreach ($errors->all('<p>:message</p>') as $message)
        <div  class="alert alert-danger notificaciones" role="alert" >
        <button type="button" class="close pull-right" data-dismiss="alert">&times;</button>
            {!! $message !!}
        </div>
    @endforeach
@endif

@if (Session::has('message'))
    <div class="alert alert-success notificaciones" role="alert">{{ Session::get('message') }}
		<button type="button" class="close pull-right" data-dismiss="alert" >&times;</button>
    </div>
@endif
{{--<script>--}}
    {{--$(document).ready(function () {--}}
        {{--show(100000);--}}
    {{--});--}}

    {{--function show ( duration) {--}}
        {{--var id = 'alert' + Math.floor((Math.random()*1000)+1);--}}
        {{--var elem = $('.notificaciones');--}}
        {{--doAnimation(elem, duration);--}}
        {{--elem.hide();--}}
        {{--return elem;--}}
    {{--}--}}

    {{--function doAnimation(elem, duration) {--}}
        {{--if(duration == undefined) {--}}
            {{--duration = 10000;--}}
        {{--}--}}
        {{--if(this.timeoutId != null) {--}}
            {{--window.clearTimeout(this.timeoutId);--}}
        {{--}--}}
        {{--window.setTimeout(function () {--}}
            {{--hide(elem.attr('id'));--}}
        {{--}, duration);--}}
        {{--elem.fadeIn();--}}
    {{--}--}}

    {{--function hide(id) {--}}
        {{--$('#' + id).fadeOut(5000, function() {--}}
            {{--$(this).remove();--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}
<style>
    .notificaciones{
        z-index: 99999;
        position: fixed;
        top: 54px;
        left: 50%;
        width: 500px;
        margin-left: -250px;

    }
</style>
