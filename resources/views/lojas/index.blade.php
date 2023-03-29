@extends('general.index', $setup);
@section('thead')
<th scope="col">{{ __('Name') }}</th>
<th scope="col">{{ __('Logo') }}</th>
<th scope="col">{{ __('Owner') }}</th>
<th scope="col">{{ __('Owner email') }}</th>
<th scope="col">{{ __('Creation Date') }}</th>
<th scope="col">{{ __('Active') }}</th>
<th scope="col"></th>
@endsection
@section('tbody')
@foreach ($setup['items'] as $item)
<tr>
    <td>{{ $item->name }}</td>
    <td><img class="rounded" src={{ $item->logo }} width="80px"></img></td>
    <td>  
       <?php 
            echo \App\User::where(['id' => $item->user_id ])->first()->name; 
       ?>
    </td>
    <td>
        <?php 
           echo \App\User::where(['id' => $item->user_id])->first()->email; 
       ?>    
    </td>
    <td>{{ $item->created_at->setTimezone('America/Sao_Paulo')->format(config('settings.datetime_display_format'))}}</td>
    <td>
    @if($item->active == 1)
        <span class="badge badge-success">{{ __('Active') }}</span>
    @else
        <span class="badge badge-warning">{{ __('Not active') }}</span>
    @endif    
    </td>
    <td>
        <div class="row">
            <div class="col">
            <form action="{{ route('admin.restaurants.destroy', $item) }}" method="post">
                    @csrf
                    @method('delete')
                    @if($item->active == 0)
                        <a class="btn btn-success btn-sm" href="{{ route('restaurant.activate', $item) }}">{{ __('Activate') }}</a>
                    @else
                    <button type="button" class="btn btn-warning btn-sm" onclick="confirm('{{ __("Are you sure you want to deactivate this restaurant?") }}') ? this.parentElement.submit() : ''">
                        {{ __('Desativar') }}
                    </button>
                @endif
            </form>
            </div>
            <div class="col"> 
            <a class="btn btn-primary btn-sm" href="{{ route('admin.restaurants.loginas', $item) }}">{{ __('Login as') }}</a>
            </div>
        </div>  
    </td>
</tr> 
@endforeach

@endsection