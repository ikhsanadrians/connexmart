<?php

namespace App\Http\Controllers;

use App\Charts\TestingChart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;
use App\Models\CashierShift;
use App\Models\UserCheckout;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Barryvdh\DomPDF\Facade\Pdf;

class MartController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        $charts = (new LarapexChart)->setType('area')
            ->setTitle('Total Users Monthly')
            ->setSubtitle('From January to March')
            ->setXAxis([
                'Jan', 'Feb', 'Mar'
            ])
            ->setDataset([
                [
                    'name'  =>  'Active Users',
                    'data'  =>  [250, 700, 1200]
                ]
            ]);


        return view('mart.index',  compact("products", "categories", "charts"));
    }


    public function goodsindex(Request $request)
    {
        $products = Product::query();

        if ($request->category) {
            $category = Category::where("slug", $request->category)->first();
            if ($category) {
                $products->where("category_id", $category->id);
            }
        }

        if ($request->sort) {
            $sortOrder = $request->sort === "oldfirst" ? "asc" : "desc";
        } else {
            $sortOrder = "desc";
        }

        if ($request->show === "all") {
            $products = $products->orderBy("created_at", $sortOrder)->get();
        } else {
            $products = $products->orderBy("created_at", $sortOrder)->paginate($request->show ?? 50);
        }

        $productcategories = Category::all();
        $count_products = Product::count();

        return view('mart.products.index', compact('products', 'productcategories', 'count_products'));
    }

    public function goodsAddIndex()
    {
        $productcategories = Category::all();
        return view("mart.products.add", compact("productcategories"));
    }

    public function goodsEditIndex(string $slug)
    {
        $productcategories = Category::all();
        $product = Product::where("slug", $slug)->first();

        return view("mart.products.edit", compact("product", "productcategories"));
    }

    public function goodpost(Request $request)
    {
        $imageThumbnail = "";

        if ($request->hasFile('image')) {
            $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName());
        }

        $thumbnailPath =  $imageThumbnail->getPathname();


        $goods = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            "barcode_number" => $request->barcode_number,
            'stock' => $request->stock,
            'photo' => $thumbnailPath,
            'desc' => $request->description,
            'category_id' => $request->category_id,
            'stand' => 2,
        ]);

        alert()->success('Success', 'Success Add New Product!');

        return redirect()->route('mart.goods');
    }

    public function goodshow(string $slug)
    {
        $product = Product::where("slug", $slug)->first();

        return view("mart.products.show", compact("product"));
    }

    public function goodsupdate(string $slug, Request $request)
    {

        $goodsToUpdate = Product::find($slug);

        if ($request->hasFile('image')) {
            $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName());
            if ($goodsToUpdate->photo) {
                Storage::disk('public')->delete($goodsToUpdate->photo);
            }
        }

        $updateData = [
            "name" => $request->name,
            "price" => $request->price,
            "barcode_number" => $request->barcode_number,
            "stock" => $request->stock,
            "desc" => $request->description,
            "category_id" => $request->category_id,
            "stand" => 2
        ];


        if (isset($imageThumbnail)) {
            $updateData["photo"] = $imageThumbnail;
        }

        $goodsToUpdate->update($updateData);

        alert()->success("Success", "Success Update Product");

        return redirect()->route('mart.goods');
    }

    public function goodsdelete(Request $request, string $id)
    {
        if($request->ajax()){
            $deletedProduct = Product::where("id",$request->id_to_delete)->first();

            $deletedProduct->delete();

            alert()->success("Success", "Success Delete Product");

            return response()->json([
                "message" => "success delete product",
            ]);
        }
    }

    public function addcategory()
    {
        $categories = Category::all();

        return view('mart.category', compact("categories"));
    }

    public function addcategorypost(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        Category::create([
            "name" => $request->name
        ]);

        alert()->success("Success", "Success Create Category");

        return redirect()->back();
    }

    public function deletegoodscategory(Request $request)
    {

        $deletedCategory = Category::find($request->category_id);

        $deletedCategory->delete();

        alert()->success("Success", "Success Delete Category");

        return redirect()->back();
    }

    public function deletegoodscategoryfromsearch(string $id)
    {
        $deletedCategory = Category::find($id);
        $deletedCategory->delete();

        alert()->success("Success", "Success Delete Category");

        return redirect()->back();
    }


    public function updategoodscategory(Request $request)
    {

        $category = Category::find($request->category_id);

        $request->validate([
            "name" => "required"
        ]);

        $category->update([
            "name" => $request->name
        ]);

        alert()->success("Success", "Success Update Category");

        return redirect()->back();
    }


    public function goodscategorysearch(Request $request)
    {
        $goodsCategory = null;

        $goodsCategory = Category::where("name", "LIKE", "%" . $request->searchValue . "%")
            ->withCount('products')
            ->get();

        if (count($goodsCategory) == 0) {
            return response()->json([
                "message" => "cannot found categories",
                "data" => "empty"
            ]);
        }

        return response()->json([
            "message" => "success, get data",
            "data" => $goodsCategory
        ]);
    }

    public function auth()
    {
        return view("mart.login");
    }

    public function auth_proceed(Request $request)
    {
        $credentials = [
            "name" => $request->username,
            "password" => $request->password
        ];

        $checkRoles = User::where('name', $credentials['name'])->first();

        if (Auth::attempt($credentials))
            return redirect()->route('mart.index');

        return redirect()->back();
    }

    public function cashier(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();
        $transactions =  Transaction::with('product')->where('user_id', 4)->where('status', 'outcart')->orderBy('created_at', 'asc')->get();

        if ($request->category) {
            $category = Category::where("slug", $request->category)->first();
            $products->where("category_id", $category->id);
        }

        $products = $request->show == "all" ? $products->get() : $products->paginate($request->show ?? 50);

        $count_products = $products->count();

        return view("mart.cashier", compact("products", "categories", "count_products", "transactions"));
    }

    public function cashierAddToOrderList(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->product_id);
            $productPrice = $product->price;
            $transaction_id = "";
            $productSummaryPrice = ($productPrice * $request->quantity);
            $currentCashierShift = CashierShift::where("status", "current")->first();

            $sameTransaction = Transaction::where('product_id', $request->product_id)
                ->where('user_id', Auth::user()->id)
                ->where('status', 'outcart')
                ->first();

            if (!$currentCashierShift) {
                return response()->json([
                    "message" => "Tidak Dapat Memproses!, Anda Belum memulai shift"
                ], 401);
            }

            if ($product->stock < $request->quantity) {
                return response()->json([
                    "message" => "failed, product stock is not enough"
                ], 401);
            } else {
                if ($sameTransaction) {
                    $sumQuantity = $sameTransaction->quantity += $request->quantity;
                    $sumPrice = $sumQuantity * $product->price;
                    $sameTransaction->update([
                        'quantity' => $sumQuantity,
                        'price' => $sumPrice
                    ]);

                    $transaction_id = $sameTransaction->id;
                } else {
                    $transaction = Transaction::create([
                        "user_id" => Auth::user()->id,
                        "product_id" => $product->id,
                        "status" => "outcart",
                        "cashier_shifts_id" => $currentCashierShift->id,
                        "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
                        "quantity" => $request->quantity,
                        "price" => $productSummaryPrice,
                    ]);

                    $transaction_id = $transaction->id;
                }


                return response()->json([
                    "message" => "success",
                    "data" => $transaction_id,
                ]);
            }
        }
    }

    public function cashierQuantityUpdate(Request $request)
    {

        if ($request->ajax()) {
            $quantityToUpdate = Transaction::where('id', $request->transaction_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($request->quantity >= $quantityToUpdate->product->stock) {
                return response()->json(["message" => "Tidak Dapat Menambahkan, Stok Habis!"], 401);
            }

            if ($request->type == "delete") {
                $quantityToUpdate->delete();
                $message = "Berhasil Menghapus Produk!";
            } else {
                $quantityToUpdate->update(['quantity' => $request->quantity]);
                $message = "Berhasil Memperbarui Produk!";
            }

            return response()->json(["message" => $message, "data" => $quantityToUpdate]);
        }
    }


    public function search(Request $request)
    {
        $products = null;

        if ($request->category != null) {
            $category = Category::where("slug", $request->category)->first();
            $products = Product::where("category_id", $category->id)->where("name", "LIKE", "%" . $request->searchValue . "%")->get();
        } else {
            $products = Product::where("name", "LIKE", "%" . $request->searchValue . "%")->get();
        }


        if (count($products) == 0) {
            return response()->json([
                "message" => "cannot found product",
                "data" => "empty"
            ]);
        }

        return response()->json([
            "message" => "success, get data",
            "data" => $products
        ]);
    }


    public function transactions_search(Request $request)
    {
        $userCheckouts = null;

        $userCheckouts = UserCheckout::where("checkout_code", "LIKE", "%" . $request->searchValue . "%")->get();



        if (count($userCheckouts) == 0) {
            return response()->json([
                "message" => "cannot found transactions",
                "data" => "empty"
            ]);
        }

        return response()->json([
            "message" => "success, get data",
            "data" => $userCheckouts
        ]);
    }


    public function clearOrder(Request $request)
    {
        $transactions = Transaction::where('user_id', 4)->where("status", "outcart")->get();

        foreach ($transactions as $transaction) {
            $transaction->delete();
        }

        return response()->json(["message" => "All transactions have been cleared."]);
    }

    public function cashierProceed(Request $request)
    {
        if ($request->ajax()) {

            $currentCashierShift = CashierShift::where("status", "current")->first();

            if (!$currentCashierShift) {
                return response()->json([
                    "message" => "Tidak Dapat Memproses!, Anda Belum memulai shift"
                ], 401);
        }

            $checkTransactions = Transaction::whereIn('id', $request->product_list)->get();

            // $checkTotalPrice = $checkTransactions->sum("price");
            // $checkTotalQty = $checkTransactions->sum("quantity");

            // if($checkTotalPrice != $request->total_price || $checkTotalQty != $request->total_quantity){
            //     return response()->json([
            //           "message" => "Total harga atau Jumlah tidak Valid!"
            //     ], 422);
            // }

        

            if ($request->payment_method == "tenbank") {
                $checkout_code = now()->format("dmYHis") . Auth::user()->id . substr(uniqid(), 0, 3);

                $data = UserCheckout::create([
                    "checkout_code" => $checkout_code,
                    "user_id" => Auth::user()->id,
                    "product_list" => json_encode($request->product_list),
                    "total_quantity" => $request->total_quantity,
                    "cashier_shifts_id" =>  $currentCashierShift->id,
                    "total_price" => $request->total_price,
                    "status" => "pending"
                ]);

                $qrCodeData = QrCode::format('png')->margin(1)->size(512)->generate($checkout_code);
                $formatedBase64QrCode = base64_encode($qrCodeData);


                return response()->json([
                    "checkoutDetail" => $data,
                    "qrCodeData" => $formatedBase64QrCode,
                    "checkoutCode" => $checkout_code
                ]);
            } else if ($request->payment_method == "cash") {
                $checkout_code = now()->format("dmYHis") . Auth::user()->id . substr(uniqid(), 0, 3);

                $refund_cash = $request->cash_amount - $request->total_price;

                $data = UserCheckout::create([
                    "checkout_code" => $checkout_code,
                    "payment_method" => "bdk",
                    "user_id" => Auth::user()->id,
                    "cashier_shifts_id" =>  $currentCashierShift->id,
                    "product_list" => json_encode($request->product_list),
                    "total_quantity" => $request->total_quantity,
                    "total_price" => $request->total_price,
                    "cash_total" => $request->cash_amount,
                    "refund_cash" => $refund_cash,
                    "status" => "ordered"
                ]);

                $transaction_list = json_decode($data->product_list);
                $transactions = Transaction::whereIn("id", $transaction_list)->where("user_id", Auth::user()->id)->get();

                foreach ($transactions as $transaction) {
                    $transaction->update([
                        "status" => "taken",
                        "order_id" => $checkout_code
                    ]);
                }

                $currentCashierShift->sold_items += $request->total_quantity;
                $currentCashierShift->refund_cash += $refund_cash;
                $currentCashierShift->current_cash += $request->cash_amount;
                $currentCashierShift->current_cash -= $refund_cash;

                $currentCashierShift->save();


                return response()->json([
                    "checkoutDetail" => $data,
                ]);
            }
        }
    }



    public function cashierProceedIndex(string $checkout_code)
    {
        $checkouts = UserCheckout::where("checkout_code", $checkout_code)->first();
        if (!$checkouts || $checkouts->status == "ordered") return view("errors.404");
        $product_list = json_decode($checkouts->product_list);

        $transactions = Transaction::whereIn("id", $product_list)->with('product')->where("user_id", Auth::user()->id)->get();

        foreach ($transactions as $transaction) {
            $transaction->totalPricePerTransaction = ($transaction->product->price * $transaction->quantity);
        }


        return view("mart.cashierproceed", compact("transactions", "checkouts"));
    }


    public function streamResponseCheckout(string $checkout_code)
    {
        $checkout = UserCheckout::where("checkout_code", $checkout_code)->first();

        $response = new StreamedResponse(function () use ($checkout) {
            echo "data: " . json_encode($checkout) . "\n\n";
            ob_flush();
            flush();
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }



    public function cashierSuccessDetail(string $checkout_code)
    {
        $checkouts = UserCheckout::where("checkout_code", $checkout_code)->first();

        if (!$checkouts) return view("errors.404");

        $product_list = json_decode($checkouts->product_list);

        $transactions = Transaction::whereIn("id", $product_list)->with('product')->where("user_id", Auth::user()->id)->get();

        foreach ($transactions as $transaction) {
            $transaction->totalPricePerTransaction = ($transaction->product->price * $transaction->quantity);
        }

        $total_cash = $checkouts->cash_total;
        $total_price = $checkouts->total_price;
        $cash_return = ($total_cash -= $total_price);

        $checkouts->cash_return = $cash_return;


        return view("mart.cashiersuccess", compact("transactions", "checkouts"));
    }


    public function downloadReceipt(string $checkout_code)
    {
        $data = UserCheckout::where("checkout_code", $checkout_code)->first();
        if (!$data) {
            abort(404, "Receipt data not found.");
        }

        $pdf = Pdf::loadView('mart.receipt.index', compact('data'));
        return $pdf->download('invoice.pdf');
    }

    public function printReceipt(string $checkout_code)
    {
        $checkouts = UserCheckout::where("checkout_code", $checkout_code)->first();

        if (!$checkouts) return view("errors.404");

        $product_list = json_decode($checkouts->product_list);


        $transactions = Transaction::whereIn("id", $product_list)->with('product')->get();

        foreach ($transactions as $transaction) {
            $transaction->totalPricePerTransaction = ($transaction->product->price * $transaction->quantity);
        }

        if($checkouts->cashierShift_id){
            $checkouts->cashierName = $checkouts->cashierShift->name;
        } else {
            $cashier = CashierShift::where("status", "current")->first();

            $checkouts->cashierName = $cashier->cashier_name;
        }

        return view("mart.cashierreceipt", compact("checkouts", "transactions"));
    }

    public function transactions(Request $request)
    {
        $userCheckouts = UserCheckout::query();

        if ($request->has('date')) {
            $formattedDate = Carbon::createFromFormat('d_m_Y', $request->date)->format('Y-m-d');
            $userCheckouts->whereDate('updated_at', $formattedDate);
        }

        if ($request->has('status')) {
            $userCheckouts->where('status', $request->status);
        } else {
            $userCheckouts->whereIn('status', ['ordered', 'not_paid', 'taken', 'canceled']);
        }

        if ($request->has('sort') && $request->sort == "oldfirst") {
            $userCheckouts->orderBy("updated_at", "asc");
        }

        $userCheckouts = $request->show === "all" ? $userCheckouts->orderBy('updated_at', 'desc')->get() : $userCheckouts->orderBy('updated_at', 'desc')->paginate($request->show ?? 50);

        $userCheckoutsDate = UserCheckout::whereIn("status", ["ordered", "taken", "canceled"])
            ->selectRaw('DATE_FORMAT(updated_at, "%d %M %Y") as formatted_date')
            ->groupBy('formatted_date')
            ->get();

        $count_userCheckouts = UserCheckout::count();

        return view("mart.transactions", compact("userCheckouts", "userCheckoutsDate", "count_userCheckouts"));
    }

    public function transaction_detail(string $checkout_code)
    {
        $userCheckouts = UserCheckout::where("checkout_code", $checkout_code)->first();
        $cashierShiftName = CashierShift::where("id", $userCheckouts->cashier_shifts_id)->first();

        if($cashierShiftName){
            $userCheckouts->cashier_name = $cashierShiftName->cashier_name;
        }

        $productListCheckout = json_decode($userCheckouts->product_list);
        $transactions = Transaction::whereIn("id", $productListCheckout)->with("product")->get();

        foreach ($transactions as $transaction) {
            $transaction->totalPricePerTransaction = ($transaction->product->price * $transaction->quantity);
        }


        $userCheckouts->refund_cash = $userCheckouts->cash_total - $userCheckouts->total_price;


        return view("mart.transactiondetail", compact("userCheckouts", "transactions"));
    }


    public function cashier_shift()
    {
        $cashierShift = CashierShift::where("status", "current")->first();



        return view("mart.cashiershift", compact("cashierShift"));
    }


    public function cashier_shift_post(Request $request)
    {
        $validator = $request->validate([
            "cashierName" => "required",
            "startCash" => "required",
        ]);
        
        CashierShift::create([
            "cashier_name" => $request->cashierName,
            "starting_cash" => $request->startCash,
            "current_cash" => $request->startCash,
            "starting_shift" => now(),
            "status" => "current"
        ]);


        alert()->success("Sukses", "Sukses Memulai Shift Kasir");

        return redirect()->back();
    }


    public function cashier_shift_end(Request $request)
    {
        $cashierShift = CashierShift::where("id", $request->shift_id)->first();
        $cashierShift->update([
            "status" => "ended",
            "end_shift" => now(),
        ]);

        alert()->success("Sukses", "Sukses Menghentikan Shift Kasir");

        return redirect()->back();
    }

    public function cashier_shift_history(Request $request)
    {

        $cashierShifts = CashierShift::query();

        if ($request->has('date')) {
            $formattedDate = Carbon::createFromFormat('d_m_Y', $request->date)->format('Y-m-d');
            $cashierShifts->whereDate('updated_at', $formattedDate);
        }

        if ($request->has('status')) {
            $cashierShifts->where('status', $request->status);
        } else {
            $cashierShifts->whereIn('status', ['current', 'ended']);
        }

        if ($request->has('sort') && $request->sort == "oldfirst") {
            $cashierShifts->orderBy("updated_at", "asc");
        }


        $cashierShifts = $request->show === "all" ? $cashierShifts->orderBy('created_at', 'desc')->get() : $cashierShifts->orderBy('updated_at', 'desc')->paginate($request->show ?? 50);



        $cashierShiftDates = CashierShift::selectRaw('DATE_FORMAT(updated_at, "%d %M %Y") as formatted_date')
        ->groupBy('formatted_date')
        ->get();

        $cashierShiftCounts = $cashierShifts->count();


        return view("mart.cashiershifthistory", compact("cashierShifts", "cashierShiftDates", "cashierShiftCounts"));
    }

    public function cashierAddToOrderListBarcode(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::where("barcode_number", $request->barcode)->first();
            $productPrice = $product->price;
            $transaction_id = "";
            $currentCashierShift = CashierShift::where("status", "current")->first();

            if (!$currentCashierShift) {
                return response()->json([
                    "message" => "Tidak Dapat Memproses!, Anda Belum memulai shift"
                ], 401);
            }

            if (!$product) {
                return response()->json([
                    "message" => "Scan Gagal!, Produk Tidak Ditemukan"
                ], 401);
            }

            $productSummaryPrice = ($productPrice * 1);

            $sameTransaction = Transaction::where('product_id', $product->id)
                ->where('user_id', Auth::user()->id)
                ->where('status', 'outcart')
                ->first();

            if ($product->stock < $request->quantity) {
                return response()->json([
                    "message" => "failed, product stock is not enough"
                ], 401);
            } else {
                if ($sameTransaction) {
                    $sumQuantity = $sameTransaction->quantity += 1;
                    $sumPrice = $sumQuantity * $product->price;
                    $sameTransaction->update([
                        'quantity' => $sumQuantity,
                        'price' => $sumPrice
                    ]);

                    $transaction_id = $sameTransaction->id;
                } else {
                    $transaction = Transaction::create([
                        "user_id" => Auth::user()->id,
                        "product_id" => $product->id,
                        "status" => "outcart",
                        "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
                        "quantity" => 1,
                        "cashier_shifts_id" => $currentCashierShift->id,
                        "price" => $productSummaryPrice,
                    ]);

                    $transaction_id = $transaction->id;
                }


                return response()->json([
                    "message" => "success",
                    "trans_id" => $transaction_id,
                    "data" => $product,
                ]);
            }
        }
    }

    public function goodssearch(Request $request)
    {
        if ($request->ajax()) {
            $products = null;

            $products = Product::where("name", "LIKE", "%" . $request->searchValue . "%")->with('category')->get();

            if (count($products) == 0) {
                return response()->json([
                    "message" => "cannot found products",
                    "data" => "empty"
                ]);
            }

            return response()->json([
                "message" => "success, get data",
                "data" => $products
            ]);
        }
    }


    public function cashier_shift_history_detail(string $id)
    {
        $cashierHistory = CashierShift::where("id", $id)->first();
        $userCheckoutsCount = UserCheckout::where("cashier_shifts_id", $cashierHistory->id)->count();
        $userCheckouts = UserCheckout::where("cashier_shifts_id", $id)->paginate(50);

        return view("mart.cashiershifthistorydetail", compact("cashierHistory", "userCheckouts", "userCheckoutsCount"));
    }

    public function cashier_shift_history_search(Request $request){
        $cashierShifts = null;

        $cashierShifts = CashierShift::where("cashier_name", "LIKE", "%" . $request->searchValue . "%")->orWhere("id", "LIKE" , "%" . $request->searchValue . "%")->get();

        foreach($cashierShifts as $cashierShift){
            $cashierShift->starting_shift = \Carbon\Carbon::parse($cashierShift->starting_shift)->format("h:i; d M Y");
            $cashierShift->end_shift = \Carbon\Carbon::parse($cashierShift->end_shift)->format("h:i; d M Y");
        }

        if (count($cashierShifts) == 0) {
            return response()->json([
                "message" => "cannot found cashiershift",
                "data" => "empty"
            ]);
        }

        return response()->json([
            "message" => "success, get data",
            "data" => $cashierShifts
        ]);
    }

    public function transactionConfirm(Request $request){

    }


    public function martlogout()
    {
        Auth::logout();

        request()->session()->invalidate();

        return redirect()->route('mart.auth');
    }
}