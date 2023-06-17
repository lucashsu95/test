<?php

namespace App\Traits;

trait ApiResponse
{
    public function success($data = "", $statusCode = 200)
    {
        return Response()->json([
            'success' => true,
            'data' => $data,
            'message' => ''
        ], $statusCode);
    }

    public function fails($statusCode = 400, $message = '')
    {
        return Response()->json([
            'success' => false,
            'data' => "",
            'message' => $message
        ], $statusCode);
    }

    public function validationFails(\Illuminate\Validation\Validator $validator)
    {
        [$message, $statusCode] = explode(' ', $validator->errors()->first());
        return $this->fails($statusCode, $message);
    }

    public function MSG_INVALID_LOGIN()
    {
        return 'MSG_INVALID_LOGIN 403';
    }

    public function INVALID_LOGIN()
    {
        return $this->fails(403, 'MSG_INVALID_LOGIN');
    }

    public function MSG_USER_EXISTS()
    {
        return 'MSG_USER_EXISTS 409';
    }

    public function USER_EXISTS()
    {
        return $this->fails(409, 'MSG_USER_EXISTS');
    }

    public function MSG_PASSWORD_NOT_SECURE()
    {
        return 'MSG_PASSWORD_NOT_SECURE 409';
    }

    public function PASSWORD_NOT_SECURE()
    {
        return $this->fails(409, 'MSG_PASSWORD_NOT_SECURE');
    }

    public function MSG_INVALID_ACCESS_TOKEN()
    {
        return 'MSG_INVALID_ACCESS_TOKEN 401';
    }

    public function INVALID_ACCESS_TOKEN()
    {
        return $this->fails(401, 'MSG_INVALID_ACCESS_TOKEN');
    }

    public function MSG_PERMISSION_DENY()
    {
        return 'MSG_PERMISSION_DENY 403';
    }

    public function PERMISSION_DENY()
    {
        return $this->fails(403, 'MSG_PERMISSION_DENY');
    }

    public function MSG_MISSING_FIELD()
    {
        return 'MSG_MISSING_FIELD 400';
    }

    public function MISSING_FIELD()
    {
        return $this->fails(400, 'MSG_MISSING_FIELD');
    }

    public function MSG_WROND_DATA_TYPE()
    {
        return 'MSG_WROND_DATA_TYPE 400';
    }

    public function WROND_DATA_TYPE()
    {
        return $this->fails(400, 'MSG_WROND_DATA_TYPE');
    }

    public function MSG_POST_NOT_EXISTS()
    {
        return 'MSG_POST_NOT_EXISTS 404';
    }

    public function POST_NOT_EXISTS()
    {
        return $this->fails(404, 'MSG_POST_NOT_EXISTS');
    }

    public function MSG_COMMENT_NOT_EXISTS()
    {
        return 'MSG_COMMENT_NOT_EXISTS 404';
    }

    public function COMMENT_NOT_EXISTS()
    {
        return $this->fails(404, 'MSG_COMMENT_NOT_EXISTS');
    }

    public function MSG_USER_NOT_EXISTS()
    {
        return 'MSG_USER_NOT_EXISTS 404';
    }

    public function USER_NOT_EXISTS()
    {
        return $this->fails(404, 'MSG_USER_NOT_EXISTS');
    }

    public function MSG_INVALID_FILE_FORMAT()
    {
        return 'MSG_INVALID_FILE_FORMAT 400';
    }

    public function INVALID_FILE_FORMAT()
    {
        return $this->fails(400, 'MSG_INVALID_FILE_FORMAT');
    }
}
