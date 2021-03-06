@extends('master.index')

@section('content')
<div class="container">

    @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
       The admin can view this
    @elseif(Sentry::check() && Sentry::getUser()->inGroup(Sentry::findGroupByName('Supplier')))
       Suppliers see this.
    @elseif(Sentry::check() && Sentry::getUser()->inGroup(Sentry::findGroupByName('Scheduler')))
       Schedulers see this.
    @else
       Non Admin/Supplier/Scheduler can see this.
    @endif


<br />
    Anyone Can see this

</div>

    @endsection