<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function generate(Request $request)
    {
        $this->validate($request,
        [
            'number_of_barcodes' => 'required|numeric',
            'code_type' => 'required',
            'start_number' => 'required|numeric',
        ]
        );
        $code_type = $request->code_type;
        $number_of_barcodes = $request->number_of_barcodes;
        $start = $request->start_number;
        $end = $start+$number_of_barcodes;
        $barcodes = array();
        $filenames = array();
        $numbers = array();
        $bar = App::make('BarCode');
        
        for($i = $start;$i<$end;$i++)
        {
            $filename = "image".$i.".jpeg";
            // $c =
            // [
            //     'text' => "$i",
            //     'size' => 50,
            //     'orientation' => 'horizontal',
            //     'code_type' => $code_type,
            //     'print' => true,
            //     'sizefactor' => 1,
            //     'filename' => $filename,
            //     'filepath' => 'barcodes'
            // ];
            // //array_push($barcodes,$c);
            array_push($numbers,$i);
           // array_push($filenames,$filename);
        }


        // foreach($barcodes as $barcode) {
        // //    $file= $bar->barcodeFactory()->renderBarcode(
        // //                                 $text=$barcode["text"], 
        // //                                 $size=$barcode['size'], 
        // //                                 $orientation=$barcode['orientation'], 
        // //                                 $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar 
        // //                                 $print=$barcode['print'], 
        // //                                 $sizefactor=$barcode['sizefactor'],
        // //                                 $filename = $barcode['filename'],
        // //                                 //$filepath = $barcode['filepath'],
        // //                         )->filename($barcode['filename']);
    
        // //     array_push($filenames,$file);  
                
            
            
        // }

        return view('barcodelist',compact('code_type','numbers'));
    }
}
