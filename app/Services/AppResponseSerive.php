<?php

namespace App\Services;


class AppResponseSerive
{
    public function sendJson($statusCode = 200, $success = true, $code = 'A01', $payload = 'Successful!', $type = 'success', $message = 'Successfully')
    {
        return response()->json([
            'success' => $success,
            'code'    => $code,
            'message' => $message,
            'payload' => $payload,
            'type'    => $type
        ], $statusCode);
    }

    public function sendValidationError($errors, $message = 'The given data was invalid.')
    {
        return $this->sendJson(422, false, config('rest.response.validation_error.code'), $errors, 'error', $message);
    }


    public function sendUnauthorizedError($errors, $message = 'Unauthorized Access.')
    {
        $errors = [
            'message' => [$message]
        ];
        return $this->sendJson(401, false, config('rest.response.unauthorized.code'), $errors, 'error', $message);
    }

    public function sendEmailVarifiedError($message = 'Please Verify your email address.')
    {
        $errors = [
            'message' => [$message]
        ];
        return $this->sendJson(307, false, config('rest.response.login.verify_email.code'), $errors, 'error', $message);
    }

    public function sendAddSuccess($data, $message = "Successfully Added")
    {
        # code...   
        $payload = [
            'data' => $data
        ];
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendUpdateSuccess($data, $message = "Successfully Updated")
    {
        # code...   
        $payload = [
            'data' => $data
        ];
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendDeleteSuccess($data = [])
    {
        $payload = [
            'item' => $data
        ];
        $message = "Successfully deleted";
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendSuccess($payload, $message = "Success")
    {
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendInvalid($message = "Wrong email or password!")
    {
        $payload = [
            'message' => [$message]
        ];
        return $this->sendJson(403, false, config('rest.response.login.invalid.code'), $payload, 'error', $message);
    }

    public function sendNotFound($message = "Not found. Try another one")
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(404, false, config('rest.response.error.code'), $payload, 'error', $message);
    }

    public function sendError($message = 'Whoops, looks like something went wrong! Please try again.')
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(511, false, config('rest.response.error.code'), $payload, 'error');
    }

    public function sendPermissionError($message = 'Permission denied. Please contact your admin.')
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(403, false, config('rest.response.error.code'), $payload, 'error', $message);
    }
}
