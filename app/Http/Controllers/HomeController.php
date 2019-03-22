<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tintuc;
use App\Tinh;

class HomeController extends Controller
{
    public function gethomepage()
    {
        $tintuc = Tintuc::where('duyettin', 1)->get();
        return view('front.pages.homepage', compact('tintuc'));
    }
    public function postsearch(Request $request)
    {
        $tintuc = Tintuc::all();
        $tinh = Tinh::where('_id',$request->tinh)->first();
        $huyen = $tinh->dshuyen()->where('_id',$request->huyen)->first();
        $tintuc = $tintuc->where('tinh',$tinh->ten)->where('huyen',$huyen->ten);
        $tintuc = $tintuc->where('duyettin',1);

        return view('front.pages.homepage', compact('tintuc'));

    }
}


// //Validation
//         $tintuc = Tintuc::all();
//         $tinh = Tinh::where('_id',$request->tinh)->first();
//         $huyen = $tinh->dshuyen()->where('_id',$request->huyen)->first();
//         $tintuc = $tintuc->where('tinh',$tinh->ten)->where('huyen',$huyen->ten);
//         $tintuc = $tintuc->where('duyettin',1);

//         foreach ($tintuc as $key => $tin) {
//          echo "<div class='col-12 col-md-6 col-xl-4'>
//                     <div class='single-featured-property mb-50 wow fadeInUp' data-wow-delay='100ms'>
//                         <!-- Property Thumbnail -->
//                         <div class='property-thumb'>";
//                             if(isset($tin->hinhanh)){
//                             foreach($tin->hinhanh as $hinh){
//                             echo "<a href='".asset('tintuc')."/". $tin->id ."'><img class='anhtin' height='210px' src='data:image/x-icon;base64,".$hinh." ' alt=''></a>";
//                             break;
//                             }};
//                             echo "<div class='list-price'>
//                                 <p>".$tin->gia."</p>
//                             </div>
//                         </div>
//                         <!-- Property Content -->
//                         <div class='property-content'>
//                             <h5>".substr($tin->tieude,0,100)."...</h5>
//                             <p class='location'><img src='img/icons/location.png' alt=''>".$tin->huyen." - ".$tin->tinh."</p>
//                             <p>".substr($tin->noidung,0,150)."...</p>
//                             <div class='property-meta-data d-flex align-items-end justify-content-between'>
//                                 <!-- <div class='new-tag'>
//                                     <img src='img/icons/new.png' alt=''>
//                                 </div> -->
//                                 <div class='garage'>
//                                     <img src='img/icons/garage.png' alt=''>
//                                     <span>".$tin->pngu."</span>
//                                 </div>

//                                 <div class='bathroom'>
//                                     <img src='img/icons/bathtub.png' alt=''>
//                                     <span>".$tin->pvsinh."</span>
//                                 </div>                                <div class='space'>
//                                     <img src='img/icons/space.png' alt=''>
//                                     <span>".$tin->dientich." m2</span>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>";
//         }