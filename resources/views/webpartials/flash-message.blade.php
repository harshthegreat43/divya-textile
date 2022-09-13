
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>{{session()->get('success')}}</strong>
  </div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>{{session()->get('error')}}</strong>
  </div>
@endif

@if(session()->has('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>{{session()->get('warning')}}</strong>
  </div>
@endif


@if(session()->has('info'))
<div class="alert alert-info alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>{{session()->get('info')}}</strong>
  </div>
@endif


