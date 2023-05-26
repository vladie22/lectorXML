<?php

namespace App\Http\Livewire;

use App\Models\FacturaAlfa;
use App\Models\QuantityData;
use App\Models\XmlData;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FacturaTotalData extends Component
{

    use LivewireAlert;
    public $folio, $cantidad, $cantidadTotalFacturas;
    public $search,  $searchOptions = 'folio', $limit = 5;

    protected $rules = [
        'folio' => 'required',
        'cantidad' => 'required'
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $searchOptions = $this->searchOptions;
        $limit = $this->limit;
        $cantidadTotal = QuantityData::sum('cantidad_total');
        $cantidadTotal2 = XmlData::sum('cantidad');
        $cantidadTotalAlfa = FacturaAlfa::sum('cantidad');
        if($cantidadTotal == $cantidadTotal2){
            $this->cantidadTotalFacturas = abs($cantidadTotalAlfa-$cantidadTotal);
        }
        return view('livewire.factura-total-data',[
            'facturas' => FacturaAlfa::orderBy('cantidad','DESC')->paginate($limit),
            'searchFacturas' => FacturaAlfa::where($searchOptions, 'like', $search)->orderBy('cantidad','DESC')->simplePaginate($limit)
        ]);
    }

    public function generate()
    {
        $this->validate();
        $total = $this->cantidad * 330;
        if($this->cantidad <= $this->cantidadTotalFacturas){
            FacturaAlfa::updateOrCreate([
                'folio' => $this->folio,
                'cantidad' => $this->cantidad,
                'total' => $total
            ]);
            $this->alert('success','Factura Alfa registrada exitosamente!');
        }else{
            $this->alert('error','La cantidad de la factura es mayor a la cantidad de kilos');
        }
    }
}
