<div>
    @if(session()->has('success'))
    <div id="alert" class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('success')}}</strong>
    </div>
    @endif
    @if(session()->has('error'))
    <div id="alert" class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('error')}}</strong>
    </div>
    @endif
    @if(session()->has('warning'))
    <div id="alert" class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('warning')}}</strong>
    </div>
    @endif
    @if(session()->has('danger'))
    <div id="alert" class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('danger')}}</strong>
    </div>
    @endif
    @if(session()->has('info'))
    <div id="alert" class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('info')}}</strong>
    </div>
    @endif
    @if(session()->has('outOfStock'))
    <div id="alert" class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('outOfStock')}}</strong>
    </div>
    @endif
    @if(session()->has('refill'))
    <div id="alert" class="alert alert-secondary alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{session('refill')}}</strong>
    </div>
    @endif
    @if($errors->any())
    <div id="alert" class="alert alert-secondary alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>