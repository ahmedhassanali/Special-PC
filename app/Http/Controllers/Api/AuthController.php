<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Services\AuthService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $fcmToken = $request->input('fcm_token');
            $credentials = $request->only('email', 'password');
            if ($this->authService->login($credentials, $fcmToken)) {
                $customer = Customer::where('email', $request->email)->first();
                $customer['accessToken'] = $customer->createToken('authToken')->accessToken;

                return  $this->successResponse($customer, 'Successfully login');
            } else {
                return $this->errorResponse('Invalid email or password.', 404);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }


    public function logout(Request $request)
    {
        try {
            $request->user('api')->token()->revoke();
            return  $this->successResponse(null, 'Successfully logged out');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $customer = $this->authService->register($request->all());
            $accessToken = $customer->createToken('authToken')->accessToken;
            return response()->json(['customer' => $customer, 'accessToken' => $accessToken]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }


    public function sendVerificationEmail(Request $request)
    {
        try {
            $response = $this->authService->sendVerificationEmail($request->email);
            if ($response === false) {
                return $this->errorResponse('User Not Found', 404);
            } else {
                $customer = Customer::where('email', $request->email)->first();
                return $this->successResponse($customer, 'The email has been sent successfully.');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function checkVerificationCode(Request $request)
    {
        try {
            $response = $this->authService->checkVerificationCode($request['email'], $request['code']);
            if ($response === 'true') {
                $customer = Customer::where('email', $request->email)->first();
                $customer['accessToken'] = $customer->createToken('authToken')->accessToken;
                return $this->successResponse($customer, 'success');
            } else {
                return $this->errorResponse($response, 404);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function resetPasswordEmail(Request $request)
    {
        try {
            $response = $this->authService->resetPasswordEmail($request->email);
            if ($response === false) {
                return $this->errorResponse('User Not Found', 404);
            } else {
                return $this->successResponse($response, 'The email has been sent successfully.');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function resetPasswordCheckCode(Request $request)
    {
        try {
            $response = $this->authService->resetPasswordCheckCode($request['email'], $request['code']);
            if ($response === 'true') {
                return $this->successResponse($response, 'success');
            } else {
                return $this->errorResponse($response, 404);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function newPassword(Request $request)
    {
        try {
            $response = $this->authService->newPassword($request['email'], $request['newPassword']);
            if ($response === false) {
                return $this->errorResponse('User Not Found', 404);
            } else {
                return $this->successResponse($response, 'Password updated successfully');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function changePassword($id, Request $request)
    {
        try {
            $response = $this->authService->changePassword($id, $request['oldPassword'], $request['newPassword']);

            if ($response === false) {
                return $this->errorResponse('Incorrect old password', 404);
            } else {
                return $this->successResponse($response, 'Password updated successfully');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
