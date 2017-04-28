<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use View;
use Input;
use Redirect;
Use Zipper;
use Response;
use Excel;
use DB;

class UploadsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return View::make('uploads.create');
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'caption' => 'required',
            'file' => 'required|image',
        ]);

        $upload = new Upload;

        $upload->email = preg_replace('/\s+/','',Input::get('email'));

        $upload->caption = Input::get('caption');

        if (Input::hasFile('file')) {

          $file = Input::file('file');

          $email = Input::get('email');

          $filename = time() . $email .'-'. $file->getClientOriginalName();

          $filename = preg_replace('/\s+/','',$filename);

          $file->move(public_path() .'/images/', $filename);

          $path = public_path() .'/images/'. $filename;

          $upload->file = $path;

        }

        $upload->save();

        return redirect('thankyou');
    }


    public function thankyou()
    {
        return View::make('thankyou');
    }

    public function downloadZip()
    {
        $files = glob(public_path('images/*'));

        $fileName = 'zips/'.time().'.zip';

        Zipper::make($fileName)->add($files)->close();

        return response()->download(public_path($fileName));
    }

    public function downloadExcel()
    {
        $allUploads = DB::table('uploads')->get();

        $dataToArray = [];
        foreach ($allUploads as $s) {
          $i = (array) $s;
          array_push($dataToArray, $i);
        }
        $export = Excel::create('All-User-Uploads', function ($excel) use ($dataToArray) {
            $excel->sheet('All-User-Uploads', function ($sheet) use ($dataToArray) {
                $sheet->fromArray($dataToArray);
            });

        })->export('xls');

    }

}
