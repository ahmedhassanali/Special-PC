<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Captain;
use App\Services\CaptainService;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    use ApiResponser;

    public function __construct(private CaptainService $captainService)
    {
    }

    public function update(Request $request, Captain $captain)
    {
        try {
            $captain = $this->captainService->update($request->all() , $captain->id);
            return $this->successResponse($captain, 'captain_Updated_Successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show(Captain $captain)
    {
        try {
            $captain = Captain::find($captain->id);
            return $this->successResponse($captain, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $captain = Captain::find($id);
            if ($captain->image){
                $data['image'] = ImageService::delete($captain->image);
            }
            $captain->delete();
            return $this->successResponse('success', 'Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
