<?php

namespace App\Http\Livewire;

use App\Models\QuantityData;
use App\Models\XmlData;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowData extends Component
{
    use LivewireAlert;
    use WithPagination;
    //declare public variables and set the initial value
    public $search, $searchOptions = 'nombre', $limit = 5;


    public function render()
    {
        $search = '%' . $this->search . '%';
        $searchOptions = $this->searchOptions;
        $limit = $this->limit;
        return view('livewire.show-data', [
            'facturas' => XmlData::orderBy('id','DESC')->paginate($limit),
            'uuids' => XmlData::where($searchOptions, 'like', $search)->orderBy('id','DESC')->paginate($limit)
        ]);

    }
    public function logoutUser()
    {
        Auth::logout();
        redirect(route('login'));
    }
    // Delete a row hacer modificaciones en facturaalfa
    public function destroy($id){
        $rfc = XmlData::where('id',$id)->first()->rfc;
        $cantidad = floatval(XmlData::where('id',$id)->first()->cantidad);
        XmlData::destroy($id);
        QuantityData::where('rfc',$rfc)->decrement('cantidad_total',$cantidad);
        if(floatval(QuantityData::where('rfc',$rfc)->first()->cantidad_total) == 0){
            $idCantidadTotal = QuantityData::where('rfc',$rfc)->first()->id;
            QuantityData::destroy($idCantidadTotal);
        }
        $this->alert('success','La factura ha sido eliminada!');
    }
}
