<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerification;
use App\Mail\ResetPassword;
use App\Models\Cart;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthService
{


    // Method to register a new Customer
    public function register(array $data)
    {
        // Set default status for new user
        $data['status'] = Customer::NEWUSER;
        // Hash the user's password
        $data['password'] = Hash::make($data['password']);

        // If a photo is provided, upload it and store the image path in the data
        if (isset($data['photo'])) {
            $image = new ImageService($data['photo'], 'storage/Customers/', $data['photo']->getCustomerOriginalName());
            $data['image'] = $image->upload();
        }

        // Create a new Customer and cart record in the database
        $customer = Customer::create($data);
        $data['customer_id'] = $customer->id;
        Cart::create($data);
        // Send a verification email to the Customer's email address
        $this->sendVerificationEmail($customer->email);

        // Return the created Customer
        return $customer;
    }

		// Method to log in a Customer
    public function login(array $credentials, string $fcmToken): bool
    {

        $customer = Customer::where('email', $credentials['email'])->first();

        if (!$customer || !Hash::check($credentials['password'], $customer->password)) {
            return false;
        }

        $this->updateFcmToken($customer, $fcmToken);

        return true;

        $customer['accessToken'] = $customer->createToken('authToken')->accessToken;

        $customer = Customer::where('email', $credentials['email'])->first();
        // Attempt to authenticate the Customer
        if (Auth::guard('app')->attempt($credentials)) {
            // Update the FCM token for the authenticated Customer
            $this->updateFcmToken($customer, $fcmToken);
        }

        return false;
    }

    // Method to update the Customer profile
    public function updateProfile(array $data, int $id)
    {
        // Set status for an old user
        $data['status'] = Customer::OLDUSER;

        // If a new password is provided, hash it
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Find the Customer in the database by ID
        $customer = Customer::find($id);

        // If a new photo is provided, update the image path in the data
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'], 'storage/Customers/', $data['photo']->getCustomerOriginalName(), $customer->image);
        }

        // Update the Customer record in the database
        return $customer->update($data);
    }

    // Method to delete a Customer from the database
    public function delete(int $id)
    {
        // Find the Customer in the database by ID
        $customer = Customer::find($id);

        // If the Customer has an image, delete it
        if ($customer->image) {
            $data['image'] = ImageService::delete($customer->image);
        }

        // Delete the Customer record from the database
        $customer->delete();
    }

    // Method to send a verification email to a Customer
    public function sendVerificationEmail($email)
    {
        // Find the Customer in the database by email
        $customer = Customer::where('email', $email)->first();

        // If the Customer is found, generate a verification code and send the email
        if ($customer) {
            $verificationCode = rand(1000, 9999);
            $customer['code'] = $verificationCode;
            $customer->save();
            return Mail::to($customer->email)->send(new EmailVerification($verificationCode));
        } else {
            return false;
        }
    }

    // Method to send a password reset email to a Customer
    public function resetPasswordEmail($email)
    {
        // Find the Customer in the database by email
        $customer = Customer::where('email', $email)->first();

        // If the Customer is found, generate a verification code and send the email
        if ($customer) {
            $verificationCode = rand(1000, 9999);
            $customer['code'] = $verificationCode;
            $customer->save();
            return Mail::to($customer->email)->send(new ResetPassword($verificationCode));
        } else {
            return false;
        }
    }

    // Method to check if the verification code matches for email verification
    public function CheckVerificationCode($email, $code)
    {
        // Find the Customer in the database by email
        $customer = Customer::where('email', $email)->first();

        // If the Customer is found, check if the verification code matches
        if ($customer) {
            if ($customer->code == $code) {
                $customer['email_verified_at'] = now();
                $customer->save();
                return 'true';
            } else {
                return 'Verification code does not match.';
            }
        } else {
            return 'This Email Not Found';
        }
    }

    // Method to check if the verification code matches for password reset
    public function resetPasswordCheckCode($email, $code)
    {
        // Find the Customer in the database by email
        $customer = Customer::where('email', $email)->first();

        // If the Customer is found, check if the verification code matches
        if ($customer) {
            if ($customer->code == $code) {
                return 'true';
            } else {
                return 'Verification code does not match.';
            }
        } else {
            return 'This Email Not Found';
        }
    }

    // Method to set a new password for a Customer
    public function newPassword($email, $newPassword)
    {
        // Find the Customer in the database by email
        $customer = Customer::where('email', $email)->first();
        // If the Customer is found, set a new hashed password and save
        if ($customer) {
            $customer['password'] = Hash::make($newPassword);
            $customer->save();
            return $customer;
        } else {
            return false;
        }
    }

    // Method to change the password for a Customer
    public function changePassword($id, $oldPassword, $newPassword)
    {
        // Find the Customer in the database by ID
        $customer = Customer::find($id);

        // If the Customer is found and the old password matches, set a new hashed password and save
        if ($customer && Hash::check($oldPassword, $customer->password)) {
            $customer->password = Hash::make($newPassword);
            return $customer->save();
        } else {
            return false;
        }
    }

		// Helper method to update the FCM token for a Customer
    private function updateFcmToken(Customer $customer, string $fcmToken): void
    {
        $customer->fcm_token = $fcmToken;
        $customer->save();
    }

}
