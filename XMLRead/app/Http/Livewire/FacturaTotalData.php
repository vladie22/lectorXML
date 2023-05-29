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
    public $folioAlfa, $cantidad, $cantidadTotalFacturas,$generarFactura = false;
    public $search,  $searchOptions = 'folio', $limit = 5,$cantidadTotalAlfaNueva;
    public $searchData, $searchOptionsData = 'uuid';

    protected $rules = [
        'folio' => 'required',
        'cantidad' => 'required'
    ];

    public function generarFacturaShow()
    {
        $this->generarFactura = true;
    }
    public function generarFacturaClose()
    {
        $this->generarFactura = false;
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $searchData = '%' . $this->searchData . '%';
        $searchOptions = $this->searchOptions;
        $searchOptionsData = $this->searchOptionsData;
        $limit = $this->limit;
        $cantidadTotal = QuantityData::sum('cantidad_total');
        $cantidadTotal2 = XmlData::sum('cantidad');
        $cantidadTotalAlfa = FacturaAlfa::sum('cantidad');
        $this->cantidadTotalAlfaNueva = XmlData::where('folioAlfa',$this->folioAlfa)->sum('cantidad');
        if($cantidadTotal == $cantidadTotal2){
            $this->cantidadTotalFacturas = abs($cantidadTotalAlfa-$cantidadTotal);
        }
        return view('livewire.factura-total-data',[
            'derivas' => XmlData::where('folioAlfa',$this->folioAlfa)->orWhere('estado','Usado')
                                    ->where('folioAlfa',null)->orWhere('estado','Sin usar')
                                    ->orderBy('id','DESC')->paginate($limit),
            'busquedas' => XmlData::where('folioAlfa',$this->folioAlfa)->orWhere('folioAlfa',null)->where($searchOptionsData, 'like', $searchData)->where('estado','Sin usar')->orderBy('id','DESC')->paginate($limit),
            'facturas' => FacturaAlfa::orderBy('cantidad','DESC')->paginate($limit),
            'searchFacturas' => FacturaAlfa::where($searchOptions, 'like', $search)->orderBy('cantidad','DESC')->simplePaginate($limit)
        ]);
    }

    public function usado($id)
    {
        XmlData::where('id',$id)->update(['folioAlfa' => $this->folioAlfa,
                                            'estado' => 'Usado']);
        $this->toast('success','La deriva se ha agreado a la factura con exito!');
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
