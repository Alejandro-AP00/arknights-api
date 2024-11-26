<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Build a JSON response with standardized formatting.
     *
     * @param mixed $data The data to return.
     * @param int $status HTTP status code (default is 200).
     * @param array $headers Additional headers (default is empty).
     * @param int $options JSON encoding options (default includes JSON_UNESCAPED_UNICODE).
     * @return JsonResponse
     */
    public static function success($data, $status = 200, array $headers = [], $options = 0)
    {
        $options |= JSON_UNESCAPED_UNICODE;
        return response()->json(['success' => true, 'data' => $data], $status, $headers, $options);
    }

    /**
     * Build a JSON response for errors.
     *
     * @param string $message Error message.
     * @param int $status HTTP status code (default is 400).
     * @param array $headers Additional headers (default is empty).
     * @param int $options JSON encoding options (default includes JSON_UNESCAPED_UNICODE).
     * @return JsonResponse
     */
    public static function error($message, $status = 400, array $headers = [], $options = 0)
    {
        $options |= JSON_UNESCAPED_UNICODE;
        return response()->json(['success' => false, 'error' => $message], $status, $headers, $options);
    }
}
