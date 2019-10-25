<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
// use Illuminate\Pagination\Paginator;
// use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    //
    public function index()
    {
        # code...
        $Products = Product::paginate(8);
        foreach ($Products as $Product) {
            $photo = explode(';', $Product->photo);
            $photo = array_filter($photo); //陣列空值刪除
            // $data[$Product->name] = [
            //     'id' => $Product->id,
            //     'name' => $Product->name,
            //     'description' => $Product->description,
            //     'price' => $Product->price,
            //     'count'=>$Product->count,
            //     'photo' => $photo,
            // ];
            $Product->photo=$photo;
        }
        // var_dump($data);
        $data = ['title' => 'home',  'data' => $Products];
        // return $data;
        // exit;
        return view('product', $data);
    }

    public function cart(Request $request)
    {
        # code...
        $data = ['title' => 'cart'/*, 'data' => $json*/];
        //     //   exit; 
        return view('cart', $data);
    }
    public function pay(Request $request)
    {
        # code...
       // [{"id":1,"name":"product1","price":199,"count":"1"},{...}]
        $arg = $request->get('pid');
        $arg = json_decode($arg, true); // arr=>{[....],[...],[...]}
        $productList = []; //購物產品清單
        $totalPrice = null; //總價
        foreach ($arg as $key => $item) {

            $Product = Product::where('id', $item['id'])->first();
            if (!$Product->count > 0) {
                return '錯誤';
            }
            $totalPrice += $Product->price * $item['count'];
            $productList[] = [
                'id' => $Product->id,
                'name' => $Product->name,
                'price' => $Product->price,
                'count' => $item['count'],
            ];
            $Product->decrement('count', $item['count']);
            //    $order[]=$Product;

        }
        $order = [
            'user_id' => session('user_id'),
            'products' => json_encode($productList),
            'total_price' => $totalPrice
        ];
        Orders::create($order);

        return $productList;
        // exit;
    }

    public function uploadFiles($fName, $files, $count = null)
    {
        # code...    
        $filesArray = [];
        ($count != null) ? $count = $count : $count = 1;
        foreach ($files as $file) {
            // $filename = $file->getClientOriginalName(); //檔案原名稱
            $extension = $file->getClientOriginalExtension(); //副檔名
            $fileName = 'product_' .  $fName . '-' . $count . '.' . $extension; //新檔名
            // $path = '../public/prod_photo/' . $fileName; //存放路徑
            $path = $file->storeAs('public/prod_photo', $fileName); //進行存放
            $path = Storage::url($path);
            array_push($filesArray, $path);
            $count++;
        }

        return $filesArray;
    }


    public function allProduct()
    {
        # code...
        $data = Product::all();

        return $data;
        // exit;
    }
    public function productPage()
    {
        # code...
        $Product = Product::paginate(5);
        return $Product;

    }
    public function product($pid)
    {
        # code...

        $Product = Product::find($pid);
        return $Product;
    }
    public function edit(Request $request, $pid)
    {
        # code...
        $data=$request->all();
        $Product = Product::find($pid);

        // var_dump(implode(';',$origPhoto) );
       

        if ($request->hasFile('photo')) {
            $files = $request->file('photo'); //讀取file
            // $extension = $files->getClientOriginalExtension(); //副檔名
            if ($Product->photo) { //判斷資料庫是否已經有圖檔
                $countPhoto = explode(';', $Product->photo);
                $fileArray = $this->uploadFiles($request->name, $files, count($countPhoto));
                // $fileName = 'product_' . $request->name . '-' . count($countPhoto) . '.' . $extension; //新檔名
            } else {
                $fileArray = $this->uploadFiles($request->name, $files);
                // $fileName = 'product_' . $request->name . '-1.' . $extension; //新檔名 
            }
            $Product->photo =   $Product->photo . implode(';', $fileArray) . ';';
            // $file->storeAs('prod_photo', $fileName); //進行存放
            // $path = '../storage/app/prod_photo/' . $fileName; //存放路徑      
        }

        if($request->delPhoto!=null){ //如果有要刪除的圖片
            $delPhoto=$request->delPhoto; //刪除圖片路徑
            $delPhoto=explode(',',$delPhoto);

            $origPhoto=$Product->photo; //原本圖片路徑
            $origPhoto=array_filter(explode(';',$origPhoto));

            foreach($delPhoto as $photo){ //開始刪除
                 $key=array_search($photo,$origPhoto);
                 array_splice($origPhoto,$key,1);
            }
            $Product->photo = implode(';', $origPhoto) . ';'; 
        }


        $Product->name = $request->name;
        $Product->description = $request->description;
        $Product->price = $request->price;
        $Product->count = $request->count;
        $Product->save();

        return redirect()->intended('/admin/home');
    }

    public function createProduct(Request $request)
    {
        # code...
        $data = $request->all();
        $rules = [
            'name' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'photo' => [
                // 'required',
                // 'file',
                'max:5120'
            ],
            'price' => [
                'required',
                'integer',
            ],
            'count' => [
                'required',
                'integer',
            ]
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->intended('/admin/home')
                ->withErrors($validator)
                ->withInput();
        }

        $files = $request->file('photo'); //讀取file
        if ($request->hasFile('photo')) {
            $fileArray = $this->uploadFiles($data['name'], $files);  // 圖片存放 ， return 圖片路徑陣列
        }

        $data = [
            'name' => $data['name'],
            'description' => $data['description'],
            'photo' => implode(';', $fileArray) . ';',  //陣列轉字串後，串接字串 ;
            'price' => $data['price'],
            'count' => $data['count'],
        ];
        $Product = Product::create($data);
        return redirect()->intended('/admin/home');
    }
}
