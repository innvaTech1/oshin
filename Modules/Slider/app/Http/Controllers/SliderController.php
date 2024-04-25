<?php

namespace Modules\Slider\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Slider\app\Services\SliderService;

class SliderController extends Controller
{
    use RedirectHelperTrait;

    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = $this->sliderService->all()->paginate(20);
        return view('slider::index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slider::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'status' => 'required',
        ]);
        try
        {
            $this->sliderService->create($request->except('_token'));
            $notification = array(
                'messege' => 'Slider created successfully',
                'alert-type' => 'success'
            );

            return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.slider.index');
            
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            $notification = array(
                'messege' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = $this->sliderService->find($id);
        return view('slider::edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
            'status' => 'required',
        ]);
        try
        {
            $slider = $this->sliderService->find($id);
            $this->sliderService->update($slider,$request->except('_token'));
            $notification = array(
                'messege' => 'Slider updated successfully',
                'alert-type' => 'success'
            );
            return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.slider.index');
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            $notification = array(
                'messege' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $product = $this->sliderService->find($id);

            if(!$product){
                $notification = array(
                    'message' => 'Slider not found',
                    'alert-type' => 'error'
                );
                return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.slider.index');
            }
            $this->sliderService->delete($product);
            $notification = array(
                'message' => 'Slider deleted successfully',
                'alert-type' => 'success'
            );
            return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.slider.index');
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
