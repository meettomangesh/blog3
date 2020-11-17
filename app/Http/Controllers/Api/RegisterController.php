<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Models\CustomerLoyalty;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Helper\DataHelper;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email_address' => 'required|email|unique:customer_loyalty,email_address',
            'mobile_number' => 'required|unique:customer_loyalty,mobile_number',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['referral_code'] = DataHelper::generateBarcodeString(9);
        $input['email_verify_key'] = DataHelper::emailVerifyKey();
        $input['created_by'] = 1;
        $user = CustomerLoyalty::create($input);
        $success['token'] =  $user->createToken(getenv('APP_NAME'))->accessToken;
        $success['name'] =  $user->first_name. " " .$user->last_name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (Auth::guard('api')->attempt(['mobile_number' => $request->mobile_number, 'password' => $request->password])) {
            $user = Auth::guard('api')->user();
            $success['token'] =  $user->createToken(getenv('APP_NAME'))->accessToken;
            $success['name'] =  $user->first_name. " " .$user->last_name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}