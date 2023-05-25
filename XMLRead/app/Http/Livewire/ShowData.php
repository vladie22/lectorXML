<?php

namespace App\Http\Livewire;

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
    public $search, $searchOptions = 'uuid', $limit = 5;

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
    //Change the status from "Sin pagar" to "Pagado"
    // public function pagadoNoToSi($id)
    // {
    //     XmlData::where('id',$id)->update(['estado'=>'Pagado']);
    //     $this->alert('success','Se ha pagado la factura!');
    // }
    // Delete a row
    public function destroy($id){
        XmlData::destroy($id);
        $this->alert('success','La factura ha sido eliminada!');

    }
}
