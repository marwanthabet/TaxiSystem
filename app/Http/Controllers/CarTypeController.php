<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CarTypeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CarType::class, 'car_type');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny', CarType::class);
        if($request->expectsJson()){
            $data = $request->has('name') ? CarType::where('name', $request->input('name'))->get() : CarType::all();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $data
            ]);
        }else{
            $data = CarType::all();
            return response()->view('cms.types.index', ['types' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.types.create');
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
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'type_image' => 'required|mimes:png,jpg|max:2048'
        ]);
        if(! $validator->fails()){
            $carType = new CarType();
            $carType->name = $request->input('name');
            if ($request->hasFile('type_image')){
                $image = $request->file('type_image');
                $imageName = Carbon::now()->format('Y_m_d H_i') . '_' . 'type_' . $carType->name . '.' . $image->getClientOriginalExtension();
                //dd($imageName);
                //$image->move('images/types', $imageName);
                $image->storeAs('images/types', $imageName, ['disk' => 'public']);
                $carType->image = 'images/types/' . $imageName;
            }
            $isSaved = $carType->save();
            return response()->json([
                'message' => $isSaved ? 'Created successfully' : 'Create failed'
            ], $isSaved ? Response::HTTP_CREATED :Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        //
        $this->authorize('view', $carType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        //
        return response()->view('cms.types.edit', ['type' => $carType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarType $carType)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|min:3|max:45|string',
            'type_image' => 'required|image|mimes:png,jpg|max:2048'
        ]);
        if(! $validator->fails()){
            $carType->name = $request->input('name');
            if ($request->hasFile('type_image')){
                $image = $request->file('type_image');
                $oldImage = $carType->image;
                Storage::delete($oldImage);
                $newImageName = Carbon::now()->format('Y_m_d H_i').'_type'.$carType->name.'.'.$image->getClientOriginalExtension();
                $image->storeAs('images/types', $newImageName, ['disk' => 'public']);
                $carType->image = 'images/types/' . $newImageName;
            }
            $isSaved = $carType->save();
            return response()->json([
                'message' => $isSaved ? 'Updated successfully' : 'Update failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarType $carType)
    {
        //
        $carTypeImage = $carType->image;
        $deleted = $carType->delete();
        if($deleted){
            $imageDeleted = Storage::disk('public')->delete($carTypeImage);
        }
        return response()->json([
            'message' => $imageDeleted ? 'Deleted successfully' : 'Delete failed'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
