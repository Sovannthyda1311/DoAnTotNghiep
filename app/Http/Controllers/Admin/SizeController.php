<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SizeFormRequest;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(SizeFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Size::create($validatedData);
        return redirect('admin/sizes')->with('message','Size Added Successfully');
    }

    public function edit(Size $size)
    {

        return view('admin.sizes.edit', compact('size'));
    }

    public function update(SizeFormRequest $request, $size_id)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Size::find($size_id)->update($validatedData);
        return redirect('admin/sizes')->with('message', 'Size Updated Successfully');
    }

    public function destroy($size_id)
    {
        $size = Size::findOrFail($size_id);
        $size->delete();
        return redirect('admin/sizes')->with('message', 'Size Deleted Successfully');
    }

}
