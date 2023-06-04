<?php

namespace App\Http\Livewire;

use App\Models\QuantityData;
use App\Models\XmlData;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use function PHPUnit\Framework\fileExists;

class ReadXmlData extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $xml, $showData = false, $noDataYet = false, $claveProductoAlert= false, $repeatUuidAlert = false;
    public $fecha,$rfc, $nombre, $folio, $uuid, $cantidad, $total, $claveProducto, $precioUnitario,$arribo;

    protected $rules = [
        'arribo' => 'required|size:12',
    ];


    public function render()
    {
        return view('livewire.read-xml-data');
    }

    public function logoutUser()
    {
        Auth::logout();
        redirect(route('login'));
    }
    //close "no data yet" warning alert
    public function closeNoDataYet(){
        $this->noDataYet = false;
    }
    //close "claveProducto" warning alert
    public function closeClaveProductoAlert(){
        $this->claveProductoAlert = false;
    }
    //close "repeatUuid" warning alert
    public function closeRepeatUuidAlert(){
        $this->repeatUuidAlert = false;
    }

    //function who transform, read and extract data from an xml file
    public function readXml(){
        if($this->xml != null){
            //save the file in public route
            $this->xml->storeAs('xmls', 'archivo.xml', 'public_uploads');
            //getting the content of the file
            $xml = file_get_contents(public_path('xmls/archivo.xml'));
            //transform data from the xml file
            $xmlNew = str_replace('<cfdi:','<',$xml);
            $xmlNew = str_replace('xmlns:','',$xmlNew);
            $xmlNew = str_replace('xsi:','',$xmlNew);
            $xmlNew = str_replace('</cfdi:','</',$xmlNew);
            $xmlNew = str_replace('<tfd:','<',$xmlNew);
            $xmlNew =str_replace('<registrofiscal:','<',$xmlNew);
            $xmlNew =str_replace('</registrofiscal:','</',$xmlNew);
            $xmlData = simplexml_load_string($xmlNew);
            // getting data from XML
            $this->fecha = (string)$xmlData['Fecha'];
            $this->rfc = (string)$xmlData->Emisor['Rfc'];
            $this->nombre = (string)$xmlData->Emisor['Nombre'];
            $this->folio = (string)$xmlData['Folio'];
            $this->uuid = (string)$xmlData->Complemento->TimbreFiscalDigital['UUID'];
            $this->cantidad = floatval((string)$xmlData->Conceptos->Concepto['Cantidad']);
            $this->total = floatval((string)$xmlData['Total']);
            $this->claveProducto = (string)$xmlData->Conceptos->Concepto['ClaveProdServ'];
            $this->precioUnitario = $this->total/$this->cantidad;
            //asking to eloquent if a data like this exists
            $repeatUuid = XmlData::where('uuid','=',$this->uuid)->exists();
            //verify if uuid is repeated or already exist
            if($repeatUuid == false){
                if($this->claveProducto == '10101802'){
                    //show data in the DOM
                $this->showData = true;
                }
                else{
                    $this->claveProductoAlert = true;
                }

            }
            else{
                // show "repeatUuid" warning alert
                $this->repeatUuidAlert = true;
            }
        }else{
            // show "no data yet" warning alert
            $this->noDataYet = true;
        }
    }

    // function who save data in the DB
    public function storeData()
    {
        $this->validate();
        //asking to eloquent if a data like this exists
        $repeatArribo = XmlData::where('arribo','=',$this->arribo)->orWhere('arribo2','=',$this->arribo)->exists();
       //verify if "uuid" is repeated or already exist
        if(XmlData::where('uuid','=',$this->uuid)->exists() == false){
            if($repeatArribo == false)
            {
                //Save data
            XmlData::updateOrCreate([
                'fecha' => $this->fecha,
                'rfc' => $this->rfc,
                'nombre' => $this->nombre,
                'folio' => $this->folio,
                'uuid' => $this->uuid,
                'cantidad' => $this->cantidad,
                'total' => $this->total,
                'precioUnitario' => $this->precioUnitario,
                'claveProdServ' => $this->claveProducto,
                'estado' => 'Sin usar',
                'arribo' => strtoupper($this->arribo)
            ]);
            if(QuantityData::where('rfc','=',$this->rfc)->exists() == false){
                $montoTotal = $this->cantidad * 200;
                QuantityData::create([
                    'nombre' => $this->nombre,
                    'rfc' => $this->rfc,
                    'cantidad_total' => $this->cantidad,
                    'monto_total' => $montoTotal
                ]);
                //success alert
                $this->alert('success','La factura ha sido registrada');
                $this->showData = false;
                $this->arribo = null;
            }else{
                $montoTotal = $this->cantidad * 200;
                QuantityData::where('rfc','=',$this->rfc)->increment('cantidad_total',$this->cantidad);
                QuantityData::where('rfc','=',$this->rfc)->increment('monto_total',$montoTotal);
                $this->alert('success','La factura ha sido registrada');
                $this->showData = false;
            }
            }
            else{
                //Error alert for arribo data repeat
                $this->alert("error",'Este arribo ya ha sido ultilizado.');
            }

        }else{
            //warning alert
            $this->repeatUuidAlert = true;
        }
    }

}
