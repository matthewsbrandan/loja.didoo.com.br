@if(isset($restorant) && $restorant->has_delivery_tax)
<div class="modal fade" id="modal-taxes" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Delivery fee') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="col-md-10 offset-md-1">
                            <table class="m-auto table">
                                <thead>
                                    <th>{{ __('Neighborhood') }}</th>
                                    <th class="text-right">{{ __('Delivery fee') }}</th>
                                </thead>
                                <tbody>
                                    @php
                                        $arrayTaxes = $restorant->arrayTaxes();
                                        $defaultTax = null;
                                    @endphp
                                    @foreach($arrayTaxes as $tax)
                                        <?php
                                            if($tax->neighborhood == 'Standard Tax') $defaultTax = $tax;
                                            else{
                                        ?>
                                            <tr>
                                                <td>{{ $tax->neighborhood }}</td>
                                                <td class="text-right">
                                                    R$ {{ number_format($tax->tax, 2, ',', '.') }}
                                                </td> 
                                            <tr>
                                        <?php } ?>
                                    @endforeach
                                    <tr>
                                        <th>{{ __('Other neighborhoods') }}</th>
                                        <td class="text-right">
                                            {{
                                                $defaultTax ?
                                                    "R$ ".number_format($defaultTax->tax, 2, ',', '.') : 
                                                    __('To match')
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif