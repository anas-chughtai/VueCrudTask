<?php

namespace App\Http\Controllers;

use App\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        return view('inquiries.index');
    }

    public function storeInquiry(Request $request)
    {
        $inquiry = Inquiry::create($request->all());
        return $inquiry;
    }

    public function readInquiries()
    {
        $inquiries = Inquiry::all();
        return $inquiries;
    }

    public function deleteInquiry(Request $request)
    {
        $inquiry = Inquiry::find($request->id);
        $inquiry->delete();
    }

    public function editInquiry(Request $request, $id)
    {
        $data = Inquiry::where('id', $id)->update($request->all());
        return $data;
    }
}
