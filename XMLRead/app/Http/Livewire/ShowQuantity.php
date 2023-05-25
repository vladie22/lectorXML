<?php

namespace App\Http\Livewire;

use App\Models\XmlData;
use Livewire\Component;
use App\Models\QuantityData;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowQuantity extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search,  $searchOptions = 'rfc', $limit = 5;
    public function render()
    {
        $search = '%' . $this->search . '%';
        $searchOptions = $this->searchOptions;
        $limit = $this->limit;
        return view('livewire.show-quantity',[
            'quantities' => QuantityData::orderBy('cantidad_total','DESC')->paginate($limit),
            'searchQuantities' => QuantityData::where($searchOptions, 'like', $search)->orderBy('cantidad_total','DESC')->simplePaginate($limit)
        ]);
    }
    public function logoutUser()
    {
        Auth::logout();
        redirect(route('login'));
    }
}
