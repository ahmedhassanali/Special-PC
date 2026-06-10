<?php

namespace App\Services;

use App\Models\Captain;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerification;
use App\Mail\ResetPassword;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CaptainAuthService
{


    // Method to register a new captain
    public function register(array $data)
    {
        // Set default status for new user
        $data['status'] = Captain::NEWUSER;
        // Hash the user's password
        $data['password'] = Hash::make($data['password']);

        // If a photo is provided, upload it and store the image path in the data
        if (isset($data['photo'])) {
            $image = new ImageService($data['photo'], 'storage/captains/', $data['photo']->getcaptainOriginalName());
            $data['image'] = $image->upload();
        }

        // Create a new captain and cart record in the database
        $captain = Captain::create($data);
        $data['captain_id'] = $captain->id;
        Cart::create($data);
        // Send a verification email to the captain's email address
        $this->sendVerificationEmail($captain->email);

        // Return the created captain
        return $captain;
    }

		// Method to log in a captain
    public function login(array $credentials, string $fcmToken): bool
    {
        $captain = Captain::where('email', $credentials['email'])->first();

        if (!$captain || !Hash::check($credentials['password'], $captain->password)) {
            return false;
        }

        $this->updateFcmToken($captain, $fcmToken);

        return true;

        $captain['accessToken'] = $captain->createToken('authToken')->accessToken;

        $captain = Captain::where('email', $credentials['email'])->first();
        // Attempt to authenticate the captain
        if (Auth::guard('app')->attempt($credentials)) {
            // Update the FCM token for the authenticated captain
            $this->updateFcmToken($captain, $fcmToken);
        }

        return false;
    }

    // Method to update the captain profile
    public function updateProfile(array $data, int $id)
    {
        // Set status for an old user
        $data['status'] = Captain::OLDUSER;

        // If a new password is provided, hash it
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Find the captain in the database by ID
        $captain = Captain::find($id);

        // If a new photo is provided, update the image path in the data
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'], 'storage/captains/', $data['photo']->getcaptainOriginalName(), $captain->image);
        }

        // Update the captain record in the database
        return $captain->update($data);
    }

    // Method to delete a captain from the database
    public function delete(int $id)
    {
        // Find the captain in the database by ID
        $captain = Captain::find($id);

        // If the captain has an image, delete it
        if ($captain->image) {
            $data['image'] = ImageService::delete($captain->image);
        }

        // Delete the captain record from the database
        $captain->delete();
    }

    // Method to send a verification email to a captain
    public function sendVerificationEmail($email)
    {
        // Find the captain in the database by email
        $captain = Captain::where('email', $email)->first();

        // If the captain is found, generate a verification code and send the email
        if ($captain) {
            $verificationCode = rand(1000, 9999);
            $captain['code'] = $verificationCode;
            $captain->save();
            return Mail::to($captain->email)->send(new EmailVerification($verificationCode));
        } else {
            return false;
        }
    }

    // Method to send a password reset email to a captain
    public function resetPasswordEmail($email)
    {
        // Find the captain in the database by email
        $captain = Captain::where('email', $email)->first();

        // If the captain is found, generate a verification code and send the email
        if ($captain) {
            $verificationCode = rand(1000, 9999);
            $captain['code'] = $verificationCode;
            $captain->save();
            return Mail::to($captain->email)->send(new ResetPassword($verificationCode));
        } else {
            return false;
        }
    }

    // Method to check if the verification code matches for email verification
    public function CheckVerificationCode($email, $code)
    {
        // Find the captain in the database by email
        $captain = Captain::where('email', $email)->first();

        // If the captain is found, check if the verification code matches
        if ($captain) {
            if ($captain->code == $code) {
                $captain['email_verified_at'] = now();
                $captain->save();
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
        // Find the captain in the database by email
        $captain = Captain::where('email', $email)->first();

        // If the captain is found, check if the verification code matches
        if ($captain) {
            if ($captain->code == $code) {
                return 'true';
            } else {
                return 'Verification code does not match.';
            }
        } else {
            return 'This Email Not Found';
        }
    }

    // Method to set a new password for a captain
    public function newPassword($email, $newPassword)
    {
        // Find the captain in the database by email
        $captain = Captain::where('email', $email)->first();

        // If the captain is found, set a new hashed password and save
        if ($captain) {
            $captain['password'] = Hash::make($newPassword);
            $captain->save();
            return $captain;
        } else {
            return false;
        }
    }

    // Method to change the password for a captain
    public function changePassword($id, $oldPassword, $newPassword)
    {
        // Find the captain in the database by ID
        $captain = Captain::find($id);

        // If the captain is found and the old password matches, set a new hashed password and save
        if ($captain && Hash::check($oldPassword, $captain->password)) {
            $captain->password = Hash::make($newPassword);
            return $captain->save();
        } else {
            return false;
        }
    }

		// Helper method to update the FCM token for a captain
    private function updateFcmToken(captain $captain, string $fcmToken): void
    {
        $captain->fcm_token = $fcmToken;
        $captain->save();
    }

}
