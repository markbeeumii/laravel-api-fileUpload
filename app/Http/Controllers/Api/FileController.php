<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

class FileController extends BaseAPIController{
  public function upload(Request $req)
  {
    try{
      $file_url = $this->uploadLocal($req, 'file');
      //echo $file_url;
      return $this->success($file_url, 'Upload successfully');
    }catch(\Exception $e){
      report($e);
    }
  }
  public function uploadLocal(Request $request, $key = 'file')
  {
      $file = $request[$key];
      $original_name = $file->getClientOriginalName();
      $original_name = preg_replace('/\s+/', '-', $original_name);
      $imageName = time() . '.' . $original_name;
      $file->move(public_path('/dist/img/local/'), $imageName);
      return asset('dist/img/local/'.$imageName);
  }
}