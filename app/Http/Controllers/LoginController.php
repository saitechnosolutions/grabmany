<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LoginController extends Controller {

    public function register( Request $request ) {
        //  dd( $request );

        if ( User::where( 'email', $request->input( 'email' ) )->orWhere( 'phone_number', $request->input( 'phone' ) )->exists() ) {
            return redirect()->back()->with( 'error', 'User Already Exists' );
        } else {

            $user = new User();
            $user->name = $request->input( 'name' );
            $user->email = $request->input( 'email' );
            $user->phone_number = $request->input( 'phone' );
            $user->password = Hash::Make( $request->input( 'password' ) );
            $user->mode = 'loggin';

            $user->save();

            return redirect( '/login' )->with( 'success', 'User Registered SuccessFully' );

        }
    }

    public function login( Request $request ) {
        $phone = $request->input( 'phone' );
        $password = $request->input( 'password' );

        $credentials = [
            'phone_number' => $request[ 'phone' ],
            'password' => $request[ 'password' ],
        ];

        if ( Auth::attempt( $credentials ) ) {
            $user = User::where( 'phone_number', $phone )->first();
            Auth::login( $user );

            $userid = Auth::user()->id;

            return redirect( '/' )->with( 'success', 'Login Successfully' );
        } else {
            return back()->with( 'error', 'Invalid Credentials...' );
        }
    }

    public function logout( Request $request ) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect( '/' );
    }

    public function edituser( Request $request ) {
        $user = User::find( $request->input( 'editid' ) );
        $user->name = $request->input( 'name' );
        $user->email = $request->input( 'email' );
        $user->phone = $request->input( 'phone' );

        //  $user->confirm_pass = Hash::Make( $request->input( 'confirm_password' ) );

        $user->save();

        return redirect()->back()->with( 'success', 'User Details Updated Successfully' );
    }

    public function checkmail( Request $request ) {

        $email = $request->input( 'email' );
        $user = User::where( 'email', $email )->first();

        if ( $user ) {
            // Generate OTP
            $otp = rand( 1000, 9999 );
            // dd( $otp );
            // Save OTP and expiry time in the database
            $user->otp = $otp;
            $user->otp_expiry = Carbon::now()->addMinutes( 2 );
            // Set expiry for 2 minutes
            $user->save();

            // Email data
            $data = [
                'otp' => $otp,
                'email' => $email,
                'username' => $user->name,
                'status' => 'otp'
            ];

            // Send OTP email
            Mail::to( $email )->send( new ContactMail( $data ) );

            return response()->json( [ 'exists' => true, 'message' => 'OTP sent successfully.' ] );
        }

        return response()->json( [ 'exists' => false, 'message' => 'Email not found.' ] );
    }

    public function verifyOtp( Request $request ) {

        $email = $request->input( 'email' );
        $otp = $request->input( 'otp' );

        $user = User::where( 'email', $email )->first();

        if ( $user && $user->otp == $otp ) {
            if ( Carbon::now()->lt( $user->otp_expiry ) ) {
                return response()->json( [ 'valid' => true, 'message' => 'OTP verified successfully.' ] );
            } else {
                return response()->json( [ 'valid' => false, 'message' => 'OTP expired. Please request a new one.' ] );
            }
        }

        return response()->json( [ 'valid' => false, 'message' => 'Invalid OTP. Please try again.' ] );
    }

    public function resetPassword( Request $request ) {
        $email = $request->input( 'email' );
        $newPassword = Hash::make( $request->input( 'password' ) );

        $user = User::where( 'email', $email )->first();
        if ( $user ) {
            $user->password = $newPassword;
            $user->otp = null;
            $user->save();
            return response()->json( [ 'success' => true ] );
        }

        return response()->json( [ 'success' => false ] );
    }

    public function getCities( $state_id ) {
        $cities = city::where( 'state_id', $state_id )->get();
        return response()->json( $cities );
    }
}