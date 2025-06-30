<?php

namespace App\Http\Controllers;

use App\Models\career;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerController extends Controller
{
    public function contact(Request $request)
    {
        require base_path("vendor/autoload.php");

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $message = $request->input('message');





        // Store in the database


        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chandrup.sts@gmail.com';
            $mail->Password = 'hkgtvandexxpapyg';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('chandrup.sts@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Customer Details';

            $mail->Body = "<html>
            <head>
            <title>Contact Details</title>
            <style>
                table, td, th { border: 1px solid black; text-align: center; padding: 5px; }
                th { background-color: beige; }
                td:hover { background-color: #E7E8EA; }
                table { width: 100%; border-collapse: collapse; }
            </style>
            </head>
            <body>
            <h2>Hello Sir / Madam</h2>
            <p style='font-size:16px;'>Kindly find below the enquiry details.</p>
            <h4 style='background-color:#e0e0eb;padding: 5px;'>Grabmany</h4>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>       
                    <th>Phone</th>
                   
                    <th>Message</th>
                    
                  
                </tr>
                <tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phone</td>
                    
                    <td>$message</td>
                                    
                </tr>
            </table>
            </body>
            </html>";

            // Send email
            if (!$mail->send()) {
                return back()->with('error', 'Email could not be sent.');
            } else {
                return redirect()->back()->with("success", "Form Submit Successfully.");
            }
        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }
    }
    public function contact_send(Request $request)
    {
        require base_path("vendor/autoload.php");

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');





        // Store in the database


        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chandrup.sts@gmail.com';
            $mail->Password = 'hkgtvandexxpapyg';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('chandrup.sts@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Customer Details';

            $mail->Body = "<html>
            <head>
            <title>Contact Details</title>
            <style>
                table, td, th { border: 1px solid black; text-align: center; padding: 5px; }
                th { background-color: beige; }
                td:hover { background-color: #E7E8EA; }
                table { width: 100%; border-collapse: collapse; }
            </style>
            </head>
            <body>
            <h2>Hello Sir / Madam</h2>
            <p style='font-size:16px;'>Kindly find below the enquiry details.</p>
            <h4 style='background-color:#e0e0eb;padding: 5px;'>Spykaar Cables & Wires:</h4>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>       
                    <th>Phone</th>
                     <th>Subject</th>
                    <th>Message</th>
                  
                </tr>
                <tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phone</td>
                    <td>$subject</td>
                    <td>$message</td>
                                    
                </tr>
            </table>
            </body>
            </html>";

            // Send email
            if (!$mail->send()) {
                return back()->with('error', 'Email could not be sent.');
            } else {
                // return redirect()->back()->with("success", "Form Submit Successfully.");
            }
        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }
    }
}
