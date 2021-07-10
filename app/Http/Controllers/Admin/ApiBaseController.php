<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiBaseController extends Controller
{

    public function __construct()
    {

    }

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode): ApiBaseController
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondNotFound(string $message = 'Data Not Found!'): JsonResponse
    {
        return $this->setStatusCode(404)->respondWithError($message, 404);
    }

    public function respondValidationError($message = 'Bad Input.Try Again!'): JsonResponse
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondInternalError(string $message = 'Internal Error!'): JsonResponse
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * @param $message
     * @param int $status_code
     * @return JsonResponse
     */
    public function respondWithError($message, int $status_code = 500): JsonResponse
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $status_code,
            ]
        ]);

    }

    /**
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, array $headers = []): JsonResponse
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function respondWithMessage($message, $data): JsonResponse
    {
        return $this->respond([
            'message' => $message,
            'data' => $data,
        ]);
    }


}
