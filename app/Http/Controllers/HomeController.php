<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        $id = auth()->user()->id;

        $expense = DB::table('expenses')->where('user_id',$id)->orderBy('id','desc')->get();

        return view('home',[
           'expenses' => $expense
        ]);
    }

    public function create(Request $req){

        $req->validate([
            'merchant' => 'required',
            'total' => 'required',
            'date' => 'required',
            'comment' => 'required',
            'receipt' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // dd($req->merchant);

        $usr_id = auth()->user()->id;

        $expense = [
            'merchant' => $req->merchant,
            'total' => $req->total,
            'date' => $req->date,
            'status' => "Reimbursed",
            'user_id' => $usr_id,
            'comment' => $req->comment,
        ];

        if($req->hasFile('receipt')){
            $expense["receipt"] = $req->file('receipt')->store('uploads','public');
            // $req["receipt"] = $receipt->getClientOriginalName();
            // dd($req->file());
            // $req->file('receipt')->store('uploads','public');
        }

        Expense::create($expense);

        // return response()->json(["status"=>1]);

    }

    public function filter(Request $req){

        $data = $req->merchant;

        if($data == "all"){
            $data = DB::table('expenses')->get();

            return response()->json($data,200);

        }else{

            $data = DB::table('expenses')->where('merchant',$data)->orderBy('id','desc')->get();

            return response()->json($data,200);

        }

    }

    public function filterMin(Request $req){

        $min = $req->min;

        $val = DB::table('expenses')->where('total', '>=', $min)->orderBy('id','desc')->get();

        return response()->json($val,200);

    }

    public function filterMax(Request $req){

        $max = $req->max;

        $val = DB::table('expenses')->where('total', '<=', $max)->orderBy('id','desc')->get();

        return response()->json($val,200);

    }

    public function import(Request $req){

        $file = $req->file('importExpense');

        $data = Excel::toArray([], $file)[0];

        // Example result array
        // $resultArray = [
        //     '0' => 'id;"merchant";"total";"date";"status";"user_id";"comment";"receipt";"created_at";"updated_at"',
        //     '1' => '1;"Acme";"100.00";"2022-03-17";"pending";"1";"Test comment";"image.jpg";"2022-03-17 10:00:00";"2022-03-17 10:00:00"',
        //     '2' => '2;"Widgets Inc";"200.00";"2022-03-16";"approved";"2";"Another comment";"image2.jpg";"2022-03-16 12:00:00";"2022-03-16 12:00:00"',
        //     // ...and so on
        // ];

        // Initialize an empty array to hold the CSV data
        $csvData = [];

        // Loop through each item in the result array and convert it to a CSV row
        foreach ($data as $row) {
            // dd($row[0]);
            $csvData[] = str_getcsv($row[0], ';');
        }

        // The resulting array will contain nested arrays, where each nested array represents a row of data
        // You can access the data using indexes like this:
        $id = $csvData[1][0]; // Gets the ID of the first row of data
        $merchant = $csvData[1][1]; // Gets the merchant name of the first row of data
        $total = $csvData[1][2]; // Gets the total amount of the first row of data
        $date = $csvData[1][3];
        $status = $csvData[1][4];
        $comment = $csvData[1][6];
        $receipt = $csvData[1][7];
        $usr = auth()->user()->id;
        // ...and so on

        // dd($receipt);
    
        // Iterate through the array and insert the data into the database
        foreach ($data as $row) {

            DB::table('expenses')->insert([
                'merchant' => $merchant,
                'total' => $total,
                'date' => $date,
                'status' => $status,
                'comment' => $comment,
                'user_id' => $usr,
                'receipt' => $receipt
                // ...and so on
            ]);
        }

        return redirect('/home')->with(["success"=>"1","title"=>"Data has been imported","msg"=>"Expenses have been succesfully imported"]);

    }

    
}
