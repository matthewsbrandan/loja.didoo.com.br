@extends('general.index', $setup);
@section('thead')
    <th>{{ __('Nome') }}</th>
    <th>{{ __('Proprietário') }}</th>
    <th>{{ __('E-mail') }}</th>
    <th>{{ __('Celular') }}</th> 
    <th>{{ __('Lojas') }}</th> 
    <th>{{ __('Opções') }}</th> 
@endsection
@section('tbody')
@foreach ($setup['items'] as $item)  
<tr>
    <td>{{ $item->franquia }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone }}</td> 
    <td><a href="{{ route("cities.edit",["city"=>$item->id]) }}" class="btn btn-primary btn-sm">{{ __('Ver Lojas') }}</a></td> 
    <td><a href="{{ route("cities.edit",["city"=>$item->id]) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a><a href="{{ route("cities.delete",["city"=>$item->id]) }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a></td>
</tr> 
@endforeach

@endsection