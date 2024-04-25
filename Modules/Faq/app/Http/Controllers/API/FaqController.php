<?php

namespace Modules\Faq\app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Faq\app\Models\Faq;
use Modules\Faq\app\Resources\FaqResource;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::where('status', 1)->orderBy('id', 'asc')->get();
        $faqs = FaqResource::collection($faqs);
        if($faqs->isEmpty()){
            return responseFail('No faq found', 404);
        }
        return responseSuccess($faqs);
    }

    
}
