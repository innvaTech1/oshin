<?php

namespace Modules\Slider\app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Slider\app\Resources\SliderResource;
use Modules\Slider\app\Services\SliderService;

class SliderController extends Controller
{

    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = $this->sliderService->active();

        $sliders = SliderResource::collection($sliders);
        if($sliders->isEmpty()){
            return responseFail('No slider found', 404);
        }
        return responseSuccess($sliders);

    }
}
