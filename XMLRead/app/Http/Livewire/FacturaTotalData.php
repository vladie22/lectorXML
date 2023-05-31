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
    public $folioAlfa, $cantidad, $cantidadTotalFacturas,$descripcion,$generarFactura = false;
    public $search,  $searchOptions = 'folio', $limit = 5,$cantidadTotalAlfaNueva;
    public $searchData, $searchOptionsData = 'uuid',$array = array(),$hideCancelar = false;

    protected $rules = [
        'folioAlfa' => 'required',
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
        if(FacturaAlfa::where('folio',$this->folioAlfa)->exists() == true){
            $this->hideCancelar = true;
        }else{
            $this->hideCancelar = false;
        }
        $search = '%' . $this->search . '%';
        $searchData = '%' . $this->searchData . '%';
        $searchOptions = $this->searchOptions;
        $searchOptionsData = $this->searchOptionsData;
        $limit = $this->limit;
        $cantidadTotal = QuantityData::sum('cantidad_total');
        $cantidadTotalDerivas = XmlData::sum('cantidad');
        $cantidadTotalAlfa = XmlData::where('folioAlfa','!=',null)->sum('cantidad');
        // $cantidadTotalAlfa = FacturaAlfa::sum('cantidad');
        //Kilos of the new facturaAlfa
        $this->cantidadTotalAlfaNueva = XmlData::where('folioAlfa',$this->folioAlfa)->sum('cantidad');
        //Validate if kilos of each deriva ar equal to kilos for each cooperativa
        if($cantidadTotal == $cantidadTotalDerivas){
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
        $facturaExist = FacturaAlfa::where('folio',$this->folioAlfa)->exists();
        XmlData::where('id',$id)->update(['folioAlfa' => $this->folioAlfa,
                                        'estado' => 'Usado']);
        if($facturaExist == true){
            $cantidad = floatVal(XmlData::where('id',$id)->first()->cantidad);
            $total = $cantidad * 330;
            FacturaAlfa::where('folio',$this->folioAlfa)->increment('cantidad',$cantidad);
            FacturaAlfa::where('folio',$this->folioAlfa)->increment('total',$total);
            $this->toast('success','Se ha actualizado con exito!');
        }else{
            $this->toast('success','La deriva se ha agreado a la factura con exito!');
        }

    }
    public function sinUsar($id)
    {
        $facturaExist = FacturaAlfa::where('folio',$this->folioAlfa)->exists();
        XmlData::where('id',$id)->update(['folioAlfa' => null,
                                            'estado' => 'Sin usar']);
        if($facturaExist == true){
            $cantidad = floatVal(XmlData::where('id',$id)->first()->cantidad);
            $total = $cantidad * 330;
            FacturaAlfa::where('folio',$this->folioAlfa)->decrement('cantidad',$cantidad);
            FacturaAlfa::where('folio',$this->folioAlfa)->decrement('total',$total);
            $this->toast('success','Se libero deriva de la factura con folio: '.$this->folioAlfa);
        }else{
            $this->toast('success','Cambio realizado con exito!');
        }
    }

    public function generateFactura()
    {
        $this->validate();
        $facturaExist = FacturaAlfa::where('folio',$this->folioAlfa)->exists();
        $derivas = XmlData::where('folioAlfa',$this->folioAlfa)->get();
        for($i=0; $i<count($derivas); $i++)
        {
            array_push($this->array,$derivas[$i]->nombre.' FOLIO: '.substr($derivas[$i]->uuid,0,8).' '.$derivas[$i]->arribo);
        }
        $text = implode(". ",$this->array);
        $this->descripcion ='ESTA FACTURA SE DERIVA DE LAS SIGUIENTES COOPERATIVAS Y SE AMPARA CON LOS SIGUIENTES ARRIBOS: '.$text.'.';
        $total = $this->cantidadTotalAlfaNueva * 330;
            if($facturaExist == false){
                FacturaAlfa::updateOrCreate([
                    'folio' => $this->folioAlfa,
                    'cantidad' => $this->cantidadTotalAlfaNueva,
                    'total' => $total,
                    'descripcion' => $this->descripcion
                ]);
                $this->alert('success','Factura Alfa registrada exitosamente!');
            }else{
                FacturaAlfa::where('folio',$this->folioAlfa)->update([
                    'cantidad' => $this->cantidadTotalAlfaNueva,
                    'total' => $total,
                    'descripcion' => $this->descripcion
                ]);
                $this->alert('success','Factura Alfa ha sido actualizada!');
            }

    }
}
