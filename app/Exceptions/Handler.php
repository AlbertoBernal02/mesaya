use Illuminate\Auth\Access\AuthorizationException;

public function render($request, Exception $exception)
{
if ($exception instanceof AuthorizationException) {
return response()->view('errors.403', [], 403);
}
}