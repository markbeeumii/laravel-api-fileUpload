<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\OpenApi(
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="API Testing Server"
 *     ),
 *     @OA\Info(
 *         version="1.0.0",
 *         title="SOKHAK API Documentation",
 *         description="API List for SOKHAK's system",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(name="SOKHAK Team", email="support@sokhak.com"),
 *         @OA\License(
 *              name="Apache 2.0",
 *              url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *          )
 *     ),
 *     security={
 *         {"bearer": {}},
 *         {"client-host": {}}
 *     },
 * )
 */
abstract class BaseAPIController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The default pagination size.
     *
     * @var int The pagination size
     */
    protected $pagination = 20;
    /**
     * The maximum pagination size.
     *
     * @var int The pagination size
     */
    protected $maxLimit = 500;
    /**
     * The minimum pagination size.
     *
     * @var int The pagination size
     */
    protected $minLimit = 1;

    /**
     * The filter with archived data.
     *
     * @var bool The archived data.
     */
    protected $archived = false;

    /**
     * Getter for the pagination.
     *
     * @return int The pagination size
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Sets and checks the pagination.
     *
     * @param int $pagination The given pagination
     */
    public function setPagination(int $pagination)
    {
        $this->pagination = (int) $this->checkPagination($pagination);
    }

    /**
     * Checks the pagination.
     *
     * @param * $pagination The pagination
     *
     * @return int The corrected pagination
     */
    private function checkPagination($pagination)
    {
        // Pagination should be numeric
        if (! is_numeric($pagination)) {
            return $this->pagination;
        }
        // Pagination should not be less than the minimum limitation
        if ($pagination < $this->minLimit) {
            return $this->minLimit;
        }
        // Pagination should not be greater than the maximum limitation
        if ($pagination > $this->maxLimit) {
            return $this->maxLimit;
        }
        // If the pagination is between the min limit and the max limit, return the pagination
        if (! ($pagination > $this->maxLimit) && ! ($pagination < $this->minLimit)) {
            return $pagination;
        }

        // If all fails, return the default pagination
        return $this->pagination;
    }

    // For testing with login
    
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
	protected function success($data, string $message = null, int $code = 200)
	{
		return response()->json([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	/**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	protected function error(string $message = null, int $code, $data = null)
	{
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code);
	}
}
