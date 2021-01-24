<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class InfoCovid19Controller extends Controller
{
    public function index(Request $request)
    {
	
		$client=New Client([
			'headers'=>['content-type'=>'application/json','Accept'=>'application/json'],
		]);
		$resCov19Alls=$client->request('GET','https://api.kawalcorona.com/indonesia',[
			'json'=>[
				'code'=>'123',
			],
		]);
		$datCov19Alls=$resCov19Alls->getBody();
		$datCov19Alls=json_decode($datCov19Alls);		
		
		
		$resCov19ByProvs=$client->request('GET','https://api.kawalcorona.com/indonesia/provinsi',[
			'json'=>[
				'code'=>'321',
			],
		]);
		$datCov19ByProvs=$resCov19ByProvs->getBody();
		$datCov19ByProvs=json_decode($datCov19ByProvs);
		return view('covid19.index',compact('datCov19Alls','datCov19ByProvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
