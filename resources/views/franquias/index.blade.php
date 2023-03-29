@extends('general.index', $setup);
@section('thead')
    <th>{{ __('Nome') }}</th>
    <th>{{ __('Proprietário') }}</th>
    <th>{{ __('E-mail') }}</th>
    <th>{{ __('Celular') }}</th>  
    <th>{{ __('Estado') }}</th> 
    <th>{{ __('Opções') }}</th> 
@endsection
@section('tbody')
@foreach ($setup['items'] as $item)  
<tr>
    <td>{{ $item->name }}</td>
    <td>
    <?php 
        $dados = \App\User::where(['id' => $item->user_id ])->first(); 
        echo $dados->name;
    ?></td>
    <td>
    <?php 
        echo $dados->email; 
    ?>
    </td>
    <td>
    <?php 
        echo $dados->phone; 
    ?>
    </td>  
    <td>
         
        @if($item->active == 1)
            <span class="badge badge-success">{{ __('Active') }}</span>
        @else
            <span class="badge badge-warning">{{ __('Not active') }}</span>
        @endif
    </td>  
    <td>
        <span>
            <a href="restaurants/<?= $item->id; ?>/edit" class="btn btn-primary d-none btn-sm">{{ __('Edit') }}</a>
        </span>
        <div class="row">
            <div class="col">
            <form action="{{ route('admin.restaurants.destroy', $item) }}" method="post">
                    @csrf
                    @method('delete')
                    @if($item->active == 0)
                        <a class="btn btn-success btn-sm" href="{{ route('restaurant.activate', $item) }}">{{ __('Activate') }}</a>
                    @else
                    <button type="button" class="btn btn-warning btn-sm"onclick="confirm('{{ __("Are you sure you want to deactivate this restaurant?") }}') ? this.parentElement.submit() : ''">
                        {{ __('Desativar') }}
                    </button>
                @endif
            </form>
            </div>
            <div class="col">
            <a href="removestore/<?= $item->id; ?>" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
            </div>
        </div>
    </td>
</tr> 
@endforeach

@endsection