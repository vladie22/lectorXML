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
    public $search, $searchOptions = 'nombre', $limit = 5, $mobileMenu = false, $deleteId;

    protected $listeners =[
        'confirmed'
    ];

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
    // Delete a row hacer modificaciones en facturaalfa
    public function destroy($id){
        $this->deleteId = $id;

        $this->alert('warning', '¿Quiere eliminar esta deriva?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Eliminar',
            'onConfirmed' => 'confirmed',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'allowOutsideClick' => false,
            'timer' => null
        ]);
    }
    public function confirmed()
    {
        $rfc = XmlData::where('id',$this->deleteId)->first()->rfc;
        $cantidad = floatval(XmlData::where('id',$this->deleteId)->first()->cantidad);
        XmlData::destroy($this->deleteId);
        QuantityData::where('rfc',$rfc)->decrement('cantidad_total',$cantidad);
        if(floatval(QuantityData::where('rfc',$rfc)->first()->cantidad_total) == 0){
            $idCantidadTotal = QuantityData::where('rfc',$rfc)->first()->id;
            QuantityData::destroy($idCantidadTotal);
        }
        $this->deleteId = null;
    }

}
