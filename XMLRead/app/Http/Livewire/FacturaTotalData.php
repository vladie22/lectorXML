<?php

namespace App\Http\Livewire;

use App\Models\XmlData;
use Livewire\Component;
use App\Models\FacturaAlfa;
use App\Models\QuantityData;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacturaTotalData extends Component
{
    use LivewireAlert;
    public $folioAlfa, $cantidad, $cantidadTotalFacturas, $descripcion, $generarFactura = false,
        $search,  $searchOptions = 'folio', $limit = 5, $cantidadTotalAlfaNueva,
        $searchData, $searchOptionsData = 'uuid', $array = array(), $folioAlfaExist = false,
        $cancelarUsado = array(), $showEdit = false, $folioAlfaEdit, $mobileMenu;

    protected $rules = [
        'folioAlfa' => 'required',
    ];

    public function render()
    {
        if (FacturaAlfa::where('folio', $this->folioAlfa)->exists() == true) {
            $this->folioAlfaExist = true;
        } else {
            $this->folioAlfaExist = false;
        }
        $search = '%' . $this->search . '%';
        $searchData = '%' . $this->searchData . '%';
        $searchOptions = $this->searchOptions;
        $searchOptionsData = $this->searchOptionsData;
        $limit = $this->limit;
        $cantidadTotal = QuantityData::sum('cantidad_total');
        $cantidadTotalDerivas = XmlData::sum('cantidad');
        $cantidadTotalAlfa = XmlData::where('folioAlfa', '!=', null)->sum('cantidad');
        //Kilos of the new facturaAlfa
        $this->cantidadTotalAlfaNueva = XmlData::where('folioAlfa', $this->folioAlfa)->sum('cantidad');
        //Validate if kilos of each deriva ar equal to kilos for each cooperativa
        if ($cantidadTotal == $cantidadTotalDerivas) {
            $this->cantidadTotalFacturas = abs($cantidadTotalAlfa - $cantidadTotal);
        }
        return view('livewire.factura-total-data', [
            'derivas' => XmlData::where('folioAlfa', $this->folioAlfa)->orWhere('estado', 'Usado')
                ->where('folioAlfa', null)->orWhere('estado', 'Sin usar')
                ->orderBy('id', 'DESC')->paginate($limit),
            'busquedas' => XmlData::where('folioAlfa', $this->folioAlfa)
                ->orWhere('folioAlfa', null)
                ->where($searchOptionsData, 'like', $searchData)
                ->where('estado', 'Sin usar')->orderBy('id', 'DESC')
                ->paginate($limit),
            'facturas' => FacturaAlfa::orderBy('cantidad', 'DESC')->paginate($limit),
            'searchFacturas' => FacturaAlfa::where($searchOptions, 'like', $search)
                ->orderBy('cantidad', 'DESC')->simplePaginate($limit)
        ]);
    }
    public function showMobileMenu()
    {
        if($this->mobileMenu == true)
        {
            $this->mobileMenu = false;
        }
        else
        {
            $this->mobileMenu = true;
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        redirect(route('login'));
    }

    public function usado($id)
    {
        array_push($this->cancelarUsado, $id);
        XmlData::where('id', $id)->update([
            'folioAlfa' => $this->folioAlfa,
            'estado' => 'Usado'
        ]);
        $this->alert('success', 'Se ha agregado deriva!');
    }

    public function sinUsar($id)
    {
        XmlData::where('id', $id)->update([
            'folioAlfa' => null,
            'estado' => 'Sin usar'
        ]);
        $this->alert('success', 'Se ha quitado deriva!');
    }

    public function generarFacturaShow()
    {
        $this->generarFactura = true;
    }

    public function generarFacturaClose()
    {
        //DISCARD CHANGES WHEN CLICKED ON "CANCELAR"
        $facturaAlfaExist = FacturaAlfa::where('folio', $this->folioAlfa)->exists();
        if ($this->folioAlfa && $facturaAlfaExist == false) {
            for ($i = 0; $i < count($this->cancelarUsado); $i++) {
                XmlData::where('id', $this->cancelarUsado[$i])->update([
                    'estado' => 'Sin usar',
                    'folioAlfa' => null
                ]);
            }
            $this->cancelarUsado = array();
            $this->generarFactura = false;
            $this->folioAlfa = null;
        } else {
            $this->cancelarUsado = array();
            $this->generarFactura = false;
            $this->folioAlfa = null;
        }
    }

    public function generateFactura()
    {
        $this->validate();
        $derivas = XmlData::where('folioAlfa', $this->folioAlfa)->get();
        for ($i = 0; $i < count($derivas); $i++) {
            array_push($this->array, $derivas[$i]->nombre . ' FOLIO: ' . substr($derivas[$i]->uuid, 0, 8) . ' ' . $derivas[$i]->arribo);
        }
        $text = implode(". ", $this->array);
        $this->descripcion = 'ESTA FACTURA SE DERIVA DE LAS SIGUIENTES COOPERATIVAS Y SE AMPARA CON LOS SIGUIENTES ARRIBOS: ' . $text . '.';
        $total = $this->cantidadTotalAlfaNueva * 330;

        FacturaAlfa::updateOrCreate([
            'folio' => $this->folioAlfa,
            'cantidad' => $this->cantidadTotalAlfaNueva,
            'total' => $total,
            'descripcion' => $this->descripcion
        ]);
        $this->alert('success', 'Factura Alfa registrada exitosamente!');
        $this->generarFactura = false;
        $this->folioAlfa = null;
        $this->cancelarUsado = array();
        $this->array = array();
    }

    public function showDescripcion($id)
    {
        $descripcion = FacturaAlfa::where('id', $id)->first()->descripcion;
        $this->alert('info', $descripcion, [
            'timer' => 60000
        ]);
    }
    public function edit($folioAlfa)
    {
        $this->folioAlfa = $folioAlfa;
        $this->showEdit = true;
    }

    public function editFacturaClose()
    {
        for ($i = 0; $i < count($this->cancelarUsado); $i++) {
            XmlData::where('id', $this->cancelarUsado[$i])->update([
                'estado' => 'Sin usar',
                'folioAlfa' => null
            ]);
        }
        $this->cancelarUsado = array();
        $this->folioAlfa = null;
        $this->showEdit = false;
    }

    public function updateFactura()
    {
        $cantidad = XmlData::where('folioAlfa', $this->folioAlfa)->sum('cantidad');
        $derivas = XmlData::where('folioAlfa', $this->folioAlfa)->get();

        for ($i = 0; $i < count($derivas); $i++) {
            array_push($this->array, $derivas[$i]->nombre . ' FOLIO: ' . substr($derivas[$i]->uuid, 0, 8) . ' ' . $derivas[$i]->arribo);
        }

        $text = implode(". ", $this->array);
        $descripcion = 'ESTA FACTURA SE DERIVA DE LAS SIGUIENTES COOPERATIVAS Y SE AMPARA CON LOS SIGUIENTES ARRIBOS: ' . $text . '.';
        $total = $cantidad * 330;
        FacturaAlfa::where('folio', $this->folioAlfa)->update([
            'cantidad' => $cantidad,
            'total' => $total,
            'descripcion' => $descripcion
        ]);
        $this->alert('success', 'Factura Alfa se ha actualizado exitosamente!');
        $this->showEdit = false;
        $this->folioAlfa = null;
        $this->cancelarUsado = array();
        $this->array = array();
    }
}
