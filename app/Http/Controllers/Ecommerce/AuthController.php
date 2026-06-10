<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\CahngePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('ecommerce')->attempt($credentials)) {
                // Merging guest cart items into the logged-in user's cart
                $customer = Auth::guard('ecommerce')->user();
                $guestCartItems = session('cart_items', []);
    
                foreach ($guestCartItems as $guestCartItem) {
                    $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    
                    $existingItem = $cart->items()->where('product_id', $guestCartItem['product_id'])->first();
    
                    if ($existingItem) {
                        $existingItem->update(['quantity' => $existingItem->quantity + $guestCartItem['quantity']]);
                    } else {
                        $cart->items()->create([
                            'product_id' => $guestCartItem['product_id'],
                            'quantity' => $guestCartItem['quantity'],
                        ]);
                    }
                }
    
                // Clear the guest cart session
                session()->forget('cart_items');
    
                return redirect()->intended('home');
            } else {
                return redirect()->back()->with('error', 'Invalid email or password.');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
    

    public function LoginForm()
    {
        try {
            return view('ecommerce.auth.login');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('ecommerce')->logout();
            $request->session()->invalidate();
            return redirect()->route('home');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function registerForm()
    {
        try {
            return view('ecommerce.auth.register');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function passwordCodeForm()
    {
        return view('ecommerce.auth.passwords.password-code');
    }

    public function verificationCodeForm()
    {
        return view('ecommerce.auth.verification-code');
    }

    public function forgotPasswordForm()
    {
        try {
            return view('ecommerce.auth.passwords.forgot-password');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $customer = $this->authService->register($request->all());
    
            // Merging guest cart items into the registered user's cart
            $guestCartItems = session('cart_items', []);
    
            foreach ($guestCartItems as $guestCartItem) {
                $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    
                $existingItem = $cart->items()->where('product_id', $guestCartItem['product_id'])->first();
    
                if ($existingItem) {
                    $existingItem->update(['quantity' => $existingItem->quantity + $guestCartItem['quantity']]);
                } else {
                    $cart->items()->create([
                        'product_id' => $guestCartItem['product_id'],
                        'quantity' => $guestCartItem['quantity'],
                    ]);
                }
            }
    
            // Clear the guest cart session
            session()->forget('cart_items');
    
            return view('ecommerce.auth.verification-code', compact('customer->email'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
    

    public function sendEmailForm()
    {
        try {
            return view('ecommerce.auth.send-email');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function sendVerificationEmail(Request $request)
    {
        try {
            $response = $this->authService->sendVerificationEmail($request->email);
            if ($response === false) {
                return redirect()->back()->with('error', 'User Not Found');
            } else {
                $email = $request->email;
                return view('ecommerce.auth.verification-code', compact('email'))->with('success', 'The email has been sent successfully.');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function checkVerificationCode(Request $request)
    {
        try {
            $num1 = intval($request['num1']);
            $num2 = intval($request['num2']);
            $num3 = intval($request['num3']);
            $num4 = intval($request['num4']);
            $code = $num1 * 1000 + $num2 * 100 + $num3 * 10 + $num4;
            $email = $request['email'];
            $response = $this->authService->checkVerificationCode($request['email'], $code);
            if ($response === 'true') {
                return redirect()->route('home')->with('success', ' تم تسجيل الحساب بنجاح');
            } else {
                return  view('ecommerce.auth.verification-code' , compact('email'))->with('error', $response);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function resetPasswordEmail(Request $request)
    {
        try {
            $response = $this->authService->resetPasswordEmail($request->email);
            if ($response === false) {
                return redirect()->back()->with('error', 'User Not Found');
            } else {
                $email = $request->email;
                return view('ecommerce.auth.passwords.password-code', compact('email'))->with('success', 'The email has been sent successfully.');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function resetPasswordCheckCode(Request $request)
    {
        try {
            $num1 = intval($request['num1']);
            $num2 = intval($request['num2']);
            $num3 = intval($request['num3']);
            $num4 = intval($request['num4']);
            $code = $num1 * 1000 + $num2 * 100 + $num3 * 10 + $num4;
            $email = $request->email;

            $response = $this->authService->resetPasswordCheckCode($email, $code);
            if ($response === 'true') {
                return view('ecommerce.auth.passwords.new-password', compact('email'));
            } else {
                $message =$response;
                return view('ecommerce.layouts.catch', compact('message'))->with('error', $response);

                // return view('ecommerce.auth.passwords.password-code', compact('email'))->with('error', $response);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function newPassword(NewPasswordRequest $request)
    {
        try {
            $response = $this->authService->newPassword($request['email'], $request['password']);
            $email = $request['email'];
            if ($response === false) {
                return view('ecommerce.auth.passwords.new-password', compact('email'))->with('error', 'User Not Found');
            } else {
                return  redirect()->route('ecommerce.login');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function changePassword($id, CahngePasswordRequest $request)
    {
        try {
            $response = $this->authService->changePassword($id, $request['old_password'], $request['password']);

            if ($response === false) {
                return redirect()->back()->with( 'error', 'Incorrect old password');
            } else {
                return redirect()->back()->with( 'success' ,'Password updated successfully');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
