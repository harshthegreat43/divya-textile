
@if(session()->has('success'))
<div class="alert bg-green alert-dimissible alert-block">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>	
        <strong>{{session()->get('success')}}</strong>
</div>
@endif

@if(session()->has('error'))
<div class="alert bg-red alert-dimissible alert-block">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>	
        <strong>{{session()->get('error')}}</strong>
</div>
@endif

@if(session()->has('warning'))
<div class="alert bg-deep-orange alert-dimissible alert-block">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>	
	<strong>{{session()->get('warning')}}</strong>
</div>
@endif


@if(session()->has('info'))
<div class="alert bg-blue alert-dimissible alert-block">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>	
	<strong>{{session()->get('info')}}</strong>
</div>
@endif


